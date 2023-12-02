<?php
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';

    $sql = "SELECT * FROM aulas WHERE estado = 1";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();

?>

<main class="app-content">
  <div class="row">
      <div class="col-md-12 border shadow p-2 bg-info text-white">
        <h3 class="display-4 text-center">SISTEMA ESCOLAR - LICEO BOLIVARIANO EJIDO</h3>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>QUINTO AÑO</h4>
      <br>
      <a href="lista_quinto_año_total.php" class="btn btn-info">Ver Todos los Alumnos de Todas las Secciones</a>

    </div>
  </div>
  <div class="row">
    <?php if($row > 0) {
      while($data = $query->fetch()) {
    ?>
    <div class="col-md-4 text-center border mt-3 p-1 bg-light">
        <div class="card m-2 shadow" style="width: 20rem;">
          <div class="card-body">
            <h4 class="card-title text-center">Quinto Año</h4>
            <h5 class="card-tittle">Seccion <kbd class="bg-info"><?= $data['nombre_aula'] ?></kbd></h5>
            <a href="lista_quinto_año.php?seccion=<?= $data['aula_id'] ?>&nombreSeccion=<?= $data['nombre_aula']?>" class="btn btn-secondary">Ver Todos los Alumnos</a>
            <br><br>
            <a href="lista_quinto_año_activos.php?seccion=<?= $data['aula_id'] ?>&nombreSeccion=<?= $data['nombre_aula']?>" class="btn btn-primary">Ver Alumnos En Periodo Activo</a>
          </div>
        </div>
    </div>
    <?php } } ?>
  </div>
</main>

<?php
require_once 'includes/footer.php';
?>