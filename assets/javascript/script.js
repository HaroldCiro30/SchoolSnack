document.addEventListener("DOMContentLoaded", function () {
  // Hacer una solicitud AJAX para obtener la lista de productos desde el servidor
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          const productos = JSON.parse(xhr.responseText);

          // Función para actualizar la interfaz de un producto específico
          function actualizarInterfaz(id, disponible) {
              const producto = document.getElementById(`producto-${id}`);
              if (producto) {
                  producto.querySelector('.btn-comprar').style.display = disponible ? 'block' : 'none';
              }
          }

          // Iterar sobre la lista de productos y actualizar la interfaz
          productos.forEach(producto => {
              actualizarInterfaz(producto.id, producto.disponible);
          });

          // Aquí podrías tener lógica para manejar eventos de eliminación y actualización de productos en la base de datos
      }
  };

  xhr.open('GET', '../../php/script.php', true);
  xhr.send();
});
