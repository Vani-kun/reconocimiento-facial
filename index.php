<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIVElula | Registro Biométrico</title>
    <script src="js/face-api.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/camara.css">
    <link rel="stylesheet" href="css/index.css">
    
    <script>
        // Seguridad: Bloqueo de retroceso
        history.pushState(null, null, location.href);
        window.onpopstate = function () { history.go(1); };
    </script>
</head>
<body>

    <?php include 'php/extras/navbar.php'; ?>

    <main class="panel-captura">
        <div class="wrapper-visor"> 
            <div class="anillo-escaneo"></div>
            <div class="visor-circular">
                <p class="status-cam" id="estatus">ESPERANDO CÁMARA...</p>
                <video id="video" width="600" height="600" autoplay muted></video>
                <canvas id="canva"></canvas>
            </div>
        </div> 
        
        <div class="indicadores-estado">
            <div class="estado-item detectado" id="det"><span>●</span> Detectado</div>
            <div class="estado-item no-detectado active" id="nodet"><span>●</span> No Detectado</div>
        </div>
        
        <div id="reloj">00:00:00</div>

        <div class="btnconte">
            <button id="btn" class="boton oculto">GUARDAR BIOMETRÍA</button>
        </div>
    </main>

    <div style="min-height:30vh"></div>

    <audio id="detect" src="mp3/detect.mp3" preload="auto" hidden></audio>
    <audio id="nodetect" src="mp3/nodetect.mp3" preload="auto" hidden></audio>

    <script src="codigo.js"></script>

    <?php include 'php/extras/footer.php';?>


</body>
</html>