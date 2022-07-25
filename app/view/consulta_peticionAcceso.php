<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title>Helisa | Soporte Infraestructura</title>
	    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
	    <link rel="stylesheet" href="../../public/css/peticion.css" media="screen" type="text/css">
	    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
        <link rel="stylesheet" href="../../public/css/smoke.min.css">
	
</head>

<body>
	<?php 
	header('Cache-Control: no cache'); //duplicidad pantalla
    session_cache_limiter('private_no_expire');//
    ini_set("session.cookie_lifetime",18000);
	ini_set("session.gc_maxlifetime",18000);
        
        session_start();
   
        if(!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])){
       
        header('location:../../login.php');
        }
        
        require_once('../controller/controlador_peticionesAccesos.php');
        require_once('../controller/controlador_plataformas.php');

        $peticion=$_POST['id_peticion']; 
        $usuario_creacion=$_POST['usuario_creacion'];
        $fecha_creacion=$_POST['fecha_creacion'];
        $descripcion=$_POST['descripcion'];
        $tipo = $_POST['tipo'];
        $plataformasPeticion=$_POST['plataformas'];
        $estado=$_POST['estado'];
        $estado_descripcion=$_POST['estado_descripcion'];
        $fecha_atendido=$_POST['fecha_atendido'];
        $usuario_atendio=$_POST['usuario_atendio'];
        $conclusiones=$_POST['conclusiones'];
        $aprobado = $_POST['aprobado'];

        $platarformasArreglo = explode (',', $plataformasPeticion);
        $numElement  = count($platarformasArreglo);
	 ?>
	 
	 
	     <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/Logo_blanco.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 pl-5">
                <h6>Registro Solicitud Accesos</h6>
            </div>
            <div class="col-12 ml-5">
                <div class="form-group">
                    
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <label>id Solicitud</label>
                                    <input type="text" id="id_peticion" name="id_peticion" class="form-control data" value="<?php echo $peticion;?>" readonly>
                                </div>

                                <div class="col-4">
                                    <label>Fecha Solicitud</label>
                                    <input type="text" id="fecha_creacion" name="fecha_creacion" class="form-control data" value="<?php echo  $fecha_creacion;?>" readonly>
                                </div> 
                                  
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <label>Usuario</label>
                                    <input type="text" id="$usuario_creacionn" name="$usuario_creacionn" class="form-control data" value="<?php echo  $usuario_creacion;?>" readonly> 
                                </div>

                                <div class="col-4">
                                    <label>Fecha registro usuario</label>
                                    <input type="text" id="fecha_registro" name="fecha_registro" class="form-control data" value="<?php echo $f_fechaRegistro;?>"  readonly>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label>Correo usuario</label>
                                    <input type="text" id="correo" name="correo" class="form-control data" value="<?php echo $f_correo;?>" readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Descripcion</label> 
                                    <textarea id="descripcion" name="descripcion" class="form-control col-6 data" readonly><?php echo $descripcion;?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label>Tipo</label>
                                    <input type="text" class="form-control data" value="<?php switch($tipo){case 0:echo "Modificacion";break;case 1:echo "Activacion";break;case 2: echo "Inactivacion";break;Default:echo "Modificacion";}?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-2">
                                    <div><label for="">Observaciones</label></div>
                                        <textarea name="conclusiones" id="conclusiones" class="form-control col-6 data" readonly><?=strip_tags($conclusiones,'<br/>')?></textarea>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <label>Aprobacion</label>
                                    <input type="text" class="form-control data" value="<?php switch($aprobado){case 0:echo "Sin Respuesta";break;case 13:echo "No Aprobado";break;case 12: echo "Aprobado";break;Default:echo "Sin Respuesta";}?>" readonly>
                                </div>
                            </div>

                            <?php if($plataformasPeticion != ''):?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Accesos <?php if($aprobado == 12){echo "Por definir.";}else{echo "Solicitados.";}?></label>
                                        <div style="overflow-y:scroll;height:auto;max-height:250px">
                                        <div class="checkbox-group required">
                                        <?php foreach($plataformas as $listado):?>
                                            <?php for($x=0; $x<$numElement;$x++):?>
                                                <?php if($listado['estado'] == 5 && $platarformasArreglo[$x] == $listado['id_plataforma']):?>
                                                    <label class="col-5"><input type="checkbox" checked disabled> <?php echo $listado['descripcion'];?></label>
                                                <?php endif;?>
                                            <?php endfor;?>
                                        <?php endforeach ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>

                            <?php if($aprobado == 12):?>
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label>Accesos</label>
                                        <div class="row">
                                            <span class="col-4 mt-2"><b>Plataforma</b></span>
                                            <span class="col-2 mt-2"><b>Nombre Usuario</b></span>
                                            <span class="col-3 mt-2"><b>Estado</b></span>
                                        </div>

                                        <div>
                                        <?php foreach($registroAccesos as $listado):?>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-4">
                                                            <input type="text" title="<?=$listado->getPlataformaDescripcion();?>" class="form-control" value="<?php echo $listado->getPlataformaDescripcion();?>" readonly>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control" value="<?php echo $listado->getUsuario();?>" readonly>
                                                        </div>
                                                        
                                                        <div class="col-sm-3">
                                                            <select class="form-control" disabled>
                                                                <?php $estadoAcceso = $listado->getEstado() ;?>
                                                                <option value='12' <?php if($estadoAcceso == 12){echo 'selected';}?>>Aprobado</option>
                                                                <option value='13' <?php if($estadoAcceso == 13){echo 'selected';}?>>No aprobado</option>
                                                                <option value='3' <?php if($estadoAcceso == 3){echo 'selected';}?>>Pendiente</option>
                                                            </select>
                                                        </div> 
                                                    </div>
                                        <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>

                            <div class="row">
                                <div class="col-3">
                                    <input type=button name=boton value=Cerrar onclick="window.close()" class="btn btn-primary  mt-3">
                                </div>                              
                           </div>

                           

                                  


                        </div>
                </div> 
            </div>
        </div>
    </div>
    
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
</body>
</html>