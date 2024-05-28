<?php
// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado un ID válido
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo "ID de check-in no válido";
        exit;
    }

    // Recuperar los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellido_paterno'];
    $apellidoMaterno = $_POST['apellido_materno'];
    $fechaCheckin = $_POST['fecha_checkin'];
    $horaCheckin = $_POST['hora_checkin'];

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

    // Consultar si el check-in a actualizar existe
    $sql = "SELECT * FROM Checkin WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "No se encontró el check-in con el ID proporcionado";
        exit;
    }

    // Actualizar los datos del check-in en la base de datos
    $sql_update = "UPDATE Checkin SET nombre = '$nombre', apellido_paterno = '$apellidoPaterno', apellido_materno = '$apellidoMaterno', fecha_checkin = '$fechaCheckin', hora_checkin = '$horaCheckin' WHERE id = $id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Check-in actualizado correctamente";
    } else {
        echo "Error al actualizar el check-in: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
} else {
    echo "Acceso no autorizado";
}
?>

