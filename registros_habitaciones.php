<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Habitaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaffdb; /* Fondo verde limón */
            color: #333; /* Color de texto oscuro */
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            max-width: 1000px;
            margin: 50px auto;
        }

        .formulario, .tabla {
            flex-basis: 48%;
            background-color: #fff; /* Fondo blanco para contrastar */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        h1, h2 {
            text-align: center;
            color: #333; /* Color de texto oscuro */
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333; /* Color de texto oscuro */
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: calc(33.33% - 5px);
            padding: 10px;
            margin-top: 10px;
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

        .tabla-registros {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabla-registros th,
        .tabla-registros td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .tabla-registros th {
            background-color: #f2f2f2; /* Fondo gris claro */
        }

        .btn-modificar {
            margin-right: 5px;
        }

        .btn-eliminar {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="formulario">
            <h1>Registro de Habitaciones</h1>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="form-group">
                    <label for="numerohabitacion">Numero de Habitacion:</label>
                    <input type="number" id="numerohabitacion" name="numerohabitacion" required pattern="\d+">
                </div>

                <div class="form-group">
                    <label for="tipo_habitacion">Tipo de Habitación:</label>
                    <select id="tipo_habitacion" name="tipo_habitacion" required>
                        <option value="suit">Suit</option>
                        <option value="doble">Doble</option>
                        <option value="individual">Individual</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="precio">Precio por Noche:</label>
                    <select id="precio" name="precio" required>
                        <option value="150">150.00</option>
                        <option value="100">100.00</option>
                        <option value="75">75.00</option>
                    </select>
                </div>

                <button type="submit" name="registrar">Registrar Habitación</button>
            </form>
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

            // Verificar si se ha enviado el formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verificar si se ha enviado el formulario de registro de habitación
                if (isset($_POST["registrar"])) {
                    // Recibir datos del formulario
                    $numero_habitacion = $_POST["numerohabitacion"];
                    $tipo_habitacion = $_POST["tipo_habitacion"];
                    $precio = $_POST["precio"];

                    // Inserción de datos en la base de datos
                    $sql_insert = "INSERT INTO Habitaciones (numero_habitacion, tipo_habitacion, precio) VALUES ('$numero_habitacion', '$tipo_habitacion', '$precio')";

                    // Verificar si el número de habitación es válido (solo números)
                    if (!is_numeric($numero_habitacion)) {
                        echo "<p style='color: red;'>El número de habitación debe ser un valor numérico.</p>";
                    } else {
                        // Verificar si la inserción se realizó correctamente
                        if ($conn->query($sql_insert) === TRUE) {
                            echo "<p style='color: green;'>¡Habitación registrada correctamente!</p>";
                        } else {
                            echo "Error al registrar la habitación: " . $conn->error;
                        }
                    }
                }
            }

            // Cerrar conexión
            $conn->close();
            ?>
        </div>

        <div class="tabla">
            <h2>Registros de Habitaciones</h2>
            <a href="tabla_registros_habitaciones.php">Ver registros de habitaciones</a>
        </div>
    </div>
</body>

</html>











