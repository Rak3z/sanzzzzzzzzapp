<?php
require_once "conexion.php";
session_start();
$fecha = date ('Y-m-d H:i:s');
$sql = "SELECT * FROM productos_carrito WHERE id_boleta = '".$_SESSION['carrito']."'";
$total = 0;
foreach($pdo->query($sql) as $fila){//ingresando en producto_historial
    $sql2 = "INSERT INTO historial values ('".$fila['id_boleta']."', '".$fecha."', '0')";//ingreso solbre la tabla historial previo = null
    $stmt = $pdo->prepare($sql2);
    $stmt->execute();
    $sql2 = "INSERT INTO historial_producto values ('".$fila['id_producto']."', '".$fila['id_boleta']."', '".$fila['cantidad']."')";
    $stmt = $pdo->prepare($sql2);
    $stmt->execute();   
    $sql2 = "SELECT precio FROM productos WHERE id_producto = '".$fila['id_producto']."'";
    foreach($pdo->query($sql2) as $fila2){//query llega
        $total += $fila2['precio'] * $fila['cantidad'];
    }
    $sql2 = "UPDATE historial SET fecha = '".$fecha."', costo_total = '".$total."' WHERE id_transaccion = ".$fila['id_producto'];
    $stmt = $pdo->prepare($sql2);
    $stmt->execute(); 
    $sql2 = "INSERT INTO compra values ('".$fila['id_boleta']."', '".$_SESSION['idUser']."')";
    $stmt = $pdo->prepare($sql2);
    $stmt->execute();

    $sql2 = "SELECT rol FROM productos WHERE id_producto = '".$fila['id_producto']."'";
    foreach($pdo->query($sql2) as $fila2){//query llega
        $sql3 = "INSERT INTO venta values ('".$fila['id_boleta']."' , '".$fila2['rol']."')";
        $stmt = $pdo->prepare($sql3);
        $stmt->execute(); 
    }
}
$sql = "SELECT * FROM productos_carrito WHERE id_boleta = '".$_SESSION['carrito']."'";
foreach($pdo->query($sql) as $fila){//ingresando en producto_historial
    $sql2 = "UPDATE productos SET unidades_vend = unidades_vend + '".$fila['cantidad']."' WHERE id_producto = '".$fila['id_producto']."'";
    $stmt = $pdo->prepare($sql2);
    $stmt->execute(); 
    $sql2 = "DELETE FROM productos_carrito WHERE id_producto = ".$fila['id_producto']." AND id_boleta = ".$_SESSION['carrito'];
    $stmt = $pdo->prepare($sql2);
    $stmt->execute(); 
    }
unset($_SESSION['carrito']);

?>