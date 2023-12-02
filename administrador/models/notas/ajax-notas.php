<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['listMateria']) || empty($_POST['listPeriodo'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else { 
        if(!empty($_POST['nota1']) && !empty($_POST['nota2']) && !empty($_POST['nota3'])) {
            $nota1 = $_POST['nota1'];
            $nota2 = $_POST['nota2'];
            $nota3 = $_POST['nota3'];
            $promedio = $nota1 + $nota2 + $nota3;
            $promedio = $promedio/3;
        }else {
            $nota1 = $_POST['nota1'];
            $nota2 = $_POST['nota2'];
            $nota3 = $_POST['nota3'];
            $promedio = 0;
        }
        $idnotas = $_POST['idnotas'];
        $idcursante = $_POST['idcursante'];
        $idcurso = $_POST['idcurso'];
        $materia = $_POST['listMateria'];
        $periodo = $_POST['listPeriodo'];
        $estadonota = $_POST['estadonota'];
        $momento_nota = $_POST['momento_nota'];
        
        
        

        $sql = "SELECT * FROM notas WHERE nota_id != ? AND alumno_id = ? AND materia_id = ? AND periodo_id = ? AND curso = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($idnotas,$idcursante,$materia,$periodo,$idcurso));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result > 0){
            $respuesta = array('status' => false,'msg' => 'Error, la materia seleccionada ya existe para este estudiante en el periodo elegido.');
        } else {
            if($idnotas == 0){
                $sqlInsert = "INSERT INTO notas (alumno_id,materia_id,periodo_id,nota1,nota2,nota3,promedio,curso,estadonota,momento_nota) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($idcursante,$materia,$periodo,$nota1,$nota2,$nota3,$promedio,$idcurso,$estadonota,$momento_nota));
                $accion = 1;
            } else {
                    $sqlUpdate = 'UPDATE notas SET alumno_id = ?,materia_id = ?,periodo_id = ?,nota1 = ?,nota2 = ?,nota3 = ?,promedio = ?,curso = ?,estadonota = ?,momento_nota = ? WHERE nota_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($idcursante,$materia,$periodo,$nota1,$nota2,$nota3,$promedio,$idcurso,$estadonota,$momento_nota,$idnotas));
                    $accion = 2;
            }
            
            if($request > 0) {
                if($accion == 1) {
                    $respuesta = array('status' => true,'msg' => 'Nota creada correctamente');
                } else {
                    $respuesta = array('status' => true,'msg' => 'Nota actualizada correctamente');
                }

            } else {
                $respuesta = array('status' => false,'msg' => 'Error al crear la Nota');
            }
        }
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}