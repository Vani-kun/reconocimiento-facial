<?php
$result = 0;


    $dias = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
    $diaSemana = $dias[date("w")];
    $jsonBusqueda = json_encode(["Dia" => $diaSemana]);
    $fechaHoy = date('Y-m-d');

    $sqlInitial = " INSERT IGNORE INTO asistencia (profesorID, entrada, salida, fecha, estado, tardanza)
                    SELECT DISTINCT profesor, '00:00:00', '00:00:00', ?, 0, 0
                    FROM horario h
                    WHERE JSON_CONTAINS(dias, ?) 
                    AND profesor IS NOT NULL 
                    AND NOT EXISTS (
                        SELECT 1 FROM asistencia a 
                        WHERE a.profesorID = h.profesor 
                        AND a.fecha = ?
                        );";
    
    try {
        $stmtPopulate = $pdo->prepare($sqlInitial);
        $stmtPopulate->execute([$fechaHoy, $jsonBusqueda, $fechaHoy]);
        $result = 1;

    } catch (PDOException $e) {
        error_log("Error en Lazy Cron: " . $e->getMessage());
    }


?>