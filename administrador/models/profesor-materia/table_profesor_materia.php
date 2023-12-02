<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT * FROM profesor_materias as pm INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN materias as m ON pm.materia_id = m.materia_id INNER JOIN periodos as pe ON pm.periodo_id = pe.periodo_id WHERE pm.estado_profesor_materia != 0";
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0; $i < count($consulta);$i++) {
    if($consulta[$i]['estado_profesor_materia'] == 1){
        $consulta[$i]['estado_profesor_materia'] = '<span class="badge badge-success">Activo</span>';  
    } else{
        $consulta[$i]['estado_profesor_materia'] = '<span class="badge badge-danger">Inactivo</span>';  
    }

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarProfesorMateria('.$consulta[$i]['estado_profesor_materia'].')">Editar</button>
        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarProfesorMateria('.$consulta[$i]['estado_profesor_materia'].')">Eliminar</button>
                                ';
}

echo json_encode($consulta,JSON_UNESCAPED_UNICODE);