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
$dbname = "sesion";  // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$success_message = '';
$error_message = '';

// Registrar la venta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_sale'])) {
    $producto = $_POST['producto'];
    $cantidad_vendida = $_POST['cantidad_vendida'];
    $total_venta = $_POST['total_venta'];

    // Verificar si hay suficiente stock
    $sql = "SELECT cantidad FROM inventario WHERE producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $producto);
    $stmt->execute();
    $stmt->bind_result($cantidad);
    $stmt->fetch();
    $stmt->close();

    if ($cantidad >= $cantidad_vendida) {
        // Actualizar inventario
        $sql = "UPDATE inventario SET cantidad = cantidad - ? WHERE producto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $cantidad_vendida, $producto);
        $stmt->execute();
        $stmt->close();

        // Registrar la venta
        $sql = "INSERT INTO ventas (producto, cantidad_vendida, total_venta) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $producto, $cantidad_vendida, $total_venta);

        if ($stmt->execute()) {
            $success_message = "Venta registrada exitosamente.";
        } else {
            $error_message = "Error al registrar la venta: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error_message = "No hay suficiente stock para realizar esta venta.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta</title>
    <style>
        /* Estilos básicos */
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
    <h2>Registrar Venta</h2>

    <?php if (isset($success_message)): ?>
        <div class="message"><?php echo $success_message; ?></div>
    <?php elseif (isset($error_message)): ?>
        <div class="message error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="sales.php">
        <input type="text" name="producto" placeholder="Producto" required>
        <input type="number" name="cantidad_vendida" placeholder="Cantidad Vendida" required>
        <input type="number" step="0.01" name="total_venta" placeholder="Total de la Venta" required>
        <button type="submit" name="register_sale">Registrar Venta</button>
    </form>
</div>

</body>
</html>
