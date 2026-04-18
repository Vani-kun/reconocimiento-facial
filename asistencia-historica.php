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

    <style>
        :root {
            --color-detectado: rgb(0, 255, 234);
            --color-no-detectado: #7d27df;
            --color-fondo: #f4f4f4;
            --color-boton: #1336ff;
            --azul-glow: rgba(65, 105, 225, 0.4);
            --cyan: #00FFFF;
            --cyan-dim: rgba(0, 255, 255, 0.12);
            --green: #00d9ff;
            --green-dim: rgba(0, 174, 255, 0.12);
            --red: #601ae2;
            --red-dim: rgba(231, 76, 60, 0.12);
            --yellow: #f1c40f;
            --surface: #ffffff;
            --surface2: #eef1fb;
            --border: #d0d8f5;
            --text: #2c3e6b;
            --fc-today-bg-color: white;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: var(--color-fondo);
            color: var(--text);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- AQUÍ EMPIEZA TODO TU DISEÑO ORIGINAL DE M.A.R.S. --- */
        .main { max-width: 1300px; margin: 0 auto; padding: 2.5rem 2rem; }
        .page-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1.5rem; }
        .page-tag { font-size: 0.7rem; letter-spacing: 4px; color: var(--azul); text-transform: uppercase; margin-bottom: 0.4rem; font-weight: bold; }
        .page-title { font-size: 2.4rem; font-weight: 800; line-height: 1; letter-spacing: 1px; color: var(--text); text-transform: uppercase; }
        .page-title span { color: var(--azul); }
        .page-date { font-size: 0.8rem; color: var(--text-dim); margin-top: 0.5rem; letter-spacing: 2px; text-transform: uppercase; }

        .stats-row { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .stat-card { background: #fff; border: 1.5px solid var(--border); border-radius: 12px; padding: 1rem 1.8rem; min-width: 160px; position: relative; overflow: hidden; box-shadow: 0 2px 12px rgba(65,105,225,0.07); }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: var(--azul); }
        .stat-card.green::before { background: var(--green); }
        .stat-card.red::before { background: var(--red); }
        .stat-label { font-size: 0.68rem; letter-spacing: 3px; color: var(--text-dim); text-transform: uppercase; margin-bottom: 0.4rem; font-weight: 600; }
        .stat-value { font-size: 2.2rem; font-weight: 800; color: var(--azul); line-height: 1; }
        .stat-card.green .stat-value { color: #3ee2e2; }
        .stat-card.red .stat-value { color: var(--red); }

        .toolbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.2rem; gap: 1rem; flex-wrap: wrap; }
        .toolbar-actions {
        display: flex;
        align-items: center;
        gap: 10px; /* Espacio uniforme entre los botones */
        flex-wrap: nowrap; /* Evita que los botones salten a la siguiente línea */
        }
        .search-wrap { position: relative; }
        .search-input { background: #fff; border: 1.5px solid var(--border); border-radius: 50px; color: var(--text); font-size: 0.9rem; padding: 0.6rem 1.2rem 0.6rem 2.5rem; width: 270px; outline: none; transition: all 0.2s; }
        .search-input:focus { border-color: var(--azul); box-shadow: 0 0 0 3px var(--azul-glow); }


        .table-wrap { background: #fff; border: 1.5px solid var(--border); border-radius: 14px; overflow: hidden; box-shadow: 0 4px 20px rgba(65,105,225,0.08); }
        .table-inner { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 0.7rem; letter-spacing: 3px; color: var(--azul); text-transform: uppercase; padding: 1rem 1.2rem; text-align: left; background: var(--surface2); }
        td { padding: 0.9rem 1.2rem; font-size: 0.95rem; border-bottom: 1px solid var(--border); color: var(--text); }

        .badge { display: inline-block; font-size: 0.68rem; padding: 0.28rem 0.8rem; border-radius: 50px; font-weight: 700; }
        .badge-puntual  { background: var(--green-dim);  color: #27ae60; border: 1.5px solid rgba(0,200,80,0.3); }
        .badge-tardanza { background: rgba(241,196,15,0.13); color: #b7960a; border: 1.5px solid rgba(241,196,15,0.4); }

        .spinner { width: 38px; height: 38px; border: 2px solid var(--border); border-top: 2px solid var(--cyan); border-radius: 50%; animation: girar 2s linear infinite; margin: 0 auto; }
        @keyframes girar { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes fadeRow { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        tbody tr { animation: fadeRow 0.3s ease both; }
        .fc-theme-standard td, .fc-theme-standard th {
        border-radius: 100%;
        border: 1px solid var(--fc-border-color);
        border-color: azure;
        }

        .fc-daygrid-day-top{
            display: flex;
            align-content: center;
            justify-content: center;
            flex-wrap: wrap;
            background-color: #d0d8f5;
            width:35px;
            height:35px;
            border-radius:50%;
        }
        
        .fc-day-with-registry .fc-daygrid-day-top{
        background-color: #2ce4e4;

        }

        .fc-daygrid-day-frame.fc-scrollgrid-sync-inner{

        align-content: center;
        flex-wrap: wrap;
        justify-content: center;
        display:flex;

        }

        .fc-day.fc-daygrid-day{

        justify-content: center;
        align-items: center;

        }


        /* Ajustar el tamaño del círculo de hoy */
        
        
.fc-day.fc-day-past{
    /* Reducimos el ancho y alto (ajusta a tu gusto, ej: 30px o 35px) */

    
    /* Aseguramos que siga siendo un círculo perfecto */
    border-radius: 50% !important;
    
    
    /* Centrado manual por si se desplaza al achicarlo */
    justify-content: center !important;
    align-items: center !important;
    margin: auto;
}

.fc-day{
    justify-content: center !important;
    align-items: center !important;
    margin-top: 21%;
}

.fc-day.fc-daygrid-day:hover .fc-daygrid-day-top{

background-color: #adbeff;
        
}

.fc-day-with-registry.fc-day.fc-daygrid-day:hover .fc-daygrid-day-top{

background-color: #229aaf;
        
}


.fc-day.fc-daygrid-day:hover{
cursor:pointer;
}

.item-seccion{
    height:30px;
    background-color: var(--azul);
    border-radius: 5px;
    margin-bottom: 5px;
    width: 80%;
    color: white;
    justify-self: center;
    -webkit-user-select: none; /* Safari */
    -ms-user-select: none;     /* IE 10 y 11 */
    user-select: none;         /* Estándar (Chrome, Firefox, Edge) */
    text-align: left;
    padding-left: 10px;
}

.item-seccion.selected{

background-color: var(--azul-glow);

}

.item-seccion:hover{
    background-color: var(--azul-glow);
    cursor:pointer;
}

.scrolleable{
      /* ACTIVAR SCROLL */
    overflow-y: auto; /* Solo sale el scroll si el contenido supera la altura */
    overflow-x: hidden; /* Evita scroll horizontal molesto */

    max-height: 250px; 
    padding-bottom: 50px;
    }

.dateInput{
    -ms-user-select: none;     
    pointer-events: fill;         

    /* Quita el borde azul de enfoque al hacer click */
    outline: none !important;
    
    /* Evita que se resalten los números internos (día/mes/año) */
    user-select: none !important;
    -webkit-user-select: none;
    
    /* Opcional: evita que cambie el fondo al hacer click en algunos navegadores */
    -webkit-tap-highlight-color: transparent;
    
    cursor: pointer;
}

/* Esto quita específicamente el sombreado interno de los campos en navegadores Webkit */
.dateInput::-webkit-datetime-edit-fields-wrapper {
    user-select: none;
}
.dateInput.selected{

border-color:var(--cyan);

}


    /* --- ESTILOS DEL MENÚ DE EXPORTACIÓN --- */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--surface);
            min-width: 160px;
            box-shadow: 0px 8px 20px rgba(65,105,225,0.15);
            z-index: 100;
            border-radius: 12px;
            border: 1.5px solid var(--border);
            overflow: hidden;
            margin-top: 8px;
        }
        .dropdown-content a {
            color: var(--text);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            transition: background 0.2s;
        }
        .dropdown-content a:hover {
            background-color: var(--surface2);
            color: var(--azul);
        }
        /* Mostrar el menú al pasar el mouse */
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>

<?php include 'php/extras/navbar.php'; ?>

<div id="profesorlist" class="oculto" style="overflow:hidden;position:absolute;width:50%;max-height:50%;min-height:50%;background-color:white;top:70px;right:20px;border-radius:10px;justify-content:center">
    <div class="search-wrap" style="margin-top:10px;">
        <input class="search-input" type="text" id="buscador" placeholder="🔍 Buscar profesor...">
    </div>
    <div style="display: flex;height: 230px;">
        <div id="profesorcontainer" style="justify-content:center; display:block; width:100%;margin-top:10px;" class="scrolleable">
    
        </div>
    </div>
</div>

<div id="calendardiv" class="" style="display:flex;overflow:hidden;position:absolute;width:50%;max-height:50%;min-height:50%;background-color:white;top:70px;right:20px;border-radius:10px;justify-content:center">
    
        <div style="width:100%;background-color:white;border-radius:50px;align-items:center;justify-content:center;display:block;justify-self:center">
            <div style="padding-top:5px;padding-left:50px;padding-right:50px;max-height:50px;">
                <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
                <div id="calendar" style="width: 100%; height: 100%; max-height:280px;"></div>
            </div>
        </div>

</div>

<main class="main">
    <div class="page-header">
        <div class="header-left">
            <div class="page-tag">// sistema de asistencia</div>
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

                

    <div class="toolbar" style="justify-content: flex-end;">
        <div class="toolbar-actions">
            <input id="filtrostart" class="dateInput selected" type="date" readonly style="width:120px;height:30px;font-size:15px;border-radius:5px;"> -
            <input id="filtroend" class="dateInput" type="date" readonly style="width:120px;height:30px;font-size:15px;border-radius:5px;">
            <button class="btn btn-reload" onclick="toggleCalendar()">📆Calendario</button>
            <button class="btn btn-reload" onclick="togglePList()">👤Profesores</button>
            <div class="toolbar-actions">
            <button class="btn btn-reload" onclick="cargarDatos()">Recargar</button>
            <div class="dropdown">
            <button class="btn btn-export">Exportar ▼</button>
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

// 1. Sacamos la lógica a una función que podamos re-utilizar
function aplicarIluminacionCeldas(info) {
    // Limpiamos siempre primero
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
        // 2. FORZAMOS EL REFRESCO TOTAL
        // Al llamar a render() después de actualizar fechasGlobales, 
        // FullCalendar re-evalúa las celdas visibles.
        // Si changeView no te funcionó, esto reconstruirá la vista:
        calendar.destroy(); // Destruimos la instancia actual
        calendar = null;    // Limpiamos la variable
        inicializarOReferescarCalendario(); // Re-ejecutamos (entrará al if !calendar)
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
                    } else {
                    include += 1;
                    }
                } 

            if(trueSearch.trim() === ""){
                include += 1;
                }

            if (searchTerms.length > 0 && prof.tags.length > 0) {
                const profTagsLower = prof.tags.map(t => t.toLowerCase());


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

    // --- NUEVAS FUNCIONES DE EXPORTACIÓN ---

    function descargarExcel() {
        // Seleccionamos la tabla HTML
        let tabla = document.getElementById("tabla-asistencia");
        // SheetJS convierte la tabla HTML a un libro de Excel automáticamente
        let wb = XLSX.utils.table_to_book(tabla, {sheet: "Asistencia"});
        XLSX.writeFile(wb, "asistencia_mars.xlsx");
    }

    function descargarWord() {
        // Se crea una estructura HTML básica que Word pueda interpretar
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

    // 1. Detectar si el usuario volvió atrás
    window.onpageshow = function(event) {
        if (event.persisted) {
            // Si la página viene de la caché, forzamos recarga
            window.location.reload();
        }
    };

    // 2. Limpiar el historial para que no pueda "retroceder"
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
            // Evita el clic derecho y teclas de retroceso si quieres ser más estricto
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