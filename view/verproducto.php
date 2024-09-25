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
<body>
    <header>
        <h1>Producto</h1>
        <nav>
        <a href="aboutus.html">Acerca de Nosotros</a>
        <a href=""><?php echo ucwords($_SESSION['usuario']); ?></a>
        <a href="../controller/functions/users/cerrar_sesion.php">Cerrar Sesión</a>
        <img src="../assets/imagenes/SchoolSnackPrototipo.png" alt="Aperitivo Escolar" class="logo">
        </nav>
    </header>
    
    <main>
        <section class="producto-info">
            <div class="producto-cuadro">
                <p>En este cuadro mostrar el producto seleccionado.</p>
            </div>
            <div class="producto-detalles">
                <p><strong>Producto:</strong> </p>
                <p><strong>Precio:</strong> </p>
                <p><strong>Disponible:</strong> </p>
                <button>COMPRAR</button>
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
</body>
</html>