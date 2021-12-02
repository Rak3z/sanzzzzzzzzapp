<?php
    session_start();
    session_destroy();
    header('location: login.php') //../ para volver un directorio atras
?>
