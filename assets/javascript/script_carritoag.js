document.addEventListener('DOMContentLoaded', function() {
    const cartBtn = document.getElementById('cart-btn');
    const cartDropdown = document.getElementById('cart-dropdown');
    const cartItems = document.getElementById('cart-items');
    const cartCount = document.getElementById('cart-count');
    const cartTotal = document.getElementById('cart-total');
    const checkoutBtn = document.getElementById('checkout-btn');

    let cart = [];

    cartBtn.addEventListener('click', function() {
        cartDropdown.classList.toggle('hidden');
    });

    function updateCart() {
        cartItems.innerHTML = '';
        let total = 0;
        let itemCount = 0;
        cart.forEach((item, index) => {
            total += item.price * item.quantity;
            itemCount += item.quantity;
            cartItems.innerHTML += `
                <div class="flex justify-between items-center mb-2">
                    <span>${item.name} (${item.quantity})</span>
                    <span>$${(item.price * item.quantity).toLocaleString()}</span>
                    <button onclick="removeFromCart(${index})" class="text-red-500">&times;</button>
                </div>
            `;
        });
        cartCount.textContent = itemCount;
        cartTotal.textContent = `$${total.toLocaleString()}`;
    }

    window.addToCart = function(name, price) {
        const existingItem = cart.find(item => item.name === name);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({ name, price, quantity: 1 });
        }
        updateCart();
        
        // Mostrar una notificación
        showNotification(`${name} agregado al carrito`);
    }

    window.removeFromCart = function(index) {
        cart.splice(index, 1);
        updateCart();
    }

    checkoutBtn.addEventListener('click', function() {
        alert('Procesando pago...');
        // Aquí iría la lógica para procesar el pago
        cart = [];
        updateCart();
        cartDropdown.classList.add('hidden');
    });

    function showNotification(message) {
        const notification = document.createElement('div');
        notification.textContent = message;
        notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg';
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Cerrar el dropdown cuando se hace clic fuera de él
    document.addEventListener('click', function(event) {
        if (!cartBtn.contains(event.target) && !cartDropdown.contains(event.target)) {
            cartDropdown.classList.add('hidden');
        }
    });
});