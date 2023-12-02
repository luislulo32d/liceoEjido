<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT * FROM profesor WHERE estadopr != 0";
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0; $i < count($consulta);$i++) {
    if($consulta[$i]['estadopr'] == 1){
        $consulta[$i]['estadopr'] = '<span class="badge badge-success">Activo</span>';  
    } else{
        $consulta[$i]['estadopr'] = '<span class="badge badge-danger">Inactivo</span>';  
    }

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarProfesor('.$consulta[$i]['profesor_id'].')">Editar</button>
        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarProfesor('.$consulta[$i]['profesor_id'].')">Eliminar</button>
                                ';
}

echo json_encode($consulta,JSON_UNESCAPED_UNICODE);