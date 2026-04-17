<?php
$host = 'localhost';
$db   = 'sistema_asistencia'; // Asegúrate que este nombre coincida en phpMyAdmin
$user = 'root';
$pass = ''; // XAMPP por defecto no tiene contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>