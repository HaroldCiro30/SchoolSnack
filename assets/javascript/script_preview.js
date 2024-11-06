// script_preview.js

let cart = [];

document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all "Comprar ahora" buttons
    document.querySelectorAll('.product-card button').forEach(button => {
        if (button.textContent.trim() === 'Comprar ahora') {
            button.addEventListener('click', openModal);
        }
    });
});

function openModal() {
    const modal = document.getElementById('productModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
    
    // Add animation classes
    const modalContent = modal.querySelector('div');
    modalContent.classList.add('animate-modal-enter');
}

function closeModal() {
    const modal = document.getElementById('productModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

function updateQuantity(change) {
    const quantityElement = document.getElementById('quantity');
    const totalElement = document.getElementById('totalPrice');
    let quantity = parseInt(quantityElement.textContent) + change;
    
    // Ensure quantity doesn't go below 1
    quantity = Math.max(1, quantity);
    
    // Update quantity display
    quantityElement.textContent = quantity;
    
    // Update total price
    const unitPrice = 2000;
    totalElement.textContent = `$${(quantity * unitPrice).toLocaleString()}`;
}

function addToCart() {
    const quantity = parseInt(document.getElementById('quantity').textContent);
    const totalPrice = parseFloat(document.getElementById('totalPrice').textContent.replace('$', '').replace(',', ''));
    const productName = document.querySelector('#productModal h4').textContent;

    const item = {
        name: productName,
        quantity: quantity,
        price: totalPrice / quantity,
        total: totalPrice
    };

    cart.push(item);
    updateCartDisplay();
    closeModal();
}

function updateCartDisplay() {
    const cartCount = document.getElementById('cart-count');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');

    let totalItems = 0;
    let totalPrice = 0;

    cartItems.innerHTML = '';

    cart.forEach(item => {
        totalItems += item.quantity;
        totalPrice += item.total;

        const itemElement = document.createElement('div');
        itemElement.className = 'flex justify-between items-center mb-2';
        itemElement.innerHTML = `
            <span>${item.name} x${item.quantity}</span>
            <span>$${item.total.toLocaleString()}</span>
        `;
        cartItems.appendChild(itemElement);
    });

    cartCount.textContent = totalItems;
    cartTotal.textContent = `$${totalPrice.toLocaleString()}`;

    // Show cart dropdown
    document.getElementById('cart-dropdown').classList.remove('hidden');
}

function confirmPurchase() {
    addToCart();
    
    const modal = document.getElementById('productModal');
    const modalContent = modal.querySelector('.max-w-2xl');
    
    modalContent.innerHTML = `
        <div class="p-8 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-2xl font-semibold text-gray-900 mb-2">¡Producto agregado al carrito!</h3>
            <p class="text-gray-600 mb-6">
                El producto ha sido agregado exitosamente a tu carrito de compras.
            </p>
            <button onclick="closeModal()" class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                Cerrar
            </button>
        </div>
    `;
    
    // Close modal after 3 seconds
    setTimeout(closeModal, 3000);
}