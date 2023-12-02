<?php
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    require_once 'includes/modals/modal_alumno.php';

    $sql = "SELECT * FROM alumnos WHERE estadoes != 0 ORDER BY cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();
?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Alumnos</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de alumnos</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablealumnos">
                  <thead>
                    <tr>
                      <th>CEDULA</th>
                      <th>APELLIDOS</th>
                      <th>NOMBRES</th>
                      <th>LUGAR DE NAC.</th>
                      <th>ENTIDAD FEDERAL</th>
                      <th>SEXO</th>
                      <th>FECHA DE NAC.</th>
                      <th>ESTADO</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      if ($row > 0) {
                        while($data = $query->fetch()) {
                          
                    ?>
                    <tr>
                        <td><?= $data['nacionalidad']; ?> <?= $data['cedulaes']; ?></td>
                        <td><?= $data['apellido_alumno'];?></td>
                        <td><?= $data['nombre_alumno'];?></td>
                        <td><?= $data['lugarNac']; ?></td>
                        <td><?= $data['entidadFederal']; ?></td>
                        <td><?= $data['sexo']; ?></td>
                        <td><?= $data['fecha_nac']; ?></td>


                        <td><?php if($data['estadoes'] == 1){
                                ?>    <span class="badge badge-success">Activo</span>
                                <?php } elseif ($data['estadoes'] == 2){
                                ?>    <span class="badge badge-danger">Inactivo</span>  
                                <?php } elseif ($data['estadoes'] == 3){
                                ?>    <span class="badge badge-info">Graduado</span>  
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