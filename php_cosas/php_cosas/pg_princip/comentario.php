//verificar sesion
<?php
session_start();
if(isset($_SESSION['active'])){
    echo "sesion activa: " .$_SESSION['nombre'];
}
else{
    header("location: index.php");
}
if(!empty($_POST)){
    if( empty($_POST['comentario'])){
        $alert = "ingrese su comentario";
    }else{
        $reg_comentario = $_POST['comentario'];
        $reg_evaluacion = $_POST['calificacion'];
        $fecha = new DateTime();
        $idcom =  $fecha->getTimestamp();
        $idprod = urldecode($_GET['id']);
        $uid = $_SESSION['idUser'];
        require_once "conexion.php";
        $sql = "SELECT * FROM comentarios WHERE rol_autor = '$uid' and '$idprod'";
        $flag = true;
        foreach($pdo->query($sql) as $fila){//query llega
            
            $flag = false;
        }
        if($flag){
            $sql = "INSERT INTO comentarios VALUES ('$idcom','$idprod','$uid','$reg_comentario','$reg_evaluacion')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();   
        }
        else{
            $sql = "UPDATE comentarios SET comentario = '$reg_comentario', calificacion = '$reg_evaluacion' where rol_autor = '$uid'";
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
                <h4>barra de busqueda</h4>
                <input type = "text" name ="comentario" placeholder = "comentario">
                <select name="calificacion">
                    <option value="1">1</option>
                    <option value="2">2</option> 
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <div class ="alert" <?php isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "subir comentario">
            </form>
            <form action = "" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "borrar comentario" />
            </form>
        </section>
        <form action = "busqueda.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
        </form>
    </body>
</html>

