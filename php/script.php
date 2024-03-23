<?php
session_start();
include 'conexion_productos.php';  // Agregar punto y coma aquí

// Verificar si la clave 'productos' existe en la variable de sesión y no está vacía
if (isset($_SESSION['productos']) && !empty($_SESSION['productos'])) {
    // Obtener la lista de productos desde la variable de sesión PHP
    $productos = $_SESSION['productos'];

    // Devolver los productos como respuesta JSON
    header('Content-Type: application/json');
    echo json_encode($productos);
} else {
    // Si no hay productos, devolver un JSON vacío o algún mensaje de error
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>