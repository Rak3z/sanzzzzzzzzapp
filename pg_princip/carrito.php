<?php
session_start();
if(isset($_SESSION['active'])){
    echo "sesion activa: " .$_SESSION['nombre']. " carrito nro : ". $_SESSION['carrito']; 
    require_once "conexion.php";
    if(!isset($_SESSION['carrito'])){
        $fecha = new DateTime();
        $_SESSION['carrito'] = $fecha->getTimestamp();
        $sql = "INSERT INTO carrito_de_compra values ('".$_SESSION['idUser']."', '".$_SESSION['carrito']."')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();   
    }
    if(isset($_GET['id'])){
        $idprod = urldecode($_GET['id']);
        $sql = "SELECT * FROM productos_carrito WHERE id_producto = '".$idprod."' and '".$_SESSION['carrito']."'";
        $flag = true;
        foreach($pdo->query($sql) as $fila){//query llega
            $cantidad_pro = $fila['cantidad'];
            $flag = false;
        }
        if($flag){
            $sql = "INSERT INTO productos_carrito values ('".$idprod."', '".$_SESSION['carrito']."', '1' )";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();   
        }
        else{
            $cantidad_pro+=1;
            $sql = "UPDATE productos_carrito SET id_producto = '".$idprod."', id_boleta = '".$_SESSION['carrito']."', cantidad = '$cantidad_pro' WHERE id_producto = '".$idprod."' and '".$_SESSION['carrito']."'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();   
            header("location: carrito.php");        
        }
    }
    if(empty($_POST["comprar"])){
        foreach ($_POST as $param_name => $param_val) {
            $idprod =$param_name;
            echo $param_name."".$_SESSION['carrito'];
            $sql = "DELETE FROM productos_carrito WHERE id_producto = ".$idprod." AND id_boleta = ".$_SESSION['carrito'];
            $stmt = $pdo->prepare($sql);
            $stmt->execute();   
            header("location: carrito.php");   
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
            <?php
                require_once "conexion.php";
                $sql = "SELECT id_producto,cantidad FROM productos_carrito WHERE id_boleta = '".$_SESSION['carrito']."'";
                foreach($pdo->query($sql) as $fila){//query llega
                    $sql2 = "SELECT nombre_producto, precio FROM productos WHERE id_producto = '".$fila['id_producto']."'";
                    foreach($pdo->query($sql2) as $fila2){//query llega
                        echo "<br> nombre : ".$fila2['nombre_producto'].";  precio: ".$fila2['precio'].";  cantidad a comprar ".$fila['cantidad']."</br>";
                        echo "<form action = '' method= 'post'> <!action manda a llamara al otro archivo>
                                   <input type= 'submit' name = '".$fila['id_producto']."' value = 'borrar' />
                              </form>";
                    }
                }
            ?>
        </section>
        <form action = "compra.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" name = "comprar" value = "comprar" />
        </form>
        <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
        </form>
    </body>
</html>

