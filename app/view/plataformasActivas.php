<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css" />
    <link rel="stylesheet" href="public/css/smoke.min.css">
    <link rel="stylesheet" href="public/css/plataformasEstilos.css">


</head>

<body>

    <?php
    ini_set("session.cookie_lifetime", 18000);
    ini_set("session.gc_maxlifetime", 18000);

    session_start();

    if (!isset($_SESSION['usuario'])) {

        header('location:../../login.php');
    }
    require('../controller/controlador_plataformas.php');
    require('../controller/controlador_funcionarios.php');

    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Plataformas Activas </h6>
            </div>
            <div class="col-1 mt-4 mb-2">
                <a href="" data-toggle="modal" data-target="#crearModal" data-backdrop="static"><img src="public/img/nuevo.png"></a>
            </div>

            <div class="col" id="padre_tabla"> <!-- Ver archivo Organigrama.js -->
                <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                        <th style="width: 15%;">ID</th>
                        <th style="width: 35%;">Título</th>
                        <th style="width: 35%;">Administrador</th>
                        <th style="width: 15%;">Modificar</th>
                    </thead>
                    <tbody id="contenido_departamentos">
                        <?php foreach ($plataformas as $listado_plataformas) {
                            if ($listado_plataformas['estado'] == 5) {
                        ?>
                                <tr>
                                    <td><?= $listado_plataformas['id_plataforma'] ?></td>
                                    <td><?= $listado_plataformas['descripcion'] ?></td>
                                    <td><?= $listado_plataformas['nombre'] ?></td>
                                    <td><button type="button" onclick="modalModificar(<?php echo $listado_plataformas['id_plataforma']; ?>,'<?php echo $listado_plataformas['descripcion']; ?>',<?php echo $listado_plataformas['administrador']; ?>,<?php echo $listado_plataformas['estado']; ?>)" class="btn btn-primary" id="btn-modificar" name="btn-modificar" data-toggle="modal" data-target="#modificarModal" data-backdrop="static"><span>Modificar</span></button></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Modals -->
    <!-- Modal modificar -->
    <div class="modal fade bd-example-modal-sm" id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="modificarModal" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Modificar Plataforma</h6>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar" id="cerrar_crear">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form>
                                    <label for="">Id Plataforma</label>
                                    <div><input class="form-control" type="text" name="modal_id" id="modal_id" class="crea_data" maxlength="29" autocomplete="off" value="" autofocus disabled></div>

                                    <label for="">Título</label>
                                    <div><input class="form-control" type="text" name="modal_descripcion" id="modal_descripcion" class="crea_data" maxlength="90" autocomplete="off" value="" required disabled></div>

                                    <label for="">Administrador</label>
                                    <div><select class="form-control" id="modal_administrador" name="modal_administrador" required>
                                            <option value=''>Seleccione Un Funcionario</option>
                                            <?php
                                            foreach ($listado_funcionarios as $crud) {
                                                echo "<option value='" . $crud["identificacion"] . "'>" . $crud["nombre"] . "</option>";
                                            }
                                            ?>
                                        </select></div>

                                    <label for="">Estado</label>
                                    <div>
                                        <select class="form-control" id="modal_estado" name="modal_estado" required>
                                            <option value='5'>Activo</option>
                                            <option value='6'>Inactivo</option>
                                        </select>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="button" value="Guardar" id="modificar_plataforma" name="modificar_plataforma" class="mt-4 btn btn-success btn-lg">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Crear -->
    <div class="modal fade bd-example-modal-sm" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModal aria-hidden=" true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Crear Plataforma</h6>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar" id="cerrar_crear">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form>
                                    <label for="">Título</label>
                                    <div>
                                        <input class="form-control" type="text" name="modal_descripcionCrear" id="modal_descripcionCrear" class="crea_data" maxlength="90" autocomplete="off" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Administrador</label>
                                        <select class="form-control info" id="modal_administradorCrear" name="modal_administradorCrear" required>
                                            <option value='' selected>Seleccione Un Funcionario</option>
                                            <?php
                                            foreach ($listado_funcionarios as $crud) {
                                                echo "<option value='" . $crud["identificacion"] . "'>" . $crud["nombre"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="button" value="Crear" id="crear_plataforma" name="crear_plataforma" class="mt-4 btn btn-success btn-lg">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="public/js/jquery-3.3.1.min.js"></script> -->
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/plataformasActivas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>