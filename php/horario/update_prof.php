<?php
header('Content-Type: application/json');

try {
    require "../conexion.php";

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['id']) && isset($data['prof'])) {
        $id = $data['id'];
        $prof = $data['prof'];
        $reemplace = $data['reemplace'];

        // CORRECCIÓN: Se añadió la coma entre activo y tags
        $sql = "UPDATE horario SET profesor = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$prof, $id]);

        if($reemplace != -1){
            $sql = "UPDATE horario SET profesor = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["", $reemplace]);  
            }
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