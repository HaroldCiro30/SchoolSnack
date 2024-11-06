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
    <title>Producto - Aperitivo Escolar</title>
    <link rel="stylesheet" href="../assets/css/style11.css">
    <script src="https://cdn.tailwindcss.com"></script>
<body>
<header>
    <nav class="bg-black text-white py-4 px-6 flex justify-between items-center">
  <div class="flex items-center">
    <!-- Logo -->
    <img src="../assets/imagenes/SchoolSnackPrototipo.png" alt="Logo" class="h-10 w-auto">
  </div>
  
  <!-- Menú de navegación -->
  <div class="hidden md:flex space-x-8">
    <a href="paginaprincipal.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Aperitivo</a>
    <a href="aboutus.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Acerca de Nosotros</a>
    <a href="productos.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Administrar</a>
  </div>

  <!-- Icono de usuario (posiblemente con un dropdown) -->
 
  <div class="relative">
        <button id="profile-btn" class="hidden md:flex items-center focus:outline-none">
          <img src="profile.jpg" alt="User Profile" class="h-10 w-10 rounded-full">
        </button>

        <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-black text-white rounded-lg shadow-lg py-2">
          <div class="px-4 py-2">
            <p class="font-bold"><?php echo ucwords($_SESSION['usuario']);?></p>
            <p class="text-sm text-gray-600"><?php echo isset($_SESSION['correo']) && !is_array($_SESSION['correo']) ? $_SESSION['correo'] : 'Correo no disponible'; ?></p>
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

<!-- Menú móvil desplegable -->
<div id="mobile-menu" class="hidden md:hidden bg-black text-white py-2">
  <a href="#aperitivo" class="block px-4 py-2 text-lg hover:bg-orange-500">Aperitivo</a>
  <a href="#acerca" class="block px-4 py-2 text-lg hover:bg-orange-500">Acerca de Nosotros</a>
  <a href="#admin" class="block px-4 py-2 text-lg hover:bg-orange-500">Administrar</a>
</div>
</nav>

    <script src="../assets/javascript/main.js"></script>
  </header>
    
    <main>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="relative">
    <img src="../assets/imagenes/empanada.png" alt="Producto" class="rounded-lg shadow-lg object-cover h-full w-full">
    <div class="absolute bottom-0 left-0 bg-white px-4 py-2 rounded-bl-lg">
        <span class="text-sm text-gray-500">En existencia</span>
    </div>
</div>
            <div class="space-y-4">
                <h2 class="text-3xl font-bold">Nombre del Producto</h2>
                <p class="text-gray-600">Descripción detallada del producto, incluyendo características y beneficios.</p>
                <div class="flex items-center">
                    <span class="text-2xl font-bold">$</span>
                    <span id="precio" class="ml-2 text-2xl font-bold">0.00</span>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Comprar
                </button>
            </div>
        </div>
    </div>

    <script src="../assets/javascript/script_comprar.js"></script>
    </main>

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
                <h2>SOBRE NOSOTROS</h2>
                <p>Somos una plataforma en línea revolucionaria que transforma la experiencia de compra en la tienda escolar. Hemos desarrollado una página web de pedidos para superar desafíos como la falta de variedad y horarios inadecuados.</p>
                <p>Ofrecemos conveniencia, visualización rápida de productos y menús, optimizando la gestión de inventario y eficiencia en el proceso de venta. Únete a nosotros para hacer la tienda escolar más eficiente, accesible y satisfactoria.</p>
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
            <small>&copy; 2024 <b>SchoolSnack</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
</body>
</html>