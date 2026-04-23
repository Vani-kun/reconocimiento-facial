<?php
header('Content-Type: application/json');

try {
    require "../conexion.php";

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['id'])) {
        $id = $data['id'];

        $sql = "SELECT id, asignatura, seccion, aula, dias FROM horario WHERE profesor = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(["success" => true, "message" => "Actualizado con éxito", "data" => $registros]);
    } else {
        echo json_encode(["success" => false, "error" => "Datos incompletos"]);
    }
} catch (Exception $e) {
    // Si algo falla, enviamos el error en formato JSON puro
    http_response_code(500);
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>