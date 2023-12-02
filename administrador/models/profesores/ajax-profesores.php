<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['apellido']) || empty($_POST['nombre']) || empty($_POST['cedula'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idprofesor = $_POST['idprofesor'];
        $apellido = $_POST['apellido'];
        $nombre = $_POST['nombre'];
        $cedula = $_POST['cedula'];
        $estadopr = $_POST['listEstado'];
        $comprobanteProfe = 0;
        $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ_ ÁÉÍÓÚ";



        for($i=0; $i<strlen($apellido); $i++){
            if (strpos($permitidos, substr($apellido,$i,1))===false){
                $comprobanteProfe = 1;
            }
         }
        for($i=0; $i<strlen($nombre); $i++){
            if (strpos($permitidos, substr($nombre,$i,1))===false){
                $comprobanteProfe = 1;
            }
         }
         if($comprobanteProfe == 1){
            $respuesta = array('status' => false,'msg' => 'El Nombre o el Apellido no es valido');
         }else{

        $cedula = $cedula * 1;
            
        if (($cedula < 2000000) || ($cedula > 200000000)){
            $respuesta = array('status' => false,'msg' => 'El número de cédula no es valido');
        }else {

        $sql = 'SELECT * FROM profesor WHERE cedula = ? AND profesor_id != ? AND estadopr !=0';
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula,$idprofesor));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result > 0){
            $respuesta = array('status' => false,'msg' => 'El profesor ya existe');
        } else {
            if($idprofesor == 0){
                $sqlInsert = 'INSERT INTO profesor (apellido,nombre,cedula,estadopr) VALUES (?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($apellido,$nombre,$cedula,$estadopr));
                $accion = 1;
            } else {
                    $sqlUpdate = 'UPDATE profesor SET apellido = ?,nombre = ?,cedula = ?,estadopr = ? WHERE profesor_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($apellido,$nombre,$cedula,$estadopr,$idprofesor));
                    $accion = 2;
                } 
            }
            
            if($request > 0) {
                if($accion == 1) {
                    $respuesta = array('status' => true,'msg' => 'Profesor creado correctamente');
                } else {
                    $respuesta = array('status' => true,'msg' => 'Profesor actualizado correctamente');
                }

            } else {
                $respuesta = array('status' => false,'msg' => 'Error al crear Profesor');
            }
        }
    }
}
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}