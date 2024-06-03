<?php
include '../../db.php'; // Incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $nombre_completo = $_POST['nombre_completo'];
    $contrasena = $_POST['contrasena'];

    // Encriptar la contraseña usando SHA-512
    $contrasena_encriptada = hash('sha512', $contrasena);
    
    $verificar_correo = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo='$correo' ");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
            <script>
                alert("Este correo ya está registrado, ¡Intenta con otro diferente!");
                window.location = "../../../index.php";
            </script>
        ';
    exit();
}

$verificar_nombre_completo = mysqli_query($conn, "SELECT * FROM usuarios WHERE nombre_completo='$nombre_completo' ");

if (mysqli_num_rows($verificar_nombre_completo) > 0) {
    echo '
            <script>
                alert("Este nombre ya está registrado, ¡Intenta con otro diferente!");
                window.location = "../../../index.php";
            </script>
        ';
    exit();
}


$verificar_usuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario='$usuario' ");

if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '
                <script>
                    alert("Este usuario ya está registrado, ¡Intenta con otro diferente!");
                    window.location = "../../../index.php";
                </script>
            ';
    exit();
}

    $sql = "INSERT INTO usuarios (usuario, correo, nombre_completo, contrasena) VALUES ('$usuario', '$correo', '$nombre_completo', '$contrasena_encriptada')";

    if ($conn->query($sql) === TRUE) {
        echo '
            <script>
                alert("Usuario registrado exitosamente");
                window.location = "../../../index.php";
            </script>
        ';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
