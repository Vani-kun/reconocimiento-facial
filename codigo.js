let ultimosMarcajes = {}; // Guardará { "Nombre": Timestamp }
let realtime = "00:00:00";
// Cargar modelos
function cargarModelos(){
    const url = './models';
    return[
    faceapi.nets.tinyFaceDetector.loadFromUri(url),///opcional solo para tiny
    //await faceapi.loadSsdMobilenetv1Model(url);//pesado para telefonos
    faceapi.loadFaceLandmarkModel(url),
    faceapi.loadFaceRecognitionModel(url)
    // await faceapi.loadFaceExpressionModel(url); 
    ]
}
Promise.all(cargarModelos()).then(async ()=>{
    await cargarCatalogo();
    iniciarCamara();
});
let descriptorActual = null;
let faceMatcher = null; // El objeto que comparará en tiempo real

let video = document.getElementById("video");
const c = document.getElementById("canvas");
let estatus = document.getElementById("estatus");
let det = document.getElementById("det");
let nodet = document.getElementById("nodet");
let displaySize,ctx;
let horas =[];
sonar=true;
let opcionesTiny;
document.addEventListener('DOMContentLoaded', () => {
    if(c){
    video.addEventListener("play",()=>{
        displaySize = { width: video.videoWidth, height: video.videoHeight };
        faceapi.matchDimensions(c, displaySize);
        
        ctx = c.getContext('2d');
        ctx.translate(displaySize.width, 0);
        ctx.scale(-1, 1);
        opcionesTiny = new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 });
        setInterval(proceso,100);
    });}else{alert("no existe el canvas")}
});

function sonido(tipo) {
    const d = document.getElementById('detect');
    const nd = document.getElementById('nodetect');

    if (tipo === 1) {
        d.currentTime = 0; // Reinicia el sonido por si suena muchas veces
        d.play().catch(e => console.log("Esperando interacción del usuario..."));
        } else {
            nd.currentTime = 0;
            nd.play().catch(e => console.log("Esperando interacción del usuario..."));
            }
    }
const btn = document.getElementById("btn");
btn.addEventListener('click',guardar);

async function guardar(){
    if (!descriptorActual) {
        alert("No se ha detectado ningún rostro.");
        return;
    }
    // COMPARACIÓN BIOMÉTRICA (Evita duplicados)
    const coincidencia = await Buscar();
    
    // Si la IA reconoce la cara (distancia menor a 0.6)
    if (coincidencia && coincidencia.label !== 'unknown') {
        alert(`Este rostro ya está registrado como: ${coincidencia.label}`);
        return; // Detiene el proceso, no guarda nada
    }

    // Convertimos el Float32Array a un array normal y luego a JSON
    const datosEnvio = {
        nombre: prompt("Nombre",""), 
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
            await cargarCatalogo();
            alert("respuesta: "+ resultado.message);
        } else {
            alert("respuesta: " + resultado.error);
        }
    } catch (error) {
        console.error("Error al enviar: ", error);
    }
}
async function Buscar() {
if (!descriptorActual || !faceMatcher) return null;
    // Comparamos usando el catálogo que ya está en memoria
    return faceMatcher.findBestMatch(descriptorActual,0.7);
}
async function cargarCatalogo() {
    //faceMatcher.labeledDescriptors[0]._label
    const res = await fetch('php/leer.php');
    const respuesta = await res.json();
    if(respuesta.success){
    const usuarios = respuesta.usuarios;
    if (usuarios.length === 0) return console.log("Base de datos vacía");

    // Convertimos cada usuario de la BD a descriptores etiquetados
    const labels = usuarios.map(u => {
        const MiFaces = JSON.parse(u.descriptores).map(e => {
            return new Float32Array(Object.values(e));
            });

        return new faceapi.LabeledFaceDescriptors(JSON.stringify({id: u.id,nombre: u.nombre,tags: u.tags}), MiFaces)
        });

        // Creamos el comparador global (umbral 0.6)
        faceMatcher = new faceapi.FaceMatcher(labels, 0.6);
        console.log("Catálogo M.A.R.S. listo");
        }else{
            console.log("Error:",respuesta.error);
            }
}
async function iniciarCamara(){
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
async function intentarAsistencia(Profesor) {

    /*
    Esta función registra la asistencia al servidor
    */
    console.log(realtime)

    try {
    const res = await fetch('php/asistencia.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            id: Profesor.id,
            nombre: Profesor.nombre,
            hora: realtime,
            threshold: 20//Tiempo de gracia para llegar tarde (en minutos)
        })
    });

    // 1. Primero obtenemos el texto plano
    const textoRaw = await res.text();
    //console.log("Respuesta bruta del servidor:", textoRaw);
    //alert(textoRaw);

    // 2. Intentamos convertirlo manualmente
    if (!textoRaw) {
        console.error("El servidor devolvió una respuesta vacía.");
        return;
    }

    const respuesta = JSON.parse(textoRaw);
    if (respuesta.success) {
        //Si pudo registrar correctamente hace el sonido y marca en la lista 
        // para no poder volver a registrar al mismo profesor almenos 10 segundos despues
        // (En el servidor el profesor no puede marcar hasta 5 minutos despues.)
        sonido(1);
        ultimosMarcajes[Profesor.id] = Date.now(); 


        if(respuesta.estado == 1 || respuesta.estado == 2){//Si registro entrada o salida correctamente
        document.getElementById("detected-state").textContent = respuesta.message;
        document.getElementById("detected-hour").textContent = arreglarhora(respuesta.hora);
        document.getElementById("detected-name").textContent = Profesor.nombre;
        document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");

        }else if(respuesta.estado == 3 || respuesta.estado == 4){//Si hubo alguna advertencia (no necesariamente error)

        document.getElementById("detected-state").textContent = "⚠️ " + respuesta.message;
        document.getElementById("detected-name").textContent = Profesor.nombre;
        document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");

        }else if(respuesta.estado == 5){//Si el profesor no tiene ninguna materia asignada para el dia de hoy
            document.getElementById("detected-name").textContent = Profesor.nombre;
            document.getElementById("detected-state").textContent = respuesta.message;
            document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");
        }

        document.getElementById("schedule-menu-scroll").textContent = "";
        //Se agarra el div donde se muestran las fichas de las materias

        respuesta.horarios.forEach(e => {//Por cada materia que agarre el servidor
            const newHorario = document.createElement("div");
            let htmltext = `
                <div class="schedule-option">
                    <div class="schedule-option-header">
                        <p style="margin-left:1vw;"><strong>${e.asignatura}</strong></p>
                    </div>
                    <div class="schedule-option-body">
                        <div class="schedule-option-otherinfo">
                        <p>Sección ${e.seccion}</p>
                        <p>Aula ${e.aula}</p>
                        </div>
                        <div class="schedule-option-days">`
                    JSON.parse(e.dias).forEach(i => {//Luego cada materia puede tener varios dias configurados, 
                    // esto dice que por cada dia que tenga configurada la materia va a mostrar la hora y el dia
    htmltext += `<p><strong>${i.Dia}:</strong><span>${arreglarhora(i.HoraE)} - ${arreglarhora(i.HoraS)}</span></p>`
                        });
            htmltext += `</div>
                    </div>
                </div>`;
        newHorario.innerHTML = htmltext;

        document.getElementById("schedule-menu-scroll").appendChild(newHorario);//Aca se agrega al apartado donde van las fichas
        });

    } else {//Si hay error
        console.log(respuesta.horarios);
        // Aquí se mostrará el mensaje de "Faltan X minutos"
        console.warn(respuesta.error);
        document.getElementById("detected-state").textContent = "⚠️ " + respuesta.error;
        document.getElementById("detected-name").textContent = Profesor.nombre;
        document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");
        // Opcional: sonido de error
        sonido(0); 
    }
} catch (error) {//Si hay mas errores
    console.error("Error detallado:", error);
}
}
async function proceso(){                  
    const datos = await faceapi.detectSingleFace(video, opcionesTiny)
    .withFaceLandmarks()
    .withFaceDescriptor();

    if (!datos) {return;}

    ///aqui se dibuja
    ctx.clearRect(0, 0, c.width, c.height);
    const resizedDetections = faceapi.resizeResults(datos, displaySize);
    faceapi.draw.drawDetections(c, resizedDetections);
    faceapi.draw.drawFaceLandmarks(c, resizedDetections);

    ///logica d detectar y comparar
    if (datos) {
        descriptorActual = datos.descriptor; 
       if (faceMatcher) {
        const match = faceMatcher.findBestMatch(descriptorActual,0.7);
        if (match.label !== 'unknown') {
                const mydata = JSON.parse(match.label);
                detecta("si");
                
                ///esto lo desconosco imagino  q  es algo para la asistencai
                const ahora = Date.now();
                const cincoMinutos = 10 * 1000;
                if (ultimosMarcajes[mydata.id]) {
                    const tiempoTranscurrido = ahora - ultimosMarcajes[mydata.id];
                    if (tiempoTranscurrido < cincoMinutos) {
                        return; 
                    }
                }
                intentarAsistencia(mydata);
                //estatus.textContent = mydata.nombre;
            }else{
                    detecta("no");    
                    //estatus.textContent = "---";
            }
        }
    } 
}
