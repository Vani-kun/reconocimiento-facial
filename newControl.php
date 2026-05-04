<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livelula OS - Interface</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --neon-cyan: #00f3ff;
            --neon-green: #39ff14;
            --bg-panel: rgba(5, 8, 15, 0.98);
            --glass: rgba(255, 255, 255, 0.05);
        }
        body.theme-dark { 
            --neon-cyan: #ff0055; 
            --newfondo: #000;
            --newbarra: linear-gradient(to bottom, #000000 0%, #555555 100%);
            --newletras: #fff;
            --newpoligono: linear-gradient(135deg, #4d4d4d 0%, #000000 100%);
            --newprima: rgb(255, 0, 0);
        }
        body.theme-livelula { --neon-cyan: var(--neon-green); }


        /* Botón de Encendido Estilo Pulsante */
        .power-trigger {
            position: fixed; top: 25px; right: 25px; z-index: 1001;
            width: 50px; height: 50px; border-radius: 50%;
            border: 2px solid var(--neon-cyan);
            background: #000; cursor: pointer;
            box-shadow: 0 0 10px var(--neon-cyan);
            display: flex; align-items: center; justify-content: center;
            transition: 0.3s;
        }

        .power-trigger:hover { box-shadow: 0 0 25px var(--neon-cyan); transform: scale(1.05); }

        /* Panel Principal con Animación de Desvanecido */
        #panel-container {
            position: fixed;
            inset: 0;
            background: var(--bg-panel);
            backdrop-filter: blur(25px);
            display: grid;
            grid-template-columns: 320px 1fr 380px;
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
        }

        .col-left { border-right: none; background: var(--newpoligono); }
         .col-right { border-right: none; background: var(--newpoligono); }

        h3 { 
            font-size: 0.85rem; text-transform: uppercase; 
            letter-spacing: 3px; color: var(--neon-cyan);
            margin-bottom: 30px; border-bottom: 1px solid var(--neon-cyan);
            padding-bottom: 10px;
        }

        /* Diagnóstico e Inputs */
        .control-item { margin-bottom: 25px; }
        .checkbox-wrapper { display: flex; align-items: center; gap: 15px; cursor: pointer; }
        
        input[type="checkbox"] {
            width: 18px; height: 18px;
            accent-color: var(--neon-cyan);
        }

        input[type="range"] { width: 100%; accent-color: var(--neon-cyan); cursor: pointer; }

        /* Gráfico y Botones */
        .chart-container {
            background: var(--glass);
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 30px;
        }

        .btn-futurista {
            background: transparent; border: 1px solid var(--neon-cyan);
            color: #fff; padding: 14px; cursor: pointer;
            text-transform: uppercase; font-size: 0.75rem;
            letter-spacing: 2px; transition: 0.4s;
            margin-top: 10px;
        }

        .btn-futurista:hover { 
            background: var(--neon-cyan); 
            color: #000; 
            box-shadow: 0 0 30px var(--neon-cyan);
        }

        .status-display { text-align: center; margin: 40px 0; }
        #status-text { font-size: 1.8rem; font-weight: bold; text-shadow: 0 0 15px var(--neon-cyan); }

    </style>
</head>
<body>


    <div id="panel-container">
        <!-- IZQUIERDA: DIAGNÓSTICO Y PRECISIÓN -->
        <div class="col col-left">
            <h3>Sistemas & Log</h3>
            <div class="control-item">
                <label class="checkbox-wrapper">
                    <input type="checkbox" id="err-log"> Errores de Sistema
                </label>
            </div>
            <div class="control-item">
                <label class="checkbox-wrapper">
                    <input type="checkbox" id="debug-mode" checked> Depuración Activa
                </label>
            </div>
            
            <div class="control-item" style="margin-top: 20px;">
                <label style="font-size: 0.75rem; opacity: 0.8;">RANGO DE PRECISIÓN: <span id="prec-val">0.90</span></label>
                <input type="range" min="0" max="1" step="0.01" value="0.90" oninput="updatePrecision(this.value)">
            </div>

            <button class="btn-futurista" onclick="console.log('Reiniciando logs...')">Limpiar Historial</button>
        </div>

        <!-- CENTRO: NÚCLEO LIVELULA -->
        <div class="col" style="justify-content: center; align-items: center; border-left: 1px solid rgba(255,255,255,0.1);">
            <div style="text-align: center;">
                <h1 style="font-size: 3rem; letter-spacing: 15px; margin: 0; color: var(--neon-cyan);">LIVELULA</h1>
                <div class="status-display">
                    <p style="font-size: 0.8rem; opacity: 0.6;">CONTROL DE FLUJO BIOMÉTRICO</p>
                    <input type="range" min="0" max="1" step="1" value="1" style="width: 60px;" oninput="updateSystemStatus(this.value)">
                    <div id="status-text" style="color: var(--neon-cyan);">ACTIVO</div>
                </div>
                
    <!-- Interruptor de Encendido -->
    <div class="power-trigger" onclick="togglexxPanel()" >
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--neon-cyan)" stroke-width="2.5">
            <path d="M18.36 6.64a9 9 0 1 1-12.73 0M12 2v10"/></svg>
    </div>
                <button class="btn-futurista" style="width: 250px;">Rango Detección Cámara</button>
            </div>
        </div>

        <!-- DERECHA: ESTADÍSTICAS Y ESTILO -->
        <div class="col col-right">
            <h3>Monitor de Profesores</h3>
            <div class="chart-container">
                <canvas id="profDataChart"></canvas>
            </div>

            <h3>Interfaz de Usuario</h3>
            <button class="btn-futurista" onclick="applyTheme('basic')">Tema Básico</button>
            <button class="btn-futurista" onclick="applyTheme('dark')">Modo Oscuro</button>
            <button class="btn-futurista" onclick="applyTheme('livelula')">Bio-Livelula</button>
            
            <div style="margin-top: auto; font-size: 0.65rem; opacity: 0.4; text-align: right;">
                LIVELULA_CORE // UNIT_01
            </div>
        </div>
    </div>

    <script>
        // Función para mostrar/ocultar el panel
        function togglexxPanel() {
            let pannel=document.getElementById('panel-container');
            if (pannel.classList.contains("active")){moveCamera("center")}
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
            } else {
                status.innerText = "ACTIVO";
                status.style.color = "var(--neon-cyan)";
                status.style.textShadow = "0 0 15px var(--neon-cyan)";
            }
        }

        // Temas
        function applyTheme(theme) {
            document.body.className = '';
            if(theme !== 'basic') document.body.classList.add('theme-' + theme);
        }

        // Configuración del Gráfico de Torta (Chart.js)
        const ctx2 = document.getElementById('profDataChart').getContext('2d');
        const profDataChart = new Chart(ctx2, {
            type: 'doughnut', // Estilo dona para verse más moderno
            data: {
                labels: ['Asistentes', 'Inasistentes'],
                datasets: [{
                    data: [18, 5], 
                    backgroundColor: ['#39ff14', '#ff0055'],
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
    </script>
</body>
</html>