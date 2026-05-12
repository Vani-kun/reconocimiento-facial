<style>
    :root { --p: #00d4ff; --bg: #0a0f14; --h: 120px; --r: 160px; }

    /* NAV ACTUALIZADO: Blanco a Gris con Sombra */
    nav { 
        height: 70px; 
        padding: 0 40px; 
        /* Degradado de blanco puro a un gris suave hacia abajo */
        background: var(--newbarra); 
        color:var(--newletras);/* Color oscuro para contraste */
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
        
        font-size: 1.8rem; 
        background: none; 
        color: var(--newletras);
        border: none; 
        cursor: pointer; 
        transition: .3s; 
        filter: drop-shadow(0 2px 2px var(--newfondo));
    }
    .nav-btn:hover { 
        color: var(--newprima); /* Cambia al azul en hover */
        transform: rotate(90deg); 
    }
    .user-btn:hover { 
        color: var(--newprima); /* Cambia al azul en hover */
        transform: rotate(360deg); 
    }
    /* MENU */
    #hexOverlay { 
        background: linear-gradient(180deg, #0F495E00 0%, var(--newnucle) 100%); 
        position: fixed; inset: 0; backdrop-filter: blur(8px); display: none; 
        justify-content: center; align-items: center; z-index: 2000; 
    }
    .menu-wrapper { position: relative; width: var(--h); height: 135px; }
    .hexagon { 
        color: white;
        position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: center; align-items: center; 
        background: #0a141e; clip-path: polygon(50% 0, 100% 25%, 100% 75%, 50% 100%, 0 75%, 0 25%);
        transition: .5s cubic-bezier(.68,-.55,.26,1.55); border: 1px solid var(--newnucle); opacity: 0; scale: 0; cursor: pointer;
    }
    .hexagon i { font-size: 1.8rem; color: var(--newnucle); }/*#904192;*/
    .core { opacity: 1; scale: 1.1; z-index: 10; background: radial-gradient(var(--newnucle), #000); }
    
    /* POSICIONES (Simplificadas) */
    .expanded .hexagon { opacity: 1; scale: 1; }
    .expanded .p1 { transform: translate(0, calc(-1 * var(--r))); }
    .expanded .p2 { transform: translate(calc(-1 * var(--r)), 0); }
    .expanded .p3 { transform: translate(var(--r), 0); }
    .expanded .p4 { transform: translate(calc(var(--r) * -.7), var(--r)); }
    .expanded .p5 { transform: translate(calc(var(--r) * .7), var(--r)); }
    .expanded .p6 { transform: translate(0, calc(var(--r))); }
    .hexagon:hover { background: #926EA7; color: #FFF; }
    .hexagon:hover i { color: #FFF; }

    /*Menu de usuario*/
    .user-menu-wrapper{
        position: fixed; z-index: 2000; width: 100%; height: 100%; top: 0; left: 0;
        background-color: rgb( 155, 155, 155, 0.12); backdrop-filter: blur(8px);
        align-items:center;
        justify-content:center;
        display:flex;
        }
    .user-form-menu{
        position: relative; z-index: 2200; width: 50%; height: auto;
        background: var(--newpoligono);
        border-radius: 2vw;
        padding: 20px 20px;
        color:var(--newletras);
        }
        .marco{text-align: left; padding: 10px; border-radius:2vw; border-color:var(--newprima);}
        #user-formlegend{
            color:var(--newprima);
        }
        #usersubmitbutton{
            width:100%;
            transform: translateX(-14px);
        }
.sombralogo{
    filter:drop-shadow(0 0 5px var(--newprima))
}
</style>

<nav>
    <div class="nav-contenedor"></div>
    <img src="img/IUJO.gif" height="50" class="sombralogo">
    <button id="openUserBtn" class="nav-btn user-btn OnlyNoSecurityLevel SecurityHidden" onclick="openUserMenu(1)"><i class="fa-solid fa-circle-user"></i></button>
    <button id="openMenuBtn" class="nav-btn SecurityLevel1 SecurityHidden" onclick="toggle(1);MenuMove('main');"><i class="fa-solid fa-atom"></i></button>
</nav>

<div id="hexOverlay" onclick="toggle(0)">
    <div class="menu-wrapper" id="mw" onclick="event.stopPropagation()">
        <div class="menulink" dir="main">
            <div                class="SecurityLevel1 hexagon core"         onclick="toggle(0)"                 time-tooltip="1" data-tooltip="Cerrar el menu">                     <i class="fa-solid fa-power-off"></i>       SALIR       </div>
            <div id="ProfBtn"   class="SecurityLevel3 hexagon p1"           onclick="sowProfesores()"           time-tooltip="1" data-tooltip="Abrir la gestion de profesores">     <i class="fa-solid fa-user-tie"></i>        Prof        </div>
            <div id="RegBtn"    class="SecurityLevel1 hexagon p2"           onclick="showAsisReg(1)"            time-tooltip="1" data-tooltip="Abrir el control de reporte">        <i class="fa-solid fa-address-card"></i>    Reg         </div>
            <div id="HorBtn"    class="SecurityLevel2 hexagon p3"           onclick="MenuMove('horario')"       time-tooltip="1" data-tooltip="Moverse al menu de horarios">        <i class="fa-solid fa-calendar-day"></i>    Hor         </div>
            <div id="CtrlBtn"   class="SecurityLevel3 hexagon p4"           onclick="showControl()"             time-tooltip="1" data-tooltip="Abrir las opciones de el sistema">   <i class="fa-solid fa-gear"></i>            Ctrl        </div>
            <div id="LogOutBtn" class="SecurityLevel1 viewer hexagon p5"    onclick="login_out();toggle(0)"     time-tooltip="1" data-tooltip="Cerrar sesion">                      <i class="fa-solid fa-lock"></i>            Cerrar Ses  </div>
        </div>
        <div class="menulink" dir="horario">
            <div                class="SecurityLevel1 hexagon core" onclick="MenuMove('main')"  time-tooltip="1" data-tooltip="Volver al menu anterior">            <i class="fa-solid fa-arrow-left"></i>      REGRESAR    </div>
            <div id="HorBtn2"   class="SecurityLevel1 hexagon p3"   onclick="showHorarios(1)"   time-tooltip="1" data-tooltip="Ver los horarios">                   <i class="fa-solid fa-calendar-days"></i>   Hor         </div>
            <div id="SecBtn"    class="SecurityLevel3 hexagon p2"   onclick="showSecciones()"   time-tooltip="1" data-tooltip="Abrir la gestion de secciones">      <i class="fa-solid fa-address-book"></i>    Sec         </div>
        </div>
    </div>
</div>

<div id="securityOverlay" style="display:none;">
    <div class="user-menu-wrapper" id="mu" onmousedown="openUserMenu(0)">
        <div class="user-form-menu" onmousedown="event.stopPropagation()">
            <fieldset class="marco">
                <legend><h3 id="user-formlegend">Ingresar</h3></legend>
                <form id="UserLoginForm" style="justify-content:start;">
                    <label for="userinput">Usuario:</label>
                        <input class="inputt" type="text" id="userinput" name="userinput" require><br>
                    <label for="passinput">Contraseña:</label>
                        <input class="inputt" type="password" id="passinput" name="passinput" require><br>
                    <div id="LoginDiv">
                        <label for="keep-sesion">Mantener la sesion iniciada:</label>
                        <div style="width:100%;display:flex;justify-content:start;">
                            <input class="inputt" type="checkbox" id="keep-sesion" name="keep-sesion" style="width: 3vh;height: 3vh;">
                        </div>
                    </div>
                    <div id="RegisterDiv">
                        <label for="passverifyinput">Vuelve a ingresar la contraseña:</label><br>
                        <input type="password" id="passverifyinput" name="passverifyinput">
                    </div>
                    <button id="usersubmitbutton" class="btn btn-agregar" time-tooltip="1" data-tooltip="Ingresar">Enviar</button>
                </form>
            </fieldset>
        </div>
    </div>
</div>

<script src="js/loginfunctions.js" type="module"></script>

<script>
    Loginmode = 1;
    MenuDir = Array.from(document.querySelectorAll(".menulink"));

    function MenuMove(_Link){
    MenuDir.forEach(element => {
        if(element.getAttribute("dir") != _Link){
            if(!element.classList.contains("oculto")){
                element.classList.add("oculto");
                }
            }else{
            if(element.classList.contains("oculto")){
                element.classList.remove("oculto");
                }
            }
        });
    }

    MenuMove("main");

    const o = document.getElementById('hexOverlay'), w = document.getElementById('mw');
    const u = document.getElementById("securityOverlay"), mu = document.getElementById("mu");
    function toggle(s) {
        if(s) { o.style.display = 'flex'; setTimeout(() => w.classList.add('expanded'), 10); }
        else { w.classList.remove('expanded'); setTimeout(() => o.style.display = 'none', 400); }
    }

    function sowProfesores(){
        enpanelprofesor=true;
        showAsistencia(0);
        moveCamera("left");
        toggle(0);
        togglePanel();
        
    }
    function showHorarios(_nmb){
        if(_nmb){
            enpanelprofesor=true;
            showAsistencia(0);
            moveCamera("left");
            toggle(0);
            togglePanel();
            document.getElementById('toggle-panel').classList.add('ocultoboton');
            document.getElementById('schedule-toggle-panel').classList.remove('ocultoboton');
            document.getElementById("listado").classList.add("schedulepl");
            document.getElementById("BTNProfRegistry").classList.add("oculto");
            setTimeout(() => { 
                moveCamera("hide");
                toggleSchedulePanel(1);
            }, 500);   
            H_BarDefault();
        }else{
            enpanelprofesor=false;
            moveCamera("left");
            toggleSchedulePanel(0);
            document.getElementById('schedule-toggle-panel').classList.add('ocultoboton');
            setTimeout(() => { 
               togglePanel();   
               moveCamera("center");
               setTimeout(() => { 
                    document.getElementById("listado").classList.remove("schedulepl");
                    document.getElementById("BTNProfRegistry").classList.remove("oculto");
                    }, 500);   

            }, 500);
        }
    }
    function showControl(){
        enpanelprofesor=true;showAsistencia(0);
        moveCamera("hide");
        toggle(0);
        togglexxPanel();
    }
    function showSecciones(){
        enpanelprofesor=true;
        showAsistencia(0);
        toggle(0);
        moveCamera("hide");
        document.getElementById("seccion-wraper").classList.remove("hidden");
        document.getElementById("seccion-toggle-panel").classList.remove("oculto");
        S_BarDefault();
    }
    function showAsisReg(_Nmb){
        if(_Nmb){
            document.getElementById("AsisFirstDiv").classList.remove("hidden");
            document.getElementById("AsisSecondDiv").classList.remove("hidden");
            document.getElementById("AsisThirdDiv").classList.remove("hidden");
            document.getElementById("AsisFourDiv").classList.remove("hidden");
            document.getElementById("AsisOnBtn").classList.remove("hidden");
            document.getElementById("AsisMainDiv").classList.remove("hidden");
            moveCamera("hide");
            showAsistencia(0);
            toggle(0);
            enpanelprofesor=true;
            getonlydays();
            AR_BarDefault();
            }else{
            document.getElementById("AsisFirstDiv").classList.add("hidden");
            document.getElementById("AsisSecondDiv").classList.add("hidden");
            document.getElementById("AsisThirdDiv").classList.add("hidden");
            document.getElementById("AsisFourDiv").classList.add("hidden");
            document.getElementById("AsisOnBtn").classList.add("hidden");
            document.getElementById("AsisMainDiv").classList.add("hidden");
            moveCamera("center");
            enpanelprofesor=false;
            closeAsisWrapper();
            }
        }


    /////esto es de secciones y usuarios 
    function openUserMenu(s){
        if(s) {
            u.style = "display:flex"
            if(Loginmode == 1){
                document.getElementById("user-formlegend").textContent = "Ingresar";
                document.getElementById("RegisterDiv").style="display:none";
                document.getElementById("LoginDiv").style="";
                document.getElementById("passverifyinput").require = false;
            }else{
                document.getElementById("user-formlegend").textContent = "Registrar";
                document.getElementById("RegisterDiv").style="";
                document.getElementById("LoginDiv").style="display:none";
                document.getElementById("passverifyinput").require = true;
            }
        } else {u.style = "display:none"}
    }

    document.getElementById("UserLoginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const username = document.getElementById("userinput").value;
    const password = document.getElementById("passinput").value;
    
        if(Loginmode){
        const checkKeep = document.getElementById("keep-sesion").checked ? 1 : 0;
        
        const res = await login(username,password,checkKeep);

        if(res.success){openUserMenu(0);}

        }else{

        const passwordverify = document.getElementById("passverifyinput").value;

        if(password != passwordverify){
            msj("las contraseñas no coinciden",2);
            return;
            }

        const res = await register(username,password);

        if(res.success) {
                openUserMenu(0);
                Loginmode = 1;
            } 
        }
    })

    window.addEventListener('load', () => {
        //schedulerecharge();
        //showAsisReg(1);
        if (typeof addUpdateLevelEventListener === 'function') {
            addUpdateLevelEventListener((e) => {

            const ProfBtn = document.getElementById("ProfBtn");
            const RegBtn = document.getElementById("RegBtn");
            const HorBtn = document.getElementById("HorBtn");
            const CtrlBtn = document.getElementById("CtrlBtn");
            const LogOutBtn = document.getElementById("LogOutBtn");

            const MyArray = [ProfBtn, RegBtn, HorBtn, CtrlBtn, LogOutBtn];

                for (let i = 1; i <= 6; i++) {

                    MyArray.forEach(element => {
                    element.classList.remove(`p${i}`);
                        });
                    }

            console.log(e);

            switch (e.level) {
                case 0:
                LogOutBtn.classList.add("p6");
                    break;

                case 1:
                LogOutBtn.classList.add("p6");
                    break;
    
                case 2:
                HorBtn.classList.add("p1");
                LogOutBtn.classList.add("p6");
                    break;

                case 3:
                RegBtn.classList.add("p2");
                HorBtn.classList.add("p3");
                LogOutBtn.classList.add("p6");
                    break;

                case 4:
                RegBtn.classList.add("p2");
                HorBtn.classList.add("p3");
                LogOutBtn.classList.add("p6");
                    break;

                case 5:
                ProfBtn.classList.add("p1");
                RegBtn.classList.add("p2");
                HorBtn.classList.add("p3");
                CtrlBtn.classList.add("p4");
                LogOutBtn.classList.add("p5");
                    break;

                default:
                ProfBtn.classList.add("p1");
                RegBtn.classList.add("p2");
                HorBtn.classList.add("p3");
                CtrlBtn.classList.add("p4");
                LogOutBtn.classList.add("p5");
                    break;
                }
            });

  
            addUpdateLevelEventListener(async (e) => {
               
            const myuser = localStorage.getItem('user_id');
                if(myuser){
                switch (parseInt(myuser)) {
                    case 7: //Aaron
                            showAsisReg(1);
                    break;        
                    case 8: //Yovani
                           //| msj("iniciando servicio de alertas Livelula");
                        //showAsisReg(3);
                        showControl();
                    break;//No se pq no esta funcionando ahroa esta parte
                    case 4: //Adrian
                        chat("QUe haces adrian?");
                        showAsisReg(3); 
                    break;
                    default:
                    break;

                }
                }
            })        
        }
    });


    function P_BarDefault(){
        const List = document.getElementById("listado");     
        const Search = document.getElementById("lupa");  

        List.textContent = "";
        Search.value = "";
        
        cargarProfesores();
        }
    function S_BarDefault(){
        ItemSelected = -1;
        const _prevItems = document.querySelectorAll(".schedule-option");
        _prevItems.forEach(element => {
            element.classList.remove("previtemselected");
            });   
            
        form.reset();   

        SwitchItemBankSection(ItemBankBtn, 0)
        SwitchItemBankSection(SectionBtn, 0);

        const MateriaMenu   = document.getElementById('MateriaMenu');
        const HorarioMenu   = document.getElementById('HorarioMenu');
        const AulaMenu      = document.getElementById('AulaMenu');
        const SeccionMenu   = document.getElementById('SeccionMenu');

        if(!MateriaMenu.classList.contains('oculto')){
            MateriaMenu.classList.add('oculto');               
            }
        if(!HorarioMenu.classList.contains('oculto')){
            HorarioMenu.classList.add('oculto');
            }
        if(!AulaMenu.classList.contains('oculto')){
            AulaMenu.classList.add('oculto');
            }
        if(!SeccionMenu.classList.contains('oculto')){
            SeccionMenu.classList.add('oculto');
            }                
        }
    function H_BarDefault(){
        const ScheduleSect = document.getElementById("schedule-section");
        const ScheduleMenu = document.getElementById("schedule-menu");
        const Button = document.getElementById("openmenubtn");

        profSelected = -1;
        Horario = 0;

        if(!ScheduleSect.classList.contains("open")){
            ScheduleSect.classList.add("open");
            ScheduleMenu.classList.add("open");
            Button.innerHTML = `<i class="fa-solid fa-angle-up"></i>`;
            }                  

        LimpiarHorario();
        }
    function C_BarDefault(){
        editacion=0;
        ide=0;
                
        const regPanel = document.getElementById("regPanel");
        
        if(regPanel.style.display === 'block'){
            togglePanelusers()                
            }

        }
    function AR_BarDefault(){    
        const _tablesort0   = document.getElementById("tablesort0");  
        const _tablesort1   = document.getElementById("tablesort1");   
        const _tablesort2   = document.getElementById("tablesort2"); 
        const _tbAFInput    = document.getElementById("asisFilterInput");              

        const _tbstatus0    = document.getElementById("strongstatus0");
        const _tbstatus1    = document.getElementById("strongstatus1");
        const _tbstatus2    = document.getElementById("strongstatus2");             

        const _expMenu       = document.getElementById('exportMenu');

        /*_tbstatus0.classList.toggle("sdisable");
        _tbstatus1.classList.toggle("sdisable");
        _tbstatus2.classList.toggle("sdisable");
        status0 = true;
        status1 = true;
        status2 = true;
        */

        _tablesort0.querySelector("i").classList.remove("fa-angle-up","fa-angle-down");
        _tablesort1.querySelector("i").classList.remove("fa-angle-up","fa-angle-down");
        _tablesort2.querySelector("i").classList.remove("fa-angle-up","fa-angle-down"); 
        tablesortdir = 0;
        tablesortmode = 0;                

        _tbAFInput.value = "";search = "";               

        _expMenu.classList.remove('show');

        AsisID = -1;
        asisActualProfId = -1;

        record=0;
        inasistencias=0;
        tardanzas=0;
        asisinfoclickeable = 0;              

        MyCalendar.ChoiseDay();
        AA_MyCalendar.setDefault();              

        cargarDatosAsis();  

        profestadistico2.data.datasets[0].data = [0,0,0];   
        profestadistico2.update(); 

        AC_clean();
        PC_clean();
        
        }
</script>