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

// Obtener ID del producto a modificar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM inventario WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit();
    }
    $stmt->close();
}

// Actualizar el producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $proveedor = $_POST['proveedor'];
    $marca = $_POST['marca'];
    $codigo_producto = $_POST['codigo_producto'];

    $sql = "UPDATE inventario SET producto = ?, cantidad = ?, precio = ?, proveedor = ?, marca = ?, codigo_producto = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siisssi", $producto, $cantidad, $precio, $proveedor, $marca, $codigo_producto, $id);

    if ($stmt->execute()) {
        echo "Producto actualizado exitosamente.";
        header("Location: inventory.php"); // Redirigir a la página de inventario
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 30px auto;
            text-align: center;
        }

        .form-container h2 {
            color: #003366;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .form-container input,
        .form-container select {
            margin-bottom: 15px;
            padding: 12px;
            font-size: 16px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-container input:focus,
        .form-container select:focus {
            border-color: #003366;
        }

        .form-container button {
            background-color: #003366;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #005599;
        }

        .message {
            margin-top: 20px;
            padding: 12px;
            border-radius: 8px;
            background-color: #dff0d8;
            color: #3c763d;
            font-size: 16px;
        }

        .error-message {
            background-color: #f2dede;
            color: #a94442;
        }

        .form-container .back-link {
            margin-top: 20px;
            display: block;
            color: #003366;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
        }

        .form-container .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Modificar Producto</h2>

    <!-- Mensajes de éxito o error -->
    <?php if (isset($success_message)): ?>
        <div class="message"><?php echo $success_message; ?></div>
    <?php elseif (isset($error_message)): ?>
        <div class="message error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="edit_product.php?id=<?php echo $product['id']; ?>">
        <input type="text" name="producto" value="<?php echo $product['producto']; ?>" placeholder="Nombre del Producto" required>
        <input type="number" name="cantidad" value="<?php echo $product['cantidad']; ?>" placeholder="Cantidad" required>
        <input type="number" step="0.01" name="precio" value="<?php echo $product['precio']; ?>" placeholder="Precio" required>
        <input type="text" name="proveedor" value="<?php echo $product['proveedor']; ?>" placeholder="Proveedor" required>
        <input type="text" name="marca" value="<?php echo $product['marca']; ?>" placeholder="Marca" required>
        <input type="text" name="codigo_producto" value="<?php echo $product['codigo_producto']; ?>" placeholder="Código de Producto" required>
        <button type="submit">Actualizar Producto</button>
    </form>

    <a href="admin_inventario.php" class="back-link">Volver al Inventario</a>
</div>

</body>
</html>
