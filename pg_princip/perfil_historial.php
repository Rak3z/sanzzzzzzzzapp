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
        <h4>Historial de ventas</h4>
        <?php
        require_once "conexion.php";
        $uid = $_SESSION['idUser'];
        $sql = "SELECT  id_transaccion FROM venta WHERE rol_vendedor = '$uid'";
        $c=0;
        foreach($pdo->query($sql) as $fila){//query llega
            $c+=1;
            echo "<br>venta numero : ".$fila['id_transaccion']."</br>";
            echo "<ul>";
            $sql2 = "SELECT  * FROM historial_producto WHERE id_transaccion = '".$fila['id_transaccion']."'";
            foreach($pdo->query($sql2) as $fila2){//query lleg
                echo "<li>".$fila2['id_producto']." : ".$fila2['cant_comprada']." </li>";
            }
            $sql2 = "SELECT  * FROM historial WHERE id_transaccion = '".$fila['id_transaccion']."'";
            foreach($pdo->query($sql2) as $fila2){//query lleg
                echo "<li>fecha venta:".$fila2['fecha']." </li>";
                echo "<li>costo total:".$fila2['costo_total']." </li>";
            }
            echo "</ul>";
        }
        echo "<br> Total de ventas : ".$c."</br>";

        echo "<h4>Historial de compras</h4>";

        $sql = "SELECT  id_transaccion FROM compra WHERE rol_comprador = '$uid'";
        $c=0;
        foreach($pdo->query($sql) as $fila){//query llega
            $c+=1;
            echo "<br>compra numero : ".$fila['id_transaccion']."</br>";
            echo "<ul>";
            $sql2 = "SELECT  * FROM historial_producto WHERE id_transaccion = '".$fila['id_transaccion']."'";
            foreach($pdo->query($sql2) as $fila2){//query lleg
                echo "<li>".$fila2['id_producto']." : ".$fila2['cant_comprada']." </li>";
            }
            $sql2 = "SELECT  * FROM historial WHERE id_transaccion = '".$fila['id_transaccion']."'";
            foreach($pdo->query($sql2) as $fila2){//query lleg
                echo "<li>fecha compra:".$fila2['fecha']." </li>";
                echo "<li>costo total:".$fila2['costo_total']." </li>";
            }
            echo "</ul>";
        }
        echo "<br> Total de compras : ".$c."</br>";
        ?>

        <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
        </form>
    </body>
</html>