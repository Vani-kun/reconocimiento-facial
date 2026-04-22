<?php
    include "php/conexion.php";

    // 1. Consultamos todos los registros
    $sql = "SELECT id, descriptores, nombre, activo, tags FROM caras ORDER BY activo DESC, nombre ASC";
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
    <link rel="stylesheet" href="css/profesores.css">

    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
        }

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
        width:33%;
        margin-left:5px;
        margin-right:5px;
        }
    .active{
        color: #0F495E;
        }
    .inactive{
        color: #6F868E;
        }
    .invisible {
        display: none;
        height: 0;
        }
    .section-container{
        overflow: clip;
        margin-top: 20px;
        }
    .panel {
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        padding: 2rem;
        }
    .list-panel{
        width:100%;
        float: left;
        height: 80vh;
        }
    .section-container{
        background-color:#D1EAEC;
        }
    </style>

</head>
<body>

<?php include 'php/extras/navbar.php'; ?>

<script>
const safeParse = (data) => {
    if (!data || data.trim() === "") return []; // Si está vacío o es solo espacio, devuelve array vacío
    try {
        return JSON.parse(data);
    } catch (e) {
        console.error("Error parseando JSON:", data);
        return []; // Si el JSON está mal formado, devuelve array vacío para no romper el código
    }
};

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
    const descriptores = safeParse(prof.descriptores);
    const tags = safeParse(prof.tags);

    const profCard = document.createElement('div');

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
    btnChange.classList.add('btn', 'btn-white');
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

                    

    btnChange.addEventListener('click', () => {
        const mySelf = allProfesors[myAllprofesorID];
        openEditor = mySelf;
        addedi(2);
        });
  
    btnDelete.addEventListener('click', () => {  
        if(!confirm("Seguro que quieres eliminar a "+nombre)){return;}
        if(prompt(`Para eliminar a ${nombre}, escribe: ELIMINAR`) != "ELIMINAR"){return;}
        _ID = id;
        BorrarProfesor(_ID);
        });

    allProfesors.push({
        id,
        nombre,
        activo,
        tags,
        descriptores,
        element: profCard,
        idap: myAllprofesorID,
        ep: profAvatar,
        en: strong
        });
    }
</script>

<div class="main-container section-container" style="width:90%; height:90%; justify-self:center; display:flex; flex-direction: column; align-items: center; padding: 20px; margin-left: 5%;">
    <section class="panel list-panel">
        <div class="panel-header input-group" style="width:100%;justify-content:center;">
            <h2>Profesores Registrados</h2>
            <input type="text" placeholder="🔍 Buscar profesor..." id="search-prof" style="width:50%;">
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
            <div class="faces-column">
                <div id="cameraedit" class="oculto">
                    <div class="camera-circle">
                        <video id="video" width="600" height="600" autoplay muted></video>
                        <canvas id="canvas"></canvas>
                    </div>
                    <div style="display:flex">
                    <button class="btn btn-cancel" id="btncancelface" style="width:48%;margin:0 1%;">Cancelar</button>
                    <button class="btn btn-success" id="btnconfirmface" style="width:48%;margin:0 1%;">Confirmar</button>
                    </div>
                </div>
                <div id="allfaces">
                    <fieldset class="scroll-section" id="allfacesfs">
                    </fieldset>
                    <button class="btn btn-change" id="btnaddface" style="width:100%;margin:0;">Añadir rostro</button>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-cancel" id="btnsalir">Cancelar</button>
            <button class="btn btn-success" id="btnguarda">Guardar Profesor</button>
        </div>
    </div>
</div>

<script src="js/carafunciones.js"></script>

<script>

FacesList = [];

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
            allProfesors.some(e => {
                if(e.id == _ID){
                    e.element.remove();
                    return true;
                    }
                });      
            allProfesors.splice(openEditor.idap,1);
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
            const btnToggle = prof.element.querySelector('.btn-white + .btn');
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
            const btnToggle = prof.element.querySelector('.btn-white + .btn');
            btnToggle.classList.add('btn-success');
            btnToggle.textContent = 'Activar';
            if(prof.tags.includes("activo")){
                prof.tags = prof.tags.filter(t => t !== "activo");
                }
            if(!prof.tags.includes("inactivo")){
                prof.tags.push("inactivo");
                }
            }

        fetch('php/profesores/activar_profesor.php', {
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
async function addedi(md)  {
    if (!cargado) {alert("Los modelos de IA aún se están descargando. Por favor, espere.");return;}        
        
    if(md==1){
        cnombre.value="";
        btntags.value="";
        aetag.textContent="Añadir Nuevo";
        FacesList = [];
    }else
    if(md==2){

        if (openEditor==-1){alert("seleccione un profesor") ;return}
        cnombre.value = openEditor.nombre;
        btntags.value = Array.isArray(openEditor.tags) ? openEditor.tags.filter((e) => (e != "activo" && e != "inactivo")).join(", ") : '';
        FacesList = Array.from(openEditor.descriptores);
        }

    refreshFacesList();

    const facem = document.getElementById("allfaces");
    const cameram = document.getElementById("cameraedit");

    if(!cameram.classList.contains("oculto")){
        cameram.classList.add("oculto");
        }

    if(facem.classList.contains("oculto")){
        facem.classList.remove("oculto");
        }    

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
btnguarda.addEventListener('click',()=>{guardar()});

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

    if(FacesList.length == 0){
        alert("Guarda al menos un rostro");
        return;
        }

    if(cnombre.value.trim() == ""){alert("Escribe un nombre");return;}

    const tags = btntags.value.split(',').map(tag => tag.trim());
    let _Page = 'php/profesores/guardar_profesor.php';
    let datosEnvio;

    if(openEditor == -1){
        tags.push("activo")
        datosEnvio = {
            nombre:cnombre.value, 
            tags: tags,
            descriptor: JSON.stringify(FacesList)
            };
        }else{
            _Page = 'php/profesores/actualizar_profesor.php';
            if(openEditor.activo){
                tags.push("activo");
                }else{
                tags.push("inactivo");
                }
            datosEnvio = {
                nombre:cnombre.value, 
                tags: tags,
                id: openEditor.id,
                descriptor: JSON.stringify(FacesList)
                };
            }
    try {
        const respuesta = await fetch(_Page, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datosEnvio)
        });

        const resultado = await respuesta.json(); 
        if (resultado.success) {
            console.log(datosEnvio);
            alert("respuesta: "+ resultado.message);

            if(openEditor==-1){
                CrearCarta(resultado.profesor);
                refreshProfessorList(document.getElementById('search-prof').value);
                }else{
                    openEditor.nombre = cnombre.value;
                    openEditor.tags = tags;
                    openEditor.en.textContent = cnombre.value;
                    openEditor.ep.textContent = cnombre.value.charAt(0).toUpperCase();
                    openEditor.descriptores = FacesList;

                    btntags.value = "";
                    cnombre.value = "";    
                    FacesList = [];
                    openEditor = -1;

                    console.log(allProfesors[openEditor.idap]);
                }

            ventana.style.display = 'none';
            stopCamera(); 
        } else {
            alert("respuesta: " + resultado.error);
        }
    } catch (error) {
        console.error("Error al enviar: ", error);
    }
}
   
document.getElementById('search-prof').addEventListener('input', (e) => {
    refreshProfessorList(e.target.value);
    });

function refreshFacesList(){
    console.log(FacesList);
    const fieldset = document.getElementById("allfacesfs");
    fieldset.textContent = "";

    FacesList.forEach( (element,index) => {
        
        const fb = document.createElement("div");
        fb.classList.add("facebar");

        const p = document.createElement("p");
        p.style = "width:70%;justify-content:left;display:flex;padding-left:10px;";
        p.textContent = "Face "+(index+1);
        
        const btn = document.createElement("div");
        btn.classList.add("facebarbtn");
        btn.textContent = "X";
        btn.addEventListener("click", () => {

            if(!confirm("Seguro que deseas eliminar el rostro "+index)){return;}

                FacesList.splice(index, 1);
                fb.remove();
                

            });

        fb.appendChild(p);
        fb.appendChild(btn);
        fieldset.appendChild(fb);
        });     
    }    

    document.getElementById("btnaddface").addEventListener("click", () => {
        document.getElementById("allfaces").classList.toggle("oculto");
        document.getElementById("cameraedit").classList.toggle("oculto");
        })

    document.getElementById("btncancelface").addEventListener("click", () => {
        document.getElementById("allfaces").classList.toggle("oculto");
        document.getElementById("cameraedit").classList.toggle("oculto");
        })

    document.getElementById("btnconfirmface").addEventListener("click", () => {
        let _Descriptor = descriptorActual;
        if(!_Descriptor){
            alert("ninguna cara detectada");
            }else{
                FacesList.push(_Descriptor);
                refreshFacesList();
                document.getElementById("allfaces").classList.toggle("oculto");
                document.getElementById("cameraedit").classList.toggle("oculto");
            }
        });

        
        
</script>
    
<?php include 'php/extras/footer.php';?>

</body>
</html>
