function setOperacion(operacion) {
    document.getElementById('operacion').value = operacion;
    document.forms[0].submit();
}

function cargarTablaProductos() {
    $.ajax({
        url: '../../php/agregar_producto.php', // Cambia esto por la ruta correcta
        type: 'POST', // o 'POST' según tu configuración
        success: function(data) {
            $('#tabla-container').html(data);
        },
        error: function() {
            console.log('Error al cargar la tabla de productos.');
        }
    });
}

// Llamada inicial para cargar la tabla al cargar la página
cargarTablaProductos();

// Evento para manejar el envío del formulario
$('form').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            // Muestra un mensaje de éxito o error
            alert(response.success || response.error);
            
            // Actualiza la tabla después de agregar un producto
            cargarTablaProductos();
        },
        error: function() {
            console.log('Error al agregar el producto.');
        }
    });
});