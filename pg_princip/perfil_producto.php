<?php
session_start();
$id= urldecode($_GET['id']);
var_dump($_POST);
if(isset($_SESSION['active'])){
    echo "sesion activa: " .$_SESSION['nombre'];
}
if(!empty($_POST["calificacion"])){
    header("location: comentario.php?id=$id");
}
elseif(!empty($_POST["carito"])){
    header("location: carrito.php?id=$id");
}
else{
    foreach ($_POST as $param_name => $param_val) {
        if($param_val == "ir a pagina del usuario"){
            header("location: perfil3ros.php?id=$param_name");
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
                <h4>añadir al carrito</h4>
                <input type= "submit" name ="carito" value = "Añadir">
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
                $id_vendedor = $fila['rol'];
                $nombre_vendedor = $fila2['nombre'];
            }
            echo  "<br>perfil del vendedor</br>";
            echo "  <form action = '' method= 'post'> <!action manda a llamara al otro archivo>
                        <input type= 'submit' name = '".$id_vendedor."' value = 'ir a pagina del usuario' />
                    </form>";
            

            echo "<br>".$fila['nombre_producto']. ": </br>";
            echo "<ul>"."<li> ID : ".$fila['id_producto']."</li>".
                        "<li> nombre vendedor : ".$nombre_vendedor."</li>".
                        "<li> categoria : ".$fila['etiqueta_categoria']."</li>".
                        "<li> precio : ".$fila['precio']."</li>".
                        "<li> unidades disponibles : ".$fila['unidades_disp']."</li>".
                        "<li> cantidad vendida : ".$fila['unidades_vend']."</li>".
                        "</ul>";
            echo "</ul>";
            echo "<br>Comentarios del producto</br>";
            echo "<ul>";
            $sql2 = "SELECT * FROM comentarios WHERE id_producto = '".$fila['id_producto']."'";
            $c =0;
            $prom = 0;            
            foreach($pdo->query($sql2) as $fila2){
                $c +=1; 
                echo "<li> rol :".$fila2['rol_autor'].", claificó con ".$fila2['calificacion']." estrellas y comentó ".$fila2['comentario']." </li>";
                $prom += $fila2['calificacion'];
            }
            echo "</ul>";
            echo "<br>calificacion promedio: ".$prom/$c."</br>";
            echo "<br>de un total de ".$c." comentarios</br>";
        }
        ?>

        <form action = "busqueda.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
        </form>
    </body>
</html>