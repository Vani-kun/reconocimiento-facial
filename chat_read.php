<?php
// get_asistencia.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// Establecemos la zona horaria de Caracas para que concuerde con tu ubicación
date_default_timezone_set('America/Caracas');
require "php/conexion.php";

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $start_time = time();

   
        $last_id = $data['last_id'] ?? 0;
        $limit = $data['limit'] ?? null;

        if ($last_id == 0 && $limit != null) {
        // CASO A: Primera carga. Traemos los últimos N mensajes.
        $sql = "SELECT u.usuario, m.mensaje, m.id, m.fecha FROM mensajes m INNER JOIN usuarios u ON m.usuario = u.id ORDER BY m.id DESC LIMIT :limit";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "success" => true, 
            "msjs"=>  $resultados
            ]);
            exit;
        } else {
        // CASO B: Actualización constante. Solo lo nuevo desde el último ID.
        while (time() - $start_time < 40) {
            $sql = "SELECT u.usuario, m.mensaje, m.id, m.fecha FROM mensajes m INNER JOIN usuarios u ON m.usuario = u.id WHERE m.id > ? ORDER BY m.id DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$last_id]);

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($resultados)) {
                echo json_encode(["success" => true, "msjs" => $resultados, "ultimoID" => $last_id]);
                exit; // Si hay mensajes, enviamos y cerramos el script
                }

            usleep(1000000);
            }

            echo json_encode(["success" => true, "msjs" => []]);
            exit;
        }
        
    

} catch (Exception $e) {
    echo json_encode([
        "success" => false
    ]);
}
?>