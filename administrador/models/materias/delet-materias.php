<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idmateria = $_POST['idmateria'];

    $sql = "UPDATE materias SET estado = 0 WHERE materia_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idmateria));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Materia eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}