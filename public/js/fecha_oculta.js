var campoOculto = document.getElementById('fecha');
var campoOcultoFuniconarios = document.getElementById('funcionarioTranspaso');/* funcionarios activos, transpaso de activos */
var campoOcultoDescripcion = document.getElementById('descripcionRetiro_Div'); 

var campos = document.getElementsByClassName('ocultar');
var casillas = document.getElementsByClassName('requerido');

$('#f_estado').on('change', function () {
    if (this.value == 16) {
          campoOculto.style.display='inline';   
        document.getElementById("f_fecha_inactivacion").required = true;
        
        campoOcultoFuniconarios.style.display='block';   
        document.getElementById("funcionario_translado").required = true;
        
        campoOcultoDescripcion.style.display='block';
        document.getElementById("descripcionRetiro").required = true;
    } else {
          campoOculto.style.display = 'none';
          campoOcultoFuniconarios.style.display = 'none';
          campoOcultoDescripcion.style.display = 'none';
    }

});

$('#f_estado').trigger('change');