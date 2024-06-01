<?php
session_start();
include 'conexion_productos.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['eliminar'])) {
        $id_a_eliminar = $_POST['id'];
        $sql_eliminar = "DELETE FROM productos WHERE id = $id_a_eliminar";
        
        if ($conexion->query($sql_eliminar) === TRUE) {
            
            header("Location: ../assets/views/stockproductos.php");
            exit();
        } else {
            echo "Error al eliminar fila: " . $conexion->error;
        }
    }
}
?>