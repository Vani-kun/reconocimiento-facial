<?php
header('Content-Type: application/json');
ini_set('display_errors', 0); 
date_default_timezone_set('America/Caracas'); // <--- AGREGA ESTO

try {
    include "conexion.php"; 
    // Recuerda verificar si usas $pdo o $conn

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data || !isset($data['nombre'])) {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
        exit;
    }

    $nombre = $data['nombre'];
    $horaActual = $data['hora']; 
    $fechaHoy = date('Y-m-d');

    // 1. BUSCAR REGISTRO DE HOY
    $stmt = $pdo->prepare("SELECT id, estado, entrada FROM asistencia WHERE nombre = ? AND fecha = ? LIMIT 1");
    $stmt->execute([$nombre, $fechaHoy]);
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$registro) {
        // CASO 0: No existe -> REGISTRAR ENTRADA
        $sql = "INSERT INTO asistencia (nombre, entrada, fecha, estado) VALUES (?, ?, ?, 1)";
        $pdo->prepare($sql)->execute([$nombre, $horaActual, $fechaHoy]);
        
        echo json_encode([
            'success' => true, 
            'message' => "Entrada registrada: $nombre a las $horaActual",
            'estado' => 1
        ]);
    } 
    else {
        $estadoActual = (int)$registro['estado'];
        $idReg = $registro['id'];
        $horaEntrada = $registro['entrada']; // Formato HH:MM:SS

        if ($estadoActual === 1) {
            // --- LÓGICA DE LOS 5 MINUTOS ---
            $entradaTimestamp = strtotime($fechaHoy . ' ' . $horaEntrada);
            $ahoraTimestamp = time();
            $diferenciaSegundos = $ahoraTimestamp - $entradaTimestamp;
            $esperaRequerida = 5 * 60; // 300 segundos

            if ($diferenciaSegundos < $esperaRequerida) {
                $faltanteSegundos = $esperaRequerida - $diferenciaSegundos;
                $minutos = ceil($faltanteSegundos / 60);
                
                echo json_encode([
                    'success' => false, 
                    'error' => "Faltan $minutos min. para poder marcar salida."
                ]);
                exit;
            }

            // CASO 1: Ya pasó el tiempo -> REGISTRAR SALIDA
            $sql = "UPDATE asistencia SET salida = ?, estado = 2 WHERE id = ?";
            $pdo->prepare($sql)->execute([$horaActual, $idReg]);
            
            echo json_encode([
                'success' => true, 
                'message' => "Salida registrada: $nombre a las $horaActual",
                'estado' => 2
            ]);
        } 
        else {
            echo json_encode(['success' => false, 'error' => "Jornada completada para $nombre."]);
        }
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Error de BD: ' . $e->getMessage()]);
}
?>