<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empleados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
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
        select,
        input[type="date"] {
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

        .tabla {
            margin-top: 20px;
            text-align: center;
        }

        .tabla h2 {
            margin-bottom: 10px;
        }

        .tabla a {
            display: inline-block;
            padding: 8px 15px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .tabla a:hover {
            background-color: #218838;
        }
        </style>
</head>

<body>
    <div class="container">
        <h1>Registro de Empleados</h1>
        <form method="post" action="insertar_empleado.php" onsubmit="return validarCampos()">
            <div class="form-group">
                <label for="nombre">Nombre Empleado:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" required>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" required>
            </div>
            <div class="form-group">
                <label for="puesto">Seleccione su puesto:</label>
                <select id="puesto" name="puesto" required>
                    <option value="Gerente">Gerente</option>
                    <option value="Supervisor">Supervisor</option>
                    <option value="Recepcionista">Recepcionista</option>
                    <option value="Limpieza">Personal de Limpieza</option>
                    <option value="Cocinero">Cocinero</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_contratacion">Fecha de Contratación:</label>
                <input type="date" id="fecha_contratacion" name="fecha_contratacion" required>
            </div>
            <button type="submit" name="registrar">Registrar empleado</button>
        </form>
        
        <div class="tabla">
            <h2>Registros de empleados</h2>
            <a href="tabla_registros_empleados.php">Ver registros de empleados</a>
        </div>
    </div>

    <script>
        function validarCampos() {
            var nombreInput = document.getElementById('nombre').value.trim();
            var apellidoPaternoInput = document.getElementById('apellido_paterno').value.trim();
            var apellidoMaternoInput = document.getElementById('apellido_materno').value.trim();
            
            // Expresión regular que valida uno o dos nombres sin símbolos ni nombres incompletos con la primera letra en mayúscula y al menos tres letras en cada parte
            var regex = /^[A-Z][a-zA-Z]{2,}(?:\s+[A-Z][a-zA-Z]{2,})?$/;
            // Expresión regular que valida apellidos con al menos cinco letras y la primera letra en mayúscula
            var apellidoRegex = /^[A-Z][a-zA-Z]{4,}$/;
            
            if (!regex.test(nombreInput) || !apellidoRegex.test(apellidoPaternoInput) || !apellidoRegex.test(apellidoMaternoInput)) {
                alert('Por favor, ingrese nombres y apellidos válidos con la primera letra en mayúscula y al menos cinco letras en cada parte.');
                return false;
            }
            
            return true;
        }
    </script>
</body>

</html>