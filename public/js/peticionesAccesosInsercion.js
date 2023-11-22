$(document).ready(function () {
  var refreshId = setInterval(function () {
    var data = "preSeleccionar=1&id_peticion=" + $("#id_peticion").val();
    $.ajax({
      type: "POST",
      url: "../controller/controlador_peticionesAccesos.php",
      data: data,
    }).done(function (respuesta) {
      if (respuesta == 0) {
        $.smkAlert({
          text: "Error Interno.",
          type: "danger",
        });
      } else if (respuesta != 8) {
        $.smkAlert({
          text: "Un usuario a liberado la peticion.",
          type: "warning",
        });
        setTimeout(function () {
          redireccionarxTipoUser();
        }, 800);
      }
    });
  }, 1000);
});

function liberarPeticion(id_peticion) {
  var data = "liberarPeticion=1&id_peticion=" + id_peticion;
  $.ajax({
    type: "POST",
    url: "../../app/controller/controlador_peticionesAccesos.php",
    data: data,
  }).done(function (respuesta) {
    if (respuesta == 2) {
      $.smkAlert({
        text: "El ticket Cambio su estado antes de Poder liberarse.",
        type: "warning",
      });
      redireccionarxTipoUser();
    } else if (respuesta == 1) {
      redireccionarxTipoUser();
    } else {
      $.smkAlert({
        text: "Error Interno.",
        type: "danger",
      });
      redireccionarxTipoUser();
    }
  });
}

function aprobacionPlataformas(elemento) {
  var x = elemento;
  var estado = $("#estado" + x).val();
  if (estado == 12) {
    $("#nombre_usuario" + x).prop("required", true);
    $("#clave" + x).prop("required", true);

    $("#nombre_usuario" + x).prop("disabled", false);
    $("#clave" + x).prop("disabled", false);
  } else {
    $("#nombre_usuario" + x).prop("required", false);
    $("#clave" + x).prop("required", false);

    $("#nombre_usuario" + x).prop("disabled", true);
    $("#clave" + x).prop("disabled", true);

    $("#nombre_usuario" + x).val("");
    $("#clave" + x).val("");
  }
}

function redireccionarxTipoUser() {
  var data = "buscarTipoUsuario=1";
  $.ajax({
    type: "POST",
    url: "../controller/controlador_peticionesAccesos.php",
    data: data,
  }).done(function (respuesta) {
    if (respuesta == 0) {
      window.location = "../../dashboard_funcionarios.php";
    } else if (respuesta == 1) {
      window.location = "../../dashboard.php";
    }
  });
}
const nombreUsuarios = document.querySelectorAll('[name^="nombre_usuario"]');

nombreUsuarios.forEach((nombreUsuario) => {
  nombreUsuario.addEventListener("input", function () {
    let review = nombreUsuario.value;
    const row = this.closest(".row");
    const plataforma = row.querySelector('[name^="plataforma"]').value;
    const contrasena = row.querySelector('[name^="clave"]');
    const idUuser = document.getElementById("p_identificacion");
    const estado = row.querySelector('[name^="estado"]');
    let accesoConsulta =
      "plataforma=" +
      plataforma +
      "&usuario=" +
      review +
      "&consultarD=1";
      console.log(accesoConsulta);

    $.ajax({
      type: "POST",
      url: "../controller/controlador_peticionesAccesos.php",
      data: accesoConsulta,
    }).done(function (data) {
      if (data == 2) {
        $.smkAlert({
          text: "El funcionario ya tiene un usuario creado en la plataforma",
          type: "danger",
          permanent: true,
        });
        estado.value = 13;
        if (contrasena) {
          contrasena.disabled = true;
          nombreUsuario.value = "";
          nombreUsuario.disabled = true;
        }
      }
    });
  });
});
