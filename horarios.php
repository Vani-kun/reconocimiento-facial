<?php
    include "php/conexion.php";

    //traer todos los profesores
    $sql = "SELECT id, nombre, activo, tags, horarios FROM caras WHERE activo = 1 ORDER BY nombre ASC";
    $stmt = $pdo->query($sql);
    $profesores = $stmt->fetchAll();
    //el profesor actual
    $profesor = null;
    if (isset($_GET['id'])) {
        $id_buscado = $_GET['id'];
        try {
            $stmt = $pdo->prepare("SELECT * FROM caras WHERE id = :id LIMIT 1");
            $stmt->execute(['id' => $id_buscado]);
            $profesor = $stmt->fetch(PDO::FETCH_ASSOC);    
        } catch (PDOException $e) {
            echo "Error en id profesor: " . $e->getMessage();
        }
    }

     //traer todos los horarios
    $sql = "SELECT id, asignatura, seccion, profesor, entrada, salida, aula FROM horario";
    $stmt = $pdo->query($sql);
    $horarios = $stmt->fetchAll();
    //el profesor actual
    $horario = null;
    if (isset($_GET['id'])) {
        $id_buscado = $_GET['id'];
        try {
            $stmt = $pdo->prepare("SELECT * FROM horario WHERE id = :id LIMIT 1");
            $stmt->execute(['id' => $id_buscado]);
            $horario = $stmt->fetch(PDO::FETCH_ASSOC);    
        } catch (PDOException $e) {
            echo "Error en id horario: " . $e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.A.R.S. - Panel de Administración</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/profesores.css">
    <script src="js/face-api.min.js"></script>
    <style>
        .prof-card{

        display: flex;
        align-items: center;


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

        .invisible
        {
            display: none !important;
            pointer-events: none;
        }
        .details-list{
            list-style: none;
            padding: 0;
            margin: 0;
            justify-content: left;
        }

         .details-list li{
            margin-bottom: 5px;
        }

        .prof-details{
            padding: 10px;
            border-radius: 5px;
            margin-left: 20px;
            justify-content: left;
        }
    </style>
</head>
<body>
    
<?php include 'php/extras/navbar.php'; ?>

    <main class="admin-container">
        <section id="schedule-section" class="panel list-panel invisible">
            <div class="panel-header">
                <h2>Horario Registrados</h2>
                </div>
                <div class="scroll-area" id="schedule-list">
                </div>
        </section>

        <section id="professors-section" class="panel list-panel">
            <div class="panel-header">
                <h2>Profes Registrados</h2>
            </div>

            <div class="scroll-area" id="professors-list">
            <script>
                SelectProfesor = -1;
                const datosProfesores = <?php echo json_encode($profesores); ?>;
                const allProfesors = [];

                openEditor = -1;
                openProf = -1;

                datosProfesores.forEach (prof => {
                        if(prof.activo){
                            document.getElementById('professors-list').appendChild(CrearCarta(prof));
                            }
                    });

                function CrearCarta(prof){

                    console.log(prof);

                    const myAllprofesorID = allProfesors.length;
                    const id = prof.id;
                    const nombre = prof.nombre;
                    const activo = prof.activo;
                    const tags = JSON.parse(prof.tags) || [];

                    const horarios = prof.horarios ? (typeof prof.horarios === 'string' ? JSON.parse(prof.horarios) : prof.horarios) : [];

                    const profCard = document.createElement('div');

                    profCard.myID = myAllprofesorID; // Guardamos el ID en el elemento para referencia futura

                    profCard.classList.add('prof-card');

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

                    allProfesors.push({
                        id,
                        nombre,
                        activo,
                        tags,
                        horarios,
                        element: profCard
                    });

                    profCard.addEventListener('click', function() {
                        
                        if(SelectProfesor != -1){
                            allProfesors[SelectProfesor].element.classList.remove('active');
                        }

                        if(SelectProfesor === this.myID){
                            SelectProfesor = -1;
                            profCard.classList.remove('active');
                            document.getElementById('current-prof-name').textContent = "Seleccione un profesor";
                            document.getElementById('current-prof-id').textContent = "TAGS: ---";
                            return;
                        }else{
                            profCard.classList.add('active');
                            SelectProfesor = this.myID;
                            document.getElementById('current-prof-name').textContent = allProfesors[this.myID].nombre;
                            document.getElementById('current-prof-id').textContent = "TAGS: " + 
                            allProfesors[this.myID].tags
                            .filter(term => {
                            // Usamos !== para decir "que no sea igual a"
                            return term !== "activo" && term !== "inactivo";
                            })
                            .join(', ');
                        }
                        


                    });

                    return profCard;
                }
            

                SelectProfesor = -1;
                const datosHorarios = <?php echo json_encode($horarios); ?>;
                const allSchedule = [];

                openEditor = -1;
                openProf = -1;

                datosHorarios.forEach (horario => {
                        document.getElementById('schedule-list').appendChild(CrearHorario(horario));
                        
                    });

                function CrearHorario(horario){

                    const myAllscheduleID = allSchedule.length;

                    const id            = horario.id;
                    const nombre        = horario.nombre;
                    
                    const asignatura    = horario.asignatura;
                    const seccion       = horario.seccion;
                    const profesor      = horario.profesor;
                    const entrada       = horario.entrada;
                    const salida        = horario.salida;
                    const aula          = horario.aula;
                
                    let LastProfesorID = -1;   

                    if (profesor){
                        
                    LastProfesorID = allProfesors.findIndex(prof => prof.id == profesor); 
                    
                    }
                    

                    const profesorname = LastProfesorID !== -1 ? allProfesors[LastProfesorID].nombre : "Sin asignar";

                    const profCard = document.createElement('div');

                    profCard.myID = myAllscheduleID; // Guardamos el ID en el elemento para referencia futura

                    profCard.classList.add('prof-card');

                    const infoDiv = document.createElement('div');
                    infoDiv.classList.add('prof-infodiv');
                    profCard.appendChild(infoDiv);

                    const profAvatarContext = document.createElement('div');
                    profAvatarContext.classList.add('prof-avatar-context');

                    const profInfo = document.createElement('div');
                    profInfo.classList.add('prof-info');
                    const strong = document.createElement('strong');
                    strong.textContent = nombre;

                    profInfo.appendChild(strong);
                    profAvatarContext.appendChild(profInfo);

                    const profDetails = document.createElement('div');
                    profDetails.classList.add('prof-details');

                    const detailsList = document.createElement('ul');
                    detailsList.classList.add('details-list');
                    const seccionItem = document.createElement('li');
                    seccionItem.textContent = `Sección: ${seccion}`;
                    const profesorItem = document.createElement('li');
                    profesorItem.textContent = `Profesor Actual: ${profesorname}`;
                    const horarioItem = document.createElement('li');
                    horarioItem.textContent = `Horario: ${entrada} - ${salida}`;
                    const aulaItem = document.createElement('li');
                    aulaItem.textContent = `Aula: ${aula}`;
                    
                    detailsList.appendChild(seccionItem);
                    detailsList.appendChild(profesorItem);
                    detailsList.appendChild(horarioItem);
                    detailsList.appendChild(aulaItem);
                    profDetails.appendChild(detailsList);
                    
                    infoDiv.appendChild(profAvatarContext);
                    infoDiv.appendChild(profDetails);

                    

                    allSchedule.push({
                        id, 
                        nombre, 
                        asignatura, 
                        seccion, 
                        profesor, 
                        entrada, 
                        salida, 
                        aula,
                        element: profCard
                    });

                    if(SelectProfesor != -1 && profesor === allProfesors[SelectProfesor].id){
                         profCard.classList.add('active');
                    }
                
                    profCard.addEventListener('click', function() {
                     if(SelectProfesor === -1){return;}

                     console.log("aca")
                        if (profesor === allProfesors[SelectProfesor].id){

                            ActualizarHorarioProfesor(-1, SelectProfesor, myAllscheduleID);
                            profesorItem.textContent = `Profesor Actual: sin asignar`;
                            profCard.classList.remove('active');
                            return;

                        }else{

                            ActualizarHorarioProfesor(SelectProfesor, LastProfesorID, myAllscheduleID);
                            profesorItem.textContent = `Profesor Actual: ${allProfesors[SelectProfesor].nombre}`;
                            profCard.classList.add('active');
                            return;
                        }

                    });

                    return profCard;
                }
            
                function ActualizarHorarioProfesor(Pid, LPid, Hid){

                const IDHorario = allSchedule[Hid].id
                let Hlist1 = [];
                let IDProfesor1 = -1;

                if (Pid !== -1){
                allProfesors[Pid].horarios.push(IDHorario);
                Hlist1 = allProfesors[Pid].horarios;
                IDProfesor1 = allProfesors[Pid].id;
                }

                let Hlist2 = [];
                let IDProfesor2 = -1;

                if (LPid !== -1){
                allProfesors[LPid].horarios = allProfesors[LPid].horarios.filter(hor => hor !== IDHorario);
                Hlist2 = allProfesors[LPid].horarios;
                IDProfesor2 = allProfesors[LPid].id;
                }

                fetch('php/actualizarhorarios.php', {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                    id1: IDProfesor1,
                    horarios1: Hlist1,
                    id2: IDProfesor2,
                    horarios2: Hlist2,
                    IDHorario: IDHorario
                    }),
                        })
                    .then(response => response.json()) // Recibir respuesta PHP
                    .then(data => console.log(data))
                    .catch(error => console.error('Error:', error));


                }


            </script>    
                
            </div>

            
            
            <div id="controlpanel" class="control-panel">
                <div class="current-prof-display">
                        <div class="status-indicator"></div>
                        <?php
                            if($profesor){
                                echo '<p id="current-prof-name">Pofesor(a) '.$profesor['nombre'].'</p>';
                                echo '<small id="current-prof-id">TAGS: '.$profesor['id'].'</small>';
                            }else{
                                echo '<p id="current-prof-name">Seleccione un profesor</p>';
                                echo '<small id="current-prof-id">TAGS: ---</small>';
                            }
                        ?>
                </div>

                <div class="search-box">
                    <input type="text" id="search-input" placeholder="Buscar por nombre o ID...">
                    <span class="search-icon">🔍</span>
                </div>
            </div>
        </section>

        <section class="panel horario-panel">
            <div class="panel-header">
                <h2>Horario de Clases</h2>
                <button id="btn-add" class="btn-add">+ Asignar Materia</button>
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
        <!--section class="panel historial-panel">
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
        </section-->
    </main>

    <div id="ventana" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-body">
            
            <div class="form-column">
                <h3><span id="aetag">Añadir Nuevo</span> Profesor</h3>
                <div class="input-group">
                    <label>Nombre:</label>
                    <input type="text" id="cnombre" placeholder="Ej. Juan">
                </div>
                <div class="input-group">
                    <label>Apellido:</label>
                    <input type="text" id="add-apellido" placeholder="Ej. Pérez">
                </div>
                <div class="input-group">
                    <label>Especialidad/Materia:</label>
                    <input type="text" id="add-materia" placeholder="Ej. Matemáticas">
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

    <script src="js/carafunciones.js"></script>
    <script>
    let pageMode = 0;

    let name = "<?php echo $profesor ? $profesor['nombre'] : ''; ?>";
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
    const cnombre = document.getElementById('cnombre');
    const aetag = document.getElementById('aetag');
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');

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
        const datosEnvio = {
            nombre:cnombre.value, 
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
            } else {
                alert("respuesta: " + resultado.error);
            }
        } catch (error) {
            console.error("Error al enviar: ", error);
        }
    }
   
     
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
   
    document.getElementById('search-input').addEventListener('input', (e) => {
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

    document.getElementById('btn-add').addEventListener('click', () => {
        if (pageMode === 0){
            const Pmenu = document.getElementById('professors-section');
            Pmenu.classList.add('invisible');

            const scheduleMenu = document.getElementById('schedule-section');
            scheduleMenu.classList.remove('invisible');

            document.getElementById('btn-add').textContent = "Volver a Profesores";

            contextSection = document.getElementById('controlpanel');

            scheduleMenu.appendChild(contextSection);

        pageMode = 1;
        } else {
            const Pmenu = document.getElementById('professors-section');
            Pmenu.classList.remove('invisible');

            const scheduleMenu = document.getElementById('schedule-section');
            scheduleMenu.classList.add('invisible');

            document.getElementById('btn-add').textContent = "+ Asignar Materia";

            contextSection = document.getElementById('controlpanel');

            Pmenu.appendChild(contextSection);
        pageMode = 0;
        }
        

    });
    </script>

    <?php include 'php/extras/footer.php';?>

</body>
</html>