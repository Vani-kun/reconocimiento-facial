<style>
    #reloj-container {
        position: fixed;
        bottom: 0px;
        right: 0px;
       /* filter: drop-shadow(0 0 10px var(--newprima));*/
        z-index: 99;
        user-select: none;          
        cursor: default;

        background: rgba(0, 0, 0, 0.3);
        color: var(--newprima);
        border-right: 2px solid var(--newprima);

        clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
        clip-path: polygon(15% 0, 100% 0, 100% 100%, 0 100%, 0 25%);backdrop-filter: blur(5px);  
        
        min-width: 200px;   

    }
    #reloj {    
        text-shadow: 0 0 5px var(--newprima);
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        font-size: 20px;font-weight: bold;text-align: right;
        letter-spacing: 2px;padding: 0px 20px;
        display: flex;align-items: center;justify-content: center;  
    }
    #reloj span {
        font-size: 0.8rem;
        margin-left: 5px;
        opacity: 0.7;
    }
            #date {
                 margin-right:10px;
            font-size: 0.8rem;
            text-align: right;
            text-transform: uppercase;
            opacity: 0.8;
            margin-bottom: 10px;
        }
    .label {
        font-size: 0.6rem;
        color: #555;
        display: block;
        text-align: right;
        margin-right:10px;
    }

        .scanner-line {
            width: 100%;
            height: 1px;
            background: var(--newprima);
            margin: 10px 0;
            opacity: 0.3;
            position: relative;
            overflow: hidden;
        }
        .scanner-line::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 100%;
            background: white;
            box-shadow: 0 0 10px white;
            animation: scan 3s infinite linear;
        }
        @keyframes scan {
            0% { left: -60px; }
            100% { left: 100%; }
        }
        .copyright {
            font-size: 0.7rem;
            cursor: pointer;
            display: block;
            text-align: center;
            margin-top: 5px;
            transition: 0.3s;
        }

        .copyright:hover {
            color: white;
            text-shadow: 0 0 8px white;
        }
</style>

<div id="reloj-container">
     <span class="label">BETA_v0.1 </span>
    <div id="reloj">00:00:00 <span>--</span></div>
    <div id="date">SYNCING...</div>
     <div class="scanner-line"></div>
    <div class="copyright" onclick="mostrarInfo()">
        © LIVELULA. <span style="text-decoration: underline;">Saber más...</span>
    </div>
</div>

<script>
    function actualizarReloj() {
        const ahora = new Date();
        // Usamos Intl.DateTimeFormat para un formateo limpio y rápido
        const opciones = { 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit', 
            hour12: true 
        };
        
        const tiempoString = ahora.toLocaleTimeString('en-US', opciones);
        
        // Separamos la hora del AM/PM para darle estilo al span
        const [hora, periodo] = tiempoString.split(' ');
        document.getElementById('reloj').innerHTML = `${hora}<span>${periodo}</span>`;

        const options = { year: 'numeric', month: 'short', day: '2-digit' };
        document.getElementById("date").textContent = ahora.toLocaleDateString('es-ES', options);
    }
        function mostrarInfo() {
            alert("Somos Livelula una empresa emprededora de software");
        }

    // Ejecución inmediata y actualización cada segundo
    actualizarReloj();
    setInterval(actualizarReloj, 1000);
</script>