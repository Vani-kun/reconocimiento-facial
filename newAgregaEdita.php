<style>
    :root {
        --accent: #00f2ff;
        --bg: #0f172a;
        --glass: rgba(255, 255, 255, 0.03);
        --border: rgba(255, 255, 255, 0.1);
        --card: rgba(30, 41, 59, 0.9); /* Un poco más opaco para que se lea bien sobre el fondo */
    }
    /* --- BOTÓN DE ACTIVACIÓN --- */
    #btn-toggle {
        position: fixed;
        top: 25px;
        left: 25px;
        z-index: 100;
        background: var(--card);
        border: 1px solid var(--border);
        color: var(--accent);
        padding: 10px 20px;
        border-radius: 12px;
        cursor: pointer;
        backdrop-filter: blur(10px);
        font-size: 0.8rem;
        font-weight: 500;
        transition: 0.3s;
    }

    #btn-toggle:hover {
        border-color: var(--accent);
        box-shadow: 0 0 15px rgba(0, 242, 255, 0.3);
    }

    /* --- PANEL LATERAL FIJO (DERECHA) --- */
    .soft-panel {
        position: fixed;
        right: 20px; /* Separación del borde */
        top: 50%;
        transform: translateY(-50%) translateX(120%); /* Escondido a la derecha */
        
        width: 320px;
        padding: 35px;
        background: var(--card);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border);
        
        /* Diseño de esquinas suave: la inferior derecha es la "diferente" */
        border-radius: 40px 40px 4px 40px;
        box-shadow: -10px 0 30px rgba(0, 0, 0, 0.4);
        
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 1000;
    }

    /* Clase para mostrar el panel */
    .soft-panel.active {
        transform: translateY(-50%) translateX(0);
    }

    /* --- BIOMETRÍA --- */
    .bio-header {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 25px;
    }

    .bio-slot {
        width: 45px;
        height: 45px;
        background: var(--glass);
        border: 1px solid var(--border);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.55rem;
        color: var(--accent);
    }

    /* --- INPUTS --- */
    h2 {
        font-size: 1rem;
        margin-bottom: 20px;
        text-align: center;
        color: white;
        font-weight: 500;
    }

    .input-wrap { margin-bottom: 15px; }

    input {
        width: 100%;
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--border);
        padding: 12px;
        border-radius: 15px;
        color: white;
        outline: none;
        font-size: 0.85rem;
        box-sizing: border-box;
    }

    input:focus { border-color: var(--accent); }

    /* --- BOTONES --- */
    .btn-group {
        display: flex;
        margin-top: 25px;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid var(--border);
    }

    .btn {
        flex: 1;
        padding: 14px;
        border: none;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-cancel { background: transparent; color: #94a3b8; }
    .btn-save { background: var(--accent); color: #0f172a; }
    .btn:active { opacity: 0.8; }
    /* --- BIOMETRÍA CON INTERACCIÓN --- */
    .bio-header {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 25px;
    }
    .btn-bio {
        flex: 1;
        padding: 14px;
        border: none;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 600;
        transition: 0.2s;
        background: transparent; color: #94a3b8; 
        box-shadow: 0 0.1vh 0.6vh rgba(0, 0, 0, 0.8);
        width: 40px;
        height: 40px;
        background: var(--glass);
        border: 1px solid var(--border);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.55rem;
        color: white;
        cursor: pointer; /* Cambia el cursor al pasar por encima */
        transition: all 0.3s ease; /* Transición suave para todos los estados */
    }
        .btn-bio:hover { opacity: 0.8; box-shadow: 0 0 0 rgba(0, 0, 0, 0.8);}
    .bio-slot {
        width: 60px;
        height: 60px;
        background: var(--glass);
        border: 1px solid var(--border);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.55rem;
        color: var(--accent);
        cursor: pointer; /* Cambia el cursor al pasar por encima */
        transition: all 0.3s ease; /* Transición suave para todos los estados */
    }

    /* Efecto de iluminación al pasar el mouse */
    .bio-slot:hover {
        border-color: var(--accent);
        background: rgba(0, 242, 255, 0.1);
        box-shadow: 0 0 15px rgba(0, 242, 255, 0.4); /* Resplandor exterior */
        transform: translateY(-2px); /* Pequeño salto táctil */
        color: #fff; /* El texto brilla un poco más */
    }

    /* Efecto visual al hacer clic */
    .bio-slot:active {
        transform: scale(0.95);
        box-shadow: 0 0 5px rgba(0, 242, 255, 0.2);
    }
    .scanimg{
        width : 100%;
        height :100%;
        objectFit :cover;
        borderRadius :12px;
    }
</style>

<!--button id="btn-toggle" onclick="togglexPanel()">Nuevo Registro</button-->

<!-- El elemento ya no tiene overlay, es independiente -->
<div id="sidePanel" class="soft-panel">
    
    <div class="bio-header">
        <div class="bio-slot" id="scan1">SCAN</div>
        <div class="bio-slot" id="scan2">SCAN</div>
        <div class="bio-slot" id="scan3">SCAN</div>
            <button class="btn-bio" onclick="addScan()">+</button>
    </div>

    <h2><span id="ttl-subpanel">Nuevo</span> Profesor</h2>
    
    <div class="input-wrap">
        <input type="text" placeholder="Nombre completo" id="pro_nombre">
    </div>

    <div class="input-wrap">
        <input type="text" placeholder="Especialidad(es)" id="pro_tag">
    </div>

    <div class="btn-group">
        <button class="btn btn-cancel" onclick="togglexPanel(-1,0)">Cerrar</button>
        <button class="btn btn-save" onclick="validaSave()">Confirmar</button>
    </div>

</div>

<script>
    FacesList = [];
    nombreimagenprofesor="yovani";
    const subpanel = document.getElementById('sidePanel');
    
    function togglexPanel(edi,id) {editar=edi;
        if (edi==1){
            ///traer los datos del ´profesor para ediotarlos
            const profesor = datosProfesores.find(p => p.id == id);
            document.getElementById('pro_nombre').value=profesor.nombre;
            document.getElementById('pro_tag').value=profesor.tags;
            FacesList =profesor.descriptores;
            for(i=1;i<=3;i++){
                if (profesor.descriptores[i-1]){
                const slotElement = document.getElementById('scan'+i);
                const nuevaImagen = document.createElement('img');
                nuevaImagen.src = "img/descriptores/"+profesor.nombre+i+".jpg";
                nuevaImagen.classList.add("scanimg");
                slotElement.innerHTML = ''; 
                slotElement.appendChild(nuevaImagen);
                }
            }
            document.getElementById("ttl-subpanel").textContent="Editar";
        }else if (edi==0){
            document.getElementById('pro_nombre').value="";
            document.getElementById('pro_tag').value="";
            FacesList =[];
            document.getElementById("ttl-subpanel").textContent="Nuevo";
        }
        subpanel.classList.toggle('active');
    }
    function addScan() {
        moveCamera("left")
        if(document.getElementById('pro_nombre').value==""){alert("debe rellenar el nombre");return}
        if (descriptorActual) {
            // Determinamos qué slot toca (1, 2 o 3)
            const slotIndex = FacesList.length + 1;
            const slotElement = document.getElementById(`scan${slotIndex}`);

            if (slotElement && FacesList.length < 3) {
                nombreimagenprofesor=document.getElementById('pro_nombre').value.trim();;
                // Capturamos la foto y la metemos en el slot
                capturarImagenDeVideo(video, slotElement);              
                // Aquí deberías pushear el descriptor al array para que la cuenta suba
                FacesList.push(descriptorActual); 
                
                console.log(`Snapshot ${slotIndex} guardado en el panel.`);
            } else {
                alert("Límite de Descriptores alcanzado");
            }
            
            descriptorActual = null; // Limpiamos para el siguiente escaneo
        } else {
            alert("No se detectó ningún rostro. Intenta ajustar la iluminación.");
        }   
    }
    async function capturarImagenDeVideo(videoElement, targetContainer) {
        // 1. Crear un canvas invisible
        const canvas = document.createElement('canvas');
        canvas.width = videoElement.videoWidth;
        canvas.height = videoElement.videoHeight;

        // 2. Dibujar el frame actual del video en el canvas
        const context = canvas.getContext('2d');
        context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

        // 3. Convertir el canvas a una imagen (formato Base64)
        const dataURL = canvas.toDataURL('image/png');

        // 4. Crear el elemento imagen
        const nuevaImagen = document.createElement('img');
        nuevaImagen.src = dataURL;

       await guardarImg(canvas);
        // Estilo para que encaje bien en tus slots suaves
        nuevaImagen.classList.add("scanimg");
       

        // 5. Hacer append al elemento destino
        // Opcional: limpiar el contenedor antes de añadir la nueva imagen
        targetContainer.innerHTML = ''; 
        targetContainer.appendChild(nuevaImagen);
    }
    async function guardarImg(cc) {
        cc.toBlob(async (blob) => {
            const datos = new FormData();
            
            // 'foto' es el nombre que recibirá PHP en $_FILES['foto']
            // El tercer parámetro es el nombre del archivo
            datos.append('foto', blob, `${nombreimagenprofesor}.jpg`);
            datos.append('nombre', nombreimagenprofesor+FacesList.length);

            try {
                const respuesta = await fetch('php/profesores/guardar_foto.php', {
                    method: 'POST',
                    body: datos 
                });
                const resultado = await respuesta.json();
                if (resultado.status === "ok") {console.log("¡Guardado!", resultado.ruta);
                } else {console.error("Error:", resultado.message);}
            } catch (error) {console.error("Error en la petición:", error);}
        }, 'image/jpeg', 0.9); // Formato y calidad
    }
    function validaSave() {
        const pro_nombre = document.getElementById('pro_nombre').value.trim();
        const pro_tag = document.getElementById('pro_tag').value.trim();
        // Validación de longitud (entre 5 y 29 caracteres)
        const nombreValido = pro_nombre.length > 4 && pro_nombre.length < 30;
        const tagValida = pro_tag.length > 4 && pro_tag.length < 30;

        if (!nombreValido ) {alert("El nombre debe tener entre 5 y 29 caracteres.");
        }else
        if (!tagValida) {alert("la especialidad debe tener entre 5 y 29 caracteres.");
        }else 
        if (FacesList.length <=0) {alert("debes agregar almenos un descrictor.");
        }else {
            guardarProfesor(pro_nombre,pro_tag,FacesList,editar);
            togglexPanel();
        }
    }
    //togglexPanel();
</script>
