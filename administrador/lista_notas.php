<?php
    if(!empty($_GET['seccion']) ||!empty($_GET['curso']) ||!empty($_GET['cursante']) ||!empty($_GET['cedu']) || !empty($_GET['nombrestu']) || !empty($_GET['apellistu']) || !empty($_GET['nacionstu']) || !empty($_GET['fecnac']) || !empty($_GET['feces']) || !empty($_GET['nomsecci']) || !empty($_GET['numelis']) || !empty($_GET['elPerio'])) {
        $seccion = $_GET['seccion'];
        $curso = $_GET['curso'];
        $cursante = $_GET['cursante'];
        $cedu = $_GET['cedu'];
        $nombrestu = $_GET['nombrestu'];
        $apellistu = $_GET['apellistu'];
        $nacionalidad = $_GET['nacionstu'];
        $fechaNacimiento = $_GET['fecnac'];
        $fechaEscolar = $_GET['feces'];
        $nombreSeccion = $_GET['nomsecci'];
        $numeroLista = $_GET['numelis'];
        $elPeriodo = $_GET['elPerio'];
    } else {
      echo '<script> alert("No se a seleccionado correctamente el estudiante, su sección o su año")</script>';
      
    }
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    require_once 'includes/modals/modal_notas.php';
    if ($curso == 1){
      $año = 'Primer Año';
    }elseif ($curso == 2){
      $año = 'Segundo Año';
    }elseif ($curso == 3){
      $año = 'Tercer Año';
    }elseif ($curso == 4){
      $año = 'Cuarto Año';
    }elseif ($curso == 5){
      $año = 'Quinto Año';
    }

    $sql = "SELECT * FROM notas as nt INNER JOIN alumnos as al ON nt.alumno_id = al.alumno_id INNER JOIN periodos as pe ON nt.periodo_id = pe.periodo_id INNER JOIN materias as ri ON nt.materia_id = ri.materia_id WHERE al.alumno_id = $cursante AND nt.curso = $curso AND pe.periodo_id = $elPeriodo";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();
    
?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista De Notas De <?= $año; ?> <br> Estudiante: <?= $apellistu;?>  <?= $nombrestu;?> (CI: <?= $nacionalidad;?> <?= $cedu; ?>)  <br> Periodo escolar : <?= $fechaEscolar;?> </h1>
            <button class="btn btn-info" type="button" onclick="openModalNota()">Nueva Nota</button>
            <a href="boletin.php?seccion=<?= $seccion;?>&curso=<?= $curso;?>&cursante=<?= $cursante;?>&cedu=<?= $cedu;?>&nombrestu=<?= $nombrestu;?>&apellistu=<?= $apellistu;?>&nacionalidad=<?= $nacionalidad;?>&fechaNac=<?= $fechaNacimiento;?>&fechaEsc=<?= $fechaEscolar;?>&nombreSec=<?= $nombreSeccion;?>&numelist=<?= $numeroLista;?>&elPerio=<?= $elPeriodo;?>" class="btn btn-secondary ">Generar Boletin Academico</a>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de notas</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableNota">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>ASIGNATURAS</th>
                      <th>1º PERIODO</th>
                      <th>2º PERIODO</th>
                      <th>3º PERIODO</th>
                      <th>FINAL</th>
                      <th>TIPO DE NOTA</th>
                      <th>MOMENTO</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      if ($row > 0) {
                        while($data = $query->fetch()) {
                          
                    ?>
                      <tr>
                        <td><?php
                              if ($privilegios==1){
                                echo $data['acciones'] = '
                                <button class="btn btn-primary btn-sm" title="Editar" onclick="editarNota('.$data['nota_id'].')">Editar</button>
                                <button class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarNota('.$data['nota_id'].')">Eliminar</button>
                                                    ';
                              }elseif($privilegios==2){
                                echo $data['acciones'] = '
                                <button class="btn btn-primary btn-sm" title="Editar" onclick="editarNota('.$data['nota_id'].')">Editar</button>
                                                    ';
                              }elseif($privilegios==3){
                                echo '<span class="alert alert-dark">No Disponible</span>';
                              }
                                
                        ?></td>
                        <td><?= $data['nombre_materia']; ?></td>
                        <td><?php
                                if ($data['nota1']>9){
                                 ?> <span class="alert alert-success"><b><?php echo $data['nota1'];?></b></span><?php
                                }else if($data['nota1']>0){
                                  ?> <span class="alert alert-danger"><b>0<?php echo $data['nota1'];?></b></span><?php
                                 }
                                ?></td>
                        <td><?php
                                if ($data['nota2']>9){
                                 ?> <span class="alert alert-success"><b><?php echo $data['nota2'];?></b></span><?php
                                }else if($data['nota2']>0){
                                  ?> <span class="alert alert-danger"><b>0<?php echo $data['nota2'];?></b></span><?php
                                }
                                ?></td>
                        <td><?php
                                if ($data['nota3']>9){
                                 ?> <span class="alert alert-success"><b><?php echo $data['nota3'];?></b></span><?php
                                }else if($data['nota3']>0){
                                  ?> <span class="alert alert-danger"><b>0<?php echo $data['nota3'];?></b></span><?php
                                }
                                ?></td>
                        <td><?php
                                if ($data['promedio']>9){
                                 ?> <span class="alert alert-success"><b><?php echo $data['promedio'];?></b></span><?php
                                }else if($data['promedio']>0){
                                  ?> <span class="alert alert-danger"><b>0<?php echo $data['promedio'];?></b></span><?php
                                }
                                ?></td>
                        <td>
                          <?php
                            if ($data['estadonota']==2){
                              ?> <span class="alert alert-success">NORMAL</span> <?php
                            }else if($data['estadonota']==1){
                             ?> <span class="alert alert-info">REMEDIAL</span><?php
                            }else if($data['estadonota']==3){
                              ?> <span class="alert alert-danger">M. P.<?php
                            }else if($data['estadonota']==4){
                              ?> <span class="alert alert-primary">REPITENTE<?php
                            }else{
                              ?> <span class="alert alert-warning">O. I.<?php
                            }
                            
                          

                          ?>
                          
                        </td>

                        <td>
                            <?php
                              if ($data['estadonota']==3) {
                                echo $data['momento_nota'];
                              }else {
                                echo " ";
                              }
                            ?>


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