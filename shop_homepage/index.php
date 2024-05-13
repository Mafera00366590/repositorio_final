<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tienda de pines</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../fotos/disney_logo.png" />
    <!-- Bootstrap icons-->
    <link href="../fotos/disney_logo.png" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../html/inicio.html">Disney Pins</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../html/inicio.html">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="../html/nosotro.html">Acerca de nosotros</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="../shop_homepage/index.php"
                             aria-expanded="false">Tienda</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="../html/inicio_sesion.html">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cerrar sesion
                            <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
                        </button>
                    </form>
                    <form class="d-flex" action="../carrito/prueba.php">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Carrito
                            <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    <!-- Header-->
    <header class="bg-dark py-5" style="background-image: url('../fotos/fon.png'); background-size: cover; background-position: center;">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Pines disney</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Compra tus pines originales y arma tu coleccion</p>
                </div>
            </div>
        </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                // Establecer conexión a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "final";

                // Crear conexión
                $conn = new mysqli($servername, $username, $password, $database);

                // Verificar conexión
                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }

                // Realizar consulta SQL para obtener productos
                $sql = "SELECT * FROM productos";
                $result = $conn->query($sql);

                //  Mostrar los productos dinámicamente
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="col mb-5">';
                        echo '<div class="card h-100">';
                        echo '<img class="card-img-top" src="../fotos/'.$row["fotos"].'" alt="..." />';
                        echo '<div class="card-body p-4">';
                        echo '<div class="text-center">';
                        echo '<h5 class="fw-bolder">'.$row["nombre"].'</h5>';
                        echo '$'.$row["precio"];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">';
                        echo '<div class="text-center">';
                        echo '<a class="btn btn-outline-dark mt-auto" href="../item_page/index.php?id_producto='.$row["id_producto"].'">Ver producto</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "No hay productos disponibles.";
                }

                //Cerrar conexión
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
</body>
</html>
