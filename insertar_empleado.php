<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Cambia localhost por el nombre del servidor si es necesario
$username = "root"; // Cambia tu_usuario por el nombre de usuario de la base de datos
$password = ""; // Cambia tu_contraseña por la contraseña de la base de datos
$database = "paraiso"; // Cambia tu_base_de_datos por el nombre de la base de datos

// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han recibido los datos del formulario
    if (isset($_POST['nombre']) && isset($_POST['apellido_paterno']) && isset($_POST['apellido_materno']) && isset($_POST['puesto']) && isset($_POST['fecha_contratacion'])) {
        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Recuperar los datos del formulario
        $nombre = $_POST["nombre"];
        $apellidoPaterno = $_POST["apellido_paterno"];
        $apellidoMaterno = $_POST["apellido_materno"];
        $puesto = $_POST["puesto"];
        $fechaContratacion = $_POST["fecha_contratacion"];

        // Preparar y ejecutar la consulta SQL para insertar el empleado
        $sql = "INSERT INTO Empleados (nombre, apellido_paterno, apellido_materno, puesto, fecha_contratacion) 
                VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$puesto', '$fechaContratacion')";

        if ($conn->query($sql) === TRUE) {
            echo "Empleado registrado correctamente";
        } else {
            echo "Error al registrar el empleado: " . $conn->error;
        }

        // Cerrar conexión
        $conn->close();
    } else {
        echo "Faltan datos en el formulario";
    }
} else {
    echo "Acceso no autorizado";
}
?>
