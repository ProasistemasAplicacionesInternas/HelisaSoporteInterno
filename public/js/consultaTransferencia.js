function validarFormulario(event, id) {
  event.preventDefault();

  var formId = "#formTraslados_" + id;
  var af_id = $("#af_idB_" + id).val();
  var af_funcionario = $("#af_responsableB_" + id).val();
  var af_fechaAsignacion = $("#af_fechaAsignacionB_" + id).val();

  var dataConsult = {
    af_idB: af_id,
    consultarPendientes: 1,
  };

  $.ajax({
    type: "POST",
    url: "../controller/controlador_traslados.php",
    data: dataConsult,
  }).done(function (response) {
    console.log("response: ", response);
    if (response == true) {
      $.smkAlert({
        text: "No es posible generar el traslado ya que el activo seleccionado tiene solicitudes pendientes por aceptar",
        type: "danger",
      });
    }
    if (response == false) {
      $(formId).submit();
    }
  });
}
