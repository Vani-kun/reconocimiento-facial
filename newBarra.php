<style>
        :root { --p: #00d4ff; --bg: #0a0f14; --h: 120px; --r: 160px; }

        
            /* NAV */
    /* NAV ACTUALIZADO: Blanco a Gris con Sombra */
    nav { 
        height: 70px; 
        padding: 0 40px; 
        /* Degradado de blanco puro a un gris suave hacia abajo */
        background: linear-gradient(to bottom, #ffffff 0%, #e0e0e0 100%); 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        position: relative; 
        /* Sombra negra sólida hacia abajo */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5); 
        
        position: fixed; 
        top: 0;         
        left: 0;         
        width: 100%;     
        z-index: 100;   /* Lo coloca "al frente" de los demás elementos */
    }

    .nav-contenedor { 
        position: absolute; 
        inset: 5px 20px; 
        /* Cambiamos el borde a un color oscuro sutil para que resalte sobre el blanco */
        border: 2px solid rgba(0, 0, 0, 0.1); 
        clip-path: polygon(0 0, 98% 0, 100% 30%, 100% 100%, 2% 100%, 0 70%); 
        pointer-events: none; 
    }

    /* Ajuste del botón para que resalte sobre el fondo claro */
    .nav-btn { 
        color: #333; /* Color oscuro para contraste */
        font-size: 1.8rem; 
        background: none; 
        border: none; 
        cursor: pointer; 
        transition: .3s; 
        filter: drop-shadow(0 2px 2px rgba(0,0,0,0.2));
    }

    .nav-btn:hover { 
        color: var(--p); /* Cambia al azul en hover */
        transform: rotate(90deg); 
    }
    /* MENU */
    #hexOverlay { position: fixed; inset: 0; background:rgb(0 6 255 / 70%); backdrop-filter: blur(8px); display: none; justify-content: center; align-items: center; z-index: 2000; }
    .menu-wrapper { position: relative; width: var(--h); height: 135px; }
    .hexagon { 
        position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: center; align-items: center; 
        background: #0a141e; clip-path: polygon(50% 0, 100% 25%, 100% 75%, 50% 100%, 0 75%, 0 25%);
        transition: .5s cubic-bezier(.68,-.55,.26,1.55); border: 1px solid var(--p); opacity: 0; scale: 0; cursor: pointer;
    }
    .hexagon i { font-size: 1.8rem; color: var(--p); }
    .core { opacity: 1; scale: 1.1; z-index: 10; background: radial-gradient(#005f73, #000); }
    
    /* POSICIONES (Simplificadas) */
    .expanded .hexagon { opacity: 1; scale: 1; }
    .expanded .p1 { transform: translate(0, calc(-1 * var(--r))); }
    .expanded .p2 { transform: translate(calc(-1 * var(--r)), 0); }
    .expanded .p3 { transform: translate(var(--r), 0); }
    .expanded .p4 { transform: translate(calc(var(--r) * -.7), var(--r)); }
    .expanded .p5 { transform: translate(calc(var(--r) * .7), var(--r)); }
    .hexagon:hover { background: var(--p); color: #000; }
    .hexagon:hover i { color: #000; }
</style>


<nav>
    <div class="nav-contenedor"></div>
    <img src="img/IUJO.gif" height="50" style="filter:drop-shadow(0 0 5px var(--p))">
    <button class="nav-btn" onclick="toggle(1)"><i class="fa-solid fa-atom"></i></button>
</nav>

<div id="hexOverlay" onclick="toggle(0)">
    <div class="menu-wrapper" id="mw">
        <div class="hexagon core"> <i class="fa-solid fa-power-off"></i> SALIR </div>
        <div class="hexagon p1"> <i class="fa-solid fa-user-tie"></i> Prof </div>
        <div class="hexagon p2"> <i class="fa-solid fa-address-card"></i> Reg </div>
        <div class="hexagon p3"> <i class="fa-solid fa-calendar-day"></i> Hor </div>
        <div class="hexagon p4"> <i class="fa-solid fa-gear"></i> Ctrl </div>
        <div class="hexagon p5"> <i class="fa-solid fa-lock"></i> Ses </div>
    </div>
</div>

<script>
    const o = document.getElementById('hexOverlay'), w = document.getElementById('mw');
    function toggle(s) {
        if(s) { o.style.display = 'flex'; setTimeout(() => w.classList.add('expanded'), 10); }
        else { w.classList.remove('expanded'); setTimeout(() => o.style.display = 'none', 400); }
    }
</script>
