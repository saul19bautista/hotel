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

// Obtener el ID del cliente a eliminar
$id = $_POST['id'];

// Eliminar el cliente de la base de datos
$sql = "DELETE FROM Clientes WHERE id = $id";

$response = "¡Cliente eliminado correctamente!";
if ($conn->query($sql) !== TRUE) {
    $response = "Error al eliminar el cliente: " . $conn->error;
}

// Cerrar conexión
$conn->close();

// Devolver respuesta
echo $response;
?>


