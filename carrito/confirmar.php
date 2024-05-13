<?php
// Iniciar la sesión
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "final");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}else
//echo "<h1>Se conecto a la base</h1> ";

// Verificar si el usuario ha iniciado sesión y tiene un ID de usuario en la sesión
if(isset($_SESSION['id_usuarios'])&& isset($_POST['continuar_compra'])) {
    // El usuario ha iniciado sesión, puedes usar $_SESSION['id_usuario'] para obtener su ID
    $id_usuario = $_SESSION['id_usuarios'];

    // Obtener el ID del producto que se va a agregar al carrito
    $id_producto = $_POST['id_producto'];


          $sql_agregar = "INSERT INTO historial_compras(id_compra, id_usuario, id_producto) VALUES (NULL,'$id_usuario','$id_producto')";

          if ($conexion->query($sql_agregar) === TRUE) {
              echo "Producto eliminado al carrito exitosamente.";
              header("Location: ../html/exito.html");          
            } else {
              echo "Error al eliminar producto del carrito: " . $conexion->error;
          } 

          $sql_borrar = "DELETE FROM carrito_compras WHERE id_usuario='$id_usuario'";

          if ($conexion->query($sql_borrar) === TRUE) {
            echo "Producto eliminado al carrito exitosamente.";
            header("Location:   ../html/exito.html");          
          } else {
            echo "Error al eliminar producto del carrito: " . $conexion->error;
         } 

         // Consulta SQL para obtener la información del producto
                $sql_PROD = "SELECT * FROM productos WHERE id_producto = $id_producto";

                // Ejecutar la consulta
                $result = $conexion->query($sql_PROD);

                // Mostrar los detalles del producto
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $c_alamacen=$row['c_almacen'];
                } else {
                    echo "No se encontró el producto.";
                }
         $c_alamacen=$c_alamacen-1;
         $sql_alterar = "UPDATE productos SET c_almacen = '$c_alamacen' WHERE productos.id_producto = '$id_producto'";
          
          if ($conexion->query($sql_alterar) === TRUE) {
            echo "Producto alterado en almacen.";
            header("Location:   ../html/exito.html");          
          } else {
            echo "Error al eliminar producto del almacen: " . $conexion->error;
        } 


} else {
    // El usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: ../html/exito.html");
    exit();
}

// Cerrar la conexión
$conexion->close();

?>