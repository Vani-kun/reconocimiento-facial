
<style>
    /* Posicionamiento en la mitad derecha */
.profe-info {
    position: fixed;
    right: 10%;
    top: 50%;
    transform: translateY(-50%); /* Centrado vertical */
    width: 350px;
    background: var(--newpoligono);
    color:var(--newletras);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    text-align: center;
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    z-index: 1000;
    opacity: 1;
}

/* Estado cuando está oculto (desplazado hacia abajo y transparente) */
.profe-info.hidden {
    transform: translateY(-50vh); /* Se va hacia el fondo de la pantalla */
    opacity: 0;
    pointer-events: none;
}

/* El círculo con la letra */
.avatar-circle {
    width: 80px;
    height: 80px;
    background: var(--newprima);
    color: white;
    font-size: 40px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 15px;
    text-transform: uppercase;
}

.asistencia {
    margin-top: 15px;
    font-size: 0.9em;
}

.estado {
    color: #2ecc71; /* Verde para asistencia */
    display: block;
}
.btn-primary{
position: fixed;
    left: 5%;
    top: 5%;
    z-index: 10000;
}
.status-badge {
            margin-top: 25px;
            display: inline-block;
            padding: 8px 15px;
            background: var(--newnucle);
            color: var(--newsecu);
            border-radius: 5px;
            font-size: 1em;
        }
</style>
<!-- Botón para controlar el panel -->
<button id="btnTogglee" class="btn-primary" style="display:none;">Ver Profesor</button>

<!-- Contenedor de información -->
<div id="profesorrPanel" class="profe-info hidden">
    <div id="profCirculo"class="avatar-circle">A</div>
    <h2 id="profNombre">Nombre del Profesor</h2>
    <p  id="profTags"class="especialidad">Especialidad: Reconocimiento Facial</p>
    <hr>
    <div class="asistencia">
        <div><strong>Entrada:</strong><span id="entrada"> 6:00 AM</span></div>
        <div><strong>Salida:</strong> <span id="salida">12:00 PM</span></div>
        <div class="status-badge estado">
                Estado de Asitencia: <span id="estado">Sin registro-En turno-Finalizada</span>
        </div><br><br>
    </div>
            <div class="#0f495e" style="background-color:#D1EAEC;border-radius:5vh;display:block;margin-left:1vw;">
            <div style="height:88%;width:100%;font-size:2.5vh;display:grid;grid-template-rows: 10% 10% 10% 10% 50% 10%;align-items: center;">
                <h1 id="detected-name">Esperando...</h1>
                <h2 id="detected-tags" style="color:#ADD8D5">Tags:</h2>
                <h3 id="detected-hour" style="color:#81BA4E"></h3>
                <h3 id="detected-state" style="color:#E41924"></h3>
                <div id="schedule-menu-scroll" class="schedule-menu-scroll" style="width:80%;height:100%;justify-self: center;grid-template-columns: 1fr;">
                </div>
                <br>
            </div>

        </div>
</div>

<script>
    const btn = document.getElementById('btnTogglee');
    const panel = document.getElementById('profesorrPanel');

    btn.addEventListener('click', () => {
        if (panel.classList.contains('hidden')) {
            showAsistencia(1);
        } else {
           showAsistencia(0);
        }
        
    });
    function showAsistencia(mm){
        if (mm==1){
            panel.classList.remove('hidden');
            btn.textContent = "Ver Profesor";
        }else
        if (mm==0){
            panel.classList.add('hidden');
            btn.textContent = "Cerrar Panel";
        }
        
    }

async function asistencia(id,nombre) {
    try {
        const res = await fetch('asistencia.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ pid: id, nombre: nombre })
        });
        const resultado = await res.json();

        if (resultado.success) {
            document.getElementById("entrada").textContent=" "+resultado.entro;
            document.getElementById("salida").textContent=" "+resultado.salio;
            document.getElementById("estado").textContent=" "+resultado.tipo;

            console.log("Sistema:", resultado.msg);
            //alert(resultado.msg);
        }else{console.log("Sistema:", resultado.error);}
        
   } catch (e) {
        //console.error("Error en asistencia:", e);
   } 
}










///////////////////////////////////////////////////////////esto esta sin uso pero lo deje por temas de los horarios en las asisteancvias


    /*
                    ///esto lo desconosco imagino  q  es algo para la asistencai
                    const mydata = JSON.parse(match.label);
                    const ahora = Date.now();
                    const cincoMinutos = 10 * 1000;
                    if (ultimosMarcajes[mydata.id]) {
                        const tiempoTranscurrido = ahora - ultimosMarcajes[mydata.id];
                        if (tiempoTranscurrido < cincoMinutos) {
                            return; 
                        }
                    }
                    intentarAsistencia(mydata);
                    //estatus.textContent = mydata.nombre;
 */

async function intentarAsistencia(Profesor){

    /*
    Esta función registra la asistencia al servidor
    */
    console.log(realtime)

    try {
    const res = await fetch('php/asistencia.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            id: Profesor.id,
            nombre: Profesor.nombre,
            hora: realtime,
            threshold: 20//Tiempo de gracia para llegar tarde (en minutos)
        })
    });

    // 1. Primero obtenemos el texto plano
    const textoRaw = await res.text();
    //console.log("Respuesta bruta del servidor:", textoRaw);
    //alert(textoRaw);

    // 2. Intentamos convertirlo manualmente
    if (!textoRaw) {
        console.error("El servidor devolvió una respuesta vacía.");
        return;
    }

    const respuesta = JSON.parse(textoRaw);
    if (respuesta.success) {
        //Si pudo registrar correctamente hace el sonido y marca en la lista 
        // para no poder volver a registrar al mismo profesor almenos 10 segundos despues
        // (En el servidor el profesor no puede marcar hasta 5 minutos despues.)
        sonido(1);
        ultimosMarcajes[Profesor.id] = Date.now(); 


        if(respuesta.estado == 1 || respuesta.estado == 2){//Si registro entrada o salida correctamente
        document.getElementById("detected-state").textContent = respuesta.message;
        document.getElementById("detected-hour").textContent = arreglarhora(respuesta.hora);
        document.getElementById("detected-name").textContent = Profesor.nombre;
        document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");

        }else if(respuesta.estado == 3 || respuesta.estado == 4){//Si hubo alguna advertencia (no necesariamente error)

        document.getElementById("detected-state").textContent = "⚠️ " + respuesta.message;
        document.getElementById("detected-name").textContent = Profesor.nombre;
        document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");

        }else if(respuesta.estado == 5){//Si el profesor no tiene ninguna materia asignada para el dia de hoy
            document.getElementById("detected-name").textContent = Profesor.nombre;
            document.getElementById("detected-state").textContent = respuesta.message;
            document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");
        }

        document.getElementById("schedule-menu-scroll").textContent = "";
        //Se agarra el div donde se muestran las fichas de las materias

        respuesta.horarios.forEach(e => {//Por cada materia que agarre el servidor
            const newHorario = document.createElement("div");
            let htmltext = `
                <div class="schedule-option">
                    <div class="schedule-option-header">
                        <p style="margin-left:1vw;"><strong>${e.asignatura}</strong></p>
                    </div>
                    <div class="schedule-option-body">
                        <div class="schedule-option-otherinfo">
                        <p>Sección ${e.seccion}</p>
                        <p>Aula ${e.aula}</p>
                        </div>
                        <div class="schedule-option-days">`
                    JSON.parse(e.dias).forEach(i => {//Luego cada materia puede tener varios dias configurados, 
                    // esto dice que por cada dia que tenga configurada la materia va a mostrar la hora y el dia
    htmltext += `<p><strong>${i.Dia}:</strong><span>${arreglarhora(i.HoraE)} - ${arreglarhora(i.HoraS)}</span></p>`
                        });
            htmltext += `</div>
                    </div>
                </div>`;
        newHorario.innerHTML = htmltext;

        document.getElementById("schedule-menu-scroll").appendChild(newHorario);//Aca se agrega al apartado donde van las fichas
        });

    } else {//Si hay error
        console.log(respuesta.horarios);
        // Aquí se mostrará el mensaje de "Faltan X minutos"
        console.warn(respuesta.error);
        document.getElementById("detected-state").textContent = "⚠️ " + respuesta.error;
        document.getElementById("detected-name").textContent = Profesor.nombre;
        document.getElementById("detected-tags").textContent = "Tags: "+JSON.parse(Profesor.tags).filter(e => !(e == "activo" || e == "inactivo")).join(", ");
        // Opcional: sonido de error
        sonido(0); 
    }
} catch (error) {//Si hay mas errores
    console.error("Error detallado:", error);
}
}
</script>