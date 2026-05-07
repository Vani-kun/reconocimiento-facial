<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuristic Hex-Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --cssinfo: #00f2ff;
            --csswarn: #f39c12;
            --csserror: #ff0055;
        }

        @keyframes pulse-icon {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.3); }
        }

        /* --- MODAL HEXAGONAL --- */
        .overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.85);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999999;
            backdrop-filter: blur(8px);
        }

        .hex-modal {
            width: 450px;
            height: 400px;
            background: #111;
            /* Forma hexagonal alargada */
            clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Efecto de borde neón dinámico */
        .hex-modal::before {
            content: '';
            position: absolute;
            inset: 0;
            clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
            padding: 4px; /* Grosor del borde */
            /*background: var(--current-color, var(--neon-info));*/
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }/*#00f2ff*/ 
        .hex-modal.info::before {background:  var(--cssinfo);}
        .hex-modal.warn::before {background:  var(--csswarn);}
        .hex-modal.erro::before {background:  var(--csserror);}

        i.info{
            color:var(--cssinfo);filter: drop-shadow(0 0 10px var(--cssinfo));
        }
        i.warn{
            color:var(--csswarn);filter: drop-shadow(0 0 10px var(--csswarn));
        }
        i.erro{
            color:var(--csserror);filter: drop-shadow(0 0 10px var(--csserror));
        }
        .hex-modal #main-icon {
            font-size: 4rem;
            margin-bottom: 15px;          
            animation: pulse-icon 2s infinite ease-in-out;
        }
        .hex-modal h2 {
            margin: 10px 0;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .hex-modal p {
            color: #aaa;
            font-size: 0.9rem;
            max-width: 80%;
        }

        .close-hex {
            margin-top: 20px;
            background: none;
            border: 1px solid #fff;
            color: #fff;
            padding: 8px 20px;
            cursor: pointer;
            clip-path: polygon(10% 0, 100% 0, 90% 100%, 0 100%);
            transition: 0.3s;
        }

        .close-hex:hover {
            background: #fff;
            color: #000;
        }

        /* --- ANIMACIONES --- */
        @keyframes slideUp {
            from { transform: scale(0.5) translateY(100px); opacity: 0; }
            to { transform: scale(1) translateY(0); opacity: 1; }
        }

        .overlay.active { display: flex; }
    </style>
</head>
<body>

    <div class="overlay" id="overlay" >
        <div class="hex-modal" id="modal" onclick="event.stopPropagation()">
            <i id="main-icon"></i>
            <h2 id="title">Título</h2>
            <p id="msg">Mensaje del sistema...</p>
            <button class="close-hex" id="resuelve" >CERRAR</button>
        </div>
    </div>

    <script>
        const config = [
            {
                title: "Reporte",
                icon: "fa-circle-info",
                clase: "info"
            },
            {
                title: "Anomalia",
                icon: "fa-triangle-exclamation",
                clase: "warn"   
            },
            {
                title: "Alerta",
                icon: "fa-radiation",
                clase: "erro"
            }
        ];

        async function msj(txt,type = 0) {//<---------
            
                await msj2(type,txt);

        }
        function msj2(type,txt) {
            return new Promise((resolve) => {
                const data = config[type];
                const modal = document.getElementById('modal');
                const icon = document.getElementById('main-icon');
                
                document.getElementById('title').innerText = data.title;
                document.getElementById('msg').innerText = txt;
                icon.className = `fa-solid ${data.icon} `+data.clase;
                modal.className = `hex-modal `+data.clase;
                document.getElementById('overlay').classList.add('active');

                // Guardamos la función para resolver la promesa en el botón OK
                const btnOk = document.getElementById('resuelve'); // Asegúrate de tener este ID
                btnOk.onclick = () => {
                    msjend();
                    resolve(); // <--- Aquí es donde permitimos que el código continúe
                };
            })
        }
        function msjend() {
            document.getElementById('overlay').classList.remove('active');
        }
        //msj("iniciando servicio de alertas Livelula");
    </script>
</body>
</html>