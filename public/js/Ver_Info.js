$(document).ready(function() {
    $(document).on('click', '#btn-verInfo', function() {
        
        let id = $(this).val();
        let p_descripcion = $('#p_descipcion' + id).text();
        let req_nombre = $('#req_nombre' + id).text();
        let req_justificacion = $('#req_justificacion' + id).text();
        let req_divfields = document.getElementById('req_fields');

        /* $('#modifica-usuario').modal('show'); */
        $('#p_descipcionModal').val(p_descripcion);
        if (req_nombre == "") {
            
            req_divfields.style.display="none";
            
        
        }else{
            req_divfields.style.display="inline";
            $('#req_nombreModal').val(req_nombre);
            $('#req_justificacionModal').val(req_justificacion);
        }


    });
});