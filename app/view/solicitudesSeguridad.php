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
                                $fecha1 = new DateTime($datos1->getFecha_peticionSg());
                                $fecha2 = new DateTime('now');

                                $intervalo = $fecha2->diff($fecha1);

                                $varH = $intervalo->format('%H');
                                $varD = $intervalo->format('%D');
                                $varM = $intervalo->format('%m');

                                $color = $crud->coloresR($varD, $varH, $varM);
                                ?>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getId_peticionSg(); ?>
                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getUsuario_creacionSg(); ?>
                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getFecha_peticionSg(); ?>
                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getArea_funcionario(); ?>
                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getcategoriaSg() ?>
                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getEstado_peticionSg(); ?>

                                </td>
                                <td style="background-color:<?= $color ?>;">
                                    <?php echo $datos1->getUsuario_atencionSg(); ?>
                                </td>

                                <td style="background-color:<?= $color ?>;">
                                    <form action="app/view/seleccionarPeticionSeguridad.php" method="post">
                                        <input type="hidden" name="p_nropeticion" id="p_nropeticion" value="<?php echo $datos1->getId_peticionSg(); ?>">

                                        <input type="hidden" name="p_fechapeticion" id="p_fechapeticion" value="<?php echo $datos1->getFecha_peticionSg(); ?>">

                                        <input type="hidden" name="p_usuario" id="p_usuario" value="<?php echo $datos1->getUsuario_creacionSg(); ?>">

                                        <input type="hidden" name="p_extension" id="p_extension" value="<?php echo $datos1->getExtension_funcionario(); ?>">

                                        <input type="hidden" name="p_correo" id="p_correo" value="<?php echo $datos1->getEmail_funcionario(); ?>">

                                        <input type="hidden" name="p_categoria" id="p_categoria" value="<?php echo $datos1->getcategoriaSg(); ?>">

                                        <input type="hidden" name="p_descripcion" id="p_descripcion" value="<?php echo $datos1->getDescripcion_peticionSg(); ?>">

                                        <input type="hidden" name="p_cargarimagen" id="p_cargarimagen" value="<?php echo $datos1->getimagenPeticionSeguridad1(); ?>">

                                        <input type="hidden" name="p_cargarimagen2" id="p_cargarimagen2" value="<?php echo $datos1->getimagenPeticionSeguridad2(); ?>">

                                        <input type="hidden" name="p_cargarimagen3" id="p_cargarimagen3" value="<?php echo $datos1->getimagenPeticionSeguridad3(); ?>">

                                        <input type="hidden" name="p_estado" id="p_estado" value="<?php echo $datos1->getEstado_peticionSg(); ?>">

                                        <input type="hidden" name="p_conclusiones" id="p_conclusiones" value="<?php echo $datos1->getConclusiones_peticionSg(); ?>">

                                        <input type="button" value="Seleccionar" class="btn btn-primary" onclick="validarBoton('<?php echo $_SESSION['usuario']; ?>',<?php echo $datos1->getId_peticionSg(); ?>)">

                                        <input type="submit" value="Seleccionar" name="seleccionar_peticionmai" id="seleccionar_peticionmai<?php echo $datos1->getId_peticionSg(); ?>" class="btn btn-info" style="display:none;">
                                    </form>
                                </td>
                            <?php
                        endforeach;
                            ?>

                            </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="public/js/validacion_seleccionar.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>