<?php

    if(!empty($_GET['apell']) ||!empty($_GET['nom']) ||!empty($_GET['ced']) ||!empty($_GET['curso']) || !empty($_GET['materi']) || !empty($_GET['aul']) || !empty($_GET['sig'])) {
        $apellidoProf = $_GET['apell'];
        $nombreProf = $_GET['nom'];
        $cedulaProf = $_GET['ced'];
        $curso = $_GET['curso'];
        $nombreMateria = $_GET['materi']; 
        $seccion = $_GET['aul']; 
        $seccion_id = $_GET['aulid']; 
        $siglas = $_GET['sig']; 
        $evaluaciones = $_GET['eva'];

    
    }else {
        echo '<script> alert("Ups, a habido un error")</script>';
        
      }
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    require_once 'includes/modals/modal_notas.php';
    if ($curso == 1){
      $año = 'Primer Año';
      $grado = '1RO';
      $tabla = 'primer_año';
      $tablaEstado = 'statuspr';

    }elseif ($curso == 2){
      $año = 'Segundo Año';
      $grado = '2DO';
      $tabla = 'segundo_año';
      $tablaEstado = 'statussg';

    }elseif ($curso == 3){
      $año = 'Tercer Año';
      $grado = '3RO';
      $tabla = 'tercer_año';
      $tablaEstado = 'statustr';

    }elseif ($curso == 4){
      $año = 'Cuarto Año';
      $grado = '4TO';
      $tabla = 'cuarto_año';
      $tablaEstado = 'statuscr';

    }elseif ($curso == 5){
      $año = 'Quinto Año';
      $grado = '5TO';
      $tabla = 'quinto_año';
      $tablaEstado = 'statusqn';

    }else{
      $año = 'Quinto Año';
      $grado = '5TO';
      $tabla = 'quinto_año';
      $tablaEstado = 'statusqn';
    }

    $sql = "SELECT * FROM $tabla as tb INNER JOIN alumnos as al ON tb.alumno_id = al.alumno_id INNER JOIN periodos as pe ON tb.periodo_id = pe.periodo_id INNER JOIN aulas as au ON tb.aula_id = au.aula_id WHERE pe.estado = 1 AND (tb.$tablaEstado = 1 OR tb.$tablaEstado = 2) AND au.aula_id = $seccion_id ORDER BY al.cedulaes";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();

    if ($siglas == "GP") {
        $nombreMateria = "PARTICIPACIÓN EN GRUPOS DE CREACIÓN, RECREACIÓN Y PRODUCCIÓN";
        
    }

?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Nomina Estudiantil de <?php echo $nombreMateria.', '.$grado.' "'.$seccion.'"';?> </h1>
            <button id="btnCrearPdf" class="btn btn-danger">PDF</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">nomina</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive" id="boletinInformativo">
                
                <table width=650pp class="text-center-boletin" cellpadding="0" cellspacing="0" bordercolor="#000000">

                    <div class="piedeboletin"></div>
                    <colgroup>
                        <col style="width: 2%">
                        <col style="width: 10%">
                        <col style="width: 22%">
                        <col style="width: 22%">

                        <col style="width: 4%">
                        <col style="width: 3%">
                        <col style="width: 4%">
                        <col style="width: 3%">
                        <col style="width: 4%">
                        <col style="width: 3%">
                        <col style="width: 4%">
                        <col style="width: 3%">
                        <col style="width: 4%">
                        <col style="width: 3%">
                        <col style="width: 4%">
                        <col style="width: 3%">
                        <col style="width: 4%">
                        <col style="width: 3%">
                        <col style="width: 3%">

                    </colgroup>
                    <thead>
                      <tr>
                        <th rowspan = "2" colspan="4"> <img src="images/boletinCabeceraLiceoEjido.png" width="310pp" alt="cabecera"></th>
                        <?php 
                            $contando = 0;
                            for ($o=0; $o < $evaluaciones; $o++) { 
                            $contando++;
                        ?>
                        
                        <th rowspan = "10" colspan="2" > <br><br><br><br><br><br><br><br><br><br> E<?= $contando?> </th>
                        
                        <?php }?>
                        <th rowspan = "10" colspan="2" > <br><br><br><br><br><br><br><br><br><br>DEF</th>

                        <?php 
                            if (($siglas == "OYC") || ($siglas == "GP")) {
                                ?>
                                <th rowspan = "10" colspan="1" > <br><br><br><br><br><br><br><br><br><br>LIT</th>
                                <?php
                            }
                        ?>
                      </tr>
                      <tr>

                      </tr>
                      <tr>
                      <td rowspan = "1" colspan="4">AÑO ESCOLAR <select class="selectboletin">
                                                                <option value="2022-2023">2022-2023</option>
                                                                <option value="2023-2024">2023-2024</option>
                                                                <option value="2024-2025">2024-2025</option>
                                                                <option value="2025-2026">2025-2026</option>
                                                                <option value="2026-2027">2026-2027</option>
                                                                <option value="2027-2028">2027-2028</option>
                                                                <option value="2028-2029">2028-2029</option>
                                                                <option value="2029-2030">2029-2030</option>
                                                            </select> - <input type="text" class="selectboletin"> </td>

                      </tr>
                      <tr>
                        <td rowspan = "1" colspan="4"> GRADO: <?php echo $curso.'°';?> <input type="text" class="selectboletin"> SECCIÓN: <?php echo ' "'.$seccion.'" ';?></td>

                      </tr>
                      <tr>
                        <td rowspan = "1" colspan="4" align="left"> Docente Guía: <input type="text" class="selectboletin" style="width: 220px;"></td>
                         
                      </tr>
                      <tr>
                        <td rowspan = "1" colspan="4" align="left"> Docente: <?php echo $nombreProf.' '.$apellidoProf;?></td>

                      </tr>
                      <tr>
                        <td rowspan = "1" colspan="4"> Area: <?php echo $nombreMateria;?></td>

                      </tr>
                      <tr>
                      <td rowspan = "1" colspan="4"> <input type="text" class="selectboletin"></td>

                      </tr>
                      <tr>
                        <th rowspan = "1" colspan="1"> N°</th>
                        <th rowspan = "1" colspan="1"> CEDULA</th>
                        <th rowspan = "1" colspan="1"> APELLIDOS</th>
                        <th rowspan = "1" colspan="1"> NOMBRES</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $contador = 0;
                            if ($row > 0) {

                                while ($data = $query->fetch()) {
                                    $contador++;

                                    ?>
                                    <tr>
                                        <td rowspan = "1" colspan = "1"><?php echo $contador;?></td>
                                        <td rowspan = "1" colspan = "1"> <?php echo $data['nacionalidad'].$data['cedulaes'];?></td>
                                        <td rowspan = "1" colspan = "1"> <?php echo $data['apellido_alumno'];?></td>
                                        <td rowspan = "1" colspan = "1"> <?php echo $data['nombre_alumno'];?></td>
                                        <?php 
                                            for ($i=0; $i < $evaluaciones; $i++) { 

                                        ?>
                                        <td rowspan = "1" colspan = "2"> <select class="selectboletin">
                                                                            <option value=" "> </option>
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
                                                                        </select> </td>
                                        
                                        <?php } ?>
                                        
                                        <td rowspan = "1" colspan = "2"> <select class="selectboletin">
                                                                            <option value=" "> </option>
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
                                                                        </select> </td>
                                        
                                           
                                                                        <?php 
                                                if (($siglas == "OYC") || ($siglas == "GP")) {
                                                    ?>
                                                    <th rowspan = "1" colspan="1" ><select class="selectboletin">
                                                                                        <option value=" "> </option>
                                                                                        <option value="A">A</option>
                                                                                        <option value="B">B</option>
                                                                                        <option value="C">C</option>
                                                                                        <option value="D">D</option>
                                                                                        <option value="IN">IN</option>

                                                                                    </select></th>
                                                    <?php
                                                }
                                            ?> 
                                    </tr>
                                
                                
                                <?php }?>









                            <?php }

                        ?>
                        <?php 
                            for ($i=0; $i < 2; $i++) { 
                                $contador++;
                                ?>
                                <tr>
                                    <td rowspan = "1" colspan = "1"><?php echo $contador;?></td>
                                    <td rowspan = "1" colspan = "1">  </td>
                                    <td rowspan = "1" colspan = "1">  </td>
                                    <td rowspan = "1" colspan = "1">  </td>
                                <?php
                                for ($p=0; $p < $evaluaciones; $p++) { 

                                ?>
                                    <td rowspan = "1" colspan = "2">  </td>
                                    
                                <?php
                                }
                            ?>
                                    <td rowspan = "1" colspan = "2">  </td>
                                    <?php 
                                                if (($siglas == "OYC") || ($siglas == "GP")) {
                                                    ?>
                                                    <th rowspan = "1" colspan="1" > </th>
                                                    <?php
                                                }
                                            ?>
                            </tr>

                            <?php
                            }
                        ?>
                    </tbody>
                </table>


<?php
    require_once 'includes/footer.php';
?>