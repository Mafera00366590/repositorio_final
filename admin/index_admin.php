<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <!-- Favicon-->
      <link rel="icon" type="image/x-icon" href="../fotos/disney_logo.png" />
    <title>Panel de Administrador</title>
    <a href="../html/inicio_sesion.html" class="btn btn-outline-dark">Cerrar sesion</a>
    <link href="../item_page/css/styles.css" rel="stylesheet"/>

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    color: #333;
    text-align: center;
}

form {
    margin-bottom: 20px;
    text-align: center;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"], input[type="number"], select {
    width: 50%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    margin: 0 auto; 
    display: block; 
}

button[type="submit"] {
    padding: 10px 20px;
    background-color: #ff2aaa;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #666;
}

.btn-secondary {
    background-color: #6c757d;
    color: #fff;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

    </style>
</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION['id_usuarios']) && $_SESSION['id_usuarios'] == '1') {
        echo "<h2>Bienvenido Admin</h2>";
    }
    ?>
    <h1>Panel de Administrador</h1>
    
    <?php if(isset($_SESSION['id_usuarios']) && $_SESSION['id_usuarios'] == '1'): ?>
        <div>
            <h2>Consultar Historial de Compras</h2>
            <form action="consultar_compras.php" method="POST">
                <label for="id_usuario">Usuario:</label>
                <input type="number" id="id_usuario" name="id_usuario">
                <button type="submit">Consultar</button>
            </form>
        </div>

        <div>
            <h2>Alta o Baja de Producto</h2>
            <form action="alta_baja_producto.php" method="POST">
                <button type="submit">Accede a formulario</button>
            </form>
        </div>

        <div>
            <h2>Modificar Producto</h2>
            <form action="modificar_producto.php" method="POST">
                <label for="id_producto">ID del Producto:</label>
                <input type="text" id="id_producto" name="id_producto">
                <button type="submit">Modificar</button>
            </form>
        </div>
        <div>
            <h2>Checar datos tablas </h2>
            <form action="tablas.php" method="POST">
                <button type="submit">Ver tablas</button>
            </form>
        </div>
    <?php else: ?>
    <?php endif; ?>
</body>
</html>
