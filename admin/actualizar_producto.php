<?php
// Verificar si se recibieron los datos del producto actualizado
if(isset($_POST['id_producto'], $_POST['nombre'], $_POST['descripcion'], $_POST['fotos'], $_POST['precio'], $_POST['c_almacen'], $_POST['fabricante'], $_POST['origen'])) {
    // Obtener los datos del producto actualizado
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fotos = $_POST['fotos'];
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
    
    // Actualizar los datos del producto en la base de datos
    $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', fotos='$fotos', precio='$precio', c_almacen='$c_almacen', fabricante='$fabricante', origen='$origen' WHERE id_producto = '$id_producto'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Datos del producto con ID $id_producto actualizados exitosamente.";
        header("Location: ../admin/index_admin.php");        

    } else {
        echo "Error al actualizar los datos del producto: " . $conn->error;
    }
    
    // Cerrar conexión
    $conn->close();
} else {
    // Si no se recibieron todos los datos del producto actualizado, mostrar un mensaje de error
    echo "Error: No se recibieron todos los datos del producto actualizado.";
}
?>
