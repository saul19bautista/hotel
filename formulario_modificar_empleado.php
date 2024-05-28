<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Empleado</title>
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

        select {
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
        <h1>Modificar Empleado</h1>
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

        // Verificar si se ha pasado el parámetro 'id'
        if (isset($_GET['id'])) {
            // Obtener el ID del empleado a modificar
            $id = $_GET['id'];

            // Consultar el registro de empleado a modificar
            $sql = "SELECT * FROM Empleados WHERE id = $id";
            $result = $conn->query($sql);

            // Verificar si se encontró el registro
            if ($result->num_rows > 0) {
                // Obtener los datos del registro
                $row = $result->fetch_assoc();
                $nombre = $row["nombre"];
                $apellidoPaterno = $row["apellido_paterno"];
                $apellidoMaterno = $row["apellido_materno"];
                $puesto = $row["puesto"];
                $fechaContratacion = $row["fecha_contratacion"];
                ?>
                <form method="post" action="actualizar_empleado.php" onsubmit="return validarCampos()">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno:</label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?php echo $apellidoPaterno; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno:</label>
                        <input type="text" id="apellido_materno" name="apellido_materno" value="<?php echo $apellidoMaterno; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="puesto">Puesto:</label>
                        <select id="puesto" name="puesto" required>
                            <option value="recepcionista" <?php if ($puesto == "recepcionista") echo "selected"; ?>>Recepcionista</option>
                            <option value="cocinero" <?php if ($puesto == "cocinero") echo "selected"; ?>>Cocinero</option>
                            <option value="limpieza" <?php if ($puesto == "limpieza") echo "selected"; ?>>Limpieza</option>
                            <option value="gerente" <?php if ($puesto == "gerente") echo "selected"; ?>>Gerente</option>
                            <option value="mesero" <?php if ($puesto == "mesero") echo "selected"; ?>>Mesero</option>
                            <option value="supervisor" <?php if ($puesto == "supervisor") echo "selected"; ?>>Supervisor</option>
                            <!-- Agrega aquí más opciones según los puestos disponibles -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_contratacion">Fecha de Contratación:</label>
                        <input type="date" id="fecha_contratacion" name="fecha_contratacion" value="<?php echo $fechaContratacion; ?>" required>
                    </div>
                    <button type="submit" name="modificar">Modificar Empleado</button>
                </form>
            <?php
            } else {
                echo "No se encontró el registro de empleado a modificar";
            }
        } else {
            echo "El parámetro 'id' no se ha pasado correctamente";
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </div>

    <script>
        // Función para validar los campos de entrada del formulario
        function validarCampos() {
            var nombreInput = document.getElementById('nombre').value.trim();
            var apellidoPaternoInput = document.getElementById('apellido_paterno').value.trim();
            var apellidoMaternoInput = document.getElementById('apellido_materno').value.trim();
            
            // Expresión regular que valida uno o dos nombres sin símbolos ni nombres incompletos con la primera letra en mayúscula y al menos tres letras en cada parte
            var regex = /^[A-Z][a-zA-Z]{2,}(?:\s+[A-Z][a-zA-Z]{2,})?$/;
            // Expresión regular que valida apellidos con al menos cinco letras y la primera letra en mayúscula
            var apellidoRegex = /^[A-Z][a-zA-Z]{4,}$/;
            
            if (!regex.test(nombreInput) || !apellidoRegex.test(apellidoPaternoInput) || !apellidoRegex.test(apellidoMaternoInput)) {
                alert('Por favor, ingrese nombres y apellidos válidos con la primera letra en mayúscula y al menos cinco letras en cada parte.');
                return false;
            }
            
            return true;
        }
    </script>
</body>

</html>


