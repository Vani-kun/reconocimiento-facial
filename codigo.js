
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
    const res = await fetch('php/leer.php');
    const usuarios = await res.json();
    if (usuarios.length === 0) return console.log("Base de datos vacía");
    // Convertimos cada usuario de la BD a descriptores etiquetados
    const labels = usuarios.map(u => 
        new faceapi.LabeledFaceDescriptors(u.nombre, [new Float32Array(JSON.parse(u.descriptor))])
    );
    // Creamos el comparador global (umbral 0.6)
    faceMatcher = new faceapi.FaceMatcher(labels, 0.6);
    console.log("Catálogo M.A.R.S. listo");
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
        if (faceMatcher) {
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
        }
    } else {
        descriptorActual = null;
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
