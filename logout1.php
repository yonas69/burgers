<?php
// Iniciar sesión
session_start();

// Destruir la sesión
session_destroy();

// Redirigir al formulario de inicio de sesión
header("Location: admin.html");
exit();
?>
