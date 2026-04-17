<?php
session_start();

// Si no hay sesión, al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: acceso_admin.php");
    exit();
}

$pagina_actual = basename($_SERVER['PHP_SELF']);
$rol = $_SESSION['rol'];

// REGLA DE ORO: Solo el admin puede entrar a warp.php
if ($pagina_actual === 'warp.php' && $rol !== 'admin') {
    header("Location: asistencia.php?error=acceso_restringido");
    exit();
}

// Nota: Ambos (Admin y Viewer) pueden entrar a asistencia.php
?>