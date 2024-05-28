<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .detalle-reserva {
            border-top: 2px solid #ccc;
            padding-top: 20px;
        }

        .detalle-reserva p {
            margin: 10px 0;
            font-size: 16px;
            color: #555;
        }

        .botones {
            text-align: center;
            margin-top: 30px;
        }

        .botones button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .botones button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles de la Reserva</h1>
        <form action="guardar_reserva.php" method="post"> <!-- Este es tu formulario -->
            <div class="detalle-reserva">
                <?php
                // Obtener los datos del formulario
                $nombre = $_POST['nombre'];
                $apellido_paterno = $_POST['apellido_paterno'];
                $apellido_materno = $_POST['apellido_materno'];
                $num = $_POST['num'];
                $fecha_entrada = $_POST['fecha_entrada'];
                $fecha_salida = $_POST['fecha_salida'];
                $num_personas = $_POST['num_personas'];
                $tipo_habitacion = $_POST['tipo_habitacion'];
                $num_habitacion = $_POST['num_habitacion'];

                // Mostrar los datos de la reserva
                echo "<p><strong>Nombre:</strong> $nombre</p>";
                echo "<p><strong>Apellido Paterno:</strong> $apellido_paterno</p>";
                echo "<p><strong>Apellido Materno:</strong> $apellido_materno</p>";
                echo "<p><strong>Número Telefónico:</strong> $num</p>";
                echo "<p><strong>Fecha de Entrada:</strong> $fecha_entrada</p>";
                echo "<p><strong>Fecha de Salida:</strong> $fecha_salida</p>";
                echo "<p><strong>Número de Personas:</strong> $num_personas</p>";
                echo "<p><strong>Tipo de Habitación:</strong> $tipo_habitacion</p>";
                echo "<p><strong>Número de Habitación:</strong> $num_habitacion</p>";
                ?>
            </div>
            <div class="botones">
                <!-- Botón para editar la reserva -->
                <button type="button" onclick="editarReserva()">Editar</button>
                <!-- Botón para enviar la reserva -->
                <button type="submit" name="enviar">Enviar Reserva</button> <!-- Cambiado a type="submit" -->
            </div>
        </form>
    </div>

    <script>
        function editarReserva() {
            // Obtener los datos de la reserva
            var nombre = "<?php echo $nombre; ?>";
            var apellido_paterno = "<?php echo $apellido_paterno; ?>";
            var apellido_materno = "<?php echo $apellido_materno; ?>";
            var num = "<?php echo $num; ?>";
            var fecha_entrada = "<?php echo $fecha_entrada; ?>";
            var fecha_salida = "<?php echo $fecha_salida; ?>";
            var num_personas = "<?php echo $num_personas; ?>";
            var tipo_habitacion = "<?php echo $tipo_habitacion; ?>";
            var num_habitacion = "<?php echo $num_habitacion; ?>";

            // Construir la URL con los datos de la reserva como parámetros
            var url = "formulario_reserva.php?";
            url += "nombre=" + encodeURIComponent(nombre) + "&";
            url += "apellido_paterno=" + encodeURIComponent(apellido_paterno) + "&";
            url += "apellido_materno=" + encodeURIComponent(apellido_materno) + "&";
            url += "num=" + encodeURIComponent(num) + "&";
            url += "fecha_entrada=" + encodeURIComponent(fecha_entrada) + "&";
            url += "fecha_salida=" + encodeURIComponent(fecha_salida) + "&";
            url += "num_personas=" + encodeURIComponent(num_personas) + "&";
            url += "tipo_habitacion=" + encodeURIComponent(tipo_habitacion) + "&";
            url += "num_habitacion=" + encodeURIComponent(num_habitacion);

            // Redireccionar al formulario de reserva con los datos de la reserva en la URL
            window.location.href = url;
        }
    </script>
</body>
</html>





