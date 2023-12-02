<?php
  /*session_start();
  if(empty($_SESSION['active'])) {
    header('Location: ../');
  }*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Sistema de control de notas">
    <title>LICEO EUTIMIO RIVAS - CONTROL DE NOTAS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    
    <!-- Font-icon css-->
    <!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.php">Liceo Eutimio Rivas</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="../index.php"><i class="fa fa-sign-out fa-lg"></i> volver atrás</a></li>
          </ul>
        </li>
      </ul>
    </header>
<?php 
    require_once 'nav.php';
?>