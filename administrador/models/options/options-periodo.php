<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT periodo_id,nombre_periodo FROM periodos WHERE estado = 1";
$query = $pdo->prepare($sql);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data,JSON_UNESCAPED_UNICODE);