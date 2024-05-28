<?php
// Información de conexión a la base de datos
$servername = "localhost"; // dirección IP del servidor de la base de datos
$username = "root"; // nombre de usuario de la base de datos
$password = ""; // contraseña de la base de datos
$dbname = "paraiso"; // nombre de la base de datos que contiene la tabla de usuarios

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

// Verificar si el nombre de usuario ya existe en la base de datos
$sql_check = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$result_check = $conn->query($sql_check);
if ($result_check->num_rows > 0) {
    echo "El nombre de usuario ya está en uso. Por favor, elija otro.";
    // Puedes redirigir o mostrar un formulario para que el usuario vuelva a intentarlo
} else {
    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (usuario, contraseña) VALUES ('$usuario', '$contraseña')";
    if ($conn->query($sql) === TRUE) {
        // Redirigir al usuario a la página de inicio de sesión
        header("Location: inicio_sesion.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>

