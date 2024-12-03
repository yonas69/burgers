<?php
// Iniciar sesión
session_start();

// Verificar si la sesión está activa
if (!isset($_SESSION['admin'])) {
    // Si no hay sesión activa, redirigir al formulario de inicio de sesión
    header("Location: admin.html");
    exit();
}

// Configuración de la base de datos
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "sesion";  // Asegúrate de que el nombre de la base de datos sea correcto

// Crear conexión
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los usuarios de la base de datos
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            font-size: 24px;
            color: #003366;
        }
        .button {
            background-color: #003366;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #005599;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Administrar Usuarios</h1>
    <a href="admin1.php" class="button">Volver al Dashboard</a>
</div>

<a href="add_user.php" class="button">Agregar Usuario</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        // Mostrar los usuarios
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            echo "<td>" . $row["correo"] . "</td>";
            echo "<td><a href='edit_user.php?id=" . $row["id"] . "' class='button'>Editar</a> 
                  <a href='delete_user.php?id=" . $row["id"] . "' class='button'>Eliminar</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No hay usuarios registrados.</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
$conn->close();
?>
