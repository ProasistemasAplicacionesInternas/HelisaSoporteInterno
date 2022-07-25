<?php 

require('../controller/controlador_areas.php');
require('../controller/controlador_funcionarios.php');
require('../controller/controlador_gruposActivos.php'); 
//*****************************************************************************************************//
//******************************* FORMULARIO PARA LA CREACION DE FUNCIONARIOS *************************//
//*****************************************************************************************************//
    /* ini_set("session.cookie_lifetime",18000);
    ini_set("session.gc_maxlifetime",18000);
    session_start(); */

    if(!isset($_SESSION['usuario'])){

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
    <link rel="stylesheet" href="../../public/css/activosFijos.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
</head>
<body>
	<header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/Logo_blanco.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <h6 class="mt-3" style="color:#5BB94B"><b>Creación De Activos Fijos</b></h6>
            <div class="col-12 ml-5">
                <form class="form-group" id="formulario">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>C&oacutedigo De Activo</label>
                                <input type="text" id="af_codigo" name="af_codigo" class="form-control info" maxlength="25" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Serial</label>
                                <input type="text" id="af_serial" name="af_serial"  class="form-control info" maxlength="260" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" id="af_marca" name="af_marca" class="form-control info" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input type="text" id="af_modelo" name="af_modelo" class="form-control info" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="af_nombre" name="af_nombre" class="form-control info" maxlength="100" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Area de Creacion</label>
                                <select class="form-control info" id="af_areaCreacion" name="af_areaCreacion" required>
                                    <option value='' selected>Seleccione el Area de Creacion</option>
                                    <option value='Infraestructura'>Infraestructura</option>
                                    <option value='Administración'>Administracion</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Fecha Compra</label>
                                <input type="date" id="af_fechaCompra" name="af_fechaCompra" class="form-control info" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Grupo Del Activo</label>
                                <select class="form-control info" id="af_categoria" name="af_categoria" required>
                                    <option value='' selected>Seleccione Grupo Del Activo</option>
                                    
                                    <?php foreach($listado_grupos AS  $grupos):?>
                                        <?php if($grupos['area_grupo'] == 32):?>
                                            <option value="<?php echo $grupos['id_grupo'];?>" class="administracion"><?php echo $grupos['nombre_grupo'];?></option>
                                        <?php endif;?>
                                    <?php endforeach;?>

                                    <?php foreach($listado_grupos AS  $grupos):?>
                                        <?php if($grupos['area_grupo'] == 27):?>
                                            <option value="<?php echo $grupos['id_grupo'];?>"  class="infraestructura"><?php echo $grupos['nombre_grupo'];?></option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div> 
                        <div class="col-3">
                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control info" id="af_estado" name="af_estado" required>
                                    <option value="" selected> seleccione Estado</option>
                                    <option value="15">Disponible</option>
                                    <option value="14">Asignado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Ubicación/Area</label>
                                <select class="form-control info" id="af_area" name="af_area" required>
                                    <option value='' selected>Seleccione Area</option>
                                    <?php  
                                    foreach($listado_areas as $area){
                                            echo "<option value='".$area["id_area"]."'>".$area["descripcion"] . "</option>" ;
                                              }  
                                     ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Ubicacion Activo</label>
                                <select class="form-control info" id="af_ubicacion" name="af_ubicacion" required>
                                    <option value="" selected> seleccione Estado</option>
                                    <option value="Oficina">Oficina</option>
                                    <option value="Trabajo en casa">Trabajo en casa</option>
                                    <option value="Activo de uso interno y externo">Activo de uso interno y externo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div id="encargado" class="encargadoActivo">
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label>Funcionario Responsable</label>
                                    <select class="form-control info" id="af_responsable" name="af_responsable">
                                        <option value='' selected>Seleccione Un Funcionario</option>
                                        <?php
                                             foreach($listado_funcionarios as $crud){
                                                echo "<option value='".$crud["identificacion"]."'>".$crud["nombre"] . "</option>" ;
                                                  }  
                                         ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Fecha Asignación</label>
                                    <input type="date" id="af_fechaAsignacion" name="af_fechaAsignacion" class="form-control info">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="datos_adicionales" class="equipos" >  
                        <div class="row">
                            <div class="col-9 mt-4">
                                <div class="form-group">
                                    <label><h5 style="color:#5BB94B"><b>Datos Hardware</b></h5></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Ram</label>
                                    <input type="text" id="af_ram" name="af_ram" class="form-control info">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Disco Duro</label>
                                    <input type="text" id="af_discoDuro" name="af_discoDuro" class="form-control info">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Procesador</label>
                                    <input type="text" id="af_procesador" name="af_procesador" class="form-control info">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9 mt-4">
                                <div class="form-group">
                                    <label><h5 style="color:#5BB94B"><b>Datos Software</b></h5></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Sistema Operativo</label>
                                    <input type="text" id="af_so" name="af_so" class="form-control info">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Licencia Sistema Operativo</label>
                                    <input type="text" id="af_licenciaSo" name="af_licenciaSo" class="form-control info">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Dominio</label>
                                    <input type="text" id="af_dominio" name="af_dominio" class="form-control info">
                                </div>
                            </div>
                            
                            <div class="col-9">
                                <div class="form-group">
                                    <label>Aplicaciones Instaladas</label>
                                    <input type="text" id="af_aplicaciones" value="7-Zip - Google Chrome - BitDefender - LibreOffice - Adobe Reader" name="af_aplicaciones" class="form-control info">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Licencia Office</label>
                                    <input type="text" id="af_office" name="af_office" class="form-control info">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Licencia Antivirus</label>
                                    <input type="text" id="af_antivirus" name="af_antivirus" class="form-control info">
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Observaciones</label>
                                <textarea name="af_observaciones" id="af_observaciones" cols="134" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <input type="hidden" id="nombre_usu" name="nombre_usu" value="<?php echo $_SESSION['usuario'] ?>">
                            <input type="button" value="Crear Activo" id="crear_activoFijo" name="crear_activoFijo" class="mt-4 btn btn-primary btn-sm btn-guardar" >
                        </div>
                        <div class="col-4" > 
                            <a href="../../dashboard.php" class="mt-4 btn btn-danger" style="height:30px";  >Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>
    <script src="../../public/js/filtroActivos.js"></script>
    <script src="../../public/js/funcionario_oculto.js"></script>
    <script src="../../public/js/validacion_activo.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
</body>
</html>