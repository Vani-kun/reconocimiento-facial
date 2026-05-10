    <style>
        :root {
            --accent-blue: #00f2ff;
            --bg-dark:#0f495e;
            --panel-bg: rgba(26, 32, 44, 0.95);
            --danger: #ff4d4d;
            --warning: #ffcc00;
        }


        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white;
            overflow: hidden;
            margin: 0;padding: 0;box-sizing: border-box;user-select: none; 
        }

        /* --- LAYOUT PRINCIPAL --- */
        .main-wrapper {
            position: absolute;
            display: flex;
            width: 100vw;
            height: 100vh;
            margin: 0;padding: 0;box-sizing: border-box;user-select: none; 
            left:0;top:0;
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
            width: 35%;
            height: 100%;
            background: var(--newpoligono);
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
        .btn-toggle-panel {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: var(--newfondo);
            border: 1px solid var(--newprima);
            color: var(--newprima);
            width: 45px;
            height: 45px;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(104, 104, 104, 0.1);
        }

        .search-bar {
            width: 100%;
            padding: 10px;
            margin: 20px 0;
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(0,0,0,0.3);
            color: white;
            border-radius: 5px;
        }
        .search-bar:active {
            border: 1px solid var(--newprima);
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

        .lista-profesores.schedulepl .profesor-card:hover{
            background: rgba(255, 255, 255, 0.1);
            cursor:pointer;
        }
        .lista-profesores.schedulepl .profesor-card.active{
            background: rgba(255, 255, 255, 0.2);
        }


        .avatar {
            width: 32px; height: 32px;
            background: var(--newprima);
            color: var(--newletras);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-weight: bold;
            overflow: hidden;
        }

        .acciones { margin-left: auto; display: flex; gap: 5px; }

        .lista-profesores.schedulepl .btn-action{
            display:none;
        }

        .btn-action {
            border: none; padding: 5px 8px; border-radius: 4px; cursor: pointer; color: white;
        }

        .btn-edit { background: var(--newprima); color: black; }
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
.btn-agregar:hover {
    background-color:var(--newprima);
    border-color: var(--newprima);
    box-shadow: 0 0 20px var(--newprima);
    transform: translateY(2px); /* Eleva un poco el botón */
    color:var(--newletras);
}
.btn-agregar:active {
    transform: translateY(2px) scale(0.97); /* Se hunde y se encoge un poco */
}


        /* Scrollbar minimalista */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: var(--newprima); }

        .titulo{
            margin-top: 50px;
            color:var(--newletras);
        }
        .ocultoboton{
            display:none;
        }
    </style>


    <div class="main-wrapper">
        <button id="toggle-panel" onclick="togglePanel()" class="btn-toggle-panel ocultoboton">☰</button>

        <div class="panel-izquierdo">
            <h1>LIVELULA</h1>
            <p style="opacity: 0.5;">Sistema de Biometría</p>
        </div>

        <div id="panelGestion" class="panel-derecho hidden">
            <h3 class="titulo">DOCENTES</h3>
            <input id="lupa" type="text" class="search-bar" placeholder="Buscar profesor...">

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

            <button id="BTNProfRegistry" class="btn-agregar" onclick="togglexPanel(0,0)">+ REGISTRAR</button>
        </div>
    </div>

    <script>

        // Funcionalidad para traer profesores
        datosProfesores=[];<?php //echo json_encode($profesores); ?>;
        editar=0;
        ideditar=0;
        window.onload = () => {cargarProfesores(); };
        async function cargarProfesores() {
            const response = await fetch('php/profesores/leer_profesores.php');
            datosProfesores = await response.json(); // Actualiza la variable global
            listarProfesores();
            cargarDatosAsis();
        }
        function listarProfesores(){

            document.getElementById("listado").innerHTML="";
            if (!Array.isArray(datosProfesores) || datosProfesores.length === 0) {
                console.warn("La lista de profesores está vacía o no se ha cargado aún.");
                return; 
                }

            const buscador = document.getElementById('lupa');
            const valorBusqueda = buscador.value; //minúsculas   

            AsisMenu.textContent = "";
            var trueSearch = "";

            const searchTerms = valorBusqueda.trim().split(' ').filter(term => {  
            if(term.startsWith('#') && term.length > 1){
                return term;
                }else{
                if(!term.startsWith('#')){
                trueSearch += term + " ";
                }
                return false;
                }
            }).map(term => term.slice(1).toLowerCase());

        datosProfesores.filter((e) => {

         var include = 0;
         var mytags = JSON.parse(e.tags);

         if(!Array.isArray(mytags)){mytags = []};

            if(e.nombre.toLowerCase().includes(trueSearch.toLowerCase().trim()) && trueSearch.trim() !== ""){
                if(searchTerms.length === 0){
                    include += 2;
                    } else {
                    include += 1;
                    }
                }else if(trueSearch.trim() === ""){
                include += 1;
                }

        

        if (searchTerms.length > 0 && mytags.length > 0) {
            const profTagsLower = Array.isArray(mytags) ? mytags.map(t => t.toLowerCase()) : [];

            const allTermsMatched = searchTerms.every(term => {
            // Buscamos el índice de la primera etiqueta que coincida con el término
            const foundIndex = profTagsLower.findIndex(tag => tag.includes(term));
                
            if (foundIndex !== -1) {
                
                // Si la encontramos, la eliminamos de las disponibles para este profesor
                profTagsLower.splice(foundIndex, 1);
                return true;
                }
            return false;
            });
        
            if (allTermsMatched) {
                include += 1;
                }
            }else if(searchTerms.length === 0){
            include += 1;
            }
            
            
  

            return include >= 2;


        }).forEach(prof => {CrearCarta(prof);});


        }
        document.getElementById('lupa').addEventListener('input', (e) => {
            listarProfesores();
        })
        // --- LÓGICA DEL PANEL ---
        function togglePanel() {
            const panel = document.getElementById('panelGestion');
            const boton = document.getElementById('toggle-panel');
            const reloj = document.getElementById('reloj-container');
            
            panel.classList.toggle('hidden');

            if (panel.classList.contains('hidden')) {
                boton.innerHTML = '☰';
                document.getElementById('toggle-panel').classList.add('ocultoboton');

                if(!panel.classList.contains('AA_panel')){
                    moveCamera("center");
                    enpanelprofesor=false;   
                     if(document.getElementById('sidePanel').classList.contains("active")){togglexPanel(0,0);}
                    }

                if(!AA_Wrapper.classList.contains("hidden")){
                    AA_Wrapper.classList.remove("AA_panel");
                }

               
            } else {
                boton.innerHTML = '✕';
                document.getElementById('toggle-panel').classList.remove('ocultoboton');

                
                moveCamera("left");  

                panel.classList.remove("AA_panel");
                boton.classList.remove("AA_panel");
            }
        }
        function creafoto(contenedor,id,name){
                const nuevaImagen = document.createElement('img');            
                    nuevaImagen.onerror = function() {
                        contenedor.innerHTML = name[0].toUpperCase();
                        nuevaImagen.remove();
                    };
                    nuevaImagen.onload = function() {
                        contenedor.innerHTML = ''; 
                        contenedor.appendChild(nuevaImagen);
                    };
                nuevaImagen.src = "img/caras/"+id+".jpg";
                nuevaImagen.classList.add("scanimg");
        }

        function CrearCarta(prof) {
            const { id, nombre, activo, tags } = prof;

            const profCard = document.createElement('div');
            profCard.classList.add('profesor-card');
            
            // Si el profesor no está activo, aplicamos el estilo visual suave
            if (!activo || activo === '0') {profCard.style.opacity = '0.5';profCard.style.filter = 'grayscale(1)';}

            //  Avatar 
            const profAvatar = document.createElement('div');
            profAvatar.classList.add('avatar');
            //profAvatar.textContent = nombre ? nombre.charAt(0).toUpperCase() : '?'; 
            creafoto(profAvatar,id,nombre);
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
            btnEdit.addEventListener('click', async () => { 
            ideditar=id;
            console.log("Editar: ", id);togglexPanel(1,id)
            });
            profActions.appendChild(btnEdit);
            // Botón Desactivar (Off)
            const btnOff = document.createElement('button');
            btnOff.classList.add('btn-action', 'btn-off');
            btnOff.textContent = (activo == 1) ? '⭘' : '⬤';
    
            if (activo == 1){//console.log("Desactivar id:", id);
                btnOff.addEventListener('click', async () => {  
                if(!confirm("Seguro que quieres Desactivar a "+nombre)){return;}
                await activarProfesor(id,0);});
            }else{ //console.log("activar id:", id);
                btnOff.addEventListener('click', async () => {  
                await activarProfesor(id,1);});
            }


            profCard.setAttribute('id', id);
            profCard.setAttribute('nombre', nombre);
            profCard.setAttribute('tags', tags);

            profActions.appendChild(btnOff);
            // Botón Eliminar
            const btnDel = document.createElement('button');
            btnDel.classList.add('btn-action', 'btn-del');
            btnDel.textContent = '✕';
            profActions.appendChild(btnDel);

            // Inserción al DOM
            profCard.appendChild(profActions);   
            const contenedor = document.getElementById("listado");
            if (contenedor) {
                contenedor.appendChild(profCard);
            }

            profCard.addEventListener("click", (e) => {

                if(Horario != 0){

                    if(!profCard.classList.contains("active")){
                        d = Array.from(document.getElementsByClassName("profesor-card"));
                        d.forEach(element => {
                        element.classList.remove("active");
                        });

                        profCard.classList.add("active");
                        profSelected = profCard;
                        }else{

                        profCard.classList.remove("active");
                        profSelected = -1;
                        }
                        ActualizarHorario();
                    }else if(AA_Open){

                    AA_toggleProf();
                    AA_ProfID = id;
                    AA_AvatarNombre.textContent = nombre;   
                    AA_AvatarTags.textContent = JSON.parse(tags).join(", ");     

                    creafoto(AA_Avatar,id,nombre);

                    }

                });


            ////funcionalidad de botones
            btnDel.addEventListener('click', async () => {console.log("Eliminar id:", id);  
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
                    msj("respuesta: "+ resultado.message); 
                    document.getElementById("listado").innerHTML = "";  
                    // 1. Buscamos el índice (posición) del profesor en el array
                    const indice = datosProfesores.findIndex(p => p.id == _ID);
                    ///muy bien ya esta optima borrar ahora agrgar 
                    // 2. Si lo encuentra (el índice no es -1), lo borra
                    if (indice !== -1) {
                        datosProfesores.splice(indice, 1); // (posición, cuántos elementos borrar)
                    }  
                    cargarProfesores();
                } else {
                    msj("respuesta: " + resultado.error,2);
                }
        } catch (error) {
            console.error("Error al enviar: ", error);
            }
    }
    async function guardarProfesor(_nombre,_tag,_listaCaras,edi){
        if(_listaCaras.length == 0){msj("Guarda al menos un rostro");return;}
        
        let _Page ='';
        let datosEnvio='';

         console.log("Lista caras",_listaCaras);

        if (edi==1) { _Page ='php/profesores/actualizar_profesor.php';
        datosEnvio = {
                id:ideditar,
                nombre:_nombre, 
                tags: _tag,
                descriptor: JSON.stringify(_listaCaras)
                };
        }else
        if (edi==0) { _Page ='php/profesores/guardar_profesor.php';
            datosEnvio = {
                   
                    nombre:_nombre, 
                    tags: _tag,
                    descriptor: JSON.stringify(_listaCaras)
                    };
        }
        try {
            const respuesta = await fetch(_Page, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(datosEnvio)
            });
            const resultado = await respuesta.json(); 
            if (resultado.success) {
                if (edi==1) {await guardarImg(canvax,ideditar);}else
                {await guardarImg(canvax,resultado.profesor.id);}
                console.log(datosEnvio);
                 cargarProfesores();
                msj("respuesta: "+ resultado.message,0);
            } else {
                msj("respuesta: " + resultado.error,2);
            }
        } catch (error) {
            console.error("Error al enviar: ", error);
        }
    }   
    async function activarProfesor(id, estado) {
        //estado 0 desactivalo //1 activalo
        try {
            const respuesta = await fetch('php/profesores/activar_profesor.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    id: id,
                    activo: estado,
                    tag: ""
                }),
            })
            const resultado = await respuesta.json(); 
            if (resultado.success) {
                console.log("Servidor respondió:",resultado.message)
                cargarProfesores();
            } else {
                console.log("respuesta: " + resultado.error);
            }
        } catch (error) {console.error("Error al Activar/desactivar", error);}
    }
    </script>

<?php include 'newAgregaEdita.php'; ?>

