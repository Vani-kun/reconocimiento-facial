<!--########################################LaAsistencia################################################3-->
<style>
    /* Posicionamiento en la mitad derecha */
.profe-info {
    position: fixed;
    right: 10%;
    top: 50%;
    transform: translateY(-50%); /* Centrado vertical */
    width: 500px;
    background: var(--newpoligono);
    color:var(--newletras);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    text-align: center;
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    z-index: 1000;
    opacity: 1;
}

/* Estado cuando está oculto (desplazado hacia abajo y transparente) */
.profe-info.hidden {
    transform: translateY(-50vh); /* Se va hacia el fondo de la pantalla */
    opacity: 0;
    pointer-events: none;
}

/* El círculo con la letra */
.avatar-circle {
    width: 80px;
    height: 80px;
    background: var(--newprima);
    color: white;
    font-size: 40px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 15px;
    text-transform: uppercase;
    overflow: hidden;
}
#profNombre{
    margin-bottom:5px;
}
.asistencia {
    margin-top: 15px;
    font-size: 0.9em;
}

.estado {
    color: #2ecc71; /* Verde para asistencia */
    display: block;
}
.btn-primary{
position: fixed;
    left: 5%;
    top: 5%;
    z-index: 10000;
}
.status-badge {
            margin-top: 25px;
            display: inline-block;
            padding: 8px 15px;
            background: var(--newnucle);
            color: var(--newsecu);
            border-radius: 5px;
            font-size: 1em;
        }
</style>

<style>
    :root {
        --neon-entrada: #00ff88;
        --neon-laborando: #00d2ff;
        --neon-salida: #ff4d4d;
        --line-color: rgba(255, 255, 255, 0.1);
    }

    .status-card {
        background: rgba(20, 25, 35, 0.5);
        backdrop-filter: blur(12px);
        border: 2px solid var(--newsecu);
        border-radius: 15px;
        padding: 20px;
        width: 100%;
        max-width: 400px;
        color: white;
        font-family: 'Segoe UI', sans-serif;
    }

    /* --- PARTE SUPERIOR (Labels) --- */
    .status-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.8;
    }

    .status-header div {
        flex: 1;
        text-align: center;
    }

    /* --- LÍNEA DE TIEMPO (Iconos y Conectores) --- */
    .timeline-container {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
    }

    /* La línea del fondo */
    .timeline-line {
        position: absolute;
        top: 30%;
        left: 10%;
        right: 10%;
        height: 3px;
        background: var(--line-color);
        z-index: 1;
        pointer-events: none; /* Como aprendimos, para que no interfiera */
    }

    .step {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .step i {
        background: #1a1f2b;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--line-color);
        transition: all 0.3s ease;
    }

    .step span {
        font-size: 0.7rem;
        font-weight: bold;
    }

    /* Estados Activos */
    .step.active.entrada i { border-color: var(--neon-entrada); color: var(--neon-entrada); box-shadow: 0 0 10px var(--neon-entrada); }
    .step.active.laborando i { border-color: var(--neon-laborando); color: var(--neon-laborando); box-shadow: 0 0 10px var(--neon-laborando); }
    .step.active.salida i { border-color: var(--neon-salida); color: var(--neon-salida); box-shadow: 0 0 10px var(--neon-salida); }

</style>

<!--style>
    .content-box.hidden {
        display: none !important;
        /* Estado inicial: oculto */
        max-height: 0;
        opacity: 0;
    }
    #typewriter-text {
        /* Tipografía y Visibilidad */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 2rem;         /* Tamaño grande para que sea muy visible */
        font-weight: 800;          /* Texto extra negrita */
        color:var(--newletras);            /* Color casi negro para mayor contraste */
        /* Altura y Espaciado */
        line-height: 1.6;          /* Aumenta la altura entre líneas */
        letter-spacing: 0.5px;     /* Separa un poco las letras para legibilidad */
        /* Centrado y contenedor */
        text-align: center;
        margin-bottom: 20px;
        display: block;            /* Asegura que ocupe su propia línea */
    }
    /* Animación de cursor titilando */
    #typewriter-text::after {
        content: "|";
        animation: blink 0.7s infinite;
    }
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }
    .content-box {
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
        /* 1. ELIMINAR min-height o ponerlo en 0 */
        min-height: 0;   
        /* 2. Estado inicial (Cerrado) */
        max-height: 0;
        opacity: 0;
        padding: 0 20px; /* Padding vertical en 0 para que colapse */
        transform: scale(0.95);
        /* 3. Una sola transición para todo */
        transition: all 0.5s ease-in-out;
        /* Estética */
        border-radius: 20px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    /* 4. Estado activo (Abierto) */
    .content-box.active {
        max-height: 300px; /* Un valor alto que cubra tu texto */
        opacity: 1;
        padding: 40px 20px; /* Aquí recuperas el espacio interno */
        transform: scale(1);
    }
</style-->

<!-- Botón para controlar el panel --><!--style="display:none  hidden"-->
<button id="btnTogglee" class="btn-primary " style="display:none"  >Ver Profesor</button>
<!-- Botón que activa la bienvenida >
<button id="btn-bienvenida" class=" btn-primary " style="top:64px" onclick="saludo('entrada' )">
    Registrar Entrada
</button>
<-- Botón que activa la salidad >
<button id="btn-bienvenida" class=" btn-primary " style="top:128px" onclick="saludo('salida')">
    Registrar Salida
</button-->

<!-- Contenedor de información -->
<div id="profesorrPanel" class="profe-info hidden">

    <!-- Div Encabezado -->
    <div id="info-div" class="content-box active">
        <div id="profCirculo"class="avatar-circle">A</div>
        <h2 id="profNombre">Nombre del Profesor</h2>
        <p  id="profTags"class="especialidad">Especialidad: Reconocimiento Facial</p>
    </div>
    <!-- Div Mensajes dinámicos -->
    <div id="message-div" class="content-box ">
        <h2 id="typewriter-text"></h2>
    </div>





    <hr>
    <div class="asistencia">
        <div><strong>Entrada:</strong><span id="entrada"> 6:00 AM</span></div>
        <div><strong>Salida:</strong> <span id="salida">12:00 PM</span></div>
        <div class="status-badge estado" style="margin-bottom: 20px;">Estado de Asistencia: <span id="estado">Sin registro-En turno-Finalizada</span></div>

    
        <!--div class="status-card">
            <-- Fila Superior: Labels >
            <div class="status-header">
                <div>Entrada</div>
                <div style="color: var(--neon-laborando)">Estado</div>
                <div>Salida</div>
            </div>
            <-- Fila Inferior: Timeline >
            <div class="timeline-container">
                <div class="timeline-line"></div>
                <div class="step active entrada">
                    <i class="fa-solid fa-user-clock"></i>
                    <span id="entrada"> 6:00 AM</span>
                </div>
                <div class="step active laborando">
                    <i class="fa-solid fa-person-digging"></i>
                    <span>ACTIVO</span>
                </div>
                <div class="step salida">
                    <i class="fa-solid fa-person-booth"></i>
                    <span id="salida">12:00 PM</span>
                </div>
            </div>
        </div-->

    </div>

        <!-- panel de horarios -->
        <div style="border-radius:5vh;display:block;margin-left:1vw;">
            <div style="overflow: hidden;height:88%;width:100%;font-size:2.5vh;display: flex;">
                <div id="asis-schedule-menu-scroll" class="schedule-menu-scroll" style="display: grid;width: 100%;height:100%;">
                </div>
            </div>
        </div>
</div>
<script>
/*const PROFESOR = "Yovani";
function saludo(tipo) {
    const info = document.getElementById('info-div');
    const msg = document.getElementById('message-div');
    const display = document.getElementById('typewriter-text');
    
    // Configurar texto según el tipo
    const texto = tipo === 'entrada' 
        ? `¡Bienvenido, profesor ${PROFESOR}!` 
        : `¡Hasta luego, profesor ${PROFESOR}! Excelente trabajo.`;

    // Alternar Paneles
    info.classList.remove('active');
    setTimeout(() => {
        msg.classList.add('active');
        escribir(texto, display, () => {
            // Regresar tras 3 segundos de finalizar
            setTimeout(() => {
                msg.classList.remove('active');
                setTimeout(() => info.classList.add('active'), 500);
            }, 3000);
        });
    }, 500);
}

function escribir(txt, el, callback, i = 0) {
    if (i === 0) el.innerHTML = ""; // Limpiar al inicio
    if (i < txt.length) {
        el.innerHTML += txt.charAt(i);
        setTimeout(() => escribir(txt, el, callback, i + 1), 50);
    } else if (callback) callback();
}*/
</script>

<script>
    const btn = document.getElementById('btnTogglee');
    const panel = document.getElementById('profesorrPanel');

    btn.addEventListener('click', () => {
        if (panel.classList.contains('hidden')) {
            showAsistencia(1);           
        } else {
           showAsistencia(0);
        }
        
    });
    function showAsistencia(mm){
        if (mm==1){//saludo('entrada')
            panel.classList.remove('hidden');
            btn.textContent = "Ver Profesor";
        }else
        if (mm==0){//saludo('salida')
            panel.classList.add('hidden');
            btn.textContent = "Cerrar Panel";
        }
        
    }
async function asistencia(id,nombre) {
    const menu = document.getElementById("asis-schedule-menu-scroll");
    try {
        const res = await fetch('php/asistencia.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, nombre: nombre})
        });
        const resultado = await res.json();
        //console.log("aca",resultado);
        if (resultado.success) {
            document.getElementById("entrada").textContent=" "+resultado.horaE;
            document.getElementById("salida").textContent=" "+resultado.horaS;
            document.getElementById("estado").textContent=" "+resultado.message;

            const __DayList = resultado.horarios;
            menu.textContent = "";
            console.log("DayList",__DayList);
            __DayList.forEach(element => {

                const di = JSON.parse(element.dias);

                di.forEach(e => {
                    if(e.Dia == resultado.DiaSemana){
                        const main = document.createElement("div");
                        const ma = element.asignatura;
                        const au = element.aula;
                        const se = element.seccion;
                
                        main.classList.add("previtem","schedule-option", "draggable-item");

                        const div = document.createElement("div");
                        div.classList.add("schedule-option-pname");
                        const add1 = document.createElement("div");
                        add1.style = "display:flex";
                        const add2 = document.createElement("strong"); 
                        add2.textContent = `🖈${ma}: `;
                        const add3 = document.createElement("p"); 
                        add3.textContent = `🖈Seccion ${se} 🖈Aula ${au}`;

                        main.appendChild(div); 
                        add1.appendChild(add2); 
                        add1.appendChild(add3); 
                        main.appendChild(add1);       

                        const add4 = document.createElement("p");
                        add4.textContent = `🖈${e.Dia} ${arreglarhora(e.HoraE)} - ${arreglarhora(e.HoraS)}`;
                        main.appendChild(add4);  
                        menu.appendChild(main);   
                        }
                    });
                });

            //console.log("Sistema:", resultado.msg);
        }else{console.log("Asistencia Error else:", resultado.error);}
        
   } catch (e) {
        console.error("Error en asistencia try:", e);
   } 
}
function traerDatos(mt){
   const profesor = listaPro.find(u => u.id == mt.label);
   profesorGlobal=profesor;
   //document.getElementById("profCirculo").textContent=profesor.nombre[0];
   creafoto(document.getElementById("profCirculo"),profesor.id,profesor.nombre);
   document.getElementById("profNombre").textContent=profesor.nombre;
   document.getElementById("profTags").textContent="Especialidad: "+profesor.tags;
}

</script>