<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT materia_id,nombre_materia,siglas,año_seleccion,estado FROM materias WHERE estado = 1";
$query = $pdo->prepare($sql);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data,JSON_UNESCAPED_UNICODE);