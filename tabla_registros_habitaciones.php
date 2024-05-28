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

// Consultar registros de habitaciones
$sql = "SELECT * FROM Habitaciones";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Habitaciones</title>
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
    </style>
</head>

<body>
    <h2>Registros de Habitaciones</h2>
    <table>
        <tr>
            <th>Número de Habitación</th>
            <th>Tipo de Habitación</th>
            <th>Precio por Noche</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["numero_habitacion"] . "</td><td>" . $row["tipo_habitacion"] . "</td><td>" . $row["precio"] . "</td>";
                echo "<td>
                        <form method='post' action='modificar_habitacion.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='btn-modificar'>Modificar</button>
                        </form>
                        <form method='post' action='eliminar_habitacion.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='btn-eliminar'>Eliminar</button>
                        </form>
                      </td></tr>"; 
            }
        } else {
            echo "<tr><td colspan='4'>No hay habitaciones registradas</td></tr>";
        }
        ?>
    </table>
</body>

</html>

<?php
// Cerrar conexión
$conn->close();
?>
