<?php
    $alert = "";
    if(!empty($_POST)){
        if( empty($_POST['busqueda'])){
            $alert = "busca algo";
        }else{
            require_once "conexion.php";
            $search = $_POST['busqueda'];
            $catego = $_POST['cat_busqueda'];
            if ($catego == 1){
                $sql = "SELECT * FROM productos WHERE nombre_producto like '%$search%' or descripcion like '%$search%'";
            }elseif($catego ==2){
                $sql = "SELECT * FROM usuario WHERE nombre like '%$search%'";
            }elseif($catego ==3){
                $sql = "SELECT * FROM productos WHERE etiqueta_categoria like '%$search%'";
            }
            $flag = true;
            foreach($pdo->query($sql) as $fila){//query llega
                print_r("AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAY uno");
                print_r($fila);
                $flag = false;
            }//query no llega
            if ($flag){
                $alert = "Usuario o clave incorrecto";
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
                <input type = "text" name ="busqueda" placeholder = "busqueda">
                <select name="cat_busqueda">
                    <option value="1">productos</option>
                    <option value="2">usuarios</option> 
                    <option value="3">categorias</option>
                </select>
                <div class ="alert" <?php isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "Ingresar">
            </form>
        </section>
        <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
        </form>
    </body>
</html>