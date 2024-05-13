<?php
// Verificar si se recibió el ID del producto a modificar
if(isset($_POST['id_producto'])) {
    // Obtener el ID del producto a modificar
    $id_producto = $_POST['id_producto'];
    
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "final";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Consulta SQL para obtener los datos del producto con el ID proporcionado
    $sql = "SELECT * FROM productos WHERE id_producto = $id_producto";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Mostrar el formulario para editar los datos del producto
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../fotos/disney_logo.png"/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../item_page/css/styles.css" rel="stylesheet"/>
            <title>Modificar Producto</title>
        </head>
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

h2 {
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

input[type="text"],
input[type="number"],
textarea {
    width: 50%;
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
    margin-top: 10px;
}

button[type="submit"]:hover {
    background-color: #666;
}

.btn-outline-dark {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 10px;
    color: #343a40;
    background-color: transparent;
    border: 1px solid #343a40;
    border-radius: 5px;
    text-decoration: none;
}

.btn-outline-dark:hover {
    background-color: #343a40;
    color: #fff;
}


        </style>
        <body>
            <h2>Modificar Producto</h2>
            <form action="actualizar_producto.php" method="POST">
                 <label for="nombre">Id_producto seleccionado:</label>
                <input type="text" name="id_producto" value="<?php echo $id_producto; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>"><br>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $row['descripcion']; ?></textarea><br>
                <label for="fotos">Fotos:</label>
                <input type="text" id="fotos" name="fotos" value="<?php echo $row['fotos']; ?>"><br>
                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio" value="<?php echo $row['precio']; ?>"><br>
                <label for="c_almacen">Cantidad en Almacén:</label>
                <input type="text" id="c_almacen" name="c_almacen" value="<?php echo $row['c_almacen']; ?>"><br>
                <label for="fabricante">Fabricante:</label>
                <input type="text" id="fabricante" name="fabricante" value="<?php echo $row['fabricante']; ?>"><br>
                <label for="origen">Origen:</label>
                <input type="text" id="origen" name="origen" value="<?php echo $row['origen']; ?>"><br>
                <button type="submit">Actualizar</button>
                <br><a href="../admin/index_admin.php" class="btn btn-outline-dark">Volver a la página principal del admin</a>

            </form>
        </body>
        </html>
        <?php
    } else {
        // Si no se encontró el producto con el ID proporcionado, mostrar un mensaje de error
        echo "No se encontró ningún producto con el ID $id_producto.";
    }
    
    // Cerrar conexión
    $conn->close();
} else {
    // Si no se recibió el ID del producto, mostrar un mensaje de error
    echo "Error: No se proporcionó el ID del producto.";
}
?>
