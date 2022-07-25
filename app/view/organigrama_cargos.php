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

       require_once('../controller/controlador_cargos.php');
       require_once('../controller/controlador_areas.php');
       
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Cargos</h6>
            </div>
            <?php if($_SESSION['id_roles']!=10):?>
                <div class="col-1 mt-4 mb-2">
                <a href="" data-toggle="modal" id="abrir_modal_crear" data-target="#crearModal" data-backdrop="static"><img src="public/img/nuevo.png"></a>
                </div>
            <?php endif;?>
            <div class="col-11 mt-2 mb-3 ml-5">
                <div class="col-5">
                    <label for="">Filtro Areas</label>
                        <select class="form-control" id="filtro_areas" name="filtro_areas">
                        <option value='0'>Todos</option>
                        <?php foreach($listado_areas as $area):?>
                            <option value="<?php echo $area['id_area'];?>" <?php if(isset($auxiliar) && ($auxiliar==$area['id_area'])){ echo 'selected';}?>><?php echo $area['descripcion'];?></option>
                        <?php endforeach;?> 

                    </select>
                </div>   
                
            </div>

            <div class="col" id="padre_tabla">
                    <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                            <th style="width:50px;">Nro</th>
                            <th>Nombre Cargo</i></th>
                            <th>Area Asignada</th>
                            <th>Departamento Asignado</th>
                            <th style="width:100px;">Numero de personas</th>
                            <?php if($_SESSION['id_roles']!=10):?>
                                <th style="width:50px;">Modificar</th>
                            <?php endif;?>
                    </thead>
                    <tbody id="contenido_cargos">
                        <?php foreach($listado_cargos AS $cargos):?>
                            <tr>
                                <td><?php echo $cargos['id_cargo'];?></td>
                                <td><?php echo $cargos['descripcion'];  if($cargos['auxiliarDp'] == 1){echo '  <i class="far fa-handshake fa-lg">';}?></td>
                                <td><?php echo $cargos['area'];?></td>
                                <td><?php echo $cargos['departamento'];?></td>
                                <td align="center"><?php echo $cargos['personasxCargo'];?></td>
                                <?php if($_SESSION['id_roles']!=10):?>
                                    <td><button type="button" onclick="modalCargo(<?php echo $cargos['id_cargo'];?>,'<?php echo $cargos['descripcion'];?>',<?php echo $cargos['estado'];?>,<?php echo $cargos['id_area'];?>,<?php echo $cargos['auxiliarDp'];?>)" class="btn btn-primary" id="btn-modificar" name="btn-modificar" data-toggle="modal" data-target="#modificarModal" data-backdrop="static"><span>Modificar</span></button></td>                                
                                <?php endif;?>
                            </tr>   
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
    <!-- Modaes -->
    <!-- Modal Modificar -->
    <div class="modal fade bd-example-modal-sm" id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="modificarModal" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Modificar Cargo</h6>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar" id="cerrar_crear">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                            <form>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="">Id Cargo</label>
                                            <div><input class="form-control" type="text" name="modal_id" id="modal_id" class="crea_data" maxlength="29" autocomplete="off" value="" autofocus disabled></div>
                                        </div>

                                        <div class="col-6">
                                            <label for="">Nomrbre Cargo</label>
                                            <div><input class="form-control" type="text" name="modal_descripcion" id="modal_descripcion" class="crea_data" maxlength="90" autocomplete="off" value="" required></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="">Estado</label>
                                            <div><select class="form-control" id="modal_estado" name="modal_estado" required>
                                                <option value="5">Activo</option>
                                                <option value="6">Inactivo</option>
                                            </select></div>
                                        </div>

                                        <div class="col-6">
                                            <label for="">Area Asignada</label>
                                            <div><select class="form-control" id="modal_areaAsignado" name="modal_areaAsignado" required>
                                                    <option value="">Seleccione una Opcion</option>
                                                    <?php foreach($listado_areas as $area):?>
                                                        <?php if($area['estado'] == 5 && $area['estado_departamento'] == 5): ?>
                                                            <option value="<?php echo $area['id_area'];?>"><?php echo $area['descripcion'];?></option>
                                                        <?php endif;?>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row" <?php if($_SESSION['id_roles'] != 7 && $_SESSION['id_roles']!= 1){echo 'style=display:none';}?>>
                                        <div class="col-6">
                                            <label>Auxiliar de Departamento</label>
                                            <div>
                                                <select class="form-control" id="modal_auxiliarDp" name="modal_auxiliarDp">
                                                    <option value="0">Inactivo</option>
                                                    <option value="1">Activo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <?php include('../controller/controlador_plataformas.php'); ?>
                                    <div <?php if($_SESSION['id_roles'] != 1 && $_SESSION['id_roles'] != 7){echo 'style=display:none';}?>>
                                    <input type="search" placeholder="Buscar..." id="buscador" style="float:right;position:relative;top:15px">
                                    <br><label>Plataformas Designadas 
                                            <button type="button" style="border:0px" onclick="limpiarChecks();" title="Deseleccionar"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                            <button type="button" style="border:0px"  title="Seleccionados" id="verSeleccionados"><i class="fas fa-eye fa-lg" style="color:black" aria-hidden="true"></i></button>
                                            <button type="button" style="border:0px"  title="Ver todas" id="verTodas"><i class="fas fa-eye-slash fa-lg" aria-hidden="true"></i></button>
                                        </label>
                                        
                                        <div class="form-group checkbox-group required" style="overflow-y:scroll;height:auto;max-height:300px">
                                            <table class="table table-striped tablesorter" id="result" >
                                                <tbody >
                                                    <?php foreach($plataformas as $listado):?>
                                                        <?php if($listado['estado'] == 5):?>
                                                        <tr>
                                                        <td id="td<?=$listado['id_plataforma']?>"><input type="checkbox" id="plataformas<?=$listado['id_plataforma']?>" value="<?=$listado['id_plataforma']?>">  <?= $listado['descripcion']?></td> 
                                                        </tr>
                                                        <?php endif;?>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>

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
                    <h6 class="modal-title">Crear Cargo</h6>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar" id="cerrar_crear">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                            <div class="col-12">
                                <form>
                                    <label for="">Titulo</label>
                                    <div>
                                    <input class="form-control" type="text" name="modal_descripcionCrear" id="modal_descripcionCrear" class="crea_data" maxlength="90" autocomplete="off" value="" required>
                                    </div>

                                    <label for="">Area Asignada</label>
                                    <div><select class="form-control" id="modal_areaCrear" name="modal_areaCrear" required> 
                                            <option value="">Seleccione una Opcion</option>
                                            <?php foreach($listado_areas as $area):?>
                                                <?php if($area['estado'] == 5 && $area['estado_departamento'] == 5): ?>
                                                    <option value="<?php echo $area['id_area'];?>"><?php echo $area['descripcion'];?></option>
                                                <?php endif;?>
                                            <?php endforeach;?>    
                                        </select>
                                    </div>


                                    <div class="modal-footer">
                                    <input type="button" value="Crear" id="crear_cargo" name="crear_area" class="mt-4 btn btn-success btn-lg">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="public/js/jquery-3.3.1.min.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/lenguajeTablas.js"> </script>
    <script src="public/js/organigrama_cargos.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>


