<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);

    
    $telefono = preg_replace('/[^0-9]/', '', $telefono); 

    
    if (strlen($telefono) >= 10) {
        
        $telefono = substr($telefono, 0, 2) . '-' . 
                    substr($telefono, 2, 2) . '-' . 
                    substr($telefono, 4, 2) . '-' . 
                    substr($telefono, 6, 2) . '-' . 
                    substr($telefono, 8, 2);
        
        $sql = "INSERT INTO usuarios(nombre, contraseña, correo, telefono) VALUES('$nombre', '$contraseña', '$correo', '$telefono')";
        
        if (mysqli_query($coneccion, $sql)) {
            echo '
            <script>
            alert("Usuario registrado exitosamente");
            window.location = "inisio.html";
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Inténtalo de nuevo");
            window.location = "inisio.html";
            </script>
            ';
        }
    } else {
        echo '
        <script>
        alert("El número de teléfono debe tener al menos 10 dígitos.");
        window.location = "inisio.html";
        </script>
        ';
    }
}
mysqli_close($coneccion);
?>
