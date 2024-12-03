<?php

// Iniciar la sesión
session_start();

// Verificar si el archivo ha sido incluido y no accesado directamente


// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "sesion";
$puerto = "3306";

$coneccion = new mysqli($servidor, $usuario, $contrasena, $base_datos, $puerto);
if ($coneccion->connect_error) {
    die("Error de conexión: " . $coneccion->connect_error);
}

// Consultar datos dinámicos
$usuarios = $coneccion->query("SELECT COUNT(*) as total FROM usuarios")->fetch_assoc()['total'];
$inventario = $coneccion->query("SELECT COUNT(*) as total FROM inventario")->fetch_assoc()['total'];
$ventas = $coneccion->query("SELECT COUNT(*) as total FROM ventas")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f9fc;
            display: flex;
        }

        /* Menú lateral */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .sidebar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .sidebar a {
            text-decoration: none;
            color: #ecf0f1;
            width: 100%;
            text-align: left;
            padding: 10px 20px;
            margin: 5px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        /* Contenido principal */
        .main-content {
            flex: 1;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            color: #2c3e50;
        }

        .logout {
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout:hover {
            background-color: #c0392b;
        }

        /* Tarjetas */
        .cards {
            display: flex;
            gap: 20px;
        }

        .card {
            flex: 1;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #2c3e50;
        }

        .card p {
            font-size: 24px;
            color: #3498db;
            font-weight: bold;
        }

        .card:hover {
            background-color: #f1f2f6;
        }

        .content { margin-top: 20px; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        canvas { max-width: 100%; 
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="user.png" alt="User">
        <h2><?php echo $_SESSION['admin']; ?></h2>
        <a href="#" id="inicio" data-section="inicio">Inicio</a>
        <a href="#" data-section="usuarios">Administrar Usuarios</a>
        <a href="#" data-section="inventario">Administrar Inventario</a>
        <a href="#" data-section="ventas">Registro de Ventas</a>
        <button class="logout" onclick="logout()">Cerrar sesión</button>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Bienvenido al Panel de Administración</h1>
        </div>

        <div class="cards">
            <div class="card" data-chart="usuarios">
                <h3>Usuarios</h3>
                <p><?php echo $usuarios; ?> Registrados</p>
            </div>
            <div class="card" data-chart="inventario">
                <h3>Inventario</h3>
                <p><?php echo $inventario; ?> Items</p>
            </div>
            <div class="card" data-chart="ventas">
                <h3>Ventas</h3>
                <p><?php echo $ventas; ?> Ventas</p>
            </div>
        </div>

        <div class="content" id="content">
            <canvas id="chart"></canvas>
        </div>
    </div>

    <script>

          function resetActiveLinks() {
                $(".sidebar a").removeClass("active");
                $(".content").html("<h3>Selecciona una opción del menú</h3>");
            }

            // Al hacer clic en el enlace "Inicio", recargamos la página y quitamos cualquier opción seleccionada
            $('#inicio').click(function (e) {
                e.preventDefault();
                resetActiveLinks(); // Limpiar cualquier selección previa
                location.reload(); // Recargar la página
            });

        $(document).ready(function () {
            // Mostrar gráfica al hacer clic en una tarjeta
            $('.card').click(function () {
                const chartType = $(this).data('chart');
                $.ajax({
                    url: 'get_chart_data.php', // Archivo para obtener datos de la gráfica
                    type: 'POST',
                    data: { type: chartType },
                    success: function (response) {
                        const data = JSON.parse(response);
                        renderChart(chartType, data.labels, data.values);
                    }
                });
            });

            // Cargar contenido dinámico al seleccionar una opción
            $('.sidebar a').click(function (e) {
                e.preventDefault();
                const section = $(this).data('section');
                $.ajax({
                    url: `admin_${section}.php`, // Archivo PHP correspondiente
                    type: 'GET',
                    success: function (response) {
                        $('#content').html(response); // Cargar contenido en el contenedor
                    }
                });
            });
        });

        // Renderizar gráfica con Chart.js
        function renderChart(type, labels, values) {
            const ctx = document.getElementById('chart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: `Datos de ${type}`,
                        data: values,
                        backgroundColor: 'rgba(52, 152, 219, 0.5)',
                        borderColor: 'rgba(52, 152, 219, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        function logout() {
            // Redirigir al script de logout
            window.location.href = 'logout1.php';
        }
    </script>
</body>
</html>

