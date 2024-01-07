<!DOCTYPE html>
<html>
<head>
  <title>Registro de Sesión</title>
  <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
  
  <div class="container">
    <form action="/php/registro_usuario_be.php" method="POST"> 
      <h2>Registro de Sesión</h2>
      <div class="Usuario">
      <input type="text" id="username" name="usuario" placeholder="Usuario" required>
    </div>
    <div class="Contraseña">
      <input type="password" id="password" name="password" placeholder="Contraseña" required>
    </div>
    <div class="email">
      <input type="email" id="email" name="email" placeholder="Correo Electronico" required>
    </div>
    <div class="Enviar">
      <button type="submit">Registrarse</button>
      <p>¿Ya tienes una cuenta? <a href="../index.html" ><span>Inicia sesión aquí</span></a>.</p>
    </div>
    <div class="Logo">
      <a href="../index.html"><img src="../imagenes/SchoolSnackPrototipo.png" width="150"></a>
    </div>
    </form>
    <script src="../js/script.js"></script>
  </div>
</body>
</html>