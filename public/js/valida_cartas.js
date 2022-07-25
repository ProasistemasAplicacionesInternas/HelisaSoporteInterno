$(document).on('change', 'input[type="file"]', function () {
    
    var fileName = this.files[0].name;
    var fileSize = this.files[0].size;

    if (fileSize > 1000000) {

        $('#alert button').after('<span>El tamaño no debe ser mayor a 1Mb</span>');

        $('#alert').fadeIn('slow');
        document.getElementById("enviar").disabled = true;

        setTimeout(function () {

            document.getElementById("enviar").disabled = false;
            $("#alerta").load(" #alerta");
            $("#ruta").load(" #ruta");

        }, 4000);
        this.value = '';
        this.files[0].name = '';
    } else {
      
        var ext = fileName.split('.').pop();

       
        switch (ext) {
            case 'jpg':
            case 'JPG':
            case 'jpeg':
            case 'JPEG':
            case 'png':
            case 'PNG':
            case 'PDF':
            case 'pdf':    
                break;
            default:
                $('#alert button').after('<span>Tipo de archivo invalido</span>');

                $('#alert').fadeIn('slow');
                document.getElementById("enviar").disabled = true;

                setTimeout(function () {

                    document.getElementById("enviar").disabled = false;
                    $("#alerta").load(" #alerta");
                    $("#ruta").load(" #ruta");

                }, 4000);
                this.value = ''; // reset del valor
                this.files[0].name = '';
        }
    }
});
