<?php
    include "php/conexion.php";

    //traer todos los profesores
    $sql = "SELECT id, nombre, tags FROM caras WHERE activo = 1 ORDER BY nombre ASC";
    $stmt = $pdo->query($sql);
    $profesores = $stmt->fetchAll();

     //traer todos los profesores
    $sql = "SELECT id, asignatura, seccion, profesor, aula, dias FROM horario ORDER BY id ASC";
    $stmt = $pdo->query($sql);
    $horarios = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.A.R.S. - Panel de Administración</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/profesores.css">
    <link rel="stylesheet" href="css/horarios.css">
    <link rel="stylesheet" href="sigeastyle.css">
    <script src="js/face-api.min.js"></script>

</head>
<body>
    
<?php include 'php/extras/navbar.php'; ?>

<main class="main-container" style="display:flex">
    <section id="professors-section" class="profesor-container">
        <div class="panel-header">
            <h2 style="font-size:3.5vh">Profes Registrados</h2>
        </div>

        <div class="scroll-area" id="professors-list">
            <script>

            profSelected = -1;

            const safeParse = (data) => {
                if (!data || data.trim() === "") return []; // Si está vacío o es solo espacio, devuelve array vacío
                try {
                    return JSON.parse(data);
                    } catch (e) {
                    console.error("Error parseando JSON:", data);
                    return []; // Si el JSON está mal formado, devuelve array vacío para no romper el código
                    }
                };

            SelectProfesor = -1;
            const datosProfesores = <?php echo json_encode($profesores); ?>;
            const allProfesors = [];

            
            

            openEditor = -1;
            openProf = -1;

            datosProfesores.forEach (prof => {
                document.getElementById('professors-list').appendChild(CrearCarta(prof));   
                });

            function CrearCarta(prof){

            const myAllprofesorID = allProfesors.length;
            const id = prof.id;
            const nombre = prof.nombre;
            const tags = safeParse(prof.tags);

            const profCard = document.createElement('div');

            profCard.classList.add('prof-card');

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
                 
            profCard.setAttribute('id', id);
            profCard.setAttribute('nombre', nombre);
            profCard.setAttribute('tags', tags);

            profCard.addEventListener("click", (e) => {
                if(!profCard.classList.contains("active")){
                    d = Array.from(document.getElementsByClassName("prof-card"));
                    d.forEach(element => {
                        element.classList.remove("active");
                    });

                    document.getElementById("userinfo").textContent = profCard.getAttribute('nombre');
                    document.getElementById("usertags").textContent = "tags: "+(profCard.getAttribute('tags').split(",").filter((e) => (e != "activo" && e != "inactivo")).join(", "));

                    profCard.classList.add("active");
                    profSelected = profCard;
                    }else{
                    document.getElementById("userinfo").textContent = "Escoje a un profesor";
                    document.getElementById("usertags").textContent = "tags: ";

                    profCard.classList.remove("active");
                    profSelected = -1;
                    }
                    ActualizarHorario();
                });

            allProfesors.push({
                id,
                nombre,
                tags,
                element: profCard,
                idap: myAllprofesorID,
                });

            return profCard;
            }
            </script>            
        </div>

            
            
        <div id="controlpanel" class="control-panel">
            <div class="current-prof-display">
                <div class="status-indicator"></div>
                        
            </div>

            <div class="search-box">
                <input type="text" id="search-prof" placeholder="🔍Buscar por nombre o ID...">
            </div>
            <div class="infodiv">
                <strong id="userinfo">Escoje a un profesor</strong>
                <p id="usertags">tags:</p>
            </div>
        </div>
    </section>


    <section class="schedule-container">
        <div id="schedule-section" class="schedule-div open">
            <div class="panel-header">
            <h2 style="font-size:3.5vh">Horario</h2>
            </div>

            <div class="schedule">

                <div class="schedule-header">
                    <div class="schedule-day-div-h">Lunes</div>
                    <div class="schedule-day-div-h">Martes</div>
                    <div class="schedule-day-div-h">Miercoles</div>
                    <div class="schedule-day-div-h">Jueves</div>
                    <div class="schedule-day-div-h">Viernes</div>
                    <div class="schedule-day-div-h">Sabado</div>
                    <div class="schedule-day-div-h">Domingo</div>
                </div>

                <div class="schedule-config">
                    <div id="Lunes" class="schedule-day-div"></div>
                    <div id="Martes" class="schedule-day-div"></div>
                    <div id="Miercoles" class="schedule-day-div"></div>
                    <div id="Jueves" class="schedule-day-div"></div>
                    <div id="Viernes" class="schedule-day-div"></div>
                    <div id="Sabado" class="schedule-day-div"></div>
                    <div id="Domingo" class="schedule-day-div"></div>
                </div>

            </div>
        </div>

        
        <div id="openmenubtn">A</div>
        <div id="schedule-menu" class="schedule-menu open">
        

            <div class="schedule-menu-scroll">


                <?php foreach ($horarios as $horario): ?>
                <div class="schedule-option" id="<?= htmlspecialchars($horario['id']) ?>" profesor="<?= htmlspecialchars($horario['profesor']) ?>" dias="<?= htmlspecialchars($horario['dias']) ?>" nombre="<?= htmlspecialchars($horario['asignatura']) ?>">
                    <div class="schedule-option-header">
                        <p style="margin-left:1vw;"><strong><?= htmlspecialchars($horario['asignatura']) ?>:</strong> <span class="schedule-option-pname"></span></p>
                    </div>
                    <div class="schedule-option-body">
                        <div style="width:30%;text-align:left;padding-left:2vh;align-content:center;height:100%;">
                        <p>Sección <?= htmlspecialchars($horario['seccion']) ?></p>
                        <p>Aula <?= htmlspecialchars($horario['aula']) ?></p>
                        </div>
                        <div class="schedule-option-days">
   
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<script>

const starthour = "14:15";
const endhour = "20:25";

let HorarioList = [];

 /**
 * Crea y posiciona una tarea en el horario.
 * @param {string} horaInicio - Formato "HH:MM" (ej: "03:15")
 * @param {string} horaFin - Formato "HH:MM" (ej: "04:45")
 * @param {string} titulo - Nombre de la actividad
 * @param {string} carrilId - El ID del div del día (ej: "lunes-carril")
 */
function agregarTarea(horaInicio, horaFin, titulo, carrilId, Seccion = "", Aula = "") {

    

    // 1. Configuración de escala
    const MINUTOS_INICIO_HORARIO = (14 * 60) + 15; // 2:15 PM en minutos
    const PIXELES_POR_MINUTO = 0.19; // Ajusta esto para estirar/encoger el horario

    // 2. Auxiliar para convertir "HH:MM" a minutos totales
    const convertirAMinutos = (horaStr) => {
        const [horas, minutos] = horaStr.split(':').map(Number);
        return (horas * 60) + minutos;
    };

    const minInicio = convertirAMinutos(horaInicio);
    const minFin = convertirAMinutos(horaFin);

    // 3. Cálculos de posición y tamaño
    const posicionTop = (minInicio - MINUTOS_INICIO_HORARIO) * PIXELES_POR_MINUTO;
    const duracionPx = (minFin - minInicio) * PIXELES_POR_MINUTO;

    // 4. Crear el elemento DOM
    const taskBox = document.createElement('div');
    taskBox.classList.add('task-box'); // Usa los estilos CSS que definimos antes

    // Aplicar estilos dinámicos
    Object.assign(taskBox.style, {
        top: `${posicionTop}vh`,
        height: `${duracionPx}vh`
    });

    taskBox.innerHTML = `<strong>${titulo}</strong><br>Sección: ${Seccion}<br>Aula: ${Aula}<br>${arreglarhora(horaInicio)} - ${arreglarhora(horaFin)}`;

    // 5. Insertar en el carril correspondiente
    const carril = document.getElementById(carrilId);
    if (carril) {
        carril.appendChild(taskBox);
    } else {
        console.error(`No se encontró el carril con ID: ${carrilId}`);
    }
}

function LimpiarHorario(){
document.getElementById("Lunes").textContent = "";
document.getElementById("Martes").textContent = "";
document.getElementById("Miercoles").textContent = "";
document.getElementById("Jueves").textContent = "";
document.getElementById("Viernes").textContent = "";
document.getElementById("Sabado").textContent = "";
document.getElementById("Domingo").textContent = "";
}

async function ActualizarHorario(){

    LimpiarHorario();
    if(profSelected == -1){return;}

    const myid = profSelected.getAttribute("id");

    try {
        const respuesta = await fetch('php/horario/checkhorario.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
                },
            body: JSON.stringify({
            id: myid
                }),
            });

        const resultado = await respuesta.json(); 
        if (resultado.success) {
            const data = Array.from(resultado.data);
            
            HorarioList = data;        

            data.forEach(e => {
                const name = e.asignatura;
                const seccion = e.seccion;
                const aula = e.aula;

                const dias = JSON.parse(e.dias);
                dias.forEach(i => {
                    agregarTarea(i.HoraE,i.HoraS,name,i.Dia,seccion,aula);
                    })
                

                });


            } else {
            alert("respuesta: " + resultado.error);
            }
        } catch (error) {
        console.error("Error al enviar: ", error);
        }  


    }

function arreglarhora(hora){

    let hora24 = hora;
    if(hora.length > 5){hora24 = hora.substring(0, 5)}  

    const fechaTemp = new Date(`1970-01-01T${hora24}:00`);

    return fechaTemp.toLocaleString('en-US', { 
        hour: 'numeric', 
        minute: 'numeric', 
        hour12: true 
        });
    }

document.getElementById('search-prof').addEventListener('input', (e) => {
    refreshProfessorList(e.target.value);
    });

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
refreshProfessorList();

const datosHorarios = document.getElementsByClassName("schedule-option");
const profDatos = <?php echo json_encode($profesores); ?>;;


for (let index = 0; index < datosHorarios.length; index++) {
    const element = datosHorarios[index];

    const myprofid = element.getAttribute("profesor");
    const mydays = JSON.parse(element.getAttribute("dias"));                
    const myid = element.getAttribute("id");

    const namespan = element.querySelector('.schedule-option-pname');
    if(myprofid){
        namespan.textContent = Array.from(profDatos).find((e) => e.id == myprofid).nombre;
        }
    
    const diasdiv = element.querySelector('.schedule-option-days');
    
    mydays.forEach(e => {
        const p = document.createElement("p");

        const strong = document.createElement("strong")
        strong.textContent = e.Dia+": ";
        
        const span = document.createElement("span");
        span.textContent = arreglarhora(e.HoraE) + " - " + arreglarhora(e.HoraS);
        
        p.appendChild(strong);
        p.appendChild(span);

        diasdiv.appendChild(p);
        });

    element.addEventListener("click", async () => {

        const myprofid = element.getAttribute("profesor");
        const nombre = element.getAttribute("nombre");
        let reemplace = -1;

        if(profSelected == -1){return;}

        /*Comprobar que no choque con un horario ya existente*/
        if (HorarioList.length > 0) {
            let continuar = 1;

            mainLoop: 
            for (const element of HorarioList) {
                const HLdias = JSON.parse(element.dias);
                if(element.id != myid){
                    for (const i of HLdias) {
                        for (const j of mydays) {
                            if (j.Dia == i.Dia) {
                                if ((i.HoraE > j.HoraE && i.HoraE < j.HoraS) || 
                                    (i.HoraS > j.HoraE && i.HoraS < j.HoraS) || 
                                    (i.HoraS == j.HoraS && i.HoraE == j.HoraE)) {
                        
                                    continuar = confirm("La materia "+nombre+" choca con " + element.asignatura +" deseas sobreescribirla?");
                                    reemplace = element.id;
                                    break mainLoop; 
                                    }
                                }
                            }
                        }
                    }
                }
            if(!continuar){
                return;
                }
            }

        let newprofid = profSelected.getAttribute("id");

        if(myprofid == newprofid){
            newprofid = "";
            }

        if(myprofid != profSelected.getAttribute("id") && myprofid){
            if(!confirm("Esta sección ya tiene un profesor asignado, deseas sobreescribirlo?")){
                return;
                }
            }


        try {
            const respuesta = await fetch('php/horario/update_prof.php', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                    },
                body: JSON.stringify({
                id: myid,
                prof: newprofid,
                reemplace: reemplace
                    }),
                });

            const resultado = await respuesta.json(); 
            if (resultado.success) {
                if(newprofid){
                    namespan.textContent = profSelected.getAttribute("nombre");
                    element.setAttribute("profesor",profSelected.getAttribute("id"));
                    }else{
                    namespan.textContent = "";
                    element.setAttribute("profesor","");
                    }
                if(reemplace != -1){
                    const section = Array.from(document.getElementsByClassName("schedule-option")).find(e => e.getAttribute("id") == reemplace);
                    section.setAttribute("profesor","");
                    section.querySelector('.schedule-option-pname').textContent = "";
                    }

                    ActualizarHorario();
                } else {
                alert("respuesta: " + resultado.error);
                }
            } catch (error) {
            console.error("Error al enviar: ", error);
            }           

        })

    }

    document.getElementById("openmenubtn").addEventListener("click", () => {

        if(!document.getElementById("schedule-section").classList.contains("open")){
            document.getElementById("schedule-section").classList.add("open");
            document.getElementById("schedule-menu").classList.add("open");
            }else{
            document.getElementById("schedule-section").classList.remove("open");
            document.getElementById("schedule-menu").classList.remove("open");    
            }

        })



</script>


<?php include 'php/extras/footer.php';?>

</body>
</html>