<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grand Tasty Doble</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <div class="menu">
      <span class="logo">🍔</span>
    </div>
  </header>

  <main>
  <section class="product">
  <img src="mcDouble Cheeseburger.jpg" alt="Grand Tasty Doble" class="burger-image">
  <div class="product-info">
    <h1>Cecy Double Cheeseburger</h1>
    <p>
    La Cecy Double Cheeseburger es la hamburguesa perfecta para los amantes del queso. Con dos jugosas y suculentas hamburguesas de res, 
    cocidas a la perfección, acompañadas de una generosa capa de queso cheddar derretido que se fusiona perfectamente con la carne. Lechuga fresca, 
    rodajas de tomate y cebolla crujiente añaden frescura y textura, mientras que una deliciosa salsa especial realza todos los sabores. Todo esto está servido en un pan suave y ligeramente tostado,
     creando una experiencia de sabor completa y satisfactoria. La Cecy Double Cheeseburger es ideal para quienes buscan una hamburguesa grande, sabrosa y con mucho queso. 
    ¡Un clásico reinventado en cada bocado!
    </p>
    <a href="formulario.html" class="order-btn">Comenzar Pedido</a>
        <div class="more-info">
          <button onclick="toggleNutritionalInfo()">Información nutricional</button>
          <button onclick="toggleAllergensInfo()">Información sobre alérgenos</button>
        </div>
      </div>
    </section>

    <section id="nutritional-info" class="info-section hidden">
      <h2>Información Nutricional</h2>
      <div class="info-cards">
        <div class="card">1444Kcal<br><span>Calorías (Kcal)</span></div>
        <div class="card">108g<br><span>Grasas</span></div>
        <div class="card">60g<br><span>Carbohidratos Totales</span></div>
        <div class="card">60g<br><span>Proteínas</span></div>
        <div class="card">3223mg<br><span>Sodio</span></div>
      </div>
      <table>
        <tr>
          <th>Información Nutricional</th>
          <th>Por Producto</th>
          <th>I.D.R.%</th>
        </tr>
        <tr>
          <td>Calorías (Kcal)</td>
          <td>1444Kcal</td>
          <td>0%</td>
        </tr>
        <tr>
          <td>Grasas</td>
          <td>108g</td>
          <td>0%</td>
        </tr>
        <tr>
          <td>Carbohidratos Totales</td>
          <td>60g</td>
          <td>0%</td>
        </tr>
        <tr>
          <td>Proteínas</td>
          <td>60g</td>
          <td>0%</td>
        </tr>
        <tr>
          <td>Sodio</td>
          <td>3223mg</td>
          <td>0%</td>
        </tr>
      </table>
    </section>
  </main>

  <script src="script.js"></script>
</body>
</html>
