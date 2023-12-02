<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idprimeraño = $_POST['idprimeraño'];

    $sql = "UPDATE primer_año SET statuspr = 5 WHERE primero_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idprimeraño));

    if($result) {
        $respuesta = array('status' => true,'msg' => 'Estudiante Aprobado Correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error Error Error!!');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}