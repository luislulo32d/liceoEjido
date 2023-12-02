<?php
     if(!empty($_GET['cursante']) ||!empty($_GET['cedu']) ||!empty($_GET['nombrestu']) ||!empty($_GET['apellistu']) || !empty($_GET['nacionstu']) || !empty($_GET['fecnac']) || !empty($_GET['nomPerio']) || !empty($_GET['elPerio']) || !empty($_GET['anio']) || !empty($_GET['eF']) || !empty($_GET['mun']) || !empty($_GET['fecha_hoy']) || !empty($_GET['grup'])) {
       
       $id = $_GET['cursante'];
       $cedula = $_GET['cedu'];
       $nombre = $_GET['nombrestu'];
       $apellido = $_GET['apellistu'];
       $nacionalidad = $_GET['nacionstu'];
       $fechaN = $_GET['fecnac'];
       $periodo = $_GET['nomPerio'];
       $periodoid = $_GET['elPerio'];
       $anio = $_GET['anio'];
       $entidadFederal = $_GET['eF'];
       $municipio = $_GET['mun'];
       $fecha_hoy = $_GET['fecha_hoy'];

       $tabla_año[1] = "primer_año";
       $tabla_año[2] = "segundo_año";
       $tabla_año[3] = "tercer_año";
       $tabla_año[4] = "cuarto_año";
       $tabla_año[5] = "quinto_año";
       
       
       


       if ($nacionalidad == "V-") {
        $nacimiento = "VENEZUELA";
       }else {
        $nacimiento = "EXTRANJERO";
       }
    }else {
      echo '<script> alert("Ups! No se a seleccionado correctamente el alumno")</script>';
    }
    
    if ($anio == 1) {
      $nombre_año = "PRIMER AÑO";
    }elseif ($anio == 2) {
      $nombre_año = "SEGUNDO AÑO";
    }elseif ($anio == 3) {
      $nombre_año = "TERCER AÑO";
    }elseif ($anio == 4) {
      $nombre_año = "CUARTO AÑO";
    }elseif ($anio == 5) {
      $nombre_año = "QUINTO AÑO";
    }else {
      echo '<script> alert("Ups! No se a seleccionado correctamente el año")</script>';
      $nombre_año = "ERROR";
      $anio = 5;

      $generadorBoton = 0;
    }
    require_once '../includes/conexion.php';
    require_once 'includes/header.php';

        /* NOTAS */

        for ($i=1; $i <= $anio; $i++) { 
          $sql = "SELECT * FROM notas as nt INNER JOIN materias as mt ON nt.materia_id = mt.materia_id INNER JOIN periodos as pe ON nt.periodo_id = pe.periodo_id WHERE nt.alumno_id = $id AND nt.curso = $i AND estadonota != 0 ORDER BY nt.materia_id";
          
          $query = $pdo->prepare($sql);
          $query->execute();
          $consultas[$i] = $query->fetchAll(PDO::FETCH_ASSOC);


          $cantidadMaterias[$i] = count($consultas[$i]);

          if ($cantidadMaterias[$i] > 0) {

            for($p = 0; $p < $cantidadMaterias[$i];$p++) {
              
              $nombreMateria[$i][$p] = $consultas[$i][$p]['nombre_materia'];
              $periodoN[$i][$p] = $consultas[$i][$p]['nombre_periodo'];
              $siglas[$i][$p] = $consultas[$i][$p]['siglas'];
              $tipoNota[$i][$p] = $consultas[$i][$p]['estadonota'];


              if ($tipoNota[$i][$p] == 2) {
                $tipoNota[$i][$p] = "F";
              }elseif ($tipoNota[$i][$p] == 1) {
                $tipoNota[$i][$p] = "R";
              }else {
                $tipoNota[$i][$p] = "P";
              }
              
              if (($consultas[$i][$p]['promedio'] > 0) && ($consultas[$i][$p]['promedio'] < 21)) {
                $promedio[$i][$p] = $consultas[$i][$p]['promedio'];
              }else {
                $promedio[$i][$p] = 0;
              }


              

              /* Números en castellano...*/
              if ($promedio[$i][$p] <= 9) {
                $nombreNota[$i][$p]= "PENDIENTE";
              }elseif ($promedio[$i][$p] == 10) {
                $nombreNota[$i][$p]= "DIEZ";
              }elseif ($promedio[$i][$p] == 11) {
                $nombreNota[$i][$p]= "ONCE";
              }elseif ($promedio[$i][$p] == 12) {
                $nombreNota[$i][$p]= "DOCE";
              }elseif ($promedio[$i][$p] == 13) {
                $nombreNota[$i][$p]= "TRECE";
              }elseif ($promedio[$i][$p] == 14) {
                $nombreNota[$i][$p]= "CATORCE";
              }elseif ($promedio[$i][$p] == 15) {
                $nombreNota[$i][$p]= "QUINCE";
              }elseif ($promedio[$i][$p] == 16) {
                $nombreNota[$i][$p]= "DIECISEIS";
              }elseif ($promedio[$i][$p] == 17) {
                $nombreNota[$i][$p]= "DIECISIETE";
              }elseif ($promedio[$i][$p] == 18) {
                $nombreNota[$i][$p]= "DIECIOCHO";
              }elseif ($promedio[$i][$p] == 19) {
                $nombreNota[$i][$p]= "DIECINUEVE";
              }elseif ($promedio[$i][$p] == 20) {
                $nombreNota[$i][$p]= "VEINTE";
              }
            }
          }
          

        }

        for ($g=1; $g <= $anio; $g++) { 
          $sql = "SELECT * FROM $tabla_año[$g] as ta INNER JOIN grupos as gr ON ta.grupo_id = gr.grupo_id WHERE ta.alumno_id = $id";
          $query = $pdo->prepare($sql);
          $query->execute();
          $grupo[$g] = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* DATOS LICEO */

        $sql = "SELECT * FROM datos_liceo ";
          
        $query = $pdo->prepare($sql);
        $query->execute();
        $liceo = $query->fetchAll(PDO::FETCH_ASSOC);

        


?>

<main class="app-content">
  <div class="row">
      <div class="col-md-12 border shadow p-2 bg-info text-white">
        <h3 class="display-4 text-center">SISTEMA ESCOLAR - LICEO BOLIVARIANO EJIDO</h3>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>GENERAR NOTAS CERTIFICADAS DEL ALUMNO</h4>
    </div>
  </div>

    <?php if ($nombre_año != "ERROR") {
      
    ?>
    <div class="row">
      <div class="col-md-12 text-center border mt-3 p-4 bg-light">
     
     
      <div class="modal-body">

        <form id="generar_notas_certificadas_reporte" name="generar_notas_certificadas_reporte" action="generar_notas_certificadas_reporte.php" method="POST">
            

            <input type="hidden" class="form-control" name="fecha_hoy" id="fecha_hoy" value="<?php echo $fecha_hoy;?>" readonly>              

            <!-- DATOS DEL LICEO -->
            <input type="hidden" class="form-control" name="nombre_Liceo" id="nombre_Liceo" value="<?php echo $liceo[0]['nombre_liceo'];?>" readonly>              
            <input type="hidden" class="form-control" name="zonaedu_liceo" id="zonaedu_liceo" value="Nº <?php echo $liceo[0]['zonaedu_liceo'];?>" readonly>              
            <input type="hidden" class="form-control" name="entidad_liceo" id="entidad_liceo" value="ESTADO <?php echo $liceo[0]['entidad_liceo'];?>" readonly>              
            <input type="hidden" class="form-control" name="ef_liceo" id="ef_liceo" value="<?php echo $liceo[0]['ef_liceo'];?>" readonly>              
            <input type="hidden" class="form-control" name="direccion_liceo" id="direccion_liceo" value="<?php echo $liceo[0]['direccion_liceo'];?>" readonly>              
            <input type="hidden" class="form-control" name="municipio_liceo" id="municipio_liceo" value="<?php echo $liceo[0]['municipio_liceo'];?>" readonly>              
            <input type="hidden" class="form-control" name="telefono_liceo" id="telefono_liceo" value="<?php echo $liceo[0]['telefono_liceo'];?>" readonly>              
            <input type="hidden" class="form-control" name="codigo_liceo" id="codigo_liceo" value="<?php echo $liceo[0]['código_liceo'];?>" readonly> 
            
            <input type="hidden" class="form-control" name="nombre_director" id="nombre_director" value="<?php echo $liceo[0]['nombre_director'];?>" readonly> 
            <input type="hidden" class="form-control" name="apellido_director" id="apellido_director" value="<?php echo $liceo[0]['apellido_director'];?>" readonly> 
            <input type="hidden" class="form-control" name="cedula_director" id="cedula_director" value="<?php echo $liceo[0]['nacionalidad_director'].' '.$liceo[0]['cedula_director'];?>" readonly> 
            

        
            <!-- NOTAS DEL ALUMNO -->
            <?php 
                for ($k=1; $k <= $anio ; $k++) { ?>
                  
                  <input type="hidden" class="form-control" name="cantidadM_<?= $k?>" id="cantidadM_<?= $k?>" value="<?php echo $cantidadMaterias[$k];?>" readonly>
                  <input type="hidden" class="form-control" name="grupo_<?= $k?>" id="grupo_<?= $k?>" value="<?php echo $grupo[$k][0]['nombre_grupo'];?>" readonly>
                  <?php
                  for ($l=0; $l < $cantidadMaterias[$k]; $l++) { 
                    
                  ?>
                  
                        <input type="hidden" class="form-control" name="nombreM_<?= $k?>_<?= $l?>" id="nombreM_<?= $k?>_<?= $l?>" value="<?php echo $nombreMateria[$k][$l];?>" readonly>
                        <input type="hidden" class="form-control" name="nombreN_<?= $k?>_<?= $l?>" id="nombreN_<?= $k?>_<?= $l?>" value="<?php echo $nombreNota[$k][$l];?>" readonly>
                        <input type="hidden" class="form-control" name="periodoN_<?= $k?>_<?= $l?>" id="periodoN_<?= $k?>_<?= $l?>" value="<?php echo $periodoN[$k][$l];?>" readonly>
                        <input type="hidden" class="form-control" name="siglasM_<?= $k?>_<?= $l?>" id="siglasM_<?= $k?>_<?= $l?>" value="<?php echo $siglas[$k][$l];?>" readonly>              
                        <input type="hidden" class="form-control" name="promedio_<?= $k?>_<?= $l?>" id="promedio_<?= $k?>_<?= $l?>" value="<?php echo $promedio[$k][$l];?>" readonly>              
                        <input type="hidden" class="form-control" name="tipoN_<?= $k?>_<?= $l?>" id="tipoN_<?= $k?>_<?= $l?>" value="<?php echo $tipoNota[$k][$l];?>" readonly>              
              
              
              <?php }
              }
            ?>

            <!-- DATOS DEL ALUMNO -->
            <input type="hidden" name="el_año_seleccion" id="el_año_seleccion" value="<?=$anio;?>" readonly>
            <input type="hidden" name="municipio" id="municipio" value="<?=$municipio;?>" readonly>
            <input type="hidden" name="efDelAlumno" id="efDelAlumno" value="<?=$entidadFederal;?>" readonly>
            <input type="hidden" name="paiz" id="paiz" value="<?=$nacimiento;?>" readonly>
            <input type="hidden" name="fechaDelAlumno" id="fechaDelAlumno" value="<?=$fechaN;?>" readonly>

            <div class="form-group">
                <label for="nombreDelAlumno">Nombre Del Alumno:</label>
                <input type="text" class="form-control" name="nombreDelAlumno" id="nombreDelAlumno" value="<?=$nombre;?>" readonly>
            </div>

            <div class="form-group">
                <label for="apellidoDelAlumno">Apellido Del Alumno:</label>
                <input type="text" class="form-control" name="apellidoDelAlumno" id="apellidoDelAlumno" value="<?=$apellido;?>" readonly>
            </div>

            <div class="form-group">
                <label for="cedulaDelAlumno">Cedula Del Alumno:</label>
                <input type="text" class="form-control" name="cedulaDelAlumno" id="cedulaDelAlumno" value="<?=$nacionalidad;?> <?=$cedula;?>" readonly>
            </div>

          
          <button class="btn btn-success" type="submit">Generar Reporte</button>
        </form>
      </div>
      </div>
    </div>
    
        </div>
    </div>

  </div>
 <?php }?>
</main>

<?php
require_once 'includes/footer.php';
?>