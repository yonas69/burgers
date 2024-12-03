<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .recover-container {
            width: 400px; 
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .g-recaptcha {
            margin: 15px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #34495e;
        }
        .result {
            text-align: center;
            margin-top: 15px;
            animation: fadeIn 1s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="recover-container">
        <h2>Recupera tu Contraseña</h2>
        <form action="" method="post"> 
            <label for="username">Nombre de Usuario:</label>
            <input type="text" name="username" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" required>
            
            <div class="g-recaptcha" data-sitekey="6LeoT2wqAAAAAFWMtB6JmVqOsGT4iv-MJFXXUAJ_"></div>
            
            <button type="submit">Recuperar Contraseña</button>
            
            <div class="sms-option">
            <p>¿Prefieres recuperar tu contraseña por SMS?</p>
            <a href="recuperacion_sms.php">Haz clic aquí</a>
        </div>
        </form>

        <?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require __DIR__ . '/PHPMailer/src/Exception.php';
        require __DIR__ . '/PHPMailer/src/PHPMailer.php';
        require __DIR__ . '/PHPMailer/src/SMTP.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $captcha = $_POST['g-recaptcha-response'];
            $secretKey = '6LeoT2wqAAAAAJJyfip1EjJ9qkTUerRKnHPn-Aj8';

            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
            $responseKeys = json_decode($response, true);

            if (empty($captcha) || intval($responseKeys["success"]) !== 1) {
                echo "<div class='result' style='color:red;'>Por favor completa el CAPTCHA correctamente.</div>";
            } else {
                $servername = "localhost"; 
                $dbname = "sesion";
                $dbusername = "root"; 
                $dbpassword = ""; 

                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conn->prepare("SELECT contraseña FROM usuarios WHERE nombre = :username");
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $password = $row['contraseña'];

                        
                        $mail = new PHPMailer(true);
                        try {
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'yonajaziespinosa@gmail.com'; 
                            $mail->Password = 'psfg wobh wymv zoqm'; 
                            $mail->SMTPSecure = 'tls';
                            $mail->Port = 587;

                           
                            $mail->setFrom('tu_correo@gmail.com', 'Nombre del remitente');
                            $mail->addAddress($email);


                            $mail->isHTML(true);
                            $mail->Subject = "Recuperación de Contraseña";
                            $mail->Body = "
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

                            $mail->send();
                            echo "<div class='result' style='color:green;'>Correo enviado con éxito a $email.</div>";
                        } catch (Exception $e) {
                            echo "<div class='result' style='color:red;'>Error al enviar el correo: {$mail->ErrorInfo}</div>";
                        }
                    } else {
                        echo "<div class='result' style='color:red;'>Usuario no encontrado.</div>";
                    }
                } catch (PDOException $e) {
                    echo "<div class='result' style='color:red;'>Error de conexión: " . $e->getMessage() . "</div>";
                }

                $conn = null; 
            }
        }
        ?>
    </div>
</body>
</html>
