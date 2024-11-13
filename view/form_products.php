<!DOCTYPE html>
<html>
<head>
    <title>Agregar Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Agregar Nuevo Producto</h1>
        <form method="post" action="../controller/functions/products/guardar_producto.php" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="producto" class="block text-gray-700 font-bold mb-2">Nombre Producto:</label>
                <input type="text" id="nombre" name="nombre" required class="border rounded-md px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="producto" class="block text-gray-700 font-bold mb-2">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" required class="border rounded-md px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="cantidad" class="block text-gray-700 font-bold mb-2">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required class="border rounded-md px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="cantidad" class="block text-gray-700 font-bold mb-2">Precio:</label>
                <input type="number" id="precio" name="precio" required class="border rounded-md px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="cantidad" class="block text-gray-700 font-bold mb-2">Rating:</label>
                <input type="number" id="rating" name="rating" required class="border rounded-md px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="imagen" class="block text-gray-700 font-bold mb-2">Imagen del Producto:</label>
                <input type="file" id="imagen" name="imagen" class="border rounded-md px-4 py-2 w-full">
            </div>
            <input type="submit" value="Agregar Producto" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        </form>
    </div>
</body>
</html>
