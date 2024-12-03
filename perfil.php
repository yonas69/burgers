<?php
session_start();
include('conexion.php');

// Verificar si hay una sesión activa
if (!isset($_SESSION['usuario'])) {
    header("Location: inisio.php");
    exit();
}

// Obtener los datos del usuario desde la base de datos
$usuario = $_SESSION['usuario'];
$query = "SELECT nombre, correo, telefono FROM usuarios WHERE nombre = '$usuario'";
$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $datosUsuario = mysqli_fetch_assoc($resultado);
} else {
    echo "Error al cargar la información del usuario.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - cecyBurgers</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            width: 100%;
            background-color: #ff9800;
            color: white;
            padding: 1em 0;
            text-align: center;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: #ff9800;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        .btn-1 {
            background-color: #ff9800;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .btn-1:hover {
            background-color: #e68900;
        }
        footer {
            margin-top: 20px;
            text-align: center;
        }
        footer a {
            color: #ff9800;
            text-decoration: none;
            font-weight: bold;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Perfil de Usuario</h1>
    </header>

    <section class="perfil-content container">
        <div class="perfil-info">
            <h2>Información del Usuario</h2>
            <form action="editar_perfil.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($datosUsuario['nombre']); ?>" required>

                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($datosUsuario['correo']); ?>" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($datosUsuario['telefono']); ?>" required>

                <button type="submit" class="btn-1">Guardar Cambios</button>
            </form>
        </div>
    </section>

    <footer>
        <a href="inicio.php">Volver al inicio</a>
    </footer>
</body>
</html>
