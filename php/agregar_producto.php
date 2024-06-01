<?php

session_start();
include 'conexion_productos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $cantidad = $_POST['Cantidad'];
    $producto = $_POST['Producto'];
    $disponibilidad = $_POST['Disponibilidad'];

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

    $query = "INSERT INTO productos (cantidad, producto, disponibilidad) 
                VALUES ('$cantidad', '$producto', '$Disponibilidad')";

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
