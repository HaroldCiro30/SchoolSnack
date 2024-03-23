<?php
session_start();
include 'conexion_productos.php';

$productos = array(
    array("id" => 1, "nombre" => "Empanada", "disponible" => true),
    array("id" => 2, "nombre" => "Palito De Queso", "disponible" => true),
    
);

$_SESSION['productos'] = $productos;
?>