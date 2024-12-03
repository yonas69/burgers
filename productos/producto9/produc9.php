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
  <img src="mc Spicy Chicken.jpg"" alt="Grand Tasty Doble" class="burger-image">
  <div class="product-info">
    <h1>Cecy Spicy Chicken</h1>
    <p>
    La Cecy Spicy Chicken es la opción perfecta para los amantes de lo picante. Con una pechuga de pollo jugosa,
     marinada en especias picantes y cocida a la perfección, esta hamburguesa tiene un toque audaz y sabroso. 
     El pollo crujiente se complementa con lechuga fresca, rodajas de tomate y cebolla, mientras que una salsa picante especial le da el toque final que eleva su sabor.
      Todo esto está envuelto en un pan suave y ligeramente tostado. La Cecy Spicy Chicken es la opción ideal para quienes buscan una hamburguesa con un sabor intenso y un toque de picante.
     ¡Para los que disfrutan de una experiencia explosiva de sabores!
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
