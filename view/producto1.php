<?php 

    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Por favor debes iniciar sesión");
                window.location = "../assets/index.php";
            </script>
            ';
            header("location: ../assets/index.php");
            session_destroy();
            die();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/producto1.css">
    <link rel="icon" type="image/png" href="../imagenes/SchoolSnackPrototipo.png">
    <title>PRODUCTO 1</title>
    <script type="text/javascript" src="https://me.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=ASplm5v-IpYU2VAAG7IiKJ3nolHevU8mgmKlWuRfMudbF0LQmviOsGjngqWS1KWGoFe6zjOCaPKRs1-TFB0mWdfdwrwKcGVYj7iSR_qrEVSfXCLhp-1Ug_u-ffWyH5NnCZATQvSH-aXEiLUVnMqB64vM3d5-yVIDX__NRN4xVoDK6GFUgB7lcKXS3HjaMcARoyxM7kAum7oQbyQZJSA-XZgbHPMsy-Ol_qFxtGpseUx_fHkSL8HDyLKe-MmeGemBjYsoJbS2TiHFpOjm8AzHZtfbmOicDqC9To8EY2ie5IsdGtfdMe9Nrr37Q-pdaKO7x7PrMRHGz4URtpUeudmyGw" charset="UTF-8"></script><script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav>
          <img src="../imagenes/SchoolSnackPrototipo.png" width="75" id="logo-nav"></a>
            <a href="">Elemento Dos</a>
            <a href="">Acerca de Nosotros</a>
            <a href=""><?php echo ucwords($_SESSION['usuario']);?></a>
            <a href="../../php/cerrar_sesión.php">Cerrar Sesión</a>
          </nav>        
    </header>

    <main>
    <section class="imagen-producto">
        

    </section>

    <section class="informacion-producto">
        <h2>HAMBURGUESA</h2>
        <p>PRECIO: 3500$</p>
    </section>
    
    <div class="contenedor-comprar">
        <a href="pago.html" class="comprar">Comprar producto</a>
    </div>
</main>

    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="../imagenes/SchoolSnackPrototipo.png" alt="SchoolSnackLogo" width="100">
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