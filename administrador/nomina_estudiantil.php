<?php

    if(!empty($_GET['curso']) || !empty($_GET['aul']) || !empty($_GET['aulid'])) {
        $curso = $_GET['curso'];
        $seccion = $_GET['aul']; 
        $seccion_id = $_GET['aulid']; 


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
    $contador = 0;
    $masculinos = 0;
    $femeninas = 0;

?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Nomina Estudiantil de <?php echo $grado.' "'.$seccion.'"';?> </h1>
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
                
                <table width=600pp class="text-center-boletin" cellpadding="0" cellspacing="0" bordercolor="#000000">

                    <div class="piedeboletin"></div>
                    <colgroup>
                        <col style="width: 3%">
                        <col style="width: 15%">
                        <col style="width: 15%">
                        <col style="width: 29%">
                        <col style="width: 29%">

                        <col style="width: 4%">
                        <col style="width: 4%">
                        
                        <col style="width: 4%">
                        <col style="width: 4%">

                        <col style="width: 6%">
                        
                        <col style="width: 20%">
                    </colgroup>

                    <thead>
                        <tr>
                            <th rowspan = "2" colspan="5"> <img src="images/boletinCabeceraLiceoEjido.png" width="310pp" alt="cabecera"></th>
                            <th rowspan = "2" colspan="6"> AÑO ESCOLAR <select class="selectboletin">
                                                                <option value="2022-2023">2022-2023</option>
                                                                <option value="2023-2024">2023-2024</option>
                                                                <option value="2024-2025">2024-2025</option>
                                                                <option value="2025-2026">2025-2026</option>
                                                                <option value="2026-2027">2026-2027</option>
                                                                <option value="2027-2028">2027-2028</option>
                                                                <option value="2028-2029">2028-2029</option>
                                                                <option value="2029-2030">2029-2030</option>
                                                            </select></th>
                        </tr>

                        <tr>

                        </tr>

                        <tr>
                            <th rowspan = "1" colspan="3"> AÑO: <?php echo $curso;?>°</th>
                            <th rowspan = "1" colspan="1"> SECCION: "<?php echo $seccion;?>"</th>
                            <td rowspan = "1" colspan="7" align="left"> COORDINADOR PEDAGÓGICCO:<input type="text" class="selectboletin" style="width: 135px;"> </td>
                            
                        </tr>

                        <tr>
                            <td rowspan = "1" colspan="11" align="left"> DOCENTE GUIA:<input type="text" class="selectboletin" style="width: 285px;"> </td>
                            
                        </tr>

                        <tr>
                            <th rowspan = "2" colspan="1"> N°</th>
                            <th rowspan = "2" colspan="1"> CEDULA ESTUDIANTIL</th>
                            <th rowspan = "2" colspan="1"> CEDULA DE IDENTIDAD</th>
                            <th rowspan = "2" colspan="1"> APELLIDOS</th>
                            <th rowspan = "2" colspan="1"> NOMBRES</th>

                            <th rowspan = "1" colspan="2"> SEXO </th>
                            <th rowspan = "1" colspan="2"> MP </th>
                            <th rowspan = "1" colspan="1">REP</th>

                            <th rowspan = "2" colspan="1"> OBSERVACIONES </th>

                        </tr>
                        <tr>
                            <th rowspan = "1" colspan="1">M</th>
                            <th rowspan = "1" colspan="1">F</th>

                            <th rowspan = "1" colspan="1">1</th>
                            <th rowspan = "1" colspan="1">2</th>

                            <th rowspan = "1" colspan="1">3Y+</th>



                        </tr>
                    </thead>

                    <tbody>
                        
                        <?php if ($row > 0) {
                                while ($data = $query->fetch()) {
                                    $contador++;
                                   
                                    
                        ?>
                                <tr>
                                        <td rowspan = "1" colspan = "1"><?php echo $contador;?></td>
                                        <td rowspan = "1" colspan = "1"> <?php echo $data['cedu_estudiantil'];?></td>
                                        <td rowspan = "1" colspan = "1"> <?php echo $data['nacionalidad'].$data['cedulaes'];?></td>
                                        <td rowspan = "1" colspan = "1"> <?php echo $data['apellido_alumno'];?></td>
                                        <td rowspan = "1" colspan = "1"> <?php echo $data['nombre_alumno'];?></td>
                                        <?php if ($data['sexo']=="M") {
                                            $masculinos++;
                                        ?>
                                            <td rowspan = "1" colspan = "1">M</td>
                                            <td rowspan = "1" colspan = "1"> </td>
                                        <?php }elseif ($data['sexo']=="F") {
                                            $femeninas++;
                                            ?>
                                            <td rowspan = "1" colspan = "1"> </td>
                                            <td rowspan = "1" colspan = "1">F</td>
                                        <?php }else {?>
                                            <td rowspan = "1" colspan = "1"> </td>
                                            <td rowspan = "1" colspan = "1"> </td>
                                        <?php }?>

                                        <td rowspan = "1" colspan = "1"> <select class="selectboletin">
                                                                            <option value=""> </option>
                                                                            <option value="X">X</option>
                                                                        </select>
                                        </td>
                                        <td rowspan = "1" colspan = "1"> <select class="selectboletin">
                                                                            <option value=""> </option>
                                                                            <option value="X">X</option>
                                                                        </select>
                                        </td>
                                        <td rowspan = "1" colspan = "1"> <select class="selectboletin">
                                                                            <?php if ($data[$tablaEstado] == 1) {?>
                                                                                <option value=" "> </option>
                                                                                <option value="X">X</option>
                                                                            <?php }else {?>
                                                                            <option value="X">X</option>
                                                                            <option value=" "> </option>
                                                                            <?php }?>
                                                                        </select>
                                        </td>
                                         <td rowspan = "1" colspan="1" align="left"> <input type="text" class="selectboletin" style="width: 108px;"></td>

                                        
                        
                                </tr>
                        
                        
                        
                        
                        <?php }}?>

                        <tr>
                            <td rowspan = "1" colspan = "5">NOMINAS ACTUALIZADAS HASTA EL <?php echo date("d/m/Y");?></td>
                            <td rowspan = "1" colspan = "1"><?php echo $masculinos;?></td>
                            <td rowspan = "1" colspan = "1"><?php echo $femeninas;?></td>
                            <td rowspan = "1" colspan = "4">TOTAL DE MATRICULA: <?php echo $contador;?></td>

                        </tr>
                    </tbody>

                </table>



                <?php
    require_once 'includes/footer.php';
?>