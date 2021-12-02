<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['active'])){
    echo "sesion activa: " .$_SESSION['nombre'];
    echo "  <form action = 'deslog.php' method= 'post'> <!action manda a llamara al otro archivo>
                <input type= 'submit' value = 'desloguear' />
            </form>";
    echo "  <form action = 'perfil.php' method= 'post'> <!action manda a llamara al otro archivo>
                <input type= 'submit' value = 'perfil' />
            </form>";  
    echo "  <form action = 'mis_ventas.php' method= 'post'> <!action manda a llamara al otro archivo>
                <input type= 'submit' value = 'ir a mis productos' />
            </form>";             

}else{
    echo "no estas logeado";
    echo "  <form action = 'login.php' method= 'post'> <!action manda a llamara al otro archivo>
                <input type= 'submit' value = 'login' />
            </form>
            <form action = 'registro.php' method= 'post'> <!action manda a llamara al otro archivo>
                <input type= 'submit' value = 'registrate' />
            </form>";
}
?>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>Pagina Principal</title>
</head>
<body>
    <header>
        <div class = "header">
            <h1>Sansapp<h1>
            <div class = "optionsBar">
                <span>|</span>
                <form action = "busqueda.php" method= "post"> <!action manda a llamara al otro archivo>
                        <input type= "submit" value = "busqueda" />
                </form>
            </div>
        </div>
        <?php
            require_once "conexion.php";
            echo "<br>TOP BEBIDAS<br>";
            $sql = "SELECT nombre_producto, calificacion FROM Top_5_productos";
            foreach($pdo->query($sql) as $fila){//query llega
                echo "<br>".$fila['nombre_producto']. " : ". $fila['calificacion']."<br>";
            }
            echo "<br>TOP USUARIOS CON MAS VENTAS<br>";
            $sql = "SELECT rol, value_occurrence FROM top_5_usuarios";
            foreach($pdo->query($sql) as $fila){//query llega
                echo "<br>".$fila['rol']. " : ". $fila['value_occurrence']."<br>";
            }
            echo "<br>TOP PRODUCTOS MAS VENDIDOS<br>";
            $sql = "SELECT id_producto, value_occurrence FROM top_5_vendidos";
            foreach($pdo->query($sql) as $fila){//query llega
                echo "<br>".$fila['id_producto']. " : ". $fila['value_occurrence']."<br>";
            }
        ?>

</body>
</html>

