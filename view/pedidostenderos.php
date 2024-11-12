<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    echo '
            <script>
                alert("Por favor debes iniciar sesión");
                window.location = "../index.php";
            </script>
            ';
    header("location: ../index.php");
    session_destroy();
    die();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos para Tenderos - Tienda Escolar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style16.css">
</head>
<body class="bg-gray-100">

<div class="loader-section">
  <span class="loader"></span>
</div>

<!-- Kevin, te dejare todo explicado para que vayas viendo como seria la cosa, 
 cambio y fuera! --> 


<nav class="bg-black text-white py-4 px-6 flex justify-between items-center fixed top-0 w-full z-50">
    <div class="flex items-center">
        <a href="paginaprincipal.php">
            <img src="../assets/imagenes/SchoolSnackPrototipo.png" alt="Logo" class="h-10 w-auto">
        </a>
    </div>

    <div class="hidden md:flex space-x-8">
        <a href="paginaprincipal.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Inicio</a>
        <a href="aboutus.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Acerca de Nosotros</a>
        <a href="productos.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Administrar</a>
        <a href="contactanos.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Contactanos</a>
    </div>

        <div class="flex items-center space-x-4">
            <!-- Carrito de compras -->
            <div class="relative" id="cart-container">
                <button id="cart-btn" class="text-white hover:text-orange-400 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-orange-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">0</span>
                </button>
                <div id="cart-dropdown" class="hidden absolute right-0 mt-2 w-64 bg-white text-black rounded-lg shadow-lg py-2 z-10">
                    <div id="cart-items" class="px-4 py-2">
                        <!-- Los items del carrito se insertarán aquí dinámicamente -->
                    </div>
                    <div class="border-t border-gray-200 mt-2 pt-2 px-4">
                        <div class="flex justify-between items-center">
                            <span class="font-bold">Total:</span>
                            <span id="cart-total">$0.00</span>
                        </div>
                        <button id="checkout-btn" class="mt-2 w-full bg-orange-500 text-white py-2 px-4 rounded hover:bg-orange-600 transition duration-300">Pagar</button>
                    </div>
                </div>
            </div>

            <!-- Perfil de usuario -->
            <div class="relative">
                <button id="profile-btn" class="hidden md:flex items-center focus:outline-none">
                    <?php
                    include '../controller/db.php'; 
                    $usuario_actual = $_SESSION['usuario'];
                    $sql = "SELECT imagen FROM usuarios WHERE usuario='$usuario_actual'";
                    $resultado = mysqli_query($conn, $sql);
                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        $fila = mysqli_fetch_assoc($resultado);
                        $rutaImagen = '../uploads/' . $fila['imagen']; 
                    } else {
                        $rutaImagen = '../../../uploads/default.png';
                    }
                    ?>
                    <img src="<?php echo $rutaImagen; ?>" alt="Imagen de perfil" class="profile-image" style="width: 50px; height: 50px; border-radius: 50%; object-fit: fill;">
                </button>

                <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-black text-white rounded-lg shadow-lg py-2">
                    <div class="px-4 py-2">
                        <?php
                        include '../controller/db.php'; 
                        $usuario_actual = $_SESSION['usuario'];
                        $sql = "SELECT correo FROM usuarios WHERE usuario='$usuario_actual'";
                        $resultado = mysqli_query($conn, $sql);
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            $fila = mysqli_fetch_assoc($resultado);
                            $correo = $fila['correo'];
                        } else {
                            $correo = "Correo no disponible";
                        }
                        ?>
                        <p class="font-bold"><?php echo ucwords($_SESSION['usuario']);?></p>
                        <p class="text-sm text-gray-600"><?php echo $correo;?></p>
                    </div>
                    <hr class="border-t border-gray-200 my-2">
                    <a href="perfil.php" class="block px-4 py-2 hover:bg-gray-100">Perfil</a>
                    <a href="../controller/functions/users/cerrar_sesion.php" class="block px-4 py-2 hover:bg-gray-100">Cerrar sesión</a>
                </div>
            </div>

            <div class="md:hidden">
                <button id="menu-btn" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <div id="mobile-menu" class="hidden md:hidden bg-black text-white py-2">
        <a href="#aperitivo" class="block px-4 py-2 text-lg hover:bg-orange-500">Aperitivo</a>
        <a href="#acerca" class="block px-4 py-2 text-lg hover:bg-orange-500">Acerca de Nosotros</a>
        <a href="#admin" class="block px-4 py-2 text-lg hover:bg-orange-500">Administrar</a>
    </div>

    <script src="../assets/javascript/main.js"></script>
    <script src="../assets/javascript/carrito.js"></script>
</header>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Pedidos para Tenderos</h1>
        
        <!-- Filtros y Buscador -->
        <div class="mb-6 flex flex-wrap gap-4">
            <select id="categoryFilter" class="bg-white border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas las categorías</option>
                <option value="comida">Comida</option>
                <option value="bebidas">Bebidas</option>
                <option value="otros">Otros productos escolares</option>
            </select>
            <select id="timeFilter" class="bg-white border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todos los pedidos</option>
                <option value="recent">Pedidos recientes</option>
                <option value="previous">Pedidos anteriores</option>
            </select>
            <input type="text" id="searchInput" placeholder="Buscar por estudiante o producto" class="bg-white border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
        </div>

        <!-- Lista de Pedidos -->
        <div id="orderList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Los pedidos se generarán dinámicamente aquí -->
        </div>
    </div>

    <script>
        // Datos de ejemplo (en una aplicación real, estos datos vendrían de una base de datos)
        const orders = [
            { id: 1, student: "Ana García", category: "comida", items: [{ name: "Sandwich", quantity: 1, price: 5 }, { name: "Manzana", quantity: 1, price: 1 }], total: 6, prepared: false, date: new Date(2023, 4, 15, 10, 30) },
            { id: 2, student: "Carlos Pérez", category: "bebidas", items: [{ name: "Jugo de naranja", quantity: 1, price: 2 }], total: 2, prepared: true, date: new Date(2023, 4, 15, 11, 15) },
            { id: 3, student: "María Rodríguez", category: "otros", items: [{ name: "Lápiz", quantity: 2, price: 0.5 }, { name: "Cuaderno", quantity: 1, price: 3 }], total: 4, prepared: false, date: new Date(2023, 4, 14, 9, 45) },
        ];

        function renderOrders(filteredOrders) {
            const orderList = document.getElementById('orderList');
            orderList.innerHTML = '';

            filteredOrders.forEach(order => {
                const orderElement = document.createElement('div');
                orderElement.className = 'bg-white rounded-lg shadow-md p-6 transition-all duration-300 hover:shadow-lg';
                orderElement.innerHTML = `
                    <h2 class="text-xl font-semibold mb-2">${order.student}</h2>
                    <p class="text-sm text-gray-600 mb-2">Categoría: ${order.category}</p>
                    <p class="text-sm text-gray-600 mb-2">Fecha: ${order.date.toLocaleString()}</p>
                    <ul class="mb-4">
                        ${order.items.map(item => `<li>${item.name} x${item.quantity} - $${item.price.toFixed(2)}</li>`).join('')}
                    </ul>
                    <p class="font-bold mb-4">Total: $${order.total.toFixed(2)}</p>
                    <button onclick="togglePrepared(${order.id})" class="px-4 py-2 rounded-md ${order.prepared ? 'bg-green-500 hover:bg-green-600' : 'bg-yellow-500 hover:bg-yellow-600'} text-white transition-colors duration-300">
                        ${order.prepared ? 'Preparado' : 'Marcar como preparado'}
                    </button>
                `;
                orderList.appendChild(orderElement);
            });
        }

        function filterOrders() {
            const categoryFilter = document.getElementById('categoryFilter').value;
            const timeFilter = document.getElementById('timeFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();

            const now = new Date();
            const oneDayAgo = new Date(now.getTime() - (24 * 60 * 60 * 1000));

            let filteredOrders = orders.filter(order => {
                const categoryMatch = !categoryFilter || order.category === categoryFilter;
                const timeMatch = !timeFilter || 
                    (timeFilter === 'recent' && order.date >= oneDayAgo) || 
                    (timeFilter === 'previous' && order.date < oneDayAgo);
                const searchMatch = !searchTerm || 
                    order.student.toLowerCase().includes(searchTerm) || 
                    order.items.some(item => item.name.toLowerCase().includes(searchTerm));

                return categoryMatch && timeMatch && searchMatch;
            });

            renderOrders(filteredOrders);
        }

        function togglePrepared(orderId) {
            const order = orders.find(o => o.id === orderId);
            if (order) {
                order.prepared = !order.prepared;
                filterOrders(); // Re-render the orders
            }
        }

        // Event listeners
        document.getElementById('categoryFilter').addEventListener('change', filterOrders);
        document.getElementById('timeFilter').addEventListener('change', filterOrders);
        document.getElementById('searchInput').addEventListener('input', filterOrders);

        // Initial render
        renderOrders(orders);
    </script>

<footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="../assets/imagenes/SchoolSnackPrototipo.png" alt="SchoolSnackLogo" width="100">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>INFORMACIÓN DE CONTACTO</h2>
                <p>Dirección: Carrera 44 A Nro. 93 - 87 Barrio Manrique La Salle</p>
                <p>Medellín, Antioquia - Colombia</p>
                <p>Correo Electronico: aperitivoescolar412@gmail.com</p>
                <p>Numero telefonico: N/A</p>
            </div>
            <div class="box">
                <h2>SIGUENOS</h2>
                <div class="red-social">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-youtube"></a>
                </div>
            </div>
        </div>
        <div class="grupo-2">
            <small>&copy; 2024 <b>Aperitivo Escolar</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
    <script src="../assets/javascript/loader.js"></script>
    <script src="../assets/javascript/script_cb.js"></script>
    <script src="../assets/javascript/script_preview.js"></script>
    <script src="../assets/javascript/script_carritoag.js"></script>
    <script src="../assets/javascript/carrito.js"></script>

    <div id="chatbot" class="fixed bottom-8 right-8 z-50">
    <!-- Icono del Chatbot -->
    <button id="chatbot-toggle" class="w-16 h-16 bg-orange-500 rounded-full shadow-lg hover:bg-orange-600 transition-all duration-300 flex items-center justify-center group">
        <i class="fas fa-comments text-white text-2xl group-hover:scale-110 transition-transform"></i>
    </button>

    <!-- Ventana del Chatbot -->
    <div id="chatbot-window" class="hidden fixed bottom-28 right-8 w-96 bg-white rounded-xl shadow-2xl transition-all duration-300">
        <!-- Encabezado -->
        <div class="bg-orange-500 p-4 rounded-t-xl flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <img src="../assets/imagenes/SchoolSnackPrototipo.png" alt="SchoolSnack Bot" class="w-8 h-8">
                </div>
                <div class="text-white">
                    <h3 class="font-bold">SchoolSnack Bot</h3>
                    <p class="text-sm">Siempre en línea</p>
                </div>
            </div>
            <button id="close-chat" class="text-white hover:bg-orange-600 p-2 rounded-full">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Mensajes -->
        <div id="chat-messages" class="h-80 overflow-y-auto p-4 space-y-4">
            <!-- Los mensajes se agregarán aquí dinámicamente -->
        </div>

        <!-- Input -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex gap-2">
                <input type="text" id="user-input" 
                       class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-orange-500"
                       placeholder="Escribe tu mensaje...">
                <button id="send-message" 
                        class="px-4 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600 transition-colors">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>