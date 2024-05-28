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

// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar'])) {
    // Recuperar los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellido_paterno'];
    $apellidoMaterno = $_POST['apellido_materno'];
    $puesto = $_POST['puesto'];
    $fechaContratacion = $_POST['fecha_contratacion'];

    // Actualizar los datos del empleado en la base de datos
    $sql_update = "UPDATE Empleados SET nombre = '$nombre', apellido_paterno = '$apellidoPaterno', apellido_materno = '$apellidoMaterno', puesto = '$puesto', fecha_contratacion = '$fechaContratacion' WHERE id = $id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Empleado actualizado correctamente";
    } else {
        echo "Error al actualizar el empleado: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
