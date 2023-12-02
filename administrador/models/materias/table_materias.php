<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT * FROM materias WHERE estado != 0 ORDER BY año_seleccion,materia_id,nombre_materia";
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0; $i < count($consulta);$i++) {
    if($consulta[$i]['estado'] == 1){
        $consulta[$i]['estado'] = '<span class="badge badge-success">Activo</span>';  
    } else{
        $consulta[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';  
    }

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarMateria('.$consulta[$i]['materia_id'].')">Editar</button>
        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarMateria('.$consulta[$i]['materia_id'].')">Eliminar</button>
                                ';
}

echo json_encode($consulta,JSON_UNESCAPED_UNICODE);