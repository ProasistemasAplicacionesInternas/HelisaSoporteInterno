$("#crear_activoFijo").click(function () {
  if ($("#formulario").smkValidate()) {
    var traCategoria = $.trim($("#traCategoria").val());
    console.log("valor de cageroia: " + traCategoria);

    if (
      traCategoria == "null" ||
      traCategoria === "0" ||
      traCategoria == null ||
      traCategoria === undefined
    ) {
      $.smkAlert({
        text: "El Grupo del activo no se encuentra categoriazado.",
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
    formData.append("crear", "1");
    formData.append("af_imagen1", $("#af_imagen1")[0].files[0]);
    formData.append("costoCompra", $.trim($("#costoCompra").val()));
    formData.append("tipoAct", $.trim($("#tipoAct").val()));
    formData.append("vidaUtil", $.trim($("#vidaUtil").val()));
    formData.append("estadoAct", $.trim($("#estadoAct").val()));
    formData.append("traCategoria", $.trim($("#traCategoria").val()));
    formData.append("sede", $.trim($("#sede").val()));

    $.ajax({
      type: "POST",
      url: "../controller/controlador_activosFijos.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data == 1) {
          $.smkAlert({
            text: "Activo Creado Con Éxito",
            type: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 600);
        } else {
          $.smkAlert({
            text: "El código o serial ya estan asignados a otro activo",
            type: "warning",
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        // Handle any errors that occurred during the AJAX request
      },
    });
  }
});
