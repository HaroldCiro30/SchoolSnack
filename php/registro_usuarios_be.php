<?php

    include 'conexion_be.php'; 

    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $nombre_completo = $_POST['nombre_completo'];
    $contrasena = $_POST['contrasena'];

    //Encriptamiento de Contraseña
    $contrasena = hash('sha512', $contrasena);

    // Verificar que el correo no se repita en la base de datos
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya está registrado, ¡Intenta con otro diferente!");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

     // Verificar que el nombre completo no se repita en la base de datos
     $verificar_nombre_completo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre_completo='$nombre_completo' ");

    if(mysqli_num_rows($verificar_nombre_completo) > 0){
        echo '
            <script>
                alert("Este nombre ya está registrado, ¡Intenta con otro diferente!");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

         // Verificar que el usuario no se repita en la base de datos
         $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' ");

         if(mysqli_num_rows($verificar_usuario) > 0){
             echo '
                 <script>
                     alert("Este usuario ya está registrado, ¡Intenta con otro diferente!");
                     window.location = "../index.php";
                 </script>
             ';
             exit();
         }

    $query = "INSERT INTO usuarios (usuario, correo, nombre_completo, contrasena) 
                VALUES ('$usuario', '$correo', '$nombre_completo', '$contrasena')";

    $ejecutar = mysqli_query($conexion, $query);
    
    if ($ejecutar) {
        echo '
        <script>
            alert("Usuario registrado exitosamente.");
            window.location = "../index.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Inténtalo de nuevo, usuario no registrado");
            window.location = "../index.php";
        </script>
        ';
    }
?>