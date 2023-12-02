<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['nombre'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idaula = $_POST['idaula'];
        $nombre = $_POST['nombre'];
        $estado = $_POST['listEstado'];

        $sql = 'SELECT * FROM aulas WHERE nombre_aula = ? AND aula_id != ? AND estado !=0';
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idaula));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result > 0){
            $respuesta = array('status' => false,'msg' => 'El aula ya existe');
        } else {
            if($idaula == 0){
                $sqlInsert = 'INSERT INTO aulas (nombre_aula,estado) VALUES (?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $accion = 1;
            } else {
                    $sqlUpdate = 'UPDATE aulas SET nombre_aula = ?,estado = ? WHERE aula_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$estado,$idaula));
                    $accion = 2;
            }
            
            if($request > 0) {
                if($accion == 1) {
                    $respuesta = array('status' => true,'msg' => 'Aula creada correctamente');
                } else {
                    $respuesta = array('status' => true,'msg' => 'Aula actualizada correctamente');
                }

            } else {
                $respuesta = array('status' => false,'msg' => 'Error al crear Aula');
            }
        }
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}