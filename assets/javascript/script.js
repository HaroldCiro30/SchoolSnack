document.getElementById('btnAgregarProducto').addEventListener('click', function () {
  // Muestra el modal
  document.getElementById('modalAgregarProducto').style.display = 'block';
});

document.getElementById('formAgregarProducto').addEventListener('submit', function (event) {
  event.preventDefault(); // Evita que se recargue la página

  // Recopila los datos del formulario
  var nombreProducto = document.getElementById('nombreProducto').value;
  var cantidad = document.getElementById('cantidad').value;
  var disponibilidad = document.querySelector('input[name="disponibilidad"]:checked').value;

  // Agrega un nuevo producto a la base de datos
  agregar_producto(nombreProducto, cantidad, disponibilidad);

  // Actualiza la tabla con los nuevos datos
  actualizar_tabla(resultado);

  // Oculta el modal después de agregar el producto
  document.getElementById('modalAgregarProducto').style.display = 'none';
});

// Función para actualizar la tabla con los nuevos datos
function actualizar_tabla(resultado) {
  // Obtén la tabla
  const tabla = document.querySelector("table");

  // Recorre los resultados
  for (const producto of resultado) {
      // Agrega una nueva fila a la tabla
      const nueva_fila = tabla.insertRow(tabla.rows.length);

      // Agrega una celda a la fila
      const celda_id = nueva_fila.insertCell(0);
      celda_id.innerHTML = producto.id;

      // Agrega una celda a la fila