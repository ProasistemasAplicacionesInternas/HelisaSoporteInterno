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
    ini_set("session.cookie_lifetime", 18000);
    ini_set("session.gc_maxlifetime", 18000);

    session_start();

    if (!isset($_SESSION['usuario'])) {

        header('location:../../login_peticiones.php');
    }

    require_once('../model/crudPeticionesSg.php');
    require_once('../model/datosPeticionesSeguridad.php');

    $consultar = new CrudPeticionesSg();
    $datos = new PeticionSg();
    $consultaPeticionesSg = $consultar->consultarPeticionesFuncionarioSeguridad();

    ?>
    <div class="container-fluid" id="infoPeticionSeguridad">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Solicitudes Seguridad</h6>
            </div>
            <div class="col-1 mt-4 mb-2">
                <a href="app/view/crearPeticionSg.php">
                    <h8> Generar Solicitud</h8><img src="public/img/nuevo.png" alt="">
                </a>

            </div>
            <div class="col">
                <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                        <th style="width:10px; text-align: center;">Nro. Ticket</th>
                        <th style="width:30px; text-align: center;">Categoria</th>
                        <th style="width:30px; text-align: center;">Fecha Solicitud</th>
                        <th style="width:30px; text-align: center;">Descripcion</th>
                        <th style="width:30px; text-align: center;">Estado Solicitud</th>
                        <th style="width:30px; text-align: center;">Fecha Atiende</th>
                        <th style="width:30px; text-align: center;">Usuario Atiende</th>
                        <th style="width:30px; text-align: center;">conclusiones</th>
                        <th style="width:30px; text-align: center;">Revisar</th>
                    </thead>
                    <?php foreach ($consultaPeticionesSg as $datos) : ?>
                        <tr>
                            <td style="text-align:center">
                                <?php echo $datos->getIdPeticionSg() ?></td>
                            <td>
                                <?php echo $datos->getCategoriaSg() ?></td>
                            <td style="text-align:center">
                                <?php echo $datos->getFechaPeticionSg() ?></td>
                            <td>
                                <?php echo $datos->getDescripcionPeticionSg() ?></td>
                            <td style="text-align:center">
                                <?php echo $datos->getEstadoPeticionSg() ?></td>
                            <td style="text-align:center">
                                <?php echo $datos->getFechaAtendidoSg() ?></td>
                            <td style="text-align:center">
                                <?php echo $datos->getUsuarioAtencionSg() ?></td>
                            <td style="text-align:center">
                                <?php echo $datos->getConclusionesPeticionSg() ?></td>
                            <td style="text-align:center">
                                
                                <?php
                                $estado = $datos->getEstadoPeticionSg();
                                $revisado = $datos->getMarcaRevisadoSg();

                                if (($estado == "Resuelto") && $revisado == 1) {
                                ?>
                                    <input type="checkbox" class="btn btn-danger btn-sm" onChange="marcaRevisado(<?php echo $datos->getIdPeticionSg(); ?>)" id="revisar<?php echo $datos->getIdPeticionSg(); ?>" name="revisado" value="<?php echo $datos->getIdPeticionSg(); ?>">
                                <?php
                                } elseif ($estado == "En Proceso") {
                                ?>
                                    <form action="app/view/SeguridadSolicitudProceso.php" method="post">
                                        <input type="hidden" name="pNropeticion" id="pNropeticion" value="<?php echo $datos->getIdPeticionSg(); ?>">
                                        <input type="hidden" name="pFechapeticion" id="pFechapeticion" value="<?php echo $datos->getFechaPeticionSg(); ?>">
                                        <input type="hidden" name="pUsuario" id="pUsuario" value="<?php echo $datos->getUsuarioCreacionSg(); ?>">
                                        <input type="hidden" name="pCorreo" id="pCorreo" value="<?php echo $datos->getEmailFuncionario(); ?>">
                                        <input type="hidden" name="pCategoria" id="pCategoria" value="<?php echo $datos->getCategoriaSg(); ?>">
                                        <input type="hidden" name="pDescripcion" id="pDescripcion" value="<?php echo $datos->getDescripcionPeticionSg(); ?>">
                                        <input type="hidden" name="pCargarimagen" id="pCargarimagen" value="<?php echo $datos->getimagenPeticionSeguridad1(); ?>">
                                        <input type="hidden" name="pCargarimagen2" id="pCargarimagen2" value="<?php echo $datos->getimagenPeticionSeguridad2(); ?>">
                                        <input type="hidden" name="pCargarimagen3" id="pCargarimagen3" value="<?php echo $datos->getimagenPeticionSeguridad3(); ?>">
                                        <input type="hidden" name="pCargarimagen4" id="pCargarimagen4" value="<?php echo $datos->getimagenPeticionSeguridad4(); ?>">
                                        <input type="hidden" name="pCargarimagen5" id="pCargarimagen5" value="<?php echo $datos->getimagenPeticionSeguridad5(); ?>">
                                        <input type="hidden" name="pEstado" id="pEstado" value="<?php echo $datos->getEstadoPeticionSg(); ?>">
                                        <input type="hidden" name="pConclusiones" id="pConclusiones" value="<?php echo $datos->getConclusionesPeticionSg(); ?>">
                                        <button type="submit" class="btn btn-primary">Seleccionar</button>
                                    </form>
                                <?php
                                } else {
                                ?>
                                    <p> en validacion </p>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>

        </div>
    </div>
    <script src="public/js/marcarRevisadoSg.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>