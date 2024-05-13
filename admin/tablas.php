<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <!-- Favicon-->
      <link rel="icon" type="image/x-icon" href="../fotos/disney_logo.png" />
      <link href="../item_page/css/styles.css" rel="stylesheet"/>

    <title>Tablas de la Base de Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tablas de la Base de Datos</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <button  class="btn btn-outline-dark">Ver tablas</button>
            <br>
            <a href="../admin/index_admin.php" class="btn btn-outline-dark">Volver a la página principal del admin</a>

        </form>
        <?php
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

        // Consulta SQL para obtener todas las tablas de la base de datos
        $sql = "SHOW TABLES";
        $result = $conn->query($sql);

        // Verificar si se hizo clic en el botón "Ver tablas"
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($result->num_rows > 0) {
                // Mostrar los resultados de todas las tablas
                while ($row = $result->fetch_assoc()) {
                    echo "<h3>Tabla: " . $row["Tables_in_" . $dbname] . "</h3>";
                    // Consulta SQL para obtener los datos de cada tabla
                    $table_name = $row["Tables_in_" . $dbname];
                    $table_data_sql = "SELECT * FROM $table_name";
                    $table_data_result = $conn->query($table_data_sql);
                    if ($table_data_result->num_rows > 0) {
                        // Mostrar los datos de la tabla en una tabla HTML
                        echo "<table>";
                        // Mostrar cabecera de la tabla
                        echo "<tr>";
                        while ($table_header = $table_data_result->fetch_field()) {
                            echo "<th>" . $table_header->name . "</th>";
                        }
                        echo "</tr>";
                        // Mostrar datos de la tabla
                        while ($table_row = $table_data_result->fetch_assoc()) {
                            echo "<tr>";
                            foreach ($table_row as $value) {
                                echo "<td>" . $value . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No hay datos en la tabla " . $table_name;
                    }
                }
            } else {
                echo "No se encontraron tablas en la base de datos.";
            }
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </div>
</body>
</html>
