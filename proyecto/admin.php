<?php
    include "php/conexion.php";

    // 1. Consultamos todos los registros
    $sql = "SELECT id, nombre FROM caras";
    $stmt = $pdo->query($sql);
    $profesores = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.A.R.S. - Panel de Administración</title>
    <link rel="stylesheet" href="admin-style.css">
     <link rel="stylesheet" href="estiloMARS.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <img src="IUJO.gif" alt="Logo M.A.R.S." class="logo-img">
                <span class="logo-text" style="vertical-align: top;"></span>
            </a>

            <ul class="nav-menu">
                <li><a href="index.html#inicio" class="nav-link">Escaner</a></li>
                <li><a href="admin.php" class="nav-link">Profesores</li>
                <li><a href="index.html#pie" class="nav-link">Configuracion</a></li>
            </ul>
        </div>
    </nav>

    <main class="admin-container">
        <section class="panel list-panel">
            <div class="panel-header">
                <h2>Profesores Registrados</h2>
            </div>
<section class="control-panel">
    <div class="current-prof-display">
        <div class="status-indicator"></div>
        <div class="prof-meta">
            <span class="label">PROFESOR ACTUAL</span>
            <h2 id="current-prof-name">Ninguno seleccionado</h2>
            <small id="current-prof-id">ID: ---</small>
        </div>
    </div>

    <div class="search-box">
        <input type="text" id="search-input" placeholder="Buscar por nombre o ID...">
        <span class="search-icon">🔍</span>
    </div>

    <div class="action-buttons">
        <button class="btn-action btn-add">
            <span class="icon">+</span> Añadir Profesor
        </button>
        <button class="btn-action btn-edit">
            <span class="icon">✏️</span> Editar
        </button>
        <button class="btn-action btn-disable">
            <span class="icon">🔒</span> Desactivar
        </button>
    </div>
</section>

            <div class="scroll-area" id="professors-list">
                <?php foreach ($profesores as $prof) {
                $id = $prof['id'];
                $nombre = htmlspecialchars($prof['nombre']);
                echo'<div class="prof-card active">';
                echo'    <div class="prof-avatar">Y</div>';
                echo'    <div class="prof-info">';
                echo'        <strong>'.$nombre.'</strong>';
                echo'        <span>ID:'.$id.'</span>';
                echo'    </div>';
                echo'</div>';
                }?>
            </div>
        </section>

        <section class="panel horario-panel">
            <div class="panel-header">
                <h2>Horario de Clases</h2>
                <button class="btn-add">+ Asignar Materia</button>
            </div>
            <div class="schedule-grid">
                <div class="day-col">Lun</div>
                <div class="day-col">Mar</div>
                <div class="day-col">Mié</div>
                <div class="day-col">Jue</div>
                <div class="day-col">Vie</div>
                
                <div class="schedule-content" id="weekly-schedule">
                    <div class="class-item" style="grid-row: 2; grid-column: 1;">
                        <strong>Matemáticas</strong>
                        <span>08:00 - 09:30</span>
                        <small>Aula 102</small>
                    </div>
                </div>
            </div>
        </section>
<br>
        <section class="panel historial-panel">
            <div class="panel-header">
                <h2>Historial de Asistencias</h2>
            </div>
            <div class="scroll-area" id="attendance-log">
                <div class="log-item">
                    <div class="log-status ok"></div>
                    <div class="log-details">
                        <strong>Matemáticas - Secc 6A</strong>
                        <span>Entrada: 07:55 AM</span>
                        <span>Salida: 09:35 AM</span>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>