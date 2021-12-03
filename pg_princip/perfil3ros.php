<?php
session_start();
$id= urldecode($_GET['id']);

if(isset($_SESSION['active'])){
    echo "sesion activa: " .$_SESSION['nombre'];
}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>Perfil</title>
</head>
<body>
    <header>
        <h1>Perfil<h1>
            <?php
                require_once "conexion.php";
                $id= urldecode($_GET['id']);
                
                $sql = "SELECT * FROM usuario WHERE rol = '".$id."'";
                foreach($pdo->query($sql) as $fila){//ingresando en producto_historial
                    echo "<h4> Nombre de usuario ".$fila['nombre']."<h4>";
                    echo "<h4> correo ".$fila['correo']."<h4>";
                    echo "<h4> fecha de nacimiento ".$fila['fecha_nacimiento']."<h4>";
                    echo "<h4> rol ".$fila['rol']."<h4>";
                }
            ?>
            <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
                <input type= "submit" value = "volver" />
            </form>
</body>
</html>

