$("#guardar_modificaciones").click(function () {
  if ($("#formularioModifica").smkValidate()) {
    var imagen = document.getElementById("imagenCa");
    var newImagenes = document.getElementById("af_imagen1");
    var traCategoria = $.trim($("#traCategoria").val());
    console.log("valor de categoria: " + traCategoria);

    // Validación de traCategoria
    if (
      traCategoria == "null" ||
      traCategoria === "0" ||
      traCategoria == null ||
      traCategoria === undefined
    ) {
      $.smkAlert({
        text: "El Grupo del activo no se encuentra categorizado.",
        type: "warning",
      });
      return;
    }

    var formData = new FormData();
    formData.append("af_codigo", $.trim($("#af_codigo").val()));
    formData.append("af_serial", $.trim($("#af_serial").val()));
    formData.append("af_marca", $.trim($("#af_marca").val()));
    formData.append("af_modelo", $.trim($("#af_modelo").val()));
    formData.append("af_nombre", $.trim($("#af_nombre").val()));
    formData.append("af_areaCreacion", $.trim($("#af_areaCreacion").val()));
    formData.append("af_fechaCompra", $.trim($("#af_fechaCompra").val()));
    formData.append("af_categoria", $.trim($("#af_categoria").val()));
    formData.append("af_estado", $.trim($("#af_estado").val()));
    formData.append("af_observaciones", $.trim($("#af_observaciones").val()));
    formData.append("af_area", $.trim($("#af_area").val()));
    formData.append("af_responsable", $.trim($("#af_responsable").val()));
    formData.append("af_ubicacion", $.trim($("#af_ubicacion").val()));
    formData.append(
      "af_fechaAsignacion",
      $.trim($("#af_fechaAsignacion").val())
    );
    formData.append("af_ram", $.trim($("#af_ram").val()));
    formData.append("af_discoDuro", $.trim($("#af_discoDuro").val()));
    formData.append("af_procesador", $.trim($("#af_procesador").val()));
    formData.append("hostName", $.trim($("#hostName").val()));
    formData.append("af_so", $.trim($("#af_so").val()));
    formData.append("af_licenciaSo", $.trim($("#af_licenciaSo").val()));
    formData.append("af_dominio", $.trim($("#af_dominio").val()));
    formData.append("af_aplicaciones", $.trim($("#af_aplicaciones").val()));
    formData.append("af_office", $.trim($("#af_office").val()));
    formData.append("af_antivirus", $.trim($("#af_antivirus").val()));
    formData.append("nombre_usu", $.trim($("#nombre_usu").val()));
    formData.append("costoCompra", $.trim($("#costoCompra").val()));
    formData.append("tipoAct", $.trim($("#tipoAct").val()));
    formData.append("vidaUtil", $.trim($("#vidaUtil").val()));
    formData.append("estadoAct", $.trim($("#estadoAct").val()));
    formData.append("traCategoria", traCategoria);
    formData.append("sede", $.trim($("#sede").val()));
    formData.append("guardar_modificaciones", "1");

    if (newImagenes.value === "") {
      formData.append("af_imagen1", imagen.value);
    } else {
      formData.append("af_imagen1", $("#af_imagen1")[0].files[0]);
      formData.append("deleteImg", imagen.value);
    }

    $.ajax({
      type: "POST",
      url: "../controller/controlador_activosFijos.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data == 1) {
          $.smkAlert({
            text: "Activo modificado con Éxito",
            type: "success",
          });
          setTimeout(function () {
            window.close();
          }, 600);
        } else if (data == 3) {
          $.smkAlert({
            text: "El código o serial ya estan asignados a otro activo",
            type: "warning",
          });
        } else if (data == 0) {
          $.smkAlert({
            text: "No esta funcionando la consulta",
            type: "danger",
          });
        } else {
          console.log(data + "578");
          $.smkAlert({
            text: "Comprueba que todos los campos esten completos",
            type: "danger",
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  }
});
