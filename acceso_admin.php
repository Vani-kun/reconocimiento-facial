<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.A.R.S. - Seguridad Administrador</title>
    <link rel="stylesheet" href="estilo_login.css">
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
            <h2 class="welcome-text">Seguridad</h2>
            <p class="instruction-text">
                Ingrese sus credenciales para acceder al Panel Administrativo.
            </p>

            <?php if(isset($_GET['error'])): ?>
                <span class="error-msg">Credenciales incorrectas</span>
            <?php endif; ?>
            
            <form action="auth.php" method="POST">
                <div class="input-group">
                    <label style="font-size: 0.75rem; color: var(--texto-secundario); margin-left: 5px; font-weight: bold; text-transform: uppercase;">Usuario</label>
                    <input type="text" name="usuario" placeholder="Ej: admin_mars" required autofocus>
                </div>

                <div class="input-group">
                    <label style="font-size: 0.75rem; color: var(--texto-secundario); margin-left: 5px; font-weight: bold; text-transform: uppercase;">Contraseña</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn-mars btn-azul" style="margin-top: 10px;">
                    ACCEDER AL SISTEMA
                </button>
            </form>

            <a href="login.php" class="back-link">← Volver al menú de inicio</a>
        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> M.A.R.S. - Sistema de Monitoreo Analítico.
    </footer>

</body>
</html>