
<style>
    /* Posicionamiento en la mitad derecha */
.profe-info {
    position: fixed;
    right: 10%;
    top: 50%;
    transform: translateY(-50%); /* Centrado vertical */
    width: 500px;
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
        overflow: hidden;
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
<button id="btnTogglee" class="btn-primary" style="display:none">Ver Profesor</button>

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
                Estado de Asistencia: <span id="estado">Sin registro-En turno-Finalizada</span>
        </div><br><br>
    </div>
        <div style="border-radius:5vh;display:block;margin-left:1vw;">
            <div style="overflow: hidden;height:88%;width:100%;font-size:2.5vh;display: flex;">
                <div id="asis-schedule-menu-scroll" class="schedule-menu-scroll" style="display: grid;width: 100%;height:100%;">
                
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
    
    const menu = document.getElementById("asis-schedule-menu-scroll");
    try {
        const res = await fetch('php/asistencia.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, nombre: nombre})
        });
        const resultado = await res.json();
        console.log("aca",resultado);
        if (resultado.success) {
            document.getElementById("entrada").textContent=" "+resultado.horaE;
            document.getElementById("salida").textContent=" "+resultado.horaS;
            document.getElementById("estado").textContent=" "+resultado.message;

            const __DayList = resultado.horarios;
            menu.textContent = "";
            console.log("DayList",__DayList);
            __DayList.forEach(element => {

                const di = JSON.parse(element.dias);

                di.forEach(e => {
                    if(e.Dia == resultado.DiaSemana){
                        const main = document.createElement("div");
                        const ma = element.asignatura;
                        const au = element.aula;
                        const se = element.seccion;
                
                        main.classList.add("previtem","schedule-option", "draggable-item");

                        const div = document.createElement("div");
                        div.classList.add("schedule-option-pname");
                        const add1 = document.createElement("div");
                        add1.style = "display:flex";
                        const add2 = document.createElement("strong"); 
                        add2.textContent = `🖈${ma}: `;
                        const add3 = document.createElement("p"); 
                        add3.textContent = `🖈Seccion ${se} 🖈Aula ${au}`;

                        main.appendChild(div); 
                        add1.appendChild(add2); 
                        add1.appendChild(add3); 
                        main.appendChild(add1);       

                        const add4 = document.createElement("p");
                        add4.textContent = `🖈${e.Dia} ${arreglarhora(e.HoraE)} - ${arreglarhora(e.HoraS)}`;
                        main.appendChild(add4);  
                        menu.appendChild(main);   
                        }
                    });
                });

            console.log("Sistema:", resultado.msg);
            //alert(resultado.msg);
        }else{console.log("Sistema:", resultado.error);}
        
   } catch (e) {
        //console.error("Error en asistencia:", e);
   } 
}
function traerDatos(mt){
   // profEscan=JSON.parse(mt);
   // document.getElementById("profNombre").textContent=profEscan.nombre;
   const profesor = listaPro.find(u => u.id == mt.label);
   profesorGlobal=profesor;
   //document.getElementById("profCirculo").textContent=profesor.nombre[0];
   creafoto(document.getElementById("profCirculo"),profesor.id,profesor.nombre);
   document.getElementById("profNombre").textContent=profesor.nombre;
   document.getElementById("profTags").textContent="Especialidad: "+profesor.tags;
}


</script>