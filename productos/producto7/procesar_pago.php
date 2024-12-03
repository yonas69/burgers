<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sesion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos enviados por el formulario
$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$cardNumber = $data['cardNumber'];
$expirationDate = $data['expirationDate'];
$cvv = $data['cvv'];
$address = $data['address'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO pagos (name, card_number, expiration_date, cvv, address) 
        VALUES ('$name', '$cardNumber', '$expirationDate', '$cvv', '$address')";

if ($conn->query($sql) === TRUE) {
    // Si el pago fue exitoso, devolver una respuesta exitosa
    echo json_encode(['success' => true]);
} else {
    // Si hubo un error al insertar los datos
    echo json_encode(['success' => false]);
}

$conn->close();
?>
