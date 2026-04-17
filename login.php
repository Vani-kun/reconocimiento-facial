<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIVElula Portal de Acceso</title>
    <link rel="stylesheet" href="estilo_login.css">
    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function () { history.go(1); };
    </script>
</head>
<body>

    <div class="header-logo">
        <img src="IUJO.gif" alt="Logo IUJO">
    </div>

    <div class="header-info">
        <a href="equipo.html" class="btn-info">Acerca de</a>
    </div>

    <main class="main-content">
        <div class="mars-card">
            <h1 class="welcome-text">Bienvenido</h1>
            <p class="instruction-text">
                Gestión Operativa de Asistencia.<br>
                <strong>Por favor, seleccione el módulo de acceso para continuar:</strong>
            </p>

            <div class="menu-options">
                <a href="index.php" class="btn-mars btn-verde">
                    REGISTRO DE ASISTENCIA
                </a>
                
                <a href="acceso_admin.php" class="btn-mars btn-azul">
                    MODO ADMINISTRADOR
                </a>
            </div>
        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> M.A.R.S. - Monitoring and Analytical Recognition System. 
        <br>Todos los derechos reservados.
    </footer>

</body>
</html>