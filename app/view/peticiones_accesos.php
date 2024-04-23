<!DOCTYPE html>
<html lang="spanish">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css" />
    <link rel="stylesheet" href="public/css/smoke.min.css">
    <style type="text/css">
            .navH{ color:#000000; font-size: medium; }
    </style>

</head>

<body>

    <?php
       ini_set("session.cookie_lifetime",18000);
       ini_set("session.gc_maxlifetime",18000);

       session_start();
   
       if(!isset($_SESSION['usuario'])){
            header('location:../../login_peticiones.php');
       }

       $consultar = 1;
        require('../controller/controlador_peticionesAccesos.php');

    ?>

    <?php include('peticiones_accesosHeader.php');?>

    <div class="container-fluid" id="infosPeticiones">
        <div class="row">
                <div class="col-11 mt-4 pl-5 mb-2">
                    <h6></h6>
                </div>
                <div class="col-1 mt-4 mb-2" title="Solicitar accesos.">
                    <a href="app/view/crear_peticion_acceso.php"><img src="public/img/nuevo.png" alt=""></a>
                </div>
                <div class="col">
                        <table class="table table-striped tablesorter lenguajeTabla display" id="">
                        <thead>
                                <th style="width:10px;">#</th>
                                <th style="width:30px;">Usuario</th>
                                <th style="width:30px;">Fecha Solicitud</th>
                                <th style="width:30px;">Descripci&oacute;n</th>
                                <th style="width:30px;">Tipo</th>
                                <th style="width:30px;">Estado Solicitud</th>
                                <th style="width:30px;">Estado Aprobaci&oacute;n</th>
                                <th style="width:30px;">Fecha Atendido</th>
                                <th style="width:30px;">Usuario Atiende</th>
                                <th style="width:15px;">Ver</th>
                                <th style="width:15px;">Aceptaci&oacute;n</th>
                        </thead>
                        <?php foreach($peticionesAccesosxUsuario as $datosU): ?>
                            <?php if($datosU->getRevisado() == 0): ?>
                            <tr>
                                <td>                                
                                    <?php echo $datosU->getId_peticion() ?></td>
                                <td>
                                    <?php echo $datosU->getUsuario_creacion() ?></td>
                                <td>
                                    <?php echo $datosU->getFecha_creacion() ?></td>
                                <td>
                                    <?php echo $datosU->getDescripcion() ?></td>
                                <td>
                                    <?php switch($datosU->getTipo()){
                                        case 0:echo "Modificación";break;
                                        case 1:echo "Activación";break;
                                        case 2: echo "Inactivación";break;
                                        case 3: echo "Novedades";break;
                                        case 4: echo "Reactivación";break;
                                        Default:echo "Modificación";} ?></td> 
                                <td>
                                    <?php echo $datosU->getEstado_descripcion() ?></td> 
                                <td>
                                    <?php switch($datosU->getAprobado()){case 0:echo "Sin respuesta";break;case 12: echo "Aprobado";break;case 13: echo "No Aprobado";break;Default:echo "sin respuesta";} ?></td> 
                                <td>
                                    <?php echo $datosU->getFecha_atendido() ?></td>
                                <td>
                                    <?php echo $datosU->getUsuario_atendio() ?></td>
                                <td style="text-align:center">
                                    <form action="app/view/consulta_peticionAcceso.php" method="POST" target="_blank">
                                        <input type="hidden" id="id_peticion" name="id_peticion" value="<?php echo $datosU->getId_peticion();?>">
                                        <input type="hidden" id="usuario_creacion" name="usuario_creacion" value="<?php echo $datosU->getUsuario_creacion();?>">
                                        <input type="hidden" id="fecha_creacion" name="fecha_creacion" value="<?php echo $datosU->getFecha_creacion();?>">
                                        <input type="hidden" id="descripcion" name="descripcion" value="<?php echo $datosU->getDescripcion();?>">
                                        <input type="hidden" id="tipo" name="tipo" value="<?php echo $datosU->getTipo();?>">
                                        <input type="hidden" id="plataformas" name="plataformas" value="<?php echo $datosU->getPlataformas();?>">
                                        <input type="hidden" id="estado" name="estado" value="<?php echo $datosU->getEstado_peticion();?>">
                                        <input type="hidden" id="estado_descripcion" name="estado_descripcion" value="<?php echo $datosU->getEstado_descripcion();?>">
                                        <input type="hidden" id="fecha_atendido" name="fecha_atendido" value="<?php echo $datosU->getFecha_atendido();?>">
                                        <input type="hidden" id="usuario_atendio" name="usuario_atendio" value="<?php echo $datosU->getUsuario_atendio();?>">
                                        <input type="hidden" id="conclusiones" name="conclusiones" value="<?php echo $datosU->getConclusiones();?>">
                                        <input type="hidden" id="aprobado" name="aprobado" value="<?php echo $datosU->getAprobado();?>">
                                        <input type="submit" class="btn btn-primary" name="consultarPeticion" value="Ver">
                                    </form>
                                </td>
                                <td style="text-align:center">
                                    <?php if($datosU->getEstado_peticion() == 2 && $datosU->getRevisado() == 0): ?>
                                        <input type="checkbox" class="btn btn-danger btn-sm" onChange="revisado(<?php echo $datosU->getId_peticion(); ?>)">
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endif;?>
                        <?php endforeach;?>
                    </table>
                </div>
        </div>

        

        </div>
    </div>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/lenguajeTablas.js"> </script>
    <script src="public/js/peticionesAccesos.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
    <script src="public/js/peticionAccess.js"></script>
</body>

</html>