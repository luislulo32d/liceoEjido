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

    $sql = "SELECT * FROM notas as nt INNER JOIN alumnos as al ON nt.alumno_id = al.alumno_id INNER JOIN periodos as pe ON nt.periodo_id = pe.periodo_id INNER JOIN materias as ri ON nt.materia_id = ri.materia_id WHERE al.alumno_id = $cursante AND pe.periodo_id = $elPeriodo AND nt.curso = $curso";
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

                <div class="piedeboletin"><b> BOLETIN INFORMATIVO</b></div>
                  <colgroup>
                    <col style="width: 12.17%"/>
                    <col style="width: 14.28%"/>
                    <col style="width: 14.28%"/>
                    <col style="width: 7.14%"/>
                    <col style="width: 7.14%"/>
                    <col style="width: 7.14%"/>
                    <col style="width: 7.14%"/>
                    <col style="width: 7.14%"/>
                    <col style="width: 7.14%"/>
                    <col style="width: 14.28%"/>
                  </colgroup>
                  <thead>
                      <tr>
                        <th rowspan = "1" colspan = "1">CEDULA</th>
                        <th rowspan = "1" colspan = "6">APELLIDOS Y NOMBRES</th>
                        <th rowspan = "1" colspan = "3">FECHA DE NACIMIENTO</th>
                      </tr>
                      
                    </thead>
                    <tbody>
                      <tr>
                        <td rowspan = "1" colspan = "1"><?= $nacionalidad;?><?= $cedu;?></td>
                        <td rowspan = "1" colspan = "6"><?= $apellistu;?> <?= $nombrestu;?></td>
                        <td rowspan = "1" colspan = "3"><?= $fechaNacimiento;?></td>
                      </tr>
                      <tr>
                        <th rowspan = "1" colspan = "1">EDUCACION</th>
                        <th rowspan = "1" colspan = "1">AÑO ESCOLAR</th>
                        <th rowspan = "1" colspan = "1">Nº DE ALUMNOS</th>
                        <th rowspan = "1" colspan = "2">GRADO</th>
                        <th rowspan = "1" colspan = "2">SECCION</th>
                        <th rowspan = "1" colspan = "3">Nº DE LISTA</th>
                      </tr>
                      <tr>
                        <td rowspan = "1" colspan = "1">MEDIA GENERAL</td>
                        <td rowspan = "1" colspan = "1"><?= $fechaEscolar;?></td>
                        <td rowspan = "1" colspan = "1"> <select class="selectboletin">
                                                                <option value="<?= $numeroLista;?>"><?= $numeroLista;?></option>
                                                                <option value=" "> </option>
                                                                <option value="*">*</option>
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
                                                                <option value="26">26</option>
                                                                <option value="27">27</option>
                                                                <option value="28">28</option>
                                                                <option value="29">29</option>
                                                                <option value="31">31</option>
                                                                <option value="32">32</option>
                                                                <option value="33">33</option>
                                                                <option value="34">34</option>
                                                                <option value="35">35</option>
                                                                <option value="36">36</option>
                                                                <option value="37">37</option>
                                                                <option value="38">38</option>
                                                                <option value="39">39</option>
                                                                <option value="40">40</option>
                                                                <option value="41">41</option>
                                                                <option value="42">42</option>
                                                                <option value="43">43</option>
                                                                <option value="44">44</option>
                                                                <option value="45">45</option>
                                                            </select></td>
                        <td rowspan = "1" colspan = "2"> <?= $grado;?></td>
                        <td rowspan = "1" colspan = "2"> "<?= $nombreSeccion;?>"</td>
                        <td rowspan = "1" colspan = "3"> <?= $numeroLista;?></td>
                      </tr>
                      <tr>
                        <td rowspan = "1" colspan = "10"><input type="text" class="selectboletin">  </td>
                      </tr>
                      <tr>
                        <th rowspan = "2" colspan = "3"> <br> ASIGNATURAS</th>
                        <th rowspan = "1" colspan = "2">1ºPERIODO</th>
                        <th rowspan = "1" colspan = "2">2ºPERIODO</th>
                        <th rowspan = "1" colspan = "2">3ºPERIODO</th>
                        <th rowspan = "1" colspan = "1">FINAL</th>

                      </tr>
                      <tr>
                       <th rowspan = "1" colspan = "1">CALF.</th>
                       <th rowspan = "1" colspan = "1">INAS.</th>
                       <th rowspan = "1" colspan = "1">CALF.</th>
                       <th rowspan = "1" colspan = "1">INAS.</th>
                       <th rowspan = "1" colspan = "1">CALF.</th>
                       <th rowspan = "1" colspan = "1">INAS.</th>
                       <th rowspan = "1" colspan = "1">CALF.</th>
                      </tr>
                      
                      <?php
                      if ($row > 0) {
                        while($data = $query->fetch()) {
                          $filasAsignaturas = $filasAsignaturas + 1;
                      ?>
                      <tr>
                        <td rowspan = "1" colspan = "3"><?php     $materi=$data['nombre_materia'];
                                                                  echo $materi; 
                                                                  
                                                        ?></td>
                        <td rowspan = "1" colspan = "1"><?php if($data['nota1'] != 0){
                                                              echo $data['nota1'];
                                                              $notaactual1 = $data['nota1'];
                                                              $sumatoriaNota1 = $sumatoriaNota1 + $notaactual1;
                                                              $contador1 = $contador1 + 1;
                                                              if($materi == "PARTICIPACION EN GRUPOS"){
                                                                $notaGrupo1 = $data['nota1'];
                                                                $notaGrupo1 = $notaGrupo1 * 1;
                                                                if($notaGrupo1 > 18){
                                                                  $literalGrupos1 = "A";      
                                                                }elseif($notaGrupo1 > 15){
                                                                  $literalGrupos1 = "B";
                                                                }elseif($notaGrupo1 > 11){
                                                                  $literalGrupos1 = "C";
                                                                }else{
                                                                  $literalGrupos1 = "D";
                                                                }
                                                            }if($materi == "ORIENTACION Y CONVIVENCIA"){
                                                              $notaOrientacion1 = $data['nota1'];
                                                              $notaOrientacion1 = $notaOrientacion1 * 1;
                                                              if($notaOrientacion1 > 18){
                                                                $literalOrientacion1 = "A";      
                                                              }elseif($notaOrientacion1 > 15){
                                                                $literalOrientacion1 = "B";
                                                              }elseif($notaOrientacion1 > 11){
                                                                $literalOrientacion1 = "C";
                                                              }else{
                                                                $literalOrientacion1 = "D";
                                                              }
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
                        <td rowspan = "1" colspan = "1"><?php if($data['nota2'] != 0){
                                                              echo $data['nota2'];
                                                              $notaactual2 = $data['nota2'];
                                                              $sumatoriaNota2 = $sumatoriaNota2 + $notaactual2;
                                                              $contador2 = $contador2 + 1;
                                                              if($materi == "PARTICIPACION EN GRUPOS"){
                                                                $notaGrupo2 = $data['nota2'];
                                                                $notaGrupo2 = $notaGrupo2 * 1;
                                                                if($notaGrupo2 > 18){
                                                                  $literalGrupos2 = "A";      
                                                                }elseif($notaGrupo2 > 15){
                                                                  $literalGrupos2 = "B";
                                                                }elseif($notaGrupo2 > 11){
                                                                  $literalGrupos2 = "C";
                                                                }else{
                                                                  $literalGrupos2 = "D";
                                                                }
                                                            }if($materi == "ORIENTACION Y CONVIVENCIA"){
                                                              $notaOrientacion2 = $data['nota2'];
                                                              $notaOrientacion2 = $notaOrientacion2 * 1;
                                                              if($notaOrientacion2 > 18){
                                                                $literalOrientacion2 = "A";      
                                                              }elseif($notaOrientacion2 > 15){
                                                                $literalOrientacion2 = "B";
                                                              }elseif($notaOrientacion2 > 11){
                                                                $literalOrientacion2 = "C";
                                                              }else{
                                                                $literalOrientacion2 = "D";
                                                              }
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
                        <td rowspan = "1" colspan = "1"><?php if($data['nota3'] != 0){
                                                              echo $data['nota3'];
                                                              $notaactual3 = $data['nota3'];
                                                              $sumatoriaNota3 = $sumatoriaNota3 + $notaactual3;
                                                              $contador3 = $contador3 + 1;
                                                              if($materi == "PARTICIPACION EN GRUPOS"){
                                                                $notaGrupo3 = $data['nota3'];
                                                                $notaGrupo3 = $notaGrupo3 * 1;
                                                                if($notaGrupo3 > 18){
                                                                  $literalGrupos3 = "A";      
                                                                }elseif($notaGrupo3 > 15){
                                                                  $literalGrupos3 = "B";
                                                                }elseif($notaGrupo3 > 11){
                                                                  $literalGrupos3 = "C";
                                                                }else{
                                                                  $literalGrupos3 = "D";
                                                                }
                                                            }if($materi == "ORIENTACION Y CONVIVENCIA"){
                                                              $notaOrientacion3 = $data['nota3'];
                                                              $notaOrientacion3 = $notaOrientacion3 * 1;
                                                              if($notaOrientacion3 > 18){
                                                                $literalOrientacion3 = "A";      
                                                              }elseif($notaOrientacion3 > 15){
                                                                $literalOrientacion3 = "B";
                                                              }elseif($notaOrientacion3 > 11){
                                                                $literalOrientacion3 = "C";
                                                              }else{
                                                                $literalOrientacion3 = "D";
                                                              }
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
                                                              echo $data['promedio'];
                                                              $notaactualp = $data['promedio'];
                                                              $sumatoriaPromedio = $sumatoriaPromedio + $notaactualp;
                                                              $contadorp = $contadorp + 1;
                                                              if($materi == "PARTICIPACION EN GRUPOS"){
                                                                $notaGrupo = $data['promedio'];
                                                                $notaGrupo = $notaGrupo * 1;
                                                                if($notaGrupo > 18){
                                                                  $literalGrupos = "A";      
                                                                }elseif($notaGrupo > 15){
                                                                  $literalGrupos = "B";
                                                                }elseif($notaGrupo > 11){
                                                                  $literalGrupos = "C";
                                                                }else{
                                                                  $literalGrupos = "D";
                                                                }
                                                            }if($materi == "ORIENTACION Y CONVIVENCIA"){
                                                              $notaOrientacion = $data['promedio'];
                                                              $notaOrientacion = $notaOrientacion * 1;
                                                              if($notaOrientacion > 18){
                                                                $literalOrientacion = "A";      
                                                              }elseif($notaOrientacion > 15){
                                                                $literalOrientacion = "B";
                                                              }elseif($notaOrientacion > 11){
                                                                $literalOrientacion = "C";
                                                              }else{
                                                                $literalOrientacion = "D";
                                                              }
                                                          }
                                                          }
                                                            
                                                            
                                                        ?></td>


                      </tr>

                      <?php } } ?>

                      <tr>
                        <td rowspan = "1" colspan = "3">PROMEDIO</td>
                        <td rowspan = "1" colspan = "1"><?php 
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
                        <td rowspan = "1" colspan = "1"><?php 
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
                        <td rowspan = "1" colspan = "1"><?php 
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
                       <th rowspan = "1" colspan = "9"> ORIENTACION Y CONVIVENCIA </th>
                       <th rowspan = "1" colspan = "1"> LITERAL </th>
                       
                     </tr>
                     <tr>
                       <th rowspan = "3" colspan = "2"> <input type="text" class="selectboletin"> </th>
                       <th rowspan = "1" colspan = "1"> 1ºPERIODO </th>
                       <td rowspan = "1" colspan = "6"> <input type="text" class="selectboletin"> </td>
                       <td rowspan = "1" colspan = "1"> <select class="selectboletin">
                                                                <?php if ($literalOrientacion1 != 0){?>
                                                                <option value="<?= $literalOrientacion1;?>"><?= $literalOrientacion1;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select> </td> </td>
                     </tr>
                     <tr>
                       <th rowspan = "1" colspan = "1"> 2ºPERIODO </th>
                       <td rowspan = "1" colspan = "6"> <input type="text" class="selectboletin"> </td>
                       <td rowspan = "1" colspan = "1"> <select class="selectboletin">
                                                                <?php if ($literalOrientacion2 != 0){?>
                                                                <option value="<?= $literalOrientacion2;?>"><?= $literalOrientacion2;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select> </td> </td>
                     </tr>
                     <tr>
                       <th rowspan = "1" colspan = "1"> 3ºPERIODO </th>
                       <td rowspan = "1" colspan = "6"> <input type="text" class="selectboletin"> </td>
                       <td rowspan = "1" colspan = "1"> <select class="selectboletin">
                                                                <?php if ($literalOrientacion3 != 0){?>
                                                                <option value="<?= $literalOrientacion3;?>"><?= $literalOrientacion3;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select> </td> </td>
                     </tr>
                     <tr>
                       <th rowspan = "1" colspan = "8"><input type="text" class="selectboletin"></th>
                       <th rowspan = "1" colspan = "1">DEF.</th>
                       <th rowspan = "1" colspan = "1"><select class="selectboletin">
                                                                <?php if ($literalOrientacion != 0){?>
                                                                <option value="<?= $literalOrientacion;?>"><?= $literalOrientacion;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select> </td></th>

                      </tr> 
                      <tr>
                       <th rowspan = "1" colspan = "9"> PARTICIPACION EN GRUPO </th>
                       <th rowspan = "1" colspan = "1"> LITERAL </th>
                       
                     </tr>
                     <tr>
                       <th rowspan = "3" colspan = "2"> <br> NOMBRE DEL GRUPO <br> <input type="text" class="selectboletin"> </th>
                       <th rowspan = "1" colspan = "1"> 1ºPERIODO </th>
                       <td rowspan = "1" colspan = "6"> <input type="text" class="selectboletin"> </td>
                       <td rowspan = "1" colspan = "1"> <select class="selectboletin">
                                                                <?php if ($literalGrupos1 != 0){?>
                                                                <option value="<?= $literalGrupos1;?>"><?= $literalGrupos1;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select> </td>
                     </tr>
                     <tr>
                       <th rowspan = "1" colspan = "1"> 2ºPERIODO </th>
                       <td rowspan = "1" colspan = "6"> <input type="text" class="selectboletin"> </td>
                       <td rowspan = "1" colspan = "1"> <select class="selectboletin">
                                                                <?php if ($literalGrupos2 != 0){?>
                                                                <option value="<?= $literalGrupos2;?>"><?= $literalGrupos2;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select> </td>
                     </tr>
                     <tr>
                       <th rowspan = "1" colspan = "1"> 3ºPERIODO </th>
                       <td rowspan = "1" colspan = "6"> <input type="text" class="selectboletin"> </td>
                       <td rowspan = "1" colspan = "1"> <select class="selectboletin">
                                                                <?php if ($literalGrupos3 != 0){?>
                                                                <option value="<?= $literalGrupos3;?>"><?= $literalGrupos3;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select></td>
                     </tr>
                     <tr>
                       <th rowspan = "1" colspan = "8"><input type="text" class="selectboletin"></th>
                       <th rowspan = "1" colspan = "1">DEF.</th>
                       <th rowspan = "1" colspan = "1"><select class="selectboletin">
                                                                <?php if ($literalGrupos != 0){?>
                                                                <option value="<?= $literalGrupos;?>"><?= $literalGrupos;?></option>
                                                                <?php } ?>
                                                                <option value=" "> </option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select></th>

                      </tr> 
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
                    </tbody>
                         
                </table>
                <div class="piedeboletin"><p> Av.25 de Noviembre diagonal al U.P.T.M. Parroquia Montalbán, Minicipio Campo Elías del Estado Mérida   Telef: 0274-2217237 <br>
                          -Rif: J-31036474-5.</p></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>


<?php
    require_once 'includes/footer.php';
?>