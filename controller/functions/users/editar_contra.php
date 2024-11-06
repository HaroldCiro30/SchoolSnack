<?php
session_start();

// Incluimos el archivo de configuración de la base de datos
require_once '../../db.php';

try {
  // Intentamos establecer la conexión a la base de datos
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException
 $e) {
  die("Error de conexión a la base de datos: " . $e->getMessage()); }

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  echo '<script>alert("Por favor debes iniciar sesión"); window.location = "../index.php";</script>';
  exit();
}

$usuario_actual = $_SESSION['usuario'];
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

// Verificar si las contraseñas coinciden
if (!password_verify($currentPassword, $resultado['contrasena'])) {
    echo '<script>alert("Contraseña actual incorrecta"); window.history.back();</script>'; // <-- Línea 29
}

$sql = "SELECT contrasena FROM usuarios WHERE usuario = :usuario";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario', $usuario_actual);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$resultado) {
  echo '<script>alert("Usuario no encontrado"); window.history.back();</script>';
  exit();
}

// No print out the hashed password for debugging purposes
// $hash_contraseña_actual = $resultado['contrasena'];

// Verificar que la contraseña actual ingresada es correcta
if (!password_verify($currentPassword, $resultado['contrasena'])) {
  echo '<script>alert("Contraseña actual incorrecta"); window.history.back();</script>';
  exit();
}

// Validar la nueva contraseña y actualizarla
$hash_nueva_contrasena = password_hash($newPassword, PASSWORD_DEFAULT);
$sql_update = "UPDATE usuarios SET contrasena = :newPassword WHERE usuario = :usuario";
$stmt_update = $pdo->prepare($sql_update);
$stmt_update->bindParam(':newPassword', $hash_nueva_contrasena);
$stmt_update->bindParam(':usuario', $usuario_actual);

if ($stmt_update->execute()) {
  echo '<script>alert("Contraseña actualizada correctamente"); window.location = "../../view/paginaprincipal.php";</script>';
} else {
  echo '<script>alert("Error al actualizar la contraseña"); window.history.back();</script>';
}

exit();
?>