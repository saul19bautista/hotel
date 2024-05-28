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

// Consultar registros de facturas
$sql = "SELECT * FROM facturas";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Facturas</title>
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
    <h2>Registros de Facturas</h2>
    <table>
        <tr>
            <th>Folio</th>
            <th>Fecha de Facturación</th>
            <th>Forma de Pago</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Domicilio</th>
            <th>Teléfono</th>
            <th>Número de Habitación</th>
            <th>Valor</th>
            <th>Impuesto</th>
            <th>Importe Precio</th>
            <th>Subtotal</th>
            <th>IVA</th>
            <th>Total a Pagar</th>
            <th>Número de Cuenta</th>
            <th>Banco</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["folio"] . "</td><td>" . $row["fecha_facturacion"] . "</td><td>" . $row["forma_pago"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["apellido_paterno"] . "</td><td>" . $row["apellido_materno"] . "</td><td>" . $row["domicilio"] . "</td><td>" . $row["telefono"] . "</td><td>" . $row["numero_habitacion"] . "</td><td>" . $row["valor"] . "</td><td>" . $row["impuesto"] . "</td><td>" . $row["importe_precio"] . "</td><td>" . $row["subtotal"] . "</td><td>" . $row["iva"] . "</td><td>" . $row["total_pagar"] . "</td><td>" . $row["numero_cuenta"] . "</td><td>" . $row["banco"] . "</td>";
                echo "<td>
                        <form method='post' action='modificar_factura.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='btn-modificar'>Modificar</button>
                        </form>
                        <form method='post' action='eliminar_factura.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='btn-eliminar'>Eliminar</button>
                        </form>
                      </td></tr>"; 
            }
        } else {
            echo "<tr><td colspan='18'>No hay facturas registradas</td></tr>";
        }
        ?>
    </table>
</body>

</html>

<?php
// Cerrar conexión
$conn->close();
?>
