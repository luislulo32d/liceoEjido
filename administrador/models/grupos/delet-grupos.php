<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idgrupo = $_POST['idgrupo'];

    $sql = "UPDATE grupos SET estado_grupos = 0 WHERE grupo_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idgrupo));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Grupo eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}