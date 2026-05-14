<?php
// 1. Forzar la destrucción de cualquier rastro de sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Limpiar el array de sesión por completo
$_SESSION = array();

// 3. Destruir la sesión en el servidor
session_destroy();

// 4. Limpiar cookies del navegador (Esto evita el segundo clic)
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// 5. Cabeceras anti-caché para que no "recuerde" la página de admin
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// 6. Redirección directa y final a login.php
header("Location: login.php");
exit();
?>