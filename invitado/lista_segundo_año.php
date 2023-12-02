<?php
    if(!empty($_GET['seccion']) && !empty($_GET['nombreSeccion'])) {
      $seccion = $_GET['seccion'];
      $nombreSeccion = $_GET['nombreSeccion'];
  }else {
    echo '<script> alert("Ups! No se a seleccionado correctamente la sección o el año")</script>';
  }
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';

    $sql = "SELECT * FROM segundo_año as sg INNER JOIN alumnos as al ON sg.alumno_id = al.alumno_id INNER JOIN aulas as au ON sg.aula_id = au.aula_id INNER JOIN periodos as pe ON sg.periodo_id = pe.periodo_id  WHERE sg.statussg != 0 AND sg.aula_id = $seccion ORDER BY al.cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();

?>

<main class="app-content">
      <div class="app-title">
        <div>
        <h1><i class="fa fa-dashboard"></i> Lista de Alumnos de Segundo Año Seccion <?php echo $nombreSeccion?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de Segundo Año</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablesegundoaño">
                  <thead>
                    <tr>
                      <th>VER NOTAS</th>
                      <th>NUM DE LISTA</th>
                      <th>CEDULA</th>
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
                            $data['acciones'] = '
                            <a href="lista_notas.php?seccion='.$seccion.'&curso=2&cursante='.$data['alumno_id'].'&cedu='.$data['cedulaes'].'&nombrestu='.$data['nombre_alumno'].'&apellistu='.$data['apellido_alumno'].'&nacionstu='.$data['nacionalidad'].'&fecnac='.$nacimientofe.'&feces='.$data['nombre_periodo'].'&nomsecci='.$nombreSeccion.'&numelis='.$data['numero_lista'].'&elPerio='.$data['periodo_id'].'" class="btn btn-info btn-sm">Ver Notas</a>
                                                ';
                        echo $data['acciones'];
                        ?></td>
                        <td><?= $data['numero_lista']; ?></td>
                        <td><?= $data['nacionalidad'], $data['cedulaes']; ?></td>
                        <td><?= $data['apellido_alumno'];?></td>
                        <td><?= $data['nombre_alumno'];?></td>
                        <td><?= $data['sexo'];?></td>
                        <td><?php if($data['estado'] != 1){
                                    ?> <span class="badge badge-danger"><?php echo $data['nombre_periodo'];?> </span>
                            <?php } elseif($data['statussg'] == 1){
                                ?>    <span class="badge badge-success">Activo</span>
                                <?php } elseif ($data['statussg'] == 2){
                                ?>    <span class="badge badge-danger">Inactivo</span>  
                                <?php } elseif ($data['statussg'] == 3){
                                ?>    <span class="badge badge-info">Activo Remedial</span>  
                                <?php } elseif ($data['statussg'] == 4){
                                ?>    <span class="badge badge-warning">Activo Materia Pendiente</span>  
                                <?php } elseif ($data['statussg'] == 5){
                                ?>    <span class="badge badge-primary">Aprobado</span>       
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