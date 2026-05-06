const MaxLevel = 5;
export let UpdateLevelEventBus = [];

export async function verificarSesion() {//en newBarra
    const token = localStorage.getItem('user_token'); // El ID que guardamos al hacer login
    const id = localStorage.getItem('user_id');
    const nombre = localStorage.getItem('user_name');

    var respuesta = {
        logged: false,
        level: ""
        }

    if (!token || !id || !nombre) {
        localStorage.setItem('user_level',0);
        return respuesta;
        }

    try {
        const respuesta = await fetch('php/usuarios/check-session.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ token: token, id: id, name: nombre })
        });

        const res = await respuesta.json();

        console.log(res);

        if (!res.logged) {
            console.log("Sesión inválida o expirada:", res.reason);
            localStorage.removeItem('user_token');
            localStorage.removeItem('user_id');
            localStorage.removeItem('user_name');
            localStorage.setItem('user_level',0);
            return respuesta;
        } else {
            respuesta.logged = true;
            respuesta.level = res.level;
            localStorage.setItem('user_level',res.level);
            return respuesta;
        }
    } catch (error) {
        console.error("Error al validar sesión:", error);
        localStorage.setItem('user_level',0);
        return respuesta;
    }
}

export function updatePage(){

const myLevel = parseInt(localStorage.getItem('user_level'));

    if(!myLevel || myLevel == 0){//Si no tienes nivel de autorizacion

        //#region Todo lo que requiera seguridad, se escondera
        for (let i = 1; i <= MaxLevel; i++) {

        const all_levels = document.querySelectorAll(`.SecurityLevel${i}`);
    
        all_levels.forEach(element => {
                
            if(!element.classList.contains("SecurityHidden")){
                    element.classList.add("SecurityHidden");
                }

            });

        }
        //#endregion

        //#region Lo que aparecera cuando no haya ninguna autorización
        const all_levels = document.querySelectorAll(`.OnlyNoSecurityLevel`);
    
        all_levels.forEach(element => {
                
            if(element.classList.contains("SecurityHidden")){
                    element.classList.remove("SecurityHidden");
                }

            });
        //#endregion

    }else{

        //#region Lo que aparecera cuando no haya ninguna autorización se escondera
        const all_levels = document.querySelectorAll(`.OnlyNoSecurityLevel`);
    
        all_levels.forEach(element => {
                
            if(!element.classList.contains("SecurityHidden")){
                    element.classList.add("SecurityHidden");
                }

            });
        //#endregion

        //#region Todo lo que requiera seguridad
        for (let i = 1; i <= MaxLevel; i++) {

        const all_levels = document.querySelectorAll(`.SecurityLevel${i}`);
    
        all_levels.forEach(element => {
            if(i > myLevel){  

                if(!element.classList.contains("SecurityHidden")){
                    element.classList.add("SecurityHidden");
                    }

                }else{

                if(element.classList.contains("SecurityHidden")){
                    element.classList.remove("SecurityHidden");
                    }

                }
            });
        }
        //#endregion    

    }

const e = {level:myLevel,MaxLevel:MaxLevel}

UpdateLevelEventBus.forEach(element => {
    
    try {

        element(e);
        
    } catch (error) {
        
        console.error("Error en el bus de eventos: ", error)

    }

    });
}

export async function login(username,password,checkKeep){

    const sessionID = Math.random().toString(36).substring(2) + Date.now();
    try {
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
            localStorage.setItem('user_level', res.user.level);
            localStorage.setItem('user_token', res.token);
            localStorage.setItem('user_id', res.user.id);
            localStorage.setItem('user_name', res.user.nombre);
            updatePage();
            } else {
            console.error(res.error);
            }

        return res;
        } catch (error) {
        console.error("Error al logear:", e);    
        }

}

export async function register(username,password){

    try{
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
                console.log("¡Listo! Usuario creado.");
            } else {
               console.error("Error: " + resultado.error);
            }

            return resultado;
        }catch(e){
            console.error("Error al registrar usuario:", e);
        }
}

export async function login_out(){

        const token = localStorage.getItem('user_token');
        const id    = localStorage.getItem('user_id');
        const name  = localStorage.getItem('user_name');

        try{
        const respuesta = await fetch('php/usuarios/login-out.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                name: name,
                token: token,
                id: id 
            })
        });

        const res = await respuesta.json();
    
            if (!res.success) {
            console.error(res.reason);
            }

        }catch(e){
            console.error("Error al salir de la sesion:", e);
        }finally{
            localStorage.setItem('user_level', 0);
            localStorage.removeItem('user_token');
            localStorage.removeItem('user_id');
            localStorage.removeItem('user_name');
            updatePage();
        }
}

export function addUpdateLevelEventListener(_Function){
    
    UpdateLevelEventBus.push(_Function);

}

window.verificarSesion = verificarSesion;
window.updatePage = updatePage;
window.login = login;
window.register = register;
window.login_out = login_out;
window.addUpdateLevelEventListener = addUpdateLevelEventListener;

document.addEventListener('DOMContentLoaded', async () => {await verificarSesion();updatePage();});
