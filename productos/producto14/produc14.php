<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cecy Grand Mac</title>
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
  <img src="mc Grand Mac.jpg" alt="Grand Tasty Doble" class="burger-image">
  <div class="product-info">
    <h1>Cecy Grand Mac</h1>
    <p>
    La Cecy Grand Mac es una hamburguesa majestuosa que lleva el clásico al siguiente nivel. 
    Con tres jugosas hamburguesas de res, perfectamente sazonadas y cocidas, y una capa generosa de queso cheddar derretido,
     esta obra maestra ofrece una experiencia de sabor única. El toque de cebolla crujiente, lechuga fresca, rodajas de tomate y una salsa especial, 
     complementan perfectamente cada bocado. Todo esto está servido en un pan de gran tamaño, suave y ligeramente tostado, que mantiene todos los ingredientes en su lugar.
      La Cecy Grand Mac es ideal para quienes buscan una hamburguesa grande, deliciosa y llena de sabor en cada capa. 
    ¡Una verdadera indulgencia en cada bocado!
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
