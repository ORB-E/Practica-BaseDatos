<?php
include "connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $password = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

    // Verificar si el nombre de usuario ya existe
    $stmt_check_user = $conn->prepare("SELECT id FROM Usuarios WHERE Username = ?");
    $stmt_check_user->bind_param("s", $usuario);
    $stmt_check_user->execute();
    $stmt_check_user->store_result();

    if ($stmt_check_user->num_rows > 0) {
        echo "Error al registrar: El nombre de usuario ya está en uso.";
    } else {
        // Insertar el nuevo usuario
        $stmt_insert_user = $conn->prepare("INSERT INTO Usuarios (Username, Password, Email) VALUES (?, ?, ?)");
        $stmt_insert_user->bind_param("sss", $usuario, $password, $correo);

        if ($stmt_insert_user->execute()) {
            echo "Registro exitoso";
            $_SESSION['logueado'] = true;
            $_SESSION['username'] = $usuario;
            header("Location: ../index.php");
        } else {
            echo "Error al registrar: " . $stmt_insert_user->error;
        }

        $stmt_insert_user->close();
    }

    $stmt_check_user->close();
    $conn->close();
}
?>