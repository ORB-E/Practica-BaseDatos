<?php
include "connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $password = $_POST["contraseña"];

    if (filter_var($usuario, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("SELECT id, Username, Password FROM Usuarios WHERE Email = ?");
    } else {
        $stmt = $conn->prepare("SELECT id, Username, Password FROM Usuarios WHERE Username = ?");
    }

    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($user_id, $username, $hashedPassword);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
        // Limpiar las variables de sesión antes de iniciar una nueva sesión
        session_unset();
        session_destroy();
        session_start();
    
        // Creamos una nueva sesión para el usuario
        $_SESSION['logueado'] = true;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
    
        // Redirigir al usuario a la página principal
        header("Location: ../index.php");
        exit();
    }else {
        header("Location: login.php?error=Usuario o contraseña incorrectos");
        exit();
    }

    // No es necesario cerrar las declaraciones preparadas y la conexión aquí
}
?>