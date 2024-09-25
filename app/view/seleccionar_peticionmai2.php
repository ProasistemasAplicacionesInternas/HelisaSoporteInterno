<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title>Helisa | Soporte Infraestructura</title>
	    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
	    <link rel="stylesheet" href="../../public/css/peticion.css" media="screen" type="text/css">
	    <link rel="stylesheet" href="../../public/css/peticionesmai.css" media="screen" type="text/css">
	    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
	
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

        include('../controller/controlador_soportemai.php');
        include('../controller/controlador_seleccionPeticion.php');     
        $codigo=$_POST['p_nropeticion']; 
        $fechapeticion=$_POST['p_fechapeticion'];
        $usuario=$_POST['p_usuario'];
        $extension=$_POST['p_extension'];
        $correo=$_POST['p_correo'];
        $categoria=$_POST['p_categoria'];
        $descripcion=$_POST['p_descripcion'];
        $imagen=$_POST['p_cargarimagen'];
        $imagen2=$_POST['p_cargarimagen2'];
        $imagen3=$_POST['p_cargarimagen3'];
        $estado=$_POST['p_estado'];
        $name=$_POST['soporteMai'];
        $conclusiones=$_POST['p_conclusiones'];

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
                <h6>Atendiendo Soporte</h6>
            </div>
            <div class="col-12 ml-5">
                <div class="form-group">
                    <form action="../controller/controlador_peticionmai.php" class="form-group mt-3" method="post" enctype="multipart/form-data">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2">
                                    <label>Cod. Solicitud</label>
                                    <input type="text" id="p_nropeticion" name="p_nropeticion" class="form-control data" value="<?php echo $codigo; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label>Fecha Solicitud</label>
                                    <input type="text" id="p_fechapeticion" name="p_fechapeticion" class="form-control data" value="<?php echo  $fechapeticion; ?>" readonly>
                                </div> 

                                <div class="col-4">
                                    <label>Usuario</label>
                                    <input type="text" id="p_usuario" name="p_usuario" class="form-control data" value="<?php echo  $usuario; ?>" readonly> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <label>Extension</label>
                                    <input type="text" id="p_extension" name="p_extension" class="form-control data" value="<?php echo $extension; ?>"    readonly>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label>Correo</label>
                                    <input type="text" id="p_correo" name="p_correo" class="form-control data" value="<?php echo $correo; ?>"    readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label>Producto</label>
                                    <input type="text" id="p_categoria" name="p_categoria" class="form-control data" value="<?php echo $categoria; ?>  " readonly>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Descripcion</label> 
                                    <textarea id="p_descripcion" name="p_descripcion" class="form-control col-6 data" readonly><?php echo $descripcion; ?></textarea>
                                </div>
                            </div>

                            <div class="mt-3">
                                <?php if ($imagen != '2'){ ?>
                                    <input type="hidden" id="imagenC" name="imagenC" class="form-control data" value="<?php echo $imagen; ?>" style='display:none'>
                                    <a class="text" href="../../cartas/<?=$imagen?>" target="_blanck" id="imagen" name="imagen" style=" ">
                                        Imagen
                                    </a>                                                        
                                <?php }else{ ?>
                                        <input type="hidden" id="imagenC" name="imagenC" value="2">
                                <?php } ?>
                                
                                <?php if ($imagen2 != '2'){ echo ' ';?> 
                                <input type="hidden" id="imagen2" name="imagen2" value="<?php echo $imagen2; ?>">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="text" href="../../cartas/<?=$imagen2?>" target="_blanck" id="imagen2x" name="imagen2x" style="text-decoration: underline; font-size: 15px;color: #bf1d1d; ">
                                        Imagen 2
                                    </a>                                                        
                                <?php }else{ ?>
                                        <input type="hidden" id="imagen2" name="imagen2" value="2">
                                <?php } ?>

                                <?php if ($imagen3 != '2'){echo' ';?>
                                <input type="hidden" id="imagen3" name="imagen3" value="<?php echo $imagen3; ?>">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="text" href="../../cartas/<?=$imagen3?>" target="_blanck" id="imagen3x" name="imagen3x" style="text-decoration: underline; font-size: 15px;color: #bf1d1d; ">
                                        Imagen 3
                                    </a>                                                        
                                <?php }else{ ?>
                                        <input type="hidden" id="imagen3" name="imagen3" value="2">
                                <?php } ?>
                            </div>


                            <div class="row">
                                <div class="col-4 form-control"  id="divGeneral">
                                    <label id="label" >Estado</label>
                                        <select name="p_estado" id="p_estado" class="form-control" required>
                                                <option value=""></option>
                                                <option value="2" >Resuelto</option>
                                                <option value="3" >Pendiente</option>
                                                <option value="4" >Redireccionado</option>
                                                
                                        </select>
                                </div>
                                
                                    <div class="col-4 form-control" id="divGeneral2">  
                                        <label id="label">Tipo de peticion</label>
                                            <select id="soporteMai" name="soporteMai" class="form-control">
                                                    <?php

                                                        foreach($listado_soporte as $tipoSoporte){
                                                            echo "<option value='".$tipoSoporte['id']."'" ; 
                                                            if($name == $tipoSoporte['nombre']){
                                                                echo 'selected';}
                                                            echo ">".$tipoSoporte["nombre"]. "</option>" ;
                                                            }  
                                                    ?>
                                            </select>
                                    </div>
                            </div>
    

                            <div class="row">
                                <div class="col-12 mt-2">
                                    <div>
                                        <label for="">Observaciones</label>
                                    </div>
                                        <textarea class="col-6" style="border-radius:9px; " name="p_conclusiones" id="p_cnclusiones" cols="75" rows="6" required><?=strip_tags($conclusiones,'<br/>')?></textarea>                                        
                                </div>
                            </div>
                            <div class="row">
                                        <div class="col-6 mt-2" id="imagenDiv">
                                                <label id="label">Seleccione el documento que quiere enviar</label>
                                                        </br>
                                                <input type="file" id="imagen[]" name="imagen[]" multiple="" >
                                        </div>
                                        <label class="mt-2" id="textImg" style="min-width:150%"></label>
                                    </div>

                            <div class="row">
                                <div class="col-3">
                                    <input type="submit" value="Guardar" id="aceptar_petmai" name="aceptar_petmai" class="btn btn-primary  mt-3" >
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
    <script src="../../public/js/correo_archivos.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
</body>
</html>