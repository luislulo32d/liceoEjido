<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT * FROM materias WHERE estado = 1 AND año_seleccion = 5";
$query = $pdo->prepare($sql);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data,JSON_UNESCAPED_UNICODE);