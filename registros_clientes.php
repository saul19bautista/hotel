<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaffdb; /* Fondo verde limón */
            color: #333; /* Color de texto oscuro */
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            max-width: 1000px;
            margin: 50px auto;
        }

        .formulario, .tabla {
            flex-basis: 48%;
            background-color: #fff; /* Fondo blanco para contrastar */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        h1, h2 {
            text-align: center;
            color: #333; /* Color de texto oscuro */
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333; /* Color de texto oscuro */
        }

        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: calc(33.33% - 5px);
            padding: 10px;
            margin-top: 10px;
            background-color: #6eff8b; /* Verde limón */
            color: #fff; /* Color de texto blanco */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4cd966; /* Cambio de color al pasar el ratón */
        }

        .tabla-registros {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabla-registros th,
        .tabla-registros td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .tabla-registros th {
            background-color: #f2f2f2; /* Fondo gris claro */
        }

        .btn-modificar {
            margin-right: 5px;
        }

        .btn-eliminar {
            margin-left: 5px;
        }
        </style>
</head>

<body>
    <div class="container">
        <div class="formulario">
            <h1>Registrar cliente</h1>
            <form method="post" action="insertar_clientes.php">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" required>
                </div>

                <div class="form-group">
                    <label for="apellidoPaterno">Apellido Paterno:</label>
                    <input type="text" id="apellidoPaterno" name="apellidoPaterno" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" required>
                </div>

                <div class="form-group">
                    <label for="apellidoMaterno">Apellido Materno:</label>
                    <input type="text" id="apellidoMaterno" name="apellidoMaterno" pattern="[A-ZÁÉÍÓÚ][a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*" title="Ingrese solo letras y comience con mayúscula" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" pattern="[0-9]{10}" title="Ingrese 10 dígitos numéricos" required>
                </div>

                <div class="form-group">
                    <label for="correoElectronico">Correo Electrónico:</label>
                    <input type="email" id="correoElectronico" name="correoElectronico" required>
                </div>

                <button type="submit" name="registrar">Registrar</button>
            </form>
        </div>

        <div class="tabla">
            <h2>Registros de clientes</h2>
            <a href="tabla_registros.php">Ver registros de clientes </a>
        </div>
    </div>
</body>

</html>






