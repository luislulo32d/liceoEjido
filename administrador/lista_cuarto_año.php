<?php
    if(!empty($_GET['seccion']) && !empty($_GET['nombreSeccion'])) {
      $seccion = $_GET['seccion'];
      $nombreSeccion = $_GET['nombreSeccion'];
  }else {
    echo '<script> alert("No se a seleccionado correctamente el estudiante, su sección o su curso")</script>';
  }
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    require_once 'includes/modals/modal_cuarto_año.php';

    $sql = "SELECT * FROM cuarto_año as sg INNER JOIN alumnos as al ON sg.alumno_id = al.alumno_id INNER JOIN aulas as au ON sg.aula_id = au.aula_id INNER JOIN periodos as pe ON sg.periodo_id = pe.periodo_id  WHERE sg.statuscr != 0 AND sg.aula_id = $seccion ORDER BY al.cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();

?>

<main class="app-content">
      <div class="app-title">
        <div>
        <h1><i class="fa fa-dashboard"></i> Lista de Alumnos de Cuarto Año Seccion <?php echo $nombreSeccion?></h1>
            <button class="btn btn-success" type="button" onclick="openModalCuarto()">Nuevo Registro</button>
            <a href="seleccion_notas.php?curso=4" class="btn btn-info">Generar Notas</a>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="seleccion_cuarto_año.php">Seleccion Cuarto Año</a></li>
          <li class="breadcrumb-item"><a href="#">lista de Cuarto Año</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablecuartoaño">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>NUM DE LISTA</th>
                      <th>CEDULA ESTUDIANTIL</th>
                      <th>CEDULA DE IDENTIDAD</th>
                      <th>APELLIDO DEL ALUMNO</th>
                      <th>NOMBRE DEL ALUMNO</th>
                      <th>SEXO</th>
                      <th>ESTADO</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      if ($row > 0) {
                        while($data = $query->fetch()) {
                        $nacimientofe = date("d-m-Y", strtotime($data['fecha_nac']));
                    ?>
                      <tr>
                        <td><?php
                        if ($privilegios == 1){
                            $data['acciones'] = '
                            <button class="btn btn-primary btn-sm" title="Editar" onclick="editarCuartoAño('.$data['cuarto_id'].')">Editar</button>
                            <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarCuartoAño('.$data['cuarto_id'].')">Eliminar</button>
                            <a href="lista_notas.php?seccion='.$seccion.'&curso=4&cursante='.$data['alumno_id'].'&cedu='.$data['cedulaes'].'&nombrestu='.$data['nombre_alumno'].'&apellistu='.$data['apellido_alumno'].'&nacionstu='.$data['nacionalidad'].'&fecnac='.$nacimientofe.'&feces='.$data['nombre_periodo'].'&nomsecci='.$nombreSeccion.'&numelis='.$data['numero_lista'].'&elPerio='.$data['periodo_id'].'" class="btn btn-info btn-sm">Ver Notas</a>
                                                ';
                        }elseif ($privilegios == 2){
                          $data['acciones'] = '
                          <a href="lista_notas.php?seccion='.$seccion.'&curso=4&cursante='.$data['alumno_id'].'&cedu='.$data['cedulaes'].'&nombrestu='.$data['nombre_alumno'].'&apellistu='.$data['apellido_alumno'].'&nacionstu='.$data['nacionalidad'].'&fecnac='.$nacimientofe.'&feces='.$data['nombre_periodo'].'&nomsecci='.$nombreSeccion.'&numelis='.$data['numero_lista'].'&elPerio='.$data['periodo_id'].'" class="btn btn-info btn-sm">Ver Notas</a>
                                              ';
                        }
                        echo $data['acciones'];
                        ?></td>
                        <td><?= $data['numero_lista']; ?></td>
                        <td><?= $data['cedu_estudiantil'];?></td>
                        <td><?= $data['nacionalidad'], $data['cedulaes']; ?></td>
                        <td><?= $data['apellido_alumno'];?></td>
                        <td><?= $data['nombre_alumno'];?></td>
                        <td><?= $data['sexo'];?></td>
                        <td><?php if($data['estado'] != 1){
                                    ?> <span class="badge badge-danger"><?php echo $data['nombre_periodo'];?> </span>
                            <?php } elseif($data['statuscr'] == 1){
                                ?>    <span class="badge badge-success">Activo <?php echo $data['nombre_periodo'];?></span>
                                <?php } elseif ($data['statuscr'] == 2){
                                ?>    <span class="badge badge-primary">Repitente <?php echo $data['nombre_periodo'];?></span>  
                                <?php } elseif ($data['statuscr'] == 3){
                                ?>    <span class="badge badge-info">Activo Remedial</span>  
                                <?php } elseif ($data['statuscr'] == 4){
                                ?>    <span class="badge badge-warning">Activo Materia Pendiente</span>  
                                <?php } else{ ?>
                                      <span class= "badge badge-danger"><?php echo $data['nombre_periodo'];?></span>
                                <?php }?>                
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