<?php

  require_once 'includes/header.php';



?>

<main class="app-content">
  <div class="row">
      <div class="col-md-12 border shadow p-2 bg-info text-white">
        <h3 class="display-4 text-center">SISTEMA ESCOLAR - ESTADISTICAS</h3>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>GENERAR ESTADISTICAS</h4>
    </div>
  </div>

    <div class="row">
      <div class="col-md-12 text-center border mt-3 p-4 bg-light">
     
      <div class="modal-body">

          <a href="grafica_estadistica.php" class="btn btn-info">Grafica de Generos de Todos los años</a>

          
      </div>
    </div>
    <br><br>
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">

    <div class="modal-body">


          <a href="grafica_edades.php" class="btn btn-info">Grafica de Edades de Todos los años</a>


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