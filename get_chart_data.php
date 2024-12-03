<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "sesion";
$coneccion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $labels = [];
    $values = [];

    switch ($type) {
        case 'usuarios':
            $labels = ['Registrados', 'Inactivos']; // Ejemplo
            $values = [10, 2]; // Sustituye con datos reales
            break;
        case 'inventario':
            $labels = ['Disponibles', 'Agotados'];
            $values = [20, 5];
            break;
        case 'ventas':
            $labels = ['Completadas', 'Pendientes'];
            $values = [15, 3];
            break;
    }

    echo json_encode(['labels' => $labels, 'values' => $values]);
}
?>
