<?php
session_start();

// Verificar si no hay una sesión activa, redirigir al usuario al inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
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
</head>
<body>
    <h1>Administración de Productos</h1>
    <a href="agregar_producto.php">Agregar Producto</a>
    <br><br>
    <a href="logout.php">Cerrar Sesión</a>
    <br><br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Cantidad</th>
            <th>Producto</th>
            <th>Disponibilidad</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td><?php echo $row['producto']; ?></td>
            <td><?php echo $row['disponibilidad']; ?></td>
            <td>
                <a href="editar_producto.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="eliminar_producto.php?id=<?php echo $row['id']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
