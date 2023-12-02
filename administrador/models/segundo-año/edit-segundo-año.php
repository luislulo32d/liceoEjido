<?php

require '../../../includes/conexion.php';

if(!empty($_GET)) {
    $idsegundoaño = $_GET['idsegundoaño'];

    $sql = "SELECT * FROM segundo_año WHERE segundo_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idsegundoaño));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)) {
        $respuesta = array('status' => false,'msg' => 'datos no encontrados');
    } else {
        $respuesta = array('status' => true,'data' => $result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}