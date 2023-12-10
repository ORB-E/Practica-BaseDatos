<?php
    session_start();
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro e Inicio de Sesión</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    
    <div class="container">
        <div class="register-section">
            <h2>CREA UNA CUENTA</h2>
            <form action="registro.php" method="post">
                <input type="text" name="usuario" placeholder="Nombre de usuario" required>
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                <br><br>
                <button type="submit">Registrarse</button>
            </form>
            <p>¿Ya tienes una cuenta? <span class="toggle-btn" onclick="toggleForm('login')">Iniciar sesión</span></p>
        </div>

        <div class="login-section">
            <h2>Iniciar sesión</h2>
            <form action="login.php" method="post">
                <input type="text" name="usuario" placeholder="Nombre de usuario o correo electronico" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                <br><br>
                <button type="submit">Iniciar sesión</button>
            </form>
            <p>¿No tienes una cuenta? <span class="toggle-btn" onclick="toggleForm('registro')">Registrarse</span></p>
        </div>
    </div>

    <script>
        function toggleForm(formType) {
            if (formType === 'registro') {
                document.querySelector('.login-section').style.display = 'none';
                document.querySelector('.register-section').style.display = 'block';
            } else {
                document.querySelector('.register-section').style.display = 'none';
                document.querySelector('.login-section').style.display = 'block';
            }
        }
    </script>
</body>

</html>