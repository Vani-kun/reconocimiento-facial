<?php
// Indicamos al navegador que la respuesta es un JSON
header('Content-Type: application/json');

try {
    include "../conexion.php";

    // Consultamos los registros
    $sql = "SELECT id, descriptores, nombre, activo, tags FROM caras ORDER BY activo DESC, nombre ASC";
    $stmt = $pdo->query($sql);
    $profesores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Enviamos los datos convertidos a JSON
    echo json_encode($profesores);

} catch (PDOException $e) {
    // Si hay un error, enviamos un mensaje de error en JSON
    echo json_encode(["error" => $e->getMessage()]);
}
?>