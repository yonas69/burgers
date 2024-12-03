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

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, contraseña, telefono, correo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $contraseña, $telefono, $correo);

    if ($stmt->execute()) {
        $success_message = "Usuario agregado exitosamente.";
    } else {
        $error_message = "Error al agregar el usuario: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
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
        .form-container input {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }
        .form-container input:focus {
            border-color: #003366;
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
        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error-message {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Agregar Usuario</h2>
    
    <?php if (isset($success_message)): ?>
        <div class="message"><?php echo $success_message; ?></div>
    <?php elseif (isset($error_message)): ?>
        <div class="message error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="add_user.php">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="password" name="contraseña" placeholder="Contraseña" required>
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <input type="email" name="correo" placeholder="Correo" required>
        <button type="submit">Agregar Usuario</button>
    </form>
</div>

</body>
</html>
