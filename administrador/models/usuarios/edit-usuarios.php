<?php

require '../../../includes/conexion.php';

if(!empty($_GET)) {
    $idusuario = $_GET['idusuario'];

    $sql = "SELECT * FROM usuarios WHERE usuario_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idusuario));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)) {
        $respuesta = array('status' => false,'msg' => 'datos no encontrados');
    } else {
        $respuesta = array('status' => true,'data' => $result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}