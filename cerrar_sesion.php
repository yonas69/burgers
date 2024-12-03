<?php
session_start();
session_destroy();
header('Location: inisio.html'); // Redirige a la página principal
exit();
?>
