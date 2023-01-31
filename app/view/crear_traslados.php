<?php 
//*************************************************************************************//
//********************* FORMULARIO PARA LA CREACION DE FUNCIONARIOS *******************//
//*************************************************************************************//

	ini_set("session.cookie_lifetime",18000);
  	ini_set("session.gc_maxlifetime",18000);
   		session_start();

   	if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
     }
    $funcionario_inicial=$_POST['af_responsableB'];
    $fecha_inicial=$_POST['af_fechaAsignacionB'];
    $nombre_activo=$_POST['af_nombreB'];
    $id_activo=$_POST['af_idB'];
    $codigo_activo=$_POST['af_codigoB'];
    $af_serial=$_POST['af_serialB'];
    $af_identidad=$_POST['af_identidadB'];


require_once('../controller/controlador_activosFijos.php');    
require('../controller/controlador_funcionarios.php');

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
                <img src="../../public/img/logo.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <h6 class="mt-3">Realizar Traslado</h6>
            <div class="col-12 ml-5">

                <form action="../controller/controlador_traslados.php" method="post" class="form-group">
                    <div class="row">
                        <div class="col-1">
                            <div class="form-group">
                                <label>Id Activo</label>
                                <input type="text" id="activo_traslado" name="activo_traslado" class="form-control info" autocomplete="off" value="<?php echo $id_activo?>" readonly>
                                 <input type="hidden" id="usu_name" name="usu_name" value="<?php echo $_SESSION['usuario'] ?>">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Codigo Activo</label>
                                <input type="text" id="m_codigo" name="m_codigo" class="form-control info" maxlength="10" autocomplete="off" value="<?php echo $codigo_activo?>" readonly>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Serial Activo</label>
                                <input type="text" id="m_serial" name="m_serial" class="form-control info" maxlength="10" autocomplete="off" value="<?php echo $af_serial?>" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label>Activo</label>
                                <input type="text" id="m_activo" name="m_activo" class="form-control info" maxlength="10" autocomplete="off" value="<?php echo $nombre_activo?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Funcionario Actual</label>
                                <select class="form-control info" id="funcionario_inicial" name="funcionario_inicial" value="<?php echo $funcionario_inicial?>" readonly>
                                    <?php if($af_identidad==0){ echo 
                                        "<option value='" . $identificacionResponsable="800042928". "'>". $nombreResponsable="AREA INFRAESTRUCTURA". "    </option>";
                                    }else{
                                        echo "<option value='" . $af_identidad. "'>". $funcionario_inicial. "    </option>";}?>
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Fecha Asignado</label>
                                <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control info" value="<?php echo $fecha_inicial?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Funcionario Nuevo</label>
                                <select class="form-control info" id="funcionario_final" name="funcionario_final" value="<?php echo $af_funcionario?>" required>
                                    <?php if($identificacionResponsable==0){ echo 
                                        "<option value='" . $identificacionResponsable="800042928". "'>". $nombreResponsable="AREA INFRAESTRUCTURA". "    </option>";
                                    }else{
                                        echo "<option value='" . $identificacionResponsable. "'>". $nombreResponsable. "    </option>";}?>
                                    }
                                    ?>
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
                                <label>Fecha Traslado</label>
                                <input type="date" id="fecha_traslado" name="fecha_traslado" class="form-control info" value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Descripcion Y Estado Del Activo</label>
                                <textarea name="descripcion_traslado" id="descripcion_traslado" cols="118" rows="5" required></textarea>
                            </div>
                        </div>                        
                    </div>

                    <div class="row">
                        <div class="col-5">
                            <input type="submit" value="Realizar Traslado" id="crear_traslado" name="crear_traslado" class="mt-4 btn btn-primary btn-sm btn-guardar">
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
    <script src="../../public/js/bloqueoTeclas.js"></script>
    
</body>
</html>