<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>Perfil</title>
</head>
<body>
    <header>
        <h1>Perfil<h1>
            <form action = "perfil_editar.php" method= "post"> <!action manda a llamara al otro archivo>
                <input type= "submit" value = "editar" />
            </form>
            <?php
                session_start();
                echo "<h4> Nombre de usuario ".$_SESSION['nombre']."<h4>";
                echo "<h4> correo ".$_SESSION['email']."<h4>";
                echo "<h4> fecha de nacimiento ".$_SESSION['fecha_n']."<h4>";
                echo "<h4> rol ".$_SESSION['idUser']."<h4>";
            ?>
            <form action = "index.php" method= "post"> <!action manda a llamara al otro archivo>
                <input type= "submit" value = "volver" />
            </form>
            <form action = "perfil_historial.php" method= "post"> <!action manda a llamara al otro archivo>
                <input type= "submit" value = "historial" />
            </form>
</body>
</html>

