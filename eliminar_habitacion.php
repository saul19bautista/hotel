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

// Obtener el ID de la habitación a eliminar
$id = $_POST['id'];

// Eliminar la habitación de la base de datos
$sql = "DELETE FROM Habitaciones WHERE id = $id";

$response = "¡Habitación eliminada correctamente!";
if ($conn->query($sql) !== TRUE) {
    $response = "Error al eliminar la habitación: " . $conn->error;
}

// Cerrar conexión
$conn->close();

// Devolver respuesta
echo $response;
?>
