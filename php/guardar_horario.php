<?php
header('Content-Type: application/json');

require "conexion.php";

// Leer los datos enviados por Fetch (JSON)
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['materia'])) {

    $materia = $data['materia'];
    $aula = $data['aula'];
    $h_entrada = $data['h_entrada'];
    $h_salida = $data['h_salida'];
    $seccion = $data['seccion'];

    try{
        // Preparar la consulta SQL y ejecutarla
        $sql = "INSERT INTO horario (asignatura, aula, entrada, salida, seccion) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$materia, $aula, $h_entrada, $h_salida, $seccion]);

        $idGenerado = $pdo->lastInsertId();

        //Responder al JavaScript que todo salió bien
        echo json_encode(["success" => true, "message" => "Guardado con éxito", "id" => $idGenerado, 'materia' => $materia, 'aula' => $aula, 'h_entrada' => $h_entrada, 'h_salida' => $h_salida, 'seccion' => $seccion]);
    }catch (PDOException $e) {
        echo json_encode(["success" =>false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Datos incompletos"]);
}


?>