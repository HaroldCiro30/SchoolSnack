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
        cart.forEach((item, index) => {
            total += item.price * item.quantity;
            cartItems.innerHTML += `
                <div class="flex justify-between items-center mb-2">
                    <span>${item.name} (${item.quantity})</span>
                    <span>$${(item.price * item.quantity).toFixed(2)}</span>
                    <button onclick="removeFromCart(${index})" class="text-red-500">&times;</button>
                </div>
            `;
        });
        cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartTotal.textContent = `$${total.toFixed(2)}`;
    }

    window.addToCart = function(name, price) {
        const existingItem = cart.find(item => item.name === name);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({ name, price, quantity: 1 });
        }
        updateCart();
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
});