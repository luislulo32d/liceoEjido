<?php

    if(!empty($_GET['anio'])) {
      $anio = $_GET['anio'];
    }else {
      echo '<script> alert("Ups! No se a seleccionado correctamente el año")</script>';
    }

    if ($anio == 1) {
      $nombre_año = "PRIMER AÑO";
      $nombre_tabla = "primer_año";

    }elseif ($anio == 2) {
      $nombre_año = "SEGUNDO AÑO";
      $nombre_tabla = "segundo_año";
      
    }elseif ($anio == 3) {
      $nombre_año = "TERCER AÑO";
      $nombre_tabla = "tercer_año";
      
    }elseif ($anio == 4) {
      $nombre_año = "CUARTO AÑO";
      $nombre_tabla = "cuarto_año";
    
    }elseif ($anio == 5) {
      $nombre_año = "QUINTO AÑO / GRADUADOS";
      $nombre_tabla = "quinto_año";
    
    }else {
      echo '<script> alert("Ups! No se a seleccionado correctamente el año")</script>';
      $nombre_año = "ERROR, SE MOSTRARÁN LOS DATOS DE 5to AÑO";
      $nombre_tabla = "quinto_año";
      $anio = 5;
      
    }
    $meses = array(" DE ENERO DEL "," DE FEBRERO DEL ","DE MARZO DEL "," DE ABRIL DEL "," DE MAYO DEL "," DE JUNIO DEL "," DE JULIO DEL "," DE AGOSTO DEL "," DE SEPTIEMBRE DEL "," DE OCTUBRE DEL "," DE NOVIEMBRE DEL "," DE DICIEMBRE DEL ");

    require_once 'includes/header.php';
    require_once '../includes/conexion.php';

    $dia_hoy = date("d");
    $mes_hoy = date("n");
    $año_hoy = date("Y");

    $fecha_hoy = $dia_hoy.$meses[$mes_hoy-1].$año_hoy;



    $sql = "SELECT * FROM $nombre_tabla as sg INNER JOIN alumnos as al ON sg.alumno_id = al.alumno_id INNER JOIN aulas as au ON sg.aula_id = au.aula_id INNER JOIN periodos as pe ON sg.periodo_id = pe.periodo_id ORDER BY sg.periodo_id, al.cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();

    
?>

<main class="app-content">
      <div class="app-title">
        <div>
           <h1><i class="fa fa-dashboard"></i> <?php echo $nombre_año;?> </h1>
          </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">NOTAS CERTIFICADAS <?php echo $nombre_año?></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablequintoaño">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>CEDULA DE IDENTIDAD</th>
                      <th>APELLIDO DEL ALUMNO</th>
                      <th>NOMBRE DEL ALUMNO</th>
                      <th>SEXO</th>
                      <th>PERIODO ESCOLAR</th>
                      <th>ESTADO</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                     if ($row > 0) {
                        while($data = $query->fetch()) {
                        
                        $diafe = date("d", strtotime($data['fecha_nac']));
                        $mesfe = date("n", strtotime($data['fecha_nac']));
                        $añofe = date("Y", strtotime($data['fecha_nac']));
                        
 

                        $nacimientofeES = $diafe.$meses[$mesfe-1].$añofe;
                    ?>
                      <tr>
                        <td>
                          <?php 
                            $data['acciones'] = '
                            <a href="generar_notas_certificadas.php?cursante='.$data['alumno_id'].'&cedu='.$data['cedulaes'].'&nombrestu='.$data['nombre_alumno'].'&apellistu='.$data['apellido_alumno'].'&nacionstu='.$data['nacionalidad'].'&fecnac='.$nacimientofeES.'&nomPerio='.$data['nombre_periodo'].'&elPerio='.$data['periodo_id'].'&anio='.$anio.'&eF='.$data['lugarNac'].'&mun='.$data['municipio'].'&fecha_hoy='.$fecha_hoy.'" class="btn btn-info btn-sm">N. C.</a>
                                                ';
                            echo $data['acciones'];
                            
                                          
                          ?>
                        </td>
                        <td><?= $data['nacionalidad'], $data['cedulaes']; ?></td>
                        <td><?= $data['apellido_alumno'];?></td>
                        <td><?= $data['nombre_alumno'];?></td>
                        <td><?= $data['sexo'];?></td>
                        <td><?= $data['nombre_periodo']?></td>
                        <td><?php if($data['estadoes'] == 1){
                                ?>    <span class="badge badge-success">Activo</span>
                                <?php } elseif ($data['estadoes'] == 2){
                                ?>    <span class="badge badge-danger">Inactivo</span>  
                                <?php } elseif ($data['estadoes'] == 3){
                                ?>    <span class="badge badge-info">Graduado</span>  
                                <?php } ?></td>


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