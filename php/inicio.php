<?php
// Iniciar la sesión
session_start();

// Verificar si se enviaron el correo electrónico y la contraseña
if(isset($_POST['correo']) && isset($_POST['contraseña'])) {
    // Conexión a la base de datos
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "final"; 

    // se hace la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recuperar correo electrónico y contraseña de la página de inicio
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta SQL para verificar la existencia del usuario
    $sql = "SELECT id_usuarios FROM usuarios WHERE correo = '$correo' AND contraseña = '$contraseña'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        // El usuario está registrado y las credenciales son válidas
        $row = $resultado->fetch_assoc();
        // Guardar el ID del usuario en la sesión
        $_SESSION['id_usuarios'] = $row['id_usuarios'];
        
        // Verificar si el correo del usuario es admin@correo.com
        if ($correo == 'admin@correo.com') {
            // Redireccionar al usuario a la página de administrador
            header("Location: ../admin/index_admin.php");
            exit();
        } else {
            // Redireccionar al usuario a la página de inicio
            header("Location: ../html/inicio.html");
            exit();
        }
    } else {
        // El usuario no está registrado o las credenciales son incorrectas
        echo "Correo electrónico o contraseña incorrectos";
    }

    // Cerrar conexión
    $conn->close();
} else {
    // Si no se enviaron el correo electrónico y la contraseña
    echo "Por favor, ingresa correo electrónico y contraseña.";
}
?>


