<?php
session_start();
require "php/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_input = $_POST['usuario'];
    $pass_input = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$user_input]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass_input, $user['password'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['rol'] = $user['rol'];
        $_SESSION['nombre'] = $user['usuario'];

        if ($_SESSION['rol'] === 'admin') {
            header("Location: warp.php");
        } else {
            // El Viewer y cualquier otro rol van a asistencia.php
            header("Location: asistencia.php");
        }
        exit();
    } else {
        header("Location: acceso_admin.php?error=1");
        exit();
    }
}
?>