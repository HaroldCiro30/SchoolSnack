<?php
session_start();
include __DIR__ . '/../../php/conexion_productos.php';

// Verificar si la conexión está establecida
if ($conexion === null) {
    die("Error: No se pudo establecer la conexión a la base de datos.");
}

$result = $conexion->query("SELECT * FROM productos");
echo "<main><table border='1'>
<tr>
<th>ID</th>
<th>Cantidad</th>
<th>Producto</th>
<th>Disponibilidad</th>
<th>Cambios</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['Cantidad'] . "</td>";
    echo "<td>" . $row['Producto'] . "</td>";
    echo "<td>" . ($row['Disponibilidad'] ? 'Si' : 'No') . "</td>";
    echo "<td>";
    echo "<form method='post' action='../../php/editar_producto.php'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<input type='number' name='nueva_cantidad' value='" . $row['Cantidad'] . "' required>";
    echo "<input type='text' name='nuevo_producto' value='" . $row['Producto'] . "' required>";
    echo "<input type='text' name='nueva_disponibilidad' value='" . $row['Disponibilidad'] . "' required>";
    echo "<button type='submit' name='editar'>Editar</button>";
    echo "</form>";
    echo "<form method='post' action='../../php/eliminar_producto.php'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<button type='submit' name='eliminar'>Eliminar</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</table></main>";

$conexion->close();
?>


<!DOCTYPE html>
<html lang="en">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stock de Productos - SS</title>    
        <link rel="stylesheet" href="../css/style9.css">
        <link rel="icon" type="image/png" href="/assets/imagenes/SchoolSnackPrototipo.png">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="../javascript/producto.js"></script>
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

    <form method="post" action="../../php/agregar_producto.php">
            <label for="Cantidad">Cantidad del Producto:</label>
            <input type="number" name="Cantidad" required>
            <br>

            <label for="Producto">Producto:</label>
            <input type="text" name="Producto" required>
            <br>

            <label for="Disponibilidad">Disponibilidad</label>
            <input list="Disponibilidad" name="Disponibilidad" placeholder="1 Para si, 0 Para no">
            <datalist id="Disponibilidad">
                <option value="1">
                <option value="0">
            </datalist>

            <input type="submit" value="Agregar Producto">
        </form>
    

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