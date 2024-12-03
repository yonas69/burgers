<?php
// Iniciar sesión
session_start();

// Verificar si la sesión está activa
if (!isset($_SESSION['admin'])) {
    header("Location: admin.html");
    exit();
}

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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar si el usuario existe
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit();
    }

    // Si se ha confirmado la eliminación, proceder con el borrado
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
        // Eliminar el usuario
        $delete_sql = "DELETE FROM usuarios WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $id);

        if ($delete_stmt->execute()) {
            echo "<script>alert('Usuario borrado exitosamente.'); window.location.href='admin_users.php';</script>";
            exit();
        } else {
            echo "Error al eliminar el usuario: " . $delete_stmt->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }
        .form-container h2 {
            color: #003366;
        }
        .form-container p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .form-container button {
            background-color: #003366;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .form-container button:hover {
            background-color: #005599;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>¿Estás seguro de que deseas eliminar este usuario?</h2>
    <p><strong>Usuario:</strong> <?php echo $usuario['nombre']; ?></p>
    <form method="post">
        <button type="submit" name="confirm_delete" value="yes">Sí, eliminar usuario</button>
        <button type="button" onclick="window.history.back();">Cancelar</button>
    </form>
</div>

</body>
</html>

