<?php


    ini_set("session.cookie_lifetime",18000);
    ini_set("session.gc_maxlifetime",18000);
   session_start();
   
   if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
     }     
  
        $f_identificacion=$_POST['f_identificacion']; 
        $f_nombre=$_POST['f_nombre'];
        $f_correo=$_POST['f_email'];
        $f_area=$_POST['f_area'];
        $f_cargo=$_POST['f_cargo'];
        $f_extension=$_POST['f_extension'];
        $f_usuario=$_POST['f_usuario'];
        $f_contrasena=$_POST['f_contrasena'];        
        
        

    require_once('../controller/controlador_funcionarios.php');       
    require('../controller/controlador_areas.php');
    require('../controller/controlador_cargos.php');
    require('../controller/Selector_estados.php');

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
            <h6 class="mt-3">Modificar Funcionario Inactivo</h6>
            <div class="col-12 ml-5">

                <form action="../controller/controlador_funcionarios.php" method="post" class="form-group">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Identificacion</label>
                                <input type="text" id="f_identificacion" name="f_identificacion" class="form-control info" maxlength="25" autocomplete="off" value="<?php echo         $f_identificacion ?>" required readonly>
                            </div>
                        </div>
                    </div>

                      <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label>Estado</label>
                                   <select class="form-control info" id="f_estado" name="f_estado" required>  
                                   <option value="<?php echo $codigoEstado ?>" selected><?php if($codigoEstado == 16){echo "Retirado";}else{echo $nombreEstado;} ?></option>
                                    <?php                                                               
                                    if ($codigoEstado != 6 && $codigoEstado != 16){
                                        echo "<option value=' 6 '> Inactivo  </option>";
                                    }  else {
                                         echo "<option value=' 5 '> Activo  </option>";
                                       }
                                     ?>
                                   
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div id="descripcionActiva_Div" class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Observaci&oacuten de Activacion</label>
                                <div style="max-width:85%;"><textarea type="input" name="descripcionActiva" id="descripcionActiva" class="crea_data"></textarea></div>
                            </div>
                        </div>
                  </div> 

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="f_nombre" name="f_nombre" class="form-control info" maxlength="260" autocomplete="off" value="<?php echo $f_nombre ?>" required >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="text" id="f_correo" name="f_correo" class="form-control info" maxlength="100" autocomplete="off" value="<?php echo $f_correo ?>" required >
                            </div>
                        </div>

                        <div class="col-1">
                            <div class="form-group">
                                <label>Extension</label>
                                <input type="text" id="f_extension" name="f_extension" class="form-control info" maxlength="6" autocomplete="off" value="<?php echo $f_extension ?>" required >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Area</label>
                                <select class="form-control info" id="f_area" name="f_area" required>
                                    <?php if($codigoArea==0){ echo 
                                        "<option value='' selected>Seleccione Estado</option>";
                                    }else{
                                        echo "<option value='" . $codigoArea . "'>". $nombreArea . "    </option>";}?>
                                    }?>
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
                                <label>Cargo</label>
                                <select class="form-control info" id="f_cargo" name="f_cargo" required>
                                    <?php if($codigoCargo==0){ echo 
                                        "<option value='' selected>Seleccione Area</option>";
                                    }else{
                                        echo "<option value='" . $codigoCargo . "'>". $nombreCargo . "    </option>";}?>
                                    }?>
                                    <?php

                                         foreach($listado_cargos as $cargo){
                                            echo "<option value='".$cargo["id_cargo"]."'>".$cargo["descripcion"] . "</option>" ;
 
                                              }  
                                     ?>
                                </select>
                                
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" id="f_usuario" name="f_usuario" class="form-control info" maxlength="50" autocomplete="off" value="<?php echo $f_usuario ?>" readonly >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" id="f_contrasena" name="f_contrasena" class="form-control info" maxlength="50" autocomplete="off" value="<?php echo $f_contrasena ?>" required >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <input type="submit" value="Modificar" id="modificar_funcionarioInactivo" name="modificar_funcionarioInactivo" class="mt-4 btn btn-primary btn-sm btn-guardar">
                        </div>
                        <div class="col-3" > 
                                <a id="cerrar_modificacion" class="mt-4 btn btn-danger" style="height:30px";  >Cancelar</a>
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
    <script src="../../public/js/modificar_funcionario_Inactivo.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
   

</body>
<script type="text/javascript">
$('#cerrar_modificacion').click(function(){
    window.close();
})
</script>
</html>