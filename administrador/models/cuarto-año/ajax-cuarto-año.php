<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['listEstudiante']) || empty($_POST['listAula']) || empty($_POST['listPeriodo']) || empty($_POST['listNumero'] || empty($_POST['listEstado']))) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idcuartoaño = $_POST['idcuartoaño'];
        $estudiante = $_POST['listEstudiante'];
        $aula = $_POST['listAula'];
        $periodo = $_POST['listPeriodo'];
        $listNumero = $_POST['listNumero'];
        $grupo = $_POST['listGrupos'];
        $estado = $_POST['listEstado'];

      
        $sql = "SELECT * FROM cuarto_año WHERE cuarto_id != ? AND alumno_id = ? AND periodo_id = ? AND statuscr != 0 OR numero_lista = ? AND cuarto_id != ? AND aula_id = ? AND periodo_id = ? AND statuscr != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($idcuartoaño,$estudiante,$periodo,$listNumero,$idcuartoaño,$aula,$periodo));
        $result = $query->fetch(PDO::FETCH_ASSOC);


        if($result > 0){
            $respuesta = array('status' => false,'msg' => 'Error, El estudiante ya esta registrado en una sección de cuarto año o él número de lista está repetido.');
        } else {
            if($idcuartoaño == 0){
                $sqlInsert = "INSERT INTO cuarto_año (alumno_id,aula_id,periodo_id,numero_lista,statuscr,grupo_id) VALUES (?,?,?,?,?,?)";
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($estudiante,$aula,$periodo,$listNumero,$grupo,$estado));
                $accion = 1;
            } else {
                    $sqlUpdate = 'UPDATE cuarto_año SET alumno_id = ?,aula_id = ?,periodo_id = ?,numero_lista = ?,statuscr = ?,grupo_id = ? WHERE cuarto_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($estudiante,$aula,$periodo,$listNumero,$estado,$grupo,$idcuartoaño));
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
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}