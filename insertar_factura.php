<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos (cambia estos datos según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "paraiso";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Limpiar y validar los datos del formulario
    $folio = mysqli_real_escape_string($conn, $_POST["folio"]);
    $fecha_facturacion = mysqli_real_escape_string($conn, $_POST["fecha_facturacion"]);
    $forma_pago = mysqli_real_escape_string($conn, $_POST["forma_pago"]);
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $apellido_paterno = mysqli_real_escape_string($conn, $_POST["apellido_paterno"]);
    $apellido_materno = mysqli_real_escape_string($conn, $_POST["apellido_materno"]);
    $domicilio = mysqli_real_escape_string($conn, $_POST["domicilio"]);
    $telefono = mysqli_real_escape_string($conn, $_POST["telefono"]);
    $numero_habitacion = isset($_POST["numero_habitacion"]) ? mysqli_real_escape_string($conn, $_POST["numero_habitacion"]) : null;
    $valor = floatval($_POST["valor"]); // Convertir a float para evitar inyección de SQL
    $impuesto = floatval($_POST["impuesto"]); // Convertir a float para evitar inyección de SQL
    $importe_precio = floatval($_POST["importe_precio"]); // Convertir a float para evitar inyección de SQL
    $subtotal = floatval($_POST["subtotal"]); // Convertir a float para evitar inyección de SQL
    $iva = floatval($_POST["iva"]); // Convertir a float para evitar inyección de SQL
    $total_pagar = floatval($_POST["total_pagar"]); // Convertir a float para evitar inyección de SQL
    $numero_cuenta = isset($_POST["numero_cuenta"]) ? mysqli_real_escape_string($conn, $_POST["numero_cuenta"]) : null;
    $banco = isset($_POST["banco"]) ? mysqli_real_escape_string($conn, $_POST["banco"]) : null;

    // Preparar y ejecutar la consulta SQL para insertar la factura en la base de datos
    $sql = "INSERT INTO facturas (folio, fecha_facturacion, forma_pago, nombre, apellido_paterno, apellido_materno, domicilio, telefono, numero_habitacion, valor, impuesto, importe_precio, subtotal, iva, total_pagar, numero_cuenta, banco)
    VALUES ('$folio', '$fecha_facturacion', '$forma_pago', '$nombre', '$apellido_paterno', '$apellido_materno', '$domicilio', '$telefono', '$numero_habitacion', '$valor', '$impuesto', '$importe_precio', '$subtotal', '$iva', '$total_pagar', '$numero_cuenta', '$banco')";

    if ($conn->query($sql) === TRUE) {
        echo "Factura registrada correctamente.";
    } else {
        echo "Error al registrar la factura: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
