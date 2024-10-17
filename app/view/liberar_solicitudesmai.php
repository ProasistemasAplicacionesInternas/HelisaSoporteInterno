<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css" />

</head>

<body>

    <?php
       ini_set("session.cookie_lifetime",18000);
       ini_set("session.gc_maxlifetime",18000);

       session_start();
   
       if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
       }
        
       require_once('../model/crudPeticionesMai.php');
       require_once('../model/datosPeticionesMai.php');
    
        $consultar= new CrudPeticionesMai();
        $datos= new PeticionMai();
    
        $consultarSolicitudesMai=$consultar->solicitudesEnProceso();
    ?>
    <div class="container-fluid" id="infosMai">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Liberar Soporte Interno</h6>
            </div>
            
            <div class="col">
                    <table class="table table-striped tablesorter" style="text-align:center;" id="tabla">
                    <thead style="background-color:#d7007bb3; text-align:center; color:white;">
                            <th style="width:3px;  text-align:center;"># Soporte</th>
                            <th style="width:50px; text-align:center;">Fecha Soporte</th>
                            <th style="width:50px; text-align:center;">Producto</th>
                            <th style="width:50px; text-align:center;">Asesor</th>
                            <th style="width:50px; text-align:center;">Fecha atencion</th>
                            <th style="width:50px; text-align:center;">Duración</th>
                            <th style="width:20px; text-align:center;">Tipo de soporte</th>
                            <th style="width:50px; text-align:center;">Liberar</th>
                    </thead>
                    <?php foreach($consultarSolicitudesMai as $datos): ?>
                    <tr  style="background-color:#dc35457a;">                        
                        <td>                                
                            <?php echo $datos->getId_peticionMai() ?></td>
                        <td>                                
                            <?php echo $datos->getFecha_peticionMai() ?></td>
                        <td>
                            <?php echo $datos->getProducto_peticionMai() ?></td>
                        <td>
                            <?php echo $datos->getUsuario_atencionMai() ?></td>
                        <td>
                            <?php echo $datos->getFecha_atendidoMai() ?></td>
                        
                        <td>
                            <?php 
                                date_default_timezone_set('America/Bogota');
                                $fecha1 = new DateTime($datos->getFecha_atendidoMai());
                                $fecha2 = new DateTime('now');

                                $intervalo = $fecha2->diff($fecha1);
                                echo $intervalo->format('%D:%H:%I:%S');
                            ?>
                        </td>
                        <td>
                            <?php echo $datos->getName()?></td>
                        <td>
                            <input type="button" class="btn btn-danger btn-sm" onClick="check(<?php echo $datos->getId_peticionMai(); ?>)" id="liberar<?php echo $datos->getId_peticionMai(); ?>" name="liberar" value="Liberar">
                        </td>
                    </tr>
                    <?php 
                        endforeach;
                        ?>
                </table>
            </div>

        </div>
    </div>
    
    <script src="public/js/liberar_solicitudMai.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/jquery-3.3.1.min.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>
</html>