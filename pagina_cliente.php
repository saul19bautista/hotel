<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Hospedaje</title>
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
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
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

        .habitaciones {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
        }

        .habitacion {
            width: 33.33%;
            padding: 10px;
            box-sizing: border-box;
            background-color: #7FFF7F;
            border: 1px solid #00FF00;
        }

        .no-disponible {
            display: none; /* Ocultar habitaciones no disponibles */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Reserva de Hospedaje</h1>
        <form method="post" action="procesar_reserva.php">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required pattern="[A-ZÁÉÍÓÚ][a-záéíóú\s]*" title="La primera letra debe ser mayúscula">
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" required pattern="[A-ZÁÉÍÓÚ][a-záéíóú\s]*" title="La primera letra debe ser mayúscula">
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" required pattern="[A-ZÁÉÍÓÚ][a-záéíóú\s]*" title="La primera letra debe ser mayúscula">
            </div>
            <div class="form-group">
                <label for="num">Numero Telefonico:</label>
                <input type="tel" id="num" name="num" required pattern="[0-9]{10}" title="Ingrese un número de teléfono válido (10 dígitos)">
            </div>
            <div class="form-group">
                <label for="fecha_entrada">Fecha de Entrada:</label>
                <input type="date" id="fecha_entrada" name="fecha_entrada" required>
            </div>
            <div class="form-group">
                <label for="fecha_salida">Fecha de Salida:</label>
                <input type="date" id="fecha_salida" name="fecha_salida" required>
            </div>
            <div class="form-group">
                <label for="num_personas">Número de Personas:</label>
                <input type="number" id="num_personas" name="num_personas" min="1" required>
            </div>
            <div class="form-group">
                <label for="tipo_habitacion">Tipo de Habitación:</label>
                <select id="tipo_habitacion" name="tipo_habitacion" required>
                    <option value="suit">Suit - $150</option>
                    <option value="doble">Doble - $100</option>
                    <option value="individual">Individual - $75</option>
                </select>
            </div>
            <div class="form-group">
                <label for="num_habitacion">Número de Habitación:</label>
                <select id="num_habitacion" name="num_habitacion" required>
                    <?php
                    $habitaciones_ocupadas = [3, 7, 9, 11, 15, 17, 19, 23, 25, 29, 31]; // Ejemplo de habitaciones ocupadas
                    for ($i = 1; $i <= 31; $i++) {
                        if (!in_array($i, $habitaciones_ocupadas)) {
                            $tipo_habitacion = $i <= 11 ? 'Suit' : ($i <= 21 ? 'Doble' : 'Individual');
                            echo "<option value='$i'>Habitación $i - $tipo_habitacion</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="reservar">Reservar Hospedaje</button>
        </form>

        <div class="habitaciones">
            <?php
            // Lógica PHP para mostrar las habitaciones disponibles
            $habitaciones_ocupadas = [3, 7, 9, 11, 15, 17, 19, 23, 25, 29, 31]; // Ejemplo de habitaciones ocupadas
            for ($i = 1; $i <= 31; $i++) {
                if (!in_array($i, $habitaciones_ocupadas)) {
                    $tipo_habitacion = $i <= 11 ? 'Suit' : ($i <= 21 ? 'Doble' : 'Individual');
                    echo "<div class='habitacion'>Habitación $i - $tipo_habitacion</div>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>













