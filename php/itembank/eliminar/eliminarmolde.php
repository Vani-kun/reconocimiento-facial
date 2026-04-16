<?php
header('Content-Type: application/json');

require "../../conexion.php";

// Leer los datos enviados por Fetch (JSON)
$json = file_get_contents('php://input');
$data = json_decode($json, true);


if (isset($data['id'])) {

    $id         = $data['id'];
    $type       = (int)$data['type'];
    $sql        = "";
    
    try{

        switch ($type) {
            case 0:
                $sql = "DELETE FROM materias WHERE nombre = ?";
                break;
            case 1:
                $sql = "DELETE FROM horas WHERE id = ?";
                break;
            case 2:
                $sql = "DELETE FROM aulas WHERE numero = ?";
                break;
            case 3:
                $sql = "DELETE FROM secciones WHERE numero = ?";
                break;
            default:
                throw new Exception("Tipo de molde no válido");
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        //Responder al JavaScript que todo salió bien
        echo json_encode(["success" => true, "message" => "Guardado con éxito"]);
    }catch (PDOException $e) {
        echo json_encode(["success" =>false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Datos incompletos"]);
}


?>