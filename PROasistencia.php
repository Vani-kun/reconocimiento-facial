<?php
header('Content-Type: application/json');
date_default_timezone_set('America/Caracas');
include 'php/conexion.php';

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $profesor_id = $data['pid'];
    $profesor_name = $data['nombre'];
    //if (!$profesor_id) throw new Exception("ID no recibido.");

    $hoy = date('Y-m-d');
    $ahora = date('Y-m-d H:i:s');
    $horita=date("g:i A"); 
    $entro=$horita;
    $salio=$horita;


    // 1. Buscamos la asistencia de HOY para este profesor
    $stmt = $pdo->prepare("SELECT id, entrada,salida, estado FROM asistencia WHERE profesorID = :pid AND fecha = :hoy LIMIT 1");
    $stmt->execute([':pid' => $profesor_id, ':hoy' => $hoy]);
    $asistencia = $stmt->fetch();
            


    if (!$asistencia) {
        // CASO A: No hay registro hoy -> INSERTAR ENTRADA (Estado 1)
        $ins = $pdo->prepare("INSERT INTO asistencia (profesorID,fecha, entrada, estado) VALUES ( :proid,:hoy, :ahora, 1)");
       $ins->execute([':proid' => $profesor_id,':hoy' => $hoy, ':ahora' => $ahora]);
        
        echo json_encode([
            "success" => true, 
            "entro"=>$entro,
           "salio"=>"En espera",
            "tipo"=>"entrada",
            "valor"=>$horita,   
            "msg" => "ENTRADA REGISTRADA: " . date('H:i:s'),
            "color" => "green"
        ]);
        exit;
    }else if ($asistencia['estado'] == "1") {
        $entro=date("g:i A",strtotime($asistencia['entrada'])); 
        // CASO B: Ya entró, verificar si puede marcar SALIDA (Estado 1 -> 2)
        $tiempo_entrada = strtotime($asistencia['entrada']);
        $tiempo_actual = strtotime($ahora);
        
        // Calculamos la diferencia en segundos
        $diferencia_segundos = $tiempo_actual - $tiempo_entrada;
        $segundos_restantes = 300 - $diferencia_segundos; // 300 seg = 5 min

        if ($diferencia_segundos < 300) {
            // Faltan menos de 5 minutos
            $minutos_faltantes = ceil($segundos_restantes / 60);
            echo json_encode([
                "success" =>true, 
                "entro"=>$entro,
                "salio"=>"faltan ".$minutos_faltantes." minutos",
                "tipo"=>"laborando",
                "valor"=> $minutos_faltantes,
                "msg" => "ESPERE: Faltan aproximadamente $minutos_faltantes min para marcar salida.",
                "color" => "orange"
            ]);
            exit;
        } else {
            // Ya pasaron los 5 minutos -> ACTUALIZAR A SALIDA
            $upd = $pdo->prepare("UPDATE asistencia SET salida = :ahora, estado = 2 WHERE id = :id");
            $upd->execute([':ahora' => $ahora, ':id' => $asistencia['id']]);
            
            echo json_encode([
                "success" => true, 
                "entro"=>$entro,
                "salio"=>$salio,
                "tipo"=>"salida",
                "valor"=> $horita,
                "msg" => "SALIDA REGISTRADA: " . date('H:i:s'),
                "color" => "blue"
            ]);
            exit;
        }
    } else if ($asistencia['estado'] == "2") {
        $entro=date("g:i A",strtotime($asistencia['entrada'])); 
        $salio=date("g:i A",strtotime($asistencia['salida'])); 
        // CASO C: El estado ya es 2 (Jornada terminada)
        echo json_encode([
            "success" => true, 
            "entro"=>$entro,
            "salio"=>$salio,
            "tipo"=>"completa",
            "valor"=>  "",
            "msg" => "JORNADA FINALIZADA POR HOY",
            "color" => "gray"
        ]);
        exit;
    }

} catch (Exception $e) {
    echo json_encode(["success" => false, "msg" => "Error: " . $e->getMessage()]);
}