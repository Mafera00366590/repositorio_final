<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Alta o baja de productos</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../fotos/disney_logo.png"/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
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
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Alta o Baja de Producto</h1>

        <div>
            <h2>Dar de Baja Producto</h2>
            <form action="dar_de_baja.php" method="POST">
                <label for="id_producto">ID del Producto a Dar de Baja:</label>
                <input type="text" id="id_producto" name="id_producto" required>
                <button type="submit">Dar de Baja</button>
            </form>
        </div>

        <div>
            <h2>Alta de Producto</h2>
            <form action="dar_de_alta.php" method="POST" enctype="multipart/form-data">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" required>
                <label for="fotos">Foto del Producto:</label>
                <input type="file" id="fotos" name="fotos" required>
                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio" required>
                <label for="c_almacen">Cantidad en Almacén:</label>
                <input type="text" id="c_almacen" name="c_almacen" required>
                <label for="fabricante">Fabricante:</label>
                <input type="text" id="fabricante" name="fabricante" required>
                <label for="origen">Origen:</label>
                <input type="text" id="origen" name="origen" required>
                <button type="submit">Dar de Alta</button>
            </form>
        </div>
        <a href="../admin/index_admin.php" class="btn btn-outline-dark">Volver a la página principal del admin</a>

    </div>
</body>
</html>
