<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT alumno_id,cedulaes,apellido_alumno,nombre_alumno FROM alumnos WHERE estadoes = 1 ORDER BY cedulaes";
$query = $pdo->prepare($sql);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data,JSON_UNESCAPED_UNICODE);