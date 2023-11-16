<?php

$nombre_usuario = $_POST["usuario"];
$contrasena = $_POST["password"];
$email = $_POST["email"];

$conexion = mysqli_connect("localhost", "root", "", "mydb");

$nombre_usuario = mysqli_real_escape_string($conexion, $nombre_usuario);
$contrasena = mysqli_real_escape_string($conexion, $contrasena);
$email = mysqli_real_escape_string($conexion, $email);

$consulta = "INSERT INTO usuarios (usuario, password, email) VALUES ('$nombre_usuario', '$contrasena', '$email')";
$resultado = mysqli_query($conexion, $consulta);

mysqli_close($conexion);

header("Location: index.php");

?>