<?php
    $alert = "";
    session_start();
    if(!empty($_SESSION['active'])){
        header('location: index.php');
    }
    else{
        if(!empty($_POST)){
            if( empty($_POST['correo']) || empty($_POST['rol'])||empty($_POST['fecha_n'])||empty($_POST['nombre'])){
                $alert = "ingrese sus datos";
            }else{
                require_once "conexion.php";
                $reg_mail = $_POST['correo'];
                $reg_rol = $_POST['rol'];
                $reg_fn =  $_POST['fecha_n'];
                $reg_name = $_POST['nombre'];
                $sql = "SELECT * FROM usuario WHERE rol = '$reg_rol'";
                $flag = true;
                foreach($pdo->query($sql) as $fila){//query llega
                    if ($flag){
                        $alert = "Usuario existente";
                    }
                    $flag = false;
                }//query no llega
                if ($flag){
                    $sql = "INSERT INTO usuario VALUES ('$reg_rol','$reg_name','$reg_mail','$reg_fn')";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $sql = "SELECT * FROM usuario WHERE rol = '$reg_rol'";
                    foreach($pdo->query($sql) as $fila){//query llega
                        $_SESSION['idUser']  = $fila['rol'];
                        $_SESSION['nombre']  = $fila['nombre'];
                        $_SESSION['email']   = $fila['correo'];
                        $_SESSION['fecha_n'] = $fila['fecha_nacimiento'];
                        header('location: perfil.php');
                    }
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
            <h3>Registrarse</h3>
            <input type = "text" name ="nombre" placeholder = "nombre">
            <br><br>
            <input type = "text" name = "correo" placeholder = "correo">
            <br><br>
            <input type = "text" name = "fecha_n" placeholder = "fecha de nacimiento">
            <br><br>
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