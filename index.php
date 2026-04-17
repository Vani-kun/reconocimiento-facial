<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIVElula | Registro Biométrico</title>
    <script src="js/face-api.min.js"></script>
    <link rel="stylesheet" href="estiloMARS.css">
    <link rel="stylesheet" href="indexstyle.css">
    <link rel="stylesheet" href="admin-style.css">
    <link rel="stylesheet" href="css/navbar_style.css"> 
    
    <script>
        // Seguridad: Bloqueo de retroceso
        history.pushState(null, null, location.href);
        window.onpopstate = function () { history.go(1); };
    </script>
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo-container">
                <img src="IUJO.gif" alt="Logo IUJO" class="logo-img">
               
            </a>

            <ul class="nav-menu">
                <li><a href="equipo.html" class="nav-link">Acerca de</a></li>
                <li><a href="acceso_admin.php" class="nav-link admin-btn">Iniciar sesión</a></li>
            </ul>
        </div>
    </nav>

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
            <div class="estado-item detectado" id="det">● Detectado</div>
            <div class="estado-item no-detectado active" id="nodet">● No Detectado</div>
        </div>
        
        <div id="reloj">00:00:00</div>

        <div class="btnconte">
            <button id="btn" class="boton">GUARDAR BIOMETRÍA</button>
        </div>
    </main>

    <audio id="detect" src="mp3/detect.mp3" preload="auto" hidden></audio>
    <audio id="nodetect" src="mp3/nodetect.mp3" preload="auto" hidden></audio>

    <script src="codigo.js"></script>

    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> <strong>LIVElula</strong> | Instituto Universitario IUJO</p>
        <p>Todos los derechos reservados.</p>
    </footer>

</body>
</html>