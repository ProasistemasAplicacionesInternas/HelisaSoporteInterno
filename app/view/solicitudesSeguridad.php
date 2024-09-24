<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
    <link rel="stylesheet" href="public/css/smoke.min.css">

</head>

<body>
    <?php
    ini_set("session.cookie_lifetime", "18000");
    ini_set("session.gc_maxlifetime", "18000");

    session_start();

    if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {

        header('location:../../login.php');
    }

    require('../model/crud_peticionesSg.php');
    require('../model/datosPeticionesSeguridad.php');



    $crud = new CrudPeticionesSg();
    $datos1 = new PeticionSg();



    $consultaPeticiones = $crud->consultarPeticionesSg();


    ?>
    <div class="container-fluid" id="infosSeguridad" name="infosSeguridad">
        <div class="row">
            <div class="col-11 mt-4 pl-5">
                <h6>Solicitudes Seguridad</h6>
            </div>

            <div class="col">

                <table class="table table-striped">
                    <thead style="background-color:#d7007bb3; text-align:center; color:white;">
                        <th>Nro Ticket</th>
                        <th>Usuario Solicitante</th>
                        <th>Fecha solicitud</th>
                        <th>Área</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th>Atiende</th>
                        <th>Modificar</th>

                    </thead>

                    <tbody>

                        <?php foreach ($consultaPeticiones as $datos1) : ?>
                            <tr style="text-align:center;">
                                <?php
                                date_default_timezone_set('America/Bogota');
                                $fecha1 = new DateTime($datos1->getFechaPeticionSg());
                                $fecha2 = new DateTime('now');

                                $intervalo = $fecha2->diff($fecha1);

                                $varH = $intervalo->format('%H');
                                $varD = $intervalo->format('%D');
                                $varM = $intervalo->format('%m');

                                $color = $crud->coloresR($varD, $varH, $varM);
                                ?>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getIdPeticionSg(); ?>
                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getUsuarioCreacionSg(); ?>
                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getFechaPeticionSg(); ?>
                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getAreaFuncionario(); ?>
                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getCategoriaSg() ?>
                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getEstadoPeticionSg(); ?>

                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getUsuarioAtencionSg(); ?>
                                </td>

                                <?php if ($datos1->getEstadoPeticionSg() != 'En Proceso') : ?>
                                    <td style="background-color:<?= $color ?>;">
                                        <form action="app/view/seleccionarPeticionSeguridad.php" method="post">
                                            <input type="hidden" name="pNropeticion" id="pNropeticion" value="<?php echo $datos1->getIdPeticionSg(); ?>">
                                            <input type="hidden" name="pFechapeticion" id="pFechapeticion" value="<?php echo $datos1->getFechaPeticionSg(); ?>">
                                            <input type="hidden" name="pUsuario" id="pUsuario" value="<?php echo $datos1->getUsuarioCreacionSg(); ?>">
                                            <input type="hidden" name="areaSg" id="areaSg" value="<?php echo $datos1->getAreaFuncionario(); ?>">
                                            <input type="hidden" name="pCorreo" id="pCorreo" value="<?php echo $datos1->getEmailFuncionario(); ?>">
                                            <input type="hidden" name="pCategoria" id="pCategoria" value="<?php echo $datos1->getCategoriaSg(); ?>">
                                            <input type="hidden" name="pDescripcion" id="pDescripcion" value="<?php echo $datos1->getDescripcionPeticionSg(); ?>">
                                            <input type="hidden" name="pCargarimagen" id="pCargarimagen" value="<?php echo $datos1->getImagenPeticionSeguridad1(); ?>">
                                            <input type="hidden" name="pCargarimagen2" id="pCargarimagen2" value="<?php echo $datos1->getImagenPeticionSeguridad2(); ?>">
                                            <input type="hidden" name="pCargarimagen3" id="pCargarimagen3" value="<?php echo $datos1->getImagenPeticionSeguridad3(); ?>">
                                            <input type="hidden" name="pCargarimagen4" id="pCargarimagen4" value="<?php echo $datos1->getImagenPeticionSeguridad4(); ?>">
                                            <input type="hidden" name="pCargarimagen5" id="pCargarimagen5" value="<?php echo $datos1->getImagenPeticionSeguridad5(); ?>">
                                            <input type="hidden" name="pEstado" id="pEstado" value="<?php echo $datos1->getEstadoPeticionSg(); ?>">
                                            <input type="hidden" name="pConclusiones" id="pConclusiones" value="<?php echo $datos1->getConclusionesPeticionSg(); ?>">
                                            <input type="submit" value="seleccionar" name="seleccionarPeticionSeguridad" id="seleccionarPeticionSeguridad" class="btn btn-info">
                                        </form>
                                    </td>
                                <?php else : ?>
                                    <td style="background-color:<?= $color ?>;">Validacion por usuario</td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>