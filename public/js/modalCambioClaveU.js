function identidadU(usuario) {
  var consulta = "&id_usuario=" + usuario + "&consultaU=1";
  $.ajax({
    type: "POST",
    url: "app/controller/control_usuario.php",
    data: consulta,
  }).done(function (data) {
    if (data != null) {
      usuario = data;
      $("#usuarioM").val(usuario);
    } else if (data == 2) {
      $.smkAlert({
        text: "Error.",
        type: "danger",
      });
    }
  });
}
$("#validarUsuario").on("click", function () {
    var usuario = $("#nombre_u").val();
    var contrasenaUsuario = $("#pass_u").val();
    var validarDatos =
      "&nombre_u=" + usuario + "&pass_u=" + contrasenaUsuario + "&valUserxPass=2";
    $.ajax({
      type: "POST",
      url: "app/controller/control_usuario.php",
      data: validarDatos,
    }).done(function (data) {
      if (data == 1) {
        $("#pass_u").val("");
        $("#cambiar-clave").modal("hide");
        $("#cambio-clave-usuario").modal("show");
        //$('#identF').val()
      } else {
        $.smkAlert({
          text: "Su clave es errónea.",
          type: "danger",
        });
        $("#pass_u").val("");
      }
    });
  });
  $("#passUsuario").on("click", function () {
    var usuario = $("#usuarioM").val();
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
        document.getElementById("passUsuario").disabled = false;
      } else {
        $("#mensaje")
          .removeClass("text-danger")
          .addClass("text-success")
          .text("Las contraseñas coinciden");
        document.getElementById("passUsuario").disabled = true;
  
        var cambioClave =
          "&usuario=" +
          usuario +
          "&firstPass=" +
          firstPass +
          "&enviarClaveU=1";
        $.ajax({
          type: "POST",
          url: "app/controller/control_usuario.php",
          data: cambioClave,
        }).done(function (data) {
          if (data == 1) {
            $.smkAlert({
              text: "La clave del usuario se actualizó.",
              type: "success",
            });
            $("#usuarioM").val("");
            $("#firstPass").val("");
            $("#secondPass").val("");
            $("#mensaje").text("");
            document.getElementById("passUsuario").disabled = false;
            $('#cambio-clave-usuario').modal('hide');
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