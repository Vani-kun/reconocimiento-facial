<?php
header('Content-Type: application/json');
date_default_timezone_set('America/Caracas');
require "../conexion.php";

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$tokenNav = $data['token'] ?? '';
$idNav = $data['id'] ?? '';
$nameNav = $data['name'] ?? '';

if (empty($tokenNav) || empty($nameNav) || empty($idNav)) {
    echo json_encode(['logged' => false, "level" => 0, 'reason' => 'incomplete_info']);
    exit;
    }

try {
    // Buscamos al usuario que tenga ese token de sesión activo
    $stmt = $pdo->prepare("SELECT usuario, level, actual_sesion, keep_sesion, `time-up` FROM usuarios WHERE id = ?");
    $stmt->execute([$idNav]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Si keep_sesion es 0, verificamos el tiempo transcurrido
        if ($user['keep_sesion'] == 0) {
            $ultimaActividad = strtotime($user['time-up']);
            $ahora = time();
            $diferenciaMinutos = ($ahora - $ultimaActividad) / 60;

            if ($diferenciaMinutos > 30) {
                // Pasaron más de 30 minutos, invalidamos la sesión en la BD
                $update = $pdo->prepare("UPDATE usuarios SET actual_sesion = NULL, keep_sesion = 0, `time-up` = NULL WHERE id = ?");
                $update->execute([$idNav]);
                
                echo json_encode(['logged' => false, "level" => 0, 'reason' => 'timeout', "timemark" => json_encode(["ahora" => $ahora, "antes" => $ultimaActividad, "diferencia" => $diferenciaMinutos])]);
                exit;
            }
        }

    if(password_verify($user['actual_sesion'], $tokenNav)){
        // Si todo está bien, devolvemos éxito
        $update = $pdo->prepare("UPDATE usuarios SET `time-up` = NOW() WHERE id = ?");//Actualizamos la marca de tiempo
        $update->execute([$idNav]);
        echo json_encode([
            'logged' => true,
            'level' => $user['level']
        ]);
        }else{
        echo json_encode(['logged' => false, "level" => 0, 'reason' => 'invalid_token']);  
        }
    } else {
        echo json_encode(['logged' => false, "level" => 0, 'reason' => 'no_coincidence']);
    }
} catch (PDOException $e) {
    echo json_encode(['logged' => false, "level" => 0, 'error' => $e->getMessage()]);
}
?>