<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Establecemos la zona horaria de Caracas para que concuerde con tu ubicación
date_default_timezone_set('America/Caracas');

require "../conexion.php";

try {
        // La consulta SQL selecciona fechas únicas y las ordena de la más reciente a la más antigua
        $sql = "SELECT DISTINCT fecha FROM asistencia ORDER BY fecha DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        // Obtenemos todos los resultados en un array simple
        $resultados = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        echo json_encode([
            "success" => true,
            "days" => $resultados
        ]);
        exit;

    } catch (PDOException $e) {
        echo json_encode([
            "success" => false,
            "mensaje" => "Error en la consulta: " . $e->getMessage()
        ]);
    }
?>