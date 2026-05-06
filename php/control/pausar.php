<?php
// php/config/update_pausa.php
header('Content-Type: application/json');
require "../conexion.php";

try {
    // Obtenemos el cuerpo de la petición JSON
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['nuevo_estado'])) {
        throw new Exception("No se recibió el estado");
    }

    $nuevoEstado = (int)$input['nuevo_estado'];

    // Actualizamos la tabla configuración (asumiendo que hay una sola fila)
    $sql = "UPDATE configuracion SET pausa = :pausa";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['pausa' => $nuevoEstado]);

    echo json_encode([
        "success" => true, 
        "msg" => "Sistema " . ($nuevoEstado == 1 ? "Pausado" : "Activado")
    ]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "msg" => $e->getMessage()]);
}
?>