<?php 
require_once('../controller/controlador_areas.php');
require_once('../controller/controlador_cargos.php');
require_once('../controller/control_tipo_accesos.php');
require_once('../controller/controlador_departamentosInternos.php');
require_once('../controller/controlador_centroCostos.php');

//*****************************************************************************************************//
//********************************FORMULARIO PARA LA CREACION DE FUNCIONARIOS**************************//
//*****************************************************************************************************//

    /* ini_set("session.cookie_lifetime",18000);
    ini_set("session.gc_maxlifetime",18000);
    session_start(); */

    if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_roles'])){
       header('location:../../login.php');
     }


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="../../public/css/funcionarios.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
</head>

<body>

    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/logo.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <h6 class="mt-3">Creacion De Funcionarios</h6>
        </div>
            <div class="col-12 ml-5">
                <form  class="form-group" id="formularioCrear">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Identificacion</label>
                                <input type="text" id="f_identificacion" name="f_identificacion" class="form-control info" maxlength="25" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="f_nombre" name="f_nombre" class="form-control info" maxlength="260" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label>Correo Corporativo</label>
                                <input type="email" id="f_correo" name="f_correo" class="form-control info" maxlength="100" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="col-1">
                            <div class="form-group">
                                <label>Extension</label>
                                <input type="text" id="f_extension" name="f_extension" class="form-control info" maxlength="6" autocomplete="off" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Correo Personal</label>
                                <input type="email" id="f_correo2" name="f_correo2" class="form-control info" maxlength="100" autocomplete="off" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Departamento Interno</label>
                                <select class="form-control info" id="f_departamentosInt" name="f_departamentosInt" required>
                                    <option value='' selected>Seleccione Departamento Interno</option>
                                    <?php foreach($departamentosInternos as $listado_departamentos):?>
                                        <?php if($listado_departamentos['estado'] == 5):?>
                                            <option value='<?php echo $listado_departamentos['id_departamento'];?>'><?php echo $listado_departamentos['descripcion'];?></option>
                                        <?php endif;?>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Area</label>
                                <select class="form-control info" id="f_area" name="f_area" required>
                                <option value='' selected>Seleccione Area</option>
                                    <?php  foreach($listado_areas as $area):?>
                                        <?php if($area['estado'] == 5 && $area['estado_departamento'] == 5):?>                 
                                            <option value='<?php echo $area["id_area"];?>' class="areaCP areaCS<?php echo $area['id_departamento'];?>"><?php echo $area['descripcion'];?></option>
                                                
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Cargo</label>
                                <select class="form-control info" id="f_cargo" name="f_cargo" required>
                                    <option value='' selected>Seleccione Cargo</option>
                                    <?php foreach($listado_cargos as $cargo): ?>
                                            <?php if($cargo['estado'] == 5 && $cargo['estado_area'] == 5 && $cargo['estado_departamento'] == 5 ):?>
                                                <option value='<?php echo $cargo['id_cargo'];?>' class="cargoCP cargoCS<?php echo $cargo['id_area'];?>"><?php echo $cargo['descripcion'];?></option>
                                            <?php endif;?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Centro de Costos</label>
                                <select class="form-control info" id="f_centroCostos" name="f_centroCostos" required>
                                    <option value='' selected>Seleccione Centro de Costos</option> 
                                    <?php foreach($centroDeCostos as $centros):?>
                                        <option value='<?php echo $centros['id_centroCostos'];?>'><?php echo $centros['descripcion'];?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Codigo</label>
                                    <input type="text" id="centroCostosCodigo" name="centroCostosCodigo" class="form-control info" value="" readonly>                     
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" id="f_usuario" name="f_usuario" class="form-control info" maxlength="50" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label >Rol</label>
                                <select class="form-control info" id="f_rol_funcionario" name="f_rol_funcionario">
                                    <option value="4" selected>Funcionario</option>
                                    <option value="2">Procesos Administración</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Contraseña</label>
                            <input type="text" id="f_contrasena" name="f_contrasena" class="form-control info" maxlength="50" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <input type="button" value="Crear" id="btn-guardar" name="crear_funcionario" class="mt-4 btn btn-primary btn-sm btn-guardar">
                        </div>
                        <div class="col-3" > 
                                <a id="cerrar_creacion" class="mt-4 btn btn-danger" style="height:30px";  >Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    
    
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>
    <script src="../../public/js/centro_de_costos.js"></script> 
    <script src="../../public/js/validacion_funcionario.js?v"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    
</body>
</html>