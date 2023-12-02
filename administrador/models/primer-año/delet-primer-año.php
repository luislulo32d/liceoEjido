<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idprimeraño = $_POST['idprimeraño'];

    $sql = "DELETE FROM primer_año WHERE primero_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idprimeraño));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Registro eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}