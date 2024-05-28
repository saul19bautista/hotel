<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Cambia localhost por el nombre del servidor si es necesario
$username = "root"; // Cambia tu_usuario por el nombre de usuario de la base de datos
$password = ""; // Cambia tu_contraseña por la contraseña de la base de datos
$database = "paraiso"; // Cambia tu_base_de_datos por el nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del check-out a modificar
$id = $_GET['id'];

// Consultar el registro de check-out a modificar
$sql = "SELECT * FROM Checkout WHERE id = $id";
$result = $conn->query($sql);

// Verificar si se encontró el registro
if ($result->num_rows > 0) {
    // Obtener los datos del registro
    $row = $result->fetch_assoc();
    $nombre = $row["nombre"];
    $apellidoPaterno = $row["apellido_paterno"];
    $apellidoMaterno = $row["apellido_materno"];
    $fechaCheckout = $row["fecha_checkout"];
    $horaCheckout = $row["hora_checkout"];
} else {
    echo "No se encontró el registro de check-out a modificar";
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Check-out</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="date"],
        input[type="time"],
        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
        </style>
</head>

<body>
    <div class="container">
        <h1>Modificar Check-out</h1>
        <form method="post" action="actualizar_checkout.php" onsubmit="return validarFormulario()">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required maxlength="10">
                <span class="error" id="errorNombre"></span>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?php echo $apellidoPaterno; ?>" required maxlength="10">
                <span class="error" id="errorApellidoPaterno"></span>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" value="<?php echo $apellidoMaterno; ?>" required maxlength="10">
                <span class="error" id="errorApellidoMaterno"></span>
            </div>
            <div class="form-group">
                <label for="fecha_checkout">Fecha check-out:</label>
                <input type="date" id="fecha_checkout" name="fecha_checkout" value="<?php echo $fechaCheckout; ?>" required>
            </div>
            <div class="form-group">
                <label for="hora_checkout">Hora check-out:</label>
                <input type="time" id="hora_checkout" name="hora_checkout" value="<?php echo $horaCheckout; ?>" required>
            </div>
            <button type="submit" name="modificar">Modificar Check-out</button>
        </form>
    </div>

    <script>
        function validarFormulario() {
            var nombre = document.getElementById('nombre').value;
            var apellidoPaterno = document.getElementById('apellido_paterno').value;
            var apellidoMaterno = document.getElementById('apellido_materno').value;
            var regex = /^[a-zA-Z\s]*$/; // Expresión regular que permite solo letras y espacios
            var errorNombre = document.getElementById('errorNombre');
            var errorApellidoPaterno = document.getElementById('errorApellidoPaterno');
            var errorApellidoMaterno = document.getElementById('errorApellidoMaterno');
            var valid = true;

            if (!regex.test(nombre)) {
                errorNombre.innerText = 'Por favor, ingresa solo letras y espacios.';
                valid = false;
            } else if (nombre.length > 10) {
                errorNombre.innerText = 'El nombre debe tener máximo 10 caracteres.';
                valid = false;
            } else if (!(/^([A-ZÁÉÍÓÚÑ][a-zñáéíóú]+[\s]*)+$/.test(nombre))) {
                errorNombre.innerText = 'La primera letra debe ser mayúscula.';
                valid = false;
            } else {
                errorNombre.innerText = '';
            }

            if (!regex.test(apellidoPaterno)) {
                errorApellidoPaterno.innerText = 'Por favor, ingresa solo letras y espacios.';
                valid = false;
            } else if (apellidoPaterno.length > 10) {
                errorApellidoPaterno.innerText = 'El apellido paterno debe tener máximo 10 caracteres.';
                valid = false;
            } else if (!(/^([A-ZÁÉÍÓÚÑ][a-zñáéíóú]+[\s]*)+$/.test(apellidoPaterno))) {
                errorApellidoPaterno.innerText = 'La primera letra debe ser mayúscula.';
                valid = false;
            } else {
                errorApellidoPaterno.innerText = '';
            }

            if (!regex.test(apellidoMaterno)) {
                errorApellidoMaterno.innerText = 'Por favor, ingresa solo letras y espacios.';
                valid = false;
            } else if (apellidoMaterno.length > 10) {
                errorApellidoMaterno.innerText = 'El apellido materno debe tener máximo 10 caracteres.';
                valid = false;
            } else if (!(/^([A-ZÁÉÍÓÚÑ][a-zñáéíóú]+[\s]*)+$/.test(apellidoMaterno))) {
                errorApellidoMaterno.innerText = 'La primera letra debe ser mayúscula.';
                valid = false;
            } else {
                errorApellidoMaterno.innerText = '';
            }

            if (/[\d]/.test(nombre) || /[\d]/.test(apellidoPaterno) || /[\d]/.test(apellidoMaterno)) {
                alert('Por favor, no ingrese números en los campos de nombre y apellidos.');
                valid = false;
            }

            return valid;
        }
    </script>
</body>

</html>