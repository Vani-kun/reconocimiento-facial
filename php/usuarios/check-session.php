<?php
header('Content-Type: application/json');
require "../conexion.php";

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$tokenNav = $data['token'] ?? '';

if (empty($tokenNav)) {
    echo json_encode(['logged' => false]);
    exit;
}

try {
    // Buscamos al usuario que tenga ese token de sesión activo
    $stmt = $pdo->prepare("SELECT id, usuario, rol, keep_sesion, `time-up` FROM usuarios WHERE actual_sesion = ?");
    $stmt->execute([$tokenNav]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Si keep_sesion es 0, verificamos el tiempo transcurrido
        if ($user['keep_sesion'] == 0) {
            $ultimaActividad = strtotime($user['time-up']);
            $ahora = time();
            $diferenciaMinutos = ($ahora - $ultimaActividad) / 60;

            if ($diferenciaMinutos > 30) {
                // Pasaron más de 30 minutos, invalidamos la sesión en la BD
                $update = $pdo->prepare("UPDATE usuarios SET actual_sesion = NULL WHERE id = ?");
                $update->execute([$user['id']]);
                
                echo json_encode(['logged' => false, 'reason' => 'timeout']);
                exit;
            }
        }

        // Si todo está bien, devolvemos éxito
        $update = $pdo->prepare("UPDATE usuarios SET `time-up` = NOW() WHERE id = ?");//Actualizamos la marca de tiempo
        $update->execute([$user['id']]);
        echo json_encode([
            'logged' => true,
            'user' => $user['usuario'],
            'rol' => $user['rol']
        ]);
    } else {
        echo json_encode(['logged' => false, 'reason' => 'invalid_token']);
    }
} catch (PDOException $e) {
    echo json_encode(['logged' => false, 'error' => $e->getMessage()]);
}
?>