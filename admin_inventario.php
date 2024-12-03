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

// Variables para mensajes
$success_message = '';
$error_message = '';

// Insertar un producto en el inventario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $proveedor = $_POST['proveedor'];
    $marca = $_POST['marca'];
    $codigo_producto = $_POST['codigo_producto'];

    $sql = "INSERT INTO inventario (producto, cantidad, precio, proveedor, marca, codigo_producto) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siisss", $producto, $cantidad, $precio, $proveedor, $marca, $codigo_producto);

    if ($stmt->execute()) {
        $success_message = "Producto agregado exitosamente.";
    } else {
        $error_message = "Error al agregar producto: " . $stmt->error;
    }

    $stmt->close();
}

// Realizar búsqueda si se proporcionó un término de búsqueda
$search_query = '';
if (isset($_POST['search'])) {
    $search_term = $_POST['search_term'];
    $search_query = "WHERE producto LIKE '%$search_term%' OR codigo_producto LIKE '%$search_term%'";
}

// Consultar los productos en el inventario
$sql = "SELECT * FROM inventario $search_query";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Inventario</title>
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
            max-width: 700px;
            margin: 0 auto;
            text-align: center;
        }
        .form-container h2 {
            color: #003366;
        }
        .form-container input, .form-container select {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }
        .form-container input:focus, .form-container select:focus {
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
            text-align: center;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Administrar Inventario</h2>

    <!-- Mensajes de éxito o error -->
    <?php if (isset($success_message)): ?>
        <div class="message"><?php echo $success_message; ?></div>
    <?php elseif (isset($error_message)): ?>
        <div class="message error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <!-- Formulario para agregar un nuevo producto -->
    <form method="POST" action="inventory.php">
        <input type="text" name="producto" placeholder="Nombre del Producto" required>
        <input type="number" name="cantidad" placeholder="Cantidad" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required>
        <input type="text" name="proveedor" placeholder="Proveedor" required>
        <input type="text" name="marca" placeholder="Marca" required>
        <input type="text" name="codigo_producto" placeholder="Código de Producto" required>
        <button type="submit" name="add_product">Agregar Producto</button>
    </form>

    <!-- Barra de búsqueda -->
    <h3>Buscar Producto</h3>
    <form method="POST" action="inventory.php">
        <input type="text" name="search_term" placeholder="Buscar por nombre o código" required>
        <button type="submit" name="search">Buscar</button>
    </form>

    <!-- Tabla con los productos -->
    <h3>Lista de Productos en Inventario</h3>
    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Proveedor</th>
            <th>Marca</th>
            <th>Código</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['producto']; ?></td>
                    <td><?php echo $row['cantidad']; ?></td>
                    <td><?php echo $row['precio']; ?></td>
                    <td><?php echo $row['proveedor']; ?></td>
                    <td><?php echo $row['marca']; ?></td>
                    <td><?php echo $row['codigo_producto']; ?></td>
                    <td>
                    <a href="edit_product.php?id=<?php echo $row['id']; ?>">Modificar</a> <!-- Enlace para modificar -->
                </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No hay productos en el inventario.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>
