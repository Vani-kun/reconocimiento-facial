<style>

.regasis{
    position:absolute;  
    z-index:2000;
    opacity: 1;
    }

.regasis.fd{
    left: 0;
    top: 0;
    width:29.0%;
    height:100%;
    display:grid;
    grid-template-rows: 30% 70%; 
    transition: left 0.5s, opacity 0.5s;
    }
.hidden.regasis.fd{
    left: -29%;
    opacity: 0;
    }

.regasis.sd{
    left: 29%;   
    top: 0;
    width:37.67%;
    height:50%;
    transition: top 0.5s, opacity 0.5s;
    display:flex;
    }
.hidden.regasis.sd{
    top: -50%;
    opacity: 0;
    }


.regasis.td{
    left: 29%;
    top: 50%;
    width:70.9%;
    height:50%;
    transition: top 0.5s, opacity 0.5s;
    display:flex;
    }
.hidden.regasis.td{
    top: 150%;
    opacity: 0;
    }

.regasis.fod{
    left: 66.67%;
    top: 0;
    width:33.33%;
    height:50%;
    transition: left 0.5s, top 0.5s, opacity 0.5s;
    display:flex;
    }
.hidden.regasis.fod{
    left: 133.23%;
    top: -50%;
    opacity: 0;
    }  

.power-trigger.regasis{
    position:absolute;
    opacity: 1;
    top: 2%;
    left: 0;
    width: 4vw;
    height: 4vw;
    transition: top 0.5s, opacity 0.5s, transform 0.5s;
    }
.power-trigger.hidden.regasis{
    opacity: 0;
    top: -50%;
    transform: rotateZ(360deg);
    }

.regasis.main{
    height:100%;
    width:100%;
    top: 0;
    left: 0;
    transition: opacity 0.5s;
    background-color: #00000088;
    backdrop-filter: blur(8px);
    }
.hidden.regasis.main{
    opacity:0;
    pointer-events: none;
    }

.AsisTarjeta{
    display:grid;
    grid-template-columns: 10% 50% 40%;
    height: 10%;
    width:100%;
    text-align: left;
    padding: 2.5px 10px;
    margin-top: 10px;
    background-color: #00000099;
    border-radius: 0.5vh;
    }

.status0{
    color: red;text-shadow: 0 0 10px red;
    }
.status1{
    color: #ffae00;text-shadow: 0 0 10px #ffae00;
    }
.status2{
    color: #00ff22;text-shadow: 0 0 10px #00ff22;
    }
.statusbtnon{
    font-size:1.5rem;
    transition: font-size 0.2s;
    }
.sdisable{
    font-size:1rem;
    text-shadow: 0 0 0 white;
    }
.statusbtncontainer{
    display:flex;
    align-items:center;
    justify-content:center;
    text-align: center;
}
.statusbtncontainer:hover{

    .statusbtnon{
    font-size:2rem;
    }

    cursor:pointer;
    }

.AsisTableHeader{
    background-color: #000000;
    color: white;
    font-weight: bold;
    }


</style>

<div id="AsisMainDiv" class="hidden regasis main">

    <div id="AsisFirstDiv" class="hidden regasis fd">
        <div style="width:100%;height:100%;">

            <div class="AsisFilterMenu" style="width: 50%; right: 0; position:absolute; height: 8%; top:2%; display:grid;grid-template-columns: 1fr 1fr 1fr">
                <div id="btnTogglestatus0" onclick="togglestatus(0)" class="statusbtncontainer" style="align-content:center;justify-items:center;">
                    <strong id="strongstatus0" class="status0 statusbtnon">●</strong>
                </div>
                <div id="btnTogglestatus1" onclick="togglestatus(1)" class="statusbtncontainer" style="align-content:center;justify-items:center;">
                    <strong id="strongstatus1" class="status1 statusbtnon">●</strong>
                </div>
                <div id="btnTogglestatus2" onclick="togglestatus(2)" class="statusbtncontainer" style="align-content:center;justify-items:center;">
                    <strong id="strongstatus2" class="status2 statusbtnon">●</strong>
                </div>
            </div>

        </div>
        <div style="width:100%;height:100%;padding:5% 5%;display:grid;grid-template-rows: 7% 93%;">
            <div style="background-color:black;border-top-left-radius:1vw; padding: 2.5px 10px;text-align: left;border-top-right-radius:1vw;display:grid;grid-template-columns: 10% 50% 40%;">

                <div class="AsisTableHeader" ><p>S</p></div>
                <div class="AsisTableHeader" ><p>NOMBRE</p></div>
                <div class="AsisTableHeader" ><p>FECHA</p></div>

            </div>
            <div id="AsisScrollMenu" style="background-color:blue;overflow-y:scroll;">

            </div>
        </div>
    </div>

    <div id="AsisSecondDiv" class="hidden regasis sd">
        <div style="width:100%;height:100%;">

        </div>
    </div>

    <div id="AsisThirdDiv" class="hidden regasis td">
        <div style="width:100%;height:100%;">

        </div>
    </div>

    <div id="AsisFourDiv" class="hidden regasis fod">
        <div style="width:100%;height:100%;">

        </div>
    </div>

    <div id="AsisOnBtn" class="power-trigger hidden regasis" onclick="showAsisReg(0)" >
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--newprima)" stroke-width="2.5">
            <path d="M18.36 6.64a9 9 0 1 1-12.73 0M12 2v10"/></svg>
    </div>

</div>

<script>


const AsisMenu = document.getElementById("AsisScrollMenu");
let startDate = "2026-05-04";
let endDate = "2026-05-06";
let todosLosRegistros = [];
let status0 = true;
let status1 = true;
let status2 = true;

function togglestatus(_Nmb){

if(_Nmb == 0){
    status0 = !status0;
    document.getElementById("strongstatus0").classList.toggle("sdisable");
    }else if(_Nmb == 1){
    status1 = !status1;
    document.getElementById("strongstatus1").classList.toggle("sdisable");
    }else if(_Nmb == 2){
    status2 = !status2;
    document.getElementById("strongstatus2").classList.toggle("sdisable");
    }

recargarListaAsis();

}

function crearAsisTask(status,id,date){

    
    const MyProfesor = datosProfesores.find(u => u.id == id);
    var name = "undefined";

    console.log(MyProfesor);
    if(MyProfesor){
    name = MyProfesor.nombre;
    }

    const maindiv = document.createElement("div");
    maindiv.classList.add("AsisTarjeta");
    const statusdiv = document.createElement("div");
    const namediv = document.createElement("div");
    const datediv = document.createElement("div");

    const strong = document.createElement("strong");
    strong.textContent = name;
    namediv.appendChild(strong);

    datediv.textContent = date;

    statusdiv.textContent = "●";

    statusdiv.classList.add("status"+status);  
    

    maindiv.appendChild(statusdiv);
    maindiv.appendChild(namediv);
    maindiv.appendChild(datediv);

    return maindiv;
    }
    
async function cargarDatosAsis() {
    console.log("ACAAA")
        const _Fecha = startDate;
        const _FechaEnd = endDate;
        try {
            const res  = await fetch('php/asistencia/get_asistencia_dia.php', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({sdia: _Fecha, edia: _FechaEnd}) 
                });

            const json = await res.json();
            console.log(json)
            if (json.success) {
                todosLosRegistros = json.data;
                recargarListaAsis();
                }

            } catch (err) {
                console.error("Error al cargar datos:", err);
                }
        }

    function recargarListaAsis(){
    AsisMenu.textContent = "";

        todosLosRegistros.filter((e) => {

            if(e.estado == 0 && status0){return true;}
            else if(e.estado == 1 && status1){return true;}
            else if(e.estado == 2 && status2){return true;}
        
        }).forEach(element => {
        
            AsisMenu.appendChild(crearAsisTask(element.estado,element.id,element.fecha));

            });

        }
 window.addEventListener('load', async () => {})
</script>