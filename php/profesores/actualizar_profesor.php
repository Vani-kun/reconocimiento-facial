<?php
header('Content-Type: application/json');

try {
    require "../conexion.php";

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['id']) && isset($data['nombre']) && isset($data['tags'])) {
        $id = $data['id'];
        $nombre = $data['nombre'];
        $descriptor = $data['descriptor'];
        $tags =json_encode($data['tags']);

        $sql = "UPDATE caras SET nombre = ?, descriptores = ?, tags = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $descriptor, $tags, $id]);

        echo json_encode(["success" => true, "message" => "Actualizado con éxito"]);
    } else {
        echo json_encode(["success" => false, "error" => "Datos incompletos"]);
    }
} catch (Exception $e) {
    // Si algo falla, enviamos el error en formato JSON puro
    http_response_code(500);
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>