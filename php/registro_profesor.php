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

        $sql = "SELECT * FROM caras WHERE id = :iid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':iid' => $id]); 
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT * FROM asistencia WHERE profesorID = :iid AND estado IN (1, 2) ORDER BY fecha DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':iid' => $id]); 
        $todasLasAsistencias  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total = count($todasLasAsistencias);

        $sql = "SELECT * FROM asistencia WHERE profesorID = :iid AND estado=0 ORDER BY fecha DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':iid' => $id]); 
        $inAsistencias  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $totali = count($inAsistencias);
        echo json_encode([
            "success" => true, 
            "resultado" => $resultados,
             "total" => (int)$total,
            "totali" => (int)$totali
        ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => "Error en SQL: " . $e->getMessage()
    ]);
}
?>
