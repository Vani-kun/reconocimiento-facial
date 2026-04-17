// Variables de control de estado
let cargado = false;

// Función única y unificada para M.A.R.S.
async function cargarModelos() {
    // Definimos la ruta de los modelos (asegúrate de que existe en C:\xampp\htdocs\reconocimiento-facial\models)
    let url = '/reconocimiento-facial/models'; 

    try {
        console.log("⏳ M.A.R.S. - Intentando cargar modelos de inteligencia facial desde:", url);
        
        // Carga simultánea de los 3 modelos necesarios
        await Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri(url),
            faceapi.nets.faceLandmark68Net.loadFromUri(url),
            faceapi.nets.faceRecognitionNet.loadFromUri(url)
        ]);
        
        cargado = true;
        console.log("✅ M.A.R.S. - ¡SISTEMA LISTO!");
        
        // Encendemos la cámara automáticamente al terminar
        if (typeof startVideo === 'function') {
            startVideo();
        } else {
            console.warn("⚠️ La función startVideo no existe o no se ha cargado aún.");
        }
        
    } catch (error) {
        console.error("❌ Fallo crítico en M.A.R.S.:", error);
        // Si la ruta absoluta falla, intentamos una vez más con la ruta relativa como backup
        console.log("🔄 Reintentando con ruta relativa (./models)...");
        try {
            await Promise.all([
                faceapi.nets.tinyFaceDetector.loadFromUri('./models'),
                faceapi.nets.faceLandmark68Net.loadFromUri('./models'),
                faceapi.nets.faceRecognitionNet.loadFromUri('./models')
            ]);
            cargado = true;
            console.log("✅ M.A.R.S. - Sistema cargado (ruta relativa).");
            startVideo();
        } catch (e) {
            console.error("❌ Fallo definitivo: No se encuentran los modelos en ninguna ruta.");
        }
    }
}