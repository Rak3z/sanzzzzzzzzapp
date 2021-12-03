<?php
    $alert = "";
    session_start();
    if(!empty($_SESSION['active'])){
        header('location: index.php');
    }
    else{
        if(!empty($_POST)){
            if( empty($_POST['correo']) || empty($_POST['rol'])){
                $alert = "ingrese correo y rol";
            }else{
                require_once "conexion.php";
                $log_user = $_POST['correo'];
                $log_pass = $_POST['rol'];

                $sql = "SELECT * FROM usuario WHERE correo = '$log_user' AND rol = '$log_pass'";
                $flag = true;
                foreach($pdo->query($sql) as $fila){//query llega
                    $flag = false;
                    $_SESSION['active']  = true;
                    $_SESSION['idUser']  = $fila['rol'];
                    $_SESSION['nombre']  = $fila['nombre'];
                    $_SESSION['email']   = $fila['correo'];
                    $_SESSION['fecha_n'] = $fila['fecha_nacimiento'];
                    header('location: index.php');
                }//query no llega
                if ($flag){
                    $alert = "Usuario o clave incorrecto";
                    session_destroy();
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>login | sansapp </title>
</head>
<body>
    <section id = "container">
        <form action = "" method= "post">
            <h3>Iniciar sesion</h3>
            <input type = "text" name ="correo" placeholder = "Correo">
            <input type = "text" name = "rol" placeholder = "Rol">
            <div class ="alert" <?php isset($alert)? $alert : ""; ?>></div>
            <input type= "submit" value = "Ingresar" >
        </form>
    </section>
    <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
    </form>
</body>
</html>