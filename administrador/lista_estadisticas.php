<?php
    require_once 'includes/header.php';
    require '../includes/conexion.php';
    if(!empty($_GET['an'])) {
        $an = $_GET['an'];
    }else {
        echo '<script> alert("Ups! No se a seleccionado correctamente el año")</script>';
    }

    if ($an == 1) {
        $nombreAño='Primer Año';
        $nombreTabla='primer_año';
        $nombreEstado='statuspr';
    }elseif ($an == 2) {
        $nombreAño='Segundo Año';
        $nombreTabla='segundo_año';
        $nombreEstado='statussg';
    }elseif ($an == 3) {
        $nombreAño='Tercer Año';
        $nombreTabla='tercer_año';
        $nombreEstado='statustr';
    }elseif ($an == 4) {
        $nombreAño='Cuarto Año';
        $nombreTabla='cuarto_año';
        $nombreEstado='statuscr';
    }else {
        $nombreAño='Quinto Año';
        $nombreTabla='quinto_año';
        $nombreEstado='statusqn';
    }
    $sql = "SELECT * FROM $nombreTabla as tp INNER JOIN alumnos as al ON tp.alumno_id = al.alumno_id INNER JOIN periodos as pe ON tp.periodo_id = pe.periodo_id WHERE pe.estado = 1 AND ($nombreEstado = 1 OR $nombreEstado = 2) ORDER BY aula_id";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();

    $contarLetras = 64;
    $seccionAnterior = 1;
    $seccionActual = 1;
    $textoFinal = "";
?>

<main class="app-content">
  <div class="row">
      <div class="col-md-12 border shadow p-2 bg-info text-white">
        <h3 class="display-4 text-center">SISTEMA ESCOLAR - LICEO BOLIVARIANO EJIDO </h3>
      </div>
  </div>

  <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="table_estadisticas">
                  <thead>
                    <tr>
                      <th>Año</th>

                      <th>Sección</th>


                      <th>M11</th>
                      <th>F11</th>

                      <th>M12</th>
                      <th>F12</th>

                      <th>M13</th>
                      <th>F13</th>

                      <th>M14</th>
                      <th>F14</th>

                      <th>M15</th>
                      <th>F15</th>

                      <th>M16</th>
                      <th>F16</th>

                      <th>M17</th>
                      <th>F17</th>

                      <th>M18</th>
                      <th>F18</th>

                      <th>MT</th>
                      <th>FT</th>

                      <th>TOTAL M</th>
                      <th>TOTAL F</th>

                      <th>TOTAL</th>

                      
                    </tr>
                  </thead>
                  <tbody>
        
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
