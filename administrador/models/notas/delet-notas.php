<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idnotas = $_POST['idnotas'];

    $sql = "DELETE FROM notas WHERE nota_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idnotas));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Nota eliminada correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}