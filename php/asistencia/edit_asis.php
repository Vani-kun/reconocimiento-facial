<?php
// get_asistencia.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Establecemos la zona horaria de Caracas para que concuerde con tu ubicación
date_default_timezone_set('America/Caracas');

require "../conexion.php";

try {
$json = file_get_contents('php://input');
$data = json_decode($json, true);

    $sql = "UPDATE asistencia SET estado = :stat, tardanza = :tardanza, entrada = :entrada, salida = :salida, detalles = :descripcion WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        
        // Mapeamos los nombres de tu objeto JS a las columnas de la BD
        $resultado = $stmt->execute([
            ':stat'    => $data['state'],
            ':tardanza' => $data['tardanza'],
            ':entrada'  => $data['opentime'],
            ':salida'   => $data['closetime'],
            ':id'       => $data['id'],
            ':descripcion' => $data['description']
        ]);

        echo json_encode(["success" => true, "resultado" => $resultado]);

} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>