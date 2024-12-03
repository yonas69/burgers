<?php
$servername = "localhost";  // O tu servidor
$username = "root";         // Tu usuario de base de datos
$password = "";             // Tu contraseña de base de datos
$dbname = "sesion";         // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
