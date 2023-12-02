<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idcuartoaño = $_POST['idcuartoaño'];

    $sql = "UPDATE cuarto_año SET statuscr = 5 WHERE cuarto_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idcuartoaño));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Aprobado');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}