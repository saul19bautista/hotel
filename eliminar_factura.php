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

// Verificar si se ha enviado el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener el ID de la factura a eliminar
    $id = $_POST['id'];

    // Preparar y ejecutar la consulta SQL para eliminar la factura
    $sql = "DELETE FROM facturas WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Factura eliminada correctamente.";
    } else {
        echo "Error al eliminar la factura: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>

