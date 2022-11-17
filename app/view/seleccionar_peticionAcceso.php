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
                <h6>Atendiendo Solicitud Accesos</h6>
            </div>
            <div class="col-12 ml-5">
                <div class="form-group">
                    <form action="../controller/controlador_peticionesAccesos.php" class="form-group mt-3" method="post">
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
                                    <input type="text" class="form-control data" value="<?php switch($tipo){
                                        case 0:echo "Modificacion";break;
                                        case 1:echo "Activación";break;
                                        case 2: echo "Inactivacion";
                                        case 3: echo "Novedades";
                                        case 4: echo "Reactivacion";
                                        break;Default:echo "Modificacion";}?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Accesos</label>
                                        <div style="overflow-y:scroll;height:auto;max-height:250px">
                                        <div class="checkbox-group required">
                                        <?php foreach($plataformas as $listado):?>
                                            <?php for($x=0; $x<$numElement;$x++):?>
                                                <?php if($listado['estado'] == 5 && $platarformasArreglo[$x] == $listado['id_plataforma']):?>
                                                    <label class="col-5"><input type="checkbox" checked name="plataformas<?=$listado['id_plataforma']?>" value="<?=$listado['id_plataforma']?>"> <?php echo $listado['descripcion'];?></label>
                                                <?php endif;?>
                                            <?php endfor;?>
                                        <?php endforeach ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label>Aprobaci&oacuten</label>
                                        <select class="form-control info" name="aprobado" id="aprobado" required> 
                                                <option value="" >seleccionar</option>
                                                <option value="13">No Aprobado</option>
                                                <option value="12">Aprobado</option>
                                         </select>
                                </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <div>
                                        <label for="">Observaciones</label>
                                    </div>
                                        <textarea name="conclusiones" id="conclusiones" class="form-control col-6 data" required><?=strip_tags($conclusiones,'<br/>')?></textarea>                                        
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <input type="hidden" value="<?=$plataformasPeticion;?>" name="plataformasPeticion">
                                    <input type="hidden" value="<?php echo $_SESSION['usuario'];?>" id="usuarioAtiende" name="usuarioAtiende">
                                    <input type="submit" value="Guardar" id="guardarAprociones" name="guardarAprobaciones" class="btn btn-primary  mt-3" >
                                </div>                              
                           </div>

                                  


                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
    
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    <script>
        $(document).ready(function() {
            var refreshId = setInterval(function() {
                var data = "preSeleccionar=1&id_peticion=" + $('#id_peticion').val();
                $.ajax({
                    type:"POST",
                    url:"../controller/controlador_peticionesAccesos.php",
                    data:data
                }).done(function(respuesta){
                    if(respuesta == 0){
                        $.smkAlert({
                            text: 'Error Interno.',
                            type: 'danger'
                        }); 
                    }else if(respuesta != 8){
                        $.smkAlert({
                            text: 'Un usuario a liberado la peticion.',
                            type: 'warning'
                        }); 
                        setTimeout(function(){ window.location="../../dashboard_funcionarios.php"; }, 800);
                    }
                })
            }, 1000);
        });
    </script>
    
</body>
</html>