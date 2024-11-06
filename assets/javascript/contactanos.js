       // Abrir y cerrar el modal de confirmación
       const form = document.getElementById('contact-form');
       const modal = document.getElementById('modal');
       const closeModal = document.getElementById('close-modal');

       form.addEventListener('submit', function (e) {
           e.preventDefault(); // Prevenir el envío del formulario
           modal.classList.remove('hidden'); // Mostrar modal
       });

       closeModal.addEventListener('click', function () {
           modal.classList.add('hidden'); // Cerrar modal
       });