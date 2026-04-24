<?php
header('Content-Type: application/json');
ini_set('display_errors', 0); 
date_default_timezone_set('America/Caracas'); // <--- AGREGA ESTO

try {
    include "conexion.php"; 
    // Recuerda verificar si usas $pdo o $conn

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data || !isset($data['id'])) {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos',"nombre" => "Error"]);
        exit;
    }

    $nombre = $data['nombre'];
    $profesorID = $data['id'];
    $horaActual = $data['hora']; 
    $fechaHoy = date('Y-m-d');
    $diaSemana = date("w");

    switch ($diaSemana) {
        case 1:
            $diaSemana = "Lunes";
            break;
        case 2:
            $diaSemana = "Martes";
            break;
        case 3:
            $diaSemana = "Miercoles";
            break;
        case 4:
            $diaSemana = "Jueves";
            break;
        case 5:
            $diaSemana = "Viernes";
            break;
        case 6:
            $diaSemana = "Sabado";
            break;
        case 7:
            $diaSemana = "Domingo";
            break;
        default:
            $diaSemana = "Lunes";
            break;
    }

// 2. Verificar si ya existen registros para hoy
$check = $pdo->prepare("SELECT COUNT(*) FROM asistencia WHERE fecha = ?");
$check->execute([$fechaHoy]);

if ($check->fetchColumn() == 0) {
    
    // Preparamos el JSON de búsqueda para el día actual
    $jsonBusqueda = json_encode(["Dia" => $diaSemana]);

    // 3. Inserción Masiva Optimizada
    // Usamos DISTINCT para que si un profesor tiene varias clases hoy, solo se cree un registro de asistencia
    $sqlInitial = "INSERT INTO asistencia (profesorID, entrada, salida, fecha, estado, tardanza)
                   SELECT DISTINCT profesor, '00:00:00', '00:00:00', ?, 0, 0
                   FROM horario 
                   WHERE JSON_CONTAINS(dias, ?) 
                   AND profesor IS NOT NULL 
                   AND profesor != ''";
    
    try {
        $stmtPopulate = $pdo->prepare($sqlInitial);
        $stmtPopulate->execute([$fechaHoy, $jsonBusqueda]);

    } catch (PDOException $e) {
        error_log("Error en Lazy Cron: " . $e->getMessage());
    }
}

$jsonBusqueda = json_encode(["Dia" => $diaSemana]);


    //Va a sacar todos las horas que le toquen al profesor actual
    $stmt = $pdo->prepare("SELECT id, asignatura, seccion, aula, dias FROM horario WHERE profesor = ? AND JSON_CONTAINS(dias, ?)");
    $stmt->execute([$profesorID, $jsonBusqueda]);
    $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!$horarios){//Si no hay ninguna las dejara asi
        echo json_encode([
            'success' => true, 
            'message' => "No hay materias conocidas del profesor $nombre para hoy $diaSemana",
            'estado' => 5,
            "nombre" => $nombre,
            "horarios" => $horarios
        ]);
        exit;
        }

    
    $openhour = "24:00:00";//Esto determinará a que hora tiene que entrar el profesor
    $closehour = "00:00:00";

    foreach ($horarios as $hour) {
        $alldays = json_decode($hour["dias"], true);
        foreach ($alldays as $day) {
            if($day["Dia"] == $diaSemana){
                if(strtotime($day["HoraE"]) < strtotime($openhour)){
                $openhour = $day["HoraE"];
                }

                if(strtotime($day["HoraS"]) > strtotime($closehour)){
                $closehour = $day["HoraS"];
                }
            }
        }
    }

    $tardanza = 0;

    $minutosDeGracia = $data['threshold']; 
    $segundosThreshold = $minutosDeGracia * 60;

    if((strtotime($openhour)+$segundosThreshold) < $horaActual){
        $tardanza = 1;
        }


    //Se busca si hay un registro listo para hoy
    $stmt = $pdo->prepare("SELECT id, estado, entrada FROM asistencia WHERE profesorID = ? AND fecha = ? LIMIT 1");
    $stmt->execute([$profesorID, $fechaHoy]);
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$registro) {
        // CASO 0: No existe -> REGISTRAR ENTRADA
        $sql = "INSERT INTO asistencia (profesorID, entrada, fecha, tardanza, estado) VALUES (?, ?, ?, ?, 1)";
        $pdo->prepare($sql)->execute([$profesorID, $horaActual, $fechaHoy, $tardanza]);
        
        echo json_encode([
            'success' => true, 
            'message' => "Entrada registrada!",
            'estado' => 1,
            "nombre" => $nombre,
            "horarios" => $horarios,
            "hora" => $horaActual
        ]);
    } 
    else {
        $estadoActual = (int)$registro['estado'];
        $idReg = $registro['id'];
        if($estadoActual === 0){
        $sql = "UPDATE asistencia SET entrada = ?, tardanza = ?, estado = 1 WHERE id = ?";
        $pdo->prepare($sql)->execute([$horaActual, $tardanza, $idReg]);

        echo json_encode([
            'success' => true, 
            'message' => "Entrada registrada!",
            'estado' => 1,
            "nombre" => $nombre,
            "horarios" => $horarios,
            "hora" => $horaActual
        ]);

        }else if ($estadoActual === 1) {
            $horaEntrada = $registro['entrada']; // Formato HH:MM:SS
            // --- LÓGICA DE LOS 5 MINUTOS ---
            $entradaTimestamp = strtotime($fechaHoy . ' ' . $horaEntrada);
            $ahoraTimestamp = time();
            $diferenciaSegundos = $ahoraTimestamp - $entradaTimestamp;
            $esperaRequerida = 5 * 60; // 300 segundos

           if ($diferenciaSegundos < $esperaRequerida) {
                $faltanteSegundos = $esperaRequerida - $diferenciaSegundos;
                $minutos = ceil($faltanteSegundos / 60);
                
                echo json_encode([
                    'success' => true, 
                    'message' => "Faltan $minutos min. para poder marcar salida.",
                    'estado' => 4,
                    "nombre" => $nombre,
                    "horarios" => $horarios
                ]);
                exit;
            }

            // CASO 1: Ya pasó el tiempo -> REGISTRAR SALIDA
            $sql = "UPDATE asistencia SET salida = ?, estado = 2 WHERE id = ?";
            $pdo->prepare($sql)->execute([$horaActual, $idReg]);
            
            echo json_encode([
                'success' => true, 
                'message' => "Salida registrada!",
                'estado' => 2,
                "nombre" => $nombre,
                "horarios" => $horarios,
                "hora" => $horaActual
            ]);
        } 
        else {
            echo json_encode(['success' => true, 'message' => "Jornada completada para $nombre.",'estado' => 3,"nombre" => $nombre,"horarios" => $horarios]);
        }
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Error de BD: ' . $e->getMessage(),"nombre" => $nombre]);
}
?>