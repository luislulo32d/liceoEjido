<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['e_1'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $estadistica_id = $_POST['estadistica_id'];
        $primerAño = $_POST['e_1'];
        $segundoAño = $_POST['e_2'];
        $tercerAño = $_POST['e_3'];
        $cuartoAño = $_POST['e_4'];
        $quintoAño = $_POST['e_5'];

 
       
            if($estadistica_id == 0){
                $sqlInsert = "INSERT INTO estadisticas (primerAño,segundoAño,tercerAño,cuartoAño,quintoAño) VALUES (?,?,?,?,?)";
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($primerAño,$segundoAño,$tercerAño,$cuartoAño,$quintoAño));
                $accion = 1;
            } else {
                    $sqlUpdate = 'UPDATE estadisticas SET primerAño = ?,segundoAño = ?,tercerAño = ?,cuartoAño = ?,quintoAño = ? WHERE id_estadisticas = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($primerAño,$segundoAño,$tercerAño,$cuartoAño,$quintoAño,$estadistica_id));
                    $accion = 2;
            }
            
            if($request > 0) {
                if($accion == 1) {
                    $respuesta = array('status' => true,'msg' => 'Registro creado correctamente');
                } else {
                    $respuesta = array('status' => true,'msg' => 'Registro actualizado correctamente');
                }

            } else {
                $respuesta = array('status' => false,'msg' => 'Error al crear el proceso');
            }
        
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false,'msg' => 'esta mierda está loca');
    
}