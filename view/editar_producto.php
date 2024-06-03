<?php include '../controller/functions/products/editar_producto.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Editar Producto</h1>
        <form method="post">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $producto['producto']; ?>" required class="border rounded-md px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="cantidad" class="block text-gray-700 font-bold mb-2">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required class="border rounded-md px-4 py-2 w-full">
            </div>
            <input type="submit" value="Actualizar Producto" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        </form>
    </div>
</body>
</html>
