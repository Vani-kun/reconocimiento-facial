<?php
$directorio_actual = dirname(__FILE__);
$archivo_conexion = $directorio_actual . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'db.php';

if (file_exists($archivo_conexion)) {
    require_once $archivo_conexion;
} else {
    die("Error: PHP no encuentra el archivo en esta ruta: " . $archivo_conexion);
}

// ==========================================================
// CONFIGURACIÓN DE USUARIO (Cambia aquí para cada uno)
// ==========================================================
/*
// --- PARA CREAR AL ADMIN (Acceso a warp.php) ---
$user = 'abraham'; 
$pass = 'claveadmin'; 
$rol  = 'admin'; */

 // --- PARA CREAR AL VIEWER (Acceso a asistencia.php con edición) ---
$user = 'usuario_viewer'; 
$pass = 'clave_viewer_456'; 
$rol  = 'viewer'; 


// ==========================================================

try {
    $pass_encriptada = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, password, rol) VALUES (?, ?, ?)");

    if ($stmt->execute([$user, $pass_encriptada, $rol])) {
        echo "✅ ÉXITO: Usuario <b>'$user'</b> creado con el rol <b>'$rol'</b>.<br>";
        echo "Ya puedes ir al login y probar estas credenciales.";
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo "❌ ERROR: El nombre de usuario <b>'$user'</b> ya existe en la base de datos.";
    } else {
        echo "❌ Error de base de datos: " . $e->getMessage();
    }
}
?>


