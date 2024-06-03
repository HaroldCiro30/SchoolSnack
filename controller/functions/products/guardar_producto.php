<?php
include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = $_POST['cantidad'];
    $producto = $_POST['producto'];

    // Manejar la carga del archivo
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $carpetaDestino = "../../../uploads/";
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $rutaArchivo = $carpetaDestino . $nombreArchivo;
        $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));
        
        // Verificar si el archivo es una imagen
        $check = getimagesize($_FILES['imagen']['tmp_name']);
        if ($check !== false) {
            // Mover el archivo a la carpeta destino
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
                echo "El archivo ha sido subido.";
            } else {
                echo "Hubo un error subiendo tu archivo.";
            }
        } else {
            echo "El archivo no es una imagen.";
        }
    } else {
        echo "No se subió ningún archivo o hubo un error.";
    }

    // Preparar la consulta SQL para insertar el nuevo producto
    $sql = "INSERT INTO productos (cantidad, producto, imagen) VALUES ('$cantidad', '$producto', '$nombreArchivo')";

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
