let descriptorActual = null;
let faceMatcher = null; // El objeto que comparará en tiempo real
let listaPro=[];
let profesorGlobal=null;
let displaySize,ctx;
let video = document.getElementById("video");
const c = document.getElementById("canvas");
let Detex="inicio";
let ttt=0;

enpanelprofesor=false;

let ultimosMarcajes = {}; // Guardará { "Nombre": Timestamp }
let realtime = "00:00:00";
let estatus = document.getElementById("estatus");
let det = document.getElementById("det");
let nodet = document.getElementById("nodet");

let horas =[];
sonar=true;
let opcionesTiny;

// Cargar modelos
async function cargarModelos(){
    const url = './models';
    faceapi.nets.tinyFaceDetector.loadFromUri(url),///opcional solo para tiny
    //await faceapi.loadSsdMobilenetv1Model(url);//pesado para telefonos
    faceapi.loadFaceLandmarkModel(url),
    faceapi.loadFaceRecognitionModel(url)
    // await faceapi.loadFaceExpressionModel(url); 
}
async function cargarCatalogo() {
    const res = await fetch('php/leer.php');
    const respuesta = await res.json();

    if(respuesta.success){
        listaPro=respuesta.usuarios;
        if (listaPro.length === 0) return console.log("Base de datos vacía");

            // Mapeamos para crear el FaceMatcher
            const labels = listaPro.map(u => {
                // 'u.descriptores' es un array de múltiples rostros guardado en la BD

                const arrayDescriptores = JSON.parse(u.descriptores);
                if(Array.isArray(arrayDescriptores)){

                    const MiFaces = arrayDescriptores.map(e => {
                        // Convertimos cada cara guardada a Float32Array
                        if(typeof e === "object" && e !== null){
                            return new Float32Array(Object.values(e));
                            }else{  
                            console.error(`Error con el usuario ${u.nombre} portador de la id ${u.id}: sus descriptores estan corruptos`);
                            }

                        }).filter(Boolean);

                    // Creamos la etiqueta. El primer parámetro es el NOMBRE/ID, 
                    // el segundo es el ARRAY de descriptores (múltiples caras)
                    return new faceapi.LabeledFaceDescriptors(u.id.toString(), MiFaces);
                }else{  
                    console.error(`Error con el usuario ${u.nombre} portador de la id ${u.id}: sus descriptores estan corruptos`);
                }
            }).filter(Boolean);

            // Creamos el comparador global
            // labels contiene: {nombre, [cara1, cara2, cara3...]}
            faceMatcher = new faceapi.FaceMatcher(labels, 0.45); // Usamos 0.45 por seguridad
            console.log("Catálogo y Array listos");
    }else{
        console.log("Error:",respuesta.error);
    }
}
async function iniciarCamara(){
const constraints = {
    video: {
        width: { ideal: 500 },
        height: { ideal: 500 },
        aspectRatio: 1 // Esto le dice al navegador que prefieres un cuadrado
    }
    };
    navigator.mediaDevices.getUserMedia(constraints)
    .then(stream => { video.srcObject = stream; camara=true; })
    .catch(err => console.error("Error al acceder a la cámara:", err));
}

document.addEventListener('DOMContentLoaded',async () => {
    await cargarModelos()
    await cargarCatalogo();
    await iniciarCamara();

    video.addEventListener("play",()=>{
        displaySize = { width: video.videoWidth, height: video.videoHeight };
        faceapi.matchDimensions(c, displaySize);
        
        ctx = c.getContext('2d');ctx.translate(displaySize.width, 0);ctx.scale(-1, 1);

        opcionesTiny = new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 });
        setInterval(proceso,500);
    });

    ///
    const savedTheme = localStorage.getItem('tema');
    if (savedTheme) {applyTheme(savedTheme);} else {applyTheme('basic'); }
    
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
async function proceso(){           ttt--;       
    const datos = await faceapi.detectSingleFace(video, opcionesTiny)
    .withFaceLandmarks().withFaceDescriptor();
    ctx.clearRect(0, 0, c.width, c.height);
    if (!datos) {detecta("no");return;}

    actualmenteViendoCara = true;
    const resizedDetections = faceapi.resizeResults(datos, displaySize);

    ///logica d detectar y comparar
    if (datos.detection.score > 0.5){
        faceapi.draw.drawDetections(c, resizedDetections);
        faceapi.draw.drawFaceLandmarks(c, resizedDetections);
    }
    if (faceMatcher){ 
        descriptorActual = datos.descriptor; 
        const match = faceMatcher.findBestMatch(descriptorActual,0.45);

        if (match.label !== 'unknown' && match.distance < 0.45) {
            traerDatos(match);
            detecta("si");
            
        } else {
            // Si la distancia es alta (ej. 0.65), se trata como desconocido aunque se parezca a alguien
            detecta("no");
        }
    }
}
