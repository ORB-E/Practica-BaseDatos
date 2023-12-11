<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Configuración del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1> APP PARA LISTA DE TAREAS </h1>
        <?php
        if ($_SESSION['logueado'] === true) {
            echo "<p>¡Bienvenido, " . $_SESSION['username'];
            ?>
            <form action="./PHP/handler_salir.php">
                <input type="submit" value="CERRAR SESIÓN" class="btn">
            </form>
            <?php
        } else {
            ?>
            <a href="./PHP/index.php" class="btn"> ¿TIENES CUENTA? </a>
            <?php
        }
        ?>
    </header>
    <!-- Formulario para realizar una consulta -->
    <a href="./PHP/consulta.php" class="btn"> Consulta </a>

    <!-- Enlace para insertar nuevos datos -->
    <a href="./PHP/insertar.php" class="btn">Insertar</a> <br>
</body>
</html>