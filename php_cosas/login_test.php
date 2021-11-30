<?php
    $alert = '';
    if(!empty($_POST)){
        if( empty($_POST['usuario']) || empty($_POST['clave'])){
            $alert = 'ingrese correo y rol';
        }else{
            require_once "conexion.php";
            $user = $_POST['usuario'];
            $pass = $_POST['clave'];

            $gsent = $pdo->prepare('SELECT * FROM usuario WHERE correo = "$user" AND rol = "$clave"');
            $gsent->execute();
            $result = $gsent->fetchAll();
            if ($result > 0){
                print_r($result);
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
            <input type = "text" name ="usuario" placeholder = "correo">
            <input type = "password" name = "clave" placeholder = "rol">
            <p><button type= "sumbit">Ingresar</button></p>
        </form>
    </section>
</body>
</html>