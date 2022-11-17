<?php 
//*******************************************************************************//
//************FORMULARIO PARA LA CREACION DE PETICION A TECNOLOGIA***************//
//*******************************************************************************//

	ini_set("session.cookie_lifetime",18000);
  	ini_set("session.gc_maxlifetime",18000);
   		session_start();

   	if(!isset($_SESSION['usuario'])){
       
       header('location:../../login_peticiones.php');
     }

    $crear_peticion = 1;
    include('../controller/controlador_plataformas.php');
    include('../controller/controlador_peticionesAccesos.php');
    
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="../../public/css/activosFijos.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">
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
        <div class="row" style="float: right;">
            <h6 class="ml-5">Accesos Asignados</h6>
            <table class="table table-streed ml-5" style="border:1px solid #d9007f; box-shadow: 0px 0px 5px #dad9d9 ">
                <thead style="background: #d9007f;color: #FFF">
                    <th>plataforma</th>
                    <th>usuario</th>                                
                </thead>
                <tbody id="accesosUsuario">
                </tbody>  
            </table>    
        </div>
    </div>




    <div class="container">
        <div class="row">
            <h6 class="mt-3">Solicitud de Accesos</button></h6>
            <div class="col-12 ml-5">

                <form action="../controller/controlador_peticionesAccesos.php" method="POST" class="form-group" enctype="multipart/form-data">

                <div class="row">
                        <div class="col-5" <?php if($usuarioDir != 1){echo "style='display:none'";}?>>
                            <div class="form-group">
                                <label>Peticion Dirigida</label>
                                <div>   
                                    <select class="form-control" id="funcionarioAlterno" name="funcionarioAlterno" required>
                                        <option value='0'>Para Mi</option>
                                        <?php foreach($funcionarios as $listado):?>
                                            <option value='<?php echo $listado['usuario']?>'><?= $listado['nombre'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                    </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="form-group">
                                <label>Tipo de solicitud</label>
                                <div>   
                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <option value='1'>Activaci&oacute;n</option>
                                        <option value='2'>Inactivaci&oacute;n</option>
                                        <option value='3'>Novedades</option>
                                        <option value='4'>Reactivaci&oacute;n</option>
                                        <option value='0' style="display:none">Modificacion</option>
                                    </select>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-10">
                        <label>Plataformas  
                            <button type="button" style="border:0px" onclick="limpiarChecks();" title="Deseleccionar"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                            <button type="button" style="border:0px"  title="Seleccionados" id="verSeleccionadosIcon"><i class="fas fa-eye fa-lg" style="color:black" aria-hidden="true"></i></button>
                            <button type="button" style="border:0px"  title="Ver todas" id="verTodasIcon"><i class="fas fa-eye-slash fa-lg" aria-hidden="true"></i></button>
                            <!-- <button type="button" style="border:0px"  title="Seleccionar Todas" id="seleccionarTodasIcon"><i class="fa fa-check-square-o fa-lg" aria-hidden="true"></i></button> -->
                            <button type="button" style="border:0px" title="Plataformas Designadas" id="plataformasDesignadas"><i class="far fa-id-badge fa-lg" aria-hidden="true"></i></button>
                            <input  type="search" placeholder="Buscar..." id="buscador" style="position: absolute;right:20px">
                        </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <div class="form-group checkbox-group required" style="overflow-y:scroll;height:auto;max-height:300px">
                                    <table class="table table-striped tablesorter" id="resultable" >
                                        <tbody >
                                            <?php foreach($plataformas as $listado):?>
                                                <?php if($listado['estado'] == 5):?>
                                                <tr>
                                                <td id="td<?=$listado['id_plataforma']?>"><input type="checkbox" id="plataformas<?=$listado['id_plataforma']?>" name="plataformas<?=$listado['id_plataforma']?>" value="<?=$listado['id_plataforma']?>">  <?= $listado['descripcion']?></td> 
                                                </tr>
                                                <?php endif;?>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea class="form-control" name="descripcion" id="descripcion"  rows="5" maxlength="6000" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3"> 
                        <div class="col-5">
                            <input type="hidden" id="funcionario" name="funcionario" value="<?php echo $_SESSION['usuario'];?>">
                            <button type="submit" class="btn btn-success" id="crear_peticion_accesos" name="crear_peticion_accesos" disabled>Enviar Solicitud</button>
                        </div>
                        <div class="col-5">
                            <a href="../../dashboard_funcionarios.php" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>                
            </div>
        </div>
    </div>

    
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>   
    <script src="../../public/js/crear_peticionAcceso.js"></script>  
    <script src="../../public/js/bloqueoTeclas.js"></script> 
</body>
</html>