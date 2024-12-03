// Validación de código postal y dirección
document.getElementById('carrito-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const codigoPostal = document.getElementById('codigo-postal').value;

    if (!/^\d{5}$/.test(codigoPostal)) {
        alert("Por favor, ingresa un código postal válido de 5 dígitos.");
        return;
    }

    // Proceder al pago si la validación es correcta
    window.location.href = 'pago.html';
});
window.addEventListener('load', function() {
    const producto = JSON.parse(localStorage.getItem('producto'));

    if (producto) {
        document.getElementById('lista-productos').innerHTML = `
            <li>${producto.nombre} (${producto.tamaño}) - ${producto.cantidad} x $${producto.precio}</li>
        `;
        document.getElementById('subtotal').innerText = `Subtotal: $${producto.total}`;
    }
});
const direcciones = {
    '12345': {
        ciudad: 'Ciudad de México',
        estado: 'CDMX'
    },
    '67890': {
        ciudad: 'Guadalajara',
        estado: 'Jalisco'
    },
    // Añadir más códigos postales según sea necesario
};

document.getElementById('codigo-postal').addEventListener('input', function() {
    const codigoPostal = this.value;
    
    if (direcciones[codigoPostal]) {
        document.getElementById('ciudad').value = direcciones[codigoPostal].ciudad;
        document.getElementById('estado').value = direcciones[codigoPostal].estado;
    } else {
        document.getElementById('ciudad').value = '';
        document.getElementById('estado').value = '';
    }
});
document.addEventListener('DOMContentLoaded', () => {
    // Actualizar el resumen del carrito al cargar la página
    actualizarResumenCarrito();
});

function actualizarResumenCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const listaProductos = document.getElementById('lista-productos');
    const subtotal = document.getElementById('subtotal');
    
    listaProductos.innerHTML = ''; // Limpiar lista de productos
    let total = 0;

    carrito.forEach(item => {
        // Añadir producto principal
        const itemDiv = document.createElement('li');
        itemDiv.innerHTML = `<strong>${item.nombre} (${item.cantidad})</strong> - $${item.total}`;
        listaProductos.appendChild(itemDiv);
        
        // Añadir productos adicionales
        item.adicionales.forEach(adicional => {
            const adicionalDiv = document.createElement('li');
            adicionalDiv.innerHTML = `&nbsp;&nbsp;&nbsp;${adicional.nombre} x${adicional.cantidad} - $${adicional.cantidad * item.precio}`;
            listaProductos.appendChild(adicionalDiv);
        });

        total += item.total;
    });

    subtotal.innerText = `Subtotal: $${total}`;
}

