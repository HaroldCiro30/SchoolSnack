<?php
include '../../db.php'; // Incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $nombre_completo = $_POST['nombre_completo'];
    $contrasena = $_POST['contrasena'];
    
    // Verificación de imagen
    $imagen = $_FILES['imagen']['name']; // Nombre de la imagen
    $imagenTmp = $_FILES['imagen']['tmp_name']; // Archivo temporal de la imagen

    // Directorio donde se guardará la imagen
    $directorioImagenes = "../../../uploads/";

    // Asegúrate de que el directorio de imágenes exista
    if (!is_dir($directorioImagenes)) {
        mkdir($directorioImagenes, 0777, true); // Crea el directorio si no existe
    }

    // Mover el archivo subido al directorio de imágenes
    $rutaImagen = $directorioImagenes . basename($imagen);
    if (!move_uploaded_file($imagenTmp, $rutaImagen)) {
        echo '
            <script>
                alert("Error al subir la imagen. Intenta nuevamente.");
                window.location = "../../../index.php";
            </script>
        ';
        exit();
    }

    // Encriptar la contraseña usando SHA-512
    $contrasena_encriptada = hash('sha512', $contrasena);
    
    // Verificación de usuario, correo y nombre completo ya registrados
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

    // Inserción en la base de datos, incluyendo la imagen
    $sql = "INSERT INTO usuarios (usuario, correo, nombre_completo, contrasena, imagen) 
            VALUES ('$usuario', '$correo', '$nombre_completo', '$contrasena_encriptada', '$imagen')";

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