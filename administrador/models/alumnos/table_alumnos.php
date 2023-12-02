<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT * FROM alumnos WHERE estadoes != 0";
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0; $i < count($consulta);$i++) {
    if($consulta[$i]['estadoes'] == 1){
        $consulta[$i]['estadoes'] = '<span class="badge badge-success">Activo</span>';  
    }else if($consulta[$i]['estadoes'] == 2) {
        $consulta[$i]['estadoes'] = '<span class="badge badge-danger">Inactivo</span>';  
    }else if($consulta[$i]['estadoes'] == 3){
        $consulta[$i]['estadoes'] = '<span class="badge badge-info">Graduado</span>';  
    }
    

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarAlumno('.$consulta[$i]['alumno_id'].')">Editar</button>
        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarAlumno('.$consulta[$i]['alumno_id'].')">Eliminar</button>
                                ';
}

echo json_encode($consulta,JSON_UNESCAPED_UNICODE);