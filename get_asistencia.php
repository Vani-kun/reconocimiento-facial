<?php
// get_asistencia.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Establecemos la zona horaria de Caracas para que concuerde con tu ubicación
date_default_timezone_set('America/Caracas');

require "conexion.php";

try {
    $hoy = date('Y-m-d');
    
    // Traemos SOLO los registros de hoy para el reporte diario
    $stmt = $pdo->prepare("SELECT id, nombre, entrada, salida, estado, fecha FROM asistencia WHERE fecha = :hoy ORDER BY entrada ASC");
    $stmt->execute(['hoy' => $hoy]);
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $registros,
        "total" => count($registros),
        "fecha" => $hoy
    ]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>