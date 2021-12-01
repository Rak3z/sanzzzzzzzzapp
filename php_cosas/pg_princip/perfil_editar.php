<?php
session_start();
if(!empty($_POST)){
    $uid = $_SESSION['idUser'];
    if(isset($_POST['nombre'])){
        if(empty($_POST['nombre'])){
            $alert = "ingrese nombre valido";
        }else{
            require_once "conexion.php";
            $var = $_POST['nombre'];
            $sql = "UPDATE usuario SET nombre = '$var' WHERE rol = '$uid'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
    }
    if(isset($_POST['email'])){
        if(empty($_POST['email'])){
            $alert = "ingrese email valido";
        }else{
            require_once "conexion.php";
            $var = $_POST['email'];
            $sql = "UPDATE usuario SET correo = '$var' WHERE rol = '$uid'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
    }
    if(isset($_POST['fecha_n'])){
        if( empty($_POST['fecha_n'])){
            $alert = "ingrese fecha valida";
        }else{
            require_once "conexion.php";
            $var = $_POST['fecha_n'];
            $sql = "UPDATE usuario SET fecha_nacimiento = '$var' WHERE rol = '$uid'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
    }
    $sql = "SELECT * FROM usuario WHERE rol = '$uid'";
    foreach($pdo->query($sql) as $fila){//query llega
        $_SESSION['active']  = true;
        $_SESSION['idUser']  = $fila['rol'];
        $_SESSION['nombre']  = $fila['nombre'];
        $_SESSION['email']   = $fila['correo'];
        $_SESSION['fecha_n'] = $fila['fecha_nacimiento'];
        header('location: perfil.php');
    }//query no llega

}
    
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title> </title>
</head>
    <body>
        <section id = "container">
            <h2>editor de perfil</h2>
            <form action = "" method= "post">
                <h4>nombre</h4>
                <input type = "text" name ="nombre" placeholder = "nombre">    
                <div class ="alert" <?php isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "Editar">
            </form>
            <form action = "" method= "post">
                <h4>email</h4>
                <input type = "text" name ="email" placeholder = "email">      
                <div class ="alert" <?php isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "Editar">
            </form>
            <form action = "" method= "post">
                <h4>fecha nacimiento</h4>
                <input type = "text" name ="fecha_n" placeholder = "fecha nacimiento"> 
                <div class ="alert" <?php isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "Editar">
            </form>
        </section>
        <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
        </form>
    </body>
</html>