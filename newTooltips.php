<style>
/* Clase base para el contenedor */
.tooltip-container {
    position: relative;
}

/* Estilo base del tooltip (común para ambos) */
.tooltip-container::after {
    content: attr(data-tooltip);
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    background-color: #333;
    color: #fff;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 13px;
    white-space: nowrap;
    opacity: 0; /* Oculto por defecto */
    transition: opacity 0.2s;
    pointer-events: none;
    z-index: 100000;
    text-shadow: none;
    font-family: 'Segoe UI', sans-serif;
    font-weight: normal;
    animation: none;
    }

/* --- MODO ARRIBA (Default) --- */
.tooltip-container:not(.tooltip-down)::after {
    bottom: 125%;
}

/* --- MODO ABAJO (Cuando no hay espacio arriba) --- */
.tooltip-container.tooltip-down::after {
    top: 125%; /* Cambiamos bottom por top */ 
}

.tooltip-show::after {
    opacity: 1;
}

</style>

<script>
window.addEventListener('load', () => {

document.querySelectorAll('[data-tooltip]').forEach(el => {

        el.classList.add('tooltip-container');
        
        el.addEventListener('mouseenter', () => {
            const rect = el.getBoundingClientRect();
            const mytime = (el.getAttribute("time-tooltip") || 0) * 1000;

            clearTimeout(el.tooltipTimer);

            el.tooltipTimer = setTimeout(() => {
                el.classList.add('tooltip-show');
                }, mytime);
            
            // Si la distancia al borde superior es menor a 60px
            if (rect.top < 60) {
            el.classList.add('tooltip-down');
            } else {
            el.classList.remove('tooltip-down');
            }
        });

        el.addEventListener('mouseleave', () => {
            
            el.classList.remove('tooltip-show');
            clearTimeout(el.tooltipTimer);

        });

        el.addEventListener('click', () => {
            
            el.classList.remove('tooltip-show');
            clearTimeout(el.tooltipTimer);

        });

    });

});
</script>