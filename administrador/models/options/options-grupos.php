<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT * FROM grupos WHERE estado_grupos = 1 ORDER BY nombre_grupo";
$query = $pdo->prepare($sql);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data,JSON_UNESCAPED_UNICODE);