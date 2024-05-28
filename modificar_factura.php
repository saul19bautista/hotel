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

// Variables para prellenar los campos del formulario
$id = "";
$folio = "";
$fecha_facturacion = "";
$forma_pago = "";
$nombre = "";
$apellido_paterno = "";
$apellido_materno = "";
$domicilio = "";
$telefono = "";
$numero_habitacion = "";
$tipo_habitacion = "";
$numero_cuenta = "";
$banco = "";
$valor = "";
$impuesto = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener el ID de la factura a modificar
    $id = $_POST['id'];

    // Obtener los datos de la factura de la base de datos
    $sql = "SELECT * FROM facturas WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Asignar los datos de la factura a las variables
        $folio = $row['folio'];
        $fecha_facturacion = $row['fecha_facturacion'];
        $forma_pago = $row['forma_pago'];
        $nombre = $row['nombre'];
        $apellido_paterno = $row['apellido_paterno'];
        $apellido_materno = $row['apellido_materno'];
        $domicilio = $row['domicilio'];
        $telefono = $row['telefono'];
        $numero_habitacion = $row['numero_habitacion'];
        $tipo_habitacion = "";
        $numero_cuenta = $row['numero_cuenta'];
        $banco = $row['banco'];
        $valor = $row['valor'];
        $impuesto = $row['impuesto'];
    } else {
        echo "No se encontró la factura a modificar.";
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        select {
            width: calc(100% - 12px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Modificar Factura</h2>
        <form action="actualizar_factura.php" method="post">
            <!-- Campo oculto para enviar el ID de la factura -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="folio">Folio:</label>
                <input type="text" id="folio" name="folio" value="<?php echo $folio; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_facturacion">Fecha de Facturación:</label>
                <input type="date" id="fecha_facturacion" name="fecha_facturacion" value="<?php echo $fecha_facturacion; ?>" required>
            </div>
            <div class="form-group">
                <label for="forma_pago">Forma de Pago:</label>
                <select id="forma_pago" name="forma_pago" required onchange="mostrarCamposAdicionales()">
                    <option value="efectivo" <?php if ($forma_pago == 'efectivo') echo 'selected'; ?>>Efectivo</option>
                    <option value="transferencia" <?php if ($forma_pago == 'transferencia') echo 'selected'; ?>>Transferencia</option>
                </select>
            </div>
            <hr>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" value="<?php echo $nombre; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" value="<?php echo $apellido_paterno; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" value="<?php echo $apellido_materno; ?>" required>
            </div>
            <div class="form-group">
                <label for="domicilio">Domicilio:</label>
                <input type="text" id="domicilio" name="domicilio" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" value="<?php echo $domicilio; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" pattern="[0-9]{10}" title="Ingrese 10 dígitos numéricos" value="<?php echo $telefono; ?>" required>
            </div>
            <div class="form-group">
                <label for="numero_habitacion">Número de Habitación:</label>
                <input type="text" id="numero_habitacion" name="numero_habitacion" value="<?php echo $numero_habitacion; ?>" required>
            </div>
            <hr>
            <div id="camposTransferencia" style="display: none;">
                <div class="form-group">
                    <label for="numero_cuenta">Número de Cuenta:</label>
                    <input type="text" id="numero_cuenta" name="numero_cuenta" pattern="[0-9]{16}" title="Ingrese 16 dígitos numéricos" value="<?php echo $numero_cuenta; ?>">
                    <span id="errorNumeroCuenta" class="error"></span>
                </div>
                <div class="form-group">
                    <label for="banco">Banco:</label>
                    <input type="text" id="banco" name="banco" pattern="[A-Za-z\s]+" title="Ingrese solo letras" value="<?php echo $banco; ?>">
                    <span id="errorBanco" class="error"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="tipo_habitacion">Tipo de Habitación:</label>
                <select id="tipo_habitacion" name="tipo_habitacion" required onchange="actualizarPrecio()">
                    <option value="">Seleccione tipo de habitación</option>
                    <option value="Suit-150" <?php if ($tipo_habitacion == 'Suit-150') echo 'selected'; ?>>Suit - $150.00</option>
                    <option value="Doble-100" <?php if ($tipo_habitacion == 'Doble-100') echo 'selected'; ?>>Doble - $100.00</option>
                    <option value="Individual-75" <?php if ($tipo_habitacion == 'Individual-75') echo 'selected'; ?>>Individual - $75.00</option>
                </select>
            </div>
            <div class="form-group">
                <label for="valor">Valor (Precio):</label>
                <input type="number" id="valor" name="valor" min="0" max="10000" title="Ingrese un número" value="<?php echo $valor; ?>" required oninput="calcularFactura()">
            </div>
            <div class="form-group">
                <label for="impuesto">Impuesto:</label>
                <input type="number" id="impuesto" name="impuesto" step="0.01" value="<?php echo $impuesto; ?>" required oninput="calcularFactura()">
            </div>
            <div class="form-group">
                <label for="importe_precio">Importe Precio:</label>
                <input type="number" id="importe_precio" name="importe_precio" step="0.01" readonly>
            </div>
            <div class="form-group">
                <label for="subtotal">Subtotal:</label>
                <input type="number" id="subtotal" name="subtotal" step="0.01" readonly>
            </div>
            <div class="form-group">
                <label for="iva">IVA:</label>
                <input type="number" id="iva" name="iva" step="0.01" readonly>
            </div>
            <div class="form-group">
                <label for="total_pagar">Total a Pagar:</label>
                <input type="number" id="total_pagar" name="total_pagar" step="0.01" readonly>
            </div>
            <button type="submit" name="registrar">Actualizar Factura</button>
        </form>
    </div>
    <script>
        function mostrarCamposAdicionales() {
            var formaPago = document.getElementById("forma_pago").value;
            var camposTransferencia = document.getElementById("camposTransferencia");

            if (formaPago === "transferencia") {
                camposTransferencia.style.display = "block";
            } else {
                camposTransferencia.style.display = "none";
            }
        }

        function actualizarPrecio() {
            var tipoHabitacion = document.getElementById("tipo_habitacion").value;
            var splitValues = tipoHabitacion.split('-');
            var precio = parseFloat(splitValues[1]);

            document.getElementById("valor").value = precio.toFixed(2);
            calcularFactura();
        }

        function calcularFactura() {
            var valor = parseFloat(document.getElementById("valor").value);
            var impuesto = parseFloat(document.getElementById("impuesto").value);

            var importePrecio = valor * impuesto;
            var subtotal = valor + importePrecio;
            var iva = subtotal * 0.16;
            var totalPagar = subtotal + iva;

            document.getElementById("importe_precio").value = importePrecio.toFixed(2);
            document.getElementById("subtotal").value = subtotal.toFixed(2);
            document.getElementById("iva").value = iva.toFixed(2);
            document.getElementById("total_pagar").value = totalPagar.toFixed(2);
        }
    </script>
</body>

</html>

