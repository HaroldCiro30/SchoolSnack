// Seleccionar los elementos
const preview = document.getElementById('productPreview');
const closePreviewButton = document.getElementById('closePreview');

// Función para abrir el preview
function openPreview() {
  preview.classList.add('active');
}

// Función para cerrar el preview
function closePreview() {
  preview.classList.remove('active');
}

// Evento para abrir el preview (esto debe asociarse a algún botón)
document.querySelector('#openPreviewButton').addEventListener('click', openPreview);

// Evento para cerrar el preview
closePreviewButton.addEventListener('click', closePreview);

// Cerrar el preview al hacer clic fuera del contenido
preview.addEventListener('click', function (e) {
  if (e.target === preview) {
    closePreview();
  }
});