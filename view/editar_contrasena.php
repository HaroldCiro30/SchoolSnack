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
    <title>Perfil de Usuario - Aperitivo Escolar</title>
    <link rel="stylesheet" href="../assets/css/style15.css">
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

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

<!-- Contenedor principal -->
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <!-- Contenedor de objetos -->
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <!-- Título -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Cambiar Contraseña</h2>

        <!-- Formulario -->
        <form id="passwordForm" class="space-y-4" method="POST" action="../controller/functions/users/editar_contra.php">
    <!-- Contraseña actual -->
    <div>
        <label for="currentPassword" class="text-sm font-medium text-gray-700">Contraseña Actual</label>
        <input type="password" id="currentPassword" name="currentPassword" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <!-- Nueva contraseña -->
    <div>
        <label for="newPassword" class="text-sm font-medium text-gray-700">Nueva Contraseña</label>
        <input type="password" id="newPassword" name="newPassword" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <!-- Confirmar nueva contraseña -->
    <div>
        <label for="confirmPassword" class="text-sm font-medium text-gray-700">Confirmar Nueva Contraseña</label>
        <input type="password" id="confirmPassword" name="confirmPassword" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition duration-300">Cambiar Contraseña</button>
</form>
    </div>
</div>

<script>
    function validateForm() {
    const currentPassword = document.getElementById("currentPassword").value;
    const newPassword = document.getElementById("newPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const errorMessage = document.getElementById("errorMessage");
    const successMessage = document.getElementById("successMessage");

    if (newPassword !== confirmPassword) {
        errorMessage.classList.remove("hidden");
        successMessage.classList.add("hidden");
        return;
    } else {
        errorMessage.classList.add("hidden");
    }

    fetch("cambiar_contrasena.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `currentPassword=${encodeURIComponent(currentPassword)}&newPassword=${encodeURIComponent(newPassword)}`
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes("Contraseña actualizada correctamente")) {
            successMessage.classList.remove("hidden");
        } else {
            errorMessage.textContent = data;
            errorMessage.classList.remove("hidden");
            successMessage.classList.add("hidden");
        }
    })
    .catch(error => console.error("Error:", error));
}
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
    <script src="../assets/javascript/main.js"></script>
</body>
</html>