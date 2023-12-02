<?php
    if(!empty($_GET['seccion']) && !empty($_GET['nombreSeccion'])) {
      $seccion = $_GET['seccion'];
      $nombreSeccion = $_GET['nombreSeccion'];
  }else {
    echo '<script> alert("Ups! No se a seleccionado correctamente la sección o el año")</script>';
  }
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    require_once 'includes/modals/modal_primer_año.php';

    $sql = "SELECT * FROM primer_año as pa INNER JOIN grupos as gp ON pa.grupo_id = gp.grupo_id INNER JOIN alumnos as al ON pa.alumno_id = al.alumno_id INNER JOIN aulas as au ON pa.aula_id = au.aula_id INNER JOIN periodos as pe ON pa.periodo_id = pe.periodo_id  WHERE pa.statuspr != 0 AND pa.aula_id = $seccion AND pe.estado = 1 ORDER BY al.cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();
   
?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Alumnos de Primer Año Seccion <?php echo $nombreSeccion?></h1>
            <button class="btn btn-success" type="button" onclick="openModalPrimer()">Nuevo Registro</button>
            <a href="seleccion_notas.php?curso=1" class="btn btn-info">Generar Notas</a>
            <a href="nomina_estudiantil.php?curso=1&aul=<?php echo $nombreSeccion;?>&aulid=<?php echo $seccion;?>" class="btn btn-info">Generar Nomina Estudiantil</a>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="seleccion_primer_año.php">Seleccion Primer Año</a></li>
          <li class="breadcrumb-item"><a href="#">lista de Primer Año</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableprimeraño">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>NUM DE LISTA</th>
                      <th>CEDULA ESTUDIANTIL</th>
                      <th>CEDULA DE IDENTIDAD</th>
                      <th>APELLIDO DEL ALUMNO</th>
                      <th>NOMBRE DEL ALUMNO</th>
                      <th>SEXO</th>
                      <th>GRUPO ESTABLE</th>
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
                            <button class="btn btn-primary btn-sm" title="Editar" onclick="editarPrimerAño('.$data['primero_id'].')">Editar</button>
                            <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarPrimerAño('.$data['primero_id'].')">Eliminar</button>
                            <a href="lista_notas.php?seccion='.$seccion.'&curso=1&cursante='.$data['alumno_id'].'&cedu='.$data['cedulaes'].'&nombrestu='.$data['nombre_alumno'].'&apellistu='.$data['apellido_alumno'].'&nacionstu='.$data['nacionalidad'].'&fecnac='.$nacimientofe.'&feces='.$data['nombre_periodo'].'&nomsecci='.$nombreSeccion.'&numelis='.$data['numero_lista'].'&elPerio='.$data['periodo_id'].'" class="btn btn-info btn-sm">Ver Notas</a>
                                                ';
                        }elseif ($privilegios == 2){
                          $data['acciones'] = '
                          <button class="btn btn-primary btn-sm" title="Editar" onclick="editarPrimerAño('.$data['primero_id'].')">Editar</button>
                            <a href="lista_notas.php?seccion='.$seccion.'&curso=1&cursante='.$data['alumno_id'].'&cedu='.$data['cedulaes'].'&nombrestu='.$data['nombre_alumno'].'&apellistu='.$data['apellido_alumno'].'&nacionstu='.$data['nacionalidad'].'&fecnac='.$nacimientofe.'&feces='.$data['nombre_periodo'].'&nomsecci='.$nombreSeccion.'&numelis='.$data['numero_lista'].'&elPerio='.$data['periodo_id'].'" class="btn btn-info btn-sm">Ver Notas</a>
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
                        <td><?= $data['nombre_grupo'];?></td>
                        <td><?php if($data['estado'] != 1){
                                    ?> <span class="badge badge-danger"><?php echo $data['nombre_periodo'];?> </span>
                            <?php } elseif($data['statuspr'] == 1){
                                ?>    <span class="badge badge-success">Activo <?php echo $data['nombre_periodo'];?></span>
                                <?php } elseif ($data['statuspr'] == 2){
                                ?>    <span class="badge badge-primary">Repitente <?php echo $data['nombre_periodo'];?></span>  
                                <?php } elseif ($data['statuspr'] == 3){
                                ?>    <span class="badge badge-info">Activo Remedial</span>  
                                <?php } elseif ($data['statuspr'] == 4){
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