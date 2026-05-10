<?php
header('Content-Type: application/json');

require "../conexion.php";

// Leer los datos enviados por Fetch (JSON)
$json = file_get_contents('php://input');
$data = json_decode($json, true);


if (isset($data['profId'])) {

    $profId     = $data['profId'];
    $timeStart  = $data['timeStart'];
    $timeEnd    = $data['timeEnd'];   
    $timeDate   = $data['timeDate']; 
    $state      = $data['state']; 
    $late       = $data['late'];  
    $details    = $data['details']; 

    try{
        // Preparar la consulta SQL y ejecutarla
        $sql = "INSERT INTO asistencia (profesorID, entrada, salida, fecha, estado, tardanza, detalles) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$profId, $timeStart, $timeEnd, $timeDate, $state, $late, $details]);

        //Responder al JavaScript que todo salió bien
        echo json_encode(["success" => true, "message" => "Registro creado con exito"]);
    }catch (PDOException $e) {
        echo json_encode(["success" =>false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Datos incompletos"]);
}


?>