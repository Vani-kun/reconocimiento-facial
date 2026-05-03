<?php
header('Content-Type: application/json');

try {
    require "../conexion.php";

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['id']) && isset($data['activo'])) {
        $id = $data['id'];
        $activo = $data['activo'];

        $sql = "UPDATE caras SET activo = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$activo, $id]);

        echo json_encode(["success" => true, "message" => "Activado/Desactivado con éxito"]);
    } else {
        echo json_encode(["success" => false, "error" => "Datos incompletos"]);
    }
} catch (Exception $e) {
    // Si algo falla, enviamos el error en formato JSON puro
    http_response_code(500);
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>