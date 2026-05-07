<style>
.regasis{
    position:absolute;  
    z-index:2000;
    opacity: 1;
    }

.regasis.fd{
    left: 0;
    top: 0;
    width:29.0%;
    height:100%;
    display:grid;
    grid-template-rows: 30% 70%; 
    transition: left 0.5s, opacity 0.5s;
    }
.hidden.regasis.fd{
    left: -29%;
    opacity: 0;
    }

.regasis.sd{
    left: 29%;   
    top: 0;
    width:37.67%;
    height:50%;
    transition: top 0.5s, opacity 0.5s;
    display:flex;
    }
.hidden.regasis.sd{
    top: -50%;
    opacity: 0;
    }
.regasis.td{
    left: 29%;
    top: 50%;
    width:70.9%;
    height:50%;
    transition: top 0.5s, opacity 0.5s;
    display:flex;
    }
.hidden.regasis.td{
    top: 150%;
    opacity: 0;
    }

.regasis.fod{
    left: 66.67%;
    top: 0;
    width:33.33%;
    height:50%;
    transition: left 0.5s, top 0.5s, opacity 0.5s;
    display:flex;
    }
.hidden.regasis.fod{
    left: 133.23%;
    top: -50%;
    opacity: 0;
    }  

.power-trigger.regasis{
    position:absolute;
    opacity: 1;
    top: 2%;
    left: 0;
    width: 4vw;
    height: 4vw;
    transition: top 0.5s, opacity 0.5s, transform 0.5s;
    }
.power-trigger.hidden.regasis{
    opacity: 0;
    top: -50%;
    transform: rotateZ(360deg);
    }

.regasis.main{
    height:100%;
    width:100%;
    top: 0;
    left: 0;
    transition: opacity 0.5s;
    background-color: #00000088;
    backdrop-filter: blur(8px);
    }
.hidden.regasis.main{
    opacity:0;
    pointer-events: none;
    }

.AsisTarjeta{
    display:grid;
    grid-template-columns: 10% 50% 40%;
    height: 10%;
    width:100%;
    text-align: left;
    padding: 2.5px 10px;
    margin-top: 10px;
    background-color: #00000099;
    border-radius: 0.5vh;
    }
    .AsisTarjeta:hover{
    opacity:0.3;
    cursor:pointer;
    }
    .status0,.status1,.status2{margin-right:20px}
    .status0{color: red; text-shadow: 0 0 10px red;}
    .status1{color: #ffae00;text-shadow: 0 0 10px #ffae00;}
    .status2{color: #00ff22;text-shadow: 0 0 10px #00ff22;}

.statusbtnon{
    font-size:1.5rem;
    transition: font-size 0.2s;
    }
.sdisable{
    font-size:1rem;
    text-shadow: 0 0 0 white;
    }
.statusbtncontainer{
    display:flex;
    align-items:center;
    justify-content:center;
    text-align: center;
}
.statusbtncontainer:hover{

    .statusbtnon{
    font-size:2rem;
    }

    cursor:pointer;
    }

.AsisTableHeader{
    display:flex;
    font-weight: bold;
    padding:0 10%;
    transition: box-shadow 0.2s;
    }
.AsisTableHeader:hover{
        cursor:pointer;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
    }
.AsisTableHeader.select{
        
    }
    .cabezaregistro{
        background:var(--newprima);
        border-top-left-radius:1vw; 
        padding: 2.5px 10px;text-align: left;border-top-right-radius:1vw;display:grid;grid-template-columns: 10% 50% 40%;
        color:black;
    }


    /*estilos de los paneles de profesor y asistencia */
    :root {
        --color-primario: #007bff;
        --bg-panel: #ffffff;
        --border-color: #e0e0e0;
    }

    .contenedor-principal {
        display: flex;
        width: 100%;
        max-width: 900px;
        min-height: 400px;
        gap: 20px;
        padding: 40px 20px;
        margin: 0 auto;
    align-items: stretch;  /* Esto es lo que iguala las alturas (viene por defecto) */
    gap: 20px;            /* Espacio entre paneles */
    }

    .panel {
        flex: 1; /* Mitad y mitad */
        display: flex;         /* Opcional: para organizar el contenido interno */
        flex-direction: column; /* Alinea el contenido de arriba a abajo */
        background: var(--newpoligono);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        position: relative; /* Para que el círculo se ubique respecto a este div */
        display: flex;
        flex-direction: column;
        color:var(--newletras);
        border-left:0px ;
    }

    /* Círculo sobresaliendo */
    .circulo-avatar {
        width: 70px;
        height: 70px;
        background: var(--newprima);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    /* Estilos Panel Izquierdo */
    .contenido { margin-top: 20px; }
    .nombre { margin: 10px 0; font-size: 1.5rem; }
    
    .tag {
        background: #e9ecef;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-right: 5px;
    }

    .stats { margin: 20px 0; line-height: 1.6; }

    .btn-sueldo {
        background: #28a745;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-sueldo:hover { background: #218838; }

    /* Estilos Panel izquierdo */
    .panel-derecho h3 { border-bottom: 2px solid var(--newprima); padding-bottom: 10px; }
    
    .registro-horas {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .campo {
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex: 1;
        margin-top: 10px;
    }

    input, textarea {
        padding: 10px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-family: inherit;
    }

    textarea {
        resize: none;
        height: 100px;
    }
    .btx{
        font-size: 10px;
        padding:10px;
    }
    .chart-container2{
        max-width: 300px;
    max-height: 300px;
    margin: 0px auto;
    }
    /*Estilos para el Menu de exportacion*/
    .export-menu-container {
        position: absolute;
        bottom: 15px;
        right: 15px;
        display: flex;
        flex-direction: column-reverse;
        align-items: flex-end;
        gap: 8px;
        z-index: 20;
    }
    .export-toggle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--newprima);
        border: none;
        color: white;
        font-size: 1.4rem;
        cursor: pointer;
        box-shadow: 0 0 15px var(--newprima);
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .export-toggle:hover {
        transform: scale(1.1);
        box-shadow: 0 0 25px var(--newprima);
    }
    /* Menú desplegable */
    .export-menu {
        display: flex;
        flex-direction: column-reverse;
        gap : 8px;
        opacity: 0;a
        transform: translateY(20px);
        pointer-events: none;
        transition: opacity 0.3s, transform 0.3s;
    }
    .export-menu.show {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }
    /*Estilos de los botones de exportacion*/
    .export-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 130px;
        padding: 10px 16px;
        border-radius: 30px;
        background: rgba(25, 25, 35, 0.75);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ddd;
        font-family: 'Segoe UI', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.4px;
        cursor: pointer;
        transition: all 0.3s cubics-bezier(0.23, 1, 0.32, 1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
    }
    .export-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, transparent 50%);
        pointer-events: none;
    }
    .export-btn:hover {
        background: rgba(30, 30, 40, 0.9);
        border-color: rgba(255, 255, 255, 0.3);
        color: #fff;
        box-shadow: 0 6px 18px rgba(0,0,0,0.5);
        transform: translateY(-2px);
    }
    /*Word*/ 
    .export-btn.word {
        border-color: rgba(43, 87, 154, 0.5);
    }
    .export-btn.word i {
        color: #2b579a;
        transition: color 0.3s;
    }
    .export-btn.word:hover {
        background: #2b579a;
        border-color: #2b579a;
        box-shadow: 0 0 20px rgba(43, 87, 154, 0.7);
    }
    .export-btn.word:hover i {
        color: #ffffff;
    }
    /*Excel*/
    .export-btn.excel {
        border-color: rgba(33, 115, 70, 0.5);
    }
    .export-btn.excel i {
        color: #217346;
        transition: color 0.3s;
    }
    .export-btn.excel:hover {
        background: #217346;
        border-color: #217346;
        box-shadow: 0 0 20px rgba(33, 115, 70, 0.7);
    }
    .export-btn.excel:hover i {
        color: #ffffff;
    }
    /*PDF*/
    .export-btn.pdf {
        border-color: rgba(211, 47, 47, 0.5);
    }
    .export-btn.pdf i {
        color: #D32F2F;
        transition: color 0.3s;
    }
    .export-btn.pdf:hover {
        background: #D32F2F;
        border-color: #D32F2F;
        box-shadow: 0 0 20px rgba(211, 47, 47, 0.7);
    }
    .export-btn.pdf:hover i {
        color: #ffffff;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div id="AsisMainDiv" class="hidden regasis main">
<!--/////////////////////////////////////asistencias todas////////////////////////////////////////////////-->
    <div id="AsisFirstDiv" class="hidden regasis fd">
        <div style="width:100%;height:100%;display:flex;">

            <div class="AsisFilterMenu" style="width: 50%; right: 0; position:absolute; height: 8%; top:2%; display:grid;grid-template-columns: 1fr 1fr 1fr">
                <div id="btnTogglestatus0" onclick="togglestatus(0)" class="statusbtncontainer" style="align-content:center;justify-items:center;">
                    <strong id="strongstatus0" class="status0 statusbtnon"><i class="fa-regular fa-clock"></i></strong>
                </div>
                <div id="btnTogglestatus1" onclick="togglestatus(1)" class="statusbtncontainer" style="align-content:center;justify-items:center;">
                    <strong id="strongstatus1" class="status1 statusbtnon"><i class="fa-regular fa-clock"></i></strong>
                </div>
                <div id="btnTogglestatus2" onclick="togglestatus(2)" class="statusbtncontainer" style="align-content:center;justify-items:center;">
                    <strong id="strongstatus2" class="status2 statusbtnon"><i class="fa-regular fa-clock"></i></strong>
                </div>
            </div>
            <div style="position: absolute;top: 22.5%;height: 10%;width: 100%;padding:5% 5%;">

                <input id="asisFilterInput" type="text" class="inputt" style="bottom:0;width:100%;background:var(--newprima);color:black;font-weight:bold;">

            </div>
        </div>
        <div style="width:100%;height:100%;padding:5% 5%;display:grid;grid-template-rows: 7% 93%;">
            <div class="cabezaregistro">

                <div id="tablesort0" class="AsisTableHeader" onclick="tablesort(0)"><p>S</p><i class="fa-solid"></i></div>
                <div id="tablesort1" class="AsisTableHeader" onclick="tablesort(1)"><p>NOMBRE</p><i class="fa-solid"></i></div>
                <div id="tablesort2" class="AsisTableHeader" onclick="tablesort(2)"><p>FECHA</p><i class="fa-solid"></i></div>

            </div>
            <div id="AsisScrollMenu" style="overflow-y:scroll;">

            </div>
        </div>
    </div>
<!--/////////////////////////////////////ESTADISTUCO////////////////////////////////////////////////-->
    <div id="AsisSecondDiv" class="hidden regasis sd">
        <div style="width:100%;height:100%;  ">

        <h3>Estadistico de Asistencias</h3>
        <div class="chart-container2">
            <canvas id="grafico"></canvas>
        </div>
        <button class="btx btn-futurista" onclick="cambia(0)">Torta</button>
        <button class="btx btn-futurista" onclick="cambia(1)">Barra</button>
        <button class="btx btn-futurista" onclick="cambia(2)">Área Polar</button>
        <button class="btx btn-futurista" onclick="cambia(3)">linea</button>
        <button class="btx btn-futurista" onclick="cambia(4)">Radar</button>
         <!--button class="btx btn-futurista" onclick="applyTheme('basic')">Básico</button>
        <button class="btx btn-futurista" onclick="applyTheme('dark')">Oscuro</button>
        <button class="btx btn-futurista" onclick="applyTheme('livelula')">Bio-Livelula</button>
        <button class="btx btn-futurista" onclick="applyTheme('dark2')">Ambar</button-->
        
        <div style="margin-top: auto; font-size: 0.65rem; opacity: 0.4; text-align: right;">
            LIVELULA_CORE // UNIT_01
        </div>

        </div>
    </div>
<!--/////////////////////////////////////Panelwes de profe y asistenca////////////////////////////////////////////////-->
    <div id="AsisThirdDiv" class="hidden regasis td">
        <div style="width:100%;height:100%;">
                <div class="contenedor-principal">
                    <!-- Panel Derecho: Registro -->
                    <div class="panel panel-derecho">
                        <h3>Asistencia</h3>
                        
                        <div class="registro-horas">
                            <div class="campo">
                                <label>Entrada:</label>
                                <input class="inputt" type="time" value="07:00">
                            </div>
                            <div class="campo">
                                <label>Salida:</label>
                                <input class="inputt" type="time" value="13:00">
                            </div>
                        </div>

                        <div class="campo">
                            <label>Nota del día:</label>
                            <textarea class="inputt" placeholder="Escribe observaciones aquí..."></textarea>
                        </div>
                    </div>
                                        <!-- Panel Izquierdo: Información -->
                    <div class="panel panel-izquierdo">
                        <div class="circulo-avatar" id="regavatar">A</div>
                        
                        <div class="contenido">
                            <h2 class="nombre" id="regnombre">Juan Pérez</h2>
                            <div class="tags" id="regtags">
                                Docente 6to Grado
                            </div>
                            
                            <div class="stats">
                                <p><strong>Récord de asistencia:</strong> <span id="regasis">95% </span></p>
                                <p><strong>Inasistencias:</strong><span id="regina">2</span></p>
                            </div>
                            
                            <button class="btn  btn-save">Calcular Sueldo</button>
                        </div>
                    </div>
                </div>

                <div class="export-menu-container">
                    <!-- Botón principal (disparador) -->
                    <button class="export-toggle" onclick="toggleExportMenu()" title="Exportar">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>

                    <!-- Menú desplegable -->
                    <div id = "exportMenu" class="export-menu">
                        <div style="position: absolute; bottom: 15px; right: 15px; display: flex; gap: 10px; z-index: 10;">
                            <button class="export-btn word" onclick="exportarWord()"><i class="fas fa-file-word"></i> Word</button>
                            <button class="export-btn excel" onclick="exportarExcel()"><i class="fas fa-file-excel"></i> Excel</button>
                            <button class="export-btn pdf" onclick="exportarPDF()"><i class="fas fa-file-pdf"></i> PDF</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div id="AsisFourDiv" class="hidden regasis fod">
        <div style="width:100%;height:100%;display: flex;justify-content: center;align-items: center;">
            <?php include 'newCalendario.php';?>
        </div>
    </div>

    <div id="AsisOnBtn" class="power-trigger hidden regasis" onclick="showAsisReg(0)" >
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--newprima)" stroke-width="2.5">
            <path d="M18.36 6.64a9 9 0 1 1-12.73 0M12 2v10"/></svg>
    </div>

</div>

<script>


const AsisMenu = document.getElementById("AsisScrollMenu");
let startDate = "2026-05-04";
let endDate = "2026-05-07";
let todosLosRegistros = [];
let registrosVisibles = [];
let status0 = true;
let status1 = true;
let status2 = true;
let search = "";
let tablesortdir = 0;
let tablesortmode = 0;
let record=0;
let inasistencias=0;

function tablesort(mode){

    if(mode === tablesortmode){
        if(tablesortdir === 0){tablesortdir = 1;}else{tablesortdir = 0;}
    }else{tablesortmode = mode;tablesortdir = 0;}

    document.getElementById("tablesort0").querySelector("i").classList.remove("fa-angle-up","fa-angle-down");
    document.getElementById("tablesort1").querySelector("i").classList.remove("fa-angle-up","fa-angle-down");
    document.getElementById("tablesort2").querySelector("i").classList.remove("fa-angle-up","fa-angle-down");
    
    document.getElementById("tablesort0").classList.remove("select");
    document.getElementById("tablesort1").classList.remove("select");
    document.getElementById("tablesort2").classList.remove("select");

    document.getElementById("tablesort"+tablesortmode).classList.add("select");
    if(tablesortdir === 0){
        document.getElementById("tablesort"+tablesortmode).querySelector("i").classList.add("fa-angle-up"); 
        }else{
        document.getElementById("tablesort"+tablesortmode).querySelector("i").classList.add("fa-angle-down");   
        }
    
    recargarListaAsis();
}


document.getElementById("asisFilterInput").addEventListener("input", (e) => {

search = document.getElementById("asisFilterInput").value;
recargarListaAsis()

});

function togglestatus(_Nmb){

if(_Nmb == 0){
    status0 = !status0;
    document.getElementById("strongstatus0").classList.toggle("sdisable");
    }else if(_Nmb == 1){
    status1 = !status1;
    document.getElementById("strongstatus1").classList.toggle("sdisable");
    }else if(_Nmb == 2){
    status2 = !status2;
    document.getElementById("strongstatus2").classList.toggle("sdisable");
    }

recargarListaAsis();

}

function crearAsisTask(status,id,date,name,late,pid){

    
    const MyProfesor = datosProfesores.find(u => u.id == id);
    
    const maindiv = document.createElement("div");
    maindiv.classList.add("AsisTarjeta");
    maindiv.addEventListener("click",()=>{
       updateProfeinfo(id,date,name,late,pid);
    });
    const statusdiv = document.createElement("div");
    const namediv = document.createElement("div");
    const datediv = document.createElement("div");

    const strong = document.createElement("strong");
    strong.textContent = name;
    namediv.appendChild(strong);

    datediv.textContent = date;

    statusdiv.textContent = "●";
    statusdiv.innerHTML='<i class="fa-regular fa-clock"></i>';

    if(status == 1 || status == 2){
        if(late == 0){
        statusdiv.classList.add("status2"); 
        }else{
        statusdiv.classList.add("status1");    
        }
    }else{
    statusdiv.classList.add("status0");   
    }
    

    maindiv.appendChild(statusdiv);
    maindiv.appendChild(namediv);
    maindiv.appendChild(datediv);

    return maindiv;
    }
    
async function cargarDatosAsis() {
        const _Fecha = startDate;
        const _FechaEnd = endDate;
        try {
            const res  = await fetch('php/asistencia/get_asistencia_dia.php', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({sdia: _Fecha, edia: _FechaEnd}) 
                });

            const json = await res.json();
            console.log(json)
            if (json.success) {

                var Dato1 = 0;
                var Dato2 = 0;
                var Dato3 = 0;

                todosLosRegistros = json.data;

                todosLosRegistros.forEach(element => {
                    
                    if(element.estado == 0){
                        Dato3++;
                    }else{
                        if(element.tardanza == 1){
                        Dato2++;
                        }else{
                        Dato1++;
                        }
                    }

                    const id = element.profesorID;
                    const myprof = datosProfesores.find(u => u.id == id);
                    var nombre = "desconocido";
                    var tags = [];
                    if(myprof){
                        nombre = myprof.nombre;
                        tags = JSON.parse(myprof.tags);
                        }   

                    element.nombre = nombre;
                    element.tags = tags;
                    element.myHtml = crearAsisTask(element.estado,element.id,element.fecha,element.nombre,element.tardanza,element.profesorID);

                });

                console.log("XDXDXD",todosLosRegistros)
                recargarListaAsis();

                profestadistico.data.datasets[0].data = [Dato1,Dato2,Dato3];
                profestadistico.update();
                console.log("📊 Gráfico actualizado con éxito.");
                }

            } catch (err) {
                console.error("Error al cargar datos:", err);
                }
        }

    function recargarListaAsis(){
    AsisMenu.textContent = "";
    var trueSearch = "";

        const searchTerms = search.trim().split(' ').filter(term => {  
        if(term.startsWith('#') && term.length > 1){
            return term;
            }else{
            if(!term.startsWith('#')){
            trueSearch += term + " ";
                }
            return false;
            }
        }).map(term => term.slice(1).toLowerCase());

        todosLosRegistros.filter((e) => {

            const late = e.tardanza;
    
                if(e.estado == 0 && status0){return true;}
                else if((e.estado == 1 || e.estado == 2) && (status2 || status1)){
                    if((late == 1 && status1) || (late == 0 && status2)){
                        return true;
                        }
                    }

            return false;
            
        }).filter((e) => {

         var include = 0;
         
            if(e.nombre.toLowerCase().includes(trueSearch.toLowerCase().trim()) && trueSearch.trim() !== ""){
                if(searchTerms.length === 0){
                    include += 2;
                    } else {
                    include += 1;
                    }
                }else if(trueSearch.trim() === ""){
                include += 1;
                }

        if (searchTerms.length > 0 && e.tags.length > 0) {
            const profTagsLower = Array.isArray(e.tags) ? e.tags.map(t => t.toLowerCase()) : [];
            const allTermsMatched = searchTerms.every(term => {
            // Buscamos el índice de la primera etiqueta que coincida con el término
            const foundIndex = profTagsLower.findIndex(tag => tag.includes(term));
                
            if (foundIndex !== -1) {
                // Si la encontramos, la eliminamos de las disponibles para este profesor
                profTagsLower.splice(foundIndex, 1);
                return true;
                }
            return false;
            });
        
            if (allTermsMatched) {
                include += 1;
                }
            }else if(searchTerms.length === 0){
            include += 1;
            }
            
            return include >= 2;


        }).sort((a, b) => {
        let comparison = 0;

        if (tablesortmode === 0) { // Ordenar por estado
        const getPriority = (item) => {
            if (item.estado == 0) return 0;
            if (item.estado == 1 || item.estado == 2) {
                return item.tardanza == 1 ? 1 : 2;
            }
            return 3; // Valor por defecto
        };
        comparison = getPriority(a) - getPriority(b);
        
        
        } else if (tablesortmode === 1) { // Ordenar por Nombre
        // localeCompare es la forma correcta de comparar strings
        comparison = a.nombre.localeCompare(b.nombre);

        } else if (tablesortmode === 2) { // Ordenar por fecha
        // Asumiendo que 'fecha' es un string de fecha o un objeto Date
        comparison = new Date(a.fecha) - new Date(b.fecha);
        }

        // Aplicar la dirección (Ascendente 0, Descendente 1)
        return tablesortdir === 0 ? comparison : -comparison;
        }).forEach(element => {
        
            AsisMenu.appendChild(element.myHtml);

            });

        }
 window.addEventListener('load', async () => {})



//////////cargar informacion sobre estadisticos

 // Configuración del Gráfico de Torta (Chart.js)
        const ctx3 = document.getElementById('grafico').getContext('2d');
        const profestadistico = new Chart(ctx3, {
            type: 'doughnut', // Estilo dona para verse más moderno
            data: {
                labels: ['Asistentes', 'retardado', 'Inasistentes'],
                datasets: [{
                    data: [18,5,9], 
                    backgroundColor: ['#39ff14', '#ffae00','#ff0000'],
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
        });profestadistico.update();
    function cambia(nu){
        profestadistico.data.datasets[0].borderColor = '#39ff14'; // Verde neón sólido
        profestadistico.data.datasets[0].borderWidth = 0;
        profestadistico.options.scales = {}; // Limpiamos ejes previos
        profestadistico.options.cutout = 0;
        if (nu==0){
            profestadistico.config.type = 'pie';
        }else
            if (nu==1){
            profestadistico.config.type = 'bar';
            profestadistico.options.scales = { y: { beginAtZero: true } };
        }else
            if (nu==2){
            profestadistico.config.type = 'polarArea';
            profestadistico.options.scales = { r: { grid: { color: 'rgba(255,255,255,0.1)' } } }
        }else 
        if (nu==3){
            profestadistico.config.type = 'line';
            profestadistico.data.datasets[0].borderWidth = 2;
            profestadistico.options.scales = { y: { beginAtZero: true } };
        }else
        if (nu==4){
            profestadistico.config.type = 'radar';
            profestadistico.data.datasets[0].borderWidth = 2;
            profestadistico.options.scales = {
            r: {
                angleLines: { color: 'rgba(255,255,255,0.2)' },
                grid: { color: 'rgba(255,255,255,0.2)' },
                pointLabels: { color: '#fff' },
                ticks: { display: false, backdropColor: 'transparent' }
            }
        };
        }
        profestadistico.update();
    }
//////esta se puede modificar es una coida de newContol.php la funcion del estadisctico
/* async function cargarEstadistico() { 
    try {
        const res = await fetch('php/asistencia/new_asitentes.php');
        const servidor = await res.json();
        if (servidor.success) {
            // Mapeamos: st1->Verde, st0->Rojo, st2->Amarillo
            profestadistico.data.datasets[0].data = [servidor.st1,servidor.st2,servidor.st0];
            profestadistico.update();
            console.log("📊 Gráfico actualizado con éxito.");
        }else{msj("error en estadistica de control",2);}
    } catch (e) {console.error("Error cargando estadísticas:", e);}
}cargarEstadistico();*/

// Función para mostrar el menú de exportación
    function toggleExportMenu() {
        const menu = document.getElementById('exportMenu');
        menu.classList.toggle('show');
    }
    
// Funciones de expotacion Word/PDF/Excel

    function obtenerDatosExportables() {
        const entradaInput = document.querySelector('#AsisThirdDiv input[type="time"]:nth-of-type(1)');
        const salidaInput = document.querySelector('#AsisThirdDiv input[type="time"]:nth-of-type(2)');
        const entrada = entradaInput ? entradaInput.value : "2:15";
        const salida = salidaInput ? salidaInput.value : "7:30";

       
        const registros = obtenerRegistrosVisibles();

        const datos = registros.map(e => {
            let nombre = "Desconocido";
            if (Array.isArray(datosProfesores)) {
                const profe = datosProfesores.find(u => u.id == e.id);
                if (profe) nombre = profe.nombre;
            }
            return {
                fecha: e.fecha,
                nombre: nombre,
                entrada: entrada,
                salida: salida
            };
        });

        console.log('Exportando', datos.length, 'registros visibles');
        return datos;
    }

    function exportarWord() {
    // Datos de prueba garantizados (ignora la función de obtención por ahora)
        const datos = [
            { fecha: '2026-05-06', nombre: 'Juan Pérez', entrada: '07:00', salida: '13:00' },
            { fecha: '2026-05-06', nombre: 'María García', entrada: '07:00', salida: '13:00' },
            { fecha: '2026-05-07', nombre: 'Carlos López', entrada: '08:00', salida: '14:00' }
        ];

        // Logo en base64 mínimo (una imagen pequeña transparente por si no carga la real)
        const logoBase64 = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';

        let html = `
        <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word'>
        <head>
            <meta charset="UTF-8">
            <title>Registro de Asistencia</title>
            <style>
                @page { size: letter; margin: 2cm; }
                body { font-family: 'Segoe UI', sans-serif; }
                .logo { float: left; width: 80px; margin-right: 20px; }
                .encabezado { overflow: auto; margin-bottom: 30px; }
                .titulo { font-size: 1.4em; font-weight: bold; margin-bottom: 5px; }
                .subtitulo { font-size: 0.9em; color: #555; }
                table { border-collapse: collapse; width: 100%; margin-top: 20px; }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; font-size: 0.9em; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <div class="encabezado">
                <img src="${logoBase64}" class="logo" alt="Logo">
                <div style="float: left;">
                    <div class="titulo">REGISTRO DE ASISTENCIA</div>
                    <div class="subtitulo">Prof. María del Carmen García Rodríguez</div>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Hora de Entrada</th>
                        <th>Hora de Salida</th>
                    </tr>
                </thead>
                <tbody>`;

        datos.forEach(d => {
            html += `<tr>
                <td>${d.fecha}</td>
                <td>${d.nombre}</td>
                <td>${d.entrada}</td>
                <td>${d.salida}</td>
            </tr>`;
        });

        html += `</tbody></table></body></html>`;

        const blob = new Blob([html], { type: 'application/msword' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'registro_asistencia.doc';
        a.click();
        URL.revokeObjectURL(url);
    }

    function exportarExcel() {
        // Datos de prueba (los mismos que en Word por ahora)
        const datos = [
            { fecha: '2026-05-06', nombre: 'Juan Pérez', entrada: '07:00', salida: '13:00' },
            { fecha: '2026-05-06', nombre: 'María García', entrada: '07:00', salida: '13:00' },
            { fecha: '2026-05-07', nombre: 'Carlos López', entrada: '08:00', salida: '14:00' }
        ];

        // Construir una tabla HTML simple 
        let html = `
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Registro de Asistencia</title>
            <style>
                table { border-collapse: collapse; width: 100%; }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <h3>REGISTRO DE ASISTENCIA</h3>
            <table>
                <thead>
                    <tr><th>Fecha</th><th>Nombre</th><th>Hora Entrada</th><th>Hora Salida</th></tr>
                </thead>
                <tbody>`;

        datos.forEach(d => {
            html += `<tr>
                <td>${d.fecha}</td>
                <td>${d.nombre}</td>
                <td>${d.entrada}</td>
                <td>${d.salida}</td>
            </tr>`;
        });

        html += `</tbody></table></body></html>`;

        // Crear blob y descargar como archivo .xls
        const blob = new Blob([html], { type: 'application/vnd.ms-excel' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'registro_asistencia.xls';
        a.click();
        URL.revokeObjectURL(url);
    }

    function exportarPDF() {
        console.log('Iniciando exportarPDF...');

        // Datos de prueba 
        const datos = [
            { fecha: '2026-05-06', nombre: 'Juan Pérez', entrada: '07:00', salida: '13:00' },
            { fecha: '2026-05-06', nombre: 'María García', entrada: '07:00', salida: '13:00' },
            { fecha: '2026-05-07', nombre: 'Carlos López', entrada: '08:00', salida: '14:00' }
        ];

        // Logo transparente temporal 
        const logoBase64 = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';

        // Abrir ventana nueva
        const ventana = window.open('', '_blank', 'width=800,height=600');

        let contenido = `
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Registro de Asistencia</title>
            <style>
                @page { size: A4 portrait; margin: 20mm; }
                body { font-family: 'Segoe UI', sans-serif; margin: 20px; }
                .encabezado { overflow: auto; margin-bottom: 30px; }
                .logo { float: left; width: 80px; margin-right: 20px; }
                .titulo { font-size: 1.4em; font-weight: bold; margin-bottom: 5px; }
                .subtitulo { font-size: 0.9em; color: #555; }
                table { border-collapse: collapse; width: 100%; margin-top: 20px; }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; font-size: 0.9em; }
                th { background-color: #f2f2f2; }
                .boton-imprimir {
                    margin: 20px 0;
                    padding: 10px 20px;
                    font-size: 14px;
                    background: #007bff;
                    color: white;
                    border: none;
                    border-radius: 6px;
                    cursor: pointer;
                }
                @media print {
                    .boton-imprimir { display: none; }
                }
            </style>
        </head>
        <body>
            <div class="encabezado">
                <img src="${logoBase64}" class="logo" alt="Logo">
                <div>
                    <div class="titulo">REGISTRO DE ASISTENCIA</div>
                    <div class="subtitulo">Prof. María del Carmen García Rodríguez</div>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Hora de Entrada</th>
                        <th>Hora de Salida</th>
                    </tr>
                </thead>
                <tbody>`;

        datos.forEach(d => {
            contenido += `<tr>
                <td>${d.fecha}</td>
                <td>${d.nombre}</td>
                <td>${d.entrada}</td>
                <td>${d.salida}</td>
            </tr>`;
        });

        contenido += `</tbody></table>
            <button class="boton-imprimir" onclick="window.print()">📄 Imprimir / Guardar como PDF</button>
        </body>
        </html>`;

        const blob = new Blob([contenido], { type: 'text/html' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'registro_asistencia.html';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);

        console.log('Archivo HTML descargado. Ábrelo y usa el botón Imprimir para guardar como PDF.');
    }


async function traerProfe(id) { 
    try {
        const res = await fetch('php/registro_profesor.php',{
            method: 'POST',headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id: id
            }),
        });
        const servidor = await res.json();
        if (servidor.success) {
            record=servidor.total;
            inasistencias=servidor.totali;
            return servidor.resultado[0];////no quitar esto denuevo :(
        }else{console.log(servidor.error);}
    } catch (e) {console.error("Error al traer info", e);}
    return null;
}
async function updateProfeinfo(id,date,name,late,pid){
    elprofesor= await traerProfe(pid);
    if(elprofesor){
        creafoto(document.getElementById("regavatar"),pid,name);
        document.getElementById("regnombre").textContent=name;
        document.getElementById("regtags").textContent=JSON.parse(elprofesor.tags).join(", ");
        document.getElementById("regasis").textContent=record;
        document.getElementById("regina").textContent=inasistencias;
    }
   //msj(id);
}
</script>