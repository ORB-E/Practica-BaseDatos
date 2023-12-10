<?php
// Incluir el archivo de conexión a la base de datos
include 'connect.php';

// Verificar si la solicitud HTTP es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST["id"];
    $Titulo = $_POST["Titulo"];
    $Descripcion = $_POST["Descripcion"];
    $Completado = $_POST["Completado"];
    $Fecha_Vencimiento = $_POST["Fecha_Vencimiento"];

    // Crear la consulta SQL para actualizar un registro en la tabla Tareas
    $sql = "UPDATE Tareas SET Titulo = '$Titulo', Descripcion = '$Descripcion', Completado = '$Completado', Fecha_Vencimiento = '$Fecha_Vencimiento' WHERE id = $id;";

    // Ejecutar la consulta
    if (mysqli_query($conn, $sql)) {
        $mensaje = "Registro actualizado con éxito";
    } else {
        $mensaje = "Error al actualizar el registro" . mysqli_error($conn);
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f2f2f2;
        }

        header {
            background-color: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 20px;
        }

        main {
            margin-top: 20px;
        }

        /* Estilos para el mensaje de éxito o error */
        .message {
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #2ecc71;
            color: #fff;
        }

        .error {
            background-color: #e74c3c;
            color: #fff;
        }

        /* Estilos para el botón de regresar */
        button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin: 10px;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <header>
        <?php
        // Mostrar el mensaje de éxito o error
        if (isset($mensaje)) {
            echo $mensaje;
        }
        ?>
    </header>
    <main align="center">
        <!-- Enlace para regresar a la página principal -->
        <a href="../index.php"> <input type="button" value="REGRESAR A LA PÁGINA PRINCIPAL"> </a>
    </main>
</body>

</html>