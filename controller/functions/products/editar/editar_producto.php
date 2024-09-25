<?php
session_start();

// Configuración de la base de datos (reemplaza con tus datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "schoolsnack";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Función para validar un producto
function validarProducto($producto, $cantidad) {
    // Validaciones básicas
    if (empty($producto) || empty($cantidad)) {
        return "Los campos producto y cantidad son obligatorios.";
    }

    // Validaciones adicionales (ajusta según tus necesidades)
    if (strlen($producto) > 50) {
        return "El nombre del producto es demasiado largo.";
    }
    if (!is_numeric($cantidad) || $cantidad <= 0) {
        return "La cantidad debe ser un número positivo.";
    }

    return true; // Si todas las validaciones pasan
}

// Verificar si se recibió un ID válido por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta el producto específico por su ID
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        die("Producto no encontrado.");
    }

    // Procesar la actualización del producto si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validar los datos del formulario
        $productoNombre = $_POST['producto'];
        $cantidad = $_POST['cantidad'];

        $validacion = validarProducto($productoNombre, $cantidad);
        if ($validacion !== true) {
            echo "Error: " . $validacion;
            exit();
        }

        // Actualizar el producto
        $stmt = $pdo->prepare("UPDATE productos SET producto = :producto, cantidad = :cantidad WHERE id = :id");
        $stmt->bindParam(':producto', $productoNombre);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            echo "Producto actualizado correctamente.
            <script>
                window.location.href = '/SchoolSnack-main/view/productos.php';
            </script>
            ";
            exit();
        } catch (PDOException $e) {
            echo "Error al actualizar el producto: " . $e->getMessage();
        }
    }

} else {
    echo "ID de producto inválido.";
}
?>