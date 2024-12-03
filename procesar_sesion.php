<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto si es necesario
$db_username = "root";     // Tu usuario de base de datos
$db_password = "";         // Tu contraseña de base de datos
$dbname = "sesion";        // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Iniciar sesión
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];  // Contraseña enviada por el usuario
    $admin_code = $_POST['admin_code'];

    // Consultar la base de datos para validar al administrador
    $sql = "SELECT * FROM admin WHERE username = ? AND admin_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $admin_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Verificar la contraseña directamente
        $admin = $result->fetch_assoc();
        if ($password === $admin['password']) {
            // Si las credenciales son correctas, iniciar la sesión
            $_SESSION['admin'] = $admin['username'];  // Guardar el nombre del administrador en la sesión

            // Redirigir a la página de administración
            header("Location: admin1.php");  // Cambié a admin1.php, ya que es más consistente con el flujo PHP
            exit; // Asegura que el código posterior no se ejecute
        } else {
            echo "<h1>Contraseña incorrecta. Por favor, inténtelo de nuevo.</h1>";
        }
    } else {
        echo "<h1>Usuario o código de administrador incorrectos.</h1>";
    }

    $stmt->close();
}

$conn->close();
?>
