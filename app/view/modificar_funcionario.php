<?php


    ini_set("session.cookie_lifetime",18000);
    ini_set("session.gc_maxlifetime",18000);
   session_start();
     $_SESSION['id_roles'];

   if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
     }     
  
        $f_identificacion=$_POST['f_identificacion']; 
        $f_nombre=$_POST['f_nombre'];
        $f_correo=$_POST['f_email'];
        $f_correo2=$_POST['f_email2'];
        $f_area=$_POST['f_area'];
        $f_cargo=$_POST['f_cargo'];
        $f_extension=$_POST['f_extension'];
        $f_usuario=$_POST['f_usuario'];
        $f_contrasena=$_POST['f_contrasena'];
        $f_rol=$_POST['f_rol'];
        $f_nombre_rol=$_POST['f_nombre_rol'];
        $f_centroCostos=$_POST['f_centroCostos'];
        $f_departamentoInterno=$_POST['f_departamentoInterno'];
        

    require_once('../controller/controlador_funcionarios.php');     
    require('../controller/controlador_areas.php');
    require('../controller/controlador_cargos.php');
    require('../controller/Selector_estados.php');
    require('../controller/control_tipo_accesos.php');
    require_once('../controller/controlador_departamentosInternos.php');
    require_once('../controller/controlador_centroCostos.php');

     
        $crud = new CrudFuncionarios();
        $datos1 = new Funcionario();

        /* $consultaAccesos=$crud->detalleAcceso(); */
        $consultaActivos=$crud->ConsultarActivos();

    $consultarAccesosPlataformas = 1;
    require_once('../controller/controlador_peticionesAccesos.php');

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
     <link rel="stylesheet" href="../../public/css/modal_login.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
    <!--Modal Validacion-->
    <style type="text/css">

    </style>
  
</head>
<body>

<?php if ($_SESSION['id_roles']==6){ ?>

  <!--Modal de Incio-->
<a class="btn" data-popup-open="popup-1" href="#" style="display: none;">Open Popup #1</a>


<div class="popup" data-popup="popup-1">
  <div class="popup-inner">
       <div class="modal-header">        
         <h4 class="" style="text-align: left;">Por seguidad, inicia sesi&oacuten de nuevo</h4>
       </div>
       <div class="modal-body">
        <form class="mt-3" id="valida" name="valida">

       <input type="text" class="form-control" placeholder="Usuario" id="usuarios" name="usuarios" required autofocus autocomplete="off" required>
       <br/>
            <input type="password" class="form-control" placeholder="Contrase&ntilde;a" id="claves" name="claves" required>
      <br/>
         <button type="button" data-popup-close="popup-1" class="btn btn-primary">Login</button>

       </form>
       </div>
  </div>
</div>

  
<?php } ?>

<!--Fin Modal de Incio-->
    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/logo.png" alt="">
            </div>
        </div>
    </header>

      <div class="container" id="Activos">
        <div class="row" style="float: right;">
            <h6 style="padding: 3% 10%;">Activos Asignados</h6>
               <div class="row mb-3 col-12">
                <div class="col-12">
                <h6 style="margin: 1% 45%">Infraestructura</h6>
                    <table class="table table-streed ml-5" style="border: 1px solid #d9007f; box-shadow: 0px 0px 5px #dad9d9 ">
                          <thead style="background: #d9007f;color: #FFF">
                                    <th style="display:none;"></th>
                                    <th>C&oacute;digo</th>
                                    <th>Serial</th>
                                    <th>Nombre</th>                                 
                          </thead>
                          <tbody>
                              <?php foreach ($consultaActivos as $crud):  ?>
                                    <?php if($crud->getAf_areaCreacion() == 27): ?>
                                   <tr>
                                    <td style="display:none;"><span id="id<?php echo $crud->getAf_id(); ?>"><?php echo $crud->getAf_id(); ?></span></td>
                                    <td><span id="codigo<?php echo $crud->getAf_id(); ?>"><?php echo $crud->getAf_codigo(); ?></span></td>
                                    <td><span id="serial<?php echo $crud->getAf_id(); ?>"><?php echo $crud->getAf_serial(); ?></span></td>
                                    <td><span id="nombre<?php echo $crud->getAf_id(); ?>"><?php echo $crud->getAf_nombre(); ?></span></td>
                                    </tr>
                                    <?php endif;?>        
                                <?php endforeach;?>   
                          </tbody>  
                     </table>
                    
                     <h6 style="margin: 1% 45%">Administraci&oacute;n</h6>
                     <table class="table table-streed ml-5" style="border: 1px solid #d9007f">
                          <thead style="background: #d9007f;color: #FFF">
                                    <th style="display:none;"></th>
                                    <th>C&oacute;digo</th>
                                    <th>Serial</th>
                                    <th>Nombre</th>                                 
                          </thead>
                          <tbody>
                              <?php foreach ($consultaActivos as $crud):  ?>
                                    <?php if($crud->getAf_areaCreacion() == 32): ?>
                                    <tr>
                                    <td style="display:none;"><span id="id<?php echo $crud->getAf_id(); ?>"><?php echo $crud->getAf_id(); ?></span></td>
                                    <td><span id="codigo<?php echo $crud->getAf_id(); ?>"><?php echo $crud->getAf_codigo(); ?></span></td>
                                    <td><span id="serial<?php echo $crud->getAf_id(); ?>"><?php echo $crud->getAf_serial(); ?></span></td>
                                    <td><span id="nombre<?php echo $crud->getAf_id(); ?>"><?php echo $crud->getAf_nombre(); ?></span></td>
                                    </tr>
                                    <?php endif;?>
                            <?php endforeach;?>
                          </tbody>
                     </table>

                     <h6 style="padding:9% 0% 0% 8%;">Accesos Plataformas</h6>
                     <table class="table table-streed ml-5" style="border: 1px solid #d9007f">
                          <thead style="background: #d9007f;color: #FFF">
                                <th>Plataforma</th>
                                <th>Usuario</th>
                                <th width="100">Fecha de Registro</th>   
                          </thead>
                          <tbody>
                            <?php foreach($consultarAccesosPlataformas as $listado): ?>
                                <?php if($listado->getEstado() == 5):?>
                                <tr>
                                    <td style="max-width:5vh"><span><?= $listado->getPlataformaDescripcion()?></spam></td>
                                    <td style="max-width:7vh;overflow:hidden"><span><?= $listado->getUsuario()?> </spam></td>
                                    <td><span><?= $listado->getFecha_registro()?> </spam></td>
                                </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                          </tbody> 
                     </table>
                     
                </div>
                   
               </div>

        </div>
    </div>

        <div class="container">
        <div class="row">
            <h6 class="mt-3">Modificar Funcionario</h6>
            <div class="col-12 ml-5">

                <form class="mt-3" id="modificaFuncionario">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Identificaci&oacute;n</label>
                                <input type="text" id="f_identificacion" name="f_identificacion" class="form-control info" maxlength="25" autocomplete="off" value="<?php echo $f_identificacion ?>" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tipo de autenticaci&oacute;n</label>
                                </br>
                                <select name="f_tipoValidacion" id="f_tipoValidacion" style="padding:7px; width:56%; border-radius:5px;">
                                    <option value="1" >Google Authenticator</option>
                                    <option value="2" >Token por Correo</option>
                                </select>  
                            </div>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Estado</label>
                                   <select class="form-control info" id="f_estado" name="f_estado" required>  
                                   <option value="<?php echo $codigoEstado ?>" selected><?php echo $nombreEstado ?></option>
                                    <?php                                                               
                                    if ($codigoEstado != 6 && $codigoEstado !=16){
                                        echo "<option value=' 16 '>Inactivo</option>";
                                    }  else {
                                         echo "<option value=' 5 '>Activo</option>";
                                       }
                                     ?>
                                    </select>
                            </div>
                        </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Rol</label>
                                   <select class="form-control info" id="f_rol" name="f_rol" required>  
                                    <?php                                                               
                                    if ($f_rol == 2){
                                        echo "<option value='" . $f_rol . "' selected>". $f_nombre_rol . "    </option>";
                                        echo "<option value='4'>Funcionario </option>";
                                    }  else {
                                         echo "<option value='" . $f_rol . "'>". $f_nombre_rol . "    </option>";
                                         echo "<option value='2'>Procesos Administración </option>";
                                       }
                                     ?>
                                    </select>
                            </div>
                        </div>
                    </div>   
            

                <div id="fecha" class="fechaInactividad">
                     <div class="row">
                        <div class="col-3">
                            <div class="form-group" style="min-width: 200%"> <!--  -->
                                <label>Fecha</label>
                                 <input type="date" id="f_fecha_inactivacion" name="f_fecha_inactivacion" class="form-control info" >
                           </div>
                       </div>
                    </div> 

                  </div>

                  
                    <div id="funcionarioTranspaso" class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Responsable sobre activos</label>
                                <select class="form-control info" id="funcionario_translado" name="funcionario_translado" value="<?php echo $af_funcionario?>">
                                    <?php if($identificacionResponsable==0){ echo 
                                        "<option value='" . $identificacionResponsable="800042928". "'>". $nombreResponsable="AREA INFRAESTRUCTURA". "    </option>";
                                    }else{
                                        echo "<option value='" . $identificacionResponsable. "'>". $nombreResponsable. "    </option>";}?>
                                    }
                                    ?>
                                    <?php 

                                         foreach($listado_funcionarios as $crud){
                                                if($crud["identificacion"] != $f_identificacion){
                                                    echo "<option value='".$crud["identificacion"]."'>".$crud["nombre"] . "</option>" ;
                                                }
 
                                              }  
                                    ?>
                                </select>
                            </div>
                        </div>
                  </div>      
                  
                    
                    <div id="descripcionRetiro_Div" class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Observaci&oacuten de inactivacion</label>
                                <div><textarea type="input" name="descripcionRetiro" id="descripcionRetiro" class="crea_data" ></textarea></div>
                            </div>
                        </div>
                  </div>      

                    <div class="row">
                        <div class="col-7">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="f_nombre" name="f_nombre" class="form-control info" maxlength="260" autocomplete="off" value="<?php echo $f_nombre ?>" required >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label>Correo Corporativo</label>
                                <input type="text" id="f_correo" name="f_correo" class="form-control info" maxlength="100" autocomplete="off" value="<?php echo $f_correo ?>" required >
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <label>Extension</label>
                                <input type="text" id="f_extension" name="f_extension" class="form-control info" maxlength="6" autocomplete="off" value="<?php echo $f_extension ?>" required >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-7">
                            <div class="form-group">
                                <label>Correo Personal</label>
                                <input type="text" id="f_correo2" name="f_correo2" class="form-control info" maxlength="100" autocomplete="off" value="<?php echo $f_correo2 ?>" required >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-7">
                            <div class="form-group">
                                <label>Departamento Interno</label>
                                <select class="form-control info" id="f_departamentosInt" name="f_departamentosInt" value="<?php echo $f_departamentoInterno?>" required>
                                        <option value=''>Seleccione un Departamento Interno</option>
                                        <?php foreach($departamentosInternos as $listado_departamentos):?>
                                            <?php if($listado_departamentos['estado'] == 5):?>
                                                <option value='<?php echo $listado_departamentos['id_departamento'];?>' <?php if($datosListados['id_departamento'] ==$listado_departamentos['id_departamento']){echo 'selected';}?>><?php echo $listado_departamentos['descripcion'];?></option>
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
                                            <option value='<?php echo $area["id_area"];?>' class="areaCP areaCS<?php echo $area['id_departamento'];?>" <?php if($codigoArea == $area["id_area"]){echo 'selected';}?>><?php echo $area['descripcion'];?></option>
                                                
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </select>
                                
                            </div>
                        </div>
                    

                        <div class="col-4">
                            <div class="form-group">
                                <label>Cargo</label>
                                <select class="form-control info" id="f_cargo" name="f_cargo" required>
                                    <option value=''>Seleccione Cargo</option>
                                    <?php foreach($listado_cargos as $cargo): ?>
                                            <?php if($cargo['estado'] == 5 && $cargo['estado_area'] == 5 && $cargo['estado_departamento'] == 5 ):?>
                                                <option value='<?php echo $cargo['id_cargo'];?>' class="cargoCP cargoCS<?php echo $cargo['id_area'];?>" <?php if($codigoCargo==$cargo['id_cargo']){echo 'selected';}?>><?php echo $cargo['descripcion'];?></option>
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
                                        <?php if($datosListados['id_centroCostos'] == 0){
                                            echo "<option value='' selected>Seleccione Centro de Costos</option>";
                                        }else{
                                            echo "<option value='" .$datosListados['id_centroCostos']. "' selected>" .$datosListados['descripcion_centroCostos']. "</option>";
                                        }
                                        ?>
                                        <?php foreach($centroDeCostos as $centros):?>
                                            <option value='<?php echo $centros['id_centroCostos'];?>'><?php echo $centros['descripcion'];?></option>
                                        <?php endforeach ?>
                                    </select>                       
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Codigo</label>
                                    <input type="text" id="centroCostosCodigo" name="centroCostosCodigo" class="form-control info" value="" readonly>                     
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-7">
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" id="f_usuario" name="f_usuario" class="form-control info" maxlength="50" autocomplete="off" value="<?= $f_usuario ?>"  <?php if($_SESSION['id_roles'] != 1 && $_SESSION['id_roles'] != 7){ echo "readoly";} ?>>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-4"> <button type="button" class="mt-5 btn btn-success" id="btn-guardarModif" name="btn-guardarModif" style="height:33.5px; width=auto;" >Guardar</button></div>
                        <div class="col-3" > <a id="cerrar_modificacion" class="mt-5 btn btn-secondary" style="height:33.5px; width=auto;">Cancelar</a> </div>
                        
                    </div>
                </form>
                <div class="row">
                    <div class="col-7" > <button type="button" id="btn-limpiarCodigo" name="btn-limpiarCodigo" class="btn btn-danger" style="margin:10px 0;">Borrar código QR</button> </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>
    <script src="../../public/js/fecha_oculta.js"></script>     
    <script src="../../public/js/modifica_funcionario.js"></script>
    <script src="../../public/js/modal.js"></script>
    <script src="../../public/js/centro_de_costos.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
  
</body>

</html>