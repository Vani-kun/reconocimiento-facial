<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/face-api.min.js"></script>
    <link rel="stylesheet" href="indexstyle.css">
    <link rel="stylesheet" href="estiloMARS.css">
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>

    <?php include 'php/navbar.php';?>

    <div class="panel-captura">
        <div class="wrapper-visor"> 
            
            <div class="anillo-escaneo"></div>
            
            <div class="visor-circular">
                <p class="status-cam" id="estatus">ESPERANDO CÁMARA...</p>
                <video id="video" width="600" height="600" autoplay muted></video>
                <canvas id="canva"></canvas>
            </div>

        </div> 
        
        <div class="indicadores-estado">
            <div class="estado-item detectado" id="det">● Detectado</div>
            <div class="estado-item no-detectado active" id="nodet">● No Detectado</div>
        </div>
        <div id="reloj">00:00:00</div>

        <div class="btnconte" style="display: none;">
            <button id="btn" class="boton">GUARDAR BIOMETRÍA</button>
        </div>
    </div>

    <script src="codigo.js"></script>

    <footer class="footer">
        <p>&copy; 2026 Proyecto Livelula | Instituto Universitario IUJO</p>
    </footer>
</body>
</html>