<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Check-in</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2; /* Fondo gris claro para encabezados */
        }

        .btn-modificar, .btn-eliminar {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-modificar {
            background-color: #007bff;
            color: #fff;
        }

        .btn-eliminar {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-modificar:hover, .btn-eliminar:hover {
            background-color: #0056b3;
        }

        .buscar-btn {
            padding: 8px 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buscar-btn:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <h2>Registros de Check-in</h2>
    <form method="post" action="">
        <input type="text" name="busqueda" placeholder="Buscar...">
        <button type="submit" class="buscar-btn">Buscar</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha de Check-in</th>
            <th>Hora de Check-in</th>
            <th>Acciones</th>
        </tr>
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

        // Consultar registros de check-in
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $busqueda = $_POST['busqueda'];
            $sql = "SELECT * FROM Checkin WHERE nombre LIKE '%$busqueda%' OR apellido_paterno LIKE '%$busqueda%' OR apellido_materno LIKE '%$busqueda%'";
        } else {
            $sql = "SELECT * FROM Checkin";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["apellido_paterno"] . "</td><td>" . $row["apellido_materno"] . "</td><td>" . $row["fecha_checkin"] . "</td><td>" . $row["hora_checkin"] . "</td>";
                echo "<td>
                        <form method='post' action='modificar_checkin.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='btn-modificar'>Modificar</button>
                        </form>
                        <form method='post' action='eliminar_checkin.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='btn-eliminar'>Eliminar</button>
                        </form>
                      </td></tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay registros de check-in</td></tr>";
        }
        ?>
    </table>
    <?php
    // Cerrar conexión
    $conn->close();
    ?>
</body>

</html>


