<?php
// Verificar si se recibió el ID del producto a dar de baja
if(isset($_POST['id_producto'])) {
    // Obtener el ID del producto a dar de baja
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
    
    
    // Consulta SQL para dar de baja un producto 
    $sql = "DELETE FROM productos WHERE id_producto='$id_producto';    ";
    
    if ($conn->query($sql) === TRUE) {
        echo "Producto con ID $id_producto dado de baja exitosamente.";
        header("Location: ../admin/alta_baja_producto.php");   
    } else {
        echo "Error al dar de baja el producto: " . $conn->error;
    }
    
    // Cerrar conexión
    $conn->close();
} else {
    // Si no se recibió el ID del producto, mostrar un mensaje de error
    echo "Error: No se proporcionó el ID del producto.";
}
?>
