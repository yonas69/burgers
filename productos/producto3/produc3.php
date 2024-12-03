<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cecy Quarter Pounder with Chees</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="menu">
      <span class="logo">🍔</span>
    </div>
  </header>

  <main>
  <section class="product">
  <img src="Cecy Quarter Pounder with Chees.jpg" alt="Grand Tasty Doble" class="burger-image">
  <div class="product-info">
    <h1>Cecy Quarter Pounder with Cheese</h1>
    <p>
    La Cecy Quarter Pounder with Cheese es una hamburguesa contundente y deliciosa, preparada con una generosa porción de carne de res de ¼ de libra, perfectamente sellada para mantener su jugosidad. 
    Está cubierta con una capa de queso cheddar derretido, que se funde armoniosamente con la carne, creando una textura cremosa en cada mordisco. Acompañada de cebollas frescas, lechuga crujiente, 
    tomate y una salsa especial, todo dentro de un pan suave y ligeramente tostado. Ideal para quienes buscan un clásico con un toque único y un sabor incomparable. 
    ¡La Cecy Quarter Pounder with Cheese es pura satisfacción en cada bocado!
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
