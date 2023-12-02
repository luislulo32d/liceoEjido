<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idprofesormateria = $_POST['idprofesormateria'];

    $sql = "UPDATE profesor_materias SET estado_profesor_materia = 0 WHERE profesor_materia_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idprofesormateria));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Registro eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}