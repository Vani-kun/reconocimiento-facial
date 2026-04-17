<?php
// 1. Evitar que el navegador almacene la página en el historial (Caché)
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// 2. Comprobar la sesión
include 'includes/session_check.php';

// Si el check de sesión falla, el usuario no verá NADA de lo que sigue abajo
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.A.R.S. - Registro de Asistencia</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="estiloMARS.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <style>
        :root {
            --color-detectado: #00ff00;
            --color-no-detectado: #e74c3c;
            --color-fondo: #f4f4f4;
            --color-boton: #1336ff;
            --azul: #4169E1;
            --azul-glow: rgba(65, 105, 225, 0.4);
            --cyan: #00FFFF;
            --cyan-dim: rgba(0, 255, 255, 0.12);
            --green: #00ff00;
            --green-dim: rgba(0, 255, 0, 0.12);
            --red: #e74c3c;
            --red-dim: rgba(231, 76, 60, 0.12);
            --yellow: #f1c40f;
            --surface: #ffffff;
            --surface2: #eef1fb;
            --border: #d0d8f5;
            --text: #2c3e6b;
            --text-dim: #7a8bbf;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: var(--color-fondo);
            color: var(--text);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navbar Dinámico (Solo Inicio, Configuración si es Admin, y Salir) */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #fff;
            border-bottom: 2px solid var(--border);
            padding: 0 2rem;
            box-shadow: 0 2px 12px rgba(65,105,225,0.10);
        }
        .nav-container {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
        }
        .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-menu { list-style: none; display: flex; gap: 2rem; }
        .nav-link {
            text-decoration: none;
            color: var(--text-dim);
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: color 0.2s;
        }
        .nav-link:hover { color: var(--azul); }
        .nav-link.logout { color: var(--red); }

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
        .stat-card.green .stat-value { color: #27ae60; }
        .stat-card.red .stat-value { color: var(--red); }

        .toolbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.2rem; gap: 1rem; flex-wrap: wrap; }
        .search-wrap { position: relative; }
        .search-input { background: #fff; border: 1.5px solid var(--border); border-radius: 50px; color: var(--text); font-size: 0.9rem; padding: 0.6rem 1.2rem 0.6rem 2.5rem; width: 270px; outline: none; transition: all 0.2s; }
        .search-input:focus { border-color: var(--azul); box-shadow: 0 0 0 3px var(--azul-glow); }

        .btn { background: #6977a3; color: white; border: none; padding: 12px 26px; font-size: 12px; font-weight: bold; border-radius: 50px; cursor: pointer; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; display: inline-flex; align-items: center; }
        .btn:hover { background: var(--azul); transform: scale(1.01); box-shadow: 0 0 10px var(--azul); }

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

        /* 1. Reducir la altura de las celdas de la cuadrícula */
.fc .fc-daygrid-body tr {
    height: 50px !important; /* Ajusta este valor (ej: de 50px a 70px) según lo desees */
}

/* 2. Ajustar el contenedor interno para que no fuerce altura extra */
.fc-daygrid-day-frame {
    min-height: 50px !important; /* Debe coincidir con la altura del tr */
    height: 50px !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
}

/* 3. Eliminar el espacio superior que FullCalendar reserva para eventos */
.fc-daygrid-day-top {
    display: none !important; /* Esto quita el espacio extra arriba del círculo */
}

/* 4. Si los círculos se ven muy grandes para el nuevo tamaño, achícalos un poco */
.fc .fc-daygrid-day-number {
    width: 40px !important;  /* Antes era 50px */
    height: 40px !important; /* Antes era 50px */
    font-size: 0.9em !important;
}

    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <a href="index.php" class="logo">
            <span style="font-weight: 800; color: var(--text); font-size: 1.2rem;">M.A.R.S.</span>
        </a>
        <ul class="nav-menu">
            <li><a href="index.php" class="nav-link">Inicio</a></li>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <li><a href="warp.php" class="nav-link" style="color: var(--azul);">Configuración</a></li>
            <?php endif; ?>
            <li><a href="login.php" class="nav-link logout">Cerrar Sesión</a></li>
        </ul>
    </div>
</nav>

<main class="main">
    <div class="page-header">
        <div class="header-left">
            <div class="page-tag">// sistema de asistencia</div>
            <h1 class="page-title">REGISTRO DE <span>ASISTENCIA</span></h1>
            <div class="page-date">USUARIO: <strong><?php echo strtoupper($_SESSION['nombre']); ?></strong></div>
            <div class="page-date" id="fecha-hoy"></div>
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

    <div class="toolbar">
        <div class="search-wrap">
            <input class="search-input" type="text" id="buscador" placeholder="Buscar profesor...">
        </div>
        <div class="toolbar-actions">
            <button class="btn btn-reload" onclick="cargarDatos()">Recargar</button>
            <button class="btn btn-pdf" onclick="descargarPDF()">Exportar PDF</button>
        </div>
    </div>

    <div class="table-wrap">
        <div class="table-inner">
            <table id="tabla-asistencia">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profesor</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                        <th>Estado</th>
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

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<div id="calendar" style="width: 100%; height: 90vh;"></div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es', // En español
      events: [
        { title: 'Clase de Programación', start: '2026-04-17' }
      ]
    });
    calendar.render();
  });
</script>

<script>
    
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
        const tbody = document.getElementById('tbody');
        if (registros.length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding:40px;">Sin registros</td></tr>`;
            return;
        }
        tbody.innerHTML = registros.map((r, i) => `
            <tr style="animation-delay:${i * 0.04}s">
                <td>${String(r.id).padStart(3,'0')}</td>
                <td style="font-weight:700;">${r.nombre}</td>
                <td>${r.entrada || '—'}</td>
                <td>${r.salida || '—'}</td>
                <td>${badgeEstado(r.estado)}</td>
            </tr>
        `).join('');
    }

    async function cargarDatos() {
        try {
            const res  = await fetch('get_asistencia.php', {
                method: 'POST',
                    headers: {
                    'Content-Type': 'application/json'
                    },
                        body: JSON.stringify({}) 
                    });

            const json = await res.json();
            if (json.success) {
                todosLosRegistros = json.data;
                renderTabla(todosLosRegistros);
                document.getElementById('stat-total').textContent = todosLosRegistros.length;
                document.getElementById('stat-puntual').textContent = todosLosRegistros.filter(r => (r.estado||'').toLowerCase().includes('puntual')).length;
                document.getElementById('stat-tarde').textContent = todosLosRegistros.filter(r => (r.estado||'').toLowerCase().includes('tard')).length;
            }

        } catch (err) {
            console.error("Error al cargar datos:", err);
        }
    }

    document.getElementById('buscador').addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        const filtrados = todosLosRegistros.filter(r => r.nombre.toLowerCase().includes(q));
        renderTabla(filtrados);
    });

    function descargarPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({ orientation: 'landscape' });
        doc.text("Registro de Asistencia M.A.R.S.", 14, 15);
        doc.autoTable({ html: '#tabla-asistencia', margin: { top: 25 } });
        doc.save("asistencia_mars.pdf");
    }

    cargarDatos();
</script>

<script>
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
</script>

</body>
</html>