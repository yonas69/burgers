<?php

session_start();

if (!defined('INCLUDE_CHECK')) {
    die("Acceso no permitido");
}


if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
    header("Location: admin.html");
    exit();
}

if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], 'admin.html') === false) {
    die("Acceso no permitido");
}

?>
