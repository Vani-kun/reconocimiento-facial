// Cargar modelos
async function cargarModelos(){
    const url = './models';

    // Usamos Promise.all para cargar todo en paralelo y más rápido
    await Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri(url),
        faceapi.nets.faceLandmark68Net.loadFromUri(url), // <--- ESTO FALTABA
        faceapi.nets.faceRecognitionNet.loadFromUri(url) // Sintaxis más moderna
    ]);
    
    cargado = true;
    console.log("Modelos cargados con éxito");
}
async function proceso(){                
    // 1. Validar que el video esté emitiendo datos
    if (video.paused || video.ended || !cargado) return;

    // 2. Detectar
    const opc = new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 });
    const datos = await faceapi.detectSingleFace(video, opc)   
        .withFaceLandmarks()
        .withFaceDescriptor();
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    if (datos) {
        descriptorActual = datos.descriptor; 
        const resizedDetections = faceapi.resizeResults(datos, displaySize);
        
        // 5. Dibujar
        faceapi.draw.drawDetections(canvas, resizedDetections);
        faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
    }else {
        descriptorActual = null;
    }
}