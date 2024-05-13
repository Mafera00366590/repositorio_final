<?php
// Verificar si se recibieron los datos del nuevo producto
if(isset($_POST['nombre'], $_POST['descripcion'], $_FILES['fotos']['name'], $_POST['precio'], $_POST['c_almacen'], $_POST['fabricante'], $_POST['origen'])) {
    // Obtener los datos del nuevo producto
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fotos = $_FILES['fotos']['name']; // Nombre del archivo de la foto
    $precio = $_POST['precio'];
    $c_almacen = $_POST['c_almacen'];
    $fabricante = $_POST['fabricante'];
    $origen = $_POST['origen'];
    
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
    
    //obtener el archivo de fotos desde el path obtenido por el usuario    
    $carpeta_destino = "fotos/";
    $ruta_foto = $carpeta_destino . basename($_FILES['fotos']['name']);
    move_uploaded_file($_FILES['fotos']['tmp_name'], $ruta_foto);
    
    //querry de insert a la tabla     
    $sql = "INSERT INTO productos (id_producto,nombre, descripcion, fotos, precio, c_almacen, fabricante, origen) 
            VALUES (NULL,'$nombre', '$descripcion', '$fotos', '$precio', '$c_almacen', '$fabricante', '$origen')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Producto '$nombre' dado de alta exitosamente.";
        header("Location: ../admin/tablas.php");        
    } else {
        echo "Error al dar de alta el producto: " . $conn->error;
    }
    
    // Cerrar conexión
    $conn->close();
} else {
    // Si no se recibieron todos los datos del nuevo producto, mostrar un mensaje de error
    echo "Error: No se recibieron todos los datos del nuevo producto.";
}
?>
