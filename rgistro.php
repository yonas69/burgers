<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - cecyBurgers</title>
    <link rel="stylesheet" href="ind.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('Fondois.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-color: #e3e3e3;
            color: #333333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            width: 400px;
            padding: 20px;
            background-color: #f4f3f3;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #000000;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #000000;
        }
        .text-input, .select-input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            background-color: #f0f8ff;
            color: #333333;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: #000000;
            color: #ffffff;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Registro</h2>

        <div class="profile-image-container">
            <img id="profileImage" src="" alt="Foto de Perfil" class="profile-image" style="display: none;">
            <input type="file" id="profileImageInput" accept="image/*" onchange="previewImage(event)">
        </div>

        <form action="consulta.php" method="POST">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" required class="text-input">

            <label for="nombre">Nombre de Usuario:</label>
            <input type="text" name="nombre" required class="text-input">
            
            <label for="contraseña">Contraseña:</label>
            <div style="display: flex; align-items: center;">
                <input type="password" name="contraseña" id="contraseña" required class="text-input" style="flex-grow: 1;">
                <button type="button" onclick="togglePasswordVisibility()" style="border: none; background: none; cursor: pointer; font-size: 20px;">👁️</button>
            </div>

            <label for="telefono">Número de Teléfono:</label>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <select id="countryCode" class="select-input" required>
                    <option value="" disabled selected>Selecciona tu país</option>
                    <option value="56">🇲🇽 +56</option>
                    <option value="1">🇺🇸 +1</option>
                    <option value="34">🇪🇸 +34</option>
                </select>
                <input type="text" id="telefono" placeholder="Número de Teléfono" oninput="formatPhoneNumber(this)" class="text-input">
                <input type="hidden" name="telefono" id="telefonoCompleto">
            </div>

            <button type="submit">Registrarse</button>
        </form>

        <div class="social-media">
            <h3>Síguenos en redes sociales:</h3>
            <a href="https://www.instagram.com/tucuenta" target="_blank">Instagram</a>
            <a href="https://www.facebook.com/tucuenta" target="_blank">Facebook</a>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('profileImage');
                img.src = e.target.result;
                img.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }

        function formatPhoneNumber(input) {
            const value = input.value.replace(/\D/g, '');
            let formatted = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 2 === 0) {
                    formatted += '-';
                }
                formatted += value[i];
            }
            input.value = formatted;

            const countryCode = document.getElementById('countryCode').value;
            document.getElementById('telefonoCompleto').value = `+${countryCode}-${formatted}`;
        }

        function togglePasswordVisibility() {
            const passwordField = document.getElementById('contraseña');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#countryCode').select2({
                width: '100%',
                minimumResultsForSearch: Infinity
            });
        });
    </script>

    <img src="logo.png" alt="Imagen de Cabecera" class="header-image" style="width: 100%; margin-top: 20px;">
</body>
</html>

