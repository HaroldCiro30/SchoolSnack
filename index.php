<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SchoolSnack - Inicio de Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/imagenes/SchoolSnackPrototipo.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }

        .gradient {
            background: linear-gradient(135deg, #FF6B00 0%, #FF8800 50%, #FFA500 100%);
        }

        .form-container {
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .slide-left {
            transform: translateX(-100%);
        }

        .file-upload-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .file-upload-container input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .preview-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            display: none;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .input-field:focus-within {
            transform: translateY(-2px);
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .floating-image {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-orange-50 to-orange-100 min-h-screen">
    <div class="container mx-auto p-4 h-screen flex items-center justify-center">
        <div class="bg-white rounded-3xl shadow-2xl flex w-full max-w-5xl relative overflow-hidden min-h-[700px]">
            <!-- Formulario de Inicio de Sesión -->
            <div class="w-1/2 p-12 form-container" id="signin-form">
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-bold text-gray-800 mb-3">¡Bienvenido!</h2>
                    <p class="text-gray-500">Inicia sesión en SchoolSnack</p>
                </div>

                <form action="./controller/functions/users/login_user.php" method="POST" class="space-y-6">
                    <div class="input-field relative transition-all duration-300">
                        <i class="fas fa-user absolute text-orange-500 top-3 left-4 text-lg"></i>
                        <input type="text" name="usuario" placeholder="Usuario" required
                               class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 transition-colors bg-gray-50">
                    </div>
                    <div class="input-field relative transition-all duration-300">
                        <i class="fas fa-lock absolute text-orange-500 top-3 left-4 text-lg"></i>
                        <input type="password" name="contrasena" placeholder="Contraseña" required
                               class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 transition-colors bg-gray-50">
                    </div>
                    <button type="submit" 
                            class="w-full gradient text-white py-3 rounded-xl text-lg font-semibold hover:opacity-90 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg">
                        Iniciar Sesión
                    </button>
                </form>

                <div class="mt-8 space-y-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">O continúa con</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <button class="social-btn flex items-center justify-center py-2 px-4 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition-all duration-300">
                            <i class="fab fa-google text-red-500 text-xl"></i>
                        </button>
                        <button class="social-btn flex items-center justify-center py-2 px-4 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition-all duration-300">
                            <i class="fab fa-facebook text-blue-600 text-xl"></i>
                        </button>
                        <button class="social-btn flex items-center justify-center py-2 px-4 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition-all duration-300">
                            <i class="fab fa-apple text-gray-800 text-xl"></i>
                        </button>
                    </div>

                    <p class="text-center text-gray-600">
                        ¿No tienes una cuenta? 
                        <a href="#" class="text-orange-500 font-semibold hover:text-orange-600 transition-colors" id="show-signup">
                            ¡Regístrate!
                        </a>
                    </p>
                </div>
            </div>

            <!-- Formulario de Registro -->
            <div class="w-1/2 p-12 form-container absolute right-0 top-0 h-full bg-white" id="signup-form">
                <div class="text-center mb-8">
                    <h2 class="text-4xl font-bold text-gray-800 mb-3">Crear Cuenta</h2>
                    <p class="text-gray-500">Únete a la comunidad SchoolSnack</p>
                </div>

                <form action="./controller/functions/users/register_user.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <div class="mb-6 text-center">
                        <div class="relative mx-auto w-32 h-32 mb-4">
                            <img id="preview" src="assets/imagenes/default-avatar.png" alt="Preview" 
                                 class="w-full h-full rounded-full object-cover border-4 border-orange-500">
                            <div class="absolute bottom-0 right-0 bg-orange-500 rounded-full p-2 cursor-pointer hover:bg-orange-600 transition-colors">
                                <i class="fas fa-camera text-white"></i>
                                <input type="file" name="imagen" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer"
                                       onchange="previewImage(this)">
                            </div>
                        </div>
                        <p class="text-sm text-gray-500">Añade tu foto de perfil</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="input-field relative transition-all duration-300">
                            <i class="fas fa-user absolute text-orange-500 top-3 left-4 text-lg"></i>
                            <input type="text" name="usuario" placeholder="Usuario" required
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 transition-colors bg-gray-50">
                        </div>
                        <div class="input-field relative transition-all duration-300">
                            <i class="fas fa-envelope absolute text-orange-500 top-3 left-4 text-lg"></i>
                            <input type="email" name="correo" placeholder="Email" required
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 transition-colors bg-gray-50">
                        </div>
                    </div>

                    <div class="input-field relative transition-all duration-300">
                        <i class="fas fa-user absolute text-orange-500 top-3 left-4 text-lg"></i>
                        <input type="text" name="nombre_completo" placeholder="Nombre Completo" required
                               class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 transition-colors bg-gray-50">
                    </div>

                    <div class="input-field relative transition-all duration-300">
                        <i class="fas fa-lock absolute text-orange-500 top-3 left-4 text-lg"></i>
                        <input type="password" name="contrasena" placeholder="Contraseña" required
                               class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 transition-colors bg-gray-50">
                        <div class="absolute right-4 top-3 text-sm text-gray-500" id="password-strength"></div>
                    </div>

                    <button type="submit" 
                            class="w-full gradient text-white py-3 rounded-xl text-lg font-semibold hover:opacity-90 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg">
                        Crear Cuenta
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        ¿Ya tienes una cuenta? 
                        <a href="#" class="text-orange-500 font-semibold hover:text-orange-600 transition-colors" id="show-signin">
                            ¡Inicia sesión!
                        </a>
                    </p>
                </div>
            </div>

            <!-- Panel Decorativo -->
            <div class="absolute top-0 right-0 w-1/2 h-full gradient flex items-center justify-center text-white p-12 transition-transform duration-500" id="decorator-panel">
                <div class="text-center relative z-10">
                    <img src="assets/imagenes/SchoolSnackPrototipo.png" alt="SchoolSnack" class="mx-auto w-40 mb-8 floating-image">
                    <h3 class="text-4xl font-bold mb-6">¡Bienvenido a Aperitivo Escolar!</h3>
                    <p class="text-lg mb-8 opacity-90">La mejor manera de disfrutar tus snacks favoritos en la escuela</p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2 justify-center">
                            <i class="fas fa-check-circle text-xl"></i>
                            <span>Pedidos rápidos y seguros</span>
                        </div>
                        <div class="flex items-center space-x-2 justify-center">
                            <i class="fas fa-check-circle text-xl"></i>
                            <span>Ofertas exclusivas</span>
                        </div>
                        <div class="flex items-center space-x-2 justify-center">
                            <i class="fas fa-check-circle text-xl"></i>
                            <span>Programa de recompensas</span>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-0 bg-black opacity-10"></div>
            </div>
        </div>
    </div>

    <script>
        const showSignup = document.getElementById('show-signup');
        const showSignin = document.getElementById('show-signin');
        const signinForm = document.getElementById('signin-form');
        const signupForm = document.getElementById('signup-form');
        const decoratorPanel = document.getElementById('decorator-panel');

        // Función para previsualizar la imagen
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        // Validación de contraseña en tiempo real
        const passwordInput = document.querySelector('input[name="contrasena"]');
        const strengthIndicator = document.getElementById('password-strength');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let message = '';

            if (password.length >= 8) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^A-Za-z0-9]/)) strength += 25;

            if (strength <= 25) message = '❌ Débil';
            else if (strength <= 50) message = '⚠️ Regular';
            else if (strength <= 75) message = '👍 Buena';
            else message = '✅ Fuerte';

            strengthIndicator.textContent = message;
        });

        // Animaciones de transición
        showSignup.addEventListener('click', (e) => {
            e.preventDefault();
            decoratorPanel.style.transform = 'translateX(-100%)';
            signupForm.style.transform = 'translateX(0)';
            signinForm.style.opacity = '0';
        });

        showSignin.addEventListener('click', (e) => {
            e.preventDefault();
            decoratorPanel.style.transform  = 'translateX(0)';
            signupForm.style.transform = 'translateX(100%)';
            signinForm.style.opacity = '1';
        });

        // Animación de entrada
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.container').style.opacity = '1';
        });
    </script>
</body>
</html>