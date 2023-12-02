<?php
     if(!empty($_GET['curso'])) {
        $elaño = $_GET['curso'];
    }else {
      echo '<script> alert("Ups! No se a seleccionado correctamente el año")</script>';
    }
    if($elaño==1){
        $el_año="primer_año";
        $nom_año="Primer Año";
        $el_estado="statuspr";
        $el_id = "primero_id";

    }elseif($elaño==2){
        $el_año="segundo_año";
        $nom_año="Segundo Año";
        $el_estado="statussg";
        $el_id = "segundo_id";

    }elseif($elaño==3){
        $el_año="tercer_año";
        $nom_año="Tercer Año";
        $el_estado="statustr";
        $el_id = "tercer_id";

    }elseif($elaño==4){
        $el_año="cuarto_año";
        $nom_año="Cuarto Año";
        $el_estado="statuscr";
        $el_id = "cuarto_id";

    }elseif($elaño==5){
        $el_año="quinto_año";
        $nom_año="Quinto Año";
        $el_estado="statusqn";
        $el_id = "quinto_id";

    }else{
        echo'<script> alert("Ups! Algo a salido mal")</script>';
    }
    require_once '../includes/conexion.php';
    require_once 'includes/header.php';
    require_once 'includes/modals/modal_grupos_relacion.php';



  
      $sql = "SELECT * FROM $el_año as tb INNER JOIN alumnos as al ON tb.alumno_id = al.alumno_id INNER JOIN grupos as gp ON tb.grupos_id = gp.grupo_id INNER JOIN aulas as au ON tb.aula_id = au.aula_id INNER JOIN periodos as pe ON tb.periodo_id = pe.periodo_id  WHERE tb.$el_estado != 0 AND tb.grupos_id = NULL ORDER BY al.cedulaes";
      $query = $pdo->prepare($sql);
      $query->execute();
      $row = $query->rowCount();
   
?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Grupos de <?php echo $nom_año;?></h1>
            <button class="btn btn-success" type="button" onclick="openModalGruposRelacion()">Nueva Relacion</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de grupos</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablegruposrelacion">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>CEDULA</th>
                      <th>APELLIDO</th>
                      <th>NOMBRE</th>
                      <th>SEXO</th>
                      <th>SECCION</th>
                      <th>NOMGRE DEL GRUPO</th>
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
                            <button class="btn btn-primary btn-sm" title="Editar" onclick="editarGrupoRelacion('.$data[$el_id].')">Editar</button>
                            <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarGrupoRelacion('.$data[$el_id].')">Eliminar</button>
                                                ';
                        }elseif ($privilegios == 2){
                          $data['acciones'] = '
                          <button class="btn btn-primary btn-sm" title="Editar" onclick="editarGrupoRelacion('.$data[$el_id].')">Editar</button>
                          ';
                        }
                        echo $data['acciones'];
                        ?></td>
                        <td><?= $data['nacionalidad'], $data['cedulaes']; ?></td>
                        <td><?= $data['apellido_alumno'];?></td>
                        <td><?= $data['nombre_alumno'];?></td>
                        <td><?= $data['sexo'];?></td>
                        <td><?= $data['nombre_aula'];?></td>
                        <td><?= $data['nombre_grupo'];?></td>

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