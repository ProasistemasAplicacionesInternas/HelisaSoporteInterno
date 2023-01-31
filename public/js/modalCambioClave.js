function identidadF(funcionario) {
  var consulta = "&f_identificacion=" + funcionario + "&consultaF=1";
  $.ajax({
    type: "POST",
    url: "app/controller/controlador_funcionarios.php",
    data: consulta,
  }).done(function (data) {
    //console.log(data);
    if (data != null) {
      usuario = data;
      $("#funcionario").val(usuario);
    } else if (data == 2) {
      $.smkAlert({
        text: "Error.",
        type: "danger",
      });
    }
  });
  //$("#funcionario").val(resultado);
}
$("#validarUsuario").on("click", function () {
  var usuario = $("#nombre_a").val();
  var contrasenaUsuario = $("#pass_a").val();
  var validarDatos =
    "&nombre_a=" + usuario + "&pass_a=" + contrasenaUsuario + "&valUserxPass=1";
  $.ajax({
    type: "POST",
    url: "app/controller/control_usuario.php",
    data: validarDatos,
  }).done(function (data) {
    if (data == 1) {
      $("#pass_a").val("");
      $("#cambio-clave").modal("hide");
      $("#cambio-clave-funcionario").modal("show");
      //$('#identF').val()
    } else {
      $.smkAlert({
        text: "Su clave es errónea.",
        type: "danger",
      });
    }
  });
});
$("#passFuncionario").on("click", function () {
  var funcionarioUsuario = $("#funcionario").val();
  var firstPass = $("#firstPass").val();
  var secondPass = $("#secondPass").val();
  var regExPattern =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,10}/;
  if (firstPass != secondPass) {
    $.smkAlert({
      text: "Las claves no coinciden.",
      type: "danger",
    });
  } else {
    if (!regExPattern.test(firstPass)) {
      $("#mensaje")
        .removeClass("text-success")
        .addClass("text-danger")
        .text(
          "La contraseña debe incluir mayúsculas, minúsculas, caracteres y números." +
            "Debe tener como mínimo 10 caracteres."
        );
      document.getElementById("passFuncionario").disabled = false;
    } else {
      $("#mensaje")
        .removeClass("text-danger")
        .addClass("text-success")
        .text("Las contraseñas coinciden");
      document.getElementById("passFuncionario").disabled = true;

      var cambioClave =
        "&funcionario=" +
        funcionarioUsuario +
        "&firstPass=" +
        firstPass +
        "&enviarClaveF=1";
      $.ajax({
        type: "POST",
        url: "app/controller/controlador_funcionarios.php",
        data: cambioClave,
      }).done(function (data) {
        if (data == 1) {
          $.smkAlert({
            text: "La clave del funcionario se actualizó.",
            type: "success",
          });
          $('#cambio-clave-funcionario').modal('hide')
        } else {
          $.smkAlert({
            text: "La clave no fue modificada.",
            type: "danger",
          });
        }
      });
    }
  }
});
