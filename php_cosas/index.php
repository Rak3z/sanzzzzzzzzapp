<?php

include_once 'conexion.php';


$gsent = $pdo->prepare("SELECT * FROM usarios");
$gsent->execute();

$result = $gsent->fetchAll();
var_dump(resultado);

?>

//barra de busqueda 

<!DOCTYPE html>
<html lang="es">
<head>
    <script src