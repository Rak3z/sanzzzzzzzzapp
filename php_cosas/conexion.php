<?php

$enlace = 'mysql:host=localhost;dbname=sansapp';
$usuario = 'root';
$pass = '';

try {
    $pdo = new PDO($enlace, $usuario, $pass);
    //echo 'Hola estoy funcionando';
    foreach($pdo->query('SELECT * from usuario') as $fila){
        print_r($fila);
    } 
}catch (PDOException $e){
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>