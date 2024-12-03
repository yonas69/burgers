<?php
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

// Consultar los datos de la tabla pago
$sql = "SELECT id, name, card_number, expiration_date, cvv, address, created_at FROM pagos";
$resultado = $coneccion->query($sql);

?>

<h3>Registro de Pagos</h3>
<button id="exportExcel">Exportar a Excel</button>
<button id="showGraph">Mostrar Gráfica</button>
<div id="tableContainer">
    <table border="1" style="width:100%; border-collapse: collapse;" id="paymentsTable">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Número de Tarjeta</th>
            <th>Fecha de Expiración</th>
            <th>CVV</th>
            <th>Dirección</th>
            <th>Fecha de Creación</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . htmlspecialchars($fila['name']) . "</td>";
                echo "<td>" . substr($fila['card_number'], -4) . "</td>"; // Últimos 4 dígitos
                echo "<td>" . htmlspecialchars($fila['expiration_date']) . "</td>";
                echo "<td>***</td>"; // Ocultar CVV
                echo "<td>" . htmlspecialchars($fila['address']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['created_at']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay registros en la tabla de pagos.</td></tr>";
        }
        ?>
    </table>
</div>

<div id="chartContainer" style="display:none; margin-top:20px;">
    <canvas id="paymentsChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Botón para exportar a Excel
    document.getElementById('exportExcel').addEventListener('click', function () {
        let table = document.getElementById('paymentsTable');
        let rows = [...table.rows].map(row => [...row.cells].map(cell => cell.innerText));
        let csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
        let encodedUri = encodeURI(csvContent);
        let link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "registro_pagos.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    // Botón para mostrar la gráfica
    document.getElementById('showGraph').addEventListener('click', function () {
        document.getElementById('chartContainer').style.display = 'block';

        // Datos para la gráfica
        let labels = [];
        let data = [];
        let tableRows = document.querySelectorAll("#paymentsTable tr:not(:first-child)");

        tableRows.forEach(row => {
            labels.push(row.cells[1].innerText); // Nombres
            data.push(parseInt(row.cells[0].innerText)); // IDs
        });

        new Chart(document.getElementById('paymentsChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pagos por Nombre',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
