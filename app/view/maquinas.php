<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Software para el trabajo</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css" />
    
</head>

<body>
   <?php
   ini_set("session.cookie_lifetime","18000");
   ini_set("session.gc_maxlifetime","18000");

   session_start();
   
   if(!isset($_SESSION['usuario'])|| empty($_SESSION['usuario'])){
       
       header('location:../../login.php');
   }
            
        require_once('../model/crud_maquina.php');
        require_once('../model/datos_maquina.php');
        require_once('../controller/controlador_matriz_servidores.php');
    
        $consultar= new DatosMaquina();
        $datos= new Maquina();
    
        $consultaMaquinas=$consultar->consulta();
 
    
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Lista de M&aacute;quinas Virtuales</h6>
            </div>
            <div class="col-12 ml-5">
                <div class="col-6">
                    <a href="app/view/crea_maquina.php" ><img src="public/img/nuevo.png" alt="" style="margin:0px 0px 0px 971px"></a>
                </div>
                <div class="col-6">
                <form action="app/view/reporte_maquinas.php" method="POST">
                        <input type="submit" class="btn btn-outline-success btn-sm" name="generar" id="generar" value="Reporte PDF" target="_blanck" style="margin:-44px 0px 0px 881px">
                    </form>
                </div>
            </div>            <div class="col">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <th style="display:none;"></th>
                        <th style="display:none;">id servidor</th>
                        <th>Nombre</th>
                        <th>Ubicaci&oacute;n</th>
                        <th>I.P. M&aacute;quina</th>
                        <th>I.P. P&uacute;blica</th>
                        <th>Puerto</th>
                        <th>Servidor</th>
                        <th>Modificar</th>
                    </thead>
                     <?php foreach($consultaMaquinas as $datos): ?>
                    <tr>
            
                       <td style="display:none;"><span id="id_maquina<?php echo $datos->getIDmaquina(); ?>"><?php echo $datos->getIDmaquina() ?></span></td>

                       <td style="display:none;"><span id="id_servidor<?php echo $datos->getIDmaquina(); ?>"><?php echo $datos->getNumeroServidor() ?></span></td>

                        <td>
                            <span id="nombre_maquina<?php echo $datos->getIDmaquina(); ?>"><?php echo $datos->getNombre_maquina() ?></span>
                        </td>

                        <td>
                            <span id="ubicacion_maquina<?php echo $datos->getIDmaquina(); ?>"><?php echo $datos->getUbicacion_maquina() ?></span>
                        </td>

                        <td>
                            <span id="IP_maquina<?php echo $datos->getIDmaquina(); ?>"><?php echo $datos->getIP_maquina() ?></span>
                        </td>

                        <td>
                            <span id="IP_publica_maquina<?php echo $datos->getIDmaquina(); ?>"><?php echo $datos->getIP_publica() ?></span>
                        </td>

                        <td>
                            <span id="puerto_maquina<?php echo $datos->getIDmaquina(); ?>"><?php echo $datos->getPuerto_maquina() ?></span>
                        </td>

                        <td>
                            <span id="nombreServidor<?php echo $datos->getIDmaquina();?>"><?php echo $datos->getNombreServidor() ?></span>
                        </td>
                        
                        <td>
                            <form action="app/view/modifica_maquina.php" method="post" target="_blank">
                                <input type="hidden" name="maquinaMod" id="maquinaMod" value="<?php echo $datos->getIDmaquina(); ?>">
                                <input type="submit" class="btn btn-primary btn-sm" value="Modificar M&aacute;quina" name="seleccionarMaquina">
                            </form>
                        </td> 
                        <?php 
                        endforeach;
                        ?>
                    </tr>
                </table>

             
                </div>
            </div>
        </div>
    <!--<script src="public/js/selector_maquina.js"></script>-->
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html></html>