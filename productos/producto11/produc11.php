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
  <img src="mcSausage Muffin.jpg" alt="Grand Tasty Doble" class="burger-image">
  <div class="product-info">
    <h1>Cecy Sausage Muffin</h1>
    <p>
    La Cecy Sausage Muffin es una opción deliciosa y reconfortante, perfecta para comenzar el día con energía.
     Con un suave muffin inglés, relleno de una jugosa salchicha de cerdo perfectamente sazonada, un huevo cocido a la perfección y una capa de queso derretido,
      esta combinación es irresistible. Todo esto se complementa con un toque de salsa especial que realza el sabor de la salchicha. 
      Ideal para quienes buscan un desayuno sabroso y completo, la Cecy Sausage Muffin es la elección perfecta para disfrutar de una comida rápida y deliciosa. 
    ¡Cada bocado es un verdadero placer!
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
