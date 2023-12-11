<?php
include 'connect.php';
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['logueado'])) {
    // Manejar el caso en el que el usuario no está autenticado
    echo "Error: Usuario no autenticado.";
    exit();
}

// Verificar si el usuario está autenticado
if ($_SESSION['logueado'] === false) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header("Location: index.php");
    exit();
}

// Obtener el ID del usuario autenticado
$usuario = $_SESSION['username'];
$stmt_get_user_id = $conn->prepare("SELECT id FROM Usuarios WHERE Username = ?");
$stmt_get_user_id->bind_param("s", $usuario);
$stmt_get_user_id->execute();
$stmt_get_user_id->bind_result($user_id);
$stmt_get_user_id->fetch();
$stmt_get_user_id->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $Titulo = $_POST["Titulo"];
    $Descripcion = $_POST["Descripcion"];
    $Completado = "NO";
    $Fecha_Vencimiento = $_POST["Fecha_Vencimiento"];

    // Insertar la nueva tarea asociada al usuario autenticado
    $stmt_insert_task = $conn->prepare("INSERT INTO Tareas (Titulo, Descripcion, Completado, Fecha_Vencimiento, Usuario_ID) VALUES (?, ?, ?, ?, ?)");
    $stmt_insert_task->bind_param("ssssi", $Titulo, $Descripcion, $Completado, $Fecha_Vencimiento, $user_id);

    if ($stmt_insert_task->execute()) {
        echo "REGISTRO INSERTADO CON ÉXITO";
    } else {
        echo "ERROR AL INSERTAR EL REGISTRO: " . $stmt_insert_task->error;
    }

    $stmt_insert_task->close();
    $conn->close();
}
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
}

header {
    background-color: #2c3e50;
    color: #ecf0f1;
    text-align: center;
    padding: 20px;
}

main {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

form {
    width: 80%;
    max-width: 600px;
}

table {
    margin: 20px auto;
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 12px;
    border: 1px solid #3498db;
}

th {
    background-color: #3498db;
    color: #fff;
}

input[type="text"],
input[type="date"],
input[type="submit"],
input[type="button"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    box-sizing: border-box;
}

input[type="submit"],
input[type="button"] {
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover,
input[type="button"]:hover {
    background-color: #2980b9;
}

p {
    text-align: center;
    margin-top: 20px;
}

footer {
    margin-top: 20px;
    text-align: center;
}

input[type="button"][value="REGRESAR A LA PAGINA PRINCIPAL"] {
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    padding: 10px 20px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

input[type="button"][value="REGRESAR A LA PAGINA PRINCIPAL"]:hover {
    background-color: #2980b9;
}

    </style>
</head>
<body>
    <header>
        <h1>
            INSERTAR MASCOTAS
        </h1>
    </header>
    <main align="center">
        <!-- Formulario para ingresar nuevos datos de tareas -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
                <tr>
                    <th> Titulo: </th>
                    <td> <input type="text" name="Titulo"> </td>
                </tr>    
                <tr>
                    <th> Descripcion: </th>
                    <td> <input type="text" name="Descripcion" id=""> </td>
                </tr>
                <tr>
                    <th> Fecha de vencimiento: </th> 
                    <td> <input type="date" name="Fecha_Vencimiento"> </td>
                </tr>
                <tr>
                    <th> <input type="submit" value="Guardar"> </th>
                </tr>
            </table>
        </form>
        <!-- Mostrar mensaje de éxito o error después de la inserción -->
        <p> <?php echo $mensaje; ?> </p>

        <!-- Pie de página con un enlace para regresar a la página principal -->
        <footer>
            <a href="../index.php"> <input type="button" value="REGRESAR A LA PAGINA PRINCIPAL"> </a>
        </footer>
    </main>
</body>
</html>