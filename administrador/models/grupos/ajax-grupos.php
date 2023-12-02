<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['nombre'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idgrupo = $_POST['idgrupo'];
        $nombre = $_POST['nombre'];
        $estado = $_POST['listEstado'];
        $comprobanteGrupos = 0;
        $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ_, ÁÉÍÓÚ";



        for($i=0; $i<strlen($nombre); $i++){
            if (strpos($permitidos, substr($nombre,$i,1))===false){
                $comprobanteGrupos = 1;
            }
         }
         
         if($comprobanteGrupos == 1){
            $respuesta = array('status' => false,'msg' => 'Nombre Invalido');
         }else{

        $sql = 'SELECT * FROM grupos WHERE nombre_grupo = ? AND grupo_id != ? AND estado_grupos !=0';
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idgrupo));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result > 0){
            $respuesta = array('status' => false,'msg' => 'El grupo ya existe');
        } else {
            if($idgrupo == 0){
                $sqlInsert = 'INSERT INTO grupos (nombre_grupo,estado_grupos) VALUES (?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $accion = 1;
            } else {
                    $sqlUpdate = 'UPDATE grupos SET nombre_grupo = ?,estado_grupos = ? WHERE grupo_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$estado,$idgrupo));
                    $accion = 2;
            }
            
            if($request > 0) {
                if($accion == 1) {
                    $respuesta = array('status' => true,'msg' => 'Grupo creado correctamente');
                } else {
                    $respuesta = array('status' => true,'msg' => 'Grupo actualizado correctamente');
                }

            } else {
                $respuesta = array('status' => false,'msg' => 'Error al crear Grupo');
            }
        }
    }
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}