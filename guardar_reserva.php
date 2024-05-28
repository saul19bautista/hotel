<?php
// Configuración de la conexión a la base de datos
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

// Obtener los datos del formulario
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido_paterno = isset($_POST['apellido_paterno']) ? $_POST['apellido_paterno'] : '';
$apellido_materno = isset($_POST['apellido_materno']) ? $_POST['apellido_materno'] : '';
$num = isset($_POST['num']) ? $_POST['num'] : '';
$fecha_entrada = isset($_POST['fecha_entrada']) ? $_POST['fecha_entrada'] : '';
$fecha_salida = isset($_POST['fecha_salida']) ? $_POST['fecha_salida'] : '';
$num_personas = isset($_POST['num_personas']) ? $_POST['num_personas'] : '';
$tipo_habitacion = isset($_POST['tipo_habitacion']) ? $_POST['tipo_habitacion'] : '';
$num_habitacion = isset($_POST['num_habitacion']) ? $_POST['num_habitacion'] : '';

// Preparar la consulta SQL para insertar los datos en la base de datos
$sql = "INSERT INTO reservas (nombre, apellido_paterno, apellido_materno, num, fecha_entrada, fecha_salida, num_personas, tipo_habitacion, num_habitacion)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$num', '$fecha_entrada', '$fecha_salida', '$num_personas', '$tipo_habitacion', '$num_habitacion')";

if ($conn->query($sql) === TRUE) {
    echo "Reserva guardada correctamente";
} else {
    echo "Error al guardar la reserva: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>

