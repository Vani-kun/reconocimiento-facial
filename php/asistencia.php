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

$jsonBusqueda = json_encode(["Dia" => $diaSemana]);

$stmt = $pdo->prepare("SELECT id, asignatura, seccion, aula, dias FROM horario WHERE profesor = ? AND JSON_CONTAINS(dias, ?)");
    $stmt->execute([$profesorID, $jsonBusqueda]);
    $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!$horarios){
        echo json_encode([
            'success' => true, 
            'message' => "No hay materias conocidas del profesor $nombre para hoy $diaSemana",
            'estado' => 5,
            "nombre" => $nombre,
            "horarios" => $horarios
        ]);
        exit;
        }

    $openhour = "24:00:00";
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


    // 1. BUSCAR REGISTRO DE HOY
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
            $idReg = $registro['id'];
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