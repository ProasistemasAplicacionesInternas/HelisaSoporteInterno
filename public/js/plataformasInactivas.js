$("#crear_plataforma").click(function () {
  var plataforma = $("#modal_descripcionCrear").val();
  var administrador = $("#modal_administradorCrear").val();

  if (plataforma == "" || plataforma == null || plataforma == undefined) {
    $.smkAlert({
      text: "Debe asignarle un nombre a la plataforma.",
      type: "warning",
    });
  } else if (
    administrador == "" ||
    administrador == null ||
    administrador == undefined
  ) {
    $.smkAlert({
      text: "Debe asignarle un Administrador a la plataforma.",
      type: "warning",
    });
  } else {
    data =
      "crearPlataforma=1" +
      "&descripcion=" +
      plataforma +
      "&administrador=" +
      administrador;
    $.ajax({
      type: "POST",
      url: "app/controller/controlador_plataformas.php",
      data: data,
    }).done(function (data) {
      if (data == 1) {
        $("#modal_descripcionCrear").val("");
        $(".close").click();
        $("#contenido").load("app/view/plataformasInactivas.php");
      } else if (data == 2) {
        $.smkAlert({
          text: "El titulo asignado ya se encuentra resgirtado, se debe designar otro.",
          type: "warning",
        });
      } else {
        $("#modal_descripcionCrear").val("");
        $(".close").click();
        $.smkAlert({
          text: "Erorr interno, intentelo nuevamente.",
          type: "danger",
        });
      }
    });
  }
});

function modalModificar(id, descripcion, administrador, estado) {
  $("#modal_id").val(id);
  $("#modal_descripcion").val(descripcion);
  $("#modal_administrador").val(administrador);
  $("#modal_estado").val(estado);
}

$("#modificar_plataforma").click(function () {
  var id = $("#modal_id").val();
  var plataforma = $("#modal_descripcion").val();
  var administrador = $("#modal_administrador").val();
  var estado = $("#modal_estado").val();

  if (plataforma == "" || plataforma == null || plataforma == undefined) {
    $.smkAlert({
      text: "Debe asignarle un nombre a la plataforma.",
      type: "warning",
    });
  } else if (
    administrador == "" ||
    administrador == null ||
    administrador == undefined
  ) {
    $.smkAlert({
      text: "Debe asignarle un Administrador a la plataforma.",
      type: "warning",
    });
  } else {
    data =
      "modificarPlataforma=1" +
      "&id=" +
      id +
      "&descripcion=" +
      plataforma +
      "&administrador=" +
      administrador +
      "&estado=" +
      estado;
    $.ajax({
      type: "POST",
      url: "app/controller/controlador_plataformas.php",
      data: data,
    }).done(function (data) {
      if (data == 1) {
        try {
          $(".close").click();
          $("#contenido").load("app/view/plataformasActivas.php", function(response, status, xhr) {
              if (status === "error") {
                  throw new Error("Hubo un error al cargar el contenido.");
              }
          });
      } catch (error) {
        window.location.href = window.location.href;
      }
      } else {
        $(".close").click();
        $.smkAlert({
          text: "Error interno, intentelo nuevamente.",
          type: "danger",
        });
      }
    });
  }
});
