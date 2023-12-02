<?php
    require_once 'includes/header.php';
    require_once 'includes/modals/modal_estadistica.php';
    
   

?>

<main class="app-content">
  <div class="row">
      <div class="col-md-12 border shadow p-2 bg-info text-white">
        <h3 class="display-4 text-center">SISTEMA ESCOLAR - LICEO BOLIVARIANO EJIDO</h3>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>ESTADISTICAS GENERADAS</h4>
      <button class="btn btn-success" type="button" onclick="openModalEstadistica()">Nueva Estadistica</button>
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
