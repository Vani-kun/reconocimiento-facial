let ultimosMarcajes = {}; // Guardará { "Nombre": Timestamp }
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
const c = document.getElementById("canva");
let estatus = document.getElementById("estatus");
let det = document.getElementById("det");
let nodet = document.getElementById("nodet");
let displaySize,ctx;
let horas =[];
sonar=true;
video.addEventListener("play",()=>{
    displaySize = { width: video.videoWidth, height: video.videoHeight };
    faceapi.matchDimensions(c, displaySize);
    
    ctx = c.getContext('2d');
    ctx.translate(displaySize.width, 0);
    ctx.scale(-1, 1);
    setInterval(proceso,100);
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


//la camara
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

    console.log("aca")

    try {
    const res = await fetch('php/asistencia.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            id: Profesor.id,
            nombre: Profesor.nombre,
            hora: document.getElementById('reloj').textContent,
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
        sonido(1);
        ultimosMarcajes[Profesor.id] = Date.now(); 
        if(respuesta.estado == 1 || respuesta.estado == 2){
        document.getElementById("detected-state").textContent = respuesta.message;
        document.getElementById("detected-hour").textContent = respuesta.hora;
        document.getElementById("detected-name").textContent = Profesor.nombre;
        document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");

        }else if(respuesta.estado == 3 || respuesta.estado == 4){

        document.getElementById("detected-state").textContent = "⚠️ " + respuesta.message;
        document.getElementById("detected-name").textContent = Profesor.nombre;
        document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");

        }else if(respuesta.estado == 5){
            document.getElementById("detected-name").textContent = Profesor.nombre;
            document.getElementById("detected-state").textContent = respuesta.message;
            document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");
        }

        document.getElementById("schedule-menu-scroll").textContent = "";

        respuesta.horarios.forEach(e => {
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
                    JSON.parse(e.dias).forEach(i => {
    htmltext += `<p><strong>${i.Dia}:</strong><span>${arreglarhora(i.HoraE)} - ${arreglarhora(i.HoraS)}</span></p>`
                        });
                    
            htmltext += `</div>
                    </div>
                </div>`;
        newHorario.innerHTML = htmltext;

        document.getElementById("schedule-menu-scroll").appendChild(newHorario);
        });

    } else {
        console.log(respuesta.horarios);
        // Aquí se mostrará el mensaje de "Faltan X minutos"
        console.warn(respuesta.error);
        document.getElementById("detected-state").textContent = "⚠️ " + respuesta.error;
        document.getElementById("detected-name").textContent = Profesor.nombre;
        document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");
        // Opcional: sonido de error
        sonido(0); 
    }
} catch (error) {
    console.error("Error detallado:", error);
}
}

//la captura de rostro a travez de la camara
async function proceso(){                
    const opcionesTiny = new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 });
    const datos = await faceapi.detectAllFaces(video,opcionesTiny)     
    .withFaceLandmarks()    
    .withFaceDescriptors()
    if (datos.length > 0) {
        descriptorActual = datos[0].descriptor; 
       
       if (faceMatcher) {
        const match = faceMatcher.findBestMatch(descriptorActual,0.7);
       if (match.label !== 'unknown') {
            const mydata = JSON.parse(match.label);
            if(!det.classList.contains("active")){
                    det.classList.add("active")
                    }
            nodet.classList.remove("active");
            btn.disabled = true;
            
            const ahora = Date.now();
            const cincoMinutos = 10 * 1000;

            if (ultimosMarcajes[mydata.id]) {
                const tiempoTranscurrido = ahora - ultimosMarcajes[mydata.id];
                if (tiempoTranscurrido < cincoMinutos) {
                    return; 
                }
            }

            intentarAsistencia(mydata);
            
            estatus.textContent = mydata.nombre;
        }else{
                det.classList.remove("active")     
                if(!nodet.classList.contains("active")){
                    nodet.classList.add("active")
                    }
                btn.disabled = true;//if(sonar){sonido(1);sonar=false}
                estatus.textContent = "---";
            }
        }
    } 
    //debug
   // console.log(datos);
    //reescala antes de dibujar
    const resizedDetections = faceapi.resizeResults(datos, displaySize);
    ctx.clearRect(0, 0, c.width, c.height);
    //dibujar
    faceapi.draw.drawDetections(c,resizedDetections);//datos
    faceapi.draw.drawFaceLandmarks(c, resizedDetections);
    //faceapi.draw.drawFaceExpressions(c, datos);
}

function actualizarReloj() {
    const ahora = new Date();
    
    // Obtenemos horas, minutos y segundos
    let horas = ahora.getHours();
    let minutos = ahora.getMinutes();
    let segundos = ahora.getSeconds();
    let m = "AM";

    // Formateo: Si el número es menor a 10, le agregamos un "0" a la izquierda
    // Ejemplo: 9:5:2 -> 09:05:02
    horas = horas < 10 ? '0' + horas : horas;
    minutos = minutos < 10 ? '0' + minutos : minutos;
    segundos = segundos < 10 ? '0' + segundos : segundos;


    if(horas > 12){
        horas -= 12;
        m = "PM";
    }

    // Juntamos todo en un string
    const tiempoString = `${horas}:${minutos}:${segundos} ${m}`;

    // Lo escribimos en el div
    document.getElementById('reloj').textContent = tiempoString;
}

// Llamamos a la función una vez al principio para que no empiece en blanco
actualizarReloj();

// Configuramos el intervalo para que se ejecute cada segundo
setInterval(actualizarReloj, 1000);

function arreglarhora(hora){

            let hora24 = hora;
            if(hora.length > 5){hora24 = hora.substring(0, 5)}  

            // Creamos un objeto Date falso para poder formatearlo
            // (Usamos una fecha cualquiera, lo importante es la hora)
            const fechaTemp = new Date(`1970-01-01T${hora24}:00`);

            return fechaTemp.toLocaleString('en-US', { 
            hour: 'numeric', 
            minute: 'numeric', 
            hour12: true 
            });
        }