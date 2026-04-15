<?php
header('Content-Type: application/json');

try {
    require "conexion.php";

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['id1']) && isset($data['horarios1'])) {
        $id1 = $data['id1'];
        $horarios1 = isset($data['horarios1']) ? json_encode($data['horarios1']) : json_encode([]);

        $id2 = $data['id2'];
        $horarios2 = isset($data['horarios2']) ? json_encode($data['horarios2']) : json_encode([]);

        $IDHorario = $data['IDHorario'];

        if($id1 !== -1){
        $sql = "UPDATE caras SET horarios = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$horarios1, $id1]);
        }

        if ($id2 !== -1) {
        $sql = "UPDATE caras SET horarios = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$horarios2, $id2]);
        }

        $sql = "UPDATE horario SET profesor = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id1, $IDHorario]);

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