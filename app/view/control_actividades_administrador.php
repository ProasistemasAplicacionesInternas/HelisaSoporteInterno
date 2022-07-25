<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Software para el trabajo</title>
    <link rel="stylesheet" href="../../public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/consulta_peticion.css"> 
    <link rel="stylesheet" type="text/css" href="../../public/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../../public/css/buttons.dataTables.min.css" media="screen">

</head>

<body>

    <?php
       ini_set("session.cookie_lifetime",18000);
       ini_set("session.gc_maxlifetime",18000);

       session_start();
   
       if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
       }
        $rol = $_SESSION['rol'];
       
        require_once('../model/datos_activosFijos.php');
        require('../controller/controlador_controlActividades.php');
    
        $datos= new activosFijos();
    ?>

    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/logo.png" alt="">
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Actividades Activos Fijos</h6>
            </div>
            
            <div class="col">
                    <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                            <th style="width:3px;">Id</th>
                            <th style="width:50px;">Codigo Activo</th>
                            <th style="width:50px;">Serial</th>
                            <th style="width:50px;">Nombre Activo</th>
                            <th style="width:50px;">Estado</th>
                            <th style="width:50px;">Responsable</th>
                            <th style="width:50px;">Fecha Asignado</th>
                            <th style="width:50px;">Control De Actividades</th>                   
                            
                    </thead>
                    <?php foreach($consultarActivo as $datos): ?>
                    <tr>
                        <td>                                
                            <?= $datos->getAf_id() ?></td>
                        <td>                                
                            <?= $datos->getAf_codigo() ?></td>
                        <td>
                            <?= $datos->getAf_serial() ?></td>
                        <td>
                            <?= $datos->getAf_nombre() ?></td>
                        <td>
                            <?= $datos->getAf_estado() ?></td>
                        <td>
                            <?= $datos->getAf_funcionario() ?></td>   
                        <td>
                            <?= $datos->getAf_fechaAsignacion() ?></td> 
                                                                        
                        <td> 
                            <form action="ver_actividades.php" method="post">
                                <input type="hidden" name="af_id" id="af_id" value="<?php echo $datos->getAf_id();?>">
                                <input type="hidden" name="af_codigo" id="af_codigo" value="<?php echo $datos->getAf_codigo();?>">
                                <input type="hidden" name="af_serial" id="af_serial" value="<?php echo $datos->getAf_serial();?>">   
                                <input type="hidden" name="af_marca" id="af_marca" value="<?php echo $datos->getAf_marca();?>">   
                                <input type="hidden" name="af_modelo" id="af_modelo" value="<?php echo $datos->getAf_modelo();?>">   
                                <input type="hidden" name="af_nombre" id="af_nombre" value="<?php echo $datos->getAf_nombre();?>">   
                                <input type="hidden" name="af_fechaCompra" id="af_fechaCompra" value="<?php echo $datos->getAf_fechaCompra();?>">   
                                <input type="hidden" name="af_categoria" id="af_categoria" value="<?php echo $datos->getAf_grupo();?>">   
                                <input type="hidden" name="af_estado" id="af_estado" value="<?php echo $datos->getAf_estado();?>">   
                                <input type="hidden" name="af_area" id="af_area" value="<?php echo $datos->getAf_area();?>">   
                                <input type="hidden" name="af_responsable" id="af_responsable" value="<?php echo $datos->getAf_funcionario();?>">
                                <input type="hidden" name="af_fechaAsignacion" id="af_fechaAsignacion" value="<?php echo $datos->getAf_fechaAsignacion();?>"> 
                                <input type="hidden" name="af_observaciones" id="af_observaciones" value="<?php echo $datos->getAf_observaciones();?>">     
                                <!----------------------------------------->
                                <input type="hidden" name="af_ram" id="af_ram" value="<?php echo $datos->getAf_ram();?>">  
                                <input type="hidden" name="af_discoDuro" id="af_discoDuro" value="<?php echo $datos->getAf_disco();?>">  
                                <input type="hidden" name="af_procesador" id="af_procesador" value="<?php echo $datos->getAf_procesador();?>">  
                                <input type="hidden" name="af_office" id="af_office" value="<?php echo $datos->getAf_licenciaOffice();?>">  
                                <input type="hidden" name="af_antivirus" id="af_antivirus" value="<?php echo $datos->getAf_licenciaAntivirus();?>">  
                                <input type="hidden" name="af_aplicaciones" id="af_aplicaciones" value="<?php echo $datos->getAf_aplicaciones();?>">  
                                <input type="hidden" name="af_licenciaSo" id="af_licenciaSo" value="<?php echo $datos->getAf_licenciaSO();?>">  
                                <input type="hidden" name="af_dominio" id="af_dominio" value="<?php echo $datos->getAf_dominio();?>">  
                                <input type="hidden" name="af_so" id="af_so" value="<?php echo $datos->getAf_sistemaOperativo();?>">  
                                <input type="submit" value="Ver Actividades" name="modificar_activo" class="btn btn-info">
                            </form>
                        </td>
                        
                    </tr>
                    <?php 
                        endforeach;
                        ?>
                </table>
            </div>

        </div>
    </div>    
    
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/datatables.min.js"></script>
    <script src="../../public/js/dataTables.buttons.min.js"></script>
    <script src="../../public/js/buttons.flash.min.js"></script>
    <script src="../../public/js/jszip.min.js"></script>
    <script src="../../public/js/pdfmake.min.js"></script>
    <script src="../../public/js/vfs_fonts.js"></script>
    <script src="../../public/js/buttons.html5.min.js"></script>
    <script src="../../public/js/buttons.print.min.js"></script>
    <script src="../../public/js/tablas.js"></script>
    <script src="../../public/js/moment.min.js"></script>
    <script src="../../public/js/daterangepicker.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    
</body>
</html>