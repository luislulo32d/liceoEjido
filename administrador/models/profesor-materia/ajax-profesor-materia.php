<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['listProfesor']) || empty($_POST['listAula']) || empty($_POST['listMateriaProfesor'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idprofesormateria = $_POST['idprofesormateria'];
        $profesor = $_POST['listProfesor'];
        $aula = $_POST['listAula'];
        $materia = $_POST['listMateriaProfesor'];
        $evaluaciones = $_POST['listEvaluaciones'];
        $status = $_POST['listEstado'];

        $sql = "SELECT * FROM profesor_materias WHERE profesor_id = ? AND aula_id = ? AND materia_id = ? AND evaluaciones = ? AND estado_profesor_materia = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($profesor,$aula,$materia,$evaluaciones,$status));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result > 0){
            $respuesta = array('status' => false,'msg' => 'El profesor ya cuenta con la relación seleccionada, realice otra relación.');
        } else {
            if($idprofesormateria == 0){
                $sqlInsert = "INSERT INTO profesor_materias (profesor_id,aula_id,materia_id,evaluaciones,estado_profesor_materia) VALUES (?,?,?,?,?)";
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($profesor,$aula,$materia,$evaluaciones,$status));
                $accion = 1;
            } else {
                    $sqlUpdate = "UPDATE profesor_materias SET profesor_id = ?,aula_id = ?,materia_id = ?,estado_profesor_materia = ?,evaluaciones = ? WHERE profesor_materia_id = ?";
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($profesor,$aula,$materia,$status,$evaluaciones,$idprofesormateria));
                    $accion = 2;
            }
            
            if($request > 0) {
                if($accion == 1) {
                    $respuesta = array('status' => true,'msg' => 'Proceso creado correctamente');
                } else {
                    $respuesta = array('status' => true,'msg' => 'Proceso actualizado correctamente');
                }

            } else {
                $respuesta = array('status' => false,'msg' => 'Error al crear el proceso');
            }
        }
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}