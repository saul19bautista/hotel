<?php
// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado un ID válido
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo "ID de habitación no válido";
        exit;
    }

    // Recuperar los datos del formulario
    $id = $_POST['id'];
    $numero_habitacion = $_POST['numerohabitacion'];
    $tipo_habitacion = $_POST['tipohabitacion'];
    $precio = $_POST['precio'];

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

    // Consultar si la habitación a actualizar existe
    $sql = "SELECT * FROM Habitaciones WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "No se encontró la habitación con el ID proporcionado";
        exit;
    }

    // Actualizar los datos de la habitación en la base de datos
    $sql_update = "UPDATE Habitaciones SET numero_habitacion = '$numero_habitacion', tipo_habitacion = '$tipo_habitacion', precio = '$precio' WHERE id = $id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Habitación actualizada correctamente";
    } else {
        echo "Error al actualizar la habitación: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
} else {
    echo "Acceso no autorizado";
}
?>
