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
        gap: 30px;
        padding: 40px 20px;
        margin: 0 auto;
    align-items: stretch;  /* Esto es lo que iguala las alturas (viene por defecto) */
    gap: 20px;            /* Espacio entre paneles */

            align-items: center;
        justify-content: center;
    }

    .panelx {       
        display: flex;         /* Opcional: para organizar el contenido interno */
        flex: 1;
        flex-direction: column; /* Alinea el contenido de arriba a abajo */
        background: var(--newpoligono);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        position: relative; /* Para que el círculo se ubique respecto a este div */
        color:var(--newletras);
        border-left:0px ;
        min-height:40vh;
        min-width:300px;
    }
    /* Cuando la pantalla sea de 768px o más (Tablets/Laptops) */

    .panelx-derecho {  flex: 0 1 auto;min-width:400px; }
    .panelx-izquierdo{ flex: 0 1 auto;}
@media (max-width: 768px) {
    .contenedor-principal {
        display:grid;
        width: 100%;
        height: 100%;         
        overflow-y: auto;      
        overflow-x: hidden;   
    }
    .panelx-derecho {  display:block; width: 100%;height: auto;}
    .panelx-izquierdo{ display:block; width: 100%;height: auto;margin-top:20px}
}
    /* Círculo sobresaliendo */
    .circulo-avatar {
        width: 70px;
        height: 70px;
        background: black;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        margin:0px auto;
    }

    /* Estilos Panel dercho */
    
    .contenido { margin-top: 5px; }
    .nombre { margin: 5px 0; font-size: 1.5rem; }
    #regtags{font-size:0.6em;}
    #regasis , #regina{
        color:var(--newprima);
        font-size:1.1em;
    }
    .tag {
        background: #e9ecef;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-right: 5px;
    }

    .stats { margin: 20px 0; line-height: 1.6;    text-align: left; }

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

    .panelx-derecho h3 { border-bottom: 0px solid var(--newprima);color:var(--newletras);margin-bottom:0px}
    .panelx-derecho label {font-size:12px;text-align:left;margin:0px;padding:0px;}
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
        top: 18%;
        left: 30px;
        display: flex;
        flex-direction: column-reverse;
        align-items: start;
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
        text-align: center;
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
        opacity: 0;
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
        width: 100%;
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
    /*#######estatus de la asistencia####### */
    .status-container {
        display: flex;
        align-items: center;
        gap: 12px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 8px 16px;
        border-radius: 50px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        width: fit-content;
    }
    .status-text {font-weight: bold;color: #555;text-transform: uppercase;font-size: 0.9rem;}
    .icons-group {display: flex;gap: 15px;}
    /* Estilos base de los iconos */
    .icon-status {
        font-size: 1.5rem;
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    .assist { color: #2ecc71; }  /* Verde */
    .absent { color: #e74c3c; }  /* Rojo */
    .late { color: #f1c40f; }    /* Amarillo */
    @keyframes pulso {0% {transform: scale(1); }50% {transform: scale(1.2);}100% { transform: scale(1);}}
    .soy {
        animation: pulso 2s infinite ease-in-out;
    }
    .nosoy {
        color:rgba(0,0,0,0.5);
    }
    .saveinfo{
        font-size: 1.2rem;
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .saveinfo:hover{
        color:#2ecc71;
        cursor:pointer;
        text-shadow: 0 0 10px #00ff22;
    }
    #addasisdate::-webkit-calendar-picker-indicator {
    display: none;
    -webkit-appearance: none;
    }
    .closeaddasis{
        font-size: 1.2rem;
        display:flex;
        align-items:center;
        justify-content:center; 
    }
    .closeaddasis:hover{
        color:#ff0000;
        cursor:pointer;
        text-shadow: 0 0 10px #ff0000;
    }
    .addasissave{
        border: 2px solid gray; 
        border-radius:100%; 
        height:75px;
        width:75px;
        position:absolute;
        background-color:white;
        font-size:2rem;
        display:flex;
        justify-content:center;
        align-items:center;
        justify-self:center;
        bottom:-18.75px;
        transition: text-shadow 0.2s, color 0.2s, box-shadow 0.2s, background-color 0.2s;
        }
    .addasissave:hover{
        color:#fff;
        background-color: #2ecc71;
        cursor:pointer;
        text-shadow: 0 0 10px #00ff22;
        box-shadow: 0 0px 10px #00ff22;
        }
    .panel-derecho.AA_panel{
        z-index: 6000;
        }
    #toggle-panel.AA_panel{
        z-index: 6200;
        }
    .AA_panel .btn-action,#BTNProfRegistry{
        display:none;
        }
    .AA_panel .profesor-card:hover{
        background: rgba(255, 255, 255, 0.1);
        cursor:pointer;
        }
    #AsisCreateWrapper{
        color:black;
        position:absolute;
        height:90%;
        width:40%;
        background-color:white;
        left:30%;
        top:5%;
        z-index:5000;
        border-radius:5%;
        padding:2.5% 0;
        opacity:1;
        transition: left 0.5s cubic-bezier(0.4, 0, 0.2, 1), top 0.5s, opacity 0.5s;
        }
    .AA_panel#AsisCreateWrapper{
        left:12.5%;
        }
    .hidden#AsisCreateWrapper{
        top:-100%;
        opacity:0;
        }
    #AA_calendar{
        opacity:1;
        transition: opacity 0.5s, top 0.5s;
        top:7%;
    }
    #AA_calendar.hidden{
        top:-20%;
        opacity:0;
        pointer-events:none;
        }

</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div id="AsisMainDiv" class="hidden regasis main">
<!--/////////////////////////////////////asistencias todas////////////////////////////////////////////////-->
    <div id="AsisFirstDiv" class="hidden regasis fd">
        <div style="width:100%;height:100%;display:flex;">

            <div class="AsisFilterMenu" style="width: 50%; right: 0; position:absolute; height: 8%; top:2%; display:grid;grid-template-columns: 1fr 1fr 1fr">
                <div id="btnTogglestatus0" onclick="togglestatus(0)" class="statusbtncontainer" style="align-content:center;justify-items:center;" time-tooltip="0.2" data-tooltip="Activar/Desactivar filtro de inasistencia">
                    <strong id="strongstatus0" class="status0 statusbtnon"><i class="fa-solid fa-user-slash"></i></strong>
                </div>
                <div id="btnTogglestatus1" onclick="togglestatus(1)" class="statusbtncontainer" style="align-content:center;justify-items:center;" time-tooltip="0.2" data-tooltip="Activar/Desactivar filtro de llegadas tarde">
                    <strong id="strongstatus1" class="status1 statusbtnon"><i class="fa-regular fa-clock"></i></strong>
                </div>
                <div id="btnTogglestatus2" onclick="togglestatus(2)" class="statusbtncontainer" style="align-content:center;justify-items:center;" time-tooltip="0.2" data-tooltip="Activar/Desactivar filtro de asistencias a tiempo">
                    <strong id="strongstatus2" class="status2 statusbtnon"><i class="fa-regular fa-circle-check"></i></strong>
                </div>
            </div>
            <div style="position: absolute;top: 22.5%;height: 10%;width: 100%;padding:5% 5%;">

                <input id="asisFilterInput" type="text" class="inputt" style="bottom:0;width:100%;background:var(--newprima);color:black;font-weight:bold;">

            </div>
        </div>
        <div class="export-menu-container">
                    <!-- Botón principal (disparador) -->
                    <div style="display:flex;gap:20px;">
                        <button class="export-toggle" onclick="toggleExportMenu()" time-tooltip="0.2" data-tooltip="Exportar">
                            <i class="fa-solid fa-download"></i>
                        </button>

                        <button class="export-toggle SecurityLevel3" onclick="toggleCreateAsisMenu()" time-tooltip="0.2" data-tooltip="Añadir un nuevo registro">
                            <i class="fa-solid fa-plus"></i>
                        </button>

                        <button class="export-toggle SecurityLevel3" onclick="" time-tooltip="0.2" data-tooltip="Generar todas las inasistencias">
                            <i class="fa-solid fa-list-ul"></i>
                        </button>

                        <div style="display:flex;gap:5px;"><!-- Cambiar estatus -->  
                            <button class="export-toggle SecurityLevel3" onclick="" time-tooltip="0.2" data-tooltip="Cambiar los registros seleccionados a inasistencias">
                                <i class="fa-solid fa-user-slash"></i>
                            </button>

                            <button class="export-toggle SecurityLevel3" onclick="" time-tooltip="0.2" data-tooltip="Cambiar los registros seleccionados a asistencias con retrasos">
                                <i class="fa-regular fa-clock"></i>
                            </button>

                            <button class="export-toggle SecurityLevel3" onclick="" time-tooltip="0.2" data-tooltip="Cambiar los registros seleccionados a asistencias a tiempo">
                                <i class="fa-regular fa-circle-check"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Menú desplegable -->
                    <div id = "exportMenu" class="export-menu">
                        <div style="position: absolute; bottom: 15px; left: 0px; display: flex; gap: 10px; z-index: 10;">
                            <button class="export-btn word" onclick="exportarWord()"    time-tooltip="1" data-tooltip="Exportar en Word"><i class="fas fa-file-word"></i> Word</button>
                            <button class="export-btn excel" onclick="exportarExcel()"  time-tooltip="1" data-tooltip="Exportar en Excel"><i class="fas fa-file-excel" ></i> Excel</button>
                            <button class="export-btn pdf" onclick="exportarPDF()"      time-tooltip="1" data-tooltip="Exportar en PDF"><i class="fas fa-file-pdf"></i> PDF</button>
                        </div>
                    </div>
                </div>
        <div style="width:100%;height:100%;padding:5% 5%;display:grid;grid-template-rows: 7% 93%;">
            <div class="cabezaregistro">

                <div id="tablesort0" class="AsisTableHeader" onclick="tablesort(0)" time-tooltip="2" data-tooltip="Ordenar por estatus"><p>S</p><i class="fa-solid"></i></div>
                <div id="tablesort1" class="AsisTableHeader" onclick="tablesort(1)" time-tooltip="2" data-tooltip="Ordenar por nombre"><p>NOMBRE</p><i class="fa-solid"></i></div>
                <div id="tablesort2" class="AsisTableHeader" onclick="tablesort(2)" time-tooltip="2" data-tooltip="Ordenar por fecha"><p>FECHA</p><i class="fa-solid"></i></div>

            </div>
            <div id="AsisScrollMenu" style="overflow-y:scroll;">

            </div>
        </div>
    </div>
<!--/////////////////////////////////////ESTADISTUCO////////////////////////////////////////////////-->
    <div id="AsisSecondDiv" class="hidden regasis sd">
        <div style="width:100%;height:100%;">

        <h3>Estadistico de Asistencias</h3>
        <div class="chart-container2">
            <canvas id="grafico"></canvas>
        </div>
        <button class="btx btn-futurista" onclick="cambia(0,1)" time-tooltip="1" data-tooltip="Alternar por un grafico de torta">Torta</button>
        <button class="btx btn-futurista" onclick="cambia(1,1)" time-tooltip="1" data-tooltip="Alternar por un grafico de barra">Barra</button>
        <button class="btx btn-futurista" onclick="cambia(2,1)" time-tooltip="1" data-tooltip="Alternar por un grafico de área polar">Área Polar</button>
        <button class="btx btn-futurista" onclick="cambia(3,1)" time-tooltip="1" data-tooltip="Alternar por un grafico de linea">linea</button>
        <button class="btx btn-futurista" onclick="cambia(4,1)" time-tooltip="1" data-tooltip="Alternar por un grafico de radar">Radar</button>
        
        <div style="margin-top: auto; font-size: 0.65rem; opacity: 0.4; text-align: right;">
            LIVELULA_CORE // UNIT_01
        </div>

        </div>
    </div>
<!--/////////////////////////////////////Panelwes de profe y asistenca////////////////////////////////////////////////-->
    <div id="AsisThirdDiv" class="hidden regasis td">
        <div style="width:100%;height:100%;">
                <div class="contenedor-principal">
                    <div style="display:grid;">
                        <div class="profStadisticsDiv" style="width:100%;height:100%;padding:10% 10%;">
                            <canvas id="profGrafico"></canvas>
                        </div>
                        <div style="display:flex;">
                            <button class="btx btn-futurista" onclick="cambia(0,0)" time-tooltip="1" data-tooltip="Alternar por un grafico de torta">Torta</button>
                            <button class="btx btn-futurista" onclick="cambia(1,0)" time-tooltip="1" data-tooltip="Alternar por un grafico de barra">Barra</button>
                            <button class="btx btn-futurista" onclick="cambia(2,0)" time-tooltip="1" data-tooltip="Alternar por un grafico de área polar">Área Polar</button>
                            <button class="btx btn-futurista" onclick="cambia(3,0)" time-tooltip="1" data-tooltip="Alternar por un grafico de linea">linea</button>
                            <button class="btx btn-futurista" onclick="cambia(4,0)" time-tooltip="1" data-tooltip="Alternar por un grafico de radar">Radar</button>
                        </div>
                    </div>
                    <!-- Panel Izquierdo: Registro -->
                    <div class="panelx panelx-derecho">
                        <div>
                        <h3><i class="fa-regular fa-clock"></i>Asistencia</h3>
                        <div id="saveasisinfo" class="SecurityLevel4 saveinfo oculto" style="right: 20px;position: absolute;top: 20px;" onclick="SaveAsisInfo();" time-tooltip="0.2" data-tooltip="Guardar"><i class="fa-regular fa-floppy-disk"></i></div>
                        </div>

                        <div class="registro-horas">
                            <div class="campo">
                                <label>Entrada:</label>
                                <input class="inputt" type="time" value="07:00" id="asiEntrada" readonly>
                            </div>
                            <div class="campo">
                                <label>Salida:</label>
                                <input class="inputt" type="time" value="13:00"  id="asiSalida" readonly>
                            </div>

                        </div>

                        <div class="status-container inputt">
                            <span class="status-text">Status:</span>
  
                            <div class="icons-group">
                            <i id="ina" class="nosoy fa-solid fa-circle-xmark icon-status absent"   title="Inasistente" onclick="changeStatus(0)"   time-tooltip="0.2" data-tooltip="Cambiar el estado a inasistente"></i>
                            <i id="ret" class="nosoy fa-solid fa-clock icon-status late"            title="Retraso" onclick="changeStatus(1)"       time-tooltip="0.2" data-tooltip="Cambiar el estado a asistencia con retraso"></i>
                            <i id="asi" class="nosoy fa-solid fa-circle-check icon-status assist"   title="Asistió" onclick="changeStatus(2)"       time-tooltip="0.2" data-tooltip="Cambiar el estado a asistencia a tiempo"></i>
                            </div>
                        </div>

                        <div class="campo">
                            <label>Nota del día:</label>
                            <textarea id="asisinfoDescripcion" class="inputt" placeholder="Escribe observaciones aquí..." readonly></textarea>
                        </div>
                    </div>

                                        <!-- Panel Derecho: Información -->
                    <div class="panelx panelx-izquierdo">
                        <div class="circulo-avatar" id="regavatar"></div>
                        
                        <div class="contenido">
                            <h2 class="nombre" id="regnombre"></h2>
                            <div class="tags" id="regtags">
                                
                            </div>
                            
                            <div class="stats">
                                <p><strong>Récord de asistencia: </strong><span id="regasis"></span></p>
                                <p><strong>Llegadas tarde: </strong><span id="reglate"></span></p>
                                <p><strong>Inasistencias: </strong><span id="regina"></span></p>
                            </div>
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

    <div id="AsisOnBtn" class="power-trigger hidden regasis" onclick="showAsisReg(0)" time-tooltip="0.2" data-tooltip="Cerrar">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--newprima)" stroke-width="2.5">
            <path d="M18.36 6.64a9 9 0 1 1-12.73 0M12 2v10"/></svg>
    </div>

    <div id="AsisCreateWrapper" class="hidden" onclick="AA_removecalendar()">
        <div class="closeaddasis" style="position:absolute;font-size:1.5rem;right:5%;top:2.5%;" onclick="closeAsisWrapper();" time-tooltip="2" data-tooltip="Cerrar"><i class="fa-regular fa-circle-xmark"></i></div>

        <fieldset style="height:100%;">
            <legend><h3>Añadir un nuevo registro</h3></legend>
            <div class="addAsisProfInfo">
                <div style="display:flex;align-items:center;justify-content:center;"><div class="circulo-avatar" id="addasisavatar"></div><i class="saveinfo fa-solid fa-user-pen" style="position:absolute;text-align: center;left: 60%;" onclick="AA_toggleProf();" time-tooltip="0.5" data-tooltip="Seleccionar un profesor"></i></div>
                <h2 class="nombre" id="addasisnombre" style="color:black;">Aaron Garcia</h2>
                <div class="tags" id="addasistags">informatica, calculo</div>
            </div>
            <div style="border-top: 2px solid gray;width:80%;justify-self:center;padding:2.5%;margin-top:2.5%;">
                
                <div class="status-container inputt" style="justify-self:center;">
                    <span class="status-text">Status:</span>
  
                    <div class="icons-group">
                        <i id="addina" class="nosoy fa-solid fa-circle-xmark icon-status absent" title="Inasistente"    onclick="AA_changestatus(0);"  time-tooltip="0.2" data-tooltip="Cambiar el estado a inasistente"></i>
                        <i id="addret" class="nosoy fa-solid fa-clock icon-status late" title="Retraso"                 onclick="AA_changestatus(1);"  time-tooltip="0.2" data-tooltip="Cambiar el estado a asistencia con retraso"></i>
                        <i id="addasis" class="nosoy fa-solid fa-circle-check icon-status assist" title="Asistió"       onclick="AA_changestatus(2);"  time-tooltip="0.2" data-tooltip="Cambiar el estado a asistencia a tiempo"></i>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;width:100%;margin-top:2.5%;">
                    <div>
                        <label for="addasisopen">Entrada:</label>
                        <input class="inputt" type="time" name="addasisopen" id="addasisopen" style="width: 90%;">
                    </div>
                    <div>
                        <label for="addasisclose">Salida:</label>
                        <input class="inputt" type="time" name="addasisclose" id="addasisclose" style="width: 90%;">
                    </div>
                </div>

                <div style="width:100%;margin-top:2.5%;">
                    <label for="addasisdate">Fecha:</label>
                    <input class="inputt" type="date" name="addasisdate" id="addasisdate" style="width: 95%;" readonly>
                </div>

                <div class="campo">
                    <label>Nota del día:</label>
                    <textarea id="addasisinfoDescripcion" class="inputt" placeholder="Escribe observaciones aquí..."></textarea>
                </div>
            </div>
        </fieldset>

        <div id="AA_calendar" class="hidden" style="position:absolute;right:-2%;" onclick="event.stopPropagation();">

            <div id="AA_Rcalendar">

            </div>
            <div style="display:grid;grid-template-columns: 40% 40%;margin-bottom:5px;width: 100%;justify-content:center;background:var(--newpoligono);border-radius:10px;padding:5px">

                <div class="calendaroption-div" onclick="AA_MyCalendar.move(0)">
                    <div class="calendaroption-btn"><i class="fa-solid fa-angle-left"></i></div>
                </div>

                <div class="calendaroption-div" onclick="AA_MyCalendar.move(1)">
                    <div class="calendaroption-btn"><i class="fa-solid fa-angle-right"></i></div>
                </div>

            </div>

        </div>

        <div class="addasissave" onclick="ADD_Save();"  time-tooltip="1" data-tooltip="Guardar"><i class="fa-solid fa-floppy-disk"></i></div>
    </div>

</div>




<script>
const AsisMenu = document.getElementById("AsisScrollMenu");
let todosLosRegistros = [];
let registrosVisibles = [];
let status0 = true;
let status1 = true;
let status2 = true;
let search = "";
let tablesortdir = 0;
let tablesortmode = 0;

let AsisID = -1;
let asisActualProfId = -1;

let record=0;
let inasistencias=0;
let tardanzas=0;
let asisinfoclickeable = 0;

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

function crearAsisTask(status,id,date,name,late,pid,entra,sale,description = ""){

    
    const MyProfesor = datosProfesores.find(u => u.id == id);
    
    const maindiv = document.createElement("div");
    maindiv.classList.add("AsisTarjeta");
    const statusdiv = document.createElement("div");
    const namediv = document.createElement("div");
    const datediv = document.createElement("div");

    const strong = document.createElement("strong");
    strong.textContent = name;
    namediv.appendChild(strong);

    datediv.textContent = date;

    

    var otherstatus = 0;

    if(status == 1 || status == 2){
        if(late == 0){
        statusdiv.classList.add("status2"); 
        statusdiv.innerHTML ='<i class="fa-regular fa-circle-check"></i>';
        otherstatus = 2;
        }else{
        statusdiv.classList.add("status1");    
        statusdiv.innerHTML ='<i class="fa-regular fa-clock"></i>';
        otherstatus = 1;
        }
    }else{
    statusdiv.classList.add("status0");   
    statusdiv.innerHTML ='<i class="fa-solid fa-user-slash"></i>';
    otherstatus = 0;
    }

    maindiv.addEventListener("click",()=>{
       updateProfeinfo(otherstatus,id,date,pid,entra,sale,description);
    });
    

    maindiv.appendChild(statusdiv);
    maindiv.appendChild(namediv);
    maindiv.appendChild(datediv);

    return maindiv;
    }
    
async function cargarDatosAsis() {
        const _Fecha = MyCalendar.startDate;
        const _FechaEnd = MyCalendar.endDate;
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
                    element.myHtml = crearAsisTask(element.estado,element.id,element.fecha,element.nombre,element.tardanza,element.profesorID,element.entrada,element.salida,element.detalles);

                    updateProfCard(asisActualProfId);

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
                    data: [0,0,0], 
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

        const ctx4 = document.getElementById('profGrafico').getContext('2d');
        const profestadistico2 = new Chart(ctx4, {
            type: 'doughnut', // Estilo dona para verse más moderno
            data: {
                labels: ['Asistentes', 'retardado', 'Inasistentes'],
                datasets: [{
                    data: [0,0,0], 
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
        });profestadistico2.update();


    function cambia(nu,nmb){

        const _profestadistico = nmb ? profestadistico : profestadistico2;

        _profestadistico.data.datasets[0].borderColor = '#39ff14'; // Verde neón sólido
        _profestadistico.data.datasets[0].borderWidth = 0;
        _profestadistico.options.scales = {}; // Limpiamos ejes previos
        _profestadistico.options.cutout = 0;
        if (nu==0){
            _profestadistico.config.type = 'doughnut';
            _profestadistico.options.cutout = "70%";
        }else
            if (nu==1){
            _profestadistico.config.type = 'bar';
            _profestadistico.options.scales = { y: { beginAtZero: true } };
        }else
            if (nu==2){
            _profestadistico.config.type = 'polarArea';
            _profestadistico.options.scales = { r: { grid: { color: 'rgba(255,255,255,0.1)' } } }
        }else 
        if (nu==3){
            _profestadistico.config.type = 'line';
            _profestadistico.data.datasets[0].borderWidth = 2;
            _profestadistico.options.scales = { y: { beginAtZero: true } };
        }else
        if (nu==4){
            _profestadistico.config.type = 'radar';
            _profestadistico.data.datasets[0].borderWidth = 2;
            _profestadistico.options.scales = {
            r: {
                angleLines: { color: 'rgba(255,255,255,0.2)' },
                grid: { color: 'rgba(255,255,255,0.2)' },
                pointLabels: { color: '#fff' },
                ticks: { display: false, backdropColor: 'transparent' }
            }
        };
        }
        _profestadistico.update();
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
    const _Fecha = MyCalendar.startDate;
    const _FechaEnd = MyCalendar.endDate;
    try {
        const res = await fetch('php/registro_profesor.php',{
            method: 'POST',headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id: id,
                start: _Fecha,
                end: _FechaEnd
            }),
        });
        const servidor = await res.json();
        if (servidor.success) {
            console.log("server",servidor);
            
            record=0;
            inasistencias=0;
            tardanzas=0;

            servidor.total.forEach(element => {
                if(element.estado == 0){
                    inasistencias++;
                }else{
                    if(element.tardanza == 1){
                        tardanzas++;
                    }else{
                        record++;
                    }
                }
            });

            return servidor.resultado[0];////no quitar esto denuevo :(
        }else{console.log(servidor.error);}
    } catch (e) {console.error("Error al traer info", e);}
    return null;
}

async function updateProfCard(pid){
if(pid == -1){return;}

elprofesor= await traerProfe(pid);
if(elprofesor){
        const name = elprofesor.nombre;
        const tags = JSON.parse(elprofesor.tags || "[]");
        creafoto(document.getElementById("regavatar"),pid,name);
        document.getElementById("regnombre").textContent=name;
        document.getElementById("regtags").textContent=Array.isArray(tags) ? tags.join(", ") : "";
        document.getElementById("regasis").textContent=record;
        document.getElementById("reglate").textContent=tardanzas;
        document.getElementById("regina").textContent=inasistencias;

        profestadistico2.data.datasets[0].data = [record,tardanzas,inasistencias];
        profestadistico2.update();
    }else{

        document.getElementById("regavatar").textContent="D";
        document.getElementById("regnombre").textContent="desconocido";
        document.getElementById("regtags").textContent="";
        document.getElementById("regasis").textContent="0";
        document.getElementById("reglate").textContent="0";
        document.getElementById("regina").textContent="0";

        profestadistico2.data.datasets[0].data = [0,0,0];
        profestadistico2.update(); 

    }

}

function updateProfeinfo(status,id,date,pid,entra,sale,description = ""){

    if(id != AsisID){
    updateProfCard(pid);

        document.getElementById("asiEntrada").value=entra;
        document.getElementById("asiSalida").value=sale;
        document.getElementById("asisinfoDescripcion").value=description;
        losestatus=[document.getElementById("ina"),document.getElementById("ret"),document.getElementById("asi")]
        losestatus.forEach((ele,i)=>{
            if(i==status){
                ele.classList.add("soy");
                ele.classList.remove("nosoy");
            }else{
                ele.classList.remove("soy");
                ele.classList.add("nosoy");
            }
        });
    

    const lvl = localStorage.getItem('user_level');

    if(lvl >= 4){

        document.getElementById("asiEntrada").readOnly = false;
        document.getElementById("asiSalida").readOnly = false;
        document.getElementById("asisinfoDescripcion").readOnly = false;

    }else{

        document.getElementById("asiEntrada").readOnly = true;
        document.getElementById("asiSalida").readOnly = true;
        document.getElementById("asisinfoDescripcion").readOnly = false;

    }

    document.getElementById("saveasisinfo").classList.remove("oculto");

    asisinfoclickeable = 1;

    AsisID = id;
    asisActualProfId = pid;
    }else{

    document.getElementById("regavatar").textContent = "";
        document.getElementById("regnombre").textContent="";
        document.getElementById("regtags").textContent="";
        document.getElementById("regasis").textContent="";
        document.getElementById("regina").textContent="";
        document.getElementById("reglate").textContent="";

    losestatus=[document.getElementById("ina"),document.getElementById("ret"),document.getElementById("asi")]
        losestatus.forEach((ele,i)=>{
                ele.classList.remove("soy");
                ele.classList.add("nosoy");
            });

    document.getElementById("asiEntrada").value = "";
    document.getElementById("asiSalida").value = "";
    document.getElementById("asisinfoDescripcion").value = "";

    document.getElementById("asiEntrada").readOnly = false;
    document.getElementById("asiSalida").readOnly = false;
    document.getElementById("asisinfoDescripcion").readOnly = false;

    document.getElementById("saveasisinfo").classList.add("oculto");

    profestadistico2.data.datasets[0].data = [0,0,0];
    profestadistico2.update();

    AsisID = -1;
    asisActualProfId = -1;
    }
}

async function getonlydays() {
            
            try {
                const res = await fetch('php/asistencia/get_onlydays.php',{
                    method: 'POST',headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                
                    }),
                });

                const servidor = await res.json();
                if(servidor.success){

                MyCalendar.diasConRegistro = {};
                
                servidor.days.forEach(fechaStr => {

                    const [year, month, day] = fechaStr.split('-');

                    if (!MyCalendar.diasConRegistro[year]) {
                       MyCalendar.diasConRegistro[year] = {};
                    }
                    if (!MyCalendar.diasConRegistro[year][month]) {
                        MyCalendar.diasConRegistro[year][month] = [];
                    }

                    if (!MyCalendar.diasConRegistro[year][month].includes(day)) {
                        MyCalendar.diasConRegistro[year][month].push(day);
                    }
                });

                console.log("dias",MyCalendar.diasConRegistro)

                MyCalendar.generarCalendario();

                }
                else{
                console.error("Error en la base de datos:", servidor.mensaje);
                }
            } catch (e) { 
                console.error("Error en el servidor:", e);
            }
        }


        function changeStatus(_nmb){

        if(asisinfoclickeable == 0){return;}

        const lvl = localStorage.getItem('user_level');

            if(lvl >= 4){

            const losestatus=[document.getElementById("ina"),document.getElementById("ret"),document.getElementById("asi")]
                losestatus.forEach((ele,i)=>{
                    if(i==_nmb){
                        ele.classList.add("soy");
                        ele.classList.remove("nosoy");
                    }else{
                        ele.classList.remove("soy");
                        ele.classList.add("nosoy");
                    }
                });
            }

        }

        function AC_clean(){
            const AC_Status=[document.getElementById("ina"),document.getElementById("ret"),document.getElementById("asi")]
        
            const AC_opentime = document.getElementById("asiEntrada");
            const AC_closetime = document.getElementById("asiSalida");
            const AC_description = document.getElementById("asisinfoDescripcion");

            const AC_SaveButton = document.getElementById("saveasisinfo");

            AC_Status.forEach((ele)=>{
                ele.classList.remove("soy");
                ele.classList.add("nosoy"); 
                });

            AC_opentime.value = "";
            AC_closetime.value = "";
            AC_description.value = "";

            if(!AC_SaveButton.classList.contains("oculto")){
                AC_SaveButton.classList.add("oculto");
                }

            AsisID = -1;
            }

        function PC_clean(){
            const PC_Avatar = document.getElementById("regavatar");
            const PC_Nombre = document.getElementById("regnombre");
            const PC_Tags = document.getElementById("regtags");
            const PC_Asis = document.getElementById("regasis");
            const PC_Late = document.getElementById("reglate");
            const PC_Inasis = document.getElementById("regina");

            PC_Avatar.textContent="";
            PC_Nombre.textContent="";
            PC_Tags.textContent="";
            PC_Asis.textContent="";
            PC_Late.textContent="";
            PC_Inasis.textContent="";

            profestadistico2.data.datasets[0].data = [0,0,0];
            profestadistico2.update();

            asisActualProfId = -1;
            }

        async function SaveAsisInfo(){

            let inasis = 0;if(document.getElementById("ina").classList.contains("soy")){inasis = 1;}
            let tarde = 0;if(document.getElementById("ret").classList.contains("soy")){tarde = 1;}

            const _id = AsisID;
            const state = inasis ? 0 : 2;
            const late = tarde ? 1 : 0;
            const opentime = document.getElementById("asiEntrada").value;
            const closetime = document.getElementById("asiSalida").value;
            const description = document.getElementById("asisinfoDescripcion").value;

            const info = {id: _id, state: state, tardanza: late, opentime: opentime, closetime: closetime, description: description}

            try {
                const res = await fetch('php/asistencia/edit_asis.php',{
                    method: 'POST',headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(info),
                });

                const servidor = await res.json();
                console.log(servidor)
                if(servidor.success){

                cargarDatosAsis();
                AC_clean();
                PC_clean();

                }
                else{
                console.error("Error en la base de datos:", servidor.mensaje);
                }
            } catch (e) { 
                console.error("Error en el servidor:", e);
            }

            }

    const AA_Wrapper              = document.getElementById("AsisCreateWrapper");
            
    const AA_Avatar               = document.getElementById("addasisavatar");
    const AA_AvatarNombre         = document.getElementById("addasisnombre");
    const AA_AvatarTags           = document.getElementById("addasistags");

    const AA_StatusInactivo       = document.getElementById("addina");
    const AA_StatusRetardo        = document.getElementById("addret");
    const AA_StatusAsistencia     = document.getElementById("addasis");

    const AA_InputTimeS           = document.getElementById("addasisopen");
    const AA_InputTimeE           = document.getElementById("addasisclose");
    const AA_InputDate            = document.getElementById("addasisdate");
    const AA_InputDescription     = document.getElementById("addasisinfoDescripcion");

    let AA_ProfID = -1;
    let AA_Status = 0;
    let AA_Tardanza = 0;

    let AA_Open = false;

function closeAsisWrapper(){

    if(AA_Wrapper.classList.contains("hidden")){return;}

    AA_Wrapper.classList.add("hidden");
    AA_Wrapper.classList.remove("AA_panel");

    AA_Open = false;

    const panel = document.getElementById('panelGestion');
    const boton = document.getElementById('toggle-panel');

    if (!panel.classList.contains('hidden')) {
        panel.classList.add('hidden');
        boton.innerHTML = '☰';
        document.getElementById('toggle-panel').classList.add('ocultoboton');
        } 

    AA_removecalendar();
    }

function toggleCreateAsisMenu(){

    if(!AA_Wrapper.classList.contains("hidden")){return;}

    AA_Wrapper.classList.remove("hidden");
    AA_Wrapper.classList.remove("AA_panel");

    AA_Avatar.textContent = "";
    AA_AvatarNombre.textContent = "";   
    AA_AvatarTags.textContent = "";            

    AA_InputTimeS.value = "";           
    AA_InputTimeE.value = "";           
    AA_InputDate.value = "";           
    AA_InputDescription.value = "";    

    AA_StatusInactivo.classList.remove("soy");    
    AA_StatusRetardo.classList.remove("soy");        
    AA_StatusAsistencia.classList.remove("soy"); 

    AA_StatusInactivo.classList.remove("nosoy");    
    AA_StatusRetardo.classList.remove("nosoy");        
    AA_StatusAsistencia.classList.remove("nosoy");   

    AA_StatusInactivo.classList.add("soy");
    AA_StatusRetardo.classList.add("nosoy");        
    AA_StatusAsistencia.classList.add("nosoy");
    
    AA_ProfID = -1;
    AA_Status = 0;
    AA_Tardanza = 0;

    AA_Open = true;
    }

function AA_changestatus(_nmb){

    AA_StatusInactivo.classList.remove("soy");    
    AA_StatusRetardo.classList.remove("soy");        
    AA_StatusAsistencia.classList.remove("soy"); 

    AA_StatusInactivo.classList.remove("nosoy");    
    AA_StatusRetardo.classList.remove("nosoy");        
    AA_StatusAsistencia.classList.remove("nosoy");   

if(_nmb == 0){

    AA_StatusInactivo.classList.add("soy");
    AA_StatusRetardo.classList.add("nosoy");        
    AA_StatusAsistencia.classList.add("nosoy");

    let AA_Status = 0;
    let AA_Tardanza = 0;

    }else if(_nmb == 1){

    AA_StatusInactivo.classList.add("nosoy");
    AA_StatusRetardo.classList.add("soy");        
    AA_StatusAsistencia.classList.add("nosoy");

    let AA_Status = 2;
    let AA_Tardanza = 1;

    }else if(_nmb == 2){

    AA_StatusInactivo.classList.add("nosoy");
    AA_StatusRetardo.classList.add("nosoy");        
    AA_StatusAsistencia.classList.add("soy");

    let AA_Status = 2;
    let AA_Tardanza = 0;

    }



}

function AA_toggleProf(){

const panel = document.getElementById('panelGestion');
const boton = document.getElementById('toggle-panel');

panel.classList.toggle('hidden');

if (panel.classList.contains('hidden')) {
    boton.innerHTML = '☰';
    boton.classList.add('ocultoboton');
    if(document.getElementById('sidePanel').classList.contains("active")){togglexPanel(0,0);}
    enpanelprofesor=false;
    
    AA_Wrapper.classList.remove('AA_panel');
    
    } else {
    boton.innerHTML = '✕';
    boton.classList.remove('ocultoboton');
    panel.classList.add("AA_panel");
    boton.classList.add("AA_panel");
    AA_Wrapper.classList.add('AA_panel');
    P_BarDefault();
    }

}                

async function ADD_Save(){

const _profesorID   = AA_ProfID;
const _TimeStart    = AA_InputTimeS.value;
const _TimeEnd      = AA_InputTimeE.value;
const _TimeDate     = AA_InputDate.value;
const _State        = AA_Status;
const _Late         = AA_Tardanza;
const _Details      = AA_InputDescription.value;

if(_profesorID == -1){msj("Error: Asigna a un profesor",2);return;}
if(_TimeStart == ""){msj("Error: Asigna una hora de entrada",2);return;}
if(_TimeEnd == ""){msj("Error: Asigna una hora de salida",2);return;}
if(_TimeDate == ""){msj("Error: Asigna una fecha",2);return;}

/*const d1 = new Date(`2000-01-01T${_TimeStart}`);
const d2 = new Date(`2000-01-01T${_TimeEnd}`);*/

if(_TimeEnd < _TimeStart){msj("Error: la fecha de salida no puede ser menor a la hora de entrada",2);return;}


try {
    const respuesta = await fetch('php/asistencia/create_reg.php', {
    method: 'POST',
    headers: {
    'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        profId: _profesorID,   
        timeStart: _TimeStart,   
        timeEnd: _TimeEnd,     
        timeDate: _TimeDate,     
        state: _State,        
        late: _Late,         
        details: _Details 
        })
    });
    const resultado = await respuesta.json(); 
    if (resultado.success) {
        
        await msj("Registro guardado con exito");
        cargarDatosAsis();
        closeAsisWrapper();
        getonlydays();

        } else {
            msj("respuesta: " + resultado.error,2);
        }
    } catch (error) {
    console.error("Error al enviar: ", error);
    }


}
const AA_calendarDiv = document.getElementById("AA_calendar");
const AA_RcalendarDiv = document.getElementById("AA_Rcalendar");

const calendarDiv = document.getElementById("calendario-container");

AA_InputDate.addEventListener("click", () => {event.stopPropagation();AA_showcalendar()});

function AA_showcalendar(){
    if(AA_calendarDiv.classList.contains("hidden")){
        AA_calendarDiv.classList.remove("hidden");
        calendarDiv.classList.add("hidden");
        }
    }

function AA_removecalendar(){
    if(!AA_calendarDiv.classList.contains("hidden")){
        AA_calendarDiv.classList.add("hidden");
        calendarDiv.classList.remove("hidden");
        }
    }

const AA_MyCalendar = new Schedule(AA_RcalendarDiv);

AA_MyCalendar.addFunction((e) => {

AA_InputDate.value = e.date; 
AA_removecalendar();

});

</script>