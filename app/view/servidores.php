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
            
        
        require_once('../model/crud_servidor.php');
        require_once('../model/datos_servidor.php');
        require_once('../controller/control_servidor.php');
    
        $consultar= new DatosServidor();
        $datos= new Servidor();
    
        $consultaServidor=$consultar->consultaServidor();
 
    
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Lista de Servidores</h6>
            </div>
            <div class="col-1 mt-4 mb-2">
                <a href="app/view/crea_servidor.php" target="_blank"><img src="public/img/nuevo.png" alt=""></a>
            </div>
           <div class="col">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <th style="display:none;">ID SERVIDOR</th>
                        <th>Serial</th>
                        <th>Marca</th>
                        <th>Nombre</th>
                        <th>Ubicaci&oacute;n</th>
                        <th>I.P. Servidor</th>
                        <th>I.P. P&uacute;blica</th>
                    <!--/*------------------@jefferson.correa--------------------*/-->
                        <th style="display:none;">Usuario Administrador</th>
                        <th style="display:none;">Usuario Est&aacute;ndar</th>
                    <!--/*------------------@jefferson.correa--------------------*/-->
                        <th>Puerto</th>
                        <th>Tipo Servidor </th>
                        <th>Modificar</th>
                        <th>M&aacute;quinas</th>
                    </thead>
                    <?php foreach ($consultaServidor as $datos): ?>
                    <tr>
                        <td style="display:none;"><span id="id_servidor<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getIDservidor() ?></span>
                        </td>
                        <td><span id="serial_servidor<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getSerial_servidor()?></span>
                        </td>
                        <td><span id="marca_servidor<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getMarca_servidor()?></span>
                        </td>
                        <td><span id="nombre_servidor<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getNombre_servidor()?></span>
                        </td>
                        <td><span id="ubicacion_servidor<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getUbicacion_servidor()?></span>
                        </td>
                        <td><span id="IP_servidor<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getIP_servidor()?></span>
                        </td>
                        <td><span id="IP_publica<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getIP_publica()?></span>
                        </td>
                    <!--/*------------------@jefferson.correa--------------------*/-->
                        <td style="display: none;"><span id="usuarioAdministradorC<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getUsuarioAdministrador()?></span>
                        </td>
                        <td style="display: none;"><span id="UsuarioEstandarC<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getUsuarioEstandar()?></span>
                        </td>
                    <!--/*------------------@jefferson.correa--------------------*/-->
                        <td><span id="puerto_servidor<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getPuerto_servidor()?></span>
                        </td>
                        <td><span id="tipoServidor<?php echo $datos->getIDservidor() ?>"><?php echo $datos->getTipoServidor()?></span>
                        </td>
                    <!--/*------------------@jefferson.correa--------------------*/-->
                        <td>
                            <form action="app/view/modifica_servidor.php" method="post" target="_blank">
                                <input type="hidden" name="servidor" value="<?php echo $datos->getIDservidor(); ?>">
                                <input type="submit" class="btn btn-primary btn-sm " value="Modificar Servidor" name="modificar">
                            </form>
                        </td>

                        <td>
                            <form action="app/view/maquinaXservidor.php" method="post" target="_blank">
                                <input type="hidden" name="id_servidorMaquina" id="id_servidorMaquina" value="<?php  echo $datos->getIDservidor(); ?>">
                                <input type="hidden" name="nombre_servidorMaquina" id="nombre_servidorMaquina" value="<?php  echo $datos->getNombre_servidor(); ?>">
                                <input type="submit" class="btn btn-success btn-sm " value="Crear M&aacute;quina" name="modificar">
                            </form>
                        </td>
                    <!--/*------------------@jefferson.correa--------------------*/-->
                    <?php 
                endforeach;
                    ?>
                    </tr>
                </table>
            </div> 
        </div>        
    </div>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/crear_maquina.js?v1"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>
</html>