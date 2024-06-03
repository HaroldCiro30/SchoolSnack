<?php
session_start();

// Verificar si no hay una sesión activa, redirigir al usuario al inicio de sesión
if (!isset($_SESSION['usuario'])) {
    echo '
            <script>
                alert("Por favor debes iniciar sesión");
                window.location = "../index.php";
            </script>
            ';
    header("Location: ../index.php");
    exit(); // Detener la ejecución del script después de redirigir
}

include '../controller/db.php'; // Incluir la conexión a la base de datos

// Consulta todos los productos de la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Administración de Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="encabezado text-center">
        <h1 class="my-4">Administración de Productos</h1>
        <a href="../view/form_products.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar Producto</a>
        <a href="../controller/functions/users/cerrar_sesion.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cerrar Sesión</a>
    </div>
    <br><br>
    <?php if ($result->num_rows > 0) : ?>
        <table class="table-auto border-collapse border border-gray-400 mx-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Producto</th>
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Cantidad</th>
                    <th class="px-4 py-2">Disponibilidad</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) :
                ?>
                    <tr>
                        <td class="border px-4 py-2"><?php echo $row['id']; ?></td>
                        <td class="border px-4 py-2 capitalize"><?php echo $row['producto']; ?></td>
                        <td class="border px-4 py-2">
                            <img src="../uploads/<?php echo $row['imagen']; ?>" alt="Imagen de Producto" style="width: 100px; height: auto;">
                        </td>
                        <td class="border px-4 py-2"><?php echo $row['cantidad']; ?></td>
                        <td class="border px-4 py-2 capitalize <?php echo $row['cantidad'] == 0 ? 'text-red-500' : 'text-green-500'; ?>">
                            <?php echo $row['cantidad'] == 0 ? 'Agotado' : 'Disponible'; ?>
                        </td>
                        <td class="border px-4 py-2">
                            <a href="./editar_producto.php?id=<?php echo $row['id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                            <a href="../controller/functions/products/eliminar_producto.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="text-center text-gray-600">No hay productos</p>
    <?php endif; ?>
</body>

</html>