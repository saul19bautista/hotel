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

// Obtener registros de la tabla de clientes
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error al obtener los registros: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Registros de clientes</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
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

        .buscador-container {
            margin-bottom: 20px;
        }

        .buscador-container input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .buscador-container button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .buscador-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h2>Registros de Clientes</h2>

    <div class="buscador-container">
        <input type="text" id="input-busqueda" placeholder="Buscar por nombre...">
        <button onclick="buscar()">Buscar</button>
    </div>

    <table id="tabla-registros">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["apellidoPaterno"] . "</td>";
                echo "<td>" . $row["apellidoMaterno"] . "</td>";
                echo "<td>" . $row["telefono"] . "</td>";
                echo "<td>" . $row["correoElectronico"] . "</td>";
                echo "<td>";
                echo "<form id='form-modificar-" . $row["id"] . "' method='post' action='modificar_cliente.php' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                echo "<button type='submit' class='btn-modificar'>Modificar</button>";
                echo "</form>";
                echo "<form id='form-eliminar-" . $row["id"] . "' method='post' action='eliminar_cliente.php' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                echo "<button type='submit' class='btn-eliminar' onclick='eliminarCliente(" . $row["id"] . ")'>Eliminar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay registros</td></tr>";
        }
        ?>
    </table>

    <script>
        function eliminarCliente(id) {
            if (confirm("¿Estás seguro de que quieres eliminar este cliente?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                document.getElementById("tabla-registros").deleteRow(document.getElementById("form-eliminar-" + id).parentNode.parentNode.rowIndex);
                            } else {
                                alert("Error al eliminar el cliente: " + response.error);
                            }
                        } else {
                            alert("Error al eliminar el cliente: " + xhr.statusText);
                        }
                    }
                };
                xhr.open("POST", "eliminar_cliente.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("id=" + id);
            }
        }

        function buscar() {
            var input = document.getElementById("input-busqueda").value.toLowerCase();
            var rows = document.getElementById("tabla-registros").getElementsByTagName("tr");
            for (var i = 1; i < rows.length; i++) {
                var nombre = rows[i].getElementsByTagName("td")[1].innerText.toLowerCase();
                var apellidoPaterno = rows[i].getElementsByTagName("td")[2].innerText.toLowerCase();
                var apellidoMaterno = rows[i].getElementsByTagName("td")[3].innerText.toLowerCase();
                if (nombre.includes(input) || apellidoPaterno.includes(input) || apellidoMaterno.includes(input)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>




