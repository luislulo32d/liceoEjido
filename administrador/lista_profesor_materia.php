<?php
    
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    require_once 'includes/modals/modal_profesor_materia.php';

    $sql = "SELECT * FROM profesor_materias as pm INNER JOIN profesor as pf ON pm.profesor_id = pf.profesor_id INNER JOIN aulas as au ON pm.aula_id = au.aula_id INNER JOIN materias as mt ON pm.materia_id = mt.materia_id WHERE pm.estado_profesor_materia != 0 ORDER BY pf.cedula";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();

?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Profesor Materia</h1>
            <button class="btn btn-success" type="button" onclick="openModalProfesorMateria()">Registrar</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de profesor materia</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableprofesormateria">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>CEDULA</th>
                      <th>APELLIDO</th>
                      <th>NOMBRE</th>
                      <th>MATERIA</th>
                      <th>SIGLAS</th>
                      <th>AÑO</th>
                      <th>SECCION</th>
                      <th>N° EVALUACIONES</th>
                      <th>ESTADO</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      if ($row > 0) {
                        while($data = $query->fetch()) {
                    ?>
                      <tr>
                        <td><?php
                        if ($privilegios == 1){
                            $data['acciones'] = '
                            <button class="btn btn-primary btn-sm" title="Editar" onclick="editarProfesorMateria('.$data['profesor_materia_id'].')">Editar</button>
                            <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarProfesorMateria('.$data['profesor_materia_id'].')">Eliminar</button>
                            <a href="nomina.php?apell='.$data['apellido'].'&nom='.$data['nombre'].'&ced='.$data['cedula'].'&curso='.$data['año_seleccion'].'&materi='.$data['nombre_materia'].'&aul='.$data['nombre_aula'].'&aulid='.$data['aula_id'].'&sig='.$data['siglas'].'&eva='.$data['evaluaciones'].'" class="btn btn-info btn-sm">Ver Nomina</a>
                                                ';
                        }elseif ($privilegios == 2){
                          $data['acciones'] = '
                          <button class="btn btn-primary btn-sm" title="Editar" onclick="editarProfesorMateria('.$data['profesor_materia_id'].')">Editar</button>
                          <a href="nomina.php?apell='.$data['apellido'].'&nom='.$data['nombre'].'&ced='.$data['cedula'].'&curso='.$data['año_seleccion'].'&materi='.$data['nombre_materia'].'&aul='.$data['nombre_aula'].'&aulid='.$data['aula_id'].'&sig='.$data['siglas'].'&eva='.$data['evaluaciones'].'" class="btn btn-info btn-sm">Ver Nomina</a>
                          ';
                        }
                        echo $data['acciones'];
                        ?></td>
                        <td><?= $data['cedula']; ?></td>
                        <td><?= $data['apellido'];?></td>
                        <td><?= $data['nombre'];?></td>
                        <td><?= $data['nombre_materia'];?></td>
                        <td><?= $data['siglas'];?></td>
                        <td><?= $data['año_seleccion'];?></td>
                        <td><?= $data['nombre_aula'];?></td>
                        <td><?= $data['evaluaciones'];?></td>
                        <td><?php if($data['estado_profesor_materia'] != 1){
                                    ?> <span class="badge badge-danger">Inactivo</span>
                            <?php } elseif($data['estado_profesor_materia'] == 1){
                                ?>    <span class="badge badge-success">Activo</span>
                                <?php } ?>                
                        </td>


                      </tr>

                    <?php } } ?>
                
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>


<?php
    require_once 'includes/footer.php';
?>