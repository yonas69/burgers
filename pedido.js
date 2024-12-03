// Formulario Producto: Añadir al Carrito
document.getElementById('producto-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const tamaño = document.getElementById('tamaño');
    const cantidad = parseInt(document.getElementById('cantidad').value);
    const precio = parseInt(tamaño.selectedOptions[0].getAttribute('data-precio')) * cantidad;

    // Guardar en localStorage para luego usar en el carrito
    localStorage.setItem('producto', JSON.stringify({ tamaño: tamaño.value, cantidad, precio }));

    // Redireccionar al carrito
    window.location.href = 'carrito.html';
});

// Formulario Carrito: Mostrar Productos y Proceder al Pago
if (document.getElementById('carrito-form')) {
    const producto = JSON.parse(localStorage.getItem('producto'));

    if (producto) {
        document.getElementById('lista-productos').innerHTML = `
            <li>${producto.cantidad} x Big Mac (${producto.tamaño}) - $${producto.precio}</li>
        `;
        document.getElementById('subtotal').textContent = `Subtotal: $${producto.precio}`;
    }

    document.getElementById('carrito-form').addEventListener('submit', function(e) {
        e.preventDefault();
        window.location.href = 'pago.html';
    });
}

// Formulario Pago: Confirmar Pago
document.getElementById('pago-form').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Pago Confirmado. ¡Gracias por tu compra!');
    localStorage.clear();
});


