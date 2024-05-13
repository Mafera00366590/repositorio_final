<?php
// Iniciar la sesión
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "final");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}else

// Verificar si el usuario ha iniciado sesión y tiene un ID de usuario en la sesión
if(isset($_SESSION['id_usuarios'])&& isset($_POST['eliminar_carrito'])) {
    // El usuario ha iniciado sesión, puedes usar $_SESSION['id_usuario'] para obtener su ID
    $id_usuario = $_SESSION['id_usuarios'];

    // Obtener el ID del producto que se va a agregar al carrito
    $id_producto = $_POST['id_producto'];


        //querry para borrar
          $sql = "DELETE FROM carrito_compras WHERE id_prod='$id_producto'";

          if ($conexion->query($sql) === TRUE) {
              echo "Producto eliminado al carrito exitosamente.";
              header("Location: ../carrito/prueba.php");          
            } else {
              echo "Error al eliminar producto del carrito: " . $conexion->error;
          } 
} else {
    // El usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: ../html/inicio_de_sesion.html");
    exit();
}

// Cerrar la conexión
$conexion->close();

?>