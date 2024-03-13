/* ************* Consulta Inicial ************* */
$(document).ready(function () {
  consultAllCategories();
});

function consultAllCategories() {
  $.ajax({
    url: "app/controller/controllerCategoryAssets.php",
    type: "POST",
    data: { actionsCategoryAssets: "consultAll" },
    dataType: "json",
    success: function (data) {
      $.each(data, function (index, category) {
        var icon = iconStatus(category.code_state);
        var row = "<tr>";
        row += "<td>" + category.id + "</td>";
        row += "<td>" + category.nombre_categoria + "</td>";
        row += "<td>" + category.nombre_area + "</td>";

        row +=
          '<td><i class="fas fa-edit text-primary" style="cursor: pointer;" title="Modificar" onclick="modalUpdateCategory(' +
          category.id + ')"></i>'+'  '+ icon + category.id +')"></i> </td>';
        row += "</tr>";
        $("#tableBodyCategory").append(row);
      });
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX:", error);
    },
  });
}

function iconStatus(params) {
  if (params == 5) {
    iconInactive = '<i class="fa-regular fa-rectangle-xmark" title="Inactivar" style="color: red; cursor: pointer;" onclick="inactivateCategory(';
    return iconInactive;
  }
      iconActive = '<i class="fa-regular fa-square-check" title="Activar" style="color: green; cursor: pointer;" onclick="activateCategory(';
  return iconActive;
}
/*************** Activar e Inactivar Categoria ****************/
function activateCategory(id){
  saveStatusRequest(id,5);
}

function inactivateCategory(id){
  saveStatusRequest(id,6)
}

function saveStatusRequest(id, new_status){
  $.ajax({
    url: "app/controller/controllerCategoryAssets.php",
    type: "POST",
    data: {
      actionsCategoryAssets: "updateStatus",
      idCategory: id,
      status: new_status,
    },
    success: function (response) {
      clearTable();
      consultAllCategories();
      //$("#updateCategory").modal("show");
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}
/* ************* Edición de información ************* */
function modalUpdateCategory(id) {
  $.ajax({
    url: "app/controller/controllerCategoryAssets.php",
    type: "POST",
    data: {
      actionsCategoryAssets: "findById",
      idCategory: id,
    },
    success: function (response) {
      showResult(response);

      $("#updateCategory").modal("show");
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}

function showResult(data) {
  var jsonObject = JSON.parse(data);
  document.querySelector("#id_category").value = jsonObject.id;
  document.querySelector("#actual_name").value = jsonObject.nombre_categoria;
  document.querySelector("#actual_area").value = jsonObject.nombre_area;
  document.querySelector("#new_name").value = jsonObject.nombre_categoria;
}

/* ************* Guardar Cambios Editados ************* */
function saveEditCategory() {
  var id = $("#id_category").val();
  var newName = $("#new_name").val();
  var newArea = $("#new_area").val();

  $.ajax({
    url: "app/controller/controllerCategoryAssets.php",
    type: "POST",
    data: {
      actionsCategoryAssets: "update",
      idCategory: id,
      nameCategory: newName,
      areaCategory: newArea,
    },
    success: function (response) {
      clearTable();
      consultAllCategories();
      $("#updateCategory").modal("hide");
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}

/* ************* Crear Categorias ************* */

function modalCreateCategory() {
  $("#createCategory").modal("show");
}

function saveCreatedCategory() {
  var nameCategory = $("#created_name").val();
  var areaCategory = $("#created_area").val();
  saveCategory(nameCategory, areaCategory);
}

function saveCategory(name, area) {
  $.ajax({
    url: "app/controller/controllerCategoryAssets.php",
    type: "POST",
    data: {
      actionsCategoryAssets: "create",
      idCategory: null,
      nameCategory: name,
      areaCategory: area,
    },
    success: function (response) {
      clearTable();
      consultAllCategories();
      $("#createCategory").modal("hide");
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}

/*********** Limpiar Contenido de Tabla ************ */
function clearTable() {
  var tabla = document.getElementById("tableCategory");
  var filas = tabla.getElementsByTagName("tr");

  for (var i = filas.length - 1; i > 0; i--) {
    tabla.deleteRow(i);
  }
}
