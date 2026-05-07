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

    $modo = (int)$data['modo'];
    $rango = $data['rango'];
    $errores = $data['errores'];


    if($modo===0){
        $sql = "SELECT  rango, errores FROM configuracion";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
       // $resultados = $stmt->fetchAll();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC); // Traer una sola fila

        echo json_encode([
            "success" => true, 
            "rango"=>  $resultado['rango'],
            "errores"=>  $resultado['errores'],
            "msg" => "Exitosa la lectura"
        ]);
        exit;
    }else
    if($modo===1){
        $sql = "UPDATE configuracion SET rango = :rg, errores = :err";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':rg' => $rango,':err' => $errores ]);
        $resultados = $stmt->fetchAll();

        echo json_encode([
            "success" => true, 
            "rango"=>  $rango,
            "errores"=>  $errores,
            "msg" => "Exitosa la Actualizacion"
        ]);
        exit;
    }



} catch (Exception $e) {
    echo json_encode([
        "success" => false, 
        "msg" => "Error en consulta ".$e->getMessage()
    ]);
}
?>