<?php
session_start();
if(isset($_SESSION['active'])){
    echo "sesion activa: " .$_SESSION['nombre'];
}
if(empty($_POST["busqueda"])){
    foreach ($_POST as $param_name => $param_val) {
        if($param_val == "ir a pagina del producto"){
            header("location: perfil_producto.php?id=$param_name");
        }elseif($param_val == "ir a pagina del usuario"){
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
                <h4>barra de busqueda</h4>
                <input type = "text" name ="busqueda" placeholder = "busqueda">
                <select name="cat_busqueda">
                    <option value="1">productos</option>
                    <option value="2">usuarios</option> 
                    <option value="3">categorias</option>
                </select>
                <div class ="alert" <?php isset($alert)? $alert : ""; ?>></div>
                <input type= "submit" value = "buscar">
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
                            $flag = true;
                            foreach($pdo->query($sql) as $fila){//query llega
                                echo "<br> nombre : ".$fila['nombre_producto'].";  precio: ".$fila['precio']."</br>";
                                echo "<form action = '' method= 'post'> <!action manda a llamara al otro archivo>
                                           <input type= 'submit' name = '".$fila['id_producto']."' value = 'ir a pagina del producto' />
                                      </form>";
                                $flag = false;
                            }
                        }elseif($catego ==2){
                            $sql = "SELECT * FROM usuario WHERE nombre like '%$search%'";
                            $flag = true;
                            foreach($pdo->query($sql) as $fila){//query llega
                                echo "<br> nombre : ".$fila['nombre'].";  precio: ".$fila['rol']."</br>";
                                echo "<form action = '' method= 'post'> <!action manda a llamara al otro archivo>
                                           <input type= 'submit' name = '".$fila['rol']."' value = 'ir a pagina del usuario' />
                                      </form>";
                                $flag = false;
                            }
                        }elseif($catego ==3){
                            $sql = "SELECT * FROM productos WHERE etiqueta_categoria like '%$search%'";
                            $flag = true;
                            foreach($pdo->query($sql) as $fila){//query llega
                                echo "<br>".$fila['nombre_producto']."  ".$fila['etiqueta_categoria']."<br>";
                                $flag = false;
                            }
                        }//query no llega
                        if ($flag){
                            echo "no hubo resultados a la busqueda";
                        }
                    }
                }
                ?>
            </form>
        </section>
        <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
            <input type= "submit" value = "volver" />
        </form>
    </body>
</html>