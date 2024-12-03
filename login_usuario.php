<?php
session_start();
include 'conexion.php';

$nombre = $_POST['nombre'];
$contraseña = $_POST['contraseña'];

// Consulta preparada para evitar inyección SQL
$sql = "SELECT id, nombre, contraseña, correo FROM usuarios WHERE nombre = ?";
$stmt = $coneccion->prepare($sql);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // Verificar la contraseña
    if (password_verify($contraseña, $usuario['contraseña'])) {
        $_SESSION['usuario'] = $usuario['nombre'];
        header("location:inicio.html");
        exit;
    } else {
        registrarIntentoFallido($usuario['correo']); // Registra el intento fallido
        verificarIntentosFallidos($usuario['correo']); // Verifica si debe enviar un correo
        mostrarError();
    }
} else {
    mostrarError();
}

function mostrarError() {
    echo '
    <script>
    alert("El usuario no existe o la contraseña es incorrecta, por favor verifique los datos.");
    window.location="inisio.html";
    </script>
    ';
    exit;
}

// Registra un intento fallido en la sesión
function registrarIntentoFallido($correo) {
    $_SESSION['intentos'][$correo] = ($_SESSION['intentos'][$correo] ?? 0) + 1;
}

// Verifica si los intentos fallidos superan el límite y envía un correo
function verificarIntentosFallidos($correo) {
    if ($_SESSION['intentos'][$correo] >= 3) {
        enviarCorreoIntentosFallidos($correo);
        $_SESSION['intentos'][$correo] = 0; // Reinicia el contador
    }
}

// Envía un correo después de varios intentos fallidos
function enviarCorreoIntentosFallidos($correo) {
   use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function enviarCorreoIntentosFallidos($correo) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.tu-servidor.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'soporte@cecyburgers.com';
        $mail->Password = 'tu-contraseña';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('soporte@cecyburgers.com', 'CecyBurgers');
        $mail->addAddress($correo);

        $mail->isHTML(true);
        $mail->Subject = 'Intentos fallidos de inicio de sesión';
        $mail->Body = 'Hemos detectado varios intentos fallidos de inicio de sesión en tu cuenta. Si no fuiste tú, por favor cambia tu contraseña inmediatamente.';

        $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}

}
?>
