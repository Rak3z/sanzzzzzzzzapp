<?php
session_start();
$id= urldecode($_GET['id']);

if(isset($_SESSION['active'])){
    echo "sesion activa: " .$_SESSION['nombre'];
}
if(!empty($_POST["calificacion"])){
    header("location: comentario.php?id=$id");
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
                <h4>añadir al carrito</h4>
                <input type= "submit" value = "Añadir">
            </form>

            <form action = "" method= "post">
                <h4>calificar</h4>
                <input type= "submit" name ="calificacion" value = "calificar">
            </form>

        </section>
        <h2>info del producto</h2>
        <?php
        require_once "conexion.php";
        $id= urldecode($_GET['id']);

        $sql = "SELECT * FROM productos WHERE id_producto = '$id'";
        
        foreach($pdo->query($sql) as $fila){//query llega
            $sql2 = "SELECT nombre FROM usuario WHERE rol = '".$fila['rol']."'";
            foreach($pdo->query($sql2) as $fila2){
                $nombre_vendedor = $fila2['nombre'];
            }
            $sql2 = "SELECT id_producto, count(*) as c FROM comentarios WHERE id_producto = '".$fila['id_producto']."'";
            foreach($pdo->query($sql2) as $fila2){
                $numero_com = $fila2['c'];
            }
            echo "<br>".$fila['nombre_producto']. ": </br>";
            echo "<ul>"."<li> ID : ".$fila['id_producto']."</li>".
                        "<li> nombre vendedor : ".$nombre_vendedor."</li>".
                        "<li> categoria : ".$fila['etiqueta_categoria']."</li>".
                        "<li> precio : ".$fila['precio']."</li>".
                        "<li> unidades disponibles : ".$fila['unidades_disp']."</li>".
                        "<li> numero calificaciones : ".$numero_com."</li>".
                        "<li> calificacion (0 sin comentarios): ".$fila['calificacion']."</li>".
                        "<li> cantidad vendida : "."RECUERDA IMPLEMENTAR ESA WEAAAAAAAAAAAAAAAAAAAA"."</li>".
                        "</ul>";
        }
        ?>
        <form action = "busqueda.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
        </form>
    </body>
</html>