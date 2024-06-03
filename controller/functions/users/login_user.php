<?php
include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Encriptar la contraseña ingresada para compararla con la almacenada en la base de datos
    $contrasena_encriptada = hash('sha512', $contrasena);

    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena='$contrasena_encriptada'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("location: ../../../view/paginaprincipal.php"); // Redirigir a la página principal después del inicio de sesión
    } else {
        echo '
        <script>
            alert("Usuario no existe, por favor verifique los datos introducidos");
            window.location = "../../../index.php";
        </script>
        ';
    }
}
?>
