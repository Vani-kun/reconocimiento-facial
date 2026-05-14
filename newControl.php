<!--########################################ElControl################################################3-->
<style>

   
    body.theme-dark { 
        --newfondo: #1d1d1b;
        --newbarra: linear-gradient(to bottom, #000000 0%, #555555 100%);
        --newletras: #ffffff;
        --newletrascontraste: #ff00f2;
        --newpoligono: linear-gradient(135deg, #4d4d4d 0%, #000000 100%);
        --newpanel: linear-gradient(135deg, #4d4d4d 0%, #000000 100%);
        --newprima: rgb(255, 0, 0);
        --newsecu: #ff0055; 
        --newnucle:  #6d0024; 
    }
    body.theme-dark2 { 
        --newfondo: #1d1d1b;
        --newbarra: linear-gradient(to bottom, #382f25 0%, #000000 100%);
        --newletras: #ffffff;
        --newletrascontraste: #3700ff;
        --newpoligono: linear-gradient(135deg, #382d18 0%, #181106 100%);
        --newpanel: linear-gradient(135deg, #382d18 0%, #181106 100%);
        --newprima: rgb(255, 153, 0);
        --newsecu: #ff5100; 
        --newnucle:  #3d1800; 
    }
    body.theme-livelula { 
        --newfondo: #2a00c4;
        --newbarra: linear-gradient(to bottom, #ffffff 0%, #9294ff 100%);
        --newletras: #000000;
        --newpoligono: linear-gradient(135deg, #e2ffff 0%, #3335c9 100%);
        --newprima: rgb(0, 255, 242);
        --newsecu: #591ca8;
        --newnucle:  #0011ff;            
    }
    /*estos son los temas   copien uno y le ponen su nombre ejemplo*/  
    /* ahora les voy adecir las q tinen q cambiar primero bro checa los mios el de abra y el de abraclr*/
    body.theme-iujo { 
        --newfondo: #9a9b9c;  /* Un blanco hueso muy suave para no cansar la vista y dar elegancia */
        --newbarra: linear-gradient(180deg, #ffffff 50%, #b9b9b9 100%);   /* Degradado serio: del gris oscuro del logo hacia un tono más profundo */   
        --newletras: #000000; /* Gris grafito oscuro para máxima legibilidad y sobriedad */
        --newpoligono: linear-gradient(180deg, #cf2a2a 50%, #2c0c0c 100%);  /* Fondo secundario con un patrón sutil (Gris claro a blanco) */
        --newpanel: radial-gradient(circle, #ece7e7 0%, rgb(179, 179, 179) 100%);
        --newprima: #cf2a2a;  /* El Rojo Institucional del corazón para resaltar llamados a la acción */
        --newsecu: #ff0037; /* Un gris plata metálico para elementos secundarios */
        --newnucle: #858585; /* Un tono crema o arena suave para detalles terciarios que den calidez */
    }
    body.theme-emerald { 
        --newfondo: #010d02; /* Negro profundo con matiz esmeralda  */
        --newbarra: linear-gradient(90deg, #00ff88 0%, #005f32 100%); 
        --newletras: #e0fff0; /* Blanco menta para máxima legibilidad */
        --newpoligono: radial-gradient(circle, #003b1c 0%, #010d02 100%);
        --newprima: #00ff88; /* Verde neón vibrante */
        --newsecu: #008f5d; 
        --newnucle: #80ffc6; 
    }
    body.theme-yovani { 
        --newfondo: #999999;/*el fondo pricipal*/
        --newbarra: linear-gradient(to bottom, #e5ff00 0%, #00a761 100%);/*la barra*/
        --newletras: #ffffff;/*las letras de los textos*/
        --newpoligono: linear-gradient(135deg, #e5ff00 0%, #00ff15 100%);/*y esto es el fondo cambien los dos  */
        --newpanel: linear-gradient(circle, #ffffff 0%, #b4b4b4 100%);
        --newprima: rgb(251, 255, 0);/*esta es el color q resalta las cosas cambienlo en los suyos*/
        --newsecu: #1ca895;/*est es el color secunadario de resaltar*/
        --newnucle:  #ffe600;            /*color de los nucleos o color terceario */
    }
    body.theme-anderson {
        --newfondo: #d1d1d1;/*principal*/
        --newbarra: linear-gradient(to bottom, #bdbdbd 0%, #d4d4d4 100%);/*la barra*/
        --newletras: #000000;/*textos*/
         --newletrascontraste: #000000;
        --newpoligono: linear-gradient(135deg, #e31b23 0%, #490e10 100%);/*Cambio fondo mi primera chamba*/ 
        --newprima: rgb(199, 10, 10); /*Cambio resaltador*/
        --newsecu: #000000;/*Cambio resaltador 2*/
        --newnucle:  #ffffff;/*otros colores*/
    }

    body.theme-adrian {  
        --newfondo: #0b0e14;
        --newbarra: linear-gradient(to bottom, #2a2f3a 0%, #0c0e12 100%);
        --newletras: #e0d5b7;
        --newpoligono: linear-gradient(135deg, #2f8af5 0%, #0b0e14 100%);
        --newprima: #4da6ff;
        --newsecu: #f0513b;
        --newnucle: #161b24;
    }
    
    body.theme-abrahan { 
        --newfondo: #0f172a;
        --newbarra: linear-gradient(to bottom, #1e293b 0%, #0f172a 100%);
        --newletras: #ffffff;
        --newpoligono: linear-gradient(135deg, #582020 0%, #3f0416 100%);/*y esto es el fondo cambien los dos  */
        --newprima: rgba(83, 8, 8, 0.79);/*esta es el color q resalta las cosas cambienlo en los suyos*/
        --newsecu: #6366f1;
        --newnucle:  #3f0416;            
    }
     body.theme-abra { 
        --newfondo: #a9aaac;
        --newbarra: linear-gradient(to bottom, #663f3f 0%, #2c0c0c 100%);
        --newletras: #ffffff;
        --newpoligono: linear-gradient(135deg, #582020 0%, #3f0416 100%);/*y esto es el fondo cambien los dos  */
        --newprima: rgba(41, 40, 40, 0.79);/*esta es el color q resalta las cosas cambienlo en los suyos*/
        --newsecu: #133357;
        --newnucle:  #3f0416;            
    }
/* eso es la mitad del trabjp ya casi muchachones  explotasion     ya vengo salgo y vuelvo a netrar a ver si agarra el usua */
/* hra signme ya el estilo esta listo aora nesestamo q se asine con un boton */

    /* Botón de Encendido Estilo Pulsante */
    .power-trigger {
        position: fixed; top: 25px; right: 50%; z-index: 1001;
        width: 50px; height: 50px; border-radius: 50%;
        border: 2px solid var(--newprima);
        background: #000; cursor: pointer;
        box-shadow: 0 0 10px var(--newprima);
        display: flex; align-items: center; justify-content: center;
        transition: 0.3s;
        transform:translateX(25px);
    }

    .power-trigger:hover { box-shadow: 0 0 25px var(--newprima); transform:translateX(25px) scale(1.05); }

    /* Panel Principal con Animación de Desvanecido */
    #panel-container {
        position: fixed;
        inset: 0;
        background: var(--newpanel);
        backdrop-filter: blur(25px);
        display: grid;
        grid-template-columns: 320px 1fr 320px;
        z-index: 1000;
        
        /* Estado Inicial: Oculto */
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.4s ease-in-out; /* Animación de desvanecido sin desplazo */
    }

    #panel-container.active {
        opacity: 1;
        pointer-events: auto;
    }

    /* Columnas */
    .col {
        padding: 40px 30px;
        display: flex; flex-direction: column;
        border-right: 1px solid rgba(255,255,255,0.1);
        background:var(--newfondo);
        /*overflow-y:scroll;*/
    }

    .col-left { border-right: none; background: var(--newpanel); }
    .col-right { border-right: none; background: var(--newpanel); }
    .temascroll{
        overflow-y: scroll;
        display: block;
        max-height: 40vh;
    }


    h3 { 
        font-size: 0.85rem; text-transform: uppercase; 
        letter-spacing: 3px; color: var(--newprima);
        margin-bottom: 30px; border-bottom: 1px solid var(--newprima);
        padding-bottom: 10px;
    }

    /* Diagnóstico e Inputs */
    .control-item { margin-bottom: 5px; }
    .checkbox-wrapper { display: flex; align-items: center; gap: 15px; cursor: pointer; }
    
    input[type="checkbox"] {
        width: 18px; height: 18px;
        accent-color: var(--newprima);
    }

    input[type="range"] { width: 100%; accent-color: var(--newprima); cursor: pointer; }

    /* Gráfico y Botones */
    .chart-container {
        background: var(--newfondo);
        padding: 20px;
        border-radius: 20px;
        margin-bottom: 30px;
        max-width:180px;
            margin: 0px auto;
    }
    #profDataChart{
        /*max-width:100px;*/
    }
    .btn-futurista {
        background: transparent; border: 1px solid var(--newprima);
        color: var(--newletras ); padding: 14px; cursor: pointer;
        text-transform: uppercase; font-size: 0.75rem;
        letter-spacing: 2px; transition: 0.4s;
        margin-top: 10px;
        border-radius: 10px;
        width:100%;
    }

    .btn-futurista:hover { 
        background: var(--newprima); 
        color: #000; 
        box-shadow: 0 0 30px var(--newprima);
    }

    .status-display { text-align: center; margin: 40px 0; }
    #status-text { font-size: 1.8rem; font-weight: bold; text-shadow: 0 0 15px var(--newprima); }

    :root {
    --bg-panel: #1a1a1a;
    --bg-item: #2a2a2a;
    --accent: #00d4ff;
    --danger: #ff4757;
    --warning: #ffc107;
    --success: #2ed573;
    --text: #ffffff;
}

.panel-container {
    width: 100%;
    height: auto;
    background: var(--newpanel);
    color: var(--text);
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border: 1px solid #333;
    margin-top:20px
}

/* Cabecera */
.panel-header {
    background:var(--newfondo);color:var(--newletras);
    padding: 15px;
    text-align: center;
    border-bottom: 2px solid var(--newprima);
}
.btn-main {
    background:var(--newprima);color:var(--newletras);
    width: 100%;
    padding: 0px;
    border: none;
    font-weight: bold;
    cursor: pointer;
    text-transform: uppercase;
    font-size:30px
}

/* Lista con Scroll */
.user-list {
    flex: 1;
    overflow-y: scroll;
    max-height:150px;
    padding: 15px 15px 15px 0px;
    background:var(--newfondo);
}
.user-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--newpanel);
    padding: 0px;
    border-radius: 8px;
    margin-bottom: 10px;
    transition: 0.2s;
    border-radius: 0px 20px 20px 0px;
}
.user-item span{
    margin: 0px auto;
}
.user-item:hover {
    background: var(--newsecu);
}

/* Formulario Central */
.registration-box {
    display: none;
    padding: 20px;
    border-top: 1px solid #444;
    border-bottom: 1px solid #444;
    animation: fadeIn 0.3s ease-out;
}

.input-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Niveles de Usuario */
.level-selector {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 0px;
    margin-top: 15px;
    text-align: center;
}
.level-icon {
    font-size: 0.7rem;
    cursor: pointer;
    padding: 5px;marging:0px;
    border-radius: 4px;
    background:none;
    color: var(--newletras);
}
.level-icon:hover {
    background: var(--newprima);
    color: var(--newletras);
}
.level-icon.actleve {
    background: var(--newprima);
    color: var(--newletras);
}

/* Botones */
.botonera{display: grid;}
.btn-action {
    border: none;padding: 5px 10px;cursor: pointer;margin-left: 5px;
}
.btnedi{background: var(--warning);border-radius: 0px 20px 0px 0px;}
.btndel{background: var(--danger); border-radius: 0px 0px 20px 0px;color:white}

.botoni {
    padding: 5px!important;
    cursor: pointer;
    margin-top: 10px;height: auto;
    margin:0px;margin-top:10px;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
</style>

<div id="panel-container">
    <!-- IZQUIERDA: DIAGNÓSTICO Y PRECISIÓN -->
    <div class="col col-left">
        <h3>Configuracion del Sistema</h3>

 <div class="panel-container">
    <div class="panel-header">
        <h2 style="margin:0">Gestión de Usuarios</h2>
    </div>
    <!-- Lista que hace scroll -->
    <div class="user-list SecurityLevel5" id="userlista">
        <div class="user-item">
            <span>Error</span>
            <div class="botonera">
                <button class="btn-action btnedi" ><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn-action btndel" ><i class="fa-solid fa-trash"></i></button>
            </div>
        </div>
        <!-- Más usuarios aquí -->
    </div>
    <!-- Panel de Registro Central -->
    <div id="regPanel" class="registration-box">
        <div class="input-group">
            <input id="inpuU"class="inputt" type="text" placeholder="Nombre de usuario">
            <input id="inpuP"class="inputt" type="password" placeholder="Contraseña">
        </div>
   
        <div class="level-selector" id="seleve">
            <div class="level-icon"><i class="fa-solid fa-eye"></i><br>Visor</div>
            <div class="level-icon"><i class="fa-solid fa-pen-to-square"></i><br>Editor</div>
            <div class="level-icon"><i class="fa-solid fa-screwdriver-wrench"></i><br>Mod</div>
            <div class="level-icon"><i class="fa-solid fa-shield"></i><br>Admin</div>
            <div class="level-icon"><i class="fa-solid fa-crown"></i><br>Supremo</div>
        </div>
        
        <button id="accion" class="btn btn-save botoni" style="width:100%" onclick="guardarusuario()">GUARDAR</button>
        <button id="accion2" class="btn btn-save botoni" style="width:100%" onclick="cancelausuario()">CANCELAR</button>
    </div>
    <!-- Botón Agregar abajo -->
    <button class="btn-main" onclick="togglePanelusers()" id="botonmas">+</button>
</div>



       
        <div class="control-item">
            <label class="checkbox-wrapper">
                <input type="checkbox" id="err-log"> Errores de Sistema
            </label>
        </div>
        
        <div class="control-item" style="margin-top: 20px;">
            <label style="font-size: 0.75rem; opacity: 0.8;">RANGO DE PRECISIÓN: <span id="prec-val">0.90</span></label>
            <input type="range" min="0" max="1" step="0.01" value="0.90" oninput="updatePrecision(this.value)" id="rangobar">
        </div>

        <button class="btn-futurista" onclick="guardacargaConfi(1)">Actualizar Configuracion</button>

    </div>

    <!-- CENTRO: NÚCLEO LIVELULA -->
    <div class="col" style="justify-content: center; align-items: center; border-left: 1px solid rgba(255,255,255,0.1);">
        <div style="text-align: center;">
            <h1 style="font-size: 3rem; letter-spacing: 15px; margin: 0; color: var(--newprima);">LIVELULA</h1>
            <div class="status-display">
                <p style="font-size: 0.8rem; opacity: 0.6;">CONTROL DE FLUJO BIOMÉTRICO</p>
                <input type="range" min="0" max="1" step="1" value="<?php echo ($valorPausa==0) ?1:0;?>" style="width: 60px;" oninput="updateSystemStatus(this.value)">
                <div id="status-text" style="color: var(--newprima);">ACTIVO</div>
            </div>
            
<!-- Interruptor de Encendido -->
<div class="power-trigger" onclick="togglexxPanel()" >
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--newprima)" stroke-width="2.5">
        <path d="M18.36 6.64a9 9 0 1 1-12.73 0M12 2v10"/></svg>
</div>
            <!--button class="btn-futurista" style="width: 250px;">Rango Detección Cámara</button-->
        </div>
    </div>

    <!-- DERECHA: ESTADÍSTICAS Y ESTILO -->
    <div class="col col-right">
        <h3>Monitor de Profesores</h3>
        <div class="chart-container">
            <canvas id="profDataChart"></canvas>
        </div>

        <h3>Interfaz de Usuario</h3>
        <div class="temascroll">
            <button class="btn-futurista" onclick="applyTheme('anderson')">IUJO</button>
            <button class="btn-futurista" onclick="applyTheme('basic')">Tema Básico</button>
            <button class="btn-futurista" onclick="applyTheme('dark')">Modo Oscuro</button>
            <button class="btn-futurista" onclick="applyTheme('livelula')">Bio-Livelula</button>
            <button class="btn-futurista" onclick="applyTheme('dark2')">Neo-Livelula-Ambar</button>
            <button class="btn-futurista" onclick="applyTheme('iujo')">Tema IUJO</button>
            <button class="btn-futurista" onclick="applyTheme('emerald')">Cyber-Emerald</button>
            <button class="btn-futurista" onclick="applyTheme('yovani')">radiacion</button>
            <button class="btn-futurista" onclick="applyTheme('abrahan')">abram</button>
            <!--button class="btn-futurista" onclick="applyTheme('adrian')">Auxilio me sobreexplotan laboralmente</button>
            <button class="btn-futurista" onclick="applyTheme('abra')">abraclar</button-->
            <!-- -->
            <!--ahora copien y pegen esto cambiando el nombre de su tema regrese agarra otro ahi bro -->
            <!--applyTheme('dark2') -->
        </div>
        
        <div style="margin-top: auto; font-size: 0.65rem; opacity: 0.4; text-align: right;">
            LIVELULA_CORE // UNIT_01
        </div>
    </div>
</div>

<script>
    ////variables de configuracion 

    // Función para mostrar/ocultar el panel
    function togglexxPanel() {
        let pannel=document.getElementById('panel-container');
        if (pannel.classList.contains("active")){
            moveCamera("center");enpanelprofesor=false;
        }else{guardacargaConfi(0);C_BarDefault();}
        pannel.classList.toggle('active');
    }

    // Actualizar etiqueta de precisión
    function updatePrecision(v) {
        document.getElementById('prec-val').innerText = v;
    }

    // Control de pausa/reanudación
    function updateSystemStatus(val) {
        const status = document.getElementById('status-text');
        if(val == 0) {
            status.innerText = "PAUSADO";
            status.style.color = "#ff0055";
            status.style.textShadow = "0 0 15px #ff0055";
            cambiarEstadoPausa(1);
        } else {
            status.innerText = "ACTIVO";
            status.style.color = "var(--newprima)";
            status.style.textShadow = "0 0 15px var(--newprima)";
            cambiarEstadoPausa(0);
        }
    }
    async function cambiarEstadoPausa(estado) {
        try {
            const respuesta = await fetch('php/control/pausar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ nuevo_estado: estado })
            });
            const resultado = await respuesta.json();
            if (resultado.success) {
                console.log("🛠️ " + resultado.msg);
            } else {
                msj("Error: " + resultado.msg,2);
            }
        } catch (error) {console.error("Error al intentar cambiar la pausa:", error);}
    }

    // Temas
    function applyTheme(theme) {
        document.body.className = '';
        if(theme !== 'basic') {
            document.body.classList.add('theme-' + theme);
            localStorage.setItem('tema', theme);
        }
    }

 // Configuración del Gráfico de Torta (Chart.js)
        const ctx2 = document.getElementById('profDataChart').getContext('2d');
        const profDataChart = new Chart(ctx2, {
            type: 'doughnut', // Estilo dona para verse más moderno
            data: {
                labels: ['Asistentes', 'Inasistentes'],
                datasets: [{
                    data: [18, 5], 
                    backgroundColor: ['#39ff14', '#f10028'],
                    hoverOffset: 10,
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#fff', padding: 20, font: { size: 10, family: 'monospace' } }
                    }
                }
            }
        });

//
async function cargarDatosReales() { 
    try {
        const res = await fetch('php/asistencia/new_asitentes.php');
        const servidor = await res.json();
        if (servidor.success) {
            // Mapeamos: st1->Verde, st0->Rojo, st2->Amarillo
            profDataChart.data.datasets[0].data = [servidor.asis,servidor.st0 ];
            profDataChart.update();
            //console.log("📊 Gráfico actualizado con éxito."); esta bien bro 
        }else{msj("error en estadistica de control",2);}
    } catch (e) {console.error("Error cargando estadísticas:", e);}
}cargarDatosReales();
 
async function guardacargaConfi(modo) { 
    try {
        const res = await fetch('php/control/guarda_config.php',{
            method: 'POST',headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                modo: modo,
                rango: document.getElementById('rangobar').value,
                errores: (document.getElementById('err-log').checked)?1:0
            }),
        });
        const servidor = await res.json();
        if (servidor.success) {
            ///lectura
            if(modo==0){
            document.getElementById('err-log').checked = (servidor.errores==1)?true:false;
            document.getElementById('rangobar').value = parseFloat(servidor.rango).toFixed(1);
            updatePrecision( parseFloat(servidor.rango).toFixed(1));
            }
            //console.log("servidor "+servidor.msg);
        }else{msj("error en consulta de configuracion",2);}
    } catch (e) {
        let info=(modo==1 ? "Guardando" : "Cargando");
        console.error("Error "+info+" configuraciones:", e);
    }
}
/*##########################usuarios #############################################################*/
let editacion=0;let ide=0;let level=1;
const descripciones = {
    1: "Nivel 1: Solo puedes ver el contenido de la página sin realizar cambios.",
    2: "Nivel 2: Puedes crear y editar los profesores",
    3: "Nivel 3: Tienes poder para moderar los horarios y crear las secciones.",
    4: "Nivel 4: Gestión total de profesores y configuración del sitio.",
    5: "Nivel 5: Acceso total a la base de datos y archivos del servidor además de crear y gestionar usuarios."
};
function updatesleven() {
    const seleve = document.getElementById("seleve");
    Array.from(seleve.children).forEach((ele, i) => {
        if (i + 1 === level) {ele.classList.add("actleve");} else {ele.classList.remove("actleve");}
    });
}
function inisleven() {
    const seleve = document.getElementById("seleve");
    Array.from(seleve.children).forEach((ele, i) => {
        ele.addEventListener("click", () => {
            level = i + 1; 
            let msleve = descripciones[level] || "Selecciona un nivel.";
            msj(msleve, 1);
            updatesleven();
        });
    });
    updatesleven();
}
function cancelausuario(){
    editacion=0;
    document.getElementById('accion').textContent="GUARDAR";
    const p = document.getElementById('regPanel');
    if (p.style.display != 'none') {togglePanelusers();}
}
function togglePanelusers() {
    const p = document.getElementById('regPanel');
    p.style.display = (p.style.display === 'block') ? 'none' : 'block';
    document.getElementById("inpuU").value="";
    document.getElementById("inpuP").value="";
    document.getElementById('accion').textContent="GUARDAR";
    mas=document.getElementById("botonmas")
    if(mas.textContent!="+"){mas.textContent="+"}else{mas.textContent="-"}
}
function listarUsuarios(usrs) {
    lista=document.getElementById("userlista");lista.innerHTML = ""
    usrs.forEach(ele => {
        //console.log(ele.usuario);

        newiten=document.createElement("div");
        newuser=document.createElement("span");
        newpanelbtn=document.createElement("div");
        newedi=document.createElement("button");newedi.className="btn-action btnedi";newedi.innerHTML='<i class="fa-solid fa-pen-to-square"></i>';
        newdel=document.createElement("button");newdel.className="btn-action btndel";newdel.innerHTML='<i class="fa-solid fa-trash"></i>';

        newiten.className="user-item";
        newpanelbtn.className="botonera";
        newuser.textContent=ele.usuario;
        newedi.addEventListener("click",()=>{
            userserver(2,ele.id,"","",0);
            //msj(ele.usuario,1);
        });
        newdel.addEventListener("click",()=>{
                
        if(!confirm(`Seguro que deseas eliminar al usuario ${ele.usuario}`)){return;}
        if(prompt(`Para eliminar a ${ele.usuario}, escribe: ELIMINAR`) != "ELIMINAR"){return;}

            if( userserver(4,ele.id,"","",0)){msj(ele.usuario+ " eliminado ...",2);}
        });
        newpanelbtn.appendChild(newedi);newpanelbtn.appendChild(newdel);
        newiten.appendChild(newuser);
        newiten.appendChild(newpanelbtn);
        lista.appendChild(newiten);
    });
}
function guardarusuario() {
    ///validar
    let inpuU = document.getElementById("inpuU").value.trim();
    let inpuP = document.getElementById("inpuP").value.trim();
    if(inpuU === "" || inpuP === "") {msj("Campos vacíos", 2);return;}
    if (editacion==0){
        if (userserver(1,0,inpuU,inpuP,5)){msj("Guardado con exito!", 0);}
    }else 
    if (editacion==1){
        if (userserver(3,ide,inpuU,inpuP,5)){msj("Editado con exito!", 0);}
    }
    togglePanelusers(); 
}
async function userserver(tipo,id,usr,pass,lv){ 
    ///leeer///guardar/// traer para editar/// editar///eliminar
    try {
        const res = await fetch('php/control/usuarios.php',{
            method: 'POST',headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                tipo: tipo,
                id: id,
                usr: usr,
                pass: pass,
                lv: level
            }),
        });
        const servidor = await res.json();
        if (servidor.success) {
            ///lectura
            if(tipo==0){
                listarUsuarios(servidor.usuarios);return true;
                //msj("datos leidos",0);
            }else
            if(tipo==1){
                userserver(0,0,"","",0);return true;
            }else
            if(tipo==2){
                editacion=1;
                ide=servidor.usuario.id;
                document.getElementById('accion').textContent="EDITAR";
                const p = document.getElementById('regPanel');
                if (p.style.display != 'block') {togglePanelusers();}
                document.getElementById("inpuU").value=servidor.usuario.usuario;
                document.getElementById("inpuP").value=servidor.usuario.password;  
                level = parseInt(servidor.usuario.level) || 1;
                updatesleven();
                return true;
            }else
            if(tipo==3){
                userserver(0,0,"","",0);
                editacion=0;
                return true;
            }else
            if(tipo==4){
                userserver(0,0,"","",0);
                return true;
            }
        }else{msj("error en consulta userserver",2);msj("consulta",2);}
    } catch (e) {
        console.error("Error en user server try", e);msj("try",2);
    }return false;
}

userserver(0,0,"","",0);
togglePanelusers();
inisleven();
</script>