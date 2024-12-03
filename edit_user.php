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

    // Consultar los datos del usuario
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        // Actualizar usuario en la base de datos
        $update_sql = "UPDATE usuarios SET nombre = ?, telefono = ?, correo = ?, contraseña = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssi", $nombre, $telefono, $correo, $password, $id);

        if ($update_stmt->execute()) {
            echo "Usuario actualizado con éxito.";
            header("Location: admin_users.php"); // Redirigir a la lista de usuarios
            exit();
        } else {
            echo "Error al actualizar usuario: " . $update_stmt->error;
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
    <title>Editar Usuario</title>
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
        }
        .form-container h2 {
            text-align: center;
            color: #003366;
        }
        .form-container label {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .form-container input[type="text"], .form-container input[type="email"], .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-container input[type="text"]:focus, .form-container input[type="email"]:focus, .form-container input[type="password"]:focus {
            border-color: #003366;
        }
        .form-container button {
            background-color: #003366;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
            transition: background-color 0.3s;
        }
        .form-container button:hover {
            background-color: #005599;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Editar Usuario</h2>
    <form action="edit_user.php?id=<?php echo $id; ?>" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" value="<?php echo $usuario['contraseña']; ?>" required>

        <button type="submit">Actualizar Usuario</button>
    </form>
</div>

</body>
</html>
