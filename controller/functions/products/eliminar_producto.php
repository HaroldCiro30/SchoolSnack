<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '
            <script>
                alert("Por favor debes iniciar sesión");
                window.location = "../index.php";
            </script>
            ';
    header("Location: ../../../index.php");
    exit();
}

include '../../db.php';

// Verificar si se recibió un ID válido por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Preparar la consulta SQL para eliminar el producto
    $sql = "DELETE FROM productos WHERE id = $id";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo '
        <script>
            alert("Producto eliminado correctamente");
            window.location = "../../../view/productos.php";
        </script>
        ';
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
} else {
    echo "ID de producto no válido";
}
?>
