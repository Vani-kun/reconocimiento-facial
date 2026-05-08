<?php
// get_asistencia.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// Establecemos la zona horaria de Caracas para que concuerde con tu ubicación
date_default_timezone_set('America/Caracas');
require "conexion.php";

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $id = $data['id'] ?? null;
    $start = $data['start'] ?? null;
    $end = $data['end'] ?? null;

        $sql = "SELECT id, nombre, tags FROM caras WHERE id = :iid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':iid' => $id]); 
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $sql = "SELECT * FROM asistencia WHERE profesorID = :iid AND fecha BETWEEN :startt AND :endd ORDER BY fecha DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':iid' => $id,':startt' => $start,':endd' => $end]); 
        $total = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "success" => true, 
            "resultado" => $resultados,
             "total" => $total
        ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => "Error en SQL: " . $e->getMessage()
    ]);
}
?>
