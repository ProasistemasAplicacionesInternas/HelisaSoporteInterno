$(document).on('change', 'input[type="file"]', function() {

    var arreglo =  this.files;
    for(i=0; i<arreglo.length; i++){
        var fileName =arreglo[i].name;
        var fileSize = arreglo[i].size;

        if (validacion(fileName,fileSize)=="error"){
            this.value = '';
        }
    }
});

 function validacion(fileName,fileSize){
    
    if (fileSize > 5000000) {

        $.smkAlert({
            text: 'El tamaño del archivo '+ fileName + ' no debe ser mayor a 20 MB',
            type: 'danger'
        })
        return "error";
    } else {

        var ext = fileName.split('.').pop();
        switch (ext) {
            case 'PDF':
            case 'pdf':
                break;
            default:
                $.smkAlert({
                    text:'No se puede cargar el archivo ' + fileName + '. Ya que la extencion ' + ext + ' no es permitida',
                    type:'warning'
                })

                $('#alert').fadeIn('slow');
                document.getElementById("crear_mantenimiento").disabled = true;

                setTimeout(function() {

                    document.getElementById("crear_mantenimiento").disabled = false;
                    $("#alerta").load(" #alerta");
                    $("#ruta").load(" #ruta");

                }, 4000);
                return "error";
        }
    }
}