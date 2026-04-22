<?php
    include "php/conexion.php";

    //traer todos los profesores
    $sql = "SELECT id, nombre, tags FROM caras WHERE activo = 1 ORDER BY nombre ASC";
    $stmt = $pdo->query($sql);
    $profesores = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.A.R.S. - Panel de Administración</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/profesores.css">
    <link rel="stylesheet" href="css/horarios.css">
    <script src="js/face-api.min.js"></script>

</head>
<body>
    
<?php include 'php/extras/navbar.php'; ?>

<main class="main-container" style="display:flex">
    <section id="professors-section" class="profesor-container">
        <div class="panel-header">
            <h2 style="font-size:3.5vh">Profes Registrados</h2>
        </div>

        <div class="scroll-area" id="professors-list">
            <script>

            profSelected = -1;

            const safeParse = (data) => {
                if (!data || data.trim() === "") return []; // Si está vacío o es solo espacio, devuelve array vacío
                try {
                    return JSON.parse(data);
                    } catch (e) {
                    console.error("Error parseando JSON:", data);
                    return []; // Si el JSON está mal formado, devuelve array vacío para no romper el código
                    }
                };

            SelectProfesor = -1;
            const datosProfesores = <?php echo json_encode($profesores); ?>;
            const allProfesors = [];

            
            

            openEditor = -1;
            openProf = -1;

            datosProfesores.forEach (prof => {
                document.getElementById('professors-list').appendChild(CrearCarta(prof));   
                });

            function CrearCarta(prof){

            const myAllprofesorID = allProfesors.length;
            const id = prof.id;
            const nombre = prof.nombre;
            const tags = safeParse(prof.tags);

            const profCard = document.createElement('div');

            profCard.classList.add('prof-card');

            profCard.myID = myAllprofesorID; // Guardamos el ID en el elemento para referencia futura

            const infoDiv = document.createElement('div');
            infoDiv.classList.add('prof-infodiv');
            profCard.appendChild(infoDiv);

            const profAvatarContext = document.createElement('div');
            profAvatarContext.classList.add('prof-avatar-context');

            const profAvatar = document.createElement('div');
            profAvatar.classList.add('prof-avatar');
            profAvatar.textContent = nombre.charAt(0).toUpperCase(); // Primera letra del nombre
            profAvatarContext.appendChild(profAvatar);
            const profInfo = document.createElement('div');
            profInfo.classList.add('prof-info');
            const strong = document.createElement('strong');
            strong.textContent = nombre;

            profInfo.appendChild(strong);
            profAvatarContext.appendChild(profInfo);

            infoDiv.appendChild(profAvatarContext);
                 
            profCard.setAttribute('id', id);
            profCard.setAttribute('nombre', nombre);
            profCard.setAttribute('tags', tags);

            profCard.addEventListener("click", (e) => {
                if(!profCard.classList.contains("active")){
                    d = Array.from(document.getElementsByClassName("prof-card"));
                    d.forEach(element => {
                        element.classList.remove("active");
                    });

                    document.getElementById("userinfo").textContent = profCard.getAttribute('nombre');
                    document.getElementById("usertags").textContent = "tags: "+(profCard.getAttribute('tags').split(",").filter((e) => (e != "activo" && e != "inactivo")).join(", "));

                    profCard.classList.add("active");
                    profSelected = profCard;
                    }else{
                    document.getElementById("userinfo").textContent = "Escoje a un profesor";
                    document.getElementById("usertags").textContent = "tags: ";

                    profCard.classList.remove("active");
                    profSelected = -1;
                    }
                });

            allProfesors.push({
                id,
                nombre,
                tags,
                element: profCard,
                idap: myAllprofesorID,
                });

            return profCard;
            }
            </script>            
        </div>

            
            
        <div id="controlpanel" class="control-panel">
            <div class="current-prof-display">
                <div class="status-indicator"></div>
                        
            </div>

            <div class="search-box">
                <input type="text" id="search-prof" placeholder="🔍Buscar por nombre o ID...">
            </div>
            <div class="infodiv">
                <strong id="userinfo">Escoje a un profesor</strong>
                <p id="usertags">tags:</p>
            </div>
        </div>
    </section>


    <section id="schedule-section" class="schedule-container">
        <div class="schedule-div">
            <div class="panel-header">
            <h2 style="font-size:3.5vh">Horario</h2>
            </div>

            <div class="schedule">

                <div class="schedule-header">
                    <div class="schedule-day-div-h">Lunes</div>
                    <div class="schedule-day-div-h">Martes</div>
                    <div class="schedule-day-div-h">Miercoles</div>
                    <div class="schedule-day-div-h">Jueves</div>
                    <div class="schedule-day-div-h">Viernes</div>
                    <div class="schedule-day-div-h">Sabado</div>
                    <div class="schedule-day-div-h">Domingo</div>
                </div>

                <div class="schedule-config">
                    <div id="friday" class="schedule-day-div"></div>
                    <div id="friday" class="schedule-day-div"></div>
                    <div id="friday" class="schedule-day-div"></div>
                    <div id="friday" class="schedule-day-div"></div>
                    <div id="friday" class="schedule-day-div"></div>
                    <div id="friday" class="schedule-day-div"></div>
                    <div id="friday" class="schedule-day-div"></div>
                </div>

            </div>
        </div>
        <div class="schedule-menu">
        
            <div class="schedule-menu-scroll">

                <div class="schedule-option">
            
                    <div class="schedule-option-header">
                    <p style="margin-left:1vw;"><strong>Calculo I:</strong> Aaron García</p>
                    </div>
                    <div class="schedule-option-body">
                        <div style="width:30%;text-align:left;padding-left:2vh;align-content:center;height:100%;">
                        <p>Sección C</p>
                        <p>Aula 14</p>
                        </div>
                        <div style="width:70%;text-align:left;padding-left:2vh;align-content:center;height:100%;border-left: 0.1vh #0F495E dotted;">
                        <p><strong>Martes: </strong>2:15 - 4:35</p>
                        <p><strong>Jueves: </strong>2:15 - 4:35</p>
                        </div>
                    </div>
                </div>

                <div class="schedule-option">
            
                    <div class="schedule-option-header">
                    <p style="margin-left:1vw;"><strong>Calculo I:</strong> Aaron García</p>
                    </div>
                    <div class="schedule-option-body">
                        <div style="width:30%;text-align:left;padding-left:2vh;align-content:center;height:100%;">
                        <p>Sección C</p>
                        <p>Aula 14</p>
                        </div>
                        <div style="width:70%;text-align:left;padding-left:2vh;align-content:center;height:100%;border-left: 0.1vh #0F495E dotted;">
                        <p><strong>Martes: </strong>2:15 - 4:35</p>
                        <p><strong>Jueves: </strong>2:15 - 4:35</p>
                        </div>
                    </div>
                </div>

                <div class="schedule-option">
            
                    <div class="schedule-option-header">
                    <p style="margin-left:1vw;"><strong>Calculo I:</strong> Anderson Pichardo</p>
                    </div>
                    <div class="schedule-option-body">
                        <div style="width:30%;text-align:left;padding-left:2vh;align-content:center;height:100%;">
                        <p>Sección C</p>
                        <p>Aula 14</p>
                        </div>
                        <div style="width:70%;text-align:left;padding-left:2vh;align-content:center;height:100%;border-left: 0.1vh #0F495E dotted;">
                        <p><strong>Martes: </strong>2:15 - 4:35</p>
                        <p><strong>Jueves: </strong>2:15 - 4:35</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
</main>

<script>

document.getElementById('search-prof').addEventListener('input', (e) => {
    refreshProfessorList(e.target.value);
    });

function refreshProfessorList(search = ""){
    const listContainer = document.getElementById('professors-list');
    listContainer.innerHTML = '';
    trueSearch = "";
    const searchTerms = search.trim().split(' ').filter(term => {  
        if(term.startsWith('#') && term.length > 1){
            return term;
            }else{
            if(!term.startsWith('#')){
            trueSearch += term + " ";
                }
            return false;
            }
        }).map(term => term.slice(1).toLowerCase());

    allProfesors.forEach(prof => {
        if (!search) {
            listContainer.appendChild(prof.element);
            return;
            }

        var include = 0;

        if(prof.nombre.toLowerCase().includes(trueSearch.toLowerCase().trim()) && trueSearch.trim() !== ""){
            if(searchTerms.length === 0){
                include += 2;
                } else {
                include += 1;
                }
            } 

        if(trueSearch.trim() === ""){
            include += 1;
            }

        if (searchTerms.length > 0 && prof.tags.length > 0) {
            const profTagsLower = prof.tags.map(t => t.toLowerCase());
            const allTermsMatched = searchTerms.every(term => {
            // Buscamos el índice de la primera etiqueta que coincida con el término
            const foundIndex = profTagsLower.findIndex(tag => tag.includes(term));
                
            if (foundIndex !== -1) {
                // Si la encontramos, la eliminamos de las disponibles para este profesor
                profTagsLower.splice(foundIndex, 1);
                return true;
                }
            return false;
            });
        
            if (allTermsMatched) {
                include += 1;
                }
            }

                

        if(include === 2){
            listContainer.appendChild(prof.element);
            }
        console.log(prof.nombre, include);
        });
    }
refreshProfessorList();


</script>


<?php include 'php/extras/footer.php';?>

</body>
</html>