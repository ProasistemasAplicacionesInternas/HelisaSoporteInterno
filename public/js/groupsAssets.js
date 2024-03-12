/* ************* Consulta Inicial ************* */
$(document).ready(function () {
  consultAllGroups();
});

function consultAllGroups() {
  $.ajax({
    url: "app/controller/controlador_gruposActivos.php",
    type: "POST",
    data: { actionsGroups: "consultAll" },
    dataType: "json",
    success: function (data) {
      drawResults(data);
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX:", error);
    },
  });
}

function drawResults(data) {
  $.each(data, function (index, grupo) {
    var row = "<tr>";
    row += "<td>" + grupo.id_grupo + "</td>";
    row += "<td>" + grupo.nombre_grupo + "</td>";
    row += "<td>" + grupo.area_grupo + "</td>";
    row += "<td>" + grupo.nombre_categoria + "</td>";
    row +=
      '<td><i class="fas fa-edit text-primary" style="cursor: pointer;" onclick="modalUpdateGroup(' +
      grupo.id_grupo +
      ')"></i></td>';
    row += "</tr>";
    $("#tableBody").append(row);
  });
}

/* ************* Edición de información ************* */
function modalUpdateGroup(id) {
  
  $.ajax({
    url: "app/controller/controlador_gruposActivos.php",
    type: "POST",
    data: {
      actionsGroups: "findById",
      idGroup: id,
    },
    success: function (response) {
      
      consultAllCategoriesGroups("categoryGroup");
      showResult(response);

      $("#updateGroup").modal("show");
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}

function showResult(data) {
  var jsonObject = JSON.parse(data);
  document.querySelector("#groupId").value = jsonObject.id_grupo;
  document.querySelector("#actualNameGroup").value = jsonObject.nombre_grupo;
  document.querySelector("#actualCategoryGroup").value =
    jsonObject.nombre_categoria;
  document.querySelector("#nameGroup").value = jsonObject.nombre_grupo;
}

function consultAllCategoriesGroups(field) {
  $.ajax({
    url: "app/controller/controllerCategoryAssets.php",
    type: "POST",
    data: { actionsCategoryAssets: "consultAll" },
    dataType: "json",
    success: function (data) {
      drawOptionSelect(data, field);
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX:", error);
    },
  });
}

function drawOptionSelect(params, field) {
  var select = document.getElementById(field);
  var emptyOption = document.createElement("option");
  emptyOption.value = "";
  emptyOption.text = "";
  select.add(emptyOption);
  $.each(params, function (index, category) {
    var option = document.createElement("option");
    option.value = category.id;
    option.text = category.nombre_categoria;

    select.add(option);
  });
}

/* ************* Guardar Cambios Editados ************* */
function saveEditGroup() {
  var id = $("#groupId").val();
  var name = $("#nameGroup").val();
  var category = $("#categoryGroup").val();

  $.ajax({
    url: "app/controller/controlador_gruposActivos.php",
    type: "POST",
    data: {
      actionsGroups: "update",
      idGroup: id,
      nameGroup: name,
      categoryGroup: category,
    },
    success: function (response) {
      clearTableGroups();
      consultAllGroups();
      $("#updateGroup").modal("hide");
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}

/* ************* Crear Categorias ************* */
function modalCreateGroups() {
  $("#createGroup").modal("show");
  consultAllCategoriesGroups("createdCategoryGroup");
}

function saveCreatedGroups() {
  var nameGroup = $("#createdNameGroup").val();
  var categoryGroup = $("#createdCategoryGroup").val();
  
  saveGroup(nameGroup, categoryGroup);
}

function saveGroup(name, category) {
  
  $.ajax({
    url: "app/controller/controlador_gruposActivos.php",
    type: "POST",
    data: {
      actionsGroups: "create",
      nameGroup: name,
      categoryGroup: category,
    },
    success: function (response) {
      clearTableGroups();
      consultAllGroups();
      $("#createGroup").modal("hide");
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}

/*********** Limpiar Contenido de Tabla ************ */
function clearTableGroups() {
  var tabla = document.getElementById("tableGroups");
  var filas = tabla.getElementsByTagName('tr');

  for (var i = filas.length - 1; i > 0; i--) {
    tabla.deleteRow(i);
  }
}
