<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat Log Transparente</title>
    <style>
        body {
            background: #121212; /* Fondo oscuro para resaltar el neón */
            font-family: 'monospace';
        }
#chat-wrapper {
        position: fixed;
        bottom: 20px;
        left: 2%;
        width: 96%;
        height: 40%;
        opacity: 1;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        transition: bottom 0.5s, opacity 0.5s;
        background: #00000066;
        padding: 2% 2%;
        border: #000000 2px solid;
        backdrop-filter: blur(8px);
    }
#chat-wrapper.hidden{
    bottom: -40%;
    opacity: 0;
    pointer-events:none;
    }

    #chat-container {
        display: flex;
        flex-direction: column-reverse;
        gap: 8px;
        max-height: 200px;
        margin-bottom: 10px; /* Espacio para el input */
        overflow-y: scroll; /* Mantenemos el look limpio */
        pointer-events: none;
    }

    /* Área del Input */
    .chat-input-area {
        display: flex;
        gap: 5px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        padding: 5px;
        border-radius: 8px;
        border: 1px solid rgba(0, 242, 255, 0.3);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    #chat-input {
        flex: 1;
        background: transparent;
        border: none;
        color: #fff;
        padding: 8px 12px;
        font-family: 'monospace';
        outline: none;
        font-size: 12px;
    }

    #chat-input::placeholder {
        color: rgba(0, 242, 255, 0.5);
    }

    #chat-send {
        background: rgba(0, 242, 255, 0.2);
        border: none;
        color: #00f2ff;
        padding: 0 15px;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s;
    }

    #chat-send:hover {
        background: #00f2ff;
        color: #000;
        box-shadow: 0 0 10px #00f2ff;
    }

        /* Estilo de cada mensaje */
        .chat-msg {
            background: rgba(0, 0, 0, 0.4); /* Fondo transparente */
            color: #00f2ff; /* Color cian como tu config */
            padding: 10px 15px;
            border-left: 3px solid #00f2ff;
            border-radius: 4px;
            font-size: 12px;
            backdrop-filter: blur(5px); /* Efecto de cristal esmerilado */
            animation: slideIn 0.3s ease-out;
            pointer-events: auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            word-wrap: break-word;
            display:grid;
            grid-template-columns: 20% 80%;
        }
        .chat-name-div{
        overflow: hidden;
        display:flex;
        align-items:center;
        justify-content:center;
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .fade-out {
            animation: slideOut 0.5s forwards;
        }

        @keyframes slideOut {
            to { transform: translateX(-100%); opacity: 0; }
        }
        #btnShowChat{
            position:absolute;
            bottom:0;
            left:2%;
            width:5%;
            height:3%;
            background-color:white;
            z-index:4000;
            color:black;
            border-top-left-radius: 10%;
            border-top-right-radius: 10%;
            transition: height 0.2s,width 0.2s,left 0.2s;
            }
        #btnShowChat:hover{
            left:1%;
            height:3.5%; 
            width:7%; 
            cursor:pointer;
            }
    </style>
</head>
<body>

    <!-- El contenedor donde vivirán los mensajes -->
<div id="btnShowChat" class="SecurityLevel5" onclick="showChat();">

    <i class="fa-solid fa-angle-up"></i> <span class="oculto" style="color: #00ff22;text-shadow: 0 0 10px #00ff22;"><i class="fa-regular fa-envelope"></i></span>

</div> 
    
<div id="chat-wrapper" class="hidden SecurityLevel5">
    <div id="chat-container"></div>
    
    <div class="chat-input-area">
        <input type="text" id="chat-input" placeholder="Escribir comando..." autocomplete="off">
        <button onclick="enviarDesdeInput()" id="chat-send">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</div>

    <script>

        
        const ctchatwra = document.getElementById("chat-wrapper");
        const ctbtn = document.getElementById("btnShowChat");
        const ctbtni = ctbtn.querySelector("i");
        const ctbtnspan = ctbtn.querySelector("span");
        const ctinput = document.getElementById('chat-input');

        const chatContainer = document.getElementById('chat-container');
        const MAX_MENSAJES = 10;
        const TIEMPO_VIDA =3000 //1 * 60 * 1000; // 5 minutos en milisegundos

        ctinput.addEventListener("keydown", (event) => {
            if (event.key === "Enter") {
            event.preventDefault(); // Evita que se recargue la página si es un form
            enviarDesdeInput();
            }
        });

        let mensajes=[];
        primerCarga = true;
        
        function chat(mensaje,nombre) {
            // 1. Crear el elemento del mensaje
            const msgElement = document.createElement('div');
            const nameElement = document.createElement("div");
            const msgElementDiv = document.createElement("div");

            nameElement.textContent = nombre;
            nameElement.classList.add("chat-name-div");

            msgElement.className = 'chat-msg';

            msgElementDiv.innerHTML = mensaje;

            msgElement.appendChild(nameElement);
            msgElement.appendChild(msgElementDiv);

            // 2. Insertar en el contenedor
            return msgElement;
        }

        const lsmsg = localStorage.getItem('msgRegistry');    
        if(lsmsg){
        primerCarga = false;
        mensajes = JSON.parse(lsmsg);
        console.log("msg",mensajes);
        var con = 0;
        mensajes.forEach(texto => {con++;
                chatContainer.prepend(chat(texto.mensaje,texto.usuario));      
            });
        }

        function showChat(){
        if(ctchatwra.classList.contains("hidden")){
            if(!ctbtnspan.classList.contains("oculto")){
                ctbtnspan.classList.add("oculto");
                }
            ctchatwra.classList.remove("hidden");
            ctbtni.classList.remove("fa-angle-up");
            ctbtni.classList.add("fa-angle-down");
            }else{
            ctchatwra.classList.add("hidden"); 
            ctbtni.classList.remove("fa-angle-down");
            ctbtni.classList.add("fa-angle-up");  
            }
        }

        // Prueba inicial
        //chat("Sistema M.A.R.S. iniciado...");


        // Función para capturar el input y enviarlo al chat
        function enviarDesdeInput() {
            let mensaje = ctinput.value.trim();

            if (mensaje !== "") {

                mensaje = mensaje.split(" ").map((e) => {

                if(e.startsWith("https://www")){
                return `<a href="${e}" target="_blank">${e}</a>`;
                }

                return e;

                }).join(" ");

                sendmensajes(mensaje) ;
                ctinput.value = ""; // Limpiamos el campo
            }

            
        }
        function recibirmensajes(){
                getmensajes();
            }
            
        async function getmensajes() { 
            
            const userid = localStorage.getItem('user_id');

            if(!userid){return;}

            try {
                const res = await fetch('chat_read.php',{
                    method: 'POST',headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        last_id: mensajes.length > 0 ? mensajes[mensajes.length - 1].id : 0,
                        limit: primerCarga ? 20 : null // Si es la primera vez, pedimos 30
                    }),
                });
                const servidor = await res.json();
                if (servidor.success) {
    
                        const username = localStorage.getItem('user_name');
                        var nombre = "";
                        if(username){
                        nombre = username;
                        }

                        //console.log("server",servidor.msjs)

                        const arraynueva = servidor.msjs;
                        const arrayvieja = mensajes;

                        const mensajesParaAgregar = arraynueva.filter(nuevo => {
                        return !arrayvieja.some(local => local.id === nuevo.id);
                        });

                        console.log("arraynueva",arraynueva)
                        console.log("arrayvieja",arrayvieja)
                        // 2. Si hay mensajes nuevos, los añadimos al array original
                        const Qmensajes = mensajesParaAgregar.length;
                        if (Qmensajes > 0) {
                            primerCarga = false;
                            

                        mensajes.push(...mensajesParaAgregar);
                        console.log(`Se han añadido ${mensajesParaAgregar.length} mensajes nuevos.`);
                        let con=0;
                        let newname=0;
                        mensajesParaAgregar.reverse().forEach(texto => {con++

                                if(Qmensajes < 10){
                                    setTimeout(() => {
                                        chatContainer.prepend(chat(texto.mensaje,texto.usuario)); 
                                        if(texto.usuario == nombre){
                                        chatContainer.scrollTop = chatContainer.scrollHeight;
                                        }
                                    },200*con);
                                    }else{
                                    chatContainer.prepend(chat(texto.mensaje,texto.usuario));     
                                    }
                               
                               
                                if(texto.usuario != nombre){newname=1}
                                
                                    
                                });

                                if(newname==1){
                                    sonido(0);
                                    if(ctchatwra.classList.contains("hidden")){
                                    ctbtnspan.classList.remove("oculto");
                                    }
                                }

                            const ultimosVeinte = JSON.stringify(mensajes.slice(-20));
                            localStorage.setItem('msgRegistry',ultimosVeinte);
                            }
                            getmensajes();
                    
                }else{ console.log("error en consulta de chat");
                setTimeout(getmensajes(), 5000);
                }
            } catch (e) {

                console.error("Error enviar configuraciones:", e);
               setTimeout(getmensajes(), 5000);
            }
        }

        getmensajes();

        async function sendmensajes(m) {
            
            const userid = localStorage.getItem('user_id');

            if(!userid){return;}

            try {
                const res = await fetch('chat_send.php',{
                    method: 'POST',headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        userid: userid,
                        msg: m,
                    }),
                });
                const servidor = await res.json();
            } catch (e) { 
                console.error("Error enviar configuraciones:", e);
            }
        }

    </script>
</body>
</html>