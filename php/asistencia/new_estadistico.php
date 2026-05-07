<?php
// get_asistencia.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Establecemos la zona horaria de Caracas para que concuerde con tu ubicación
date_default_timezone_set('America/Caracas');

require "../conexion.php";

try {
    // 2. Definimos la fecha de hoy (formato YYYY-MM-DD)
    $hoy = date('Y-m-d');

    // 3. Consulta SQL para traer asistencias de hoy
    // Usamos COUNT y GROUP BY para obtener los totales de forma eficiente
    $sql = "SELECT estado, COUNT(*) as total 
            FROM asistencia
            WHERE fecha = :hoy 
            GROUP BY estado";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['hoy' => $hoy]);
    $resultados = $stmt->fetchAll();

    // 4. Inicializamos tus 3 variables en 0
    $estados0 = 0;
    $estados1 = 0;
    $estados2 = 0;
    

    // 5. Asignamos los valores según el resultado de la consulta
    foreach ($resultados as $fila) {
        if ($fila['estado'] == 0) $estados0 = $fila['total'];
        if ($fila['estado'] == 1) $estados1 = $fila['total'];
        if ($fila['estado'] == 2) $estados2 = $fila['total'];
    }
    $distintosDeCero = $estados1 + $estados2;
    echo json_encode([
        "success" => true, 
        "st0"=>  $estados0,
        "st1"=>  $estados1,
        "st2"=>  $estados2,
        "asis"=> $distintosDeCero,
        "msg" => "Exitosa la consulta"
    ]);
    exit;
    

} catch (Exception $e) {
    echo json_encode(["success" => false, "msg" => "Error en consulta: " . $e->getMessage()]);
}
?>