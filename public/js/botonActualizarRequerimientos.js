$(document).ready(function() {
    $('#actualizar').click(function() {

        $(this).prop('disabled', true);

        $('#infoRequerimientos').load('app/view/requerimientos.php', function() {
            setTimeout(function() {
                $('#btn-actualizar').prop('disabled', false);
            }, 1000);
        });
    });
});