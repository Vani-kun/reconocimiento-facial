<?php
    include "php/conexion.php";

    // 1. Consultamos todos los registros
    $sql = "SELECT id, descriptores, nombre, activo, tags FROM caras ORDER BY activo DESC, nombre ASC";
    $stmt = $pdo->query($sql);
    $profesores = $stmt->fetchAll();
?>

    <style>
        :root {
            --accent-blue: #00f2ff;
            --bg-dark:#0f495e;
            --panel-bg: rgba(26, 32, 44, 0.95);
            --danger: #ff4d4d;
            --warning: #ffcc00;
        }


        body {
            background-color: var(--bg-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white;
            overflow: hidden;
            margin: 0;padding: 0;box-sizing: border-box;user-select: none; 
        }

        /* --- LAYOUT PRINCIPAL --- */
        .main-wrapper {
            display: flex;
            width: 100vw;
            height: 100vh;
            margin: 0;padding: 0;box-sizing: border-box;user-select: none; 
        }

        .panel-izquierdo {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            margin: 0;padding: 0;box-sizing: border-box;user-select: none; 
        }

        /* --- PANEL DERECHO DESLIZABLE --- */
        .panel-derecho {
            margin: 0;padding: 0;box-sizing: border-box;user-select: none; 
            width: 450px;
            height: 100%;
            background: linear-gradient(180deg, #d1eaec 0%, #7c898a 100%);
            border-left: 1px solid rgba(0, 242, 255, 0.1);
            padding: 25px;
            display: flex;
            flex-direction: column;
            backdrop-filter: blur(10px);
            z-index: 100;
            /* Transición de deslizamiento a la derecha */
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Estado oculto (deslizado a la derecha) */
        .panel-derecho.hidden {
            transform: translateX(100%);
            position: absolute;
            right: 0;
        }

     
        /* --- ELEMENTOS DEL PANEL --- */
        #toggle-panel {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: var(--panel-bg);
            border: 1px solid var(--accent-blue);
            color: var(--accent-blue);
            width: 45px;
            height: 45px;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.1);
        }

        .search-bar {
            width: 100%;
            padding: 10px;
            margin: 20px 0;
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(0, 242, 255, 0.3);
            color: white;
            border-radius: 5px;
        }

        .lista-profesores {
            flex-grow: 1;
            overflow-y: auto;
        }

        .profesor-card {
            background: rgba(255,255,255,0.05);
            color:black;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .avatar {
            width: 32px; height: 32px;
            background: var(--accent-blue);
            color: black;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-weight: bold;
        }

        .acciones { margin-left: auto; display: flex; gap: 5px; }

        .btn-action {
            border: none; padding: 5px 8px; border-radius: 4px; cursor: pointer; color: white;
        }

        .btn-edit { background: var(--accent-blue); color: black; }
        .btn-del { background: #7A1525 }
        .btn-off {
            background: #757575; /* Usando la variable que definimos antes */
            color: black;
            font-weight: bold;
        }

        .btn-off:hover {
            background: #1b1b1b; /* Un tono un poco más oscuro al pasar el mouse */
        }

        /* Para cuando un profesor ya esté desactivado, podrías añadir esta clase opcional */
        .profesor-desactivado {
            opacity: 0.5;
            filter: grayscale(1);
        }
.btn-agregar {
    /* Layout y Dimensiones */
    width: 100%;
    height: 6vh;
    min-height: 45px;
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    
    /* Estilo Tecnológico Suave */
    background-color: rgba(72, 77, 96, 0.8); /* Tu color base con transparencia */
    color: #D1EAEC;
    border: 1px solid rgba(0, 242, 255, 0.3); /* Borde neón sutil */
    border-radius: 12px; /* Redondeado suave, no exagerado */
    
    /* Tipografía */
    font-family: 'Segoe UI', system-ui, sans-serif;
    font-size: 1.8vh;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    
    /* Efectos y Transiciones */
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    outline: none;
}

/* Estado Hover (Al pasar el mouse) */
.btn-agregar:hover {
    background-color: #484D60;
    border-color: var(--accent-blue);
    box-shadow: 0 0 20px rgba(0, 242, 255, 0.4);
    transform: translateY(2px); /* Eleva un poco el botón */
}

/* Estado Active (Efecto de hundirse al presionar) */
.btn-agregar:active {
    transform: translateY(2px) scale(0.97); /* Se hunde y se encoge un poco */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5); /* La sombra se achica */
    background-color: #363a49; /* Se oscurece al tacto */
}

        .btn-agregar:hover { background: var(--accent-blue); color: black; }

        /* Scrollbar minimalista */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: var(--accent-blue); }

        .titulo{
            margin-top: 50px;
            color:#0F495E;
        }
        .ocultoboton{
            display:none;
        }
    </style>


    <div class="main-wrapper">
        <button id="toggle-panel" onclick="togglePanel()" class="ocultoboton">☰</button>

        <div class="panel-izquierdo">
            <h1>LIVELULA</h1>
            <p style="opacity: 0.5;">Sistema de Biometría Activo</p>
            <!-- Aquí iría tu video de face-api -->
        </div>

        <div id="panelGestion" class="panel-derecho hidden">
            <h3 class="titulo">DOCENTES</h3>
            <input type="text" class="search-bar" placeholder="Buscar profesor...">

            <div class="lista-profesores" id="listado">
                <div class="profesor-card">
                    <!--div class="avatar">Y</div>
                    <span>Yovani Romero</span>
                    <div class="acciones">
                        <button class="btn-action btn-edit" title="Editar">✎</button>
                        <button class="btn-action btn-off" title="Desactivar">⭘</button>
                        <button class="btn-action btn-del" title="Eliminar">✕</button>
                    </div-->
                </div>
            </div>

            <button class="btn-agregar" onclick="togglexPanel()">+ REGISTRAR</button>
        </div>
    </div>

    <script>

        // Funcionalidad para traer profesores
        datosProfesores=[];<?php //echo json_encode($profesores); ?>;
        window.onload = () => {cargarProfesores(); };
        async function cargarProfesores() {
            const response = await fetch('php/profesores/leer_profesores.php');
            datosProfesores = await response.json(); // Actualiza la variable global
            listarProfesores();
        }
        function listarProfesores(){
            // 1. Validar que la variable sea un array y no esté vacía
            if (!Array.isArray(datosProfesores) || datosProfesores.length === 0) {
                console.warn("La lista de profesores está vacía o no se ha cargado aún.");
                return; 
            }
            datosProfesores.forEach(prof => {CrearCarta(prof);});
        }
        
        // --- LÓGICA DEL PANEL ---
        function togglePanel() {
            const panel = document.getElementById('panelGestion');
            const boton = document.getElementById('toggle-panel');
            const reloj = document.getElementById('reloj-container');
            
            panel.classList.toggle('hidden');
            
            if (panel.classList.contains('hidden')) {
                boton.innerHTML = '☰';
                document.getElementById('toggle-panel').classList.add('ocultoboton');
                moveCamera("center");
                
            } else {
                boton.innerHTML = '✕';
                document.getElementById('toggle-panel').classList.remove('ocultoboton');
                moveCamera("left");
            
            }
        }
        
        function CrearCarta(prof) {
            const { id, nombre, activo } = prof;

            const profCard = document.createElement('div');
            profCard.classList.add('profesor-card');
            
            // Si el profesor no está activo, aplicamos el estilo visual suave
            if (!activo || activo === '0') {profCard.style.opacity = '0.5';profCard.style.filter = 'grayscale(1)';}

            //  Avatar 
            const profAvatar = document.createElement('div');
            profAvatar.classList.add('avatar');
            profAvatar.textContent = nombre ? nombre.charAt(0).toUpperCase() : '?'; 
            profCard.appendChild(profAvatar);
            // Nombre
            const spanNombre = document.createElement('span');
            spanNombre.textContent = nombre;
            profCard.appendChild(spanNombre);
            // Contenedor de Acciones
            const profActions = document.createElement('div');
            profActions.classList.add('acciones');
            // Botón Editar
            const btnEdit = document.createElement('button');
            btnEdit.classList.add('btn-action', 'btn-edit');
            btnEdit.textContent = '✎';
            btnEdit.onclick = () => console.log("Editar:", id);
            profActions.appendChild(btnEdit);
            // Botón Desactivar (Off)
            const btnOff = document.createElement('button');
            btnOff.classList.add('btn-action', 'btn-off');
            btnOff.textContent = (activo == 1) ? '⭘' : '⬤';
            btnOff.onclick = () => console.log("Toggle Estado:", id);
            profActions.appendChild(btnOff);
            // Botón Eliminar
            const btnDel = document.createElement('button');
            btnDel.classList.add('btn-action', 'btn-del');
            btnDel.textContent = '✕';
            btnDel.onclick = () => console.log("Eliminar:", id);
            profActions.appendChild(btnDel);

            // Inserción al DOM
            profCard.appendChild(profActions);   
            const contenedor = document.getElementById("listado");
            if (contenedor) {
                contenedor.appendChild(profCard);
            }


            ////funcionalidad de botones
            btnDel.addEventListener('click', async () => {  
                if(!confirm("Seguro que quieres eliminar a "+nombre)){return;}
                if(prompt(`Para eliminar a ${nombre}, escribe: ELIMINAR`) != "ELIMINAR"){return;}
                await BorrarProfesor(id);
            });
        }

        async function BorrarProfesor(_ID){
            try {
                const respuesta = await fetch('php/profesores/eliminar_profesor.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                        },
                    body: JSON.stringify({id:_ID})
                    });
                const resultado = await respuesta.json(); 
                if (resultado.success) {
                        console.log(resultado.message);
                        alert("respuesta: "+ resultado.message); 
                        document.getElementById("listado").innerHTML = "";  
                        // 1. Buscamos el índice (posición) del profesor en el array
                        const indice = datosProfesores.findIndex(p => p.id == _ID);
                       ///muy bien ya esta optima borrar ahora agrgar 
                        // 2. Si lo encuentra (el índice no es -1), lo borra
                        if (indice !== -1) {
                            datosProfesores.splice(indice, 1); // (posición, cuántos elementos borrar)
                        }  
                        listarProfesores();
                    } else {
                    alert("respuesta: " + resultado.error);
                    }
            } catch (error) {
                console.error("Error al enviar: ", error);
                }
        }

    
  async function guardarProfesor(_nombre,_tag,_listaCaras){
        //alert("datos validos")
        if(_listaCaras.length == 0){alert("Guarda al menos un rostro");return;}

        let _Page = 'php/profesores/guardar_profesor.php';
        let datosEnvio = {
                nombre:_nombre, 
                tags: _tag,
                descriptor: JSON.stringify(_listaCaras)
                };

        try {
            const respuesta = await fetch(_Page, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(datosEnvio)
            });
            const resultado = await respuesta.json(); 
            if (resultado.success) {
                console.log(datosEnvio);
                alert("respuesta: "+ resultado.message);
            } else {
                alert("respuesta: " + resultado.error);
            }
        } catch (error) {
            console.error("Error al enviar: ", error);
        }
    }      
    </script>

<?php include 'newAgregaEdita.php'; ?>