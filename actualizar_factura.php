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

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener el ID de la factura a actualizar
    $id = $_POST['id'];

    // Obtener los datos del formulario
    $folio = $_POST['folio'];
    $fecha_facturacion = $_POST['fecha_facturacion'];
    $forma_pago = $_POST['forma_pago'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $domicilio = $_POST['domicilio'];
    $telefono = $_POST['telefono'];
    $numero_habitacion = $_POST['numero_habitacion'];
    $tipo_habitacion = isset($_POST['tipo_habitacion']) ? $_POST['tipo_habitacion'] : "";
    $numero_cuenta = isset($_POST['numero_cuenta']) ? $_POST['numero_cuenta'] : "";
    $banco = isset($_POST['banco']) ? $_POST['banco'] : "";
    $valor = $_POST['valor'];
    $impuesto = $_POST['impuesto'];
    $importe_precio = $valor * $impuesto;
    $subtotal = $valor + $importe_precio;
    $iva = $subtotal * 0.16;
    $total_pagar = $subtotal + $iva;

    // Preparar y ejecutar la consulta SQL para actualizar la factura
    $sql = "UPDATE facturas SET folio='$folio', fecha_facturacion='$fecha_facturacion', forma_pago='$forma_pago', nombre='$nombre', apellido_paterno='$apellido_paterno', apellido_materno='$apellido_materno', domicilio='$domicilio', telefono='$telefono', numero_habitacion='$numero_habitacion', tipo_habitacion='$tipo_habitacion', numero_cuenta='$numero_cuenta', banco='$banco', valor='$valor', impuesto='$impuesto', importe_precio='$importe_precio', subtotal='$subtotal', iva='$iva', total_pagar='$total_pagar' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Factura actualizada correctamente.";
    } else {
        echo "Error al actualizar la factura: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
