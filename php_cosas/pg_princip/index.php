<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['active'])){
    echo "hola, " .$_SESSION['nombre'];
    echo "  <form action = 'deslog.php' method= 'post'> <!action manda a llamara al otro archivo>
                <input type= 'submit' value = 'desloguear' />
            </form>";
    echo "  <form action = 'perfil.php' method= 'post'> <!action manda a llamara al otro archivo>
                <input type= 'submit' value = 'perfil' />
            </form>";        

}else{
    echo "no estas logeado";
    echo "  <form action = 'login.php' method= 'post'> <!action manda a llamara al otro archivo>
                <input type= 'submit' value = 'login' />
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
</body>
</html>

