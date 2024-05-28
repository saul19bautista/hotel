<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Habitación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaffdb; /* Fondo verde limón */
            color: #333; /* Color de texto oscuro */
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff; /* Fondo blanco para contrastar */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        h2 {
            text-align: center;
            color: #333; /* Color de texto oscuro */
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333; /* Color de texto oscuro */
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #6eff8b; /* Verde limón */
            color: #fff; /* Color de texto blanco */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4cd966; /* Cambio de color al pasar el ratón */
        }
    </style>
</head>

<body>
    <h2>Modificar Habitación</h2>
    <form method="post" action="actualizar_habitacion.php">
        <?php
        // Verificar si se ha enviado un ID válido por la URL
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "ID de habitación no válido";
            exit;
        }

        $id = $_GET['id'];

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

        // Consultar la habitación a modificar
        $sql = "SELECT * FROM Habitaciones WHERE id = $id";
        $result = $conn->query($sql);

        // Verificar si se encontró la habitación
        if ($result->num_rows == 0) {
            echo "No se encontró la habitación con el ID proporcionado";
            exit;
        }

        $row = $result->fetch_assoc();

        // Cerrar conexión
        $conn->close();
        ?>

        <!-- Campo oculto para el ID de la habitación -->
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <!-- Campo para el número de habitación con validación -->
        <label for="numerohabitacion">Número de Habitación:</label>
        <input type="text" id="numerohabitacion" name="numerohabitacion" value="<?php echo $row['numero_habitacion']; ?>" required pattern="[0-9]{1,3}" title="Ingrese un número de habitación válido (hasta 3 dígitos)">

        <!-- Campo para el tipo de habitación -->
        <label for="tipohabitacion">Tipo de Habitación:</label>
        <select id="tipohabitacion" name="tipohabitacion" required>
            <option value="suit" <?php if ($row['tipo_habitacion'] == "suit") echo "selected"; ?>>Suit</option>
            <option value="doble" <?php if ($row['tipo_habitacion'] == "doble") echo "selected"; ?>>Doble</option>
            <option value="individual" <?php if ($row['tipo_habitacion'] == "individual") echo "selected"; ?>>Individual</option>
            <!-- Agrega más opciones según los tipos de habitación disponibles -->
        </select>

        <!-- Campo para el precio con validación -->
        <label for="precio">Precio por Noche:</label>
        <select id="precio" name="precio" required>
            <option value="150" <?php if ($row['precio'] == "150") echo "selected"; ?>>150.00</option>
            <option value="100" <?php if ($row['precio'] == "100") echo "selected"; ?>>100.00</option>
            <option value="75" <?php if ($row['precio'] == "75") echo "selected"; ?>>75.00</option>
            <!-- Agrega más opciones según los precios disponibles -->
        </select>

        <!-- Botón para enviar el formulario -->
        <button type="submit">Guardar Cambios</button>
    </form>
</body>

</html>



