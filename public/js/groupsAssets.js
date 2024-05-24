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
  $("#tableBody").empty();
  $.each(data, function (index, grupo) {
    var icon = iconStatus(grupo.status);
    var row = "<tr>";
    row += "<td>" + grupo.id_grupo + "</td>";
    row += "<td>" + grupo.nombre_grupo + "</td>";
    row += "<td>" + grupo.area_grupo + "</td>";
    row += "<td>" + grupo.nombre_categoria + "</td>";
    row +=
      '<td><i class="fas fa-edit text-primary" style="cursor: pointer;" onclick="modalUpdateGroup(' +
      grupo.id_grupo +
      ')"></i>' +
      "  " +
      icon +
      grupo.id_grupo +
      ')"></i> </td>';
    row += "</tr>";
    $("#tableBody").append(row);
  });
}

function iconStatus(params) {
  if (params == 5) {
    iconInactive =
      '<i class="fa-regular fa-rectangle-xmark" title="Inactivar" style="color: red; cursor: pointer;" onclick="inactivateGroup(';
    return iconInactive;
  }
  iconActive =
    '<i class="fa-regular fa-square-check" title="Activar" style="color: green; cursor: pointer;" onclick="activateGroup(';
  return iconActive;
}

/*************** Activar e Inactivar Grupo ***************/
function activateGroup(id) {
  saveStatusRequestGroup(id, 5);
}

function inactivateGroup(id) {
  saveStatusRequestGroup(id, 6);
}

function saveStatusRequestGroup(id, new_status) {
  $.ajax({
    url: "app/controller/controlador_gruposActivos.php",
    type: "POST",
    data: {
      actionsGroups: "updateStatus",
      idGroup: id,
      statusGroup: new_status,
    },
    success: function (response) {
      if (response == 200) {
        $.smkAlert({
          text: "¡Modificación de grupo Exitosa!",
          type: "success",
        });
        clearTableGroups();
        consultAllGroups();
      }else{
        $.smkAlert({
          text: "¡Error en la Modificación!",
          type: "Danger",
        });
      }
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
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
    dataType: "json",
    success: function (response) {
      var group = response;
      consultAllCategoriesGroups("newCategoryGroup", function () {
        showResultGroup(group);
      });
      $("#updateGroup").modal("show");
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}

function showResultGroup(group) {
  document.querySelector("#groupId").value = group.id_grupo;
  document.querySelector("#nameGroup").value = group.nombre_grupo;
  document.querySelector("#newCategoryGroup").value = group.categoria;
}

function consultAllCategoriesGroups(field, callback) {
  $.ajax({
    url: "app/controller/controllerCategoryAssets.php",
    type: "POST",
    data: { actionsCategoryAssets: "consultAll" },
    dataType: "json",
    success: function (data) {
      drawOptionSelect(data, field);
      if (callback) callback();
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX:", error);
    },
  });
}

function drawOptionSelect(categories, field) {
  var select = document.getElementById(field);
  select.innerHTML="";
  var emptyOption = document.createElement("option");
  emptyOption.value = "";
  emptyOption.text = "";
  select.add(emptyOption);
  categories.forEach(function (category) {
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
  var category = $("#newCategoryGroup").val();

  if (!name) {
    $.smkAlert({
      text: "¡El campo 'Nuevo nombre' no puede estar vacío!",
      type: "danger",
    });
    return false;
  }

  if (!category) {
    $.smkAlert({
      text: "¡El campo 'Nueva categoría' no puede estar vacío!",
      type: "danger",
    });
    return false; 
  }


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

/* ************* Crear Grupo ************* */
function modalCreateGroups() {
  $("#createGroup").modal("hide");
  $("#createdNameGroup").val("");
  $("#createdCategoryGroup").val("");
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
  var filas = tabla.getElementsByTagName("tr");

  for (var i = filas.length - 1; i > 0; i--) {
    tabla.deleteRow(i);
  }
}
