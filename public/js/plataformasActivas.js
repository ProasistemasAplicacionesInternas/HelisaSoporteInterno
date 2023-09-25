function recortarCadena(data){
  var cadena = data;
  var valores = cadena.split(',');
  if (valores.length > 2) {
      var primerosTres = valores.slice(0, 2);
      var resultado = primerosTres.join(',') + ', etc.';
  } else {
      var resultado = cadena;
  }
  return resultado;
}
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
        $("#contenido").load("app/view/plataformasActivas.php");
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
      } else if (data == 6000) {
        $.smkAlert({
          text:
            "No se puede inactivar la plataforma ( " +
            plataforma +
            " ) porque tiene peticiones nuevas sin asignar.",
          type: "danger",
        });
      } else if (data == 8000) {
        data = "usuariosPlataformas=1" + "&id=" + id;
        $.ajax({
          type: "POST",
          url: "app/controller/controlador_plataformas.php",
          data: data,
        }).done(function (data) {
          if (data.lenght !== 0) {
            var resultado = recortarCadena(data);
            $.smkAlert({
              text:
                "No se puede inactivar ya que los funcionarios ( " +
                resultado +
                " ) tienen asignada la plataforma. \n",
              type: "danger",
            });
          } else {
            $(".close").click();
            $.smkAlert({
              text: "Error al traer los usuarios de las peticiones asociadas.",
              type: "danger",
            });
          }
        });
      } else if (data == 7000) {
        data = "usuariosPeticiones=1" + "&id=" + id;
        $.ajax({
          type: "POST",
          url: "app/controller/controlador_plataformas.php",
          data: data,
        }).done(function (data) {
          if (data.lenght !== 0) {
            var resultado = recortarCadena(data);
            $.smkAlert({
              text:
                "No se puede inactivar ya que los funcionarios ( " +
                resultado +
                " ) tienen peticiones pendientes sin gestionar. \n",
              type: "danger",
            });
          } else {
            $(".close").click();
            $.smkAlert({
              text: "Error al traer los usuarios de las peticiones asociadas.",
              type: "danger",
            });
          }
        });
      } else if (data == 5000) {
        data = "usuariosPeticiones=1" + "&id=" + id;
        $.ajax({
          type: "POST",
          url: "app/controller/controlador_plataformas.php",
          data: data,
        }).done(function (data) {
          if (data.lenght !== 0) {
            var resultado = recortarCadena(data);
            $.smkAlert({
              text:
                "No se puede inactivar ya que los funcionarios ( " +
                resultado +
                " ) tienen peticiones seleccionadas sin gestionar. \n",
              type: "danger",
            });
          } else {
            $(".close").click();
            $.smkAlert({
              text: "Error al traer los usuarios de las peticiones asociadas.",
              type: "danger",
            });
          }
        });
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
