<?php

// Verificar si el usuario ha iniciado sesión y tiene un ID de usuario en la sesión
if(isset($_POST['id_usuario'])) {
    // El usuario ha iniciado sesión, puedes usar $_SESSION['id_usuario'] para obtener su ID
    $id_usuario = $_POST['id_usuario'];
} 
 
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "final");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener los productos en el carrito del usuario actual
$sql = "SELECT productos.*, historial_compras.* FROM historial_compras 
        INNER JOIN productos ON historial_compras.id_producto = productos.id_producto 
        WHERE historial_compras.id_usuario = $id_usuario";
// Ejecutar la consulta
$result = $conexion->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Consultar de Compras</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../fotos/disney_logo.png"/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../item_page/css/styles.css" rel="stylesheet"/>
</head>
<body>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Verificar si hay productos en el carrito
            if ($result->num_rows > 0) {
                echo "<h2>Historial de compras de $id_usuario</h2>";

                // Iterar sobre los productos en el carrito y mostrarlos en la tabla
                while($row = $result->fetch_assoc()) {
                    $nombre_producto = $row['nombre'];
                    $precio_producto = $row['precio'];
                    $imagen_producto = $row['fotos'];
                    $id_producto=$row['id_producto'];

                    // Mostrar cada producto en una fila de la tabla
                    ?>
                    <tr>
                        <td><img src="../fotos/<?php echo $imagen_producto; ?>" alt="Imagen del producto" style="max-width: 100px;"></td>
                        <td><?php echo $nombre_producto; ?></td>
                        <td><span>&#36;<?php echo $precio_producto; ?></span></td>
                    </tr>
                    <?php
                }
            } else {
                // No hay productos en el carrito
                echo "<tr><td colspan='4'>No hay productos en el carrito</td></tr>";
            }
            // Cerrar la conexión
            $conexion->close();
            ?>
            </tbody>
        </table>
    </div>
</div>
<a href="../admin/index_admin.php" class="btn btn-outline-dark">Volver a la página principal del admin</a>

</body>
</html>

