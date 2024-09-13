var campoOculto = document.getElementById('activoSoporte');

var campos = document.getElementsByClassName('ocultar');
var casillas = document.getElementsByClassName('requerido');
$('#Categoria').on('change', function () {
    if (this.value == 16 ) {
        campoOculto.style.display='inline';
        document.getElementById("pActivo").required = true;
    }
    else{
        campoOculto.style.display = 'none';
        document.getElementById("pActivo").required = false;
    }
});

$('#Categoria').trigger('change');