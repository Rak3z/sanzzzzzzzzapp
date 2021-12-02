<?php

$enlace = 'mysql:host=localhost;dbname=sansapp';
$usuario = 'root';
$pass = '';

try {
    $pdo = new PDO($enlace, $usuario, $pass);
}catch (PDOException $e){
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>