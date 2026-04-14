<?php
// 1. Variables de acceso
$host = "localhost";
$db   = "proyecto";
$user = "root";
$pass = ""; 

try {
    // 2. Intentar la conexión
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    // echo "✅ Conexión exitosa a la base de datos."; 

} catch (PDOException $e) {
    die("❌ Error: No se pudo conectar. " . $e->getMessage());
}
?>