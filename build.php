<?php
$pharFile = 'livelula.phar';

if (file_exists($pharFile)) unlink($pharFile);

try {
    $p = new Phar($pharFile);

    // Indicamos que empaquete la carpeta actual (__DIR__)
    // Pero usamos un filtro para excluir el propio build.php y el phar resultante
    $p->buildFromDirectory(__DIR__, '/\.php$/'); 

    // El archivo que arranca tu sistema (asegúrate que sea index.php)
    $p->setDefaultStub('index.php');

    echo "¡Archivo $pharFile creado con éxito en la raíz!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

///C:\xampp\php\php.ini
///phar.readonly = Off
//cd C:\xampp\htdocs\reconocimiento-facial-main
///php -d phar.readonly=0 build.php
///C:\xampp\php\php.exe -d phar.readonly=0 build.php
?>