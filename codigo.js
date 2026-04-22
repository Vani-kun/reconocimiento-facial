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
        usuarios.forEach(u => {
            // Creamos un objeto que combina la IA con tus datos de negocio
            const elemento = {
                id: u.id,
                nombre: u.nombre
                };
            // Lo agregamos a nuestro nuevo array
            horas.push(elemento);
            });
    // Convertimos cada usuario de la BD a descriptores etiquetados
    const labels = usuarios.map(u => {
        const MiFaces = JSON.parse(u.descriptores).map(e => {
            return new Float32Array(Object.values(e));
            });

        return new faceapi.LabeledFaceDescriptors(u.nombre, MiFaces)
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
async function intentarAsistencia(nombreProfesor) {
    const ahora = Date.now();
    const cincoMinutos = 5 * 60 * 1000;

    // VALIDACIÓN DE TIEMPO (Escudo de 5 minutos)
    if (ultimosMarcajes[nombreProfesor]) {
        const tiempoTranscurrido = ahora - ultimosMarcajes[nombreProfesor];
        if (tiempoTranscurrido < cincoMinutos) {
            const segundosRestantes = Math.ceil((cincoMinutos - tiempoTranscurrido) / 1000);
            estatus.textContent = `Espere ${segundosRestantes} seg para registrar salida`;
            return; 
        }
    }

    try {
    const res = await fetch('php/asistencia.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            nombre: nombreProfesor,
            hora: document.getElementById('reloj').textContent
        })
    });

    // 1. Primero obtenemos el texto plano
    const textoRaw = await res.text();
    console.log("Respuesta bruta del servidor:", textoRaw);
    //alert(textoRaw);

    // 2. Intentamos convertirlo manualmente
    if (!textoRaw) {
        console.error("El servidor devolvió una respuesta vacía.");
        return;
    }

    const respuesta = JSON.parse(textoRaw);
    if (respuesta.success) {
        alert(respuesta.message);
        ultimosMarcajes[nombreProfesor] = Date.now(); 
    } else {
        // Aquí se mostrará el mensaje de "Faltan X minutos"
        console.warn(respuesta.error);
        estatus.textContent = respuesta.error; 
        alert("⚠️ " + respuesta.error); 
        // Opcional: sonido de error
        sonido(0); 
    }
} catch (error) {
    console.error("Error detallado:", error);
}
}

//la captura de rostro a travez de la camara
async function proceso(){                
    //detectar
    const opcionesTiny = new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 });
    const datos = await faceapi.detectAllFaces(video,opcionesTiny)     
    .withFaceLandmarks()    
    .withFaceDescriptors()
    //.withFaceExpressions(); 
    if (datos.length > 0) {
        descriptorActual = datos[0].descriptor; 
       
        // --- DETECCIÓN CONSTANTE ---
        /*if (faceMatcher) {
            const match = faceMatcher.findBestMatch(descriptorActual,0.7);
            ///const text = match.label === 'unknown' ? "Desconocido" : match.label;
            if(match.label==='unknown'){
                det.classList.remove("active")     
                nodet.classList.add("active")  
                 btn.disabled = false; if(!sonar){sonido(0);sonar=true}  
            }else{
                det.classList.add("active")     
                nodet.classList.remove("active")
                btn.disabled = true;if(sonar){sonido(1);sonar=false}
            }
            estatus.textContent=match.label;
        }*/
       if (faceMatcher) {
        const match = faceMatcher.findBestMatch(descriptorActual,0.7);
       if (match.label !== 'unknown') {
            det.classList.add("active");
            nodet.classList.remove("active");
            btn.disabled = true;
            
            if (sonar) { 
                sonido(1); 
                sonar = false; 
                // Intentar registrar asistencia automáticamente al reconocer
                intentarAsistencia(match.label);
            }
            estatus.textContent = match.label;
        }else{
                det.classList.add("active")     
                nodet.classList.remove("active")
                btn.disabled = true;//if(sonar){sonido(1);sonar=false}
                sonar = true; // Al ser desconocido, permitimos que el sistema vuelva a intentar detectar
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

    // Formateo: Si el número es menor a 10, le agregamos un "0" a la izquierda
    // Ejemplo: 9:5:2 -> 09:05:02
    horas = horas < 10 ? '0' + horas : horas;
    minutos = minutos < 10 ? '0' + minutos : minutos;
    segundos = segundos < 10 ? '0' + segundos : segundos;

    // Juntamos todo en un string
    const tiempoString = `${horas}:${minutos}:${segundos}`;

    // Lo escribimos en el div
    document.getElementById('reloj').textContent = tiempoString;
}

// Llamamos a la función una vez al principio para que no empiece en blanco
actualizarReloj();

// Configuramos el intervalo para que se ejecute cada segundo
setInterval(actualizarReloj, 1000);