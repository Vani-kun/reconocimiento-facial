
<style>
/* --- BASE DEL PANEL --- */
.overlay-panel {
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background-color: rgba(0, 0, 0, 0);
    z-index: 99;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.5s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.overlay-panel.hidden {
    transform: translateX(-100%);
    opacity: 0;
    visibility: hidden;
}

/* --- FONDO GEOMÉTRICO (3 PUNTAS: Superior, Medio, Inferior) --- */
.geometric-background {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: linear-gradient(135deg, #ffffff 0%, #1a252f 100%);
    /* 5 puntos definen las 3 puntas: Esquina Sup, Punta Central, Esquina Inf */
    clip-path: polygon(0% 0%, 25% 0%, 45% 50%, 25% 100%, 0% 100%);
    z-index: 1;
    transition: clip-path 0.5s ease-in-out;
}

/* --- CONTENEDOR DE CÁMARA --- */
#camera-wrapper {
    position: absolute;
    z-index: 5;
    transition: all 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    display: flex;
    justify-content: center;
    align-items: center;
}

.camera-center { left: 50%; transform: translate(-50%, 0); }
.camera-left   { left: 33%; transform: translate(-50%, 0); }
.camera-left2  { left: 0%;  transform: translate(-100%, 0); }

.main-circle {
    width: 450px;
    height: 450px;
    border-radius: 50%;
    background-color: #34495e;
    border: 8px solid #ecf0f1;
    box-shadow: 0 0 50px rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    font-weight: bold;
}

.panel-controls {
    position: absolute;
    bottom: 50px;
    display: flex;
    gap: 15px;
    z-index: 20;
}

.panel-controls button {
    padding: 10px 25px;
    background: #3498db;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}
.deteccion {position: relative;top: 60%;}
.deteccion{color: red;text-shadow: 0 0 10px red;}
.deteccion.si{color: #00ff22;text-shadow: 0 0 10px #00ff22;}
#video{transform: scaleX(-1);z-index: 10; }
#video, #canvas {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover; 
    top: 0;
    left: 0;
    border-radius: 50%;
}
#canvas {
    position: absolute; 
    top: 0;
    left: 0;
    pointer-events: none; 
    z-index: 99; 
}


</style>

<!-- Botón para abrir el panel -->
<!--button id="open-panel-btn" style="position:fixed; top:20px; right:20px; z-index:100; padding: 10px 20px; cursor:pointer;">Abrir Dashboard</button-->

<div id="full-screen-panel" class="overlay-panel ">
    <div class="geometric-background"></div>
    
    <!--div class="panel-controls">
        <button onclick="moveCamera('hide')">Ocultar Cámara</button>
        <button onclick="moveCamera('left')">Izquierda</button>
        <button onclick="moveCamera('center')">Centro</button>
         <button onclick="moveCamera('ocultar')">Ocultar</button>
        
    </div-->
    
    <div id="camera-wrapper" class="camera-center">
        <div class="main-circle">
            <video id="video" width="250" height="250" autoplay muted></video>
            <canvas id="canvas" width="250" height="250"></canvas>
            <span class="deteccion" id="deteccion">● DETECTADO</span>
        </div>
    </div>
</div>


<script>
    function detecta(s){
        dt=document.getElementById("deteccion");
        if(s=="si"){dt.classList.add("si");dt.textContent="● DETECTADO";}
        else
        if(s=="no"){dt.classList.remove("si");dt.textContent="● NO DETECTADO";}
    }
function toggleFullScreenPanel() {
    const panel = document.getElementById('full-screen-panel');
    panel.classList.toggle('hidden');
    document.body.style.overflow = panel.classList.contains('hidden') ? '' : 'hidden';
}

function moveCamera(position) {
    const wrapper = document.getElementById('camera-wrapper');
    const bg = document.querySelector('.geometric-background');
    
    wrapper.className = '';
    
    if (position === 'left') {
        wrapper.classList.add('camera-left');
        // 3 puntas encogidas
        bg.style.clipPath = "polygon(0% 0%, 15% 0%, 30% 50%, 15% 100%, 0% 100%)";
    } else if (position === 'center') {
        wrapper.classList.add('camera-center');
        // 3 puntas normales
        bg.style.clipPath = "polygon(0% 0%, 25% 0%, 45% 50%, 25% 100%, 0% 100%)";
    } else if (position === 'hide') {
        wrapper.classList.add('camera-left2');
        // Aplastado (todos los puntos X en 0%)
        bg.style.clipPath = "polygon(0% 0%, 0% 0%, 0% 50%, 0% 100%, 0% 100%)";
    }else if (position === 'ocultar') {
        document.getElementById('full-screen-panel').classList.toggle('hidden');
    }
}
//document.getElementById('open-panel-btn').addEventListener('click', toggleFullScreenPanel);
</script>