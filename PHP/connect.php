<?php
    $servername = "localhost";
    $username = "root";
    $password = "Pa$$w0rd";
    $dbname = "TodoList";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Conexión fallida: " . $conn->connect_error);
    }
?>