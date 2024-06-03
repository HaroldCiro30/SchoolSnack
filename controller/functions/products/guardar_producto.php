<?php
include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = $_POST['cantidad'];
    $producto = $_POST['producto'];

    // Preparar la consulta SQL para insertar el nuevo producto
    $sql = "INSERT INTO productos (cantidad, producto) VALUES ('$cantidad', '$producto')";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo '
        <script>
            alert("Producto creado");
            window.location = "../../../view/productos.php";
        </script>
        ';
    } else {
        echo "Error al agregar el producto: " . $conn->error;
    }
}
?>
