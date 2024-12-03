// Simulación de pago
document.getElementById('pago-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const numeroTarjeta = document.getElementById('numero-tarjeta').value;
    const fechaExpiracion = document.getElementById('fecha-expiracion').value;
    const cvv = document.getElementById('cvv').value;
    
    // Validar número de tarjeta (solo números y longitud)
    if (!/^\d{16}$/.test(numeroTarjeta)) {
        alert("Por favor, ingresa un número de tarjeta válido de 16 dígitos.");
        return;
    }
    
    // Validar fecha de expiración (MM/AA)
    if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(fechaExpiracion)) {
        alert("Por favor, ingresa una fecha de expiración válida en el formato MM/AA.");
        return;
    }

    // Validar CVV (3 dígitos)
    if (!/^\d{3}$/.test(cvv)) {
        alert("Por favor, ingresa un CVV válido de 3 dígitos.");
        return;
    }

    // Si todo está correcto, simular el pago
    alert('Pago Confirmado. ¡Gracias por tu compra!');
    localStorage.clear();
});
