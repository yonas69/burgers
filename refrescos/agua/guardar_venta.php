<?php
header('Content-Type: application/json');

// Obtener los datos enviados desde el formulario en formato JSON
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si los datos fueron recibidos correctamente
if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Datos recibidos no válidos.']);
    exit;
}

// Conectar a la base de datos
$servername = "localhost"; // Cambia según tu configuración
$username = "root"; // Cambia según tu configuración
$password = ""; // Cambia según tu configuración
$dbname = "sesion";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Error de conexión: ' . $conn->connect_error]);
    exit;
}

// Preparar la consulta para insertar los datos
$stmt = $conn->prepare("INSERT INTO pagos (address, payment_method, card_number, exp_date, cvv, cardholder, tip, total_price, total_with_tip, delivery_time) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Asegúrate de que los valores son pasados correctamente a la consulta
$stmt->bind_param("ssssssssds", 
    $data['address'], 
    $data['paymentMethod'], 
    $data['cardNumber'], 
    $data['expDate'], 
    $data['cvv'], 
    $data['cardholder'], 
    $data['tip'], 
    $data['totalPrice'], 
    $data['totalWithTip'], 
    $data['deliveryTime']
);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error al guardar los datos: ' . $stmt->error]);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
