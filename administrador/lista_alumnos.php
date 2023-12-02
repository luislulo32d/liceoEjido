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
            <button class="btn btn-success" type="button" onclick="openModalAlumno()">Nuevo Alumno</button>
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
                      <th>ACCIONES</th>
                      <th>CEDULA ESTUDIANTIL</th>
                      <th>CEDULA DE IDENTIDAD</th>
                      <th>APELLIDOS</th>
                      <th>NOMBRES</th>
                      <th>LUGAR DE NACIMIENTO</th>
                      <th>MUNICIPIO DE NACIMIENTO</th>
                      <th>EF</th>
                      <th>SEXO</th>
                      <th>FECHA DE NACIMIENTO</th>
                      <th>ESTADO</th>
                      <th>TELEF. DE CONTACTO</th>
                      <th>DIRECCION</th>

                    </tr>
                   
          
                  </thead>
                  <tbody>
                  <?php
                      if ($row > 0) {
                        while($data = $query->fetch()) {
                          
                    ?>
                    <tr>
                    <td><?php 
                      if($privilegios == 1){
                        $data['acciones'] = '
                        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarAlumno('.$data['alumno_id'].')">Editar</button>
                        <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarAlumno('.$data['alumno_id'].')">Eliminar</button>
                                            ';
                      }if($privilegios == 2){
                        $data['acciones'] = '
                        <button class="btn btn-primary btn-sm" title="Editar" onclick="editarAlumno('.$data['alumno_id'].')">Editar</button>
                                            ';
                      }
                      echo $data['acciones'];
                      ?></td>
                        <td><?= $data['cedu_estudiantil'];?></td>
                        <td><?= $data['nacionalidad']; ?> <?= $data['cedulaes']; ?></td>
                        <td><?= $data['apellido_alumno'];?></td>
                        <td><?= $data['nombre_alumno'];?></td>
                        <td><?= $data['lugarNac']; ?></td>
                        <td><?= $data['municipio']; ?></td>
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

                        <td><?= $data['telefono_contacto']; ?></td>
                        <td><?= $data['direccion_vivienda']; ?></td>

                  
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