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
        var icon = iconStatusCategory(category.code_state);
        var row = "<tr>";
        row += "<td>" + category.id + "</td>";
        row += "<td>" + category.nombre_categoria + "</td>";
        row += "<td>" + category.nombre_area + "</td>";
        row +=
          '<td><i class="fas fa-edit text-primary" style="cursor: pointer;" title="Modificar" onclick="modalUpdateCategory(' +
          category.id +
          ')"></i>' +
          "  " +
          icon +
          category.id +
          ')"></i> </td>';
        row += "</tr>";
        $("#tableBodyCategory").append(row);
      });
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX:", error);
    },
  });
}

function iconStatusCategory(params) {
  if (params == 5) {
    iconInactive =
      '<i class="fa-regular fa-rectangle-xmark" title="Inactivar" style="color: red; cursor: pointer;" onclick="inactivateCategory(';
    return iconInactive;
  }
  iconActive =
    '<i class="fa-regular fa-square-check" title="Activar" style="color: green; cursor: pointer;" onclick="activateCategory(';
  return iconActive;
}
/*************** Activar e Inactivar Categoria ****************/
function activateCategory(id) {
  saveStatusRequestCategory(id, 5);
}

function inactivateCategory(id) {
  saveStatusRequestCategory(id, 6);
}

function saveStatusRequestCategory(id, new_status) {
  $.ajax({
    url: "app/controller/controllerCategoryAssets.php",
    type: "POST",
    data: {
      actionsCategoryAssets: "updateStatus",
      idCategory: id,
      status: new_status,
    },
    success: function (response) {
      if (response == 200) {
        $.smkAlert({
          text: "¡Modificación de categoría Exitosa!",
          type: "success",
        });
        clearTable();
        consultAllCategories();
      } else {
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
function modalUpdateCategory(id) {
  
  $.ajax({
    url: "app/controller/controllerCategoryAssets.php",
    type: "POST",
    data: {
      actionsCategoryAssets: "findById",
      idCategory: id,
    },
    success: function (response) {
      showResultCategory(response);

      $("#updateCategory").modal("show");
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}

function showResultCategory(data) {

  var jsonObject = JSON.parse(data);
  console.log("Datos recibidos del servidor:", jsonObject);

  document.querySelector("#id_category").value = jsonObject.id;
  // document.querySelector("#actual_name").value = jsonObject.nombre_categoria;
  // document.querySelector("#actual_area").value = jsonObject.nombre_area;
  document.querySelector("#new_name").value = jsonObject.nombre_categoria;


  var newAreaElement = document.querySelector("#new_area");

  // Depuración de los valores de las opciones del select
  console.log("Opciones disponibles en new_area:");
  Array.from(newAreaElement.options).forEach(option => {
    console.log("Valor:", option.value, "Texto:", option.text);
  });

  newAreaElement.value = jsonObject.id_area;

  // Si el valor no se selecciona correctamente, forzar la selección
  if (newAreaElement.value !== jsonObject.id_area) {
    var options = newAreaElement.options;
    for (var i = 0; i < options.length; i++) {
      if (options[i].value == jsonObject.id_area) {
        options[i].selected = true;
        break;
      }
    }
  }

  // Verificar el valor del select después de la asignación
  console.log("Valor del campo new_area después de la asignación:", newAreaElement.value);
}

function getCategoryById(id) {
  $.ajax({
    url: "app/controller/controllerCategoryAssets.php",
    type: "POST",
    data: {
      actionsCategoryAssets: "findById",
      idCategory: id,
    },
    success: function (response) {
      showResultCategory(response); // Asegúrate de que response sea un JSON válido
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX:", error);
    },
  });
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
  $("#createCategory").modal("hide");
  $("#created_name").val("");
  $("#created_area").val("");
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
