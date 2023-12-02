<?php
    require_once 'includes/header.php';
    require_once 'includes/modals/modal_periodo.php';
?>

<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Periodos (Se recomienda tener solo un periodo activo para evitar problemas a la hora de generar boletines, generar resumenes o registrar estudiantes)</h1>
            <button class="btn btn-success" type="button" onclick="openModalPeriodo()">Nuevo Periodo</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de Periodos</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableperiodos">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>NOMBRE DEL PERIODO</th>
                      <th>ESTADO</th>
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