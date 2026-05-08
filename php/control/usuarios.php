<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/Caracas');
require "../conexion.php";

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $tipo = (int)$data['tipo'];
    $id = $data['id'];$usr = $data['usr'];$lv = $data['lv'];
    $pass=password_hash($data['pass'], PASSWORD_BCRYPT);

    if($tipo===0){///leeer
        $sql = "SELECT * FROM usuarios";
        $stmt = $pdo->prepare($sql);$stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    echo json_encode([
        "success" => true,
        "usuarios"=>$resultado 
    ]);
    exit;}else
    if($tipo===1){///guardar
        $sql = "INSERT INTO usuarios (usuario,password,level) VALUES (:u,:p,:l)";
        $stmt = $pdo->prepare($sql);$stmt->execute([":u"=>$usr,":p"=>$pass,":l"=>$lv]);
        //$nuevoId = $pdo->lastInsertId();
    echo json_encode([
        "success" => true//,
        //"id"=> $nuevoId
    ]);
    exit;}else
    if ($tipo === 2) { /// traer para editar
        $sql = "SELECT id, usuario, level FROM usuarios WHERE id = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":id" => $id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode([
        "success" => true,
        "usuario" => $usuario
    ]);
    exit;}else///editar
    if ($tipo === 3) { /// editar
        $sql = "UPDATE usuarios SET usuario = :u, password = :p, level = :l, actual_sesion = null WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":u"=>$usr,":p"=>$pass,":l"=>$lv,":id"=>$id]);
    echo json_encode([
        "success" => true
    ]);
    exit;}else///eliminar
    if ($tipo === 4) { /// eliminar
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":id"=>$id]);
    echo json_encode([
        "success" => true
    ]);
    exit;}else{///desconocido
    echo json_encode([
        "success" => true
    ]);
    exit;}

} catch (Exception $e) {
    echo json_encode([
        "success" => false, 
        "msg" => "Error en consulta ".$e->getMessage()//temporal
    ]);
}
?>