<?php
// 1. Evitar que el navegador almacene la página en el historial (Caché)
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// 2. Comprobar la sesión
include 'includes/session_check.php';

// Si el check de sesión falla, el usuario no verá NADA de lo que sigue abajo
?>

<?php
    include "php/conexion.php";

    $sql = "SELECT id, nombre, tags FROM caras WHERE activo = 1 ORDER BY nombre ASC";
    $stmt = $pdo->query($sql);
    $profesores = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.A.R.S. - Registro de Asistencia</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/asistencia.css">
</head>
<body>

<?php include 'php/extras/navbar.php'; ?>

<div id="profesorlist" class="oculto" style="overflow:hidden;position:absolute;width:50%;max-height:50%;min-height:50%;background-color:white;top:70px;right:20px;border-radius:10px;">
    <div class="search-wrap" style="margin-top:10px;">
        <input class="search-input" type="text" id="buscador" placeholder="🔍 Buscar profesor...">
    </div>
    <div style="display: flex;height: 230px;">
        <div id="profesorcontainer" style="display:block; width:100%;margin-top:10px;" class="scrolleable">
        
        </div>
    </div>
</div>

<div id="calendardiv" class="" style="display:flex;overflow:hidden;position:absolute;width:50%;max-height:50%;min-height:50%;background-color:white;top:70px;right:20px;border-radius:10px;justify-content:center">
    <div style="width:100%;background-color:white;border-radius:50px;align-items:center;display:block;justify-self:center">
        <div style="padding-top:5px;padding-left:50px;padding-right:50px;max-height:50px;">
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
            <div id="calendar" style="width: 100%; height: 100%; max-height:280px;"></div>
        </div>
    </div>
</div>

<main class="main">
    <div style="display:grid;width:50%;">
        <div class="page-header">
            <div class="header-left">
                <h1 class="page-title">REGISTRO DE <span>ASISTENCIA</span></h1>
                <div class="page-date" id="fecha-hoy"></div>
                <br><br>
            </div>
        </div>

    
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Total registros</div>
                <div class="stat-value" id="stat-total">—</div>
            </div>
            <div class="stat-card green">
                <div class="stat-label">Puntuales</div>
                <div class="stat-value" id="stat-puntual">—</div>
            </div>
            <div class="stat-card red">
                <div class="stat-label">Tardanzas</div>
                <div class="stat-value" id="stat-tarde">—</div>
            </div>
        </div>
        <div style="display:flex;justify-content:center">
            <input id="filtrostart" class="dateInput selected" type="date" readonly style="width:120px;height:30px;font-size:15px;border-radius:5px;"> -
            <input id="filtroend" class="dateInput" type="date" readonly style="width:120px;height:30px;font-size:15px;border-radius:5px;">
        </div>
    </div>

                

    <div class="toolbar" style="justify-content: flex-end;">
        <div class="toolbar-actions">
            <button class="btn btn-white" onclick="toggleCalendar()">Calendario</button>
            <button class="btn btn-white" onclick="togglePList()">Profesores</button>
            <div class="toolbar-actions">
            <button class="btn btn-white" onclick="cargarDatos()">Recargar</button>
                <div class="dropdown">
                <button class="btn btn-white">Exportar ▼</button>
                    <div class="dropdown-content">
                    <a href="#" onclick="descargarPDF(); return false;">📄 Documento PDF</a>
                    <a href="#" onclick="descargarExcel(); return false;">📊 Hoja de Excel</a>
                    <a href="#" onclick="descargarWord(); return false;">📝 Documento Word</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-wrap">
        <div id="registrydiv" class="table-inner">
            <table id="tabla-asistencia">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profesor</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr>
                        <td colspan="5">
                            <div style="text-align:center; padding: 40px;">
                                <div class="spinner"></div>
                                <p style="margin-top:10px; color: var(--text-dim);">Sincronizando registros...</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>



<script>
let profesorName = -1;

const registrydiv = document.getElementById("registrydiv");
const calendardiv = document.getElementById("calendardiv");

const inputstart = document.getElementById("filtrostart");
const inputend = document.getElementById("filtroend");

const fecha = new Date();
const yyyy = fecha.getFullYear();
const mm = String(fecha.getMonth() + 1).padStart(2, '0');
const dd = String(fecha.getDate()).padStart(2, '0');

const hoy = `${yyyy}-${mm}-${dd}`;

inputstart.value = hoy;
inputend.value = hoy;

inputstart.addEventListener("click", (e) => {
e.preventDefault();

if(!inputstart.classList.contains("selected")){
    inputstart.classList.add("selected");
    }

inputend.classList.remove("selected");

document.getElementById("calendardiv").classList.remove("oculto");
    calendar.updateSize();
    if(!document.getElementById("profesorlist").classList.contains("oculto")){document.getElementById("profesorlist").classList.add("oculto");}
    })

inputend.addEventListener("click", (e) => {
e.preventDefault();

if(!inputend.classList.contains("selected")){
    inputend.classList.add("selected");
    }

inputstart.classList.remove("selected");
document.getElementById("calendardiv").classList.remove("oculto");
    calendar.updateSize();
    if(!document.getElementById("profesorlist").classList.contains("oculto")){document.getElementById("profesorlist").classList.add("oculto");}       
    })

    document.addEventListener('DOMContentLoaded', async function() {
    inicializarOReferescarCalendario();
        });

let calendar;
let fechasGlobales = [];

function aplicarIluminacionCeldas(info) {
    info.el.classList.remove('fc-day-with-registry');
    info.el.style.cursor = '';
    const fechaCelda = info.date.toLocaleDateString('sv-SE');

    if (fechasGlobales.includes(fechaCelda)) {
        const numDia = info.el;
        if (numDia) {
            numDia.classList.add('fc-day-with-registry');
            info.el.style.cursor = 'pointer';
            }
        }
    }

async function inicializarOReferescarCalendario() {
    const respuesta = await fetch('php/asistencia/get_allasisdays.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ filter: profesorName })
        });

    const res = await respuesta.json();
    fechasGlobales = res.data.map(item => item.fecha);

    if (!calendar) {
        const calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            // Pasamos la referencia de la función
            dayCellDidMount: function(info) {
                aplicarIluminacionCeldas(info);
                },
            dateClick: function(info) {
                if (fechasGlobales.includes(info.dateStr)) {

                    if(inputstart.classList.contains("selected")){
                        inputstart.value = info.dateStr;
                        inputstart.classList.remove("selected");
                        inputend.classList.add("selected");

                        if(info.dateStr > inputend.value){
                            inputend.value = info.dateStr;
                            }
                        }  
                    else if(inputend.classList.contains("selected")){
                        if(info.dateStr >= inputstart.value){
                            inputend.value = info.dateStr;
                            inputstart.classList.add("selected");
                            inputend.classList.remove("selected");
                                }
                            }     
                        
                    cargarDatos();
                    }
                }
            });
        calendar.render();
        } else {
            calendar.destroy();
            calendar = null;
            inicializarOReferescarCalendario(); 
            }
    }

    function togglePList(){
        document.getElementById("profesorlist").classList.toggle("oculto");
        if(!document.getElementById("calendardiv").classList.contains("oculto")){document.getElementById("calendardiv").classList.add("oculto");}
        }

    let todosLosRegistros = [];

    const ahora = new Date();
    document.getElementById('fecha-hoy').textContent =
        ahora.toLocaleDateString('es-ES', { weekday:'long', year:'numeric', month:'long', day:'numeric' }).toUpperCase();

    function badgeEstado(estado) {
        const e = (estado || '').toLowerCase().trim();
        if (e.includes('puntual'))  return `<span class="badge badge-puntual">${estado}</span>`;
        if (e.includes('tard'))     return `<span class="badge badge-tardanza">${estado}</span>`;
        if (e.includes('ausente'))  return `<span class="badge badge-ausente">${estado}</span>`;
        return `<span class="badge badge-otro">${estado || 'N/D'}</span>`;
        }

    function renderTabla(registros) {
        let nmb = 0;
        const tbody = document.getElementById('tbody');
        if (registros.length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding:40px;">Sin registros</td></tr>`;
            return;
            }
            tbody.innerHTML = registros.map((r, i) => `
            <tr style="animation-delay:${i * 0.04}s">
                <td>${nmb++}</td>
                <td style="font-weight:700;">${r.nombre}</td>
                <td>${r.entrada || '—'}</td>
                <td>${r.salida || '—'}</td>
                <td>${r.fecha}</td>
            </tr>
            `).join('');
            }

    async function cargarDatos() {
        const _Fecha = inputstart.value;
        const _FechaEnd = inputend.value;
        try {
            const res  = await fetch('php/asistencia/get_asistencia_dia.php', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({sdia: _Fecha, edia: _FechaEnd, filtro: profesorName}) 
                });

            const json = await res.json();
            console.log(json)
            if (json.success) {
                todosLosRegistros = json.data;
                renderTabla(todosLosRegistros);
                document.getElementById('stat-total').textContent = todosLosRegistros.length;
                document.getElementById('stat-puntual').textContent = todosLosRegistros.filter(r => (r.estado||'').toLowerCase().includes('puntual')).length;
                document.getElementById('stat-tarde').textContent = todosLosRegistros.filter(r => (r.estado||'').toLowerCase().includes('tard')).length;
                registrydiv.classList.remove("oculto");
                }

            } catch (err) {
                console.error("Error al cargar datos:", err);
                }
        }

    function changeProfesorSelected(_filter = ""){
        const filter = _filter.trim();
        profesorName = filter;       
        if(filter == ""){profesorName = -1;}
        inicializarOReferescarCalendario();
        console.log(todosLosRegistros);
        const filtrados = todosLosRegistros.filter(r => {
            if(profesorName != -1){
                return r.nombre.toLowerCase() == filter.toLowerCase();
                }else{
                    return true;
                    }
            });
        renderTabla(filtrados);
        }            

    document.getElementById('buscador').addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        refreshProfessorList(q);          
        });
    const datosProfesores = <?php echo json_encode($profesores); ?>;
    const allProfesors = [];
    datosProfesores.forEach (prof => {
        const myAllprofesorID = allProfesors.length;
        const id = prof.id;
        const nombre = prof.nombre;
        const tags = JSON.parse(prof.tags) || [];
        allProfesors.push({
            id,
            nombre,
            tags,
            element: createCard(id,nombre,tags),
            idap: myAllprofesorID
            });
        });

    function createCard(_ID, _Name, _Tags){
        const card = document.createElement("div");
        card.classList.add("item-seccion");
        const Name = document.createElement("strong");
        Name.textContent = "🌟"+_Name+" ";   
        const Tags = document.createElement("small");  
        const realtags = _Tags.filter(tag => tag != "activo").join(", ");
        card.setAttribute("data-nombre",_Name);
        if(realtags != ""){
            Tags.textContent = "tags: "+realtags;        
            }

        card.appendChild(Name);
        card.appendChild(Tags);

        card.addEventListener("click", () => {
            if(card.classList.contains("selected")){
                card.classList.remove("selected");
                changeProfesorSelected("");
                }else{         
                allProfesors.forEach(prof => {
                    prof.element.classList.remove("selected");
                    });
                card.classList.add("selected");
                changeProfesorSelected(card.getAttribute("data-nombre"));
                }  
            });
        return card;
        }

    function refreshProfessorList(search = ""){
        const listContainer = document.getElementById('profesorcontainer');
        listContainer.innerHTML = '';
        trueSearch = "";

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

        allProfesors.forEach(prof => {
            if (!search) {
                listContainer.appendChild(prof.element);
                return;
                }

            var include = 0;

            if(prof.nombre.toLowerCase().includes(trueSearch.toLowerCase().trim()) && trueSearch.trim() !== ""){
                if(searchTerms.length === 0){
                    include += 2;
                    }else {
                    include += 1;
                    }
                } 

            if(trueSearch.trim() === ""){
                include += 1;
                }

            if (searchTerms.length > 0 && prof.tags.length > 0) {
                const profTagsLower = prof.tags.map(t => t.toLowerCase());
            const allTermsMatched = searchTerms.every(term => {
                const foundIndex = profTagsLower.findIndex(tag => tag.includes(term)); 
                if (foundIndex !== -1) {
                    profTagsLower.splice(foundIndex, 1);
                    return true;
                    }
                return false;
                });
                if (allTermsMatched) {
                    include += 1;
                    }
                }
            if(include === 2){
                listContainer.appendChild(prof.element);
                }
            console.log(prof.nombre, include);
        });
    }

    function descargarPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({ orientation: 'landscape' });
        doc.text("Registro de Asistencia M.A.R.S.", 14, 15);
        doc.autoTable({ html: '#tabla-asistencia', margin: { top: 25 } });
        doc.save("asistencia_mars.pdf");
        }

    function descargarExcel() {
        let tabla = document.getElementById("tabla-asistencia");
        let wb = XLSX.utils.table_to_book(tabla, {sheet: "Asistencia"});
        XLSX.writeFile(wb, "asistencia_mars.xlsx");
        }

    function descargarWord() {
        let header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
             "xmlns:w='urn:schemas-microsoft-com:office:word' " +
             "xmlns='http://www.w3.org/TR/REC-html40'>" +
             "<head><meta charset='utf-8'><title>Registro de Asistencia M.A.R.S.</title></head><body>" + 
             "<h2>Registro de Asistencia M.A.R.S.</h2>";
        let footer = "</body></html>";
        
        let tablaHTML = document.getElementById("tabla-asistencia").outerHTML;
        let sourceHTML = header + tablaHTML + footer;

        let source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        let fileDownload = document.createElement("a");
        document.body.appendChild(fileDownload);
        fileDownload.href = source;
        fileDownload.download = 'asistencia_mars.doc';
        fileDownload.click();
        document.body.removeChild(fileDownload);
        }

    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.reload();
            }
        };

    (function (global) {
        if(typeof (global) === "undefined") {
            throw new Error("window is undefined");
            }
        var _hash = "!";
        var noBackPlease = function () {
            global.location.href += "#";
            global.setTimeout(function () {
                global.location.href += "!";
                }, 50);
            };
        global.onhashchange = function () {
            if (global.location.hash !== _hash) {
                global.location.hash = _hash;
                }
            };
        global.onload = function () {
            noBackPlease();
            document.body.onkeydown = function (e) {
                var elm = e.target.nodeName.toLowerCase();
                if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                    e.preventDefault();
                    }
                e.stopPropagation();
                };
            }
        })(window);

    refreshProfessorList();

    function toggleCalendar(){
        document.getElementById("calendardiv").classList.toggle("oculto");
        calendar.updateSize();
        if(!document.getElementById("profesorlist").classList.contains("oculto")){document.getElementById("profesorlist").classList.add("oculto");}
        }

    cargarDatos()
</script>

<?php include 'php/extras/footer.php';?>

</body>
</html>