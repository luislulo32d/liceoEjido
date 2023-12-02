<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idcuartoaño = $_POST['idcuartoaño'];

    $sql = "UPDATE cuarto_año SET statuscr = 0 WHERE cuarto_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idcuartoaño));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Registro eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}