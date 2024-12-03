<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];


    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = '6LeoT2wqAAAAAJJyfip1EjJ9qkTUerRKnHPn-Aj8'; 
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo "Por favor completa el CAPTCHA.";
        exit;
    }

    $servername = "localhost"; 
    $dbname = "sesion";
    $dbusername = "root"; 
    $dbpassword = ""; 

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $password = $row['password'];

            $to = "usuario@example.com"; 
            $subject = "Recuperación de Contraseña";
            $message = "
            <html>
            <head>
                <title>Recuperación de Contraseña</title>
            </head>
            <body>
                <h2>Hola $username,</h2>
                <p>Hemos recibido una solicitud para recuperar tu contraseña.</p>
                <p><strong>Tu contraseña es:</strong> <code>$password</code></p>
                <p>Si no solicitaste este correo, por favor ignóralo.</p>
                <p>Gracias,<br>El equipo de soporte.</p>
            </body>
            </html>
            ";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: tu_correo@gmail.com" . "\r\n"; 

            // Envío del correo
            if (mail($to, $subject, $message, $headers)) {
                echo "Correo enviado con éxito a $to.";
            } else {
                echo "Error al enviar el correo.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }

    $conn = null; // Cierra la conexión
} else {
    echo "Método de solicitud no válido.";
}
?>


