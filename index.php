<?php
    include "php/conexion.php";

    $sqlConfig = "SELECT pausa FROM configuracion LIMIT 1";
    $stmtConfig = $pdo->query($sqlConfig);
    $config = $stmtConfig->fetch();
    
    // Si no existe la configuración, le damos un valor por defecto (ej. 0)
    $valorPausa = $config ? $config['pausa'] : 0;
    //echo $valorpausa;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIVElula | Registro Biométrico</title>
    <script src="js/face-api.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/horarios.css">
    <link rel="stylesheet" href="css/asignar-style.css">
    <!--link rel="stylesheet" href="css/camara.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="sigeastyle.css"-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        // Seguridad: Bloqueo de retroceso
        history.pushState(null, null, location.href);
        window.onpopstate = function () { history.go(1); };
    </script>
</heasd>
<body >


<?php include 'newBarra.php'; ?>

<?php include 'newCamara.php'; ?>
<?php include 'newProfesores.php'; ?>
<?php if($valorPausa==0):?>
<?php include 'Secciones.php'; ?>
<?php include 'newAsistencia.php';?>
<?php //include 'php/extras/footer.php';?>
<?php include 'reloj.php';?>
<?php include 'newControl.php';?>
<?php include 'horarios.php';?>

<?php else:?>
    <script>
        moveCamera('ocultar');
    </script>
<?php endif;?>
<?php include 'newRegistroAsis.php';?>
<?php include 'newMensaje.php';?>
<?php include 'ct.php';?>

    <audio id="detect" src="mp3/detect.mp3" preload="auto" hidden></audio>
    <audio id="nodetect" src="mp3/nodetect.mp3" preload="auto" hidden></audio>
    <script src="codigo.js"></script>

</body>
</html>