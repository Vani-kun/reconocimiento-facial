<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIVElula | Nuestro Equipo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="nosotros.css">
    <link rel="stylesheet" href="equipo.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<?php include 'php/extras/navbar.php'; ?>

    <header class="hero-header">
        <div class="header-content">
           <img src="img/logo-livelula.png" alt="Logo Proyecto Livelula" class="hero-logo-livelula">
             <h1>Proyecto Livelula</h1>
            <p>Conoce a las personas que hacen posible este sistema de asistencia biométrico.</p>
        </div>
    </header>

    <main class="equipo-main">
        <div class="equipo-grid">
            
            <section class="equipo-card">
                <div class="equipo-card-header azul">
                    <img src="../img/user1.jpg" alt="Aaron">
                </div>
                <div class="equipo-card-body">
                    <h3>Aaron</h3>
                    <span class="equipo-role">Arquitectura & Backend</span>
                    <p>Especialista en JavaScript y PHP. Encargado de la estructura lógica del sistema y gestión de base de datos MySQL.</p>
                </div>
            </section>

            <section class="equipo-card">
                <div class="equipo-card-header verde">
                    <img src="../img/user2.jpg" alt="Yovani">
                </div>
                <div class="equipo-card-body">
                    <h3>Yovani</h3>
                    <span class="equipo-role">Visión Artificial</span>
                    <p>Especialista en Diseño y Datos. Responsable de integrar face-api.js para el reconocimiento facial en tiempo real.</p>
                </div>
            </section>

            <section class="equipo-card">
                <div class="equipo-card-header azul">
                    <img src="../img/user3.jpg" alt="Abrahan">
                </div>
                <div class="equipo-card-body">
                    <h3>Abrahan</h3>
                    <span class="equipo-role">Seguridad & UI/UX</span>
                    <p>Especialista en Estructura. Desarrollo de la experiencia de usuario y diseño visual de los paneles administrativos.</p>
                </div>
            </section>

            <section class="equipo-card">
                <div class="equipo-card-header verde">
                    <img src="../img/user4.jpg" alt="Anderson">
                </div>
                <div class="equipo-card-body">
                    <h3>Anderson</h3>
                    <span class="equipo-role">Administración de Datos</span>
                    <p>Especialista en PHP avanzado. Optimización de consultas SQL y mantenimiento de la integridad del servidor.</p>
                </div>
            </section>

            <section class="equipo-card">
                <div class="equipo-card-header azul">
                    <img src="../img/user5.jpg" alt="Raysmari">
                </div>
                <div class="equipo-card-body">
                    <h3>Raysmari</h3>
                    <span class="equipo-role">Documentación & QA</span>
                    <p>Especialista en HTML y Diseño. Encargada de pruebas de seguridad y redacción de manuales técnicos.</p>
                </div>
            </section>

        </div>
    </main>

<?php include 'php/extras/footer.php'; ?>

</body>
</html>