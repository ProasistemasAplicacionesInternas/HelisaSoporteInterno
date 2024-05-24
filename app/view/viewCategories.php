<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/viewCategories.css" media="screen" type="text/css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/smoke.min.css">
</head>

<body>
    <div class="contenedor">
        <div class="section seccionFirst">
            <div class="container mt-4">

                <div class="row">
                    <div class="col-8">
                        <h5>Listado de categorías</h5>
                    </div>
                    <div class="col-4">
                        <img src="public/img/nuevo.png" alt="Imagen" id="abrirModalImagen"
                            onclick=modalCreateCategory();>
                    </div>
                </div>

                <table class="table" id="tableCategory">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Área</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableBodyCategory">

                    </tbody>
                </table>
            </div>

            <div class="modal" tabindex="-1" id="updateCategory">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateCategoryLabel">Modificar categoría</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <div class="modal-body">
                            <form id="modificarForm">
                                <div class="row">
                                    <input type="hidden" id="id_category">
                                    <div class="form-group col-6">
                                        <label for="new_name">Nuevo nombre</label>
                                        <input type="text" class="form-control" id="new_name" name="new_name" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="new_area">Nueva área</label>
                                        <select class="form-control" name="new_area" id="new_area" required>
                                            <option value=""></option>
                                            <option value="32">Administración</option>
                                            <option value="27">Infraestructura</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="return saveEditCategory();">Guardar
                                cambios</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="createCategory">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCategoryLabel">Crear categoría</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <div class="modal-body">
                            <form id="createForm">
                                <div class="row">
                                    <input type="hidden" id="id_category">
                                    <div class="form-group col-6">
                                        <label for="created_name">Nombre categoría</label>
                                        <input type="text" class="form-control" id="created_name" name="created_name"
                                            required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="created_area">Área</label>
                                        <select class="form-control" name="created_area" id="created_area" required>
                                            <option value=""></option>
                                            <option value="32">Administración</option>
                                            <option value="27">Infraestructura</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="saveCreatedCategory()">Guardar
                                cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section seccionSecond">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-8">
                        <h5>Listado de grupos</h5>
                    </div>
                    <div class="col-4">
                        <img src="public/img/nuevo.png" alt="Imagen" id="" onclick=modalCreateGroups();>
                    </div>
                </div>
                <table class="table" id="tableGroups">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Área</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="updateGroup">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateGroupLabel">Modificar grupos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form id="modificarForm">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nameGroup">Nuevo nombre</label>
                                <input type="text" class="form-control" id="nameGroup" name="nameGroup" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="newCategoryGroup">Nueva categoría</label>
                                <select class="form-control" id="newCategoryGroup" name="newCategoryGroup" required></select>
                            </div>
                            <input type="hidden" id="groupId">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="return saveEditGroup();">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="createGroup">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGroupLabel">Crear grupos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form id="modificarForm">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="createdNameGroup">Nombre</label>
                                <input type="text" class="form-control" id="createdNameGroup" name="createdNameGroup">
                            </div>
                            <div class="form-group col-6">
                                <label for="createdCategoryGroup">Nueva categoría</label>
                                <select class="form-control" id="createdCategoryGroup"
                                    name="createdCategoryGroup"></select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="saveCreatedGroups()">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="public/js/categoriesAssets.js"></script>
<script src="public/js/groupsAssets.js"></script>
<script src="public/js/popper.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/bootstrap.bundle.min.js"></script>
<script src="public/js/smoke.min.js"></script>

</html>