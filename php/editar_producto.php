<?php
session_start();
include 'conexion_productos.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editar'])) {
        $id_a_editar = $_POST['id'];
        $nueva_cantidad = $_POST['nueva_cantidad'];
        $nuevo_producto = $_POST['nuevo_producto'];
        $nueva_disponibilidad = $_POST['nueva_disponibilidad'];

        $sql_actualizar = "UPDATE productos SET Cantidad='$nueva_cantidad', Producto='$nuevo_producto', Disponibilidad='$nueva_disponibilidad' WHERE id=$id_a_editar";

        if ($conexion->query($sql_actualizar) === TRUE) {
            // Redirigir a la página de stockproductos.php después de editar el registro
            header("Location: ../assets/views/stockproductos.php");
            exit();
        } else {
            echo "Error al actualizar fila: " . $conexion->error;
        }
    }
}
?>