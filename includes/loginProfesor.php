<?php
session_start();
if(!empty($_POST)) {
    if(empty($_POST['loginProfesor']) || empty($_POST['passProfesor'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Todos los campos son necesarios</div>';
    } else {
        require_once 'conexion.php';
        $login = $_POST['loginProfesor'];
        $pass = $_POST['passProfesor'];

        $sql = 'SELECT * FROM profesor WHERE cedula = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($login));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($query->rowCount() > 0) {
            if(password_verify($pass, $result['clave'])) {
                $_SESSION['activeP'] = true;
                $_SESSION['profesor_id'] = $result['profesor_id'];
                $_SESSION['nombre'] = $result['nombre'];
                $_SESSION['cedula'] = $result['cedula'];
                $_SESSION['nivEstu'] = $result['nivel_est'];

                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Redireccionando</div>';
            }else {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Usuario o Clave incorrectos</div>';
            }
        } else {
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Usuario o Clave incorrectos</div>';
        }
    } 
}


