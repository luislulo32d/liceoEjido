<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idusuario = $_POST['idusuario'];

    $sql = "UPDATE usuarios SET estado = 0 WHERE usuario_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idusuario));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Usuario eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}