<?php
    if(!empty($_GET['curso'])) {
      $anio = $_GET['curso'];
    }else {
      echo '<script> alert("Ups! No se a seleccionado correctamente el año")</script>';
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
    }
    require_once '../includes/conexion.php';
    require_once 'includes/header.php';


       $sql = "SELECT materia_id, siglas, año_seleccion, estado FROM materias WHERE estado != 0 AND año_seleccion = $anio ORDER BY materia_id";
        $query = $pdo->prepare($sql);
        $query->execute();
        $consultas = $query->fetchAll(PDO::FETCH_ASSOC);
        $nombreFinal;
        $nombre_siglas = 'a';
        $cantidadMaterias = 0;
        $int = count($consultas);

        if ($int > 0) {
          for($p = 0; $p < $int;$p++) {
            $nombre_sigla = $consultas[$p]['siglas'];
            if ($nombre_sigla != $nombre_siglas) {
              $nombre_siglas = $nombre_sigla;
              if (strlen($nombre_siglas) < 3) {
                $nombreFinal[$cantidadMaterias] = $nombre_siglas." ";
              }else {
                $nombreFinal[$cantidadMaterias] = $nombre_siglas;
              }
              $cantidadMaterias++;
            
            }
          }
        }
        

?>

<main class="app-content">
  <div class="row">
      <div class="col-md-12 border shadow p-2 bg-info text-white">
        <h3 class="display-4 text-center">SISTEMA ESCOLAR - LICEO BOLIVARIANO EJIDO</h3>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>GENERAR NOTAS DE <?php echo $nombre_año;?></h4>
    </div>
  </div>

    <?php if ($nombre_año != "ERROR") {
      
    ?>
    <div class="row">
      <div class="col-md-12 text-center border mt-3 p-4 bg-light">
     
     
      <div class="modal-body">

        <form id="generar_notas" name="generar_notas" action="generar_notasa.php" method="POST">
            
         

            <input type="hidden" name="el_año_seleccion" id="el_año_seleccion" value=<?=$anio;?>>


            <div class="form-group">
            <label for="listAula">Seleccione la seccion</label>
            <select class="form-control" name="listAula" id="listAula">
                <!-- CONTENIDO AJAX -->
            </select>         
          </div>
          
          <div class="form-group">
            <label for="listPeriodo">Seleccione el Periodo</label>
            <select class="form-control" name="listPeriodo" id="listPeriodo">
                <!-- CONTENIDO AJAX -->
            </select>         
          </div>

          <div class="form-group">
            <label for="tipoLapso">Seleccione el Lapso</label>
            <select class="form-control" name="listLapso" id="listLapso">
                <option value=1>PRIMER LAPSO</option>
                <option value=2>SEGUNDO LAPSO</option>
                <option value=3>TERCER LAPSO</option>
                <option value=4>PROMEDIO</option>
            </select>         
          </div>
          
          
          <input type="hidden" name="siglas_seleccion" id="siglas_seleccion" value="<?php 
                                                                                        for ($co=0; $co < $cantidadMaterias; $co++) { 
                                                                                          echo $nombreFinal[$co];
                                                                                        }
                                                                                      ?>">

          
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