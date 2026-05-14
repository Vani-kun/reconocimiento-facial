<style>
    .calendario-container {
        width: 300px;
        background: var(--newpanel);
        border-radius: 10px;
        padding: 0px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        font-family: sans-serif;
        overflow: hidden;
        margin-bottom:10px;
        color:white;
    }
    #calendario-container{
        opacity: 1;
        transition: opacity 0.5s, transform 0.8s;
        }
    #calendario-container.hidden{
        opacity: 0;
        pointer-events:none;
        transform: translateY(-27%);
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
        color: var(--newletras);
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
    .dia.today::before {
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
    .dayinput.today{
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
    .month-div.today {
        background: var(--newsecu);
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
    .year-div {
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        font-size: 0.9em;
    }
    .year-div.today {
        background: var(--newsecu);
    }
    .year-div:hover{
        cursor:pointer;
        background: #00000055;
        }
    .year-div.tiene-registro::after {
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

        <div class="calendaroption-div" onclick="MyCalendar.move(0)" >
            <div class="calendaroption-btn"><i class="fa-solid fa-angle-left"></i></div>
        </div>

        <div class="calendaroption-div" onclick="MyCalendar.move(1)" >
            <div class="calendaroption-btn"><i class="fa-solid fa-angle-right"></i></div>
        </div>

    </div>

    <div id="calendario-container">
        
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
    this.selectdaymode = 0;

    class Schedule{
        constructor(_Div) {
            this.hoy = new Date();

            var anio = this.hoy.getFullYear();   
            var mes  = this.hoy.getMonth() + 1;  
            var dia  = this.hoy.getDate();        

            this.startDate = `${anio}-${mes}-${dia}`;
            this.endDate = `${anio}-${mes}-${dia}`;
            this.diasConRegistro = {};
            
            this.vyear = anio;
            this.vmonth = mes-1;

            const proximoMes = new Date(this.vyear, this.vmonth + 1, 1);
            this.vrmonth = proximoMes.getMonth();
            this.vryear = proximoMes.getFullYear();

            this.crearEstructuraDOM();
            this.mapearElementos();
            this.asignarEventos();

            this.generarCalendario();
            this.scheduleDaysFunction = [];

            _Div.appendChild(this.mySchedule);
            }

        setDefault(){
            this.hoy = new Date();

            var anio = this.hoy.getFullYear();   
            var mes  = this.hoy.getMonth() + 1;  
            var dia  = this.hoy.getDate();        

            this.startDate = `${anio}-${mes}-${dia}`;
            this.endDate = `${anio}-${mes}-${dia}`;
            this.diasConRegistro = {};

            this.vyear = anio;
            this.vmonth = mes-1;

            const proximoMes = new Date(this.vyear, this.vmonth + 1, 1);
            this.vrmonth = proximoMes.getMonth();
            this.vryear = proximoMes.getFullYear();

            this.ChoiseDay();
            }

        crearEstructuraDOM() {
            this.mySchedule = document.createElement("div");
            this.mySchedule.innerHTML = `
            <div class="calendario-container">
                <div id="dayChoiseDiv">
                    <div class="info-mes">
                        <div id="infoMONTH" class="infoCalendarBtn">DICIEMBRE</div>
                        <div id="infoYEAR" class="infoCalendarBtn">2026</div>
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
                        <strong id="year-show" class="infoCalendarBtn">2026</strong>
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
            </div>`;
            }

    mapearElementos() {
        // Corregido: usando # para IDs
        this.DayChoise      = this.mySchedule.querySelector("#dayChoiseDiv");
        this.MonthChoise    = this.mySchedule.querySelector("#monthChoiseDiv");
        this.YearChoise     = this.mySchedule.querySelector("#yearChoiseDiv");
        
        this.infoMonth  = this.mySchedule.querySelector("#infoMONTH");
        this.infoYear   = this.mySchedule.querySelector("#infoYEAR");
        this.infoYear2  = this.mySchedule.querySelector("#year-show");
        this.infoDecade = this.mySchedule.querySelector("#decade-show");

        this.DaysDiv    = this.mySchedule.querySelector("#calendario-dias");
        this.MonthDiv   = this.mySchedule.querySelector("#calendario-meses");
        this.YearDiv    = this.mySchedule.querySelector("#calendario-years");
        }

    asignarEventos() {
        this.infoMonth.addEventListener("click", () => {
            this.monthYearInspector = this.vyear;
            this.ChoiseMonth();
            });

        this.infoYear.addEventListener("click", () => {
            this.YearInspector = Math.floor(parseInt(this.vyear) / 10) * 10;
            this.ChoiseYear();
            });

        this.infoYear2.addEventListener("click", () => {
             this.YearInspector = Math.floor(parseInt(this.monthYearInspector) / 10) * 10;
             this.ChoiseYear();
            });
        }

        generarCalendario() {
        const contenedor = this.DaysDiv;
        contenedor.innerHTML = ''; // Limpiar calendario

        const primerDia = new Date(this.vyear, this.vmonth, 1).getDay(); // 0 (Dom) a 6 (Sab)
        const totalDias = new Date(this.vryear, this.vrmonth, 0).getDate();

        const vmpmonth = (this.vmonth === 0) ? 11 : this.vmonth - 1 ;
        const vmpyear = (this.vmonth === 0) ? this.vyear - 1 : this.vyear;

        const MPprimerDia = new Date(vmpyear, vmpmonth, 1).getDay(); // 0 (Dom) a 6 (Sab)
        const MPtotalDias = new Date(this.vyear, this.vmonth, 0).getDate();

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
            vacio.onclick = () => {
                this.vmonth = vmpmonth;
                this.vyear = vmpyear;
                this.generarCalendario();
                this.scheduleDaysFunction.forEach(element => {
                    element({date:fechaString,item:this});
                    });
                };
            contenedor.appendChild(vacio);
            }

        var calculo = 42-(shift+totalDias);

        

        const _infoMonth = new Date(this.vyear, this.vmonth).toLocaleString('es-ES', { month: 'long' }).toUpperCase();

        this.infoMonth.textContent = _infoMonth;    
        this.infoYear.textContent = this.vyear;    

        const RegistryDays = this.obtenerDiasPorMesYAnio(this.vyear, this.vmonth + 1);
        
        console.log("RegistryDays",RegistryDays)
        // 2. Crear los días
        for (let dia = 1; dia <= totalDias; dia++) {
            const elDia = document.createElement('div');
            elDia.classList.add('dia');
        
            // Formatear fecha actual para comparar
            const fechaString = `${this.vyear}-${(this.vmonth + 1).toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;

            // ¿Es hoy? (Círculo azul)
            if (dia === this.hoy.getDate() && this.vmonth === this.hoy.getMonth() && this.vyear === this.hoy.getFullYear()) {
                elDia.classList.add('today');
                }

            if (fechaString == this.startDate){
                elDia.classList.add('startdate'); 
                }

            if (fechaString == this.endDate){
                elDia.classList.add('enddate'); 
                }

            // ¿Tiene registro? (Punto verde)
            if (RegistryDays.includes(dia.toString().padStart(2, '0'))) {
                elDia.classList.add('tiene-registro');
                }

            elDia.innerHTML = `<span>${dia}</span>`;
        
            // Evento al hacer click para filtrar
            elDia.onclick = () => {
                this.scheduleDaysFunction.forEach(element => {
                element({date:fechaString,item:this});
                });
            };

            contenedor.appendChild(elDia);
        }

        for (let i = 0; i < calculo; i++) {
            const vacio = document.createElement('div');
            const _dia = i+1; 
            vacio.innerHTML = `<span">${_dia}</span>`;
            vacio.classList.add('dia');
            vacio.classList.add('apagado');
            const fechaString = `${this.vryear}-${(this.vrmonth + 1).toString().padStart(2, '0')}-${_dia.toString().padStart(2, '0')}`;
            vacio.onclick = () => {this.vmonth = this.vrmonth;this.vyear = this.vryear;this.generarCalendario();
                this.scheduleDaysFunction.forEach(element => {

                element({date:fechaString,item:this});

                });
            };
            contenedor.appendChild(vacio);
        }
    }

    addFunction(e){
        this.scheduleDaysFunction.push(e);
        }

    CleanFunctions(){
        this.scheduleDaysFunction = [];
    }

    move(_Dir){
              
    const monthChoiseDiv = this.MonthChoise;
    const dayChoiseDiv = this.DayChoise;
    const yearChoiseDiv = this.YearChoise;

    if(!dayChoiseDiv.classList.contains("oculto")){
        if(_Dir == 0){
            this.vmonth--;
            if(this.vmonth <= -1){
                this.vmonth = 12+this.vmonth;
                this.vyear--;
                }
            }else{
            this.vmonth++;
            if(this.vmonth >= 12){
                this.vmonth = this.vmonth-12
                this.vyear++;
                }
            }

        this.generarCalendario();
        }
    if(!monthChoiseDiv.classList.contains("oculto")){

        if(_Dir == 0){  
            this.monthYearInspector--;
            }else{
            this.monthYearInspector++;
            }

        this.refreshMonthDiv();

        }
    if(!yearChoiseDiv.classList.contains("oculto")){

        if(_Dir == 0){  
            this.YearInspector = this.YearInspector-10;
            }else{
            this.YearInspector = this.YearInspector+10;
            }

        this.refreshYearDiv();

        }

    }

    obtenerDiasPorMesYAnio(anio, mes) {
        // Convertimos los parámetros a string y nos aseguramos de que el mes tenga dos dígitos (ej: "05")
        const anioStr = String(anio);
        const mesStr = String(mes).padStart(2, '0');

        if (this.diasConRegistro[anioStr] && this.diasConRegistro[anioStr][mesStr]) {
            return this.diasConRegistro[anioStr][mesStr];
            }
    
        return []; // Retorna vacío si no hay registros para esa fecha
    }

    obtenerMesesPorAnio(anio) {
        const anioStr = String(anio);

        if (this.diasConRegistro[anioStr]) {
            // Object.keys nos devuelve las propiedades del objeto (en este caso, los meses "05", "04", etc.)
            return Object.keys(this.diasConRegistro[anioStr]);
            }

        return []; // Retorna vacío si el año no tiene registros
    }

    obtenerAniosConRegistros() {
        return Object.keys(this.diasConRegistro).sort((a, b) => b - a);
        }

    refreshMonthDiv(){
        const MonthWithRegistry = this.obtenerMesesPorAnio(this.monthYearInspector);
        this.MonthDiv.textContent = "";

        for (let index = 0; index < 12; index++) {
            const div = document.createElement("div");

            const _infoMonth = new Date(this.vyear, index).toLocaleString('es-ES', { month: 'long' }).toUpperCase();
            
            var anio = this.hoy.getFullYear();   
            var mes  = this.hoy.getMonth() + 1;  
            var dia  = this.hoy.getDate(); 

            div.textContent = _infoMonth;    
            
            div.classList.add('month-div');

            div.onclick = () => {this.vyear = this.monthYearInspector;this.vmonth = index;this.ChoiseDay()};

            if(MonthWithRegistry.includes((index+1).toString().padStart(2, '0'))){
                div.classList.add('tiene-registro');
            }

            if(this.monthYearInspector == this.hoy.getFullYear() && this.vmonth == index){
                div.classList.add('today'); 
            }

            this.MonthDiv.appendChild(div);
            
        }
        
        const year_show = this.infoYear2;
        year_show.textContent = this.monthYearInspector;
    }  

    refreshYearDiv(){
        
        const YearsWithRegistry = this.obtenerAniosConRegistros();
        this.YearDiv.textContent = "";

        for (let index = 0; index < 10; index++) {
            const div = document.createElement("div");
            const myyear = this.YearInspector+index;

            div.textContent = myyear;
            div.classList.add('year-div');

            div.onclick = () => {this.monthYearInspector = myyear;this.ChoiseMonth()};

            if(YearsWithRegistry.includes(myyear.toString())){
                div.classList.add('tiene-registro');
            }

            if(this.hoy.getFullYear() == myyear){
                div.classList.add('today'); 
            }

            this.YearDiv.appendChild(div);        
        }
        

        const year_show = this.infoDecade;
        year_show.textContent = this.YearInspector+"-"+(parseInt(this.YearInspector)+9);
    }  

    ChoiseMonth(){

    const monthChoiseDiv    = this.MonthChoise;
    const dayChoiseDiv      = this.DayChoise;
    const yearChoiseDiv     = this.YearChoise;

    monthChoiseDiv.classList.remove("oculto");

    if(!dayChoiseDiv.classList.contains("oculto")){
        dayChoiseDiv.classList.add("oculto");
        }
    if(!yearChoiseDiv.classList.contains("oculto")){
        yearChoiseDiv.classList.add("oculto");
        }

    this.refreshMonthDiv();
    }

    ChoiseDay(){

    const monthChoiseDiv    = this.MonthChoise;
    const dayChoiseDiv      = this.DayChoise;
    const yearChoiseDiv     = this.YearChoise;

    dayChoiseDiv.classList.remove("oculto");

    if(!monthChoiseDiv.classList.contains("oculto")){
        monthChoiseDiv.classList.add("oculto");
        }
    if(!yearChoiseDiv.classList.contains("oculto")){
        yearChoiseDiv.classList.add("oculto");
        }

    this.generarCalendario();
    }

    ChoiseYear(){

    const monthChoiseDiv    = this.MonthChoise;
    const dayChoiseDiv      = this.DayChoise;
    const yearChoiseDiv     = this.YearChoise;

    yearChoiseDiv.classList.remove("oculto");

    if(!monthChoiseDiv.classList.contains("oculto")){
        monthChoiseDiv.classList.add("oculto");
        }
    if(!dayChoiseDiv.classList.contains("oculto")){
        dayChoiseDiv.classList.add("oculto");
        }

    this.refreshYearDiv();
    }

    DOM(){
        return this.mySchedule;
    }
}


const MyCalendar = new Schedule(document.getElementById("calendario-container"));

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

function selectday(e){
const _date = e.date;

const input1 = document.getElementById("dayopeninput");
const input2 = document.getElementById("daycloseinput");

input1.classList.remove("activo");
input2.classList.remove("activo");

if(selectdaymode == 0){
    input1.value = _date;    
    selectdaymode = 1;    
    input2.classList.add("activo");  
    }else{
    input2.value = _date;   
    selectdaymode = 0;
    input1.classList.add("activo");  
    }


if(input1.value > input2.value){

        var temp = input2.value;
        input2.value = input1.value;
        input1.value = temp;

        if(selectdaymode == 0){selectdaymode = 1;}else{selectdaymode = 0;}

    }

e.item.startDate = input1.value; 
e.item.endDate = input2.value;

cargarDatosAsis();
e.item.generarCalendario();
}
MyCalendar.addFunction((e) => selectday(e));

</script>