<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idquintoaño = $_POST['idquintoaño'];

    $sql = "UPDATE quinto_año SET statusqn = 0 WHERE quinto_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idquintoaño));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Registro eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}