<?php
// personas.php
header('Content-Type: application/json');

// Desactivar visualización de errores HTML para que no rompan el JSON
ini_set('display_errors', 0);
error_reporting(E_ALL);

try {
    require "conexion.php";

    $sql = "SELECT id, nombre, descriptor FROM caras ORDER BY nombre ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // fetchAll(PDO::FETCH_ASSOC) trae todo como un array asociativo directamente
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $personas = [];
    foreach ($resultados as $fila) {
        $personas[] = [
            'id'         => (int) $fila['id'], // Es buena práctica incluir el ID
            'nombre'     => $fila['nombre'],
            // Decodificamos el descriptor de string a array de floats
            'descriptor' => json_decode($fila['descriptor'])
        ];
    }

    echo json_encode([
        "success" => true, 
        "faces"   => $personas
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false, 
        "error"   => $e->getMessage()
    ]);
}