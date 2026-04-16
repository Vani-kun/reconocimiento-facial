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

    $sql = "SELECT id, asignatura, seccion, entrada, salida, aula FROM horario";
    $stmt = $pdo->query($sql);
    $AllSeccions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>M.A.R.S. - Asignación de Materias</title>
    <link rel="stylesheet" href="asignar-style.css">
    <link rel="stylesheet" href="estiloMARS.css">
</head>
<body>
    <?php include 'php/navbar.php';?>
    
    
<div style="position:absolute; left:-5px; margin-top:60px; width:45%; height:100%">
    <div class="itemsbcm divsection-master" style="margin-left:5px">
        <div class="divsection itemsbc divsection-selected" id="msectionbutton">
        Materias
        </div>

        <div class="divsection itemsbc" id="asectionbutton">
        Aulas
        </div>

        <div class="divsection itemsbc" id="ssectionbutton">
        Secciones
        </div>

        <div class="divsection itemsbc" id="hsectionbutton">
        Horarios
        </div>
    </div>
    <section class="items-bank" style="height:70%;max-height:70%">    
        <div style="padding: 2rem;">

            <div id="MateriaSection" style="display:grid">
                <div>
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
            </div>

            <div id="AulaSection" style="display:none;">
                <h3>Aulas Disponibles</h3>
                <p><small>Arrastra un aula al panel derecho</small></p>
                <div id="aulas-items-bank" class="scroll-area">
                <?php foreach ($aulas as $aula): ?>
                    <div class="draggable-item item-aula" draggable="true" data-aula="<?= htmlspecialchars($aula['numero']) ?>">
                        Aula <?= htmlspecialchars($aula['numero']) ?>
                    </div>
                <?php endforeach; ?>
                </div>

                <div style="height: 10%; display: flex; align-items: center; justify-content: center;">
                    <button id="open-menu-aula" class="btn btn-add" style="bottom:0;">Agregar Aula</button>
                </div>
            </div>

            <div id="HorarioSection" style="display:none;">
                <h3>Horarios Disponibles</h3>
                <p><small>Arrastra un horario al panel derecho</small></p>

                <div id="horarios-items-bank" class="scroll-area">
                <?php foreach ($horas as $hora): ?>
                    <div class="draggable-item item-horario" draggable="true" data-entrada="<?= htmlspecialchars($hora['entrada']) ?>" data-salida="<?= htmlspecialchars($hora['salida']) ?>">
                        <?= htmlspecialchars($hora['entrada']) ?> - <?= htmlspecialchars($hora['salida']) ?>
                    </div>
                <?php endforeach; ?>
                </div>

                <div style="height: 10%; display: flex; align-items: center; justify-content: center;">
                    <button id="open-menu-horario" class="btn btn-add" style="bottom:0;">Agregar Horario</button>
                </div>
            </div>

            <div id="SeccionSection" style="display:none;">
                <h3>Secciones Disponibles</h3>
                <p><small>Arrastra una sección al panel derecho</small></p>
                <div id="secciones-items-bank" class="scroll-area">
                    <?php foreach ($secciones as $seccion): ?>
                        <div class="draggable-item item-seccion" draggable="true" data-seccion="<?= htmlspecialchars($seccion['numero']) ?>">
                        Sección <?= htmlspecialchars($seccion['numero']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="height: 10%; display: flex; align-items: center; justify-content: center;">
                    <button id="open-menu-seccion" class="btn btn-add" style="bottom:0;">Agregar Sección</button>
                </div>
            </div>
                

        </div>
    </section>
</div>

<div class="recicle-bin"></div>

<div style="position:absolute; left:55%; margin-top:60px; width:45%; height:100%">
    <div class="divsection-master">
        <div id="EditSectionBtn" class="divsection divsection-selected" style="border-left: 5px solid #00e1ff;">
        Edición
        </div>

        <div id="BankSectionBtn" class="divsection">
        Banco
        </div>
    </div>
    <section id="drop-target" class="drop-zone" style="height:70%;max-height:70%">        
        <div style="padding: 2rem;">
            <div id="SectionConfig">
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
                    <button type="button" id="btn-clean" class="btn btn-edit">Vaciar</button>
                </div>
            </form>
            </div>
            <div id="SectionBank" style="display:none">
                <h3>Secciones Creadas</h3>
                <div id="mold-items-bank" class="scroll-area">
                    <?php foreach ($AllSeccions as $mySec): ?>
                        <div class="item-seccion draggable-item previtem" materia="<?= htmlspecialchars($mySec['asignatura']) ?>" aula="<?= htmlspecialchars($mySec['aula']) ?>" horarioe="<?= htmlspecialchars($mySec['entrada']) ?>" horarios="<?= htmlspecialchars($mySec['salida']) ?>" seccion="<?= htmlspecialchars($mySec['seccion']) ?>" myid="<?= htmlspecialchars($mySec['id']) ?>">
                        <?= htmlspecialchars($mySec['asignatura']) ?> <?= htmlspecialchars($mySec['seccion']) ?> <?= htmlspecialchars($mySec['aula']) ?> <?= htmlspecialchars($mySec['entrada']) ?> - <?= htmlspecialchars($mySec['salida']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="height: 10%; display: flex; align-items: center; justify-content: center;">
                    <button id="editmbtn" class="btn btn-add" style="bottom:0;width:50%">Editar</button>
                    <button id="erasembtn" class="btn btn-add" style="bottom:0;width:50%">Eliminar</button>
                </div>
            </div>
        </div>
    </section>
</div>



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
        const prevItems = document.querySelectorAll(".previtem");
        ItemSelected = -1;                

        prevItems.forEach(element => {
           
            element.addEventListener("click", () => {
            
                prevItems.forEach(element => {
                element.classList.remove("previtemselected");
                });     
                if(!element.classList.contains("previtemselected")){
                    ItemSelected = element;
                    element.classList.add("previtemselected");   
                    }else{
                    ItemSelected = -1; 
                    element.classList.remove("previtemselected");    
                    }
                });           

            });                

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
            if(!document.getElementById("EditSectionBtn").classList.contains("divsection-selected")){
                return;
                }
            dropTarget.classList.add('hover');  
            });

        dropTarget.addEventListener('dragleave', () => {
            dropTarget.classList.remove('hover');
            });

        dropTarget.addEventListener('drop', e => {
            e.preventDefault();
            if(!document.getElementById("EditSectionBtn").classList.contains("divsection-selected")){
                return;
                }


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

        document.getElementById("form-asignacion").addEventListener("submit", async (e) => {
            e.preventDefault();
            const form = document.getElementById("form-asignacion");
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());
            
            if(ItemSelected === -1){
                console.log("XDXD");
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
                        const NewItem = document.createElement("div");

                        NewItem.setAttribute("materia", resultado.materia);
                        NewItem.setAttribute("aula", resultado.aula);
                        NewItem.setAttribute("horarioe", resultado.h_entrada);
                        NewItem.setAttribute("horarios", resultado.h_salida);
                        NewItem.setAttribute("seccion", resultado.seccion);
                        NewItem.setAttribute("myid", resultado.id);

                        NewItem.classList.add("item-seccion","draggable-item","previtem");

                        NewItem.textContent = data.materia + " " + data.seccion + " " + data.aula + " " + data.h_entrada + " - " +data.h_salida;

                        document.getElementById("mold-items-bank").appendChild(NewItem);

                    } else {
                        console.error("respuesta: " + resultado.error);
                        alert("Error al guardar el horario.");
                    }
                } catch (error) {
                    console.error("Error al enviar: ", error);
                    alert("Error de conexión al guardar el horario.");
                }
            }else{
                        data.id = ItemSelected.getAttribute("myid");
               try {
                    const respuesta = await fetch('php/edit_horario.php', {
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
                        SectionBtn[1][0].classList.add("divsection-selected"); 
                        SectionBtn[1][1].style   = "";
                
                        SectionBtn[0][0].classList.remove("divsection-selected"); 
                        SectionBtn[0][1].style   = "display:none;"; 

                        ItemSelected.setAttribute("materia", data.materia);
                        ItemSelected.setAttribute("aula", data.aula);
                        ItemSelected.setAttribute("horarioe", data.h_entrada);
                        ItemSelected.setAttribute("horarios", data.h_salida);
                        ItemSelected.setAttribute("seccion", data.seccion);

                        ItemSelected.textContent = data.materia + " " + data.seccion + " " + data.aula + " " + data.h_entrada + " - " +data.h_salida;
                        

                    } else {
                        console.error("respuesta: " + resultado.error);
                        alert("Error al guardar el horario.");
                    }
                } catch (error) {
                    console.error("Error al enviar: ", error);
                    alert("Error de conexión al guardar el horario.");
                } 
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
        


        ItemBankBtn = [];
        ItemBankBtn[0] = [];
        ItemBankBtn[1] = [];              
        ItemBankBtn[2] = [];
        ItemBankBtn[3] = [];

        ItemBankBtn[0][0]  = document.getElementById("msectionbutton");                   
        ItemBankBtn[1][0]  = document.getElementById("asectionbutton");
        ItemBankBtn[2][0]  = document.getElementById("ssectionbutton");
        ItemBankBtn[3][0]  = document.getElementById("hsectionbutton");

        ItemBankBtn[0][1]  = document.getElementById("MateriaSection");
        ItemBankBtn[1][1]  = document.getElementById("AulaSection");
        ItemBankBtn[2][1]  = document.getElementById("SeccionSection");
        ItemBankBtn[3][1]  = document.getElementById("HorarioSection");

        SectionBtn = [];
        SectionBtn[0] = [];
        SectionBtn[1] = [];

        SectionBtn[0][0]  = document.getElementById("EditSectionBtn"); 
        SectionBtn[1][0]  = document.getElementById("BankSectionBtn"); 

        SectionBtn[0][1]  = document.getElementById("SectionConfig"); 
        SectionBtn[1][1]  = document.getElementById("SectionBank"); 

                        console.log(SectionBtn[0][0]);
                        console.log(SectionBtn[1][0]);
           

        function SwitchItemBankSection(Array, Number){
        
        if(Array[Number][0].classList.contains("divsection-selected")){return;}

            for (let index = 0; index < Array.length; index++) {
                
                if(index === Number){
                Array[index][0].classList.add("divsection-selected"); 
                Array[index][1].style   = "";
                }else{
                Array[index][0].classList.remove("divsection-selected"); 
                Array[index][1].style   = "display:none;"; 
                }
            }
        }

        ItemBankBtn[0][0].addEventListener("click", () => SwitchItemBankSection(ItemBankBtn, 0));
        ItemBankBtn[1][0].addEventListener("click", () => SwitchItemBankSection(ItemBankBtn, 1));
        ItemBankBtn[2][0].addEventListener("click", () => SwitchItemBankSection(ItemBankBtn, 2));
        ItemBankBtn[3][0].addEventListener("click", () => SwitchItemBankSection(ItemBankBtn, 3));

        SectionBtn[0][0].addEventListener("click", () => {

                if(!SectionBtn[0][0].classList.contains("divsection-selected")){
                    ItemSelected = -1;
                    prevItems.forEach(element => {
                        element.classList.remove("previtemselected");
                        });   
                    }

            SwitchItemBankSection(SectionBtn, 0)
            });
        SectionBtn[1][0].addEventListener("click", () => SwitchItemBankSection(SectionBtn, 1));

        const EraseMateriaBtn = document.getElementById("erasembtn");
        const EditMateriaBtn = document.getElementById("editmbtn");

        EditMateriaBtn.addEventListener("click", () => {

            if(ItemSelected != -1){

                
                SectionBtn[0][0].classList.add("divsection-selected"); 
                SectionBtn[0][1].style   = "";
                
                SectionBtn[1][0].classList.remove("divsection-selected"); 
                SectionBtn[1][1].style   = "display:none;"; 

                materiaInput.value  = ItemSelected.getAttribute("materia");
                aulaInput.value     = ItemSelected.getAttribute("aula");
                horarioEInput.value = ItemSelected.getAttribute("horarioe");
                horarioSInput.value = ItemSelected.getAttribute("horarios");
                seccionInput.value  = ItemSelected.getAttribute("seccion");
                }

            });

            document.getElementById("btn-clean").addEventListener("click", (e) => {
                e.preventDefault();
                document.getElementById("form-asignacion").reset();   
                });
                  
            document.getElementById("erasembtn").addEventListener("click", async (e) => {
                if(ItemSelected === -1){return}

                const MYID = ItemSelected.getAttribute("myid");

                try {
                const respuesta = await fetch('php/eliminar_horario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({id: MYID})
                });

                const resultado = await respuesta.json(); 
                    if (resultado.success) {
                        
                        ItemSelected.remove();

                        ItemSelected = -1; 
                        } else {
                        console.error("respuesta: " + resultado.error);
                        }
                    } catch (error) {
                    console.error("Error al enviar: ", error);
                    }

                
            

                });
    </script>
    
</body>
</html>