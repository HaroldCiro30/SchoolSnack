<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Nuestro Proyecto Educativo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style1.css">
</head>
<body class="bg-gray-50">
    <!-- Barra de navegación -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="#" class="flex items-center py-4 px-2">
                            <img src="assets/imagenes/SchoolSnackPrototipo.png" width="50"></img>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="#" class="py-4 px-2 text-orange-500 border-b-4 border-orange-500 font-semibold">Inicio</a>
                        <a href="#about" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Sobre Nosotros</a>
                        <a href="#services" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Servicios</a>
                        <a href="#gallery" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Galería</a>
                        <a href="#contact" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Contacto</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    <a href="index.php" id="btnInicio" class="py-2 px-4 bg-orange-500 hover:bg-orange-600 text-white rounded-md shadow-md transition duration-300">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sección de héroe -->
    <div class="relative bg-orange-600 h-96 flex items-center">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('assets/imagenes/galan2.jpeg?height=400&width=1200');"></div>
        <div class="absolute inset-0 bg-orange-900 opacity-75"></div>
        <div class="container mx-auto px-4 z-10">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-white mb-4">Bienvenido a Nuestro Proyecto Educativo</h1>
                <p class="text-xl text-white mb-8">Transformando el futuro a través de la educación innovadora</p>
                <a href="#about" class="bg-white text-orange-600 py-3 px-6 rounded-full font-bold hover:bg-orange-100 transition duration-300">Descubre Más</a>
            </div>
        </div>
    </div>

    <!-- Sección Sobre Nosotros -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Sobre Nuestro Proyecto</h2>
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2 mb-8 md:mb-0">
                    <img src="/placeholder.svg?height=400&width=600" alt="Sobre nosotros" class="rounded-lg shadow-lg">
                </div>
                <div class="w-full md:w-1/2 md:pl-10">
                    <p class="text-gray-600 mb-4">
                        Nuestro proyecto educativo está diseñado para inspirar y capacitar a la próxima generación de líderes y pensadores innovadores. Combinamos métodos de enseñanza tradicionales con tecnologías de vanguardia para crear una experiencia de aprendizaje única y enriquecedora.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Con un enfoque en el desarrollo integral del estudiante, nuestro programa fomenta no solo la excelencia académica, sino también habilidades críticas para el siglo XXI como el pensamiento crítico, la creatividad y la colaboración.
                    </p>
                    <a href="#" class="inline-block bg-orange-500 text-white py-2 px-4 rounded hover:bg-orange-600 transition duration-300">Leer más</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Servicios -->
    <section id="services" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Nuestros Servicios</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <i class="fas fa-laptop-code text-4xl text-orange-500 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Cursos en Línea</h3>
                    <p class="text-gray-600">Accede a una amplia gama de cursos en línea impartidos por expertos en la industria.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <i class="fas fa-users text-4xl text-orange-500 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Tutoría Personalizada</h3>
                    <p class="text-gray-600">Recibe orientación individual de tutores experimentados para maximizar tu potencial.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <i class="fas fa-certificate text-4xl text-orange-500 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Certificaciones</h3>
                    <p class="text-gray-600">Obtén certificaciones reconocidas en la industria para impulsar tu carrera.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Galería de Imágenes -->
    <section id="gallery" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Galería de la Institución</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <img src="/placeholder.svg?height=300&width=400" alt="Imagen de la institución 1" class="w-full h-64 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300">
                <img src="/placeholder.svg?height=300&width=400" alt="Imagen de la institución 2" class="w-full h-64 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300">
                <img src="/placeholder.svg?height=300&width=400" alt="Imagen de la institución 3" class="w-full h-64 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300">
                <img src="/placeholder.svg?height=300&width=400" alt="Imagen de la institución 4" class="w-full h-64 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300">
                <img src="/placeholder.svg?height=300&width=400" alt="Imagen de la institución 5" class="w-full h-64 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300">
                <img src="/placeholder.svg?height=300&width=400" alt="Imagen de la institución 6" class="w-full h-64 object-cover rounded-lg shadow-md hover:shadow-xl transition duration-300">
            </div>
        </div>
    </section>

    <!-- Sección de Testimonios -->
    <section class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Lo que dicen nuestros estudiantes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <p class="text-gray-600 mb-4">"Esta institución ha transformado mi carrera. Los cursos son de alta calidad y los profesores son increíblemente dedicados."</p>
                    <p class="font-semibold">- María González, Estudiante de Ingeniería</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <p class="text-gray-600 mb-4">"La flexibilidad de los cursos en línea me permitió equilibrar mis estudios con mi trabajo. ¡Altamente recomendado!"</p>
                    <p class="font-semibold">- Carlos Rodríguez, Profesional en Tecnología</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Preguntas Frecuentes -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Preguntas Frecuentes</h2>
            <div class="space-y-4">
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-semibold mb-2">¿Cómo puedo inscribirme en un curso?</h3>
                    <p class="text-gray-600">Para inscribirte, simplemente crea una cuenta en nuestra plataforma y selecciona el curso que te interese. Luego, sigue las instrucciones de pago y ¡listo!</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-semibold mb-2">¿Los cursos tienen algún requisito previo?</h3>
                    <p class="text-gray-600">Algunos cursos avanzados pueden tener requisitos previos. Estos se indicarán claramente en la descripción del curso antes de la inscripción.</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-semibold mb-2">¿Ofrecen algún tipo de asistencia financiera?</h3>
                    <p class="text-gray-600">Sí, ofrecemos becas y planes de pago flexibles para estudiantes que lo necesiten. Contacta a nuestro equipo de admisiones para más información.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pie de página -->
    <footer id="contact" class="bg-gray-800 text-white py-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-xl font-semibold mb-4">Contáctanos</h3>
                    <p>Email: info@proyecto-educativo.com</p>
                    <p>Teléfono: +1 234 567 890</p>
                    <p>Dirección: 123 Calle Educación, Ciudad</p>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-xl font-semibold mb-4">Enlaces Rápidos</h3>
                    <ul>
                        <li><a href="#" class="hover:text-blue-300">Inicio</a></li>
                        <li><a href="#about" class="hover:text-blue-300">Sobre Nosotros</a></li>
                        <li><a href="#services" class="hover:text-blue-300">Servicios</a></li>
                        <li><a href="#gallery" class="hover:text-blue-300">Galería</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-xl font-semibold mb-4">Síguenos</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-2xl hover:text-blue-300"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-2xl hover:text-blue-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-2xl hover:text-blue-300"><i class="fab fa-instagram"></i></a>
                        
                        <a href="#" class="text-2xl hover:text-blue-300"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p>&copy; 2024 Proyecto Educativo. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('btnInicio').addEventListener('click', function() {
            // Aquí puedes cambiar 'pagina-inicio.html' por la URL real de tu página de inicio de sesión/registro
            window.location.href = 'pagina-inicio.html';
        });

        // Smooth scroll para los enlaces de navegación
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>