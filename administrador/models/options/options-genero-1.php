<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT * FROM primer_año as pr INNER JOIN alumnos as al ON pr.alumno_id = al.alumno_id INNER JOIN periodos as pe ON pr.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND pr.statuspr = 1 AND al.estadoes = 1  ORDER BY cedulaes";
$query = $pdo->prepare($sql);
$query->execute();
$rowgen = $query->rowCount();

