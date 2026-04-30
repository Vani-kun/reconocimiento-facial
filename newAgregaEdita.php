   <style>
        :root {
            --accent: #00f2ff;
            --bg: #0f172a;
            --glass: rgba(255, 255, 255, 0.03);
            --border: rgba(255, 255, 255, 0.1);
            --card: rgba(30, 41, 59, 0.9); /* Un poco más opaco para que se lea bien sobre el fondo */
        }
        /* --- BOTÓN DE ACTIVACIÓN --- */
        #btn-toggle {
            position: fixed;
            top: 25px;
            left: 25px;
            z-index: 100;
            background: var(--card);
            border: 1px solid var(--border);
            color: var(--accent);
            padding: 10px 20px;
            border-radius: 12px;
            cursor: pointer;
            backdrop-filter: blur(10px);
            font-size: 0.8rem;
            font-weight: 500;
            transition: 0.3s;
        }

        #btn-toggle:hover {
            border-color: var(--accent);
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.3);
        }

        /* --- PANEL LATERAL FIJO (DERECHA) --- */
        .soft-panel {
            position: fixed;
            right: 20px; /* Separación del borde */
            top: 50%;
            transform: translateY(-50%) translateX(120%); /* Escondido a la derecha */
            
            width: 320px;
            padding: 35px;
            background: var(--card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            
            /* Diseño de esquinas suave: la inferior derecha es la "diferente" */
            border-radius: 40px 40px 4px 40px;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.4);
            
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1000;
        }

        /* Clase para mostrar el panel */
        .soft-panel.active {
            transform: translateY(-50%) translateX(0);
        }

        /* --- BIOMETRÍA --- */
        .bio-header {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 25px;
        }

        .bio-slot {
            width: 45px;
            height: 45px;
            background: var(--glass);
            border: 1px solid var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.55rem;
            color: var(--accent);
        }

        /* --- INPUTS --- */
        h2 {
            font-size: 1rem;
            margin-bottom: 20px;
            text-align: center;
            color: white;
            font-weight: 500;
        }

        .input-wrap { margin-bottom: 15px; }

        input {
            width: 100%;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border);
            padding: 12px;
            border-radius: 15px;
            color: white;
            outline: none;
            font-size: 0.85rem;
            box-sizing: border-box;
        }

        input:focus { border-color: var(--accent); }

        /* --- BOTONES --- */
        .btn-group {
            display: flex;
            margin-top: 25px;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .btn {
            flex: 1;
            padding: 14px;
            border: none;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 600;
            transition: 0.2s;
        }
        .btn-cancel { background: transparent; color: #94a3b8; }
        .btn-save { background: var(--accent); color: #0f172a; }
        .btn:active { opacity: 0.8; }
        /* --- BIOMETRÍA CON INTERACCIÓN --- */
        .bio-header {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 25px;
        }
       .btn22 {
            height: 32px;
        }
        .bio-slot {
            width: 60px;
            height: 60px;
            background: var(--glass);
            border: 1px solid var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.55rem;
            color: var(--accent);
            cursor: pointer; /* Cambia el cursor al pasar por encima */
            transition: all 0.3s ease; /* Transición suave para todos los estados */
        }

        /* Efecto de iluminación al pasar el mouse */
        .bio-slot:hover {
            border-color: var(--accent);
            background: rgba(0, 242, 255, 0.1);
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.4); /* Resplandor exterior */
            transform: translateY(-2px); /* Pequeño salto táctil */
            color: #fff; /* El texto brilla un poco más */
        }

        /* Efecto visual al hacer clic */
        .bio-slot:active {
            transform: scale(0.95);
            box-shadow: 0 0 5px rgba(0, 242, 255, 0.2);
        }
    </style>

    <!--button id="btn-toggle" onclick="togglexPanel()">Nuevo Registro</button-->

    <!-- El elemento ya no tiene overlay, es independiente -->
    <div id="sidePanel" class="soft-panel">
        
        <div class="bio-header">
            <div class="bio-slot" id="scan1">SCAN</div>
            <div class="bio-slot" id="scan2">SCAN</div>
            <div class="bio-slot" id="scan3">SCAN</div>
             <button class="btn btn22 btn-cancel" >+</button>
        </div>

        <h2>Nuevo Profesor</h2>
        
        <div class="input-wrap">
            <input type="text" placeholder="Nombre completo">
        </div>

        <div class="input-wrap">
            <input type="text" placeholder="Especialidad">
        </div>

        <div class="btn-group">
            <button class="btn btn-cancel" onclick="togglexPanel()">Cerrar</button>
            <button class="btn btn-save" onclick="handleSave()">Confirmar</button>
        </div>

    </div>

    <script>
        const subpanel = document.getElementById('sidePanel');
        
        function togglexPanel() {
            subpanel.classList.toggle('active');
        }

        function handleSave() {
        guardarProfesor();    
        //alert("Datos sincronizados correctamente");
            //togglexPanel();
        }
    </script>
