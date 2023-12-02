<?php
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';

    $sql = "SELECT * FROM materias WHERE estado != 0 ORDER BY año_seleccion";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();
?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Materias</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de materias</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablematerias">
                  <thead>
                    <tr>
                      <th>NOMBRE DE LA MATERIA</th>
                      <th>SIGLAS</th>
                      <th>AÑO</th>
                      <th>ESTADO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        if ($row > 0) {
                          while($data = $query->fetch()) {
                            
                      ?>
                      <tr>
                          <td><?= $data['nombre_materia'];?></td>
                          <td><?= $data['siglas'];?></td>
                          <td><?= $data['año_seleccion'];?></td>
                          <td><?php if($data['estado'] == 1){
                                  ?>    <span class="badge badge-success">Activo</span>
                                  <?php } elseif ($data['estadoes'] == 2){
                                  ?>    <span class="badge badge-danger">Inactivo</span>  
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