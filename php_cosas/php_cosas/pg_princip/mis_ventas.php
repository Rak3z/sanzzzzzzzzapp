<?php
session_start();
if(isset($_SESSION['active'])){
    echo "sesion activa: " .$_SESSION['nombre'];
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
            <h4>Mis productos</h4>
            <form action = "venta_edit.php" method= "post">
                <h4>Editar productos</h4>
                <input type= "submit" value = "Editar">
            </form>
            <form action = "vender.php" method= "post">
                <h4>Vender nuevo producto</h4>
                <input type= "submit" value = "vender">
            </form>
        </section>
        <h4>Productos a la venta</h4>
        <?php
        require_once "conexion.php";
        $uid = $_SESSION['idUser'];
        $sql = "SELECT nombre_producto, id_producto FROM productos WHERE rol = '$uid'";
        foreach($pdo->query($sql) as $fila){//query llega
            echo "<br> nombre_producto : id producto ";
            echo "<br>".$fila['nombre_producto']. " : ". $fila['id_producto']."<br>";
        }
        ?>
        <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
        </form>
    </body>
</html>