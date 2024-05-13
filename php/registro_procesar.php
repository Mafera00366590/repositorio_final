<?php
// Verificar si se enviaron todos los campos necesarios
if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contraseña']) && isset($_POST['fecha_nacimiento']) && isset($_POST['num_tarjeta']) && isset($_POST['direccion'])) {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $num_tarjeta = $_POST['num_tarjeta'];
    $direccion = $_POST['direccion'];

    // Conexión a la base de datos
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "final"; 

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para verificar si el usuario ya existe
    $sql_verificar = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado_verificar = $conn->query($sql_verificar);

    if ($resultado_verificar->num_rows > 0) {
        // El usuario ya está registrado
        // Redireccionar al usuario de vuelta a la página de registro con mensaje de error en la URL
        header("Location: registro.php?error=El+correo+electrónico+ya+está+registrado.");
        exit(); 
    } else {
        // El usuario no está registrado, proceder con el insert
        // Consulta SQL para insertar un nuevo usuario
        $sql_insertar = "INSERT INTO usuarios (id_usuarios,nombre, correo, contraseña, fecha_nacimiento, num_tarjeta, direecion) VALUES (NULL,'$nombre', '$correo', '$contraseña', '$fecha_nacimiento', '$num_tarjeta', '$direccion')";
        
        if ($conn->query($sql_insertar) === TRUE) {
            echo "Registro exitoso";
            // Redirigir a inicion de sesion
            header("Location: ../html/inicio_sesion.html");

        } else {
            echo "Error al registrar: " . $conn->error;
        }
    }

    // Cerrar conexión
    $conn->close();
} else {
    // Si no se enviaron todos los campos necesarios
    echo "Por favor, ingresa todos los campos requeridos.";
}
?>


