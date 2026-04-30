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
    .user-btn:hover { 
        color: var(--p); /* Cambia al azul en hover */
        transform: rotate(360deg); 
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
        background: radial-gradient(#D1EAEC, #ADD8D5);;
        border-radius: 2vw;
        padding: 20px 20px;
        color:#211E42;
        }


</style>


<nav>
    <div class="nav-contenedor"></div>
    <img src="img/IUJO.gif" height="50" style="filter:drop-shadow(0 0 5px var(--p))">
    <button id="openUserBtn" style="display:none;" class="nav-btn user-btn" onclick="openUserMenu(1)"><i class="fa-solid fa-circle-user"></i></button>
    <button id="openMenuBtn" style="display:none;" class="nav-btn" onclick="toggle(1)"><i class="fa-solid fa-atom"></i></button>
</nav>

<div id="hexOverlay" onclick="toggle(0)">
    <div class="menu-wrapper" id="mw" onclick="event.stopPropagation()">
        <div class="hexagon core" onclick="toggle(0)"> <i class="fa-solid fa-power-off"></i> SALIR </div>
        <div class="viewer admin hexagon p1" onclick="sowProfesores()"> <i class="fa-solid fa-user-tie"></i> Prof </div>
        <div class="viewer hexagon p2"> <i class="fa-solid fa-address-card"></i> Reg </div>
        <div class="viewer hexagon p3"> <i class="fa-solid fa-calendar-day"></i> Hor </div>
        <div class="viewer hexagon p4"> <i class="fa-solid fa-gear"></i> Ctrl </div>
        <div class="viewer hexagon p5"> <i class="fa-solid fa-lock"></i> Ses </div>
    </div>
</div>

<div id="securityOverlay" style="display:none;">
    <div class="user-menu-wrapper" id="mu" onmousedown="openUserMenu(0)">
        <div class="user-form-menu" onmousedown="event.stopPropagation()">
            <fieldset style="text-align: left; padding: 10px; border-radius:2vw; border-color:#46B9B1;">
                <legend><h3 id="user-formlegend">Ingresar</h3></legend>
                <form id="UserLoginForm" style="justify-content:start;">
                    <label for="userinput">Usuario:</label>
                        <input type="text" id="userinput" name="userinput" require><br>
                    <label for="passinput">Contraseña:</label>
                        <input type="password" id="passinput" name="passinput" require><br>
                    <div id="LoginDiv">
                        <label for="keep-sesion">Mantener la sesion iniciada:</label><br>
                        <div style="width:100%;display:flex;justify-content:start;">
                            <input type="checkbox" id="keep-sesion" name="keep-sesion" style="width: 3vh;height: 3vh;">
                        </div>
                    </div>
                    <div id="RegisterDiv">
                        <label for="passverifyinput">Vuelve a ingresar la contraseña:</label><br>
                        <input type="password" id="passverifyinput" name="passverifyinput">
                    </div>
                    <button id="usersubmitbutton" class="btn-agregar">Enviar</button>
                </form>
            </fieldset>
        </div>
    </div>
</div>

<script src="js/loginfunctions.js" type="module"></script>

<script type="module">
    import { verificarSesion } from './js/loginfunctions.js';

    const res = await verificarSesion();

    if(!res.logged){
    document.getElementById("openMenuBtn").style = "display:none";
    document.getElementById("openUserBtn").style = "";
    }else{
    document.getElementById("openUserBtn").style = "display:none";  
    document.getElementById("openMenuBtn").style = "";
    }

</script>


<script>

    document.getElementById("keep-sesion").addEventListener("click", (e) =>{

    console.log(document.getElementById("keep-sesion").checked)

    })

    Loginmode = 1;

    const o = document.getElementById('hexOverlay'), w = document.getElementById('mw');
    const u = document.getElementById("securityOverlay"), mu = document.getElementById("mu");
    function toggle(s) {
        if(s) { o.style.display = 'flex'; setTimeout(() => w.classList.add('expanded'), 10); }
        else { w.classList.remove('expanded'); setTimeout(() => o.style.display = 'none', 400); }
    }
    ////esto es para mostrar profesores
    function sowProfesores(){
        
        moveCamera("left");
        toggle(0);
        togglePanel();
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
        const sessionID = Math.random().toString(36).substring(2) + Date.now();

        const respuesta = await fetch('php/usuarios/login-user.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                usuario: username,
                password: password,
                token_sesion: sessionID,
                keep_sesion: checkKeep // true o false del checkbox
            })
        });

        const res = await respuesta.json();
    
            if (res.success) {
            localStorage.setItem('user_rol', res.user.rol);
            localStorage.setItem('mytoken', sessionID);
            openUserMenu(0);
            } else {
            alert(res.error);
            }
        }else{

        const passwordverify = document.getElementById("passverifyinput").value;

        if(password != passwordverify){
            alert("las contraseñas no coinciden")
            return;
            }

            const respuesta = await fetch('php/usuarios/create-user.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    usuario: username,
                    password: password
                })
            });
    
            const resultado = await respuesta.json();
            if(resultado.success) {
                alert("¡Listo! Usuario creado.");
                openUserMenu(0);
                Loginmode = 1;
            } else {
                alert("Error: " + resultado.error);
            }

        }
    })
</script>
