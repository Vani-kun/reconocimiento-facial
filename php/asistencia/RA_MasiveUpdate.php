<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set('America/Caracas');

require "../conexion.php";

$data = json_decode(file_get_contents('php://input'), true);

$ids      = $data['ids'];      
$status   = $data['status'];   
$tardanza = $data['tardanza']; 

if (!empty($ids) && is_array($ids)) {
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    
    // Cambia "tu_tabla" por el nombre real de tu tabla (ej. asistencia)
    $sql = "UPDATE asistencia SET estado = ?, tardanza = ? WHERE id IN ($placeholders)";
    
    $stmt = $pdo->prepare($sql);
    
    // IMPORTANTE: Debes pasar todos los valores en un solo array:
    // Primero el status, luego la tardanza, y luego todos los IDs
    $params = array_merge([$status, $tardanza], $ids);
    $results = $stmt->execute($params); // <--- Punto y coma añadido
    
    if ($results) {
        echo json_encode(["success" => true, "message" => "Registros actualizados"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al ejecutar la consulta"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No se enviaron IDs válidos"]);
}

?>