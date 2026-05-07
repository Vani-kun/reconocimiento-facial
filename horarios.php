<main  class="main-container schedule-main">

<button id="schedule-toggle-panel" onclick="showHorarios(0)" class="btn-toggle-panel ocultoboton">✕</button>

    <section id="ScheduleMain" class="main-wrapper hidden schedule-container">
        <div id="schedule-section" class="schedule-div open">
            <div class="panel-header" style="align-content: center;height:60px;">
            <h2 style="font-size:3.5vh;margin-bottom: 0;">Horario</h2>
            </div>

            <div class="schedule">
                <div id="schedule-header" class="schedule-header" style="grid-template-columns: repeat(0, 1fr);">
                    <div id="hLunes" class="schedule-day-div-h oculto">Lunes</div>
                    <div id="hMartes" class="schedule-day-div-h oculto">Martes</div>
                    <div id="hMiercoles" class="schedule-day-div-h oculto">Miercoles</div>
                    <div id="hJueves" class="schedule-day-div-h oculto">Jueves</div>
                    <div id="hViernes" class="schedule-day-div-h oculto">Viernes</div>
                    <div id="hSabado" class="schedule-day-div-h oculto">Sabado</div>
                    <div id="hDomingo" class="schedule-day-div-h oculto">Domingo</div>
                </div>

                <div id="schedule-range" class="schedule-config">
                    <div id="Lunes" class="schedule-day-div oculto"></div>
                    <div id="Martes" class="schedule-day-div oculto"></div>
                    <div id="Miercoles" class="schedule-day-div oculto"></div>
                    <div id="Jueves" class="schedule-day-div oculto"></div>
                    <div id="Viernes" class="schedule-day-div oculto"></div>
                    <div id="Sabado" class="schedule-day-div oculto"></div>
                    <div id="Domingo" class="schedule-day-div oculto"></div>
                </div>

            </div>
        </div>

        
        <div id="openmenubtn"><i class="fa-solid fa-angle-up"></i></div>
        <div id="schedule-menu" class="schedule-menu open">
            <div id="schedule-allSections" class="schedule-menu-scroll">


                
            </div>
        </div>
    </section>
</main>

<script>

profSelected = -1;
Horario = 0;

const allSections = document.getElementById("mold-items-bank");
const schAS = document.getElementById("schedule-allSections");


function toggleSchedulePanel(_Nmb){

if(_Nmb){
    document.getElementById("ScheduleMain").classList.remove("hidden");
    Horario = 1;
    schAS.textContent = "";
    schAS.innerHTML = allSections.innerHTML;
    allSections.textContent = "";

    const datosHorarios = document.getElementsByClassName("schedule-option");
    const profDatos = datosProfesores;
    schedulerecharge()

    }else{
    document.getElementById("ScheduleMain").classList.add("hidden");
    Horario = 0;
    allSections.textContent = "";
    allSections.innerHTML = schAS.innerHTML;
    schAS.textContent = "";

    schedulerecharge()
    }

}

/*Estas 3 variables seran configurables desde config de pagina*/

const starthour = "14:15";//Hora de inicio del horario
const endhour = "20:25";//Hora donde terminara el horario
const qdias = 5;//Cantidad de dias que tendra el horario desde lunes hasta el domingo (5 es hasta el viernes)

let sh = Number(starthour.split(":")[0]);
let sm = Number(starthour.split(":")[1]);

let eh = Number(endhour.split(":")[0]);
let em = Number(endhour.split(":")[1]);

if(sh > eh){
temp = sh;
sh = eh;
eh = temp;

temp = sm;
sm = em;
em = temp;
}else if(sh == eh){
const temp = sh;
    if(sm > em){    
        const temp = sm;
        sm = em;
        em = temp;
        }
    }

let maxh = eh-sh;
let maxhm = em-sm;
if(maxhm < 0){
    maxh--; 
    maxhm += 60;
    }
const START_HOUR = sh;
const START_MINUTE = sm;                
const MAX_HOUR = maxh+(maxhm/60);

const PIXELES_POR_MINUTO = 1.084/MAX_HOUR;

if(qdias >= 1){
document.getElementById("Lunes").classList.remove("oculto");
document.getElementById("hLunes").classList.remove("oculto");
}
if(qdias >= 2){
document.getElementById("Martes").classList.remove("oculto");
document.getElementById("hMartes").classList.remove("oculto");
}
if(qdias >= 3){
document.getElementById("Miercoles").classList.remove("oculto");
document.getElementById("hMiercoles").classList.remove("oculto");
}
if(qdias >= 4){
document.getElementById("Jueves").classList.remove("oculto");
document.getElementById("hJueves").classList.remove("oculto");
}
if(qdias >= 5){
document.getElementById("Viernes").classList.remove("oculto");
document.getElementById("hViernes").classList.remove("oculto");
}
if(qdias >= 6){
document.getElementById("Sabado").classList.remove("oculto");
document.getElementById("hSabado").classList.remove("oculto");
}
if(qdias >= 7){
document.getElementById("Domingo").classList.remove("oculto");
document.getElementById("hDomingo").classList.remove("oculto");
}

document.getElementById("schedule-header").style="grid-template-columns: repeat("+qdias+", 1fr);";




let HorarioList = [];

 /**
 * Crea y posiciona una tarea en el horario.
 * @param {string} horaInicio - Formato "HH:MM" (ej: "03:15")
 * @param {string} horaFin - Formato "HH:MM" (ej: "04:45")
 * @param {string} titulo - Nombre de la actividad
 * @param {string} carrilId - El ID del div del día (ej: "lunes-carril")
 */
const convertirAMinutos = (horaStr) => {
        const [horas, minutos] = horaStr.split(':').map(Number);
        return (horas * 60) + minutos;
    };

function agregarTarea(horaInicio, horaFin, titulo, carrilId, Seccion = "", Aula = "") {           

    const MINUTOS_INICIO_HORARIO = (START_HOUR * 60) + START_MINUTE; // 2:15 PM en minutos

    const minInicio = convertirAMinutos(horaInicio);
    const minFin = convertirAMinutos(horaFin);

    const posicionTop = (minInicio - MINUTOS_INICIO_HORARIO) * PIXELES_POR_MINUTO;
    const duracionPx = (minFin - minInicio) * PIXELES_POR_MINUTO;

    const taskBox = document.createElement('div');
    taskBox.classList.add('task-box');

    Object.assign(taskBox.style, {
        top: `${posicionTop}vh`,
        height: `${duracionPx}vh`
    });

    taskBox.innerHTML = `<strong>${titulo}</strong><br>Sección: ${Seccion}<br>Aula: ${Aula}<br>${arreglarhora(horaInicio)} - ${arreglarhora(horaFin)}`;

    const carril = document.getElementById(carrilId);
    if (carril) {
        carril.appendChild(taskBox);
    } else {
        console.error(`No se encontró el carril con ID: ${carrilId}`);
    }
}

function LimpiarHorario(){
document.getElementById("schedule-range").style = "";

document.getElementById("Lunes").textContent = "";
document.getElementById("Martes").textContent = "";
document.getElementById("Miercoles").textContent = "";
document.getElementById("Jueves").textContent = "";
document.getElementById("Viernes").textContent = "";
document.getElementById("Sabado").textContent = "";
document.getElementById("Domingo").textContent = "";
}

async function ActualizarHorario(){

    LimpiarHorario();
    
    if(profSelected == -1){return;}

    const myid = profSelected.getAttribute("id");
    let _Maxhour = "00:00:00";

    try {
        const respuesta = await fetch('php/horario/checkhorario.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
                },
            body: JSON.stringify({
            id: myid
                }),
            });

        const resultado = await respuesta.json(); 
        if (resultado.success) {
            const data = Array.from(resultado.data);
            
            HorarioList = data;        

            data.forEach(e => {
                const name = e.asignatura;
                const seccion = e.seccion;
                const aula = e.aula;

                const dias = JSON.parse(e.dias);
                dias.forEach(i => {
                    agregarTarea(i.HoraE,i.HoraS,name,i.Dia,seccion,aula);
                    if(i.HoraS > _Maxhour){
                        _Maxhour = i.HoraS;
                        }
                    })
                

                });

                _Maxhour = convertirAMinutos(_Maxhour)-convertirAMinutos(START_HOUR+":"+START_MINUTE);

                _Maxhour = Math.max(_Maxhour * PIXELES_POR_MINUTO, 80);    

                document.getElementById("schedule-range").style = `min-height:${_Maxhour}vh;`;   
            } else {
                m("respuesta: " + resultado.error);
            }
        } catch (error) {
        console.error("Error al enviar: ", error);
        }  

        

    }

function arreglarhora(hora){

    let hora24 = hora;
    if(hora.length > 5){hora24 = hora.substring(0, 5)}  

    const fechaTemp = new Date(`1970-01-01T${hora24}:00`);

    return fechaTemp.toLocaleString('en-US', { 
        hour: 'numeric', 
        minute: 'numeric', 
        hour12: true 
        });
    }



    document.getElementById("openmenubtn").addEventListener("click", () => {

        if(!document.getElementById("schedule-section").classList.contains("open")){
            document.getElementById("schedule-section").classList.add("open");
            document.getElementById("schedule-menu").classList.add("open");
            document.getElementById("openmenubtn").innerHTML = `<i class="fa-solid fa-angle-up"></i>`;
            }else{
            document.getElementById("schedule-section").classList.remove("open");
            document.getElementById("schedule-menu").classList.remove("open");
            document.getElementById("openmenubtn").innerHTML = `<i class="fa-solid fa-angle-down"></i>`;    
            }

        })

    
</script>
