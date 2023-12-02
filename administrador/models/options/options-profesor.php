<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT profesor_id,apellido,nombre,cedula,estadopr FROM profesor WHERE estadopr = 1 ORDER BY cedula";
$query = $pdo->prepare($sql);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data,JSON_UNESCAPED_UNICODE);