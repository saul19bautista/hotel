<?php
// Configuración de la conexión a la base de datos
$host = 'localhost'; // Host de la base de datos
$usuario_db = 'Saul'; // Nuevo usuario de la base de datos
$contraseña_db = 'micontraseña'; // Contraseña del nuevo usuario
$nombre_db = 'paraiso'; // Nombre de la base de datos

// Intentar conectar a la base de datos
$conexion = new mysqli($host, $usuario_db, $contraseña_db, $nombre_db);

// Verificar si hay errores de conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Procesar el formulario de registro
if (isset($_POST['register'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email_registro'];
    $contraseña = $_POST['password_registro'];
    
    // Consulta SQL para insertar un nuevo usuario en la tabla usuarios
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";
    
    // Ejecutar la consulta SQL
    if ($conexion->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar usuario: " . $conexion->error;
    }
}
?>
