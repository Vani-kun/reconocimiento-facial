<?php
// get_asistencia.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// Establecemos la zona horaria de Caracas para que concuerde con tu ubicación
date_default_timezone_set('America/Caracas');
require "php/conexion.php";

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $userid = $data['userid'];
    $msg = $data['msg'];

        $sql = "INSERT INTO mensajes (usuario, mensaje) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userid,$msg]);

        echo json_encode([
            "success" => true
        ]);
        exit;
    

} catch (Exception $e) {
    echo json_encode([
        "success" => false
    ]);
}
?>