<?php
header('Content-Type: application/json');

require "conexion.php";

// Leer los datos enviados por Fetch (JSON)
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['descriptor'])) {
    $nombre = $data['nombre'];
    $descriptor = $data['descriptor']; // Esto ya viene como string JSON
    $tags = isset($data['tags']) ? json_encode($data['tags']) : json_encode([]); 
    try{
        // Preparar la consulta SQL y ejecutarla
        $sql = "INSERT INTO caras (nombre, descriptor, tags, activo) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $descriptor, $tags, 1]);

        $nuevoId = $pdo->lastInsertId();

        $nuevoProfesor = [
            "id" => (int)$nuevoId,
            "nombre" => $nombre,
            "tags" => $tags,
            "activo" => 1
        ];

        //Responder al JavaScript que todo salió bien
        echo json_encode(["success" => true, "message" => "Guardado con éxito", "profesor" => $nuevoProfesor]);
    }catch (PDOException $e) {
        echo json_encode(["success" =>false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Datos incompletos"]);
}


?>