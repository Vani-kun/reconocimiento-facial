<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>M.A.R.S. - Asignación de Materias</title>
    <link rel="stylesheet" href="asignar-style.css">
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
    <div class="drag-container">
        <section class="items-bank">
            <h3>Materias Disponibles</h3>
            <p><small>Arrastra una materia al panel derecho</small></p>
            <div class="draggable-item" draggable="true" data-materia="Matemáticas">Matemáticas</div>
            <div class="draggable-item" draggable="true" data-materia="Física">Física</div>
            <div class="draggable-item" draggable="true" data-materia="Programación">Programación</div>
            <div class="draggable-item" draggable="true" data-materia="Arte">Arte</div>
        </section>

        <section class="drop-zone" id="drop-target">
            <h3>Configuración de Asignación</h3>
            <form id="form-asignacion" action="php/guardar_horario.php" method="POST">
                <div class="input-group">
                    <label>Materia Seleccionada:</label>
                    <input type="text" id="materia-input" name="materia" readonly placeholder="Arrastra aquí...">
                </div>

                <div class="grid-form">
                    <div class="input-group">
                        <label>Aula:</label>
                        <input type="text" name="aula" placeholder="Ej: Aula 102" required>
                    </div>
                    <div class="input-group">
                        <label>Sección:</label>
                        <input type="text" name="seccion" placeholder="Ej: 6to A" required>
                    </div>
                    <div class="input-group">
                        <label>Hora Entrada:</label>
                        <input type="time" name="h_entrada" required>
                    </div>
                    <div class="input-group">
                        <label>Hora Salida:</label>
                        <input type="time" name="h_salida" required>
                    </div>
                </div>

                <div class="actions-bar">
                    <button type="submit" class="btn btn-save">Guardar</button>
                    <button type="button" class="btn btn-edit">Editar</button>
                    <button type="button" class="btn btn-delete">Eliminar</button>
                </div>
            </form>
        </section>
    </div>

    <script>
        const draggables = document.querySelectorAll('.draggable-item');
        const dropTarget = document.getElementById('drop-target');
        const materiaInput = document.getElementById('materia-input');

        draggables.forEach(item => {
            item.addEventListener('dragstart', () => {
                item.classList.add('dragging');
            });
            item.addEventListener('dragend', () => {
                item.classList.remove('dragging');
            });
        });

        dropTarget.addEventListener('dragover', e => {
            e.preventDefault();
            dropTarget.classList.add('hover');
        });

        dropTarget.addEventListener('dragleave', () => {
            dropTarget.classList.remove('hover');
        });

        dropTarget.addEventListener('drop', e => {
            e.preventDefault();
            const draggingItem = document.querySelector('.dragging');
            materiaInput.value = draggingItem.getAttribute('data-materia');
            dropTarget.classList.remove('hover');
        });
    </script>
</body>
</html>