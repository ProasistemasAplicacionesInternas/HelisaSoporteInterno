$(document).ready(function () {
    $(document).on('click', '.modal_proceso', function () {
        var id = $(this).val();
        var cambio = $('#cambio' + id).text();
        var alias = $('#alias' + id).text();
       
        $('#modal_proceso').modal('show');
        $('#cambio').val(cambio);
        $('#alias').val(alias);

    });
});
