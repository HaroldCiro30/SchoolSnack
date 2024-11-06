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
    <nav class="bg-black text-white py-4 px-6 flex justify-between items-center">
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

  <main class="container mx-auto px-6 py-8">
	 <?php
            include '../controller/db.php'; 

            $usuario_actual = $_SESSION['usuario'];

            $sql = "SELECT nombre_completo, correo, usuario, imagen FROM usuarios WHERE usuario='$usuario_actual'";
            $resultado = mysqli_query($conn, $sql);

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                $fila = mysqli_fetch_assoc($resultado);
                $nombre_completo = $fila['nombre_completo'];
                $correo = $fila['correo'];
                $usuario = $fila['usuario'];
                $rutaImagen = '../uploads/' . $fila['imagen']; 
            } else {
                $nombre_completo = "Nombre no disponible";
                $correo = "Correo no disponible";
                $usuario = "Usuario no disponible";
                $rutaImagen = '../../../uploads/default.png'; 
            }
            ?>


        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="md:flex">
                <div class="md:flex-shrink-0">
                    <img class="h-48 w-full object-cover md:w-48" src="<?php echo $rutaImagen; ?>" alt="Imagen de perfil">
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-orange-500 font-semibold">Perfil de Usuario</div>
                    <h1 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        <?php echo $nombre_completo; ?>
                    </h1>
                    <p class="mt-2 text-lg text-gray-600">@<?php echo $usuario; ?></p>
                    <p class="mt-2 text-gray-500"><?php echo $correo; ?></p>
                    <div class="mt-4 flex space-x-3">
                        <a href="editar_perfil.php"><button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Editar Perfil
                        </button></a>
                        <a href="editar_contrasena.php"><button href="editar_contrasena.php" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded transition duration-300">
                            Cambiar Contraseña
                        </button></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nombre completo</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo $nombre_completo; ?></dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Usuario</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo $usuario; ?></dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Correo electrónico</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo $correo; ?></dd>
                    </div>
                </dl>
            </div>
        </div>
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
    <script src="../assets/javascript/main.js"></script>
</body>
</html>