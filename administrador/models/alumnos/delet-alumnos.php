<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idalumno = $_POST['idalumno'];

    $sql = "UPDATE alumnos SET estadoes = 0 WHERE alumno_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idalumno));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Alumno eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}