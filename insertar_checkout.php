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

// Insertar datos en la tabla de check-out
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar'])) {
    $nombre = $_POST["nombre"];
    $apellidoPaterno = $_POST["apellido_paterno"];
    $apellidoMaterno = $_POST["apellido_materno"];
    $fechaCheckout = $_POST["fecha_checkout"];
    $horaCheckout = $_POST["hora_checkout"];

    $sql = "INSERT INTO Checkout (nombre, apellido_paterno, apellido_materno, fecha_checkout, hora_checkout) 
            VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$fechaCheckout', '$horaCheckout')";

    if ($conn->query($sql) === TRUE) {
        echo "Check-out registrado correctamente";
    } else {
        echo "Error al registrar el check-out: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
