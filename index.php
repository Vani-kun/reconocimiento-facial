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
    <link rel="stylesheet" href="css/horarios.css">
    <link rel="stylesheet" href="sigeastyle.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        // Seguridad: Bloqueo de retroceso
        history.pushState(null, null, location.href);
        window.onpopstate = function () { history.go(1); };
    </script>
</head>
<body>

<!--?php include 'php/extras/navbar.php'; ?-->
<?php include 'newBarra.php'; ?>
<?php include 'newCamara.php'; ?>
<div style="min-height:100vh">
    <main class="main-container" style="display:flex">
        <div style="min-height:80vh;width:40vw">
            <!--div class="wrapper-visor" style="width:100%;height:95%"> 
                <div class="anillo-escaneo"></div>
                <div class="visor-circular">
                    <p class="status-cam" id="estatus">ESPERANDO CÁMARA...</p>
                    <video id="video2" width="600" height="600" autoplay muted></video>
                    <canvas id="canva2"></canvas>
                </div>
            </div> 
        
            <div class="indicadores-estado">
                <div class="estado-item detectado" id="det"><span>●</span> Detectado</div>
                <div class="estado-item no-detectado active" id="nodet"><span>●</span> No Detectado</div>
            </div-->
        </div>
        <div style="background-color:#D1EAEC;border-radius:5vh;min-height:80vh;width:59vw;display:block;margin-left:1vw;">
            <div style="height:88%;width:100%;font-size:2.5vh;display:grid;grid-template-rows: 10% 10% 10% 10% 50% 10%;align-items: center;">
                <h1 id="detected-name">Esperando...</h1>
                <h2 id="detected-tags" style="color:#ADD8D5">Tags:</h2>
                <h3 id="detected-hour" style="color:#81BA4E"></h3>
                <h3 id="detected-state" style="color:#E41924"></h3>
                <div id="schedule-menu-scroll" class="schedule-menu-scroll" style="width:80%;height:100%;justify-self: center;grid-template-columns: 1fr;">



                </div>
                <br>
            </div>
            <div id="reloj">00:00:00</div>
            <div class="btnconte">
                <button id="btn" class="boton oculto">GUARDAR BIOMETRÍA</button>
            </div>

        </div>
    </main>

    </div>

    <audio id="detect" src="mp3/detect.mp3" preload="auto" hidden></audio>
    <audio id="nodetect" src="mp3/nodetect.mp3" preload="auto" hidden></audio>

    <script src="codigo.js"></script>

    <?php include 'php/extras/footer.php';?>


</body>
</html>