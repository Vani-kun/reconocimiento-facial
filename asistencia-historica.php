<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

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
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
</head>
<body>

<?php include 'php/extras/navbar.php'; ?>

    <div id="main-panel-container">

        <div style="display: flex; background-color: #265d63; padding: 5px 10px 0 10px;">
            <div id="tab-profesores" class="tab-item active" onclick="switchTab('profesores')" style="padding: 10px 20px; cursor: pointer; background: #e0f2f1; border-radius: 10px 10px 0 0; font-weight: bold; color: #265d63; margin-right: 5px;">
                Profesores
            </div>
            <div id="tab-calendario" class="tab-item" onclick="switchTab('calendario')" style="padding: 10px 20px; cursor: pointer; background: #60949a; border-radius: 10px 10px 0 0; font-weight: bold; color: white;">
                Calendario
            </div>
        </div>

        <div id="panel-content" style="flex-grow: 1; padding: 10px; position: relative; height: calc(100% - 40px);">

            <div id="section-profesores" style="display: none; height: 100%; width:100%;">
                <div class="search-wrap" style="margin-bottom:10px;">
                    <input class="search-input" type="text" id="buscador" placeholder="🔍 Buscar profesor..." style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                </div>
                <div id="profesorcontainer" class="scrolleable" style="height: calc(100% - 50px); overflow-y: auto;">
                </div>
            </div>

            <div id="section-calendario" style="display: none; height: 100%; width: 100%;">
                <div style="background: white; border-radius: 10px; padding: 5px; height: 100%; box-sizing: border-box; display: flex; flex-direction: column;">
                    <div id="calendar" style="height: 100%; width: 100%;"></div>
                </div>
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
            <button class="btn btn-white" onclick="toggleCalendar()">Filtro</button>
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

const inputstart = document.getElementById("filtrostart");
const inputend = document.getElementById("filtroend");

const fecha = new Date();
const yyyy = fecha.getFullYear();
const mm = String(fecha.getMonth() + 1).padStart(2, '0');
const dd = String(fecha.getDate()).padStart(2, '0');

const hoy = `${yyyy}-${mm}-${dd}`;

inputstart.value = hoy;
inputend.value = hoy;

function toggleCalendar() {
    const panel = document.getElementById('main-panel-container');
    if (panel.classList.contains('active')) {
        panel.classList.remove('active');
    } else {
        panel.classList.add('active');
        switchTab('calendario');
        if (calendar) {
            setTimeout(() => calendar.updateSize(), 420);
        } else {
            inicializarOReferescarCalendario();
        }
    }
}

// --- ESTE ES EL QUE DEBE QUEDAR ---
inputstart.addEventListener("click", (e) => {
    e.preventDefault();
    inputstart.classList.add("selected");
    inputend.classList.remove("selected");
    
    toggleCalendar(); // Esta función ya abre el panel y pone la pestaña correcta
});

inputend.addEventListener("click", (e) => {
    e.preventDefault();
    inputend.classList.add("selected");
    inputstart.classList.remove("selected");
    
    toggleCalendar();
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
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                // --- MEJORAS DE TAMAÑO ---
                height: '100%',        
                expandRows: true,      
                aspectRatio: 0.5,      
                handleWindowResize: true,
                stickyHeaderDates: true,
    
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
        registros.map((r,i) => `<tr>...<td> ${i + 1}</td>...1`);
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

    // --- Lógica para el control de la Interfaz de Pestañas ---

function switchTab(tabName) {
    const sectionProf = document.getElementById('section-profesores');
    const sectionCal = document.getElementById('section-calendario');
    const tabProf = document.getElementById('tab-profesores');
    const tabCal = document.getElementById('tab-calendario');

    const colorActivoBg = '#e0f2f1'; // Fondo claro
    const colorActivoTexto = '#265d63'; // Verde oscuro
    const colorInactivoBg = '#60949a'; // Verde medio/opaco
    const colorInactivoTexto = '#ffffff'; // Blanco

    if (tabName === 'profesores') {
        sectionProf.style.display = 'block';
        sectionCal.style.display = 'none';
        
        // Estilo Pestaña Profesor Activa
        tabProf.style.backgroundColor = colorActivoBg;
        tabProf.style.color = colorActivoTexto;
        
        // Estilo Pestaña Calendario Inactiva
        tabCal.style.backgroundColor = colorInactivoBg;
        tabCal.style.color = colorInactivoTexto;
    } else {
        sectionProf.style.display = 'none';
        sectionCal.style.display = 'block';
        
        // Estilo Pestaña Calendario Activa
        tabCal.style.backgroundColor = colorActivoBg;
        tabCal.style.color = colorActivoTexto;
        
        // Estilo Pestaña Profesor Inactiva
        tabProf.style.backgroundColor = colorInactivoBg;
        tabProf.style.color = colorInactivoTexto;
        
        //Reajustar el calendario para que no se vea pequeño
        if (typeof calendar !== 'undefined' && calendar !== null) {
            setTimeout(() => {
                calendar.updateSize();
            }, 0);
        }
    }
}

// Sobrescribimos tus funciones de botones del Navbar para que controlen el nuevo panel
function togglePList() {
    const panel = document.getElementById('main-panel-container');
    if (panel.classList.contains('active')) {
        panel.classList.remove('active');
    } else {
        panel.classList.add('active');
        switchTab('profesores');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Esto prepara el calendario internamente aunque el panel esté oculto
    inicializarOReferescarCalendario();
});

    refreshProfessorList();
    cargarDatos()
</script>


</body>
</html>