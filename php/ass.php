<?php
// 1. Establecer el encabezado JSON antes de cualquier salida
header('Content-Type: application/json');

// Desactivar la visualización de errores directos para que no rompan el JSON
ini_set('display_errors', 0);

try {
    // 2. Incluir la conexión (Asegúrate de que la variable sea $pdo)
    include "conexion.php";

    // 3. Leer datos del JS (Solo una vez es necesario)
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data || !isset($data['nombre']) || !isset($data['hora'])) {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos o mal formados']);
        exit;
    }

    $nombre = $data['nombre'];
    $hora   = $data['hora'];
    $fecha  = date('Y-m-d');

    // 4. Preparar e Insertar
    $sql = "INSERT INTO asistencia (nombre, entrada, fecha) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$nombre, $hora, $fecha])) {
        echo json_encode([
            'success' => true, 
            'message' => 'Asistencia marcada: ' . $nombre
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al ejecutar la inserción']);
    }

} catch (PDOException $e) {
    // Captura errores de base de datos
    echo json_encode(['success' => false, 'error' => 'Error de BD: ' . $e->getMessage()]);
} catch (Exception $e) {
    // Captura cualquier otro tipo de error
    echo json_encode(['success' => false, 'error' => 'Error general: ' . $e->getMessage()]);
}
?>