<?php
// get_asistencia.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Establecemos la zona horaria de Caracas para que concuerde con tu ubicación
date_default_timezone_set('America/Caracas');

require "../conexion.php";

try {

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data || !isset($data['sdia']) || !isset($data['edia']) || !isset($data['filtro'])) {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos o mal formados']);
        exit;
        }

    $rango1 = $data['sdia'];
    $rango2 = $data['edia'];
    $filtro = $data['filtro'];
    
    // Traemos SOLO los registros de hoy para el reporte diario
    if($filtro == -1){
        $stmt = $pdo->prepare("SELECT id, nombre, entrada, salida, estado, fecha FROM asistencia WHERE fecha BETWEEN ? AND ? ORDER BY fecha ASC, entrada ASC");
        $stmt->execute([$rango1, $rango2]);
        }else{
            $stmt = $pdo->prepare("SELECT id, nombre, entrada, salida, estado, fecha FROM asistencia WHERE nombre = ? AND fecha BETWEEN ? AND ? ORDER BY fecha ASC, entrada ASC");
            $stmt->execute([$filtro, $rango1, $rango2]);   
            }
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $registros,
        "total" => count($registros),
        "fecha" => $rango1." - ".$rango2
    ]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>