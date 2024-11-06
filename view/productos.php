<?php
session_start();

// Verificar si no hay una sesión activa, redirigir al usuario al inicio de sesión
if (!isset($_SESSION['usuario'])) {
    echo '
            <script>
                alert("Por favor debes iniciar sesión");
                window.location = "../index.php";
            </script>
            ';
    header("Location: ../index.php");
    exit(); // Detener la ejecución del script después de redirigir
}

include '../controller/db.php'; // Incluir la conexión a la base de datos

// Consulta todos los productos de la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Administración de Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style13.css">
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
</nav>

    <script src="../assets/javascript/main.js"></script>
  </header>
  
    <div class="encabezado text-center">
        <h1 class="my-4">Administración de Productos</h1>
        <a href="../view/form_products.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar Producto</a>
        <a href="../controller/functions/users/cerrar_sesion.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cerrar Sesión</a>
    </div>
    <br><br>
    <?php if ($result->num_rows > 0) : ?>
        <table class="table-auto border-collapse border border-gray-400 mx-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Producto</th>
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Cantidad</th>
                    <th class="px-4 py-2">Disponibilidad</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) :
                ?>
                    <tr>
                        <td class="border px-4 py-2"><?php echo $row['id']; ?></td>
                        <td class="border px-4 py-2 capitalize"><?php echo $row['producto']; ?></td>
                        <td class="border px-4 py-2">
                            <img src="../uploads/<?php echo $row['imagen']; ?>" alt="Imagen de Producto" style="width: 100px; height: auto;">
                        </td>
                        <td class="border px-4 py-2"><?php echo $row['cantidad']; ?></td>
                        <td class="border px-4 py-2 capitalize <?php echo $row['cantidad'] == 0 ? 'text-red-500' : 'text-green-500'; ?>">
                            <?php echo $row['cantidad'] == 0 ? 'Agotado' : 'Disponible'; ?>
                        </td>
                        <td class="border px-4 py-2">
                            <a href="./editar_producto.php?id=<?php echo $row['id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                            <a href="../controller/functions/products/eliminar_producto.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="text-center text-gray-600">No hay productos</p>
    <?php endif; ?>

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