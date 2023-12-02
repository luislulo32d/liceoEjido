<?php

require '../../../includes/conexion.php';

if(!empty($_GET)) {
    $idprofesormateria = $_GET['idprofesormateria'];

    $sql = "SELECT * FROM profesor_materias WHERE profesor_materia_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idprofesormateria));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)) {
        $respuesta = array('status' => false,'msg' => 'datos no encontrados');
    } else {
        $respuesta = array('status' => true,'data' => $result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}