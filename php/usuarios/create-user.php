<?php
// register_user.php
header('Content-Type: application/json');

// Reutilizamos tu conexión existente
require "../conexion.php"; 

try {
    // Obtenemos los datos (asumiendo que los mandas por JSON desde JS)
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data || !isset($data['usuario']) || !isset($data['password'])) {
        echo json_encode(['success' => false, 'error' => 'Faltan datos obligatorios']);
        exit;
    }

    $user = trim($data['usuario']);
    $pass = $data['password'];
    // Si no mandas nivel, por defecto será 1
    
    // 1. Encriptamos la contraseña (¡NUNCA guardes texto plano!)
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT);

    // 2. Verificamos si el usuario ya existe para evitar errores
    $check = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = ?");
    $check->execute([$user]);
    
    if ($check->rowCount() > 0) {
        echo json_encode(['success' => false, 'error' => 'El nombre de usuario ya está en uso']);
        exit;
    }

    // 3. Insertamos en la base de datos
    // Nota: 'actual_sesion' y 'time-up' pueden ser NULL según tu captura
    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, password, level, keep_sesion) VALUES (?, ?, ?, ?)");
    
    // keep_sesion por defecto en 0 (false)
    if ($stmt->execute([$user, $passwordHash, 1, 0])) {
        echo json_encode([
            "success" => true, 
            "message" => "Usuario registrado exitosamente"
        ]);
    } else {
        echo json_encode(["success" => false, "error" => "Error al insertar en la BD"]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Error de BD: " . $e->getMessage()]);
}
?>