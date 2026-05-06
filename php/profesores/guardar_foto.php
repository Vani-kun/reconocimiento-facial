<?php
// php/profesores/guardar_foto.php

// El nombre llega por $_POST
$nombre = $_POST['nombre'] ?? 'foto_sin_nombre';

// La imagen llega por $_FILES
if (isset($_FILES['foto'])) {
    $archivo = $_FILES['foto'];
    
    // Ruta donde quieres guardar
    $ruta = "../../img/caras/" . $nombre . ".jpg";

    // move_uploaded_file toma el archivo temporal y lo mueve a tu carpeta
    if (move_uploaded_file($archivo['tmp_name'], $ruta)) {
        echo json_encode([
            "status" => "ok",
            "message" => "Imagen guardada correctamente como Blob",
            "ruta" => $ruta
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error al mover el archivo. Verifica permisos de carpeta."
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No se recibió el archivo 'foto' en el servidor."
    ]);
}
?>