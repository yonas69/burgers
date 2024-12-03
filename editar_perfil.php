<?php
session_start();
include('conexion.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: inisio.php");
    exit();
}

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

// Actualizar los datos del usuario en la base de datos
$query = "UPDATE usuarios SET nombre='$nombre', correo='$correo', telefono='$telefono' WHERE nombre = '".$_SESSION['usuario']."'";
if (mysqli_query($conexion, $query)) {
    $_SESSION['usuario'] = $nombre; // Actualiza la sesión con el nuevo nombre de usuario
    header("Location: perfil.php?actualizacion=success");
} else {
    echo "Error al actualizar los datos";
}
?>
