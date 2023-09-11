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
        .navH {
            color: #000000;
            font-size: medium;
        }
    </style>

</head>

<body>

    <?php
    ini_set("session.cookie_lifetime", 18000);
    ini_set("session.gc_maxlifetime", 18000);

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header('location:../../login_peticiones.php');
    }

    $consultar = 3;
    require('../controller/controlador_peticionesAccesos.php');

    ?>

    <?php include('peticiones_accesosHeader.php'); ?>

    <div class="container-fluid" id="infosPeticiones">


        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6></h6>
            </div>
            <div class="col">
                <table class="table table-striped tablesorter lenguajeTabla display" id="">
                    <thead>
                        <th style="width:10px;">#</th>
                        <th style="width:30px;">Usuario</th>
                        <th style="width:30px;">Fecha Solicitud</th>
                        <th style="width:30px;">Tipo</th>
                        <th style="width:30px;">Descripci&oacute;n</th>
                        <th style="width:30px;">Estado Solicitud</th>
                        <th style="width:30px;">Fecha Atendido</th>
                        <th style="width:30px;">Usuario Atiende</th>
                        <th style="width:30px;">Ver</th>
                    </thead>
                    <?php foreach ($peticionesAccesosxPlataforma as $datos) : ?>
                        <tr>
                            <td>
                                <?php echo $datos->getId_peticion() ?></td>
                            <td>
                                <?php echo $datos->getUsuario_creacion() ?></td>
                            <td>
                                <?php echo $datos->getFecha_creacion() ?></td>
                            <td>
                                <?php switch ($datos->getTipo()) {
                                    case 0:
                                        echo "Modificacion";
                                        break;
                                    case 1:
                                        echo "Activacion";
                                        break;
                                    case 2:
                                        echo "Inactivacion";
                                        break;
                                    case 3:
                                        echo "Novedades";
                                        break;
                                    case 4:
                                        echo "Reactivacion";
                                        break;
                                    default:
                                        echo "Modificacion";
                                } ?></td>
                            <td>
                                <?php echo $datos->getDescripcion() ?></td>
                            <td>
                                <?php echo $datos->getEstado_descripcion() ?></td>
                            <td>
                                <?php if ($datos->getEstado_peticion() == 8) {
                                    echo $datos->getFecha_atendido();
                                } ?></td>
                            <td>
                                <?php if ($datos->getEstado_peticion() == 8) {
                                    echo $datos->getUsuario_atendio();
                                } ?></td>
                            <td style="text-align:center">
                                <?php if ($datos->getEstado_peticion() == 1 || $datos->getEstado_peticion() == 3) : ?>
                                    <form action="app/view/seleccionar_peticionAccesoInsercion.php" method="POST">
                                        <input type="hidden" id="id_peticion" name="id_peticion" value="<?php echo $datos->getId_peticion(); ?>">
                                        <input type="hidden" id="usuario_creacion" name="usuario_creacion" value="<?php echo $datos->getUsuario_creacion(); ?>">
                                        <input type="hidden" id="fecha_creacion" name="fecha_creacion" value="<?php echo $datos->getFecha_creacion(); ?>">
                                        <input type="hidden" id="descripcion" name="descripcion" value="<?php echo $datos->getDescripcion(); ?>">
                                        <input type="hidden" id="plataformas" name="plataformas" value="<?php echo $datos->getPlataformas(); ?>">
                                        <input type="hidden" id="estado" name="estado" value="<?php echo $datos->getEstado_peticion(); ?>">
                                        <input type="hidden" id="estado_descripcion" name="estado_descripcion" value="<?php echo $datos->getEstado_descripcion(); ?>">
                                        <input type="hidden" id="fecha_atendido" name="fecha_atendido" value="<?php echo $datos->getFecha_atendido(); ?>">
                                        <input type="hidden" id="usuario_atendio" name="usuario_atendio" value="<?php echo $datos->getUsuario_atendio(); ?>">
                                        <input type="hidden" id="conclusiones" name="conclusiones" value="<?php echo $datos->getConclusiones(); ?>">
                                        <input type="hidden" id="aprobado" name="aprobado" value="<?php echo $datos->getAprobado(); ?>">
                                        <input type="hidden" id="tipo" name="tipo" value="<?php echo $datos->getTipo(); ?>">
                                        <input type="button" value="Revisar" class="btn btn-primary" onclick="revicionEstado(<?php echo $datos->getId_peticion(); ?>);">
                                        <input type="submit" class="btn btn-primary btn-sm" id="seleccionar<?php echo $datos->getId_peticion(); ?>" name="seleccionar" value="Revisar" style="display:none;">
                                    </form>
                                <?php endif;
                                if ($datos->getEstado_peticion() == 8) : ?>
                                    <button class="btn btn-danger btn-xs" onclick="liberarPeticion(<?php echo $datos->getId_peticion(); ?>);">Liberar</button>
                                <?php endif; ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </div>
    </div>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/lenguajeTablas.js"> </script>
    <script src="public/js/peticionesAccesosPlataformas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>



</body>

</html>