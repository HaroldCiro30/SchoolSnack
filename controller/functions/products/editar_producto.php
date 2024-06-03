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

include '../controller/db.php';

// Verificar si se recibió un ID válido por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta el producto específico por su ID
    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error al ejecutar la consulta: " . $conn->error;
        exit();
    }

    // Verificar si se encontró el producto
    if ($result->num_rows === 1) {
        $producto = $result->fetch_assoc();
    } else {
        echo '
        <script>
            alert("Producto no encontrado");
            window.location = "../../../view/productos.php";
        </script>
        ';
    }
} else {
    echo '
        <script>
            alert("ID no encontrado");
            window.location = "../../../view/productos.php";
        </script>
        ';
    exit();
}

// Procesar la actualización del producto si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = $_POST['cantidad'];
    $nombre = $_POST['nombre'];

    // Preparar la consulta SQL para actualizar el producto
    $sql = "UPDATE productos SET cantidad = '$cantidad', producto = '$nombre' WHERE id = $id";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo '
        <script>
            alert("Producto modificado correctamente");
            window.location = "../../../view/productos.php";
        </script>
        ';
        exit();
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }
}
?>
