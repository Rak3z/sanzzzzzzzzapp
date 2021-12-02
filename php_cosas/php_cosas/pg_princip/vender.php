<?php
    $alert = "";
    session_start();
    if(!empty($_POST)){
        if( empty($_POST['nombre_producto']) || empty($_POST['descripcion'])||empty($_POST['categoria'])||empty($_POST['precio'])||empty($_POST['unidades'])){
            $alert = "ingrese sus datos";
        }else{
            require_once "conexion.php";
            $reg_name_prod = $_POST['nombre_producto'];
            $reg_desc_prod = $_POST['descripcion'];
            $reg_cat_prod =  $_POST['categoria'];
            $reg_precio_prod = $_POST['precio'];
            $reg_unidades_prod = $_POST['unidades'];
            $reg_rol = $_SESSION['idUser'];
            $fecha = new DateTime();
            $reg_id_prod =  $fecha->getTimestamp(); //id basado en el tiempo, de esta forma es unico

            $sql = "INSERT INTO productos VALUES ('$reg_id_prod','$reg_rol','$reg_name_prod','$reg_desc_prod','$reg_cat_prod','$reg_precio_prod','$reg_unidades_prod','0')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
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
            <h3>Registrar producto</h3>
            <input type = "text" name ="nombre_producto" placeholder = "nombre producto">
            <br><br>
            <input type = "text" name = "descripcion" placeholder = "descripcion">
            <br><br>
            <input type = "text" name = "categoria" placeholder = "etiqueta">
            <br><br>
            <input type = "text" name = "precio" placeholder = "precio">
            <br><br>
            <input type = "text" name = "unidades" placeholder = "unidades">
            <div class ="alert" <?php isset($alert)? $alert : ""; ?>></div>
            <input type= "submit" value = "Ingresar" >
        </form>
    </section>
    <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
    </form>
</body>
</html>