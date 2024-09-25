<?php $ruta_archivo = '../controller/functions/products/editar/editar_producto.php'; include $ruta_archivo; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
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
          <a href="#" class="block px-4 py-2 hover:bg-gray-100">Perfil</a>
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

  <script src="../assets/javascript/main.js"></script>
    </nav>  
    </header> 
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Editar Producto</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>" method="post">
            <div class="mb-4">
                <label for="producto" class="block text-gray-700 font-bold mb-2">Producto:</label>
                <input type="text" id="producto" name="producto" 
                    value="<?php echo isset($producto['producto']) ? $producto['producto'] : ''; ?>" 
                    required class="border rounded-md px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="cantidad" class="block text-gray-700 font-bold mb-2">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" 
                    value="<?php echo isset($producto['cantidad']) ? $producto['cantidad'] : ''; ?>" 
                    required class="border rounded-md px-4 py-2 w-full">
            </div>
            <input type="submit" value="Actualizar Producto" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        </form>
    </div>
</body>
</html>
