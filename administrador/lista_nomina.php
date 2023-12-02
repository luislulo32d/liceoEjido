<?php
    if(!empty($_GET['elaño']) && !empty($_GET['alumnos'])) {
      $elaño = $_GET['elaño'];
      $alumnos = $_GET['alumnos'];
  }else {
    echo '<script> alert("Ups! No se a seleccionado correctamente el año")</script>';
  }
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    //require_once 'generar_nomina.php';

    if($elaño==1){
        $el_año="primer_año";
        $nom_año="Primer Año";
        $el_estado="statuspr";
        $materiPendiente=2;
    }elseif($elaño==2){
        $el_año="segundo_año";
        $nom_año="Segundo Año";
        $el_estado="statussg";
        $materiPendiente=1;
    }elseif($elaño==3){
        $el_año="tercer_año";
        $nom_año="Tercer Año";
        $el_estado="statustr";
        $materiPendiente=1;
    }elseif($elaño==4){
        $el_año="cuarto_año";
        $nom_año="Cuarto Año";
        $el_estado="statuscr";
        $materiPendiente=1;
    }elseif($elaño==5){
        $el_año="quinto_año";
        $nom_año="Quinto Año";
        $el_estado="statusqn";
        $materiPendiente=1;
    }else{
        echo'<script> alert("Ups! Algo a salido mal")</script>';
    }

    if($alumnos==1){
        $sql = "SELECT * FROM $el_año as pa INNER JOIN alumnos as al ON pa.alumno_id = al.alumno_id INNER JOIN aulas as au ON pa.aula_id = au.aula_id INNER JOIN periodos as pe ON pa.periodo_id = pe.periodo_id  WHERE pa.$el_estado != 0 ORDER BY al.cedulaes";
    }elseif($alumnos==2){
        $sql = "SELECT * FROM $el_año as pa INNER JOIN alumnos as al ON pa.alumno_id = al.alumno_id INNER JOIN aulas as au ON pa.aula_id = au.aula_id INNER JOIN periodos as pe ON pa.periodo_id = pe.periodo_id  WHERE pa.$el_estado != 0 AND pe.estado = 1 ORDER BY al.cedulaes";
    }else{
        echo'<script> alert("Ups! Algo a salido mal")</script>';
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();
   


?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Alumnos de Primer Año Seccion <?php echo $nom_año;?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de <?php echo $nom_año;?></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablenomina">
                  <thead>
                    
                    <tr>
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
                       
                        <td><?= $data['numero_lista']; ?></td>
                        <td><?= $data['nacionalidad'], $data['cedulaes']; ?></td>
                        <td><?= $data['apellido_alumno'];?></td>
                        <td><?= $data['nombre_alumno'];?></td>
                        <td><?= $data['sexo'];?></td>
                        <td><?php if($data['estado'] != 1){
                                    ?> <span class="badge badge-danger"><?php echo $data['nombre_periodo'];?> </span>
                            <?php } elseif($data['statuspr'] == 1){
                                ?>    <span class="badge badge-success"><?php echo $data['nombre_periodo'];?></span>
                                <?php } elseif ($data['statuspr'] == 2){
                                ?>    <span class="badge badge-danger">Inactivo</span>  
                                <?php } elseif ($data['statuspr'] == 3){
                                ?>    <span class="badge badge-info">Activo Remedial</span>  
                                <?php } elseif ($data['statuspr'] == 4){
                                ?>    <span class="badge badge-warning">Activo Materia Pendiente</span>  
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