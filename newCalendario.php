<style>
    .calendario-container {
        width: 300px;
        background: var(--newpoligono);
        border-radius: 10px;
        padding: 0px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        font-family: sans-serif;
        overflow: hidden;
    }

    .dias-semana {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        font-weight: bold;
        background: var(--newprima);
        color: var(--newletras);
        margin-bottom: 10px;
    }
    .dias-semana div,.dia{
         padding: 5px;
    }
    .calendario-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .dia {
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        font-size: 0.9em;
    }

    /* El círculo para el día seleccionado o actual */
    .dia.activo::before {
        content: '';
        position: absolute;
        width: 30px;
        height: 30px;
        background: var(--newsecu);
        border: 2px solid var(--prima);;
        border-radius: 50%;
        z-index: 0;
    }

    /* Punto indicador de que hay registro (asistencia) */
    .dia.tiene-registro::after {
        content: '';
        position: absolute;
        bottom: 2px;
        width: 4px;
        height: 4px;
        background: var(--newprima);; /* Verde */
        border-radius: 50%;
    }

    .dia span {
        position: relative;
        z-index: 1;
    }
</style>

<div class="calendario-container">
    <div class="dias-semana">
        <div>L</div><div>M</div><div>M</div><div>J</div><div>V</div><div>S</div><div>D</div>
    </div>
    <div id="calendario-dias" class="calendario-grid">
        <!-- Los días se cargarán aquí -->
    </div>
</div>
<script>
    function generarCalendario(mes, anio, diasConRegistro = []) {
    const contenedor = document.getElementById('calendario-dias');
    contenedor.innerHTML = ''; // Limpiar calendario

    const hoy = new Date();
    const primerDia = new Date(anio, mes, 1).getDay(); // 0 (Dom) a 6 (Sab)
    const totalDias = new Date(anio, mes + 1, 0).getDate();

    // Ajuste para que empiece en Lunes (L=0, M=1... D=6)
    // El getDay de JS es (D=0, L=1...). Transformamos:
    let shift = primerDia === 0 ? 6 : primerDia - 1;

    // 1. Espacios en blanco para el inicio de mes
    for (let i = 0; i < shift; i++) {
        const vacio = document.createElement('div');
        contenedor.appendChild(vacio);
    }

    // 2. Crear los días
    for (let dia = 1; dia <= totalDias; dia++) {
        const elDia = document.createElement('div');
        elDia.classList.add('dia');
        
        // Formatear fecha actual para comparar
        const fechaString = `${anio}-${(mes + 1).toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;

        // ¿Es hoy? (Círculo azul)
        if (dia === hoy.getDate() && mes === hoy.getMonth() && anio === hoy.getFullYear()) {
            elDia.classList.add('activo');
        }

        // ¿Tiene registro? (Punto verde)
        if (diasConRegistro.includes(fechaString)) {
            elDia.classList.add('tiene-registro');
        }

        elDia.innerHTML = `<span>${dia}</span>`;
        
        // Evento al hacer click para filtrar
        elDia.onclick = () => filtrarPorFecha(fechaString);

        contenedor.appendChild(elDia);
    }
}

// Ejemplo de uso:
// Mes 4 es Mayo (empiezan en 0), año 2026.
// Le pasamos una lista de fechas que tienen asistencia.
const asistencias = ['2026-05-01', '2026-05-04', '2026-05-06'];
generarCalendario(4, 2026, asistencias);

function filtrarPorFecha(fecha) {
    console.log("Filtrando registros para la fecha:", fecha);
    // Aquí llamarías a tu función de PHP para traer la asistencia de ese día
}
</script>