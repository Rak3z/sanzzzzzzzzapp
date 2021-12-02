<?php
session_start();
if(!empty($_POST) && !empty($_POST['id_prod'])){
    $uid = $_POST['id_prod'];
    require_once "conexion.php";
    if(isset($_POST['nombre'])){
        if(empty($_POST['nombre'])){
            $alert = "ingrese nombre valido";
        }else{
            $var = $_POST['nombre'];
            $sql = "UPDATE productos SET nombre_producto = '$var' WHERE id_producto = '$uid'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
    }
    if(isset($_POST['descripcion'])){
        if(empty($_POST['descripcion'])){
            $alert = "ingrese descripcion valida";
        }else{
            $var = $_POST['descripcion'];
            $sql = "UPDATE productos SET descripcion = '$var' WHERE id_producto = '$uid'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
    }
    if(isset($_POST['categoria'])){
        if(empty($_POST['categoria'])){
            $alert = "ingrese categoria valida";
        }else{
            $var = $_POST['categoria'];
            $sql = "UPDATE productos SET etiqueta_categoria = '$var' WHERE id_producto = '$uid'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
    }
    if(isset($_POST['precio'])){
        if(empty($_POST['precio'])){
            $alert = "ingrese precio valido";
        }else{
            $var = $_POST['precio'];
            $sql = "UPDATE productos SET precio = '$var' WHERE id_producto = '$uid'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
    }
    if(isset($_POST['unid_disp'])){
        if(empty($_POST['unid_disp'])){
            $alert = "ingrese unid_disp valido";
        }else{
            $var = $_POST['unid_disp'];
            $sql = "UPDATE productos SET unidades_disp = '$var' WHERE id_producto = '$uid'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
    }
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
            <form action = "" method= "post">
                <h4>nombre producto</h4>
                <input type = "text" name ="id_prod" placeholder = "id del producto a editar">   
                <input type = "text" name ="nombre" placeholder = "nombre">    
                <div class ="alert" <?php echo isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "Editar">
            </form>
            <form action = "" method= "post">
                <h4>descripcion producto</h4>
                <input type = "text" name ="id_prod" placeholder = "id del producto a editar">   
                <input type = "text" name ="descripcion" placeholder = "descripcion">      
                <div class ="alert" <?php echo isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "Editar">
            </form>
            <form action = "" method= "post">
                <h4>categoria</h4>
                <input type = "text" name ="id_prod" placeholder = "id del producto a editar">   
                <input type = "text" name ="categoria" placeholder = "categoria"> 
                <div class ="alert" <?php echo isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "Editar">
            </form>
            <form action = "" method= "post">
                <h4>precio</h4>
                <input type = "text" name ="id_prod" placeholder = "id del producto a editar">   
                <input type = "text" name ="precio" placeholder = "precio"> 
                <div class ="alert" <?php echo isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "Editar">
            </form>
            <form action = "" method= "post">
                <h4>unidades disponibles</h4>
                <input type = "text" name ="id_prod" placeholder = "id del producto a editar">   
                <input type = "text" name ="unid_disp" placeholder = "unidades disponibles"> 
                <div class ="alert" <?php echo isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "Editar">
            </form>
            <form action = "" method= "post">
                <h4>borrar producto</h4>
                <div class ="alert" <?php echo isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "Borrar">
            </form>
        </section>
        <h2>productos actualmente disponibles</h2>
        <?php
        require_once "conexion.php";
        $uid = $_SESSION['idUser'];
        $sql = "SELECT * FROM productos WHERE rol = '$uid'";
        foreach($pdo->query($sql) as $fila){//query llega
            echo "<br> nombre_producto : id producto </br>";
            echo "<br>".$fila['nombre_producto']. ": </br>";

            echo "<ul>"."<li> ID : ".$fila['id_producto']."</li>".
                        "<li> categoria : ".$fila['etiqueta_categoria']."</li>".
                        "<li> precio : ".$fila['precio']."</li>".
                        "<li> unidades disponibles : ".$fila['unidades_disp']."</li>".
                        "<li> calificacion (0 sin comentarios): ".$fila['calificacion']."</li>".
                        "<li> cantidad vendida : "."RECUERDA IMPLEMENTAR ESA WEAAAAAAAAAAAAAAAAAAAA"."</li>".
                        "</ul>";
        }
        ?>
        <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
        </form>
    </body>
</html>