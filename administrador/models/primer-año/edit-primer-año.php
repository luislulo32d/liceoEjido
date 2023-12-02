<?php

require '../../../includes/conexion.php';

if(!empty($_GET)) {
    $idprimeraño = $_GET['idprimeraño'];

    $sql = "SELECT * FROM primer_año WHERE primero_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idprimeraño));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)) {
        $respuesta = array('status' => false,'msg' => 'datos no encontrados');
    } else {
        $respuesta = array('status' => true,'data' => $result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}