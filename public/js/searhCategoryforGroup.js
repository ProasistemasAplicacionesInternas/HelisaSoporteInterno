function buscarCategoria() {
  var id_grupo = $("#af_categoria").val();
  consultCategory(id_grupo);
}

function consultCategory(id) {
  $.ajax({
    url: "../controller/controlador_gruposActivos.php",
    type: "POST",
    data: {
      actionsGroups: "findById",
      idGroup: id,
    },
    success: function (response) {
      var select = document.getElementById("traCategoria");
      select.innerHTML = "";
      var jsonObject = JSON.parse(response);
      var option = document.createElement("option");
      if (jsonObject.categoria !== undefined) {
        option.value = jsonObject.categoria;
      }
      option.text = jsonObject.nombre_categoria || ""; 
      option.selected;
      select.add(option);
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}

function diligenceCategory() {
  var select = document.getElementById("traCategoria");
}
