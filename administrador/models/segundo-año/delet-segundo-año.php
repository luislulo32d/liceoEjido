<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idsegundoaño = $_POST['idsegundoaño'];

    $sql = "UPDATE segundo_año SET statussg = 0 WHERE segundo_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idsegundoaño));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Registro eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}