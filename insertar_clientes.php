<?php
// Conexión a la base de datos (debes completar con tus propios datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paraiso";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoPaterno'];
$apellidoMaterno = $_POST['apellidoMaterno'];
$telefono = $_POST['telefono'];
$correoElectronico = $_POST['correoElectronico'];

// Preparar la consulta SQL para insertar los datos en la tabla
$sql = "INSERT INTO clientes (nombre, apellidoPaterno, apellidoMaterno, telefono, correoElectronico) 
        VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$telefono', '$correoElectronico')";

if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente";
} else {
    echo "Error al insertar registro: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>




