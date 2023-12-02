<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT * FROM grupos WHERE estado_grupos != 0 ORDER BY nombre_grupo,grupo_id";
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0; $i < count($consulta);$i++) {
    if($consulta[$i]['estado_grupos'] == 1){
        $consulta[$i]['estado_grupos'] = '<span class="badge badge-success">Activo</span>';  
    } else{
        $consulta[$i]['estado_grupos'] = '<span class="badge badge-danger">Inactivo</span>';  
    }

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarGrupo('.$consulta[$i]['grupo_id'].')">Editar</button>
        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarGrupos('.$consulta[$i]['grupo_id'].')">Eliminar</button>
                                ';
}

echo json_encode($consulta,JSON_UNESCAPED_UNICODE);