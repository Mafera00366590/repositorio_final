<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión y tiene un ID de usuario en la sesión
if(isset($_SESSION['id_usuarios'])) {
    // El usuario ha iniciado sesión, puedes usar $_SESSION['id_usuario'] para obtener su ID
    $id_usuario = $_SESSION['id_usuarios'];
} else {
    // El usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: ../html/inicio_de_sesion.html");
    exit();
}
 
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "final");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener los productos en el carrito del usuario actual
$sql = "SELECT productos.*, carrito_compras.* FROM carrito_compras 
        INNER JOIN productos ON carrito_compras.id_prod = productos.id_producto 
        WHERE carrito_compras.id_usuario = $id_usuario";
// Ejecutar la consulta
$result = $conexion->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Carrito de Compras</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../fotos/disney_logo.png"/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../item_page/css/styles.css" rel="stylesheet"/>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="../shop_homepage/index.php">Disney Pins</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page"
                                        href="../html/inicio.html">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="../html/nosotro.html">Acerca de nosotros</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link" id="navbarDropdown" href="../shop_homepage/index.php"
                       role="button"  aria-expanded="false">Tienda</a>
                </li>
            </ul>
            <form class="d-flex" action="../html/inicio_sesion.html">
                        <button class="btn btn-outline-dark" type="submit">
                            Cerrar sesion
                            <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
                        </button>
                    </form>
            <form class="d-flex" action="prueba.php">
                <a href="prueba.php" class="btn btn-outline-dark flex-shrink-0">
                    Carrito
                    <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
                </a>
            </form>
        </div>
    </div>
</nav>
<div class="container px-4 px-lg-5 my-5">
    <h1 class="display-5 fw-bolder">Carrito de Compras</h1>
    <div class="table-responsive">
    <table class="table table-bordered">
            <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Verificar si hay productos en el carrito
            if ($result->num_rows > 0) {
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
                        <td>
                            <form method="post" action="./eliminar.php">
                                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                                <button class="btn btn-outline-danger" type="submit" name="eliminar_carrito" >Eliminar</button>
                            </form>
                        </td>
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
        <form method="post" action="./vaciar.php">
                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                <button class="btn btn-outline-danger" type="submit" name="vaciar_carrito" >Vaciar carrito</button>
        </form>
        <br>
        <form method="post" action="./confirmar.php">
                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                <button type="submit" name="continuar_compra" class="btn btn-success">Confirmar orden</button>
            </form>
    </div>
</div>
</body>
</html>
