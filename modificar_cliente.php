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

// Obtener el primer cliente de la base de datos
$sql = "SELECT id, nombre, apellidoPaterno, apellidoMaterno, telefono, correoElectronico FROM Clientes LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $nombre = isset($row['nombre']) ? htmlspecialchars($row['nombre']) : '';
    $apellidoPaterno = isset($row['apellidoPaterno']) ? htmlspecialchars($row['apellidoPaterno']) : '';
    $apellidoMaterno = isset($row['apellidoMaterno']) ? htmlspecialchars($row['apellidoMaterno']) : '';
    $telefono = isset($row['telefono']) ? htmlspecialchars($row['telefono']) : '';
    $correoElectronico = isset($row['correoElectronico']) ? htmlspecialchars($row['correoElectronico']) : '';
} else {
    echo "No se encontró ningún cliente en la base de datos.";
    exit();
}

// Si se envió el formulario de modificación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar'])) {
    // Validar y limpiar los datos del formulario
    $nombreNuevo = htmlspecialchars(trim($_POST["nombre"]));
    $apellidoPaternoNuevo = htmlspecialchars(trim($_POST["apellidoPaterno"]));
    $apellidoMaternoNuevo = htmlspecialchars(trim($_POST["apellidoMaterno"]));
    $telefonoNuevo = htmlspecialchars(trim($_POST["telefono"]));
    $correoElectronicoNuevo = htmlspecialchars(trim($_POST["correoElectronico"]));

    // Expresiones regulares para validar los campos
    $nombre_regex = "/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/";
    $telefono_regex = "/^\d{10}$/";
    $correoElectronico_regex = "/^\S+@\S+\.\S+$/";

    // Validar nombre
    if (!preg_match($nombre_regex, $nombreNuevo)) {
        echo "El nombre debe contener solo letras y espacios.";
        exit();
    }

    // Validar apellido paterno
    if (!preg_match($nombre_regex, $apellidoPaternoNuevo)) {
        echo "El apellido paterno debe contener solo letras y espacios.";
        exit();
    }

    // Validar apellido materno
    if (!preg_match($nombre_regex, $apellidoMaternoNuevo)) {
        echo "El apellido materno debe contener solo letras y espacios.";
        exit();
    }

    // Validar teléfono
    if (!preg_match($telefono_regex, $telefonoNuevo)) {
        echo "El teléfono debe contener 10 dígitos numéricos.";
        exit();
    }

    // Validar correo electrónico
    if (!preg_match($correoElectronico_regex, $correoElectronicoNuevo)) {
        echo "El correo electrónico no es válido.";
        exit();
    }

    // Actualizar los datos del cliente en la base de datos solo si hay cambios
    if ($nombreNuevo !== $nombre || $apellidoPaternoNuevo !== $apellidoPaterno || $apellidoMaternoNuevo !== $apellidoMaterno || $telefonoNuevo !== $telefono || $correoElectronicoNuevo !== $correoElectronico) {
        $sql = "UPDATE Clientes SET nombre = ?, apellidoPaterno = ?, apellidoMaterno = ?, telefono = ?, correoElectronico = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nombreNuevo, $apellidoPaternoNuevo, $apellidoMaternoNuevo, $telefonoNuevo, $correoElectronicoNuevo, $id);

        if ($stmt->execute()) {
            echo "Cliente modificado correctamente";
        } else {
            echo "Error al modificar el cliente: " . $conn->error;
        }
    } else {
        echo "No se realizaron cambios en los datos del cliente.";
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Modificar Cliente</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>

            <label for="apellidoPaterno">Apellido Paterno:</label>
            <input type="text" id="apellidoPaterno" name="apellidoPaterno" value="<?php echo $apellidoPaterno; ?>" required>

            <label for="apellidoMaterno">Apellido Materno:</label>
            <input type="text" id="apellidoMaterno" name="apellidoMaterno" value="<?php echo $apellidoMaterno; ?>" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>

            <label for="correoElectronico">Correo Electrónico:</label>
            <input type="email" id="correoElectronico" name="correoElectronico" value="<?php echo $correoElectronico; ?>" required>

            <button type="submit" name="modificar">Modificar</button>
        </form>
    </div>
</body>

</html>





