<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="public/css/smoke.min.css">
</head>
<body>
		<?php
       ini_set("session.cookie_lifetime",18000);
       ini_set("session.gc_maxlifetime",18000);

       session_start();
   
       if(!isset($_SESSION['usuario'])){
       
       header('location:../../login_peticiones.php');
       }
                
        require_once('../model/crud_activosFijos.php');
        require_once('../model/datos_activosFijos.php');
        $activosAsignados = new crudActivos();
        $datosActivos = new activosFijos();
        $consultarActivos=$activosAsignados->consultarActivosfuncionario();
        // $consultarActivosPendientes=$activosAsignados->consultarActivosPendientesFuncionario();
        
    ?>
    <div class="container-fluid">

          <div class="row">
            <div class="col-10 mt-5">
                <h6 style="border: 1px solid #d9007f; margin: 0% 0%; padding: 10px; text-align: center">
                Activos Asignados
              </h6>
            </div>
            <div class="col-10" >
                <table class="table table-striped tablesorter" id="data" style="border: 1px solid #d9007f; ">
                    <thead>
                        <th style="display:none"></th>
                         <th COLSPAN="5" style="text-align: center;font-size: 15px;">Infraestructura</th>                                            
                    </thead>
                    <thead>
                        <th style="display:none"></th>
                         <th>C&oacute;digo Activo</th>
                        <th>Serial Activo</th>
                        <th>Nombre</th>
                        <th>Fecha Asignado</th>
                        <th>Aceptacion pendiente</th>

                                            
                    </thead>
                    
                        <?php foreach($consultarActivos as $campos): ?>
                                <?php if($campos->getAf_areaCreacion() == 27): ?>
                                <tr>
                                    <td><?php echo $campos->getAf_codigo() ?></td>
                                    <td><?php echo $campos->getAf_serial() ?></td>
                                    <td><?php echo $campos->getAf_nombre() ?></td>
                                    <td><?php echo $campos->getAf_fechaAsignacion() ?></td>
                                </tr>
                                <?php endif ?>
                                <?php endforeach;?>
            
                    <thead>
                        <th style="display:none"></th>
                         <th COLSPAN="5" style="text-align: center;font-size: 15px;">Administraci&oacute;n</th>                                            
                    </thead>
                    <thead>
                        <th style="display:none"></th>
                         <th>C&oacute;digo Activo</th>
                        <th>Serial Activo</th>
                        <th>Nombre</th>
                        <th>Fecha Asignado</th>
                        <th>Aceptacion pendiente</th>
                                            
                    </thead>
                    
                        <?php foreach($consultarActivos as $campos): ?>
                                <?php if($campos->getAf_areaCreacion() == 32): ?>
                                <tr>
                                    <td><?php echo $campos->getAf_codigo() ?></td>
                                    <td><?php echo $campos->getAf_serial() ?></td>
                                    <td><?php echo $campos->getAf_nombre() ?></td>
                                    <td><?php echo $campos->getAf_fechaAsignacion() ?></td>
                                </tr>
                                <?php endif ?>
                                <?php endforeach;?>
                </table>
            </div>
            
        </div>
                                


    
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
    <script src="public/js/revisadoActivosFijos.js"></script>
</body>	
</body>
</html>