<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/face-api.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <link rel="stylesheet" href="style.css">

    <style>
        
        .contenedor{
            position: relative; /* Define el marco de referencia */
            display: inline-block; /* Ajusta el div al tamaño de la imagen */
            line-height: 0;
            padding: 0px;
        }

        #canva {
            position: absolute; /* Lo saca del flujo normal */
            top: 0;
            left: 0;
            /* Opcional: para asegurarte de que el canvas no bloquee clics en la imagen */
            pointer-events: none; 
        }
        .oculto {
            display: none !important;
        }

        .btn {
            width: 80%;
            }

    </style>
</head>
<body>

    <?php include 'php/extras/navbar.php'; ?>

    <div style="min-height:100vh"></div>

    <div class="main-container section-container" style="width:50%; display:flex; flex-direction: column; align-items: center; padding: 20px; position: absolute; align-self:center; top: 50%; left: 50%; transform: translate(-50%, -50%);">

        <div style="padding-top: 10px; padding-bottom: 10px; width:100%; display:flex; flex-direction: column; gap: 10px;">
        

            <a href="asistencia-historica.php" style="flex: 1;">
                <button class="btn">Asistencias historicas</button>
            </a>
            <a href="profesores.php"><button class="btn">Modificar profesores</button></a>
            <a href="horarios.php"><button class="btn btn-danger">🛠 Definir horarios</button></a>
            <a href="asignar.php"><button class="btn">Crear secciones</button></a>
            <a href="config.php"><button class="btn btn-danger">🛠 Configuración de pagina</button></a>
        
        </div>
    </div>

    <?php include 'php/extras/footer.php';?>

</body>
</html>
