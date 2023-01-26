/*$(document).ready(function () {
    $(document).on('click', '.elimina-usuario', function () {
        var id = $(this).val();
        var usuario = $('#alias' + id).text();
        $('#elimina-usuario').modal('show');
        $('#alias').val(usuario);
       
    });
});*/

$(document).ready(function() {
    $(document).on('click', '.modifica-usuario', function() {
        let id = $(this).val();
        let id_usuario = $('#id_usuario' + id).text();
        let nombre = $('#usuario' + id).text();
        let contrasena = $('#contrasena' + id).text();
        let correo = $('#correo' + id).text();
        let uestado = $('#uestado' + id).text();

        /* $('#modifica-usuario').modal('show'); */
        $('#id_usuario').val(id_usuario);
        $('#usuario').val(nombre);
        $('#contrasena').val(contrasena);
        $('#correo').val(correo);
        $('#uestado').val(uestado);


    });
});
$(document).ready(function () {
    $(document).on("click", ".borrar-qr", function () {
      var id = $(this).val();
      console.log(id + "ID");
      var usuario = $("#id_usuario" + id).text();
      $("#id_usuarioX").val(usuario);
      var nombre = $("#usuario" + id).text();
      console.log(usuario, "  ", nombre);
      $("#usuarioX").val(nombre);
      $("#borrar").val("Borrando...");
      var borrarQr = "&usuario=" + nombre + "&limpiar_codigo=1";
    });
  });