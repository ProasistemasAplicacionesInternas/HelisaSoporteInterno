<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/view_categories.css" media="screen" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="contenedor">
        <div class="section seccionFirst">
            <div class="container mt-4">

                <div class="row">
                    <div class="col-8">
                        <h5>Listado de Categorias</h5>
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
                            <h5 class="modal-title" id="updateCategoryLabel">Modificar Categoria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="modificarForm">
                                <div class="row">
                                    <input type="hidden" id="id_category">
                                    <div class="form-group col-6">
                                        <label for="actual_name">Nombre Actual</label>
                                        <input type="text" class="form-control" id="actual_name" name="actual_name"
                                            disabled>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="actual_area">Area Actual</label>
                                        <input type="text" class="form-control" id="actual_area" name="actual_area"
                                            disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" id="id_category">
                                    <div class="form-group col-6">
                                        <label for="new_name">Nuevo Nombre</label>
                                        <input type="text" class="form-control" id="new_name" name="new_name" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="new_area">Nueva Area</label>
                                        <select class="form-control" name="new_area" id="new_area" required>
                                            <option value=""></option>
                                            <option value="32">Administración</option>
                                            <option value="27">Tecnologia/Infraestructura</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveEditCategory()">Guardar
                                Cambios</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="createCategory">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCategoryLabel">Crear Categoria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createForm">
                                <div class="row">
                                    <input type="hidden" id="id_category">
                                    <div class="form-group col-6">
                                        <label for="created_name">Nombre Categoria</label>
                                        <input type="text" class="form-control" id="created_name" name="created_name"
                                            required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="created_area">Area</label>
                                        <select class="form-control" name="created_area" id="created_area" required>
                                            <option value=""></option>
                                            <option value="32">Administración</option>
                                            <option value="27">Tecnologia/Infraestructura</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveCreatedCategory()">Guardar
                                Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section seccionSecond">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-8">
                        <h5>Listado de Grupos</h5>
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
                    <h5 class="modal-title" id="updateGroupLabel">Modificar Gruposx</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modificarForm">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="actualNameGroup">Nombre Actual</label>
                                <input type="text" class="form-control" id="actualNameGroup" name="actualNameGroup"
                                    disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="actualCategoryGroup">Categoría Actual</label>
                                <input type="text" class="form-control" id="actualCategoryGroup"
                                    name="actualCategoryGroup" disabled>
                            </div>
                            <input type="hidden" id="groupId">
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nameGroup">Nuevo Nombre</label>
                                <input type="text" class="form-control" id="nameGroup" name="nameGroup">
                            </div>
                            <div class="form-group col-6">
                                <label for="categoryGroup">Nueva Categoría</label>
                                <select class="form-control" id="categoryGroup" name="categoryGroup"></select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveEditGroup()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="createGroup">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGroupLabel">Crear Grupos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modificarForm">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="createdNameGroup">Nombre</label>
                                <input type="text" class="form-control" id="createdNameGroup" name="createdNameGroup">
                            </div>
                            <div class="form-group col-6">
                                <label for="createdCategoryGroup">Nueva Categoría</label>
                                <select class="form-control" id="createdCategoryGroup"
                                    name="createdCategoryGroup"></select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveCreatedGroups()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="public/js/categoriesAssets.js"></script>
<script src="public/js/groupsAssets.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>