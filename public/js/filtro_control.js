var codigo = document.getElementById('selectorCodigo');
var nombre = document.getElementById('selectorNombre');
var responsable = document.getElementById('selectorResponsable');

$('#criterio').on('change', function() {
    if (this.value == '' || this.value == undefined) {
        codigo.style.display = 'none';
        nombre.style.display = 'none';
        responsable.style.display = 'none';
    } else if (this.value == 1) {
        codigo.style.display = 'inline'
        nombre.style.display = 'none';
        responsable.style.display = 'none';
    } else if (this.value == 2) {
        nombre.style.display = 'inline';
        codigo.style.display = 'none';
        responsable.style.display = 'none';

    } else if (this.value == 3) {
        codigo.style.display = 'none';
        nombre.style.display = 'none';
        responsable.style.display = 'inline';

    }
});

$('#criterio').trigger('change');