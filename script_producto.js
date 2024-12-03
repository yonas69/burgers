document.getElementById('producto-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const tamaño = document.getElementById('tamaño').value;
    const cantidad = document.getElementById('cantidad').value;
    const precio = document.querySelector(`#tamaño option[value="${tamaño}"]`).dataset.precio;

    // Verificar productos adicionales seleccionados
    let productosAdicionales = [];
    let precioAdicionales = 0;

    document.querySelectorAll('.productos-adicionales img.selected').forEach(function(item) {
        const nombre = item.dataset.nombre;
        const precioAdicional = parseInt(item.dataset.precio);
        productosAdicionales.push(nombre);
        precioAdicionales += precioAdicional;
    });

    const producto = {
        nombre: 'Big Mac',
        tamaño: tamaño,
        cantidad: cantidad,
        precio: precio,
        adicionales: productosAdicionales,
        total: (precio * cantidad) + precioAdicionales
    };

    localStorage.setItem('producto', JSON.stringify(producto));

    // Actualizar la cantidad en el ícono del carrito
    document.getElementById('cantidad-carrito').innerText = cantidad;

    alert('Producto y adicionales añadidos al carrito');
});

// Manejar selección de productos adicionales
document.querySelectorAll('.productos-adicionales img').forEach(function(item) {
    item.addEventListener('click', function() {
        this.classList.toggle('selected');
        calcularTotal();
    });
});

function calcularTotal() {
    const tamaño = document.getElementById('tamaño').value;
    const cantidad = document.getElementById('cantidad').value;
    const precio = document.querySelector(`#tamaño option[value="${tamaño}"]`).dataset.precio;

    // Sumar el precio de los productos adicionales seleccionados
    let precioAdicionales = 0;
    document.querySelectorAll('.productos-adicionales img.selected').forEach(function(item) {
        precioAdicionales += parseInt(item.dataset.precio);
    });

    const precioTotal = (precio * cantidad) + precioAdicionales;
    document.getElementById('precio-total').innerText = `Precio Total: $${precioTotal}`;
}
document.getElementById('producto-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const tamaño = document.getElementById('tamaño').value;
    const cantidad = document.getElementById('cantidad').value;
    const precio = document.querySelector(`#tamaño option[value="${tamaño}"]`).dataset.precio;

    // Verificar productos adicionales seleccionados
    let productosAdicionales = [];
    let precioAdicionales = 0;

    document.querySelectorAll('.productos-adicionales div').forEach(function(div) {
        const nombre = div.querySelector('img').alt;
        const cantidadAdicional = parseInt(div.querySelector('.cantidad-adicional').value) || 0;
        const precioAdicional = parseInt(div.querySelector('.cantidad-adicional').dataset.precio);

        if (cantidadAdicional > 0) {
            productosAdicionales.push({ nombre, cantidad: cantidadAdicional });
            precioAdicionales += precioAdicional * cantidadAdicional;
        }
    });

    const producto = {
        nombre: 'Big Mac',
        tamaño: tamaño,
        cantidad: cantidad,
        precio: precio,
        adicionales: productosAdicionales,
        total: (precio * cantidad) + precioAdicionales
    };

    localStorage.setItem('producto', JSON.stringify(producto));

    // Actualizar la cantidad en el ícono del carrito
    document.getElementById('cantidad-carrito').innerText = cantidad;

    alert('Producto y adicionales añadidos al carrito');
});

// Manejar incremento y decremento
document.querySelectorAll('.btn-cantidad').forEach(function(button) {
    button.addEventListener('click', function() {
        const input = this.parentElement.querySelector('.cantidad-adicional');
        let cantidad = parseInt(input.value) || 0;
        
        if (this.dataset.accion === 'incrementar') {
            cantidad += 1;
        } else if (this.dataset.accion === 'decrementar' && cantidad > 0) {
            cantidad -= 1;
        }

        input.value = cantidad;
        calcularTotal();
    });
});

function calcularTotal() {
    const tamaño = document.getElementById('tamaño').value;
    const cantidad = document.getElementById('cantidad').value;
    const precio = document.querySelector(`#tamaño option[value="${tamaño}"]`).dataset.precio;

    // Sumar el precio de los productos adicionales seleccionados
    let precioAdicionales = 0;
    document.querySelectorAll('.productos-adicionales div').forEach(function(div) {
        const cantidadAdicional = parseInt(div.querySelector('.cantidad-adicional').value) || 0;
        const precioAdicional = parseInt(div.querySelector('.cantidad-adicional').dataset.precio);

        precioAdicionales += precioAdicional * cantidadAdicional;
    });

    const precioTotal = (precio * cantidad) + precioAdicionales;
    document.getElementById('precio-total').innerText = `Precio Total: $${precioTotal}`;
}
document.getElementById('producto-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const tamaño = document.getElementById('tamaño').value;
    const cantidad = document.getElementById('cantidad').value;
    const precio = document.querySelector(`#tamaño option[value="${tamaño}"]`).dataset.precio;

    // Verificar productos adicionales seleccionados
    let productosAdicionales = [];
    let precioAdicionales = 0;

    document.querySelectorAll('.productos-adicionales div').forEach(function(div) {
        const nombre = div.querySelector('img').alt;
        const cantidadAdicional = parseInt(div.querySelector('.cantidad-adicional').value) || 0;
        const precioAdicional = parseInt(div.querySelector('.cantidad-adicional').dataset.precio);

        if (cantidadAdicional > 0) {
            productosAdicionales.push({ nombre, cantidad: cantidadAdicional });
            precioAdicionales += precioAdicional * cantidadAdicional;
        }
    });

    const producto = {
        nombre: 'Big Mac',
        tamaño: tamaño,
        cantidad: cantidad,
        precio: precio,
        adicionales: productosAdicionales,
        total: (precio * cantidad) + precioAdicionales
    };

    // Guardar producto en localStorage
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    carrito.push(producto);
    localStorage.setItem('carrito', JSON.stringify(carrito));

    // Actualizar la cantidad en el ícono del carrito
    document.getElementById('cantidad-carrito').innerText = carrito.length;

    alert('Producto y adicionales añadidos al carrito');
    actualizarResumenCarrito();
});

function actualizarResumenCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const carritoItems = document.getElementById('carrito-items');
    const carritoTotal = document.getElementById('carrito-total');

    carritoItems.innerHTML = '';
    let total = 0;

    carrito.forEach(item => {
        total += item.total;
        const itemDiv = document.createElement('div');
        itemDiv.innerHTML = `<strong>${item.nombre}</strong> (${item.cantidad}) - $${item.total}`;
        carritoItems.appendChild(itemDiv);
    });

    carritoTotal.innerText = `Total: $${total}`;
}

// Llamar a esta función al cargar la página para mostrar el resumen inicial
window.addEventListener('load', actualizarResumenCarrito);
document.getElementById('producto-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const tamaño = document.getElementById('tamaño').value;
    const cantidad = document.getElementById('cantidad').value;
    const precio = document.querySelector(`#tamaño option[value="${tamaño}"]`).dataset.precio;

    // Verificar productos adicionales seleccionados
    let productosAdicionales = [];
    let precioAdicionales = 0;

    document.querySelectorAll('.productos-adicionales div').forEach(function(div) {
        const nombre = div.querySelector('img').alt;
        const cantidadAdicional = parseInt(div.querySelector('.cantidad-adicional').value) || 0;
        const precioAdicional = parseInt(div.querySelector('.cantidad-adicional').dataset.precio);

        if (cantidadAdicional > 0) {
            productosAdicionales.push({ nombre, cantidad: cantidadAdicional });
            precioAdicionales += precioAdicional * cantidadAdicional;
        }
    });

    const producto = {
        nombre: 'Big Mac',
        tamaño: tamaño,
        cantidad: cantidad,
        precio: precio,
        adicionales: productosAdicionales,
        total: (precio * cantidad) + precioAdicionales
    };

    // Guardar producto en localStorage
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    carrito.push(producto);
    localStorage.setItem('carrito', JSON.stringify(carrito));

    // Actualizar la cantidad en el ícono del carrito
    document.getElementById('cantidad-carrito').innerText = carrito.length;

    alert('Producto y adicionales añadidos al carrito');
    actualizarResumenCarrito();
});

function actualizarResumenCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const carritoItems = document.getElementById('carrito-items');
    const carritoTotal = document.getElementById('carrito-total');

    carritoItems.innerHTML = '';
    let total = 0;

    carrito.forEach(item => {
        total += item.total;
        const itemDiv = document.createElement('div');
        itemDiv.innerHTML = `<strong>${item.nombre}</strong> (${item.cantidad}) - $${item.total}`;
        carritoItems.appendChild(itemDiv);
    });

    carritoTotal.innerText = `Total: $${total}`;
}

// Manejar incremento y decremento
document.querySelectorAll('.btn-cantidad').forEach(function(button) {
    button.addEventListener('click', function() {
        const input = this.parentElement.querySelector('.cantidad-adicional');
        let cantidad = parseInt(input.value) || 0;
        
        if (this.dataset.accion === 'incrementar') {
            cantidad += 1;
        } else if (this.dataset.accion === 'decrementar' && cantidad > 0) {
            cantidad -= 1;
        }

        input.value = cantidad;
        calcularTotal();
    });
});

function calcularTotal() {
    const tamaño = document.getElementById('tamaño').value;
    const cantidad = document.getElementById('cantidad').value;
    const precio = document.querySelector(`#tamaño option[value="${tamaño}"]`).dataset.precio;

    // Sumar el precio de los productos adicionales
    let precioAdicionales = 0;
    document.querySelectorAll('.productos-adicionales div').forEach(function(div) {
        const cantidadAdicional = parseInt(div.querySelector('.cantidad-adicional').value) || 0;
        const precioAdicional = parseInt(div.querySelector('.cantidad-adicional').dataset.precio);

        precioAdicionales += precioAdicional * cantidadAdicional;
    });

    const precioTotal = (precio * cantidad) + precioAdicionales;
    document.getElementById('precio-total').innerText = `Precio Total: $${precioTotal}`;
}

// Llamar a esta función al cargar la página para mostrar el resumen inicial
window.addEventListener('load', actualizarResumenCarrito);

