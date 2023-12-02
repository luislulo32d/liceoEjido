<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT * FROM primer_año as pa INNER JOIN alumnos as al ON pa.alumno_id = al.alumno_id INNER JOIN aulas as au ON pa.aula_id = au.aula_id INNER JOIN periodos as pe ON pa.periodo_id = pe.periodo_id  WHERE pa.statuspr != 0";
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetch();

for($i = 0; $i < count($consulta);$i++) {
    if($consulta[$i]['statuspr'] == 1){
        $consulta[$i]['statuspr'] = '<span class="badge badge-success">Activo</span>';  
    } else if ($consulta[$i]['statuspr'] == 2){
        $consulta[$i]['statuspr'] = '<span class="badge badge-danger">Inactivo</span>';  
    } else if ($consulta[$i]['statuspr'] == 3){
        $consulta[$i]['statuspr'] = '<span class="badge badge-info">Remedial</span>';  
    } else if ($consulta[$i]['statuspr'] == 4){
        $consulta[$i]['statuspr'] = '<span class="badge badge-warning">Materia de Arrastre</span>';  
    }

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarPrimerAño('.$consulta[$i]['primero_id'].')">Editar</button>
        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarPrimerAño('.$consulta[$i]['primero_id'].')">Eliminar</button>
                                ';
}

echo json_encode($consulta,JSON_UNESCAPED_UNICODE);