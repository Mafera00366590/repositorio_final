<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Registrate</title>
      <!-- Favicon-->
      <link rel="icon" type="image/x-icon" href="../fotos/disney_logo.png" />
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    padding: 20px;
    margin: 0;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #ff2aaa;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #494547;
}

.error-message {
    color: red;
}

    </style>
</head>
<body>
    <h1>Registro de usuario</h1>

    <!-- Mostrar mensaje de error si está presente en la URL -->
    <?php
    if(isset($_GET['error'])) {
        $error_message = $_GET['error'];
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

<form action="registro_procesar.php" method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" required><br>

    <label for="correo">Correo electrónico:</label><br>
    <input type="email" id="correo" name="correo" required><br>

    <label for="contraseña">Contraseña:</label><br>
    <input type="password" id="contraseña" name="contraseña" required><br>

    <label for="fecha_nacimiento">Fecha de Nacimiento:</label><br>
    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br>

    <label for="num_tarjeta">Número de Tarjeta:</label><br>
    <input type="text" id="num_tarjeta" name="num_tarjeta" required><br>

    <label for="direccion">Dirección:</label><br>
    <input type="text" id="direccion" name="direccion" required><br>

    <input type="submit" value="Registrar">
</form>

</body>
</html>

