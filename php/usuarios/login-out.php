<?php
header('Content-Type: application/json');
require "../conexion.php";

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$tokenNav = $data['token'] ?? '';
$idNav = $data['id'] ?? '';
$nameNav = $data['name'] ?? '';

if (empty($tokenNav) || empty($nameNav) || empty($idNav)) {
    echo json_encode(['success' => false, 'reason' => 'incomplete_info']);
    exit;
    }

try {
    // Buscamos al usuario que tenga ese token de sesión activo
    $stmt = $pdo->prepare("SELECT actual_sesion FROM usuarios WHERE id = ? AND usuario = ?");
    $stmt->execute([$idNav,$nameNav]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if(password_verify($user['actual_sesion'], $tokenNav)){
        // Si todo está bien, devolvemos éxito
            $update = $pdo->prepare("UPDATE usuarios SET actual_sesion = NULL, keep_sesion = 0, `time-up` = NULL WHERE id = ?");
            $update->execute([$idNav]);
            echo json_encode([
            'success' => true
            ]);
            }else{
            echo json_encode(['success' => false, 'reason' => 'invalid_token']);  
            }
    } else {
        echo json_encode(['success' => false, 'reason' => 'no_coincidence']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>