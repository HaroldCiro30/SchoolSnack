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
    <title>Perfil de Usuario - Aperitivo Escolar</title>
    <link rel="stylesheet" href="../assets/css/style12.css">
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

</head>
<body>

<div class="loader-section">
  <span class="loader"></span>
</div>

<header>
<div class="encabezado text-center">
    <header>
    <nav class="bg-black text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
      <div>
        <img src="logo.png" alt="Logo" class="h-10">
      </div>

      <div class="hidden md:flex space-x-8">
        <a href="paginaprincipal.php" class="hover:text-gray-400">Aperitivo</a>
        <a href="aboutus.php" class="hover:text-gray-400">Acerca de Nosotros</a>
        <a href="productos.php" class="hover:text-gray-400">Administrar</a>
      </div>

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

    <div id="menu" class="hidden md:hidden mt-4 space-y-4 slide-down">
      <a href="#" class="block text-white hover:bg-gray-700 p-2 rounded">Aperitivo</a>
      <a href="#" class="block text-white hover:bg-gray-700 p-2 rounded">Acerca de Nosotros</a>
      <a href="#" class="block text-white hover:bg-gray-700 p-2 rounded">Administrar</a>
      <a href="#" class="block text-white hover:bg-gray-700 p-2 rounded">Perfil</a>
    </div>
  </nav>
</header>
    <main>
      <section class="card">
          <div class="foto">
          </div>
          <div class="info">
            <p>Nombre completo:</p>
            <p>Correo:</p>
          </div>
      </section>
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
    <script src="../assets/javascript/loader.js"></script>
    <script src="../assets/javascript/main.js"></script>
</body>
</html>