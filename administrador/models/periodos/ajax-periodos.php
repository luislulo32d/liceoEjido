<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['nombre'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idperiodo = $_POST['idperiodo'];
        $nombre = $_POST['nombre'];
        $estado = $_POST['listEstado'];

        $sql = 'SELECT * FROM periodos WHERE nombre_periodo = ? AND periodo_id != ? AND estado !=0';
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idperiodo));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result > 0){
            $respuesta = array('status' => false,'msg' => 'El periodo ya existe');
        } else {
            if($idperiodo == 0){
                $sqlInsert = 'INSERT INTO periodos (nombre_periodo,estado) VALUES (?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $accion = 1;
            } else {
                    $sqlUpdate = 'UPDATE periodos SET nombre_periodo = ?,estado = ? WHERE periodo_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$estado,$idperiodo));
                    $accion = 2;
            }
            
            if($request > 0) {
                if($accion == 1) {
                    $respuesta = array('status' => true,'msg' => 'Periodo creado correctamente');
                } else {
                    $respuesta = array('status' => true,'msg' => 'Periodo actualizado correctamente');
                }

            } else {
                $respuesta = array('status' => false,'msg' => 'Error al crear Periodo');
            }
        }
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}