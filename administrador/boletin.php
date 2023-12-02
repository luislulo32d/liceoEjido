<?php
    if(!empty($_GET['seccion']) ||!empty($_GET['curso']) ||!empty($_GET['cursante']) ||!empty($_GET['cedu']) || !empty($_GET['nombrestu']) || !empty($_GET['fechaNacimiento']) || !empty($_GET['nacionalidad']) || !empty($_GET['fechaNac']) || !empty($_GET['fechaEsc']) || !empty($_GET['nombreSec']) || !empty($_GET['numelist']) || !empty($_GET['elPerio'])) {
        $seccion = $_GET['seccion'];
        $curso = $_GET['curso'];
        $cursante = $_GET['cursante'];
        $cedu = $_GET['cedu'];
        $nombrestu = $_GET['nombrestu'];
        $apellistu = $_GET['apellistu'];
        $nacionalidad = $_GET['nacionalidad'];
        $fechaNacimiento = $_GET['fechaNac'];
        $fechaEscolar = $_GET['fechaEsc'];
        $nombreSeccion = $_GET['nombreSec'];
        $numeroLista = $_GET['numelist'];
        $elPeriodo = $_GET['elPerio'];
        $sumatoriaNota1 = 0;
        $sumatoriaNota2 = 0;
        $sumatoriaNota3 = 0;
        $sumatoriaPromedio = 0;
        $contador1 = 0;
        $contador2 = 0;
        $contador3 = 0;
        $contadorp = 0;
        $filasAsignaturas = 0;
        $literalGrupos = 0;
        $literalGrupos1 = 0;
        $literalGrupos2 = 0;
        $literalGrupos3 = 0;
        $literalOrientacion = 0;
        $literalOrientacion1 = 0;
        $literalOrientacion2 = 0;
        $literalOrientacion3 = 0;
        
    } else {
      echo '<script> alert("No se a seleccionado correctamente el estudiante, su sección o su año")</script>';
      
    }
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    require_once 'includes/modals/modal_notas.php';
    if ($curso == 1){
      $año = 'Primer Año';
      $grado = '1RO';
      $mencion = 'BASICA';
    }elseif ($curso == 2){
      $año = 'Segundo Año';
      $grado = '2DO';
      $mencion = 'BASICA';
    }elseif ($curso == 3){
      $año = 'Tercer Año';
      $grado = '3RO';
      $mencion = 'BASICA';
    }elseif ($curso == 4){
      $año = 'Cuarto Año';
      $grado = '4TO';
      $mencion = 'CIENCIAS';
    }elseif ($curso == 5){
      $año = 'Quinto Año';
      $grado = '5TO';
      $mencion = 'CIENCIAS';
    }

    

    $sql = "SELECT * FROM datos_liceo ";
          
    $query = $pdo->prepare($sql);
    $query->execute();
    $liceo = $query->fetchAll(PDO::FETCH_ASSOC);



    $sql = "SELECT * FROM notas as nt INNER JOIN alumnos as al ON nt.alumno_id = al.alumno_id INNER JOIN periodos as pe ON nt.periodo_id = pe.periodo_id INNER JOIN materias as ri ON nt.materia_id = ri.materia_id WHERE al.alumno_id = $cursante AND pe.periodo_id = $elPeriodo AND nt.curso = $curso ORDER BY nt.materia_id";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();
    
?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Boletin Informativo <br> Estudiante De <?= $año; ?> </h1>
            <button id="btnCrearPdf" class="btn btn-danger">PDF</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">boletin</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive" id="boletinInformativo">
                <table width=550pp class="text-center-boletin" cellpadding="0" cellspacing="0" bordercolor="#000000">
                <div class="boletin-cabecera">
                <img src="images/boletinCabeceraLiceoEjido.png" width="550pp" alt="cabecera">
                </div>

                <div class="piedeboletin"></div>
                  <colgroup>
                    <col style="width: 10.5%"/>
                    <col style="width: 10.5%"/>
                    <col style="width: 4.5%"/>
                    <col style="width: 4%"/>
                    <col style="width: 6.5%"/>
                    <col style="width: 2%"/>
                    <col style="width: 3%"/>
                    <col style="width: 3.5%"/>
                    <col style="width: 8%"/>
                    <col style="width: 6.5%"/>
                    <col style="width: 1.5%"/>
                    <col style="width: 8%"/>
                    <col style="width: 3.5%"/>
                    <col style="width: 7%"/>
                    <col style="width: 8%"/>
                    <col style="width: 13.5%"/>
                  </colgroup>
                    <thead>
                      <tr>
                        <th rowspan = "2" colspan="16">INFORME DE RENDIMIENTO DEL ESTUDIANTE <br> AÑO ESCOLAR <?= $fechaEscolar;?> </th>
                      </tr>
                      
                    </thead>
                    <tbody>
                      <tr>
                        <th rowspan = "1" colspan = "2">CEDULA</th>
                        <th rowspan = "1" colspan = "11">APELLIDOS Y NOMBRES</th>
                        <th rowspan = "1" colspan = "3">FECHA DE NACIMIENTO</th>
                      </tr>
                      <tr>
                        <td rowspan = "1" colspan = "2"><?= $nacionalidad;?><?= $cedu;?></td>
                        <td rowspan = "1" colspan = "11"><?= $apellistu;?> <?= $nombrestu;?></td>
                        <td rowspan = "1" colspan = "3"><?= $fechaNacimiento;?></td>
                      </tr>
                      <tr>
                        <th rowspan = "1" colspan = "2">GRADO/ AÑO</th>
                        <th rowspan = "1" colspan = "1"><?= $grado;?></th>
                        <th rowspan = "1" colspan = "2">SECCIÓN</th>
                        <th rowspan = "1" colspan = "2"><b>"<?= $nombreSeccion;?>"</b></th>
                        <th rowspan = "1" colspan = "3">DOCENTE GUÍA:</th>
                        <th rowspan = "1" colspan = "6"><input type="text" class="selectboletin"></th>
                      </tr>
                      <tr>
                        <td rowspan = "2" colspan = "5"><b> AREA DE FORMACION (PLAN DE ESTUDIO 31059) </b></td>
                        <td rowspan = "1" colspan = "4"><b>1ER PERIODO</b></td>
                        <td rowspan = "1" colspan = "3"><b>2DO PERIODO</b></td>
                        <td rowspan = "1" colspan = "3"><b>3ER PERIODO</b></td>
                        <td rowspan = "2" colspan = "1"><b>CALIFICACIÓN DEFINITIVA</b></td>

                      </tr>
                      <tr>
                        <td rowspan = "1" colspan = "3">NOTA</td>
                        <td rowspan = "1" colspan = "1">INASIST.</td>

                        <td rowspan = "1" colspan = "2">NOTA</td>
                        <td rowspan = "1" colspan = "1">INASIST.</td>

                        <td rowspan = "1" colspan = "2">NOTA</td>
                        <td rowspan = "1" colspan = "1">INASIST.</td>
                    
                      </tr>
                      
                      <?php
                      if ($row > 0) {
                        while($data = $query->fetch()) {
                          $filasAsignaturas = $filasAsignaturas + 1;
                      ?>
                      <tr>
                        <td rowspan = "1" colspan = "5"><?php     $materi=$data['siglas'];
                                                                  if($materi == "GP"){

                                                                  }elseif ($materi == "OYC"){
                                                                    
                                                                  }else{
                                                                    echo $data['nombre_materia'];
                                                                  }
                                                                  
                                                        ?></td>
                        <td rowspan = "1" colspan = "3"><?php if($data['nota1'] != 0){
                                                              
                                                              if($materi == "GP"){
                                                                $notaGrupo1 = $data['nota1'];
                                                                $notaGrupo1 = $notaGrupo1 * 1;
                                                                if($notaGrupo1 > 18){
                                                                  $literalGrupos1 = "A";      
                                                                }elseif($notaGrupo1 > 15){
                                                                  $literalGrupos1 = "B";
                                                                }elseif($notaGrupo1 > 11){
                                                                  $literalGrupos1 = "C";
                                                                }elseif($notaGrupo1 > 9){
                                                                  $literalGrupos1 = "D";
                                                                }else{
                                                                  $literalGrupos1 = "IN";
                                                                }
                                                            }elseif($materi == "OYC"){
                                                              $notaOrientacion1 = $data['nota1'];
                                                              $notaOrientacion1 = $notaOrientacion1 * 1;
                                                              if($notaOrientacion1 > 18){
                                                                $literalOrientacion1 = "A";      
                                                              }elseif($notaOrientacion1 > 15){
                                                                $literalOrientacion1 = "B";
                                                              }elseif($notaOrientacion1 > 11){
                                                                $literalOrientacion1 = "C";
                                                              }elseif($notaOrientacion1 > 9){
                                                                $literalOrientacion1 = "D";
                                                              }else{
                                                                $literalOrientacion1 = "IN";
                                                              }
                                                          }else {
                                                            echo $data['nota1'];
                                                            $notaactual1 = $data['nota1'];
                                                            $sumatoriaNota1 = $sumatoriaNota1 + $notaactual1;
                                                            $contador1 = $contador1 + 1;
                                                          }
                                                            }
                                                        ?></td>
                        <td rowspan = "1" colspan = "1"><?php if($data['nota1'] != 0){ ?>
                                                         <select class="selectboletin">
                                                                <option value="*">*</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                            </select></td>
                                                         <?php } ?>
                        <td rowspan = "1" colspan = "2"><?php if($data['nota2'] != 0){
                                                             
                                                              if($materi == "GP"){
                                                                $notaGrupo2 = $data['nota2'];
                                                                $notaGrupo2 = $notaGrupo2 * 1;
                                                                if($notaGrupo2 > 18){
                                                                  $literalGrupos2 = "A";      
                                                                }elseif($notaGrupo2 > 15){
                                                                  $literalGrupos2 = "B";
                                                                }elseif($notaGrupo2 > 11){
                                                                  $literalGrupos2 = "C";
                                                                }elseif($notaGrupo2 > 9){
                                                                  $literalGrupos2 = "D";
                                                                }else{
                                                                  $literalGrupos2 = "IN";
                                                                }
                                                            }elseif($materi == "OYC"){
                                                              $notaOrientacion2 = $data['nota2'];
                                                              $notaOrientacion2 = $notaOrientacion2 * 1;
                                                              if($notaOrientacion2 > 18){
                                                                $literalOrientacion2 = "A";      
                                                              }elseif($notaOrientacion2 > 15){
                                                                $literalOrientacion2 = "B";
                                                              }elseif($notaOrientacion2 > 11){
                                                                $literalOrientacion2 = "C";
                                                              }elseif($notaOrientacion2 > 9){
                                                                $literalOrientacion2 = "D";
                                                              }else{
                                                                $literalOrientacion2 = "IN";
                                                              }
                                                          }else{
                                                            echo $data['nota2'];
                                                            $notaactual2 = $data['nota2'];
                                                            $sumatoriaNota2 = $sumatoriaNota2 + $notaactual2;
                                                            $contador2 = $contador2 + 1;
                                                          }
                                                            }
                                                        ?></td>
                        <td rowspan = "1" colspan = "1"> <?php if($data['nota2'] != 0){ ?>
                                                            <select class="selectboletin">
                                                                <option value="*">*</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                            </select>
                                                          <?php } ?>
                                                          </td>
                        <td rowspan = "1" colspan = "2"><?php if($data['nota3'] != 0){
                                                             
                                                              if($materi == "GP"){
                                                                $notaGrupo3 = $data['nota3'];
                                                                $notaGrupo3 = $notaGrupo3 * 1;
                                                                if($notaGrupo3 > 18){
                                                                  $literalGrupos3 = "A";      
                                                                }elseif($notaGrupo3 > 15){
                                                                  $literalGrupos3 = "B";
                                                                }elseif($notaGrupo3 > 11){
                                                                  $literalGrupos3 = "C";
                                                                }elseif($notaGrupo3 > 9){
                                                                  $literalGrupos3 = "D";
                                                                }else{
                                                                  $literalGrupos3 = "IN";
                                                                }
                                                            }elseif($materi == "OYC"){
                                                              $notaOrientacion3 = $data['nota3'];
                                                              $notaOrientacion3 = $notaOrientacion3 * 1;
                                                              if($notaOrientacion3 > 18){
                                                                $literalOrientacion3 = "A";      
                                                              }elseif($notaOrientacion3 > 15){
                                                                $literalOrientacion3 = "B";
                                                              }elseif($notaOrientacion3 > 11){
                                                                $literalOrientacion3 = "C";
                                                              }elseif($notaOrientacion3 > 9){
                                                                $literalOrientacion3 = "D";
                                                              }else{
                                                                $literalOrientacion3 = "IN";
                                                              }
                                                          }else{
                                                            echo $data['nota3'];
                                                            $notaactual3 = $data['nota3'];
                                                            $sumatoriaNota3 = $sumatoriaNota3 + $notaactual3;
                                                            $contador3 = $contador3 + 1;
                                                          }
                                                            }

                                                        ?></td>
                        <td rowspan = "1" colspan = "1"> <?php if($data['nota3'] != 0){ ?>
                                                              <select class="selectboletin">
                                                                <option value="*">*</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                            </select></td>
                                                            <?php }?>
                        <td rowspan = "1" colspan = "1"><?php if($data['promedio'] != 0){
                                                             
                                                              if($materi == "GP"){
                                                                $notaGrupo = $data['promedio'];
                                                                $notaGrupo = $notaGrupo * 1;
                                                                if($notaGrupo > 18){
                                                                  $literalGrupos = "A";      
                                                                }elseif($notaGrupo > 15){
                                                                  $literalGrupos = "B";
                                                                }elseif($notaGrupo > 11){
                                                                  $literalGrupos = "C";
                                                                }elseif($notaGrupo > 9){
                                                                  $literalGrupos = "D";
                                                                }else{
                                                                  $literalGrupos = "IN";
                                                                }
                                                            }elseif($materi == "OYC"){
                                                              $notaOrientacion = $data['promedio'];
                                                              $notaOrientacion = $notaOrientacion * 1;
                                                              if($notaOrientacion > 18){
                                                                $literalOrientacion = "A";      
                                                              }elseif($notaOrientacion > 15){
                                                                $literalOrientacion = "B";
                                                              }elseif($notaOrientacion > 11){
                                                                $literalOrientacion = "C";
                                                              }elseif($notaOrientacion > 9){
                                                                $literalOrientacion = "D";
                                                              }else{
                                                                $literalOrientacion = "IN";
                                                              }
                                                          }else{
                                                            echo $data['promedio'];
                                                            $notaactualp = $data['promedio'];
                                                            $sumatoriaPromedio = $sumatoriaPromedio + $notaactualp;
                                                            $contadorp = $contadorp + 1;
                                                          }
                                                          }
                                                            
                                                            
                                                        ?></td>


                      </tr>

                      <?php } } ?>

                      <tr>
                        <td rowspan = "1" colspan = "5"><b> PROMEDIO TOTAL</b></td>
                        <td rowspan = "1" colspan = "3"><?php 
                                                            $filasAsignaturas = $filasAsignaturas + 1;
                                                            if($sumatoriaNota1 != 0){
                                                              $sumatoriaNota1 = $sumatoriaNota1/$contador1;
                                                              if(is_int($sumatoriaNota1)){
                                                                echo $sumatoriaNota1;
                                                              }else {
                                                                echo number_format($sumatoriaNota1, 2,',',' ');
                                                              }


                                                            }
                                                        ?></td>
                        <td rowspan = "1" colspan = "1"> <?php if($sumatoriaNota1 != 0){ ?>
                                                              <select class="selectboletin">
                                                                <option value="*">*</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                            </select></td>
                                                            <?php }?>
                        <td rowspan = "1" colspan = "2"><?php 
                                                            if($sumatoriaNota2 != 0){
                                                              $sumatoriaNota2 = $sumatoriaNota2/$contador2;
                                                              
                                                              if(is_int($sumatoriaNota2)){
                                                                echo $sumatoriaNota2;
                                                              }else {
                                                                echo number_format($sumatoriaNota2, 2,',',' ');
                                                              }


                                                            }
                                                        ?></td>
                        <td rowspan = "1" colspan = "1"><?php if($sumatoriaNota2 != 0){ ?>
                                                             <select class="selectboletin">
                                                                <option value="*">*</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                            </select></td>
                                                          <?php } ?> 
                        <td rowspan = "1" colspan = "2"><?php 
                                                            if($sumatoriaNota3 != 0){
                                                              $sumatoriaNota3 = $sumatoriaNota3/$contador3;
                                                              
                                                              if(is_int($sumatoriaNota3)){
                                                                echo $sumatoriaNota3;
                                                              }else {
                                                                echo number_format($sumatoriaNota3, 2,',',' ');
                                                              }


                                                            }
                                                        ?></td>
                        <td rowspan = "1" colspan = "1"><?php if($sumatoriaNota3 != 0){ ?>
                                                            <select class="selectboletin">
                                                                <option value="*">*</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                            </select></td>
                                                        <?php } ?>                                                                       
                        <td rowspan = "1" colspan = "1"><?php 
                                                            if($sumatoriaPromedio != 0){
                                                              $sumatoriaPromedio = $sumatoriaPromedio/$contadorp;
                                                              
                                                              if(is_int($sumatoriaPromedio)){
                                                                echo $sumatoriaPromedio;
                                                              }else {
                                                                echo number_format($sumatoriaPromedio, 2,',',' ');
                                                              }

                                                            }
                                                            
                                                        ?></td>
                        
                      </tr>
                      
                      <tr>
                      
                      <th rowspan = "3" colspan = "16"><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"></th>

                      </tr>
                      <tr></tr>
                      <tr></tr>
                      <tr></tr>
                     <tr>
                       <th rowspan = "1" colspan = "6"><b> ORIENTACION Y CONVIVENCIA </b></th>
                       <th rowspan = "1" colspan = "10"><b>ANALISIS CUALITATIVOS DEL DESEMPEÑO ESTUDIANTIL EN OC Y GP</b></th>
                       
                     </tr>
                     <tr>
                       <th rowspan = "3" colspan = "1"> 1ER PERIODO </th>
                       <th rowspan = "3" colspan = "1"> 2DO PERIODO </th>
                       <th rowspan = "3" colspan = "2"> 3ER PERIODO </th>
                       <th rowspan = "3" colspan = "2"> LITERAL FINAL </th>

                       <td rowspan = "3" colspan = "2">  <b>A</b> <br> </td>
                       <td rowspan = "3" colspan = "8"> Se evidencia un excelente desarrollo de potencialidades, tomando <br> en cuenta la participación individual y colectiva, superando en <br> algunos casos las expectativas durante los procesos de aprendizaje. </td>
                     </tr>
                     <tr></tr>
                     <tr></tr>
                     <tr>
                     <td rowspan = "3" colspan = "1"> <select class="selectboletin">
                                                                <?php if ($literalOrientacion1 != 0){?>
                                                                <option value="<?= $literalOrientacion1;?>"><?= $literalOrientacion1;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="IN">IN</option>
                                                            </select> </td> </td>
                       <td rowspan = "3" colspan = "1"> <select class="selectboletin">
                                                                <?php if ($literalOrientacion2 != 0){?>
                                                                <option value="<?= $literalOrientacion2;?>"><?= $literalOrientacion2;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="IN">IN</option>
                                                            </select> </td> </td>
                       <td rowspan = "3" colspan = "2"> <select class="selectboletin">
                                                                <?php if ($literalOrientacion3 != 0){?>
                                                                <option value="<?= $literalOrientacion3;?>"><?= $literalOrientacion3;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="IN">IN</option>
                                                            </select> </td> </td>
                       <th rowspan = "3" colspan = "2"><select class="selectboletin">
                                                                <?php if ($literalOrientacion != 0){?>
                                                                <option value="<?= $literalOrientacion;?>"><?= $literalOrientacion;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="IN">IN</option>
                                                            </select> </td></th>

                       <td rowspan = "3" colspan = "2">  <b>B</b> <br> </td>
                       <td rowspan = "3" colspan = "8"> Se evidencia un buen desarrollo de potencialidades, tomando <br>en cuenta la participación individual y colectiva, con un <br> fortalecimiento efectivo de los procesos de aprendizaje. </td>
                       
                     </tr>
                     <tr></tr>
                     <tr></tr>
                     <tr></tr>
                     <tr>
                      <th rowspan = "3" colspan = "6"><b> PARTICIPACIÓN EN GRUPOS DE CREACIÓN, RECREACIÓN Y PRODUCCIÓN</b></th>
                      <th rowspan = "3" colspan = "2"><b> C </b></th>
                      <td rowspan = "3" colspan = "8"> Se evidencia un satisfactorio desarrollo en potencialidades, tomando<br> en cuenta la participación individual y colectiva, requiere apoyo para<br>la consolidación de los procesos de aprendizajes.</td>

                     </tr>

                     <tr></tr>
                     <tr></tr>
                     <tr></tr>
                     <tr>
                       <th rowspan = "3" colspan = "1"> 1ER PERIODO </th>
                       <th rowspan = "3" colspan = "1"> 2DO PERIODO </th>
                       <th rowspan = "3" colspan = "2"> 3ER PERIODO </th>
                       <th rowspan = "3" colspan = "2"> LITERAL FINAL </th>

                       <td rowspan = "3" colspan = "2">  <b>D</b> <br> </td>
                       <td rowspan = "3" colspan = "8"> Se evidencia un desarrollo medianamente aceptable de las <br> potencialidades, tomando en cuenta la participación individual y <br> colectiva, requiere ayuda durante los procesos de aprendizaje. </td>
                     </tr>
                     <tr></tr>
                     <tr></tr>
                     <tr></tr>
                     <tr>
                     <td rowspan = "8" colspan = "1"> <select class="selectboletin">
                                                                <?php if ($literalGrupos1 != 0){?>
                                                                <option value="<?= $literalGrupos1;?>"><?= $literalGrupos1;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="IN">IN</option>
                                                            </select> </td> </td>
                     <td rowspan = "8" colspan = "1"> <select class="selectboletin">
                                                                <?php if ($literalGrupos2 != 0){?>
                                                                <option value="<?= $literalGrupos2;?>"><?= $literalGrupos2;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="IN">IN</option>
                                                            </select> </td> </td>
                      <td rowspan = "8" colspan = "2"> <select class="selectboletin">
                                                                <?php if ($literalGrupos3 != 0){?>
                                                                <option value="<?= $literalGrupos3;?>"><?= $literalGrupos3;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="IN">IN</option>
                                                            </select> </td> </td>
                      <th rowspan = "8" colspan = "2"><select class="selectboletin">
                                                                <?php if ($literalGrupos != 0){?>
                                                                <option value="<?= $literalGrupos;?>"><?= $literalGrupos;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="IN">IN</option>
                                                            </select> </td></th>
                      <th rowspan = "8" colspan = "10">OBSERVACIONES:            <input type="text" class="selectboletin"><input type="text" class="selectboletin">                     <br><br><br> </th>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>

                    <th rowspan = "3" colspan = "16"><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"></th>

                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                      
                      <th rowspan = "8" colspan = "5"> CONTROL DE ESTUDIO: <br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"></th>
                      <th rowspan = "8" colspan = "7"> SELLOS </th>
                      <th rowspan = "8" colspan = "4"> DIRECTOR(E): <br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"><br><input type="text" class="selectboletin"></th>

                    </tr>
                    
                     <!--
                     <tr>
                       <th rowspan = "1" colspan = "3">SELLO DEL PLANTEL</th>
                       <th rowspan = "1" colspan = "7">OBSERVACIONES</th>
                      </tr>
                      <tr>
                       <td rowspan = "4" colspan = "3"><input type="text" class="selectboletin"> <br> <input type="text" class="selectboletin"> <br> <input type="text" class="selectboletin"> <br> <input type="text" class="selectboletin"></td>
                       <td rowspan = "9" colspan = "7"> <br> <input type="text" class="selectboletin">  </td>
                      </tr>
                      <tr>
                        
                      </tr>
                      <tr>

                      </tr>
                      <tr>

                      </tr>
                      <tr>
                        <th rowspan = "2" colspan = "3">FIRMA DEL DIRECTOR (A) O REPRESENTANTE DEL CONCEJO DOCENTE</th>
                      </tr>
                      <tr>
                      </tr>
                      <tr>
                      <td rowspan = "3" colspan = "3"><input type="text" class="selectboletin"> <br> <input type="text" class="selectboletin"> </td>

                      </tr>
                                                                -->
                    </tbody>
                         
                </table>
                 <div class="piedeboletin">
                  <p><?php echo $liceo[0]['direccion_liceo'].' '.date("Y");?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>


<?php
    require_once 'includes/footer.php';
?>