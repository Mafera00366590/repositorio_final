<?php
// Iniciar la sesión
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "final");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el id_producto de la URL
if(isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];

    // Consulta SQL para obtener la información del producto
    $sql_PROD = "SELECT * FROM productos WHERE id_producto = $id_producto";

    // Ejecutar la consulta
    $result = $conexion->query($sql_PROD);

    // Mostrar los detalles del producto
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $fotos = $row['fotos'];
        $c_almacen=$row['c_almacen'];

    } else {
        echo "No se encontró el producto.";
    }
} else {
    echo "El id_producto no fue proporcionado en la URL.";
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Shop Item</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../fotos/disney_logo.png"/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
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
                        <a class="nav-link" href="../shop_homepage/index.php"
                         aria-expanded="false">Tienda</a>
                    </li>
            </ul>
            <form class="d-flex" action="../html/inicio_sesion.html">
                        <button class="btn btn-outline-dark" type="submit">
                            Cerrar sesion
                            <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
                        </button>
                    </form>
            <form class="d-flex" action="../carrito/prueba.php">
                <a href="prueba.php" class="btn btn-outline-dark flex-shrink-0">
                    Carrito
                    <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
                </a>
            </form>
        </div>
    </div>
</nav>
<div class="container px-4 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="../fotos/<?php echo $fotos; ?>"
                                   alt="<?php echo $nombre; ?>"/></div>
        <div class="col-md-6">
            <h1 class="display-5 fw-bolder"><?php echo $nombre; ?></h1>
            <div class="fs-5 mb-5">
                <span>&#36;<?php echo $precio; ?></span>
            </div>
            <div class="fs-5 mb-5">
                <span><?php echo $c_almacen; ?></span>
            </div>
            <p class="lead"><?php echo $descripcion; ?></p>
            <form method="post" action="../carrito/agregar.php">
                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="agregar_al_carrito">
                    <i class="bi-cart-fill me-1"></i>
                    Agregar a carrito
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
// Cerrar la conexión
$conexion->close();
?>