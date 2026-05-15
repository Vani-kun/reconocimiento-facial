<?php
header('Content-Type: application/json');
ini_set('display_errors', 0); 
date_default_timezone_set('America/Caracas'); 

include "../conexion.php";

include "create_inasis.php";

if($result == 1) {
    echo json_encode(['success' => true, 'message' => 'Registros de asistencia creados para hoy']);
} else {
    echo json_encode(['success' => false, 'message' => 'No se pudieron crear los registros de asistencia para hoy']);
}

?>