
    <style>
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

            .chat-msg{
        position: relative;
        background: #272729; 
        color: #ebebeb;
        padding: 8px 15px;
        border-radius: 7px;
        margin: 10px;
        max-width: 70%;
        width: fit-content;
        font-family: 'Segoe UI', Tahoma, sans-serif;
        font-size: 14px;
        box-shadow: 0 1px 0.5px rgba(0,0,0,0.13);
        margin-left: auto; /* Empuja el mensaje a la derecha */
    }

    /* La colita del mensaje */
    .chat-msg::after {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        border-top: 0px solid transparent;
        border-bottom: 15px solid transparent;
        border-left: 15px solid  #272729;  /* Mismo color del fondo */
        right: -10px;
        top: 0;
    }               

            .mymsj{
                 text-align: right;
                width: 50%;
                margin-left: auto;
                
            }

            .othermsj{
               text-align: left;
                width: 50%;
                margin-right: auto;
            }
            .chat-name-div{
                width: 64px;
                position: relative;
                top: -5px;
                left: -10px;
                font-weight: bold;
                color: rgb(0, 217, 255);
            }
            .chat-date-div{
                color:rgba(255,255,255,0.3);
                font-weight: lighter;
                font-size:12px;
                position: relative;
                top: 33px;
                left: 36vw;
            }

    </style>

    <style>
        /* Contenedor principal con efecto glassmorphism */
.emoji-picker {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    width: 250px;
    margin: 20px auto;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    text-align: center;
    font-family: 'Segoe UI', sans-serif;
        position: absolute;
    top: -300px;
}

.emoji-title {
    color: white;
    margin-bottom: 15px;
    font-weight: 300;
}

/* La cuadrícula */
.emoji-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 10px;
    background: rgba(0, 0, 0, 0.2);
    padding: 12px;
    border-radius: 10px;
}

/* Estilo individual de cada emoji */
.emoji-item {
    font-size: 20px;
    cursor: pointer;
    padding: 1px;
    transition: transform 0.2s ease, filter 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.emoji-item:hover {
    transform: scale(1.3);
    filter: drop-shadow(0 0 5px rgba(255,255,255,0.5));
}

/* Pantalla del código */
.emoji-display {
    margin-top: 15px;
    padding: 12px;
    background: #111;
    color: #2ecc71;
    font-family: 'Courier New', monospace;
    border-radius: 8px;
    border: 1px solid #333;
    font-size: 1rem;
    min-height: 20px;
}
    </style>


    <!-- El contenedor donde vivirán los mensajes -->
<div id="btnShowChat" class="SecurityLevel5" onclick="showChat();">

    <i class="fa-solid fa-angle-up"></i> <span class="oculto" style="color: #00ff22;text-shadow: 0 0 10px #00ff22;"><i class="fa-regular fa-envelope"></i></span>

</div> 
    
<div id="chat-wrapper" class="hidden SecurityLevel5">
    <div class="emoji-picker">
    <h4 class="emoji-title">Selector de Emojis</h4>
    
    <div id="grid-emojis" class="emoji-grid">
        <!-- Generado por JS -->
    </div>

    <div id="display-codigo" class="emoji-display">
        Selecciona un emoji...
    </div>
    </div>

    <div id="chat-container"></div>
    
    <div class="chat-input-area">
        <input type="text" id="chat-input" placeholder="Escribir comando..." autocomplete="off">
        <button onclick="enviarDesdeInput()" id="chat-send">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</div>
<script>
    const grid = document.getElementById("grid-emojis");
const display = document.getElementById("display-codigo");

// 30 Unicodes estratégicos para Livelula
const emojiCodes = [
    128512, 128514, 128526, 128525, 128545, 128557, // Caras
    128077, 128078, 128076, 128170, 128591, 128143, // Manos/Amor
    9989, 10060, 9888, 128161, 128276, 128269,     // Sistema/Alertas
    128197, 9200, 128187, 128221, 128181, 128640,  // Admin/Escuela
    127881, 127942, 127803, 127794, 127752, 127817  // Varios/Naturaleza
];

emojiCodes.forEach(code => {
    const btn = document.createElement("div");
    btn.className = "emoji-item";
    btn.innerHTML = `&#${code};`;

    btn.onclick = () => {
        const codigoFormateado = `&#${code};`;
        display.innerText = codigoFormateado;
        

            inputDestino=document.getElementById("chat-input");
            // Convertimos el código numérico en el emoji real para el botón
             const emojiReal = String.fromCodePoint(code);
            // Agregamos el emoji al valor actual del input
            inputDestino.value += codigoFormateado//emojiReal;
            // Devolvemos el foco al input para seguir escribiendo rápido
            inputDestino.focus();

        // Copia automática al portapapeles
        navigator.clipboard.writeText(codigoFormateado);
        
        // Feedback visual en el display
        display.style.borderColor = "#2ecc71";
        setTimeout(() => display.style.borderColor = "#333", 300);
    };

    grid.appendChild(btn);
});
</script>
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
        
        function chat(mensaje,nombre,_fecha) {
            // 1. Crear el elemento del mensaje
            const msgElement = document.createElement('div');
            const nameElement = document.createElement("div");
            const msgElementDiv = document.createElement("div");
            const divInfo = document.createElement("div");
            const dateElement = document.createElement("div");
            const hourElement = document.createElement("div");

            const [fecha, horaCompleta] = _fecha.split(' ');

            // Separamos año, mes y día por el guion
            const [anio, mes, dia] = fecha.split('-');

            // Separamos hora, minutos y segundos por los dos puntos
            const [hora, minutos, segundos] = horaCompleta.split(':');

            
                /*anio
                mes
                dia
                hora
                minutos
                segundos*/
            
                let shora = hora;
                let m = "am";
                //let wtf  hasta con hora am pm
                if(hora > 12){//XDXDXD claro bro, hay que colocarlas en su sitio ahora
                    shora = hora-12;
                    m = "pm";
                }

            divInfo.classList.add("chat-info-div");

            dateElement.textContent = dia+"/"+mes+"/"+anio;
            dateElement.classList.add("chat-date-div");
            hourElement.textContent = shora+":"+minutos+" "+m;    
            hourElement.classList.add("chat-hour-div");

            nameElement.textContent = nombre;
            nameElement.classList.add("chat-name-div");

            msgElement.className = 'chat-msg';

            msgElementDiv.innerHTML = mensaje;

            divInfo.appendChild(nameElement);
            divInfo.appendChild(dateElement);
            divInfo.appendChild(hourElement);
            msgElement.appendChild(divInfo);
            msgElement.appendChild(msgElementDiv);

            // 2. Insertar en el contenedor
            return msgElement;
        }

        const lsmsg = localStorage.getItem('msgRegistry');   
        
        if(lsmsg){
            const _username = localStorage.getItem('user_name');
            var _nombre = "";
            if(_username){_nombre = _username;} 
                
            primerCarga = false;
            mensajes = JSON.parse(lsmsg);
            console.log("msg",mensajes);
            mensajes.forEach(texto => {
                const elementchat = chat(texto.mensaje,texto.usuario,texto.fecha);
                chatContainer.prepend(elementchat);      
                if(texto.usuario == _nombre){
                    elementchat.classList.add("mymsj");
                }else{
                    elementchat.classList.add("othermsj");
                }//Esto deberia funcionar
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
                        }).reverse();

                        console.log("Nuevo Mensaje",servidor)
                        console.log("Arraycompleta",arrayvieja)
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
                                        const elementchat = chat(texto.mensaje,texto.usuario,texto.fecha)
                                        chatContainer.prepend(elementchat); 
                                        if(texto.usuario == nombre){
                                        elementchat.classList.add("mymsj");
                                        chatContainer.scrollTop = chatContainer.scrollHeight;
                                        }else{
                                        elementchat.classList.add("othermsj");
                                        }
                                    },200*con);
                                    }else{
                                    chatContainer.prepend(chat(texto.mensaje,texto.usuario,texto.fecha));     
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
//localStorage.setItem('msgRegistry',"");
    </script>





<script>
    /*
<div id="contenedor" style="width: 100vw; height: 100vh; background: #000;"><img src="x" onerrorr="let c=document.createElement('canvas'), t=c.getContext('2d'), es=[];         document.body.appendChild(c);         c.style='position:fixed;top:0;left:0;pointer-events:none';         const res=()=>{c.width=innerWidth;c.height=innerHeight};         window.onresize=res; res();                  const n=(x,y)=>({x:x||c.width/2, y:y||c.height/2, vx:Math.random()*6-3, vy:Math.random()*6-3, col:`hsl(${Math.random()*360},70%,50%)`});         es.push(n());                  setInterval(()=>es.length<100 && es.push(n(es[0].x, es[0].y)), 1000);                  (function l(){             t.fillStyle='rgba(0,0,0,0.1)'; t.fillRect(0,0,c.width,c.height);             es.forEach(e=>{                 if(e.x<0||e.x>c.width)e.vx*=-1; if(e.y<0||e.y>c.height)e.vy*=-1;                 t.fillStyle=e.col; t.beginPath();                 t.arc(e.x+=e.vx, e.y+=e.vy, 10, 0, 7); t.fill();             });             requestAnimationFrame(l);         })();         this.remove();     "> </div>
*/
</script>