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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactanos!</title>
    <link rel="icon" type="image/png" href="../assets/imagenes/SchoolSnackPrototipo.png">
    <script type="text/javascript" src="https://me.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=ASplm5v-IpYU2VAAG7IiKJ3nolHevU8mgmKlWuRfMudbF0LQmviOsGjngqWS1KWGoFe6zjOCaPKRs1-TFB0mWdfdwrwKcGVYj7iSR_qrEVSfXCLhp-1Ug_u-ffWyH5NnCZATQvSH-aXEiLUVnMqB64vM3d5-yVIDX__NRN4xVoDK6GFUgB7lcKXS3HjaMcARoyxM7kAum7oQbyQZJSA-XZgbHPMsy-Ol_qFxtGpseUx_fHkSL8HDyLKe-MmeGemBjYsoJbS2TiHFpOjm8AzHZtfbmOicDqC9To8EY2ie5IsdGtfdMe9Nrr37Q-pdaKO7x7PrMRHGz4URtpUeudmyGw" charset="UTF-8"></script>
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style14.css">
</head>

<body class="bg-gradient-to-r from-orange-200 via-red-100 to-orange-300">

<div class="loader-section">
  <span class="loader"></span>
</div>

<header>
    <nav class="bg-black text-white py-4 px-6 flex justify-between items-center">
  <div class="flex items-center">
    <!-- Logo -->
    <img src="../assets/imagenes/SchoolSnackPrototipo.png" alt="Logo" class="h-10 w-auto" href="paginaprincipal.php">
  </div>
  
  <!-- Menú de navegación -->
  <div class="hidden md:flex space-x-8">
    <a href="paginaprincipal.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Inicio</a>
    <a href="aboutus.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Acerca de Nosotros</a>
    <a href="productos.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Administrar</a>
    <a href="contactanos.php" class="text-lg font-semibold hover:text-orange-400 transition duration-300">Contactanos</a>
  </div>

  <!-- Icono de usuario (posiblemente con un dropdown) -->
 
  <div class="relative">
        <button id="profile-btn" class="hidden md:flex items-center focus:outline-none">
        <?php
include '../controller/db.php'; // Incluir la conexión a la base de datos

// Obtener el usuario actual desde la sesión, por ejemplo
$usuario_actual = $_SESSION['usuario'];

// Consultar la base de datos para obtener la imagen del perfil
$sql = "SELECT imagen FROM usuarios WHERE usuario='$usuario_actual'";
$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $rutaImagen = '../uploads/' . $fila['imagen']; // Ruta de la imagen en la base de datos
} else {
    // Imagen predeterminada si no hay imagen del usuario
    $rutaImagen = '../../../uploads/default.png';
}

?>

<!-- Mostrar la imagen del perfil -->
<img src="<?php echo $rutaImagen; ?>" alt="Imagen de perfil" class="profile-image" style="width: 50px; height: 50px; border-radius: 50%; object-fit: fill;">

        </button>

        <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-black text-white rounded-lg shadow-lg py-2">
          <div class="px-4 py-2">
          <?php
include '../controller/db.php'; // Asegúrate de tener la conexión a la base de datos activa
// Obtener el usuario actual desde la sesión
$usuario_actual = $_SESSION['usuario'];

// Consultar la base de datos para obtener la imagen, nombre completo, correo y usuario
$sql = "SELECT correo FROM usuarios WHERE usuario='$usuario_actual'";
$resultado = mysqli_query($conn, $sql);

// Verificar si hay resultados y obtener los datos
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

<!-- Menú móvil desplegable -->
<div id="mobile-menu" class="hidden md:hidden bg-black text-white py-2">
  <a href="#aperitivo" class="block px-4 py-2 text-lg hover:bg-orange-500">Aperitivo</a>
  <a href="#acerca" class="block px-4 py-2 text-lg hover:bg-orange-500">Acerca de Nosotros</a>
  <a href="#admin" class="block px-4 py-2 text-lg hover:bg-orange-500">Administrar</a>
</div>
</nav>

    <script src="../assets/javascript/main.js"></script>
  </header>

    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">¡Mensaje Enviado!</h2>
            <p class="mb-6">Gracias por contactarnos. Nos pondremos en contacto contigo lo antes posible.</p>
            <button id="close-modal" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-300">Cerrar</button>
        </div>
    </div>

    <div id="form-all" class="bg-white shadow-lg rounded-lg max-w-4xl w-full p-8 mx-4 lg:mx-auto">
     <h1 class="text-4xl font-bold text-center mb-8 text-orange-500">Contáctanos</h1>
        <form id="contact-form" class="space-y-6">

            <div class="relative">
                <input type="text" id="name" name="name" class="peer bg-transparent border-b-2 border-gray-300 w-full px-4 py-2 focus:outline-none focus:border-orange-500" required>
                <label for="name" class="absolute left-4 top-3 text-gray-500 transition-all duration-200 peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:text-sm peer-focus:text-orange-500">Nombre completo</label>
            </div>


             <div class="relative">
                <input type="email" id="email" name="email" class="peer bg-transparent border-b-2 border-gray-300 w-full px-4 py-2 focus:outline-none focus:border-orange-500" required>
                <label for="email" class="absolute left-4 top-3 text-gray-500 transition-all duration-200 peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:text-sm peer-focus:text-orange-500">Correo electrónico</label>
             </div>


            <div class="relative">
                <textarea id="message" name="message" rows="4" class="peer bg-transparent border-b-2 border-gray-300 w-full px-4 py-2 focus:outline-none focus:border-orange-500" required></textarea>
                <label for="message" class="absolute left-4 top-3 text-gray-500 transition-all duration-200 peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:text-sm peer-focus:text-orange-500">Tu mensaje</label>
            </div>


            <div class="text-center">
                <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 transition duration-300">Enviar mensaje</button>
            </div>
        </form>
    </div>

<!-- Modal de confirmación -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">¡Mensaje Enviado!</h2>
        <p class="mb-6">Gracias por contactarnos. Nos pondremos en contacto contigo lo antes posible.</p>
        <button id="close-modal" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-300">Cerrar</button>
    </div>
</div>

        </form>
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
    <script src="../assets/javascript/contactanos.js"></script>
</body>
</html>