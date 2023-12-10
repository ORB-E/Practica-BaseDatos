<?php
    include 'connect.php';
    
    session_start();

    $_SESSION['logueado'] = false;

    header("Location: ../index.php");
?>