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
        background: var(--newpoligono);
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
        color: var(--newprima);
    }    
    .bio-slot.activoo {
        background: var(--newprima);
        color: var(--newletras);
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
    .inputt {
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
   .inputt:focus { border-color: var(--newprima); }

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
    }.btn:active { opacity: 0.8; }
    .btn-cancel { background: transparent; color: var(--newletras); }
    .btn-save { background: var(--newprima); color: #ffffff; }
    .btn-save:hover {box-shadow 0px 0px 10px var(--newprima);}
    
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
        color: var(--newprima);
        cursor: pointer; /* Cambia el cursor al pasar por encima */
        transition: all 0.3s ease; 
    }

    /* Efecto de iluminación al pasar el mouse */
    .bio-slot:hover {
        border-color: var(--newprima);
        background: rgba(0, 242, 255, 0.1);
        box-shadow: 0 0 15px var(--newprima); /* Resplandor exterior */
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
    #fotopro{
        transition: all 0.3s ease; 
            overflow: hidden;
    }
    #fotopro:hover{
        box-shadow:0px 0px 10px var(--newprima);
        cursor:pointer;
        transform:scale(1.5) translateY(-20px);
    }
    #subir{
            width: 100%;
            margin-bottom: 10px;
    }
</style>

<!--button id="btn-toggle" onclick="togglexPanel()">Nuevo Registro</button-->

<!-- El elemento ya no tiene overlay, es independiente -->
<div id="sidePanel" class="soft-panel">
    <div id="fotopro"class="avatar-circle" onclick="addFoto(-1,0)">A</div>
    <input id="subir" type="file">
    <div class="bio-header">
        <div class="bio-slot" id="scan1"></div>
        <div class="bio-slot" id="scan2"></div>
        <div class="bio-slot" id="scan3"></div>
            <button class="btn-bio" onclick="addScan()">+</button>
    </div>

    <h2><span id="ttl-subpanel">Nuevo</span> Profesor</h2>
    
    <div class="input-wrap">
        <input  class="inputt" type="text" placeholder="Nombre completo" id="pro_nombre">
    </div>

    <div class="input-wrap">
        <input class="inputt" type="text" placeholder="Especialidad(es)" id="pro_tag">
    </div>

    <div class="btn-group">
        <button class="btn btn-cancel" onclick="togglexPanel(-1,0)">Cerrar</button>
        <button class="btn btn-save" onclick="validaSave()">Confirmar</button>
    </div>

</div>

<script>
    FacesList = [];
    const canvax = document.createElement('canvas');
    canvax.width = 500;canvax.height = 500;
    const subpanel = document.getElementById('sidePanel');
    for(let i=1;i<=3;i++){
        const slotElement = document.getElementById('scan'+i);
        slotElement.addEventListener("click",()=>{
            removeScan(i);
        });
    }
    function togglexPanel(edi,id) {enpanelprofesor=true;
        if (edi==1){
            editar = 1;
            ///traer los datos del ´profesor para ediotarlos
            const profesor = datosProfesores.find(p => p.id == id);/////busac el profesor por su id
            document.getElementById('pro_nombre').value=profesor.nombre;           
            const profTags = JSON.parse(profesor.tags);
            
            if(Array.isArray(profTags)){document.getElementById('pro_tag').value= profTags.join(", ");
            }else
            {document.getElementById('pro_tag').value= "";   }
            FacesList = JSON.parse(profesor.descriptores);

            if(!Array.isArray(FacesList)){
                FacesList = [];
                console.error(`descriptores del profesor ${profesor.nombre} portador del id ${profesor.id} corruptos`);
            }
            actualizaScan();

               const ava = document.getElementById("fotopro");
                /* const nuevaImagen = document.createElement('img');            
                    nuevaImagen.onerror = function() { // 1. Configuramos qué hacer si la carga falla
                        ava.innerHTML = profesor.nombre[0];
                    };
                    nuevaImagen.onload = function() {// 2. Configuramos qué hacer si la carga es exitosa
                        ava.innerHTML = ''; 
                        ava.appendChild(nuevaImagen);
                    };
                nuevaImagen.src = "img/caras/"+profesor.id+".jpg";
                nuevaImagen.classList.add("scanimg");*/
                creafoto(ava,profesor.id,profesor.nombre);

            document.getElementById("ttl-subpanel").textContent="Editar";
        }else if (edi==0){
            editar = 0;
            document.getElementById('pro_nombre').value="";
            document.getElementById('pro_tag').value="";
            FacesList =[];
            for(i=1;i<=3;i++){
                const slotElement = document.getElementById('scan'+i);
                slotElement.innerHTML="";
                slotElement.classList.remove("activoo");
            }
            document.getElementById("fotopro").innerHTML="A";
            document.getElementById("ttl-subpanel").textContent="Nuevo";
        }
        subpanel.classList.toggle('active');
    }
    function addFoto() {
        //aqui se prosesara si se sube y si se toma la foto directamente
        if(document.getElementById('pro_nombre').value==""){msj("debe rellenar el nombre",1);return}
        //nombreimagenprofesor=document.getElementById('pro_nombre').value.trim();;
        capturarImagenDeVideo(video,document.getElementById("fotopro"));         
    }
    function actualizaScan() {
        for(let i=1;i<=3;i++){
            const slotElement = document.getElementById(`scan${i}`);
            if (slotElement && FacesList.length >=i) {
                slotElement.innerHTML = "Descrip...";//"Cara("+i+")"; 
                slotElement.classList.add("activoo");
            } else {
                slotElement.innerHTML="";
                slotElement.classList.remove("activoo");
            }
        }
    }
    function addScan() {
        moveCamera("left");
        if (descriptorActual) {
            if (FacesList.length < 3) {
                FacesList.push(descriptorActual); 
                actualizaScan();
            } else {
                msj("Límite de Descriptores alcanzado",2);
            }
            descriptorActual = null; //Limpiamos para el siguiente escaneo
        } else {
            msj(2,"No se detectó ningún rostro. Intenta ajustar la iluminación.");
        }   
    }
    function removeScan(ind) {
        moveCamera("left");
        FacesList.splice(ind-1, 1);
        actualizaScan();
    }
    async function capturarImagenDeVideo(videoElement, targetContainer) {
        const context = canvax.getContext('2d');
        context.drawImage(videoElement, 0, 0, canvax.width, canvax.height);
        // 3. Convertir el canvas a una imagen (formato Base64)
        const dataURL = canvax.toDataURL('image/png');
        // 4. Crear el elemento imagen
        const nuevaImagen = document.createElement('img');
        nuevaImagen.src = dataURL;
        // Estilo para que encaje bien en tus slots suaves
        nuevaImagen.classList.add("scanimg");
        // 5. Hacer append al elemento destino
        targetContainer.innerHTML = ''; // limpiar el contenedor antes de añadir la nueva imagen
        targetContainer.appendChild(nuevaImagen);
    }
    const subir = document.getElementById('subir');
    subir.addEventListener('change', function(e) {
            const archivo = e.target.files[0]; // Tomamos el primer archivo seleccionado
            if (archivo) {cargarImagenDesdeArchivo(archivo, document.getElementById("fotopro"));}
    });
    async function cargarImagenDesdeArchivo(file, targetContainer) {
        if (!file || !file.type.startsWith('image/')) {console.error("El archivo no es una imagen válida.");return;}

        const reader = new FileReader();
        reader.onload = function(e) {
            // 3. Crear el elemento imagen
            const nuevaImagen = document.createElement('img');
            nuevaImagen.src = e.target.result;
            nuevaImagen.onload = function() {
                const context = canvax.getContext('2d');
                context.drawImage(nuevaImagen, 0, 0, canvax.width, canvax.height);
            };
            
            // Mantenemos tu clase de estilo para que se vea futurista
            nuevaImagen.classList.add("scanimg");
            // 4. Manejo de error si la imagen subida está corrupta
            nuevaImagen.onerror = function() {
                //targetContainer.innerHTML = '<p class="error-msg">Error al cargar imagen</p>';
            };

            // 5. Limpiar y añadir al contenedor
            targetContainer.innerHTML = ''; 
            targetContainer.appendChild(nuevaImagen);
        };
        // Iniciar la lectura del archivo como una URL de datos
        reader.readAsDataURL(file);
    }
    async function guardarImg(cc,idd) {
        cc.toBlob(async (blob) => {
            const datos = new FormData();  
            // 'foto' es el nombre que recibirá PHP en $_FILES['foto']
            // El tercer parámetro es el nombre del archivo
            datos.append('foto', blob, `${idd}.jpg`);
            datos.append('nombre', idd);

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
        const pro_tag = document.getElementById('pro_tag').value.trim().split(", ");
        // Validación de longitud (entre 5 y 29 caracteres)
        const nombreValido = pro_nombre.length > 4 && pro_nombre.length < 30;
        const tagValida = true;//pro_tag.length > 4 && pro_tag.length < 30;

        if (!nombreValido ) {msj("El nombre debe tener entre 5 y 29 caracteres.",1);
        }else
        if (!tagValida) {msj("la especialidad debe tener entre 5 y 29 caracteres.",1);
        }else 
        if (FacesList.length <=0) {msj("debes agregar almenos un descrictor.",2);
        }else {
            guardarProfesor(pro_nombre,pro_tag,FacesList,editar);
            togglexPanel();
        }
    }
    //togglexPanel();
</script>
