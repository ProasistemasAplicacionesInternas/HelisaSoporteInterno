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

    require_once('../model/crud_peticionesSg.php');
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
                <a href="app/view/crear_peticionSg.php">
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
                                <?php echo $datos->getid_peticionSg() ?></td>
                            <td>
                                <?php echo $datos->getcategoriaSg() ?></td>
                            <td style="text-align:center">
                                <?php echo $datos->getfecha_peticionSg() ?></td>
                            <td>
                                <?php echo $datos->getdescripcion_peticionSg() ?></td>
                            <td style="text-align:center">
                                <?php echo $datos->getestado_peticionSg() ?></td>
                            <td style="text-align:center">
                                <?php echo $datos->getfecha_atendidoSg() ?></td>
                            <td style="text-align:center">
                                <?php echo $datos->getusuario_atencionSg() ?></td>
                            <td style="text-align:center">
                                <?php echo $datos->getconclusiones_PeticionSg() ?></td>
                            <td style="text-align:center">
                                <?php
                                $estado = $datos->getestado_peticionSg();
                                $revisado = $datos->getmarcaRevisadoSg();

                                if (($estado == "Resuelto") && $revisado == 1) {
                                ?>
                                    <input type="checkbox" class="btn btn-danger btn-sm" onChange="marcarevisado(<?php echo $datos->getid_peticionSg(); ?>)" id="revisar<?php echo $datos->getid_peticionSg(); ?>" name="revisado" value="<?php echo $datos->getid_peticionSg(); ?>">
                                <?php
                                } elseif ($estado == "En Proceso") {
                                ?>
                                    <form action="app/view/SeguridadSolicitudProceso.php" method="post">
                                        <input type="hidden" name="p_nropeticion" id="p_nropeticion" value="<?php echo $datos->getId_peticionSg(); ?>">
                                        <input type="hidden" name="p_fechapeticion" id="p_fechapeticion" value="<?php echo $datos->getFecha_peticionSg(); ?>">
                                        <input type="hidden" name="p_usuario" id="p_usuario" value="<?php echo $datos->getUsuario_creacionSg(); ?>">
                                        <input type="hidden" name="p_correo" id="p_correo" value="<?php echo $datos->getEmail_funcionario(); ?>">
                                        <input type="hidden" name="p_categoria" id="p_categoria" value="<?php echo $datos->getcategoriaSg(); ?>">
                                        <input type="hidden" name="p_descripcion" id="p_descripcion" value="<?php echo $datos->getDescripcion_peticionSg(); ?>">
                                        <input type="hidden" name="p_cargarimagen" id="p_cargarimagen" value="<?php echo $datos->getimagenPeticionSeguridad1(); ?>">
                                        <input type="hidden" name="p_cargarimagen2" id="p_cargarimagen2" value="<?php echo $datos->getimagenPeticionSeguridad2(); ?>">
                                        <input type="hidden" name="p_cargarimagen3" id="p_cargarimagen3" value="<?php echo $datos->getimagenPeticionSeguridad3(); ?>">
                                        <input type="hidden" name="p_cargarimagen4" id="p_cargarimagen4" value="<?php echo $datos->getimagenPeticionSeguridad4(); ?>">
                                        <input type="hidden" name="p_cargarimagen5" id="p_cargarimagen5" value="<?php echo $datos->getimagenPeticionSeguridad5(); ?>">
                                        <input type="hidden" name="p_estado" id="p_estado" value="<?php echo $datos->getEstado_peticionSg(); ?>">
                                        <input type="hidden" name="p_conclusiones" id="p_conclusiones" value="<?php echo $datos->getConclusiones_peticionSg(); ?>">
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