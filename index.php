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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Seguridad: Bloqueo de retroceso
        history.pushState(null, null, location.href);
        window.onpopstate = function () { history.go(1); };
    </script>
</heasd>
<body >
    <?php
    if($valorPausa==0){
    include 'newTooltips.php';
    include 'newBarra.php';
    include 'newCamara.php';
    include 'newProfesores.php';///nucleo de profesores
    include 'newAgregaEdita.php';
    include 'Secciones.php'; ///nucleo de hoprario y secciones
    include 'newAsistencia.php';
    include 'reloj.php';
    include 'newControl.php';///nucleo de control
    include 'horarios.php';///nucleo de hoprario y secciones
    include 'newRegistroAsis.php';////nucleo de registros
    include 'newMensaje.php';
    include 'chat.php';
    }else{
        include 'newBarra.php';
        include 'newCamara.php';
        include 'newProfesores.php';   
        echo '<script>moveCamera("ocultar");
        document.getElementById("infoini").textContent="Sistema en manntenimiento(PAUSADO)"</script>' ;  
    }
    ?>
    <audio id="detect" src="mp3/detect.mp3" preload="auto" hidden></audio>
    <audio id="nodetect" src="mp3/nodetect.mp3" preload="auto" hidden></audio>
    <script src="codigo.js"></script>

</body>
</html>