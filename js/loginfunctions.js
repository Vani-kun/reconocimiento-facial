////es un modulo? y donde lo ejecutas'
export async function verificarSesion() {//en newBarra
    const token = localStorage.getItem('mytoken'); // El ID que guardamos al hacer login
    var respuesta = {
        logged: false,
        rol: ""
    }

    if (!token) {
        return respuesta;
    }

    try {
        const respuesta = await fetch('php/usuarios/check-session.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ token: token })
        });

        const res = await respuesta.json();

        if (!res.logged) {
            console.log("Sesión inválida o expirada:", res.reason);
            localStorage.removeItem('mytoken');
            localStorage.removeItem('user_rol');
            return respuesta;
        } else {
            console.log("Bienvenido,", res.user);
            respuesta.logged = true;
            respuesta.rol = res.rol;
            localStorage.setItem('user_rol',res.rol);
            return respuesta;
        }
    } catch (error) {
        console.error("Error al validar sesión:", error);
        return respuesta;
    }
}

window.verificarSesion = verificarSesion;
// Ejecutar la validación al cargar la página
document.addEventListener('DOMContentLoaded', verificarSesion);