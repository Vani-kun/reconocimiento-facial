<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/face-api.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="estiloMARS.css">
    <link rel="stylesheet" href="admin-style.css">

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
            background-color: #007BFF;
            color: white;
            border: none;
            margin: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.8);
        }

        .btn:hover {
            background-color: #007bffa3;
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0);
            transform: translateY(4px);
        }

    </style>
</head>
<body>

    <?php
    include 'php/navbar.php';
    ?>

    <div class="main-container" style="width:80%; display:flex; flex-direction: column; align-items: center; padding: 20px; position: fixed; align-self:center; top: 50%; left: 50%; transform: translate(-50%, -50%);">

        <div style="width:100%; display:flex; flex-direction: column; gap: 10px;">
        

            <a href="asistencia-historica.php" style="flex: 1;">
                <button class="btn" style="width:100%;">Asistencias historicas</button>
            </a>
            <a href="profesores.php"><button class="btn" style="width:100%;">Modificar profesores</button></a>
            <a href="admin.php"><button class="btn" style="width:100%;">Definir horarios</button></a>
            <a href="asignar.php"><button class="btn" style="width:100%;">Crear secciones</button></a>
            <a href="config.php"><button class="btn" style="width:100%;">Configuración de pagina</button></a>
        
        </div>
    </div>

</body>
</html>
