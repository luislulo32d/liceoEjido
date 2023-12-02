<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idterceraño = $_POST['idterceraño'];

    $sql = "UPDATE tercer_año SET statustr = 0 WHERE tercer_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idterceraño));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Registro eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}