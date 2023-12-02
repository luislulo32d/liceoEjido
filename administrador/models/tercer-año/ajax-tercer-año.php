<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['listEstudiante']) || empty($_POST['listAula']) || empty($_POST['listPeriodo']) || empty($_POST['listNumero'] || empty($_POST['listEstado']))) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idterceraño = $_POST['idterceraño'];
        $estudiante = $_POST['listEstudiante'];
        $aula = $_POST['listAula'];
        $periodo = $_POST['listPeriodo'];
        $listNumero = $_POST['listNumero'];
        $grupo = $_POST['listGrupos'];
        $estado = $_POST['listEstado'];

      
        $sql = "SELECT * FROM tercer_año WHERE tercer_id != ? AND alumno_id = ? AND periodo_id = ? AND statustr != 0 OR numero_lista = ? AND tercer_id != ? AND aula_id = ? AND periodo_id = ? AND statustr != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($idterceraño,$estudiante,$periodo,$listNumero,$idterceraño,$aula,$periodo));
        $result = $query->fetch(PDO::FETCH_ASSOC);


        if($result > 0){
            $respuesta = array('status' => false,'msg' => 'Error, El estudiante ya esta registrado en una sección de tercer año o él número de lista está repetido.');
        } else {
            if($idterceraño == 0){
                $sqlInsert = "INSERT INTO tercer_año (alumno_id,aula_id,periodo_id,numero_lista,statustr,grupo_id) VALUES (?,?,?,?,?,?)";
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($estudiante,$aula,$periodo,$listNumero,$estado,$grupo));
                $accion = 1;
            } else {
                    $sqlUpdate = 'UPDATE tercer_año SET alumno_id = ?,aula_id = ?,periodo_id = ?,numero_lista = ?,statustr = ?,grupo_id = ? WHERE tercer_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($estudiante,$aula,$periodo,$listNumero,$estado,$grupo,$idterceraño));
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