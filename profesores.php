<?php
    include "php/conexion.php";

    // 1. Consultamos todos los registros
    $sql = "SELECT id, nombre, activo, tags FROM caras";
    $stmt = $pdo->query($sql);
    $profesores = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de profesores</title>
    <script src="js/face-api.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="estiloMARS.css">
    <link rel="stylesheet" href="admin-style.css">

    <style>
        .contenedor{
            position: relative; /* Define el marco de referencia */
            display: inline-block; /* Ajusta el div al tamaño de la imagen */
            line-height: 0;
            padding: 0px;
        }

        #canva {
            position: absolute; /* Lo saca del flujo normal */
            top: 0;
            left: 0;
            /* Opcional: para asegurarte de que el canvas no bloquee clics en la imagen */
            pointer-events: none; 
        }
        .oculto {
            display: none !important;
        }


        .btn {
        padding: 6px 17.5px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.8);
        margin-right: 5px;
        }
        

        .btn-success {
        background-color: #ffffff;
        border-color: #00ff59;
        color: #00ff59;
        }

        .btn-danger {
        border-color: #ff0000;
        color: #ff0000;
        background-color: #ffc5c5;
        }

        .btn-change {
        background-color: #ffffff;
        border-color: #ffae00;
        color: #ffae00;
        }

        .btn:hover{

        transform: translateY(4px);
        cursor: pointer;
        box-shadow: 0 0px 0px rgba(0, 0, 0, 0.8);
        }

        .active{
        color: #000000;
        }

        .inactive{
        color: #888888;
        }

        .prof-edit-form{

        width:100%;
        display: block;

        }

        .prof-infodiv{
        display: flex;
        justify-content: space-between;
        align-items: center;
        }

        .prof-card{
        display: block;

        }

        .prof-info{
            display:flex;
        }

        .prof-avatar-context{
            display:flex;
            align-items: center;
        }

        .prof-edit-form{
            margin-top: 20px;
            transition: 0.3s all; 
        }

        .prof-input{
            width:100%;
        }

        .invisible {
            display: none;
            height: 0;
        }

        .list-panel{
        width:100%;

        }

    </style>
</head>
<body>

    <?php include 'php/navbar.php'; ?>

            <script>
                const datosProfesores = <?php echo json_encode($profesores); ?>;
                const allProfesors = [];

                openEditor = -1;
                openProf = -1;

                datosProfesores.forEach (prof => {
                    CrearCarta(prof);
                    });

                function CrearCarta(prof){

                    const myAllprofesorID = allProfesors.length;
                    const id = prof.id;
                    const nombre = prof.nombre;
                    const activo = prof.activo;
                    const tags = JSON.parse(prof.tags) || [];

                    const profCard = document.createElement('div');

                    console.log(tags);
                    profCard.classList.add('prof-card');
                    if(activo) {
                        profCard.classList.add('active');
                    } else {
                        profCard.classList.add('inactive');
                    }
                    
                    profCard.myID = myAllprofesorID; // Guardamos el ID en el elemento para referencia futura

                    const infoDiv = document.createElement('div');
                    infoDiv.classList.add('prof-infodiv');
                    profCard.appendChild(infoDiv);

                    const profAvatarContext = document.createElement('div');
                    profAvatarContext.classList.add('prof-avatar-context');

                    const profAvatar = document.createElement('div');
                    profAvatar.classList.add('prof-avatar');
                    profAvatar.textContent = nombre.charAt(0).toUpperCase(); // Primera letra del nombre
                    profAvatarContext.appendChild(profAvatar);
                    const profInfo = document.createElement('div');
                    profInfo.classList.add('prof-info');
                    const strong = document.createElement('strong');
                    strong.textContent = nombre;

                    profInfo.appendChild(strong);
                    profAvatarContext.appendChild(profInfo);

                    infoDiv.appendChild(profAvatarContext);

                    const profActions = document.createElement('div');
                    profActions.classList.add('prof-actions');

                    const btnChange = document.createElement('button');
                    btnChange.classList.add('btn', 'btn-change');
                    btnChange.textContent = 'Editar';
                    profActions.appendChild(btnChange);

                    const btnToggle = document.createElement('button');
                    if(activo){
                        btnToggle.classList.add('btn');
                        btnToggle.textContent = 'Desactivar';
                    } else {
                        btnToggle.classList.add('btn', 'btn-success');
                        btnToggle.textContent = 'Activar';
                    }
                    btnToggle.addEventListener('click', () => {
                        toggleProfesor(id);
                    });
                    profActions.appendChild(btnToggle);
                    const btnDelete = document.createElement('button');
                    btnDelete.classList.add('btn', 'btn-danger');
                    btnDelete.textContent = 'Eliminar';
                    profActions.appendChild(btnDelete);
                    infoDiv.appendChild(profActions);

                    const profEditdivFormulario = document.createElement('div');
                    profEditdivFormulario.classList.add('prof-edit-form');
                    profEditdivFormulario.classList.add('invisible');

                    const profEditForm = document.createElement('form');
                    profEditdivFormulario.appendChild(profEditForm);

                    const inputNombreLabel = document.createElement('label');
                    inputNombreLabel.textContent = "Nombre del profesor:";
                    profEditForm.appendChild(inputNombreLabel);

                    const inputNombre = document.createElement('input');
                    inputNombre.classList.add('prof-input');
                    inputNombre.placeholder = "Nombre del profesor";
                    inputNombre.type = 'text';
                    inputNombre.name = 'nombre';
                    inputNombre.value = nombre;
                    profEditForm.appendChild(inputNombre);

                    const inputTagsLabel = document.createElement('label');
                    inputTagsLabel.textContent = "Tags (separados por comas):";
                    profEditForm.appendChild(inputTagsLabel);

                    const inputTags = document.createElement('input');
                    inputTags.classList.add('prof-input', 'tag-input');
                    inputTags.placeholder = "Tags del profesor";
                    inputTags.type = 'text';
                    inputTags.name = 'tags';
                    inputTags.value = Array.isArray(tags) ? tags.join(', ') : '';
                    profEditForm.appendChild(inputTags);

                    const btnSave = document.createElement('button');
                    btnSave.type = 'submit';
                    btnSave.classList.add('btn', 'btn-success');
                    btnSave.textContent = 'Guardar';
                    btnSave.style = 'margin-top:10px; width:100%;';
                    profEditForm.appendChild(btnSave);

                    btnChange.addEventListener('click', () => {
                    const mySelf = allProfesors[myAllprofesorID];

                        if(openEditor !== -1 && openEditor !== id){
                            if(openProf){
                                openProf.classList.add('invisible');
                            }
                        }

                        if(openEditor === id){
                            openEditor = -1;
                            openProf = -1;
                            profEditdivFormulario.classList.add('invisible');
                        }else{
                            openEditor = id;
                            openProf = profEditdivFormulario;
                            profEditdivFormulario.classList.remove('invisible');
                            inputNombre.value = mySelf.nombre;
                            inputTags.value = Array.isArray(mySelf.tags) ? mySelf.tags.join(', ') : '';
                        }

                    });

                    profEditForm.addEventListener('submit', (e) => {
                        e.preventDefault();
                        const mySelf = allProfesors[myAllprofesorID];
                        const updatedNombre = inputNombre.value.trim();
                        const updatedTags = inputTags.value.split(',').map(t => t.trim()).filter(t => t);

                        updateInfo(id, updatedNombre, updatedTags);
                        
                        mySelf.nombre = updatedNombre;
                        mySelf.tags = updatedTags;
                        prof.nombre = updatedNombre;
                        prof.tags = updatedTags;
                        strong.textContent = updatedNombre;
                        profEditdivFormulario.classList.remove('visible');
                    });

                    profCard.appendChild(profEditdivFormulario);

                    allProfesors.push({
                        id,
                        nombre,
                        activo,
                        tags,
                        element: profCard
                    });

                }
            

            </script>

    <div class="main-container" style="width:90%; height:90%; justify-self:center; display:flex; flex-direction: column; align-items: center; padding: 20px; margin-left: 5%;">
     <section class="panel list-panel">
            <div class="panel-header" >
                <h2>Profesores Registrados</h2>
                <input type="text" placeholder="Buscar profesor..." id="search-prof">
            </div>
            <div class="scroll-area" id="professors-list">
            </div>
            <button id="btnadd" class="btn" style="width:100%">Agregar Profesor</button>
        </section>

    </div>

    <div id="ventana" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-body">
            
            <div class="form-column">
                <h3><span id="aetag">Añadir Nuevo</span> Profesor</h3>
                <div class="input-group">
                    <label>Nombre:</label>
                    <input type="text" id="cnombre" placeholder="Ej. Juan Perez">
                </div>
                <div class="input-group">
                    <label>Etiquetas (Separadas por comas):</label>
                    <input type="text" id="btntags" placeholder="Ej. Matemáticas, Fisica, Informatica, etc.">
                </div>
            </div>

            <div class="camera-column">
                <div class="camera-circle">
                    <video id="video" width="600" height="600" autoplay muted></video>
                    <canvas id="canvas"></canvas>
                </div>
                <p>Asegúrese de que el rostro esté visible</p>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn-cancel" id="btnsalir">Cancelar</button>
            <button class="btn-ok" id="btnguarda">Guardar Profesor</button>
        </div>
    </div>
    </div>

    <script>

    function refreshProfessorList(search = ""){
        const listContainer = document.getElementById('professors-list');
        listContainer.innerHTML = '';

        trueSearch = "";
        const searchTerms = search.trim().split(' ').filter(term => {  
            if(term.startsWith('#') && term.length > 1){
                return term;
            }else{
                if(!term.startsWith('#')){
                trueSearch += term + " ";
                }
                return false;
            }
        }).map(term => term.slice(1).toLowerCase());

        allProfesors.forEach(prof => {
    
        if (!search) {
            listContainer.appendChild(prof.element);
            return;
            }

            var include = 0;

            if(prof.nombre.toLowerCase().includes(trueSearch.toLowerCase().trim()) && trueSearch.trim() !== ""){
                if(searchTerms.length === 0){
                    include += 2;
                    } else {
                    include += 1;
                    }
                } 

            if(trueSearch.trim() === ""){
                include += 1;
                }

            if (searchTerms.length > 0 && prof.tags.length > 0) {
                const profTagsLower = prof.tags.map(t => t.toLowerCase());


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
            }

                

            if(include === 2){
                listContainer.appendChild(prof.element);
                }

            console.log(prof.nombre, include);

        });

        

    }

    document.getElementById('search-prof').addEventListener('input', (e) => {
        refreshProfessorList(e.target.value);


         if(openEditor !== -1){
            if(openProf){
                openProf.classList.add('invisible');
                }
                openEditor = -1;
                openProf = -1;
            }


    });

    refreshProfessorList();

    function toggleProfesor(id){
        const prof = allProfesors.find(p => p.id === id);
        if(prof){
            if(prof.activo){
                const confirmed = confirm("Seguro que deseas desactivar a " + prof.nombre + "?");
                if(!confirmed){
                    return;
                }
            } 

            prof.activo = !prof.activo;
            if(prof.activo){
                prof.element.classList.add('active');
                prof.element.classList.remove('inactive');
                const btnToggle = prof.element.querySelector('.btn-change + .btn');
                btnToggle.classList.remove('btn-success');
                btnToggle.textContent = 'Desactivar';
                const datos = { nombre: "Juan", edad: 30 };
                if(prof.tags.includes("inactivo")){
                    prof.tags = prof.tags.filter(t => t !== "inactivo");
                }
                if(!prof.tags.includes("activo")){
                    prof.tags.push("activo");
                }
                
        
            } else {
                prof.element.classList.remove('active');
                prof.element.classList.add('inactive');
                const btnToggle = prof.element.querySelector('.btn-change + .btn');
                btnToggle.classList.add('btn-success');
                btnToggle.textContent = 'Activar';
                if(prof.tags.includes("activo")){
                    prof.tags = prof.tags.filter(t => t !== "activo");
                }
                if(!prof.tags.includes("inactivo")){
                    prof.tags.push("inactivo");
                }
               
            }

            const tagsInput = prof.element.querySelector('.prof-edit-form').querySelector('.tag-input');
            if(tagsInput){
                    tagsInput.value = prof.tags.join(', ');
                }

            fetch('php/activar.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: prof.id,
                activo: prof.activo,
                tag: prof.tags
                }),
            })
            .then(response => response.json()) // Recibir respuesta PHP
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
        }
    }

    function updateInfo(id, name, tags){
        const prof = allProfesors.find(p => p.id === id);
        if(prof){

            fetch('php/actualizar.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: prof.id,
                nombre: name,
                tag: tags
                }),
            })
            .then(response => response.json()) // Recibir respuesta PHP
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
        }
    }
    </script>
    
    <script src="carafunciones.js"></script>
    <script>
    let cargado = false; // Variable global
    let displaySize;
    let ctx
    let descriptorActual = null;
    let tiempo;

    cargarModelos().then(() => {
        cargado = true;
        console.log("✅ Modelos listos para usar");
    }).catch(err => {
        console.error("Error al cargar modelos:", err);
    });

    //agrgar profesor
    const ventana = document.getElementById('ventana');
    const btnadd = document.getElementById('btnadd');
    const btntags = document.getElementById('btntags');
    const btnsalir = document.getElementById('btnsalir');
    const btnguarda = document.getElementById('btnguarda');
    const cnombre = document.getElementById('cnombre');
    const aetag = document.getElementById('aetag');
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');

    // Abrir Modal
    btnadd.addEventListener('click', () =>{addedi(1)});
    //btnedi.addEventListener('click', () =>{addedi(2)});
    async function addedi(md)  {
        if (!cargado) {alert("Los modelos de IA aún se están descargando. Por favor, espere.");return;}        
        if(md==1){
            cnombre.value="";
            btntags.value="";
            aetag.textContent="Añadir Nuevo";
        }/*else
        if(md==2){
            if (name==""){alert("seleccione un profesor") ;return}
            cnombre.value=name;
            aetag.textContent="Editar";
        }*/
        ventana.style.display = 'flex';
        // Esperamos a que la cámara se encienda REALMENTE
        await startCamera(); 

        // IMPORTANTE: Esperamos a que el video cargue sus metadatos para tener el tamaño real
        video.onloadedmetadata = () => {
            displaySize = { width: video.videoWidth, height: video.videoHeight };
            faceapi.matchDimensions(canvas, displaySize);
            
            // Si quieres el efecto espejo:
            ctx = canvas.getContext('2d');
            ctx.translate(displaySize.width, 0);
            ctx.scale(-1, 1);

            // Iniciamos el intervalo solo cuando todo está listo
            timepo=setInterval(proceso, 100);
            
        };
    }
    btnsalir.addEventListener('click', () => {
        ventana.style.display = 'none';
        stopCamera(); 
    });
    btnguarda.addEventListener('click',()=>{if(descriptorActual){guardar()}else{alert("ninguna cara detectada")}});
    // Función básica para activar la cámara
    async function startCamera() {
        
        const constraints = {
        video: {
            width: { ideal: 600 },
            height: { ideal: 600 },
            aspectRatio: 1 // Esto le dice al navegador que prefieres un cuadrado
        }
        };
        navigator.mediaDevices.getUserMedia(constraints)
        .then(stream => { video.srcObject = stream; camara=true; })
        .catch(err => console.error("Error al acceder a la cámara:", err));
    }
    function stopCamera() {
        if (video && video.srcObject) {
            const stream = video.srcObject;
            const tracks = stream.getTracks();

            tracks.forEach(track => {
                track.stop();
                console.log("Pista de cámara detenida.");
            });

            video.srcObject = null;
            clearInterval(timepo);
        }
    }
    async function guardar(){
        // Convertimos el Float32Array a un array normal y luego a JSON
        const tags = btntags.value.split(',').map(tag => tag.trim());

        const datosEnvio = {
            nombre:cnombre.value, 
            tags: tags,
            descriptor: JSON.stringify(Array.from(descriptorActual))
        };

        try {
            const respuesta = await fetch('php/guardar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datosEnvio)
            });

            const resultado = await respuesta.json(); 
            if (resultado.success) {
                console.log(datosEnvio);
                //await cargarCatalogo();
                alert("respuesta: "+ resultado.message);

                CrearCarta(resultado.profesor);
                refreshProfessorList(document.getElementById('search-prof').value);
                ventana.style.display = 'none';
                stopCamera(); 
            } else {
                alert("respuesta: " + resultado.error);
            }
        } catch (error) {
            console.error("Error al enviar: ", error);
        }
    }
   
    </script>
    
</body>
</html>
