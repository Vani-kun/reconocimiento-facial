<?php
// login_user.php
header('Content-Type: application/json');
date_default_timezone_set('America/Caracas');
session_start();

require "../conexion.php";

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data || !isset($data['usuario']) || !isset($data['password'])) {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
        exit;
    }

    $user = trim($data['usuario']);
    $pass = $data['password'];
    $tokenSesion = $data['token_sesion']; // El ID de sesión que viene del JS
    $tokenHash = password_hash($data['token_sesion'], PASSWORD_BCRYPT);
    $mantenerSesion = $data['keep_sesion'] ? 1 : 0; // Booleano: 1 o 0

    // 1. Buscamos al usuario por su nombre
    $stmt = $pdo->prepare("SELECT id, usuario, password, level FROM usuarios WHERE usuario = ?");
    $stmt->execute([$user]);
    $usuarioDB = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. Verificamos si existe y si la contraseña coincide con el hash
    if ($usuarioDB && password_verify($pass, $usuarioDB['password'])) {
        
        // 3. Actualizamos la base de datos con la sesión y la fecha actual (time-up)
        // Usamos NOW() para que MariaDB tome la hora exacta del servidor
        $update = $pdo->prepare("UPDATE usuarios SET 
            actual_sesion = ?, 
            keep_sesion = ?, 
            `time-up` = NOW()
            WHERE id = ?");
        
        $update->execute([$tokenSesion, $mantenerSesion, $usuarioDB['id']]);

        // Guardamos datos básicos en la sesión de PHP por seguridad
        $_SESSION['user_id'] = $usuarioDB['id'];
        $_SESSION['level'] = $usuarioDB['level'];

        echo json_encode([
            "success" => true,
            "message" => "Acceso concedido",
            "token" => $tokenHash,
            "user" => [
                "nombre" => $usuarioDB['usuario'],
                "id" => $usuarioDB['id'],
                "level" => $usuarioDB['level']
            ]
        ]);
    } else {
        echo json_encode(["success" => false, "error" => "Usuario o contraseña incorrectos"]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Error de BD: " . $e->getMessage()]);
}
?>