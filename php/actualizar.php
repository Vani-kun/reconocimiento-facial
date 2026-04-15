<?php
header('Content-Type: application/json');

try {
    require "conexion.php";

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['id']) && isset($data['nombre']) && isset($data['tag'])) {
        $id = $data['id'];
        $nombre = $data['nombre'];
        $tags = isset($data['tag']) ? json_encode($data['tag']) : json_encode([]);

        // CORRECCIÓN: Se añadió la coma entre activo y tags
        $sql = "UPDATE caras SET nombre = ?, tags = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $tags, $id]);

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