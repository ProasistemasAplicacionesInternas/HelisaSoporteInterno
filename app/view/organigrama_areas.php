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
       require_once('../controller/controlador_areas.php');
       require_once('../controller/controlador_departamentosInternos.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Areas Empresariales</h6>
            </div>
            <?php if($_SESSION['id_roles']!=10):?>
                <div class="col-1 mt-4 mb-2">
                    <a href="" data-toggle="modal" id="abrir_modal_crear" data-target="#crearModal" data-backdrop="static"><img src="public/img/nuevo.png"></a>
                </div>
            <?php endif;?>
            <div class="col-11 mt-2 mb-3 ml-5">
                <div class="col-5">
                    <label for="">Filtro Departamentos</label>
                    <select class="form-control" id="filtro_departamentos" name="filtro_departamentos" syle="maxwidth:50%;">
                        <option value="0">Todos</option>
                        <?php foreach($departamentosInternos as $listado_departamentos):?>
                            <option value="<?php echo $listado_departamentos['id_departamento'];?>"  <?php if(isset($auxiliar) && ($auxiliar==$listado_departamentos['id_departamento'])){ echo 'selected';}?> ><?php echo $listado_departamentos['descripcion'];?></option>
                        <?php endforeach;?> 
                    </select>
                </div>
            </div>
            
            

            <div class="col" id="padre_tabla">
                    <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                            <th style="width:50px;">Nro</th>
                            <th>Nombre Area</th>
                            <th>Departamento Asignado</th>
                            <th style="width:100px;">Numero de personas</th>
                            <?php if($_SESSION['id_roles']==10 || $_SESSION['id_roles']==7 ):?>
                                <th style="width:50px;">Documentos</th>
                            <?php endif;?>
                            <?php if($_SESSION['id_roles']!=10):?>
                                <th style="width:50px;">Modificar</th>
                            <?php endif;?>
                            <th style="width:50px;">Ver</th>
                    </thead>
                    <tbody id="contenido_areas">
                        <?php foreach($listado_areas AS $areas):?>
                            <tr>
                                <td><?php echo $areas['id_area'];?></td>
                                <td><?php echo $areas['descripcion'];?></td>
                                <td><?php echo $areas['departamento'];?></td>
                                <td><?php echo $areas['personasxArea'];?></td>
                                <?php if($_SESSION['id_roles']==10 || $_SESSION['id_roles']==7 ):?>
                                    <td align="center"> 
                                        <form action="app/view/documentos.php" method="post" target="_blank">
                                            <input type="hidden" name="id_departamento" id="id_doc" value="<?php echo $areas['id_area'];?>">
                                            <input type="hidden" name="descripcion" id="descripcion" value="<?php echo $areas['descripcion'];?>">
                                            <button type="submit" class="btn btm-light" disabled><i class="far fa-file-alt" class="ml-3" style="font-size: 20px;margin: 1%;"></i></button>
                                        </form>
                                    </td>
                                <?php endif;?>
                                <?php if($_SESSION['id_roles']!=10):?>
                                    <td><button type="button" onclick="modalArea(<?php echo $areas['id_area'];?>,'<?php echo $areas['descripcion'];?>',<?php echo $areas['estado'];?>,<?php echo $areas['id_departamento'];?>)" class="btn btn-primary" id="btn-modificar" name="btn-modificar" data-toggle="modal" data-target="#modificarModal" data-backdrop="static"><span>Modificar</span></button></td>
                                <?php endif;?>
                                <td><button type="button" onclick="redireccionar(<?php echo $areas['id_area'];?>)" class="btn btn-info" id="btn-modificar" name="btn-modificar"><span>Ver</span></button></td>
                            </tr>
                        <?php endforeach;?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
    <!-- Modales -->
    <!-- Modal Modificar -->
    <div class="modal fade bd-example-modal-sm" id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="modificarModal" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Modificar Area</h6>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar" id="cerrar_crear">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                            <form>
                                    <label for="">Id Area</label>
                                    <div><input class="form-control" type="text" name="modal_id" id="modal_id" class="crea_data" maxlength="29" autocomplete="off" value="" autofocus disabled></div>

                                    <label for="">Nomrbre Area</label>
                                    <div><input class="form-control" type="text" name="modal_descripcion" id="modal_descripcion" class="crea_data" maxlength="90" autocomplete="off" value="" required></div>

                                    <label for="">Estado</label>
                                    <div><select class="form-control" id="modal_estado" name="modal_estado" required>
                                        <option value="5">Activo</option>
                                        <option value="6">Inactivo</option>
                                    </select></div>

                                    <label for="">Departamento Asignado</label>
                                    <div><select class="form-control" id="modal_departamentoAsignado" name="modal_departamentoAsignado" required>
                                            <option value="">Seleccione un Departamento</option>
                                            <?php foreach($departamentosInternos as $listado_departamentos):?>
                                                <?php if($listado_departamentos['estado'] == 5): ?>
                                                    <option value="<?php echo $listado_departamentos['id_departamento'];?>"><?php echo $listado_departamentos['descripcion'];?></option>
                                                <?php endif;?>
                                            <?php endforeach;?>

                                        </select>
                                    </div>

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
    <div class="modal fade bd-example-modal-sm" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModal" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Crear Area</h6>
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

                                <label for="">Departamento Asignado</label>
                                    <div><select class="form-control" id="modal_departamentoCrear" name="modal_departamentoCrear" required>
                                            <option value="">Seleccione un Departamento</option>
                                            <?php foreach($departamentosInternos as $listado_departamentos):?>
                                                <?php if($listado_departamentos['estado'] == 5): ?>
                                                    <option value="<?php echo $listado_departamentos['id_departamento'];?>"><?php echo $listado_departamentos['descripcion'];?></option>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>


                                    <div class="modal-footer">
                                    <input type="button" value="Crear" id="crear_area" name="crear_area" class="mt-4 btn btn-success btn-lg">
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
    <script src="public/js/organigrama_areas.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
    
</body>

</html>