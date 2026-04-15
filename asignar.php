<?php
    include "php/conexion.php";

    $sql = "SELECT nombre FROM materias";
    $stmt = $pdo->query($sql);
    $materias = $stmt->fetchAll();

    $sql = "SELECT entrada, salida FROM horas";
    $stmt = $pdo->query($sql);
    $horas = $stmt->fetchAll();

    $sql = "SELECT numero FROM aulas";
    $stmt = $pdo->query($sql);
    $aulas = $stmt->fetchAll();

    $sql = "SELECT numero FROM secciones";
    $stmt = $pdo->query($sql);
    $secciones = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>M.A.R.S. - Asignación de Materias</title>
    <link rel="stylesheet" href="asignar-style.css">
    <link rel="stylesheet" href="estiloMARS.css">

    <style>
        .oculto {
            display: none !important;
            pointer-events: none;
        }

        .btn-add{

            background-color: #28a745;
            color: white;
            border: none;
            margin: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.8);
            height: 10px;
            font-size: 15px;

        }

        .btn{

        text-align: center;

        }

    .scroll-area {
    margin-top: 20px;
    flex: 1; /* Esto le dice que use el espacio disponible */
    
    /* LIMITAR ALTURA */
    height: 300px; /* O usa una medida relativa como 50vh */
    max-height: 500px; 
    
    /* ACTIVAR SCROLL */
    overflow-y: auto; /* Solo sale el scroll si el contenido supera la altura */
    overflow-x: hidden; /* Evita scroll horizontal molesto */
    
    padding: 10px;
    border-top: 5px solid #0095ff;

    font-size: 15px;
    }

.list-panel{
    width: 35%;
    float: left;
    height: 80vh;
}

.panel {
    background: var(--panel-bg);
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    overflow: hidden;

    background: var(--panel);
    padding: 2rem;
    border-radius: 5px;
    border-left: 5px solid #00e1ff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    height: 12.5%;
}

.container{
    width: 100%;
    
}

.menudiv{

    height: 10%;

}
.draggable-item, .btn-add { /* Usa tus clases reales */
    display: flex;
    align-items: center;     /* Centrado vertical */
    justify-content: center;  /* Centrado horizontal */
    text-align: center;
    padding: 5px 10px;       /* Ajusta el padding en lugar del height */
    height: auto;            /* Deja que el padding defina el tamaño */
    min-height: 30px;        /* O el tamaño mínimo que desees */
}

    </style>
</head>
<body>
    <?php include 'php/navbar.php';?>
    
    

    <div style="display:flex;">

<div style="width:25%;display:grid;" >
    <div class="Materias-div container menudiv">
        <div class="drag-container">
        <section class="items-bank">
            <div style="height: 90%;">
            <h3>Materias Disponibles</h3>
            <p><small>Arrastra una materia al panel derecho</small></p>

            <div id="materias-items-bank" class="scroll-area">
            <?php foreach ($materias as $materia): ?>
                <div class="draggable-item item-materia" draggable="true" data-materia="<?= htmlspecialchars($materia['nombre']) ?>">
                    <?= htmlspecialchars($materia['nombre']) ?>
                </div>
            <?php endforeach; ?>
            </div> 

            </div>

            <div style="height: 10%; display: flex; align-items: center; justify-content: center;">
            <button id="open-menu-materia" class="btn btn-add" style="bottom:0;">Agregar Materia</button>
            </div>
        </section> 
        </div>
    </div>
    
    <div class="Horarios-div container menudiv">
        <div class="drag-container">
            <section class="items-bank">
            <div style="height: 90%;">
            <h3>Horarios Disponibles</h3>
            <p><small>Arrastra un horario al panel derecho</small></p>

            <div id="horarios-items-bank" class="scroll-area">
            <?php foreach ($horas as $hora): ?>
                <div class="draggable-item item-horario" draggable="true" data-entrada="<?= htmlspecialchars($hora['entrada']) ?>" data-salida="<?= htmlspecialchars($hora['salida']) ?>">
                    <?= htmlspecialchars($hora['entrada']) ?> - <?= htmlspecialchars($hora['salida']) ?>
                </div>
            <?php endforeach; ?>
            </div>

            </div>
            <div style="height: 10%; display: flex; align-items: center; justify-content: center;">
            <button id="open-menu-horario" class="btn btn-add" style="bottom:0;">Agregar Horario</button>
            </div>
        </section>
        </div>
    </div>            
</div>
<div style="width:25%;display:grid;" >
    <div class="Aulas-div container menudiv">
        <div class="drag-container">
            <section class="items-bank">
            <div style="height: 90%;">
            <h3>Aulas Disponibles</h3>
            <p><small>Arrastra un aula al panel derecho</small></p>
            <div id="aulas-items-bank" class="scroll-area">
            <?php foreach ($aulas as $aula): ?>
                <div class="draggable-item item-aula" draggable="true" data-aula="<?= htmlspecialchars($aula['numero']) ?>">
                    Aula <?= htmlspecialchars($aula['numero']) ?>
                </div>
            <?php endforeach; ?>
            </div>
            </div>
            <div style="height: 10%; display: flex; align-items: center; justify-content: center;">
            <button id="open-menu-aula" class="btn btn-add" style="bottom:0;">Agregar Aula</button>
            </div>
        </section>
        </div>
    </div>        

    <div class="Seccion-div container menudiv">
        <div class="drag-container">
            <section class="items-bank">
            <div style="height: 90%;">
            <h3>Secciones Disponibles</h3>
            <p><small>Arrastra una sección al panel derecho</small></p>
            <div id="secciones-items-bank" class="scroll-area">
            <?php foreach ($secciones as $seccion): ?>
                <div class="draggable-item item-seccion" draggable="true" data-seccion="<?= htmlspecialchars($seccion['numero']) ?>">
                    Sección <?= htmlspecialchars($seccion['numero']) ?>
                </div>
            <?php endforeach; ?>
            </div>
            </div>
            <div style="height: 10%; display: flex; align-items: center; justify-content: center;">
            <button id="open-menu-seccion" class="btn btn-add" style="bottom:0;">Agregar Sección</button>
            </div>
        </section>
        </div>
    </div>   
</div>  

        <section class="drop-zone" id="drop-target" style="position:sticky; left:50%; top:100px; width:50%; height:100%">
            <div style="position:sticky;width:50%;right:0;top:25%;">
            <h3>Configuración de Asignación</h3>
            <form id="form-asignacion" method="POST">
                <div class="input-group">
                    <label>Materia Seleccionada:</label>
                    <input type="text" id="materia-input" name="materia" readonly placeholder="Arrastra aquí...">
                </div>

                <div class="grid-form">
                    <div class="input-group">
                        <label>Aula:</label>
                        <input id="aula-input" type="text" name="aula" placeholder="Ej: Aula 102" required>
                    </div>
                    <div class="input-group">
                        <label>Sección:</label>
                        <input id="seccion-input" type="text" name="seccion" placeholder="Ej: 6to A" required>
                    </div>
                    <div class="input-group">
                        <label>Hora Entrada:</label>
                        <input id="hora-entrada" type="time" name="h_entrada" required>
                    </div>
                    <div class="input-group">
                        <label>Hora Salida:</label>
                        <input id="hora-salida" type="time" name="h_salida" required>
                    </div>
                </div>

                <div class="actions-bar">
                    <button type="submit" id="btn-save" class="btn btn-save">Guardar</button>
                    <button type="button" class="btn btn-edit">Editar</button>
                    <button type="button" class="btn btn-delete">Eliminar</button>
                </div>
            </form>
        </div>
        </section>

        <div id="MateriaMenu" class="oculto" style="position: fixed; display: flex; justify-content: center; margin-top: 20px; left:0; top:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index: 100; align-items: center;">
                <section style="background-color: white; padding: 20px; border-radius: 8px; width: 300px;">
                    <div>
                        <label for="MateriaName">Nombre:</label>
                        <input type="text" id="MateriaName" name="name" placeholder="Ingrese el nombre de la materia">

                        <button type="button" id="add-materia">Agregar</button>
                        <button type="button" id="cancel-materia">Cancelar</button>
                    </div>
                </section>
        </div>

        <div id="HorarioMenu" class="oculto" style="position: fixed; display: flex; justify-content: center; margin-top: 20px; left:0; top:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index: 100; align-items: center;">
                <section style="background-color: white; padding: 20px; border-radius: 8px; width: 300px;">
                    <div>
                        <label for="HorarioE">Hora de Entrada:</label>
                        <input type="time" id="HorarioE" name="entrada" placeholder="Ingrese la hora de entrada">

                        <label for="HorarioS">Hora de Salida:</label>
                        <input type="time" id="HorarioS" name="salida" placeholder="Ingrese la hora de salida">

                        <button type="button" id="add-horario">Agregar</button>
                        <button type="button" id="cancel-horario">Cancelar</button>
                    </div>
                </section>
        </div>

        <div id="AulaMenu" class="oculto" style="position: fixed; display: flex; justify-content: center; margin-top: 20px; left:0; top:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index: 100; align-items: center;">
                <section style="background-color: white; padding: 20px; border-radius: 8px; width: 300px;">
                    <div>
                        <label for="AulaNumber">Numero del Aula:</label>
                        <input type="text" id="AulaNumber" name="numero" placeholder="Ingrese el numero de la aula">

                        <button type="button" id="add-aula">Agregar</button>
                        <button type="button" id="cancel-aula">Cancelar</button>
                    </div>
                </section>
        </div>

        <div id="SeccionMenu" class="oculto" style="position: fixed; display: flex; justify-content: center; margin-top: 20px; left:0; top:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index: 100; align-items: center;">
                <section style="background-color: white; padding: 20px; border-radius: 8px; width: 300px;">
                    <div>
                        <label for="SeccionNumber">Numero de la sección:</label>
                        <input type="text" id="SeccionNumber" name="numero" placeholder="Ingrese el numero de la sección">

                        <button type="button" id="add-seccion">Agregar</button>
                        <button type="button" id="cancel-seccion">Cancelar</button>
                    </div>
                </section>
        </div>
</div>
    <script>
        const draggables = document.querySelectorAll('.draggable-item');
        const dropTarget = document.getElementById('drop-target');
                const materiaInput = document.getElementById('materia-input');
                const aulaInput = document.getElementById('aula-input');
                const horarioEInput = document.getElementById('hora-entrada');
                const horarioSInput = document.getElementById('hora-salida');
                const seccionInput = document.getElementById('seccion-input');

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

            if(draggingItem.classList.contains('item-materia')){
            const draggingItem = document.querySelector('.dragging');
            materiaInput.value = draggingItem.getAttribute('data-materia');
            }else if(draggingItem.classList.contains('item-horario')){
                const draggingItem = document.querySelector('.dragging');
                horarioEInput.value = draggingItem.getAttribute('data-entrada');
                horarioSInput.value = draggingItem.getAttribute('data-salida');
            }else if(draggingItem.classList.contains('item-aula')){
                const draggingItem = document.querySelector('.dragging');
                aulaInput.value = draggingItem.getAttribute('data-aula');
            }else if(draggingItem.classList.contains('item-seccion')){
                const draggingItem = document.querySelector('.dragging');
                seccionInput.value = draggingItem.getAttribute('data-seccion');
            }
            
            dropTarget.classList.remove('hover');
        });

        document.getElementById("btn-save").addEventListener("click", async (e) => {
            e.preventDefault();
            const form = document.getElementById("form-asignacion");
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());
            
            console.log(data);

            try {
                const respuesta = await fetch('php/guardar_horario.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                

                const resultado = await respuesta.json(); 
                if (resultado.success) {
                    console.log("respuesta: "+ resultado.message);
                    alert("Horario guardado exitosamente.");
                    form.reset();
                } else {
                    console.error("respuesta: " + resultado.error);
                    alert("Error al guardar el horario.");
                }
            } catch (error) {
                console.error("Error al enviar: ", error);
                alert("Error de conexión al guardar el horario.");
            }
        });

        //#region Agregar Materia
        document.getElementById('open-menu-materia').addEventListener('click', () => {
            const menu = document.getElementById('MateriaMenu');
            menu.classList.toggle('oculto');
            document.getElementById('MateriaName').value = '';
            });

        document.getElementById('cancel-materia').addEventListener('click', () => {
            document.getElementById('MateriaMenu').classList.add('oculto');
            });

        document.getElementById('add-materia').addEventListener('click', async () => {
            const nombre = document.getElementById('MateriaName').value.trim();
            if (nombre) {

            try {
                const respuesta = await fetch('php/guardarmateria.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({nombre: nombre})
                });

                const resultado = await respuesta.json(); 
                if (resultado.success) {
  
                console.log("respuesta: "+ resultado.message);

                const newItem = document.createElement('div');
                newItem.classList.add('draggable-item', 'item-materia');
                newItem.setAttribute('draggable', 'true');
                newItem.setAttribute('data-materia', nombre);
                newItem.textContent = nombre;
                document.getElementById('materias-items-bank').appendChild(newItem);

                // Agregar eventos de arrastre al nuevo elemento
                newItem.addEventListener('dragstart', () => {
                    newItem.classList.add('dragging');
                });
                newItem.addEventListener('dragend', () => {
                    newItem.classList.remove('dragging');
                });

                document.getElementById('MateriaMenu').classList.add('oculto');
                } else {
                console.error("respuesta: " + resultado.error);
                }
            } catch (error) {
            console.error("Error al enviar: ", error);
            }

                
            }
        });
        //#endregion

        //#region Agregar Horario
        document.getElementById('open-menu-horario').addEventListener('click', () => {
            const menu = document.getElementById('HorarioMenu');
            menu.classList.toggle('oculto');
            document.getElementById('HorarioE').value = '';
            document.getElementById('HorarioS').value = '';
            });

        document.getElementById('cancel-horario').addEventListener('click', () => {
            document.getElementById('HorarioMenu').classList.add('oculto');
            });

        document.getElementById('add-horario').addEventListener('click', async () => {
            const he = document.getElementById('HorarioE').value.trim();
            const hs = document.getElementById('HorarioS').value.trim();
            if (he && hs) {

            try {
                const respuesta = await fetch('php/guardarhora.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({entrada: he, salida: hs})
                });

                const resultado = await respuesta.json(); 
                if (resultado.success) {
  
                console.log("respuesta: "+ resultado.message);

                const newItem = document.createElement('div');
                newItem.classList.add('draggable-item', 'item-horario');
                newItem.setAttribute('draggable', 'true');
                newItem.setAttribute('data-entrada', he);
                newItem.setAttribute('data-salida', hs);
                newItem.textContent = `${he} - ${hs}`;
                document.getElementById('horarios-items-bank').appendChild(newItem);

                // Agregar eventos de arrastre al nuevo elemento
                newItem.addEventListener('dragstart', () => {
                    newItem.classList.add('dragging');
                });
                newItem.addEventListener('dragend', () => {
                    newItem.classList.remove('dragging');
                });

                document.getElementById('HorarioMenu').classList.add('oculto');
                } else {
                console.error("respuesta: " + resultado.error);
                }
            } catch (error) {
            console.error("Error al enviar: ", error);
            }

                
            }
        });
        //#endregion

        //#region Agregar Aula
        document.getElementById('open-menu-aula').addEventListener('click', () => {
            const menu = document.getElementById('AulaMenu');
            menu.classList.toggle('oculto');
            document.getElementById('AulaNumber').value = '';
            });

        document.getElementById('cancel-aula').addEventListener('click', () => {
            document.getElementById('AulaMenu').classList.add('oculto');
            });

        document.getElementById('add-aula').addEventListener('click', async () => {
            const aula = document.getElementById('AulaNumber').value.trim();
            if (aula) {

            try {
                const respuesta = await fetch('php/guardaraula.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({numero: aula})
                });

                const resultado = await respuesta.json(); 
                if (resultado.success) {
  
                console.log("respuesta: "+ resultado.message);

                const newItem = document.createElement('div');
                newItem.classList.add('draggable-item', 'item-aula');
                newItem.setAttribute('draggable', 'true');
                newItem.setAttribute('data-aula', aula);
                newItem.textContent = `Aula ${aula}`;
                document.getElementById('aulas-items-bank').appendChild(newItem);

                // Agregar eventos de arrastre al nuevo elemento
                newItem.addEventListener('dragstart', () => {
                    newItem.classList.add('dragging');
                });
                newItem.addEventListener('dragend', () => {
                    newItem.classList.remove('dragging');
                });

                document.getElementById('AulaMenu').classList.add('oculto');
                } else {
                console.error("respuesta: " + resultado.error);
                }
            } catch (error) {
            console.error("Error al enviar: ", error);
            }

                
            }
        });
        //#endregion

        //#region Agregar Seccion
        document.getElementById('open-menu-seccion').addEventListener('click', () => {
            const menu = document.getElementById('SeccionMenu');
            menu.classList.toggle('oculto');
            document.getElementById('SeccionNumber').value = '';
            });

        document.getElementById('cancel-seccion').addEventListener('click', () => {
            document.getElementById('SeccionMenu').classList.add('oculto');
            });

        document.getElementById('add-seccion').addEventListener('click', async () => {
            const seccion = document.getElementById('SeccionNumber').value.trim();
            if (seccion) {

            try {
                const respuesta = await fetch('php/guardarseccion.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({numero: seccion})
                });

                const resultado = await respuesta.json(); 
                if (resultado.success) {
  
                console.log("respuesta: "+ resultado.message);

                const newItem = document.createElement('div');
                newItem.classList.add('draggable-item', 'item-seccion');
                newItem.setAttribute('draggable', 'true');
                newItem.setAttribute('data-seccion', seccion);
                newItem.textContent = `Seccion ${seccion}`;
                document.getElementById('secciones-items-bank').appendChild(newItem);

                // Agregar eventos de arrastre al nuevo elemento
                newItem.addEventListener('dragstart', () => {
                    newItem.classList.add('dragging');
                });
                newItem.addEventListener('dragend', () => {
                    newItem.classList.remove('dragging');
                });

                document.getElementById('SeccionMenu').classList.add('oculto');
                } else {
                console.error("respuesta: " + resultado.error);
                }
            } catch (error) {
            console.error("Error al enviar: ", error);
            }

                
            }
        });
        //#endregion
    </script>
</body>
</html>