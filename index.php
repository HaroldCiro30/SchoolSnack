<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/png" href="assets/imagenes/SchoolSnackPrototipo.png">
</head>

<body>

    <div class="container">
        <div class="signin-signup">

            <!--Login-->
            <form action="./controller/functions/users/login_user.php" method="POST" class="sign-in-form">
                <h2 class="title">Inicia Sesión</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Usuario" name="usuario">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Contraseña" name="contrasena">
                </div>
                <input type="submit" value="Inicia Sesión" class="btn">
                <p class="social-text">¡Bienvenido de Nuevo, SchoolSnacker!</p>
                <p class="account-text">No tienes una cuenta? <a href="#" id="sign-up-btn2">Registrate!</a></p>
            </form>

            <!--Registro-->

            <form action="./controller/functions/users/register_user.php" method="POST" class="sign-up-form" enctype="multipart/form-data">
    <h2 class="title">Registrate</h2>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" placeholder="Usuario" name="usuario">
    </div>
    <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input type="text" placeholder="Email" name="correo">
    </div>
    <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input type="text" placeholder="Nombre Completo" name="nombre_completo">
    </div>
    <div class="input-field">
        <i class="fas fa-lock"></i>
        <input type="password" placeholder="Contraseña" name="contrasena">
    </div>
    <div class="input-field">
        <i class="fas fa-image"></i>
        <input type="file" name="imagen" accept="image/*">
    </div>
    <input type="submit" value="Registrate" class="btn">
    <p class="social-text">Registrate tambien con estas redes!</p>
    <div class="social-media">
        <!-- Social media icons -->
    </div>
    <p class="account-text">Ya tienes una cuenta? <a href="#" id="sign-in-btn2">Ingresa!</a></p>
</form>
        </div>1
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Ya eres parte de SchoolSnack?</h3>
                    <p>¡NO HAY TIEMPO QUE PERDER! ¡Inicia sesión aca abajo y disfruta de los beneficios de SchoolSnack!</p>
                    <button class="btn" id="sign-in-btn">Ingresa!</button>
                </div>
                <img src="signin.svg" alt="" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Eres nuevo en SchoolSnack?</h3>
                    <p>¡Te invitamos a que crees una cuenta en el boton de abajo para que puedas acceder a los beneficios de SchoolSnack te da!</p>
                    <button class="btn" id="sign-up-btn">Registrate!</button>
                </div>
                <img src="signup.svg" alt="" class="image">
            </div>
        </div>
    </div>
    <script src="./assets/javascript/app.js"></script>
    <script src="../assets/javascript/loader.js"></script>
</body>

</html>
