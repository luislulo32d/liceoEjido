<?php
    session_start();
    if(!empty($_SESSION['active'])) {
        header('Location: administrador/');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>INGRESO LICEO BOLIVARIANO EJIDO</title>
</head>
<body>
<img class="wave" src="images/wave.png">
	<div class="container">
		<div class="img">
			<img class="wave" src="images/bg.svg">
		</div>
        <div class="cont-header">
			<img src="images/logoejido.png" width="200" height="200">
                <h1>¡Bienvenid@!</h1>
                
                    <div class="tab-content" id="myTabContent">
                            <form action="" onsubmit="return validar()">
                                <label for="usuario">Usuario</label>
                                <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
                                <label for="password">Contraseña</label>
                                <input type="password" name="pass" id="pass" placeholder="Contraseña">
                                <div id="messageUsuario"></div>
                                <button id="loginUsuario" type="button">INICIAR SESION</button>
                            </form>
        
    </header>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/login.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>