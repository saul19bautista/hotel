<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se han enviado las credenciales de usuario y contraseña
    if (isset($_POST["usuario"]) && isset($_POST["contraseña"])) {
        // Obtiene las credenciales del formulario
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];

        // Define el usuario y la contraseña permitidos
        $usuarioPermitido = "Luz Arleth";
        $contraseñaPermitida = "micontraseña";

        // Verifica si las credenciales son correctas
        if ($usuario === $usuarioPermitido && $contraseña === $contraseñaPermitida) {
            // Redirecciona al usuario si las credenciales son correctas
            header("Location: pagina_cliente.php");
            exit; // Asegura que el script se detenga después de la redirección
        } else {
            // Si las credenciales son incorrectas, muestra un mensaje de error
            $mensajeError = "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    } else {
        // Si no se proporcionaron las credenciales, muestra un mensaje de error
        $mensajeError = "Por favor, ingresa tanto el usuario como la contraseña.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Formulario Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #001f3f; /* Azul marino */
    margin: 0;
    padding: 0;
}

.form-login {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff; /* Color de fondo */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-login h5 {
    text-align: center;
    margin-bottom: 30px;
}

.controls {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.buttons {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.buttons:hover {
    background-color: #0056b3;
}

.error-message {
    color: #ff0000;
    margin-top: 10px;
}

</style>
<body>
    <section class="form-login">
        <h5>Login</h5>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input class="controls" name="usuario" value="" placeholder="Usuario">
            <input class="controls" name="contraseña" type="password" placeholder="Contraseña">
            <input class="buttons" type="submit" value="Ingresar">
        </form>
        <?php if (isset($mensajeError)) { ?>
            <p class="error-message"><?php echo $mensajeError; ?></p>
        <?php } ?>
        <p><a href="#">¿Olvidaste tu contraseña?</a></p>
    </section>

    <section class="form-login">
        <h5>Registrarse</h5>
        <form method="post" action="registro_Usuarios.php">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="email_registro">Correo Electrónico:</label>
                <input type="email" id="email_registro" name="email_registro" required>
            </div>
            <div class="form-group">
                <label for="password_registro">Contraseña:</label>
                <input type="password" id="password_registro" name="password_registro" required>
            </div>
            <button type="submit" name="register">Registrarse</button>
            <?php if (isset($error_registro)) { echo "<p>$error_registro</p>"; } ?>
            <?php if (isset($registro_exitoso)) { echo "<p>$registro_exitoso</p>"; } ?>
        </form>
    </section>
</body>
</html>

