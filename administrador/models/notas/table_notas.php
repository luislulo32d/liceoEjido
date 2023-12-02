<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT * FROM notas as nt INNER JOIN alumnos as al ON nt.alumno_id = al.alumno_id INNER JOIN materias as mt ON nt.materia_id = mt.materia_id";
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($consulta,JSON_UNESCAPED_UNICODE);