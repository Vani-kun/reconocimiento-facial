<?php
header('Content-Type: application/json');
require "conexion.php";

try {
    $stmt = $pdo->query("SELECT nombre, descriptor FROM caras");
    $usuarios = $stmt->fetchAll();
    
    // Enviamos los datos a JS
    echo json_encode(["success" => true, "message" => "Guardado con éxito", "usuarios" => $usuarios]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }
?>