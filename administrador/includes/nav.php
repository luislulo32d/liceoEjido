<?php
      require_once '../includes/conexion.php';

      
?>

    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/user.jpeg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?php echo $_SESSION['nombre'];?></p>
          <p class="app-sidebar__user-designation"><?php echo $_SESSION['nombre_rol'];?></p>
          <?php if($_SESSION['rol'] == 1){
            $privilegios = 1;
          } elseif($_SESSION['rol'] == 2) {
            $privilegios = 2;
          } elseif($_SESSION['rol'] == 3) {
            $privilegios = 3;
          } ?>
        </div>
      </div>
      <ul class="app-menu">


      <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Inicio</span></a></li>

      <?php 
        if ($privilegios == 3) {?>
              <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-university"></i><span class="app-menu__label">Datos Del Liceo</span></a></li>
              <li><a class="app-menu__item" href="lista_usuarios_maxi.php"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Usuarios</span></a></li>
          
          <?php
        }else {?>
          
     
      <li><a class="app-menu__item" href="lista_usuarios.php"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Usuarios</span></a></li>

      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-id-card"></i><span class="app-menu__label">Tablas y Registros</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
          <li><a class="app-menu__item" href="lista_alumnos.php"><i class="app-menu__icon fa fa-address-book"></i><span class="app-menu__label">Alumnos</span></a></li>

          <li><a class="app-menu__item" href="lista_profesores.php"><i class="app-menu__icon fa fa-male"></i><span class="app-menu__label">Profesores</span></a></li>

          <li><a class="app-menu__item" href="lista_materias.php"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Materias</span></a></li>

          <li><a class="app-menu__item" href="lista_profesor_materia.php"><i class="app-menu__icon fa fa-graduation-cap"></i><span class="app-menu__label">Profesor Materias</span></a></li>

          <li><a class="app-menu__item" href="lista_aulas.php"><i class="app-menu__icon fa fa-folder-open"></i><span class="app-menu__label">Secciones</span></a></li>

          <li><a class="app-menu__item" href="lista_grupos.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Grupos</span></a></li>

          <li><a class="app-menu__item" href="lista_periodos.php"><i class="app-menu__icon fa fa-calendar"></i><span class="app-menu__label">Periodos</span></a></li>
          </ul>
      </li>

      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-tags"></i><span class="app-menu__label">Años</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
          <li><a class="app-menu__item" href="seleccion_primer_año.php"><i class="app-menu__icon fa fa-tag"></i><span class="app-menu__label">Primer Año</span></a></li>

          <li><a class="app-menu__item" href="seleccion_segundo_año.php"><i class="app-menu__icon fa fa-tag"></i><span class="app-menu__label">Segundo Año</span></a></li>

          <li><a class="app-menu__item" href="seleccion_tercer_año.php"><i class="app-menu__icon fa fa-tag"></i><span class="app-menu__label">Tercer Año</span></a></li>

          <li><a class="app-menu__item" href="seleccion_cuarto_año.php"><i class="app-menu__icon fa fa-tag"></i><span class="app-menu__label">Cuarto Año</span></a></li>

          <li><a class="app-menu__item" href="seleccion_quinto_año.php"><i class="app-menu__icon fa fa-tag"></i><span class="app-menu__label">Quinto Año</span></a></li>
          </ul>
      </li>
      
      
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper"></i><span class="app-menu__label">Generar Resumenes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
          <li><a class="app-menu__item" href="seleccion_resumenes.php?anio=1"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">Resumenes 1ero</span></a></li>
          <li><a class="app-menu__item" href="seleccion_resumenes.php?anio=2"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">Resumenes 2do</span></a></li>
          <li><a class="app-menu__item" href="seleccion_resumenes.php?anio=3"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">Resumenes 3ero</span></a></li>
          <li><a class="app-menu__item" href="seleccion_resumenes.php?anio=4"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">Resumenes 4to</span></a></li>
          <li><a class="app-menu__item" href="seleccion_resumenes.php?anio=5"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">Resumenes 5to</span></a></li>
          </ul>
      </li>
      
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-newspaper"></i><span class="app-menu__label">Generar N. Certificadas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
          <li><a class="app-menu__item" href="lista_notas_certificadas.php?anio=1"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">N. C. 1ero</span></a></li>
          <li><a class="app-menu__item" href="lista_notas_certificadas.php?anio=2"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">N. C. 2do</span></a></li>
          <li><a class="app-menu__item" href="lista_notas_certificadas.php?anio=3"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">N. C. 3ero</span></a></li>
          <li><a class="app-menu__item" href="lista_notas_certificadas.php?anio=4"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">N. C. 4to</span></a></li>
          <li><a class="app-menu__item" href="lista_notas_certificadas.php?anio=5"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">N. C. 5to</span></a></li>
          </ul>
      </li>
      
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-signal"></i><span class="app-menu__label">Generar Estadisticas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
          <li><a class="app-menu__item" href="grafica_estadistica.php"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">Estadistica de Generos</span></a></li>
          <li><a class="app-menu__item" href="grafica_edades.php"><i class="app-menu__icon fa fa-file-excel"></i><span class="app-menu__label">Estadistica de Edades</span></a></li>
          </ul>
      </li>

    
      <?php }
      ?>
      
      <li><a class="app-menu__item" href="ayuda.php"><i class="app-menu__icon fa fa-power-off"></i><span class="app-menu__label">Ayuda</span></a></li>
      <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fa fa-power-off"></i><span class="app-menu__label">Logout</span></a></li>
      </ul>
    </aside>