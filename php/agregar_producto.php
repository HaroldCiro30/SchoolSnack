<?php

session_start();
include 'conexion_productos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir datos del formulario de productos
    $cantidad = $_POST['Cantidad'];
    $producto = $_POST['Producto'];
    $disponibilidad = $_POST['Disponibilidad'];

    // Verificar que el nombre del producto no se repita en la base de datos
    $verificar_producto = mysqli_query($conexion, "SELECT * FROM productos WHERE producto='$producto' ");

    if (mysqli_num_rows($verificar_producto) > 0) {
        echo '
            <script>
                alert("Este producto ya está registrado, ¡Intenta con otro diferente!");
                window.location = "../assets/views/stockproductos.php";
            </script>
        ';
        exit();
    }

    // Insertar el nuevo producto en la base de datos
    $query = "INSERT INTO productos (cantidad, producto, disponibilidad) 
                VALUES ('$cantidad', '$producto', '$disponibilidad')";

    $ejecutar = mysqli_query($conexion, $query);

    if ($ejecutar) {
        echo '
        <script>
            alert("Producto registrado exitosamente.");
            window.location = "../assets/views/stockproductos.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Inténtalo de nuevo, producto no registrado");
            window.location = "../assets/views/stockproductos.php";
        </script>
        ';
    }
}
?>
