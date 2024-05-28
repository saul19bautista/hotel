<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Facturas</title>
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

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
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
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="8"><path fill="%23000" d="M1 0l5 4.998L11 0v1.414L6 6.412 1 1.414V0z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            background-size: 12px auto;
            padding-right: 30px;
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

        .tabla {
            text-align: center;
            margin-top: 20px;
        }

        .tabla h2 {
            margin-bottom: 10px;
        }

        .tabla a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .tabla a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Registro de Facturas</h1>
        <form id="facturaForm" method="post" action="insertar_factura.php">
            <div class="form-group">
                <label for="folio">Folio:</label>
                <input type="text" id="folio" name="folio" required>
            </div>
            <div class="form-group">
                <label for="fecha_facturacion">Fecha de Facturación:</label>
                <input type="date" id="fecha_facturacion" name="fecha_facturacion" required>
            </div>
            <div class="form-group">
                <label for="forma_pago">Forma de Pago:</label>
                <select id="forma_pago" name="forma_pago" required onchange="mostrarCamposAdicionales()">
                    <option value="efectivo">Efectivo</option>
                    <option value="transferencia">Transferencia</option>
                </select>
            </div>
            <hr>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" required>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" required>
            </div>
            <div class="form-group">
                <label for="domicilio">Domicilio:</label>
                <input type="text" id="domicilio" name="domicilio" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" pattern="[0-9]{10}" title="Ingrese 10 dígitos numéricos" required>
            </div>
            <div class="form-group">
                <label for="numero_habitacion">Número de Habitación:</label>
                <input type="text" id="numero_habitacion" name="numero_habitacion" required>
            </div>
            <hr>
            <div id="camposTransferencia" style="display: none;">
                <div class="form-group">
                    <label for="numero_cuenta">Número de Cuenta:</label>
                    <input type="text" id="numero_cuenta" name="numero_cuenta" pattern="[0-9]{16}" title="Ingrese 16 dígitos numéricos">
                    <span id="errorNumeroCuenta" class="error"></span>
                </div>
                <div class="form-group">
                    <label for="banco">Banco:</label>
                    <input type="text" id="banco" name="banco" pattern="[A-Za-z\s]+" title="Ingrese solo letras">
                    <span id="errorBanco" class="error"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="tipo_habitacion">Tipo de Habitación:</label>
                <select id="tipo_habitacion" name="tipo_habitacion" required onchange="actualizarPrecio()">
                    <option value="">Seleccione tipo de habitación</option>
                    <option value="Suit-150">Suit - $150.00</option>
                    <option value="Doble-100">Doble - $100.00</option>
                    <option value="Individual-75">Individual - $75.00</option>
                </select>
            </div>
            <div class="form-group">
                <label for="valor">Valor (Precio):</label>
                <input type="number" id="valor" name="valor" min="0" max="10000" title="Ingrese un número" required oninput="calcularFactura()">
            </div>
            <div class="form-group">
                <label for="impuesto">Impuesto:</label>
                <input type="number" id="impuesto" name="impuesto" step="0.01" required oninput="calcularFactura()">
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
            <button type="submit" name="registrar">Registrar Factura</button>
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

    <div class="tabla">
        <h2>Registros de facturas</h2>
        <a href="tabla_facturas.php">Ver registros de facturas</a>
    </div>
</body>

</html>



