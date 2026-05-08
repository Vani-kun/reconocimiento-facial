<style>
    .calendario-container {
        width: 300px;
        background: var(--newpoligono);
        border-radius: 10px;
        padding: 0px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        font-family: sans-serif;
        overflow: hidden;
        margin-bottom:10px;
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
    .year-show{
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
    .calendario-grid-month {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom:10px;
    }
    .calendario-grid-years {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom:10px;
    }

    .dia {
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        font-size: 0.9em;
    }
    .dia.apagado {
        font-size: 0.9em;
        color:gray;
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
    .dia.startdate::before{
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background: green;
        border: 2px solid var(--prima);
        border-radius: 50%;
        z-index: 0;
    }
    .dia.enddate::before{
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background: red;
        border: 2px solid var(--prima);
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
    .dia:hover{
    cursor: pointer;
    background: #00000055;
    border-radius: 50%;
    }

    .dia span {
        position: relative;
        z-index: 1;
    }
    .info-mes{
        display:grid;
        grid-template-columns: 1fr 1fr;
        font-weight: bolder;
    }
    .calendaroption-btn{
        background-color:var(--newprima);
        color:var(--newletras);
        height:100%;
        width:100%;
        border-radius:10px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:bolder;
        transition: box-shadow 0.2s ,opacity 0.2s;
        }
    .calendaroption-btn:hover{
        cursor:pointer;
        box-shadow: 0 0 20px rgba(var(--newprima),1);
        text-shadow: 0 0 10px #fff;
        opacity:1;
        }
    .calendaroption-div{
        height:30px;
        width:100%;
        padding:4px 4px;
        }
    .dayinput{
        height:10px;
        }
    .dayinput.activo{
        height:10px;
        border: 2px solid var(--newprima);
        box-shadow: 0 0px 10px rgba(255,255,255,0.5);
        }
    .month-div {
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        font-size: 0.9em;
    }
    .month-div.activo {
        background: #00000055;
    }
    .month-div:hover{
        cursor:pointer;
        background: #00000055;
        }
    .month-div.tiene-registro::after {
        content: '';
        position: absolute;
        bottom: 2px;
        width: 4px;
        height: 4px;
        background: var(--newprima); /* Verde */
        border-radius: 50%;
    }
    .infoCalendarBtn:hover{
        cursor:pointer;
        text-shadow: 0 0 10px #fff;
    }
</style>

<div style="display:grid;justify-items:center;align-content:center;">
    <div style="display:grid;grid-template-columns: 40% 40%;margin-bottom:5px;margin-top:5px;width: 100%;justify-content:center;">

        <div class="calendaroption-div" onclick="changemonth(0)">
            <div class="calendaroption-btn"><i class="fa-solid fa-angle-left"></i></div>
        </div>

        <div class="calendaroption-div" onclick="changemonth(1)">
            <div class="calendaroption-btn"><i class="fa-solid fa-angle-right"></i></div>
        </div>

    </div>

    <div class="calendario-container">
        <div id="dayChoiseDiv">
            <div class="info-mes">
                <div id="infoMONTH" class="infoCalendarBtn" onclick="monthYearInspector = vyear;ChoiseMonth()">DICIEMBRE</div>
                <div id="infoYEAR" class="infoCalendarBtn" onclick="YearInspector = Math.floor(parseInt(vyear) / 10) * 10;ChoiseYear()">2026</div>
            </div>
            <div class="dias-semana">
                <div>L</div><div>M</div><div>M</div><div>J</div><div>V</div><div>S</div><div>D</div>
            </div>
            <div id="calendario-dias" class="calendario-grid">
                <!-- Los días se cargarán aquí -->
            </div>
        </div>
        <div id="monthChoiseDiv" class="oculto">
            <div class="year-show">
                <strong id="year-show" class="infoCalendarBtn" onclick="YearInspector = Math.floor(parseInt(monthYearInspector) / 10) * 10;ChoiseYear()">2026</strong>
            </div>
            <div id="calendario-meses" class="calendario-grid-month">
                <!-- Los meses se cargarán aquí -->
            </div>
        </div>
        <div id="yearChoiseDiv" class="oculto">
            <div class="year-show">
                <strong id="decade-show">2020-2029</strong>
            </div>
            <div id="calendario-years" class="calendario-grid-years">
                <!-- Los años se cargarán aquí -->
            </div>
        </div>
    </div>
    
    <div style="display:grid;grid-template-columns: 50% 50%;width:100%;">
        <p>Inicio</p>
        <p>Final</p>
    </div>
    <div style="display:grid;grid-template-columns: 50% 50%;width:100%;">
        <div style="padding: 5px 5px;"><input onclick="inputdayfocus(0)" id="dayopeninput" class="dayinput inputt" type="date" readonly></div>
        <div style="padding: 5px 5px;"><input onclick="inputdayfocus(1)" id="daycloseinput" class="dayinput inputt" type="date" readonly></div>
    </div>
</div>

<script>
    let startDate = "2026-05-04";
    let endDate = "2026-05-07";
    let monthYearInspector = "2026";
    let YearInspector = "2020";
    let diasConRegistro = {};

    let selectdaymode = 0;

    const hoy = new Date();

    let vyear = hoy.getFullYear();       // Ejemplo: 2026
    let vmonth = hoy.getMonth();      // Ejemplo: 5 (Mayo)

    const vrmonth = (vmonth === 11) ? 1 : vmonth + 1;
    const vryear = (vmonth === 11) ? vyear + 1 : vyear;

    function generarCalendario() {
    const contenedor = document.getElementById('calendario-dias');
    contenedor.innerHTML = ''; // Limpiar calendario

    const primerDia = new Date(vyear, vmonth, 1).getDay(); // 0 (Dom) a 6 (Sab)
    const totalDias = new Date(vryear, vrmonth, 0).getDate();

    const vmpmonth = (vmonth === 0) ? 11 : vmonth - 1 ;
    const vmpyear = (vmonth === 0) ? vyear - 1 : vyear;

    const MPprimerDia = new Date(vmpyear, vmpmonth, 1).getDay(); // 0 (Dom) a 6 (Sab)
    const MPtotalDias = new Date(vyear, vmonth, 0).getDate();


    // Ajuste para que empiece en Lunes (L=0, M=1... D=6)
    // El getDay de JS es (D=0, L=1...). Transformamos:
    let shift = primerDia === 0 ? 6 : primerDia - 1;

    // 1. Espacios en blanco para el inicio de mes
    for (let i = 0; i < shift; i++) {
        const vacio = document.createElement('div');
        const dia = MPtotalDias-(shift-i-1); 
        vacio.innerHTML = `<span">${dia}</span>`;
        vacio.classList.add('dia');
        vacio.classList.add('apagado');
        const fechaString = `${vmpyear}-${(vmpmonth + 1).toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;
        vacio.onclick = () => {vmonth = vmpmonth;vyear = vmpyear;generarCalendario();selectday(fechaString);};
        contenedor.appendChild(vacio);
    }

    var calculo = 42-(shift+totalDias);

    var infoMonth = "";

    switch (vmonth) {
        case 0: infoMonth = "ENERO";break;
        case 1: infoMonth = "FEBRERO";break;
        case 2: infoMonth = "MARZO";break;
        case 3: infoMonth = "ABRIL";break;
        case 4: infoMonth = "MAYO";break;
        case 5: infoMonth = "JUNIO";break;
        case 6: infoMonth = "JULIO";break;
        case 7: infoMonth = "AGOSTO";break;
        case 8: infoMonth = "SEPTIEMBRE";break;
        case 9: infoMonth = "OCTUBRE";break;
        case 10: infoMonth = "NOVIEMBRE";break;
        case 11: infoMonth = "DICIEMBRE";break;
    }
    document.getElementById("infoMONTH").textContent = infoMonth;    
    document.getElementById("infoYEAR").textContent = vyear;    

    const RegistryDays = obtenerDiasPorMesYAnio(vyear, vmonth + 1);
        
    console.log("RegistryDays",RegistryDays)
    // 2. Crear los días
    for (let dia = 1; dia <= totalDias; dia++) {
        const elDia = document.createElement('div');
        elDia.classList.add('dia');
        
        // Formatear fecha actual para comparar
        const fechaString = `${vyear}-${(vmonth + 1).toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;

        // ¿Es hoy? (Círculo azul)
        if (dia === hoy.getDate() && vmonth === hoy.getMonth() && vyear === hoy.getFullYear()) {
            elDia.classList.add('activo');
        }

        if (fechaString == startDate){
            elDia.classList.add('startdate'); 
        }

        if (fechaString == endDate){
            elDia.classList.add('enddate'); 
        }

        // ¿Tiene registro? (Punto verde)
        if (RegistryDays.includes(dia.toString().padStart(2, '0'))) {
            elDia.classList.add('tiene-registro');
        }

        elDia.innerHTML = `<span>${dia}</span>`;
        
        // Evento al hacer click para filtrar
        elDia.onclick = () => selectday(fechaString);

        contenedor.appendChild(elDia);
    }

    for (let i = 0; i < calculo; i++) {
        const vacio = document.createElement('div');
        const _dia = i+1; 
        vacio.innerHTML = `<span">${_dia}</span>`;
        vacio.classList.add('dia');
        vacio.classList.add('apagado');
        const fechaString = `${vryear}-${(vrmonth + 1).toString().padStart(2, '0')}-${_dia.toString().padStart(2, '0')}`;
        vacio.onclick = () => {vmonth = vrmonth;vyear = vryear;generarCalendario();selectday(fechaString);};

        contenedor.appendChild(vacio);
    }
}

// Ejemplo de uso:
// Mes 4 es Mayo (empiezan en 0), año 2026.
// Le pasamos una lista de fechas que tienen asistencia.
generarCalendario();

function filtrarPorFecha(fecha) {
    console.log("Filtrando registros para la fecha:", fecha);
    // Aquí llamarías a tu función de PHP para traer la asistencia de ese día
}

function changemonth(_Dir){
const monthChoiseDiv = document.getElementById("monthChoiseDiv");
const dayChoiseDiv = document.getElementById("dayChoiseDiv");
const yearChoiseDiv = document.getElementById("yearChoiseDiv");

if(!dayChoiseDiv.classList.contains("oculto")){
    if(_Dir == 0){
        vmonth--;
        if(vmonth <= -1){
            vmonth = 12+vmonth;
            vyear--;
            }
        }else{
        vmonth++;
        if(vmonth >= 12){
            vmonth = vmonth-12
            vyear++;
            }
        }

    generarCalendario();
    }
if(!monthChoiseDiv.classList.contains("oculto")){

    if(_Dir == 0){  
        monthYearInspector--;
        }else{
        monthYearInspector++;
        }

    refreshMonthDiv();

    }
if(!yearChoiseDiv.classList.contains("oculto")){

    if(_Dir == 0){  
        YearInspector = YearInspector-10;
        }else{
        YearInspector = YearInspector+10;
        }

    refreshYearDiv();

    }

}

const input1 = document.getElementById("dayopeninput");
const input2 = document.getElementById("daycloseinput");

function selectday(_nmb){
input1.classList.remove("activo");
input2.classList.remove("activo");

if(selectdaymode == 0){
    input1.value = _nmb;    
    selectdaymode = 1;    
    input2.classList.add("activo");  
    }else{
    input2.value = _nmb;   
    selectdaymode = 0;
    input1.classList.add("activo");  
    }

if(input1.value > input2.value){

        var temp = input2.value;
        input2.value = input1.value;
        input1.value = temp;

    }



startDate = input1.value; 
endDate = input2.value;
cargarDatosAsis();
generarCalendario();
}

function inputdayfocus(_nmb){
const input1 = document.getElementById("dayopeninput");
const input2 = document.getElementById("daycloseinput");

input1.classList.remove("activo");
input2.classList.remove("activo");

if(_nmb == 0){
    selectdaymode = 0;    
    input1.classList.add("activo");     
    }else{
    selectdaymode = 1;    
    input2.classList.add("activo");    
    }

}

function obtenerDiasPorMesYAnio(anio, mes) {
    // Convertimos los parámetros a string y nos aseguramos de que el mes tenga dos dígitos (ej: "05")
    const anioStr = String(anio);
    const mesStr = String(mes).padStart(2, '0');

    if (diasConRegistro[anioStr] && diasConRegistro[anioStr][mesStr]) {
        return diasConRegistro[anioStr][mesStr];
    }
    
    return []; // Retorna vacío si no hay registros para esa fecha
}

function obtenerMesesPorAnio(anio) {
    const anioStr = String(anio);

    if (diasConRegistro[anioStr]) {
        // Object.keys nos devuelve las propiedades del objeto (en este caso, los meses "05", "04", etc.)
        return Object.keys(diasConRegistro[anioStr]);
    }

    return []; // Retorna vacío si el año no tiene registros
}

function obtenerAniosConRegistros() {
    return Object.keys(diasConRegistro).sort((a, b) => b - a);
}

const MonthDiv = document.getElementById("calendario-meses");

function refreshMonthDiv(){
        
        const MonthWithRegistry = obtenerMesesPorAnio(monthYearInspector);
        MonthDiv.textContent = "";

        for (let index = 0; index < 12; index++) {
            const div = document.createElement("div");

            switch (index) {
                case 0: div.textContent = "ENERO";break;
                case 1: div.textContent = "FEBRERO";break;
                case 2: div.textContent = "MARZO";break;
                case 3: div.textContent = "ABRIL";break;
                case 4: div.textContent = "MAYO";break;
                case 5: div.textContent = "JUNIO";break;
                case 6: div.textContent = "JULIO";break;
                case 7: div.textContent = "AGOSTO";break;
                case 8: div.textContent = "SEPTIEMBRE";break;
                case 9: div.textContent = "OCTUBRE";break;
                case 10: div.textContent = "NOVIEMBRE";break;
                case 11: div.textContent = "DICIEMBRE";break;
                }
            
            div.classList.add('month-div');

            div.onclick = () => {vyear = monthYearInspector;vmonth = index;ChoiseDay()};

            if(MonthWithRegistry.includes((index+1).toString().padStart(2, '0'))){
                div.classList.add('tiene-registro');
            }

            if(vyear == monthYearInspector && vmonth == index){
                div.classList.add('activo'); 
            }

            MonthDiv.appendChild(div);
            
        }
        

        const year_show = document.getElementById("year-show");
        year_show.textContent = monthYearInspector;
    }  

const YearDiv = document.getElementById("calendario-years");

function refreshYearDiv(){
        
        const YearsWithRegistry = obtenerAniosConRegistros();
        YearDiv.textContent = "";

        for (let index = 0; index < 10; index++) {
            const div = document.createElement("div");
            const myyear = YearInspector+index;

            div.textContent = myyear;
            div.classList.add('month-div');

            div.onclick = () => {monthYearInspector = myyear;ChoiseMonth()};

            if(YearsWithRegistry.includes(myyear.toString())){
                div.classList.add('tiene-registro');
            }

            if(vyear == myyear){
                div.classList.add('activo'); 
            }

            YearDiv.appendChild(div);        
        }
        

        const year_show = document.getElementById("decade-show");
        year_show.textContent = YearInspector+"-"+(parseInt(YearInspector)+9);
    }  

function ChoiseMonth(){

const monthChoiseDiv = document.getElementById("monthChoiseDiv");
const dayChoiseDiv = document.getElementById("dayChoiseDiv");
const yearChoiseDiv = document.getElementById("yearChoiseDiv");

monthChoiseDiv.classList.remove("oculto");

if(!dayChoiseDiv.classList.contains("oculto")){
    dayChoiseDiv.classList.add("oculto");
    }
if(!yearChoiseDiv.classList.contains("oculto")){
    yearChoiseDiv.classList.add("oculto");
    }

refreshMonthDiv();

}

function ChoiseDay(){

const monthChoiseDiv = document.getElementById("monthChoiseDiv");
const dayChoiseDiv = document.getElementById("dayChoiseDiv");
const yearChoiseDiv = document.getElementById("yearChoiseDiv");

dayChoiseDiv.classList.remove("oculto");

if(!monthChoiseDiv.classList.contains("oculto")){
    monthChoiseDiv.classList.add("oculto");
    }
if(!yearChoiseDiv.classList.contains("oculto")){
    yearChoiseDiv.classList.add("oculto");
    }

generarCalendario();

}

function ChoiseYear(){

const monthChoiseDiv = document.getElementById("monthChoiseDiv");
const dayChoiseDiv = document.getElementById("dayChoiseDiv");
const yearChoiseDiv = document.getElementById("yearChoiseDiv");

yearChoiseDiv.classList.remove("oculto");

if(!monthChoiseDiv.classList.contains("oculto")){
    monthChoiseDiv.classList.add("oculto");
    }
if(!dayChoiseDiv.classList.contains("oculto")){
    dayChoiseDiv.classList.add("oculto");
    }

refreshYearDiv();
}

</script>