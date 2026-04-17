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

    if (!$data || !isset($data['filter'])) {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos o mal formados']);
        exit;
        }

    $filtro = $data['filter'];
    if($filtro == -1){
        $stmt = $pdo->prepare("SELECT DISTINCT fecha FROM asistencia ORDER BY fecha DESC;");
        $stmt->execute([]);
        }else{
            $stmt = $pdo->prepare("SELECT DISTINCT fecha FROM asistencia WHERE nombre = ? ORDER BY fecha DESC;");
            $stmt->execute([$filtro]);
            }

        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
        "success" => true,
        "data" => $registros,
        "fechas" => count($registros),
    ]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>

