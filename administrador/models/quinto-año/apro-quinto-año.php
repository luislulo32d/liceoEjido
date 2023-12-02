<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idquintoaño = $_POST['idquintoaño'];

    $sql = "UPDATE quinto_año SET statusqn = 5 WHERE quinto_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idquintoaño));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Aprobado');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}