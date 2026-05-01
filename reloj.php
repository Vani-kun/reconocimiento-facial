<style>
    :root {
        --color-neon: #00f2ff; /* Cyan tecnológico */
        --bg-hex: rgba(26, 32, 44, 0.9);
    }

    #reloj-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        filter: drop-shadow(0 0 10px rgba(0, 242, 255, 0.3));
        z-index: 9999;
        user-select: none;          
        cursor: default;
    }

    #reloj {
        background: var(--bg-hex);
        color: var(--color-neon);
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 300;
        letter-spacing: 2px;
        padding: 20px 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        /* Forma de Hexágono */
        clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
        border-left: 2px solid var(--color-neon);
        min-width: 64px;
        backdrop-filter: blur(5px);
    }

    #reloj span {
        font-size: 0.8rem;
        margin-left: 5px;
        opacity: 0.7;
    }
</style>

<div id="reloj-container">
    <div id="reloj">00:00:00 <span>--</span></div>
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
    }

    // Ejecución inmediata y actualización cada segundo
    actualizarReloj();
    setInterval(actualizarReloj, 1000);
</script>