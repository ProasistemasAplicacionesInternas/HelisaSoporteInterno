<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css" />
    <link rel="stylesheet" href="public/css/smoke.min.css">

</head>

<body>

    <?php
       ini_set("session.cookie_lifetime",18000);
       ini_set("session.gc_maxlifetime",18000);

       session_start();
   
       if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
       }   
       require_once('../controller/controlador_departamentosInternos.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Departamentos internos</h6>
            </div>
            <?php if($_SESSION['id_roles']!=10):?>
                <div class="col-1 mt-4 mb-2">
                    <a href="" data-toggle="modal" data-target="#crearModal" data-backdrop="static"><img src="public/img/nuevo.png"></a>
                </div>
            <?php endif;?>
            

            <div class="col" id="padre_tabla"> 
                    <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                            <th style="width:50px;">Nro</th>
                            <th>Nombre Departamento</th>
                            <th style="width:100px;">Numero de personas</th>
                            <?php if($_SESSION['id_roles']==10 || $_SESSION['id_roles']==7 ):?>
                                <th style="width:50px;">Documentos</th>
                            <?php endif;?>
                            <?php if($_SESSION['id_roles']!=10):?>
                                <th style="width:50px;">Modificar</th>
                            <?php endif;?>
                            <th style="width:50px;">Areas</th>
                    </thead>
                    <tbody id="contenido_departamentos">
                        <?php foreach($departamentosInternos as $listado_departamentos):?>
                            <tr>
                                <td><?php echo $listado_departamentos['id_departamento'];?></td>
                                <td><?php echo $listado_departamentos['descripcion'];?></td>
                                <td><?php echo $listado_departamentos['personasxDepartamento'];?></td>
                                <?php if($_SESSION['id_roles']==10 || $_SESSION['id_roles']==7 ):?>
                                    <td align="center"> 
                                        <form action="app/view/documentosEnrevicion.php" method="post" target="_blank">
                                            <input type="hidden" name="id_departamento" id="id_doc" value="<?php echo $listado_departamentos['id_departamento'];?>">
                                            <input type="hidden" name="descripcion" id="descripcion" value="<?php echo $listado_departamentos['descripcion'];?>">
                                            <button type="submit" class="btn btm-light" disabled><i class="far fa-file-alt" class="ml-3" style="font-size: 20px;margin: 1%;"></i></button>
                                        </form>
                                    </td>
                                <?php endif;?>
                                <?php if($_SESSION['id_roles']!=10):?>
                                    <td><button type="button" onclick="modalDepartamento(<?php echo $listado_departamentos['id_departamento'];?>,'<?php echo $listado_departamentos['descripcion'];?>',<?php echo $listado_departamentos['estado'];?>)" class="btn btn-primary" id="btn-modificar" name="btn-modificar" data-toggle="modal" data-target="#modificarModal" data-backdrop="static"><span>Modificar</span></button></td>
                                <?php endif;?>
                                <td><button type="button" onclick="redireccionar(<?php echo $listado_departamentos['id_departamento'];?>)" class="btn btn-info" id="btn-modificar" name="btn-modificar"><span>Ver</span></button></td>
                            </tr>

                        <?php endforeach ?>
                        
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
                    <h6 class="modal-title">Modificar Departamento</h6>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar" id="cerrar_crear">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                            <form>
                                    <label for="">Id Departamento</label>
                                    <div><input class="form-control" type="text" name="modal_id" id="modal_id" class="crea_data" maxlength="29" autocomplete="off" value="" autofocus disabled></div>

                                    <label for="">Titulo</label>
                                    <div><input class="form-control" type="text" name="modal_descripcion" id="modal_descripcion" class="crea_data" maxlength="90" autocomplete="off" value="" required></div>

                                    <label for="">Estado</label>
                                    <div><select class="form-control" id="modal_estado" name="modal_estado" required>
                                        <option value="5">Activo</option>
                                        <option value="6">Inactivo</option>
                                    </select></div>

                                    <div class="modal-footer">
                                        <input type="button" value="Guardar" id="modal_guardar" name="modal_guardar" class="mt-4 btn btn-primary btn-lg"></div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Crear -->
    <div class="modal fade bd-example-modal-sm" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModal aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Crear Departamento</h6>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar" id="cerrar_crear">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                            <form>
                                <label for="">Titulo</label>
                                <div>
                                    <input class="form-control" type="text" name="modal_descripcionCrear" id="modal_descripcionCrear" class="crea_data" maxlength="90" autocomplete="off" value="" required>
                                </div>

                                <div class="modal-footer">
                                    <input type="button" value="Crear" id="crear_departamento" name="crear_departamento" class="mt-4 btn btn-success btn-lg">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/organigrama.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>