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

include '../controller/db.php'; // Incluir la conexión a la base de datos

// Consulta todos los productos de la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal - SS</title>
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="icon" type="image/png" href="../assets/imagenes/SchoolSnackPrototipo.png">
    <script type="text/javascript" src="https://me.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=ASplm5v-IpYU2VAAG7IiKJ3nolHevU8mgmKlWuRfMudbF0LQmviOsGjngqWS1KWGoFe6zjOCaPKRs1-TFB0mWdfdwrwKcGVYj7iSR_qrEVSfXCLhp-1Ug_u-ffWyH5NnCZATQvSH-aXEiLUVnMqB64vM3d5-yVIDX__NRN4xVoDK6GFUgB7lcKXS3HjaMcARoyxM7kAum7oQbyQZJSA-XZgbHPMsy-Ol_qFxtGpseUx_fHkSL8HDyLKe-MmeGemBjYsoJbS2TiHFpOjm8AzHZtfbmOicDqC9To8EY2ie5IsdGtfdMe9Nrr37Q-pdaKO7x7PrMRHGz4URtpUeudmyGw" charset="UTF-8"></script>
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-orange-50">
    
<div class="loader-section">
  <span class="loader"></span>
</div>


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

<div class="bg-gradient-to-r from-orange-800 via-orange-700 to-yellow-200 text-white py-12 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-semibold mb-4 transition-all duration-700 ease-in-out transform hover:-translate-y-1 hover:text-gray-300">
            ¡Bienvenidos a SchoolSnack!
        </h1>
        <p class="text-lg md:text-xl opacity-80 transition-opacity duration-700 ease-in-out hover:opacity-100">
            Tu tienda escolar favorita ahora en línea
        </p>
    </div>
</div>

    <!-- Categories -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex overflow-x-auto gap-4 pb-4 mb-8">
            <button class="px-6 py-2 bg-orange-500 text-white rounded-full whitespace-nowrap hover:bg-orange-600 transition-colors">
                Todos los productos
            </button>
            <button class="px-6 py-2 bg-white text-gray-700 rounded-full whitespace-nowrap hover:bg-gray-100 transition-colors">
                Snacks
            </button>
            <button class="px-6 py-2 bg-white text-gray-700 rounded-full whitespace-nowrap hover:bg-gray-100 transition-colors">
                Bebidas
            </button>
            <button class="px-6 py-2 bg-white text-gray-700 rounded-full whitespace-nowrap hover:bg-gray-100 transition-colors">
                Dulces
            </button>
            <button class="px-6 py-2 bg-white text-gray-700 rounded-full whitespace-nowrap hover:bg-gray-100 transition-colors">
                Fritos
            </button>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product Card -->
            <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="https://via.placeholder.com/300x200" alt="Empanada" class="w-full h-48 object-cover">
                    <span class="absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded-full text-sm font-semibold">
                        Más vendido
                    </span>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold">Empanada</h3>
                        <span class="text-orange-500 font-bold">$2.000</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-sm text-gray-500 ml-2">(250 reseñas)</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Deliciosa empanada criolla rellena de carne y papa</p>
                    <div class="flex gap-2">
                        <button class="flex-1 bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition-colors">
                            Comprar ahora
                        </button>
                        <button onclick="addToCart('Empanada', 2000)" class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="../assets/imagenes/empanada.png" alt="Empanada" class="w-full h-48 object-cover">
                    <span class="absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded-full text-sm font-semibold">
                        Más vendido
                    </span>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold">Empanada</h3>
                        <span class="text-orange-500 font-bold">$2.000</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-sm text-gray-500 ml-2">(250 reseñas)</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Deliciosa empanada criolla rellena de carne y papa</p>
                    <div class="flex gap-2">
                        <button class="flex-1 bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition-colors">
                            Comprar ahora
                        </button>
                        <button onclick="addToCart('Empanada', 2000)" class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Puedes agregar más tarjetas de producto aquí -->
             <div class="product-cards-container">
    <?php
    // Loop para cada producto en el resultado de la consulta
    while ($row = $result->fetch_assoc()) :
    ?>
        <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden mb-4">
            <div class="relative">
                <img src="../uploads/<?php echo $row['imagen']; ?>" alt="Imagen de <?php echo $row['nombre']; ?>" class="w-full h-48 object-cover"> 
                <!-- Agregar la etiqueta "Más vendido" solo si cumple una condición -->
                <?php if ($row['cantidad'] > 10) : ?>
                    <span class="absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded-full text-sm font-semibold">
                        Más vendido
                    </span>
                <?php endif; ?>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-lg font-semibold"><?php echo ucfirst($row['nombre']); ?></h3>
                    <span class="text-orange-500 font-bold"><?php echo "$" . number_format($row['precio'], 2); ?></span>
                </div>
                <div class="flex items-center mb-2">
                    <!-- Mostrar rating como número -->
                    <span class="text-sm text-gray-500 ml-2"><?php echo $row['rating']; ?> / 5</span>
                </div>
                <p class="text-sm text-gray-600 mb-4"><?php echo ucfirst($row['descripcion']); ?></p>
                <div class="flex gap-2">
                    <button class="flex-1 bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition-colors">
                        Comprar ahora
                    </button>
                    <button onclick="addToCart('<?php echo $row['nombre']; ?>', <?php echo $row['precio']; ?>)" class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
                <p class="text-sm mt-2 <?php echo $row['cantidad'] == 0 ? 'text-red-500' : 'text-green-500'; ?>">
                    <?php echo $row['cantidad'] == 0 ? 'Agotado' : 'Disponible'; ?>
                </p>
            </div>
        </div>
    <?php endwhile; ?>
</div>
             
        </div>
    </div>

            <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl max-w-2xl w-full mx-4 overflow-hidden shadow-2xl transform transition-all">
        <!-- Modal header -->
        <div class="relative p-6 border-b">
            <h3 class="text-2xl font-semibold text-gray-900">Confirmar compra</h3>
            <button onclick="closeModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal content -->
        <div class="p-6">
            <div class="flex gap-6">
                <!-- Product image -->
                <div class="w-1/3">
                    <img src="../assets/imagenes/empanada.png" alt="Empanada" class="w-full h-auto rounded-lg">
                </div>
                
                <!-- Product details -->
                <div class="w-2/3">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900">Empanada</h4>
                            <div class="flex items-center mt-2">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-sm text-gray-500 ml-2">(250 reseñas)</span>
                            </div>
                        </div>
                        <span class="text-2xl font-bold text-orange-500">$2.000</span>
                    </div>
                    
                    <p class="text-gray-600 mb-6">Deliciosa empanada criolla rellena de carne y papa</p>
                    
                    <!-- Quantity selector -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cantidad</label>
                        <div class="flex items-center gap-4">
                            <button onclick="updateQuantity(-1)" class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center hover:border-orange-500 hover:text-orange-500 transition-colors">
                                -
                            </button>
                            <span id="quantity" class="text-xl font-semibold min-w-[2rem] text-center">1</span>
                            <button onclick="updateQuantity(1)" class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center hover:border-orange-500 hover:text-orange-500 transition-colors">
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Total price -->
                    <div class="flex justify-between items-center py-4 border-t border-b mb-6">
                        <span class="text-gray-600">Total:</span>
                        <span id="totalPrice" class="text-2xl font-bold text-orange-500">$2.000</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="p-6 bg-gray-50 flex gap-4 justify-end">
            <button onclick="closeModal()" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                Cancelar
            </button>
            <button onclick="confirmPurchase()" class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                Confirmar compra
            </button>
        </div>
    </div>
</div>
        
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