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

// Obtener el ID del check-out a eliminar
$id = $_POST['id'];

// Eliminar el registro de check-out de la base de datos
$sql = "DELETE FROM Checkout WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Check-out eliminado correctamente";
} else {
    echo "Error al eliminar el check-out: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
