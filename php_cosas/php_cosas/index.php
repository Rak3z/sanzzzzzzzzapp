<?php

include_once 'conexion.php';


$gsent = $pdo->prepare("SELECT * FROM usarios");
$gsent->execute();

$result = $gsent->fetchAll();
var_dump(resultado);

?>

//barra de busqueda ufa tengo que hacer esto

<!DOCTYPE html>
<html lang="es">
<head>
    <script src