<?php
    require_once 'includes/header.php';
    

?>

<main class="app-content">
  <div class="row">
      <div class="col-md-12 border shadow p-2 bg-info text-white">
        <h3 class="display-4 text-center">SISTEMA ESCOLAR - LICEO BOLIVARIANO EJIDO</h3>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>RELACION GRUPOS-ALUMNOS</h4>
      <br>
      
    </div>
  </div>
  <div class="row">
    <?php 
     for ($i=1; $i < 6; $i++) { 
        if ($i==1) {
            $nombreAño = "Primer Año";
        }elseif ($i==2) {
            $nombreAño = "Segundo Año";
        }elseif ($i==3) {
            $nombreAño = "Tercer Año";
        }elseif ($i==4) {
            $nombreAño = "Cuarto Año";
        }else {
            $nombreAño = "Quinto Año";
        }
     
    ?>
    <div class="col-md-4 text-center border mt-3 p-1 bg-light">
        <div class="card m-2 shadow" style="width: 20rem;">
          <div class="card-body">
            <h4 class="card-title text-center"><?php echo $nombreAño;?></h4>
            <br><br><br>
            <a href="lista_grupos_alumnos.php?curso=<?php echo $i;?>" class="btn btn-secondary">Ver Todos los Alumnos</a>
            

          </div>
        </div>
    </div>
    <?php }  ?>
  </div>
</main>

<?php
require_once 'includes/footer.php';
?>