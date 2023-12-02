<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idterceraño = $_POST['idterceraño'];

    $sql = "UPDATE tercer_año SET statustr = 5 WHERE tercer_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idterceraño));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Aprobado');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}