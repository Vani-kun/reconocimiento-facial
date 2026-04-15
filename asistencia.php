<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.A.R.S. - Registro de Asistencia</title>
    <link rel="stylesheet" href="style.css">
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

        /* Navbar */
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
        .logo-img { height: 36px; }
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
        .nav-link:hover, .nav-link.active { color: var(--azul); }

        /* Main layout */
        .main {
            max-width: 1300px;
            margin: 0 auto;
            padding: 2.5rem 2rem;
        }

        /* Header */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .page-tag {
            font-size: 0.7rem;
            letter-spacing: 4px;
            color: var(--azul);
            text-transform: uppercase;
            margin-bottom: 0.4rem;
            font-weight: bold;
        }
        .page-title {
            font-size: 2.4rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: 1px;
            color: var(--text);
            text-transform: uppercase;
        }
        .page-title span { color: var(--azul); }
        .page-date {
            font-size: 0.8rem;
            color: var(--text-dim);
            margin-top: 0.5rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Stats row */
        .stats-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .stat-card {
            background: #fff;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 1rem 1.8rem;
            min-width: 160px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(65,105,225,0.07);
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 4px;
            background: var(--azul);
        }
        .stat-card.green::before { background: var(--green); }
        .stat-card.red::before   { background: var(--red); }
        .stat-label {
            font-size: 0.68rem;
            letter-spacing: 3px;
            color: var(--text-dim);
            text-transform: uppercase;
            margin-bottom: 0.4rem;
            font-weight: 600;
        }
        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--azul);
            line-height: 1;
        }
        .stat-card.green .stat-value { color: #27ae60; }
        .stat-card.red   .stat-value { color: var(--red); }

        /* Toolbar */
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .search-wrap { position: relative; }
        .search-input {
            background: #fff;
            border: 1.5px solid var(--border);
            border-radius: 50px;
            color: var(--text);
            font-size: 0.9rem;
            padding: 0.6rem 1.2rem 0.6rem 2.5rem;
            width: 270px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-input:focus {
            border-color: var(--azul);
            box-shadow: 0 0 0 3px var(--azul-glow);
        }
        .search-icon {
            position: absolute;
            left: 0.9rem; top: 50%;
            transform: translateY(-50%);
            color: var(--text-dim);
            font-size: 0.9rem;
        }
        .toolbar-actions { display: flex; gap: 0.8rem; }

        /* Buttons — match your .boton style */
        .btn {
            background: #6977a3;
            color: white;
            border: none;
            padding: 12px 26px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px var(--azul-glow);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn:hover {
            background: var(--azul);
            transform: scale(1.01);
            box-shadow: 0 0 10px var(--azul);
        }
        .btn:active { transform: scale(0.95); }
        .btn-reload { background: #a0aabf; box-shadow: none; }
        .btn-reload:hover { background: #7a8bbf; box-shadow: none; }

        /* Table */
        .table-wrap {
            background: #fff;
            border: 1.5px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(65,105,225,0.08);
        }
        .table-inner { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }
        thead {
            background: var(--surface2);
            border-bottom: 2px solid var(--border);
        }
        th {
            font-size: 0.7rem;
            letter-spacing: 3px;
            color: var(--azul);
            text-transform: uppercase;
            padding: 1rem 1.2rem;
            text-align: left;
            white-space: nowrap;
            font-weight: 700;
        }
        td {
            padding: 0.9rem 1.2rem;
            font-size: 0.95rem;
            font-weight: 500;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
            color: var(--text);
        }
        tbody tr { transition: background 0.15s; }
        tbody tr:hover { background: rgba(65,105,225,0.04); }
        tbody tr:last-child td { border-bottom: none; }

        .col-id   { font-size: 0.8rem; color: var(--text-dim); font-weight: 600; }
        .col-nombre { color: var(--text); font-weight: 700; font-size: 1rem; }
        .col-time { font-size: 0.88rem; color: var(--text-dim); }

        .badge {
            display: inline-block;
            font-size: 0.68rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 0.28rem 0.8rem;
            border-radius: 50px;
            font-weight: 700;
        }
        .badge-puntual  { background: var(--green-dim);  color: #27ae60; border: 1.5px solid rgba(0,200,80,0.3); }
        .badge-tardanza { background: rgba(241,196,15,0.13); color: #b7960a; border: 1.5px solid rgba(241,196,15,0.4); }
        .badge-ausente  { background: var(--red-dim);    color: var(--red); border: 1.5px solid rgba(231,76,60,0.3); }
        .badge-otro     { background: var(--surface2);   color: var(--text-dim); border: 1.5px solid var(--border); }

        /* Empty / loading */
        .state-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            gap: 1rem;
        }
        .state-icon { font-size: 2.5rem; opacity: 0.3; }
        .state-msg  { font-size: 0.85rem; color: var(--text-dim); letter-spacing: 2px; text-transform: uppercase; }

        /* Spinner — matches your .anillo-escaneo style */
        .spinner {
            width: 38px; height: 38px;
            border: 2px solid var(--border);
            border-top: 2px solid var(--cyan);
            border-radius: 50%;
            animation: girar 2s linear infinite;
        }
        @keyframes girar { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        /* Table footer */
        .table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 1.4rem;
            border-top: 1.5px solid var(--border);
            background: var(--surface2);
        }
        .footer-info { font-size: 0.72rem; color: var(--text-dim); letter-spacing: 2px; text-transform: uppercase; font-weight: 600; }
        .pulse-dot {
            display: inline-block;
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--color-detectado);
            margin-right: 6px;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(0,255,0,0.4); }
            50%       { opacity: 0.6; box-shadow: 0 0 0 5px transparent; }
        }

        @keyframes fadeRow {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        tbody tr { animation: fadeRow 0.3s ease both; }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <a href="#" class="logo">
            <img src="IUJO.gif" alt="Logo M.A.R.S." class="logo-img">
            <span class="logo-text">M.A.R.S.</span>
        </a>
        <ul class="nav-menu">
            <li><a href="index.html#inicio" class="nav-link">Escaner</a></li>
            <li><a href="admin.php" class="nav-link">Profesores</a></li>
            <li><a href="asistencia.php" class="nav-link active">Asistencia</a></li>
            <li><a href="asignar.php" class="nav-link">Configuracion</a></li>
        </ul>
    </div>
</nav>

<main class="main">

    <div class="page-header">
        <div class="header-left">
            <div class="page-tag">// sistema de asistencia</div>
            <h1 class="page-title">REGISTRO DE <span>ASISTENCIA</span></h1>
            <div class="page-date" id="fecha-hoy"></div>
        </div>
    </div>

    <!-- Stats -->
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

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="search-wrap">
            <span class="search-icon"></span>
            <input class="search-input" type="text" id="buscador" placeholder="Buscar profesor...">
        </div>
        <div class="toolbar-actions">
            <button class="btn btn-reload" onclick="cargarDatos()"> &nbsp;Recargar</button>
            <button class="btn btn-pdf" onclick="descargarPDF()"> &nbsp;Exportar PDF</button>
        </div>
    </div>

    <!-- Table -->
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
                            <div class="state-box">
                                <div class="spinner"></div>
                                <div class="state-msg">Cargando datos...</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-footer">
            <div class="footer-info"><span class="pulse-dot"></span>EN VIVO</div>
            <div class="footer-info" id="footer-count">—</div>
        </div>
    </div>

</main>

<script>
    let todosLosRegistros = [];

    // Mostrar fecha actual
    const ahora = new Date();
    document.getElementById('fecha-hoy').textContent =
        ahora.toLocaleDateString('es-ES', { weekday:'long', year:'numeric', month:'long', day:'numeric' }).toUpperCase();

    // Badge según estado
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
            tbody.innerHTML = `<tr><td colspan="5">
                <div class="state-box">
                    <div class="state-icon">📋</div>
                    <div class="state-msg">Sin registros de asistencia</div>
                </div></td></tr>`;
            return;
        }

        tbody.innerHTML = registros.map((r, i) => `
            <tr style="animation-delay:${i * 0.04}s">
                <td class="col-id">${String(r.id).padStart(3,'0')}</td>
                <td class="col-nombre">${r.nombre}</td>
                <td class="col-time">${r.entrada || '—'}</td>
                <td class="col-time">${r.salida || '—'}</td>
                <td>${badgeEstado(r.estado)}</td>
            </tr>
        `).join('');
    }

    function actualizarStats(registros) {
        document.getElementById('stat-total').textContent = registros.length;
        const puntuales = registros.filter(r => (r.estado||'').toLowerCase().includes('puntual')).length;
        const tardes    = registros.filter(r => (r.estado||'').toLowerCase().includes('tard')).length;
        document.getElementById('stat-puntual').textContent = puntuales;
        document.getElementById('stat-tarde').textContent   = tardes;
        document.getElementById('footer-count').textContent = `${registros.length} REGISTRO(S) ENCONTRADO(S)`;
    }

    async function cargarDatos() {
        document.getElementById('tbody').innerHTML = `<tr><td colspan="5">
            <div class="state-box"><div class="spinner"></div><div class="state-msg">Cargando datos...</div></div>
        </td></tr>`;

        try {
            const res  = await fetch('get_asistencia.php');
            const json = await res.json();

            if (json.success) {
                todosLosRegistros = json.data;
                renderTabla(todosLosRegistros);
                actualizarStats(todosLosRegistros);
            } else {
                throw new Error(json.error || 'Error desconocido');
            }
        } catch (err) {
            document.getElementById('tbody').innerHTML = `<tr><td colspan="5">
                <div class="state-box">
                    <div class="state-icon">⚠️</div>
                    <div class="state-msg">Error al cargar: ${err.message}</div>
                </div></td></tr>`;
        }
    }

    // Buscador
    document.getElementById('buscador').addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        const filtrados = q
            ? todosLosRegistros.filter(r => r.nombre.toLowerCase().includes(q))
            : todosLosRegistros;
        renderTabla(filtrados);
        document.getElementById('footer-count').textContent = `${filtrados.length} REGISTRO(S) ENCONTRADO(S)`;
    });

    // Exportar PDF
    function descargarPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a4' });

        const fechaStr = new Date().toLocaleDateString('es-ES', {
            weekday:'long', year:'numeric', month:'long', day:'numeric'
        });

        // Fondo blanco
        doc.setFillColor(255, 255, 255);
        doc.rect(0, 0, 297, 210, 'F');

        // Header azul
        doc.setFillColor(65, 105, 225);
        doc.rect(0, 0, 297, 30, 'F');

        doc.setTextColor(255, 255, 255);
        doc.setFontSize(18);
        doc.setFont('helvetica', 'bold');
        doc.text('M.A.R.S.', 14, 13);

        doc.setFontSize(9);
        doc.setFont('helvetica', 'normal');
        doc.setTextColor(200, 215, 255);
        doc.text('SISTEMA DE REGISTRO DE ASISTENCIA', 14, 21);

        doc.setTextColor(255, 255, 255);
        doc.setFontSize(8);
        doc.text(fechaStr.toUpperCase(), 297 - 14, 13, { align: 'right' });
        doc.text(`TOTAL: ${todosLosRegistros.length} PROFESOR(ES)`, 297 - 14, 21, { align: 'right' });

        // Tabla
        const filas = todosLosRegistros.map(r => [
            String(r.id).padStart(3,'0'),
            r.nombre,
            r.entrada || '—',
            r.salida  || '—',
            (r.estado || 'N/D').toUpperCase()
        ]);

        doc.autoTable({
            startY: 38,
            head: [['#', 'PROFESOR', 'ENTRADA', 'SALIDA', 'ESTADO']],
            body: filas,
            theme: 'grid',
            styles: {
                font: 'helvetica',
                fontSize: 9,
                textColor: [44, 62, 107],
                fillColor: [255, 255, 255],
                lineColor: [208, 216, 245],
                lineWidth: 0.3,
                cellPadding: 4,
            },
            headStyles: {
                fillColor: [238, 241, 251],
                textColor: [65, 105, 225],
                fontStyle: 'bold',
                fontSize: 8,
            },
            alternateRowStyles: { fillColor: [248, 250, 255] },
            columnStyles: {
                0: { cellWidth: 15 },
                1: { cellWidth: 80 },
                2: { cellWidth: 35 },
                3: { cellWidth: 35 },
                4: { cellWidth: 50 },
            },
            didParseCell(data) {
                if (data.section === 'body' && data.column.index === 4) {
                    const v = (data.cell.raw || '').toLowerCase();
                    if (v.includes('puntual'))  data.cell.styles.textColor = [39, 174, 96];
                    else if (v.includes('tard')) data.cell.styles.textColor = [183, 150, 10];
                    else if (v.includes('ausente')) data.cell.styles.textColor = [231, 76, 60];
                }
            }
        });

        // Footer
        const py = doc.internal.pageSize.height - 8;
        doc.setTextColor(180, 190, 220);
        doc.setFontSize(7);
        doc.text('GENERADO POR M.A.R.S. — SISTEMA BIOMÉTRICO DE ASISTENCIA', 14, py);
        doc.text(`${new Date().toLocaleTimeString('es-ES')}`, 297 - 14, py, { align: 'right' });

        doc.save(`asistencia_${new Date().toISOString().slice(0,10)}.pdf`);
    }

    // Iniciar
    cargarDatos();
</script>
</body>
</html>