<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css" />
    <link rel="stylesheet" href="public/css/smoke.min.css">

</head>

<body>

    <?php
    ini_set("session.cookie_lifetime", 18000);
    ini_set("session.gc_maxlifetime", 18000);

    session_start();

    if (!isset($_SESSION['usuario'])) {

        header('location:../../login.php');
    }

    require_once('../controller/controlador_funcionarios.php');
    require_once('../model/crud_funcionarios.php');
    require_once('../model/datos_funcionarios.php');

    $consultar = new CrudFuncionarios();
    $datos = new Funcionario();

    $consultaFuncionarios = $consultar->consultarFuncionarios();
    $datos->getF_estado();
    $datos->getF_fecha_inactivacion();
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Funcionarios</h6>
            </div>
            <div class="col-1 mt-4 mb-2">
                <a href="app/view/crear_funcionario.php" target="_blank"><img src="public/img/nuevo.png" alt=""></a>
            </div>
            <div class="col">
                <table class="table table-striped tablesorter" id="tabla">
                    <thead style="text-align:center;">
                        <th style="width:50px;">Nro identificaci&oacute;n</th>
                        <th>Nombre</th>
                        <th style="width:50px;">Email</th>
                        <th style="width:50px;">Area</th>
                        <th style="width:50px;">Cargo</th>
                        <th style="width:50px;">Extension</th>
                        <th style="width:50px;">Usuario</th>
                        <th style="width:50px;">Modificar</th>
                        <th style="width:50px;">Cambiar Contraseña</th>
                    </thead>
                    <?php foreach ($consultaFuncionarios as $datos) : ?>
                        <tr id="contenido_tabla">
                            <td>
                                <?php echo $datos->getF_identificacion() ?></td>
                            <td>
                                <?php echo $datos->getF_nombre() ?></td>
                            <td>
                                <?php echo $datos->getF_email() ?></td>
                            <td>
                                <?php echo $datos->getF_area() ?></td>
                            <td>
                                <?php echo $datos->getF_cargo() ?></td>
                            <td>
                                <?php echo $datos->getF_extension() ?></td>
                            <td>
                                <?php echo $datos->getF_usuario() ?></td>
                            <td>
                                <form action="app/view/modificar_funcionario.php" method="post">
                                    <input type="hidden" name="f_identificacion" id="f_identificacion" value="<?php echo $datos->getF_identificacion(); ?>">
                                    <input type="hidden" name="f_nombre" id="f_nombre" value="<?php echo $datos->getF_nombre(); ?>">
                                    <input type="hidden" name="f_email" id="f_email" value="<?php echo $datos->getF_email(); ?>">
                                    <input type="hidden" name="f_email2" id="f_email2" value="<?php echo $datos->getF_email2(); ?>">
                                    <input type="hidden" name="f_area" id="f_area" value="<?php echo $datos->getF_area(); ?>">
                                    <input type="hidden" name="f_cargo" id="f_cargo" value="<?php echo $datos->getF_cargo(); ?>">
                                    <input type="hidden" name="f_extension" id="f_extension" value="<?php echo $datos->getF_extension(); ?>">
                                    <input type="hidden" name="f_usuario" id="f_usuario" value="<?php echo $datos->getF_usuario(); ?>">
                                    <input type="hidden" name="f_contrasena" id="f_contrasena" value="<?php echo $datos->getF_contrasena(); ?>">
                                    <input type="hidden" name="f_rol" id="f_rol" value="<?php echo $datos->getF_rol(); ?>">
                                    <input type="hidden" name="f_nombre_rol" id="f_nombre_rol" value="<?php echo $datos->getF_nombre_rol(); ?>">
                                    <input type="hidden" name="f_centroCostos" id="f_centroCostos" value=<?php echo $datos->getCentroCostos(); ?>>
                                    <input type="hidden" name="f_departamentoInterno" id="f_departamentoInterno" value=<?php echo $datos->getDepartamentoInterno(); ?>>
                                    <input type="submit" value="Modificar" name="modificar" class="btn btn-info">
                                </form>
                            </td>
                            <td>
                            <button type="button" class="btn btn-warning btn-sm cambio-clave" data-toggle="modal" data-target="#cambio-clave" id="cambioClavex" name="cambioClavex" onclick="identidadF(<?php echo $datos->getF_identificacion(); ?>);" value="<?php echo $datos->getF_identificacion(); ?>"><span>Cambio De Contraseña</span>
                        </button>
                                
                    </td>

                        </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
        <div class="modal fade mt-4" id="cambio-clave" role="dialog" aria-labelledby="cambio-clave" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Modifica Usuarios</h6>
                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid cotenedor">
                            <div class="row fila">
                                <div class="col-12">
                                    <form method="post" class="form-group">
                                        <div class="form-group">
                                            <input type="hidden" id="nombre_a" name="nombre_f" value="<?php echo $_SESSION['usuario']; ?>">
                                            <label>Dígite su contraseña: <strong><?php echo $_SESSION['usuario']; ?></strong></label>
                                            <input type="password" id="pass_a" name="pass_a" class="form-control" placeholder="Contraseña" required>
                                        </div>
                                        <div class="modal-footer">
                                            <input type=button value="Verificar" id="validarUsuario" name="validarUsuario" class="col-3 mt-4 btn btn-outline-success btn btn-guardar" data-dismiss="modal">
                                            <button type="button" class="btn btn-outline-secondary col-3 mt-4" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade mt-4" id="cambio-clave-funcionario" role="dialog" aria-labelledby="cambio-clave-funcionario" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Dígite clave nueva:</h6>
                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid cotenedor">
                            <div class="row fila">
                                <div class="col-12">
                                    <form method="post" class="form-group">
                                        <div class="form-group">
                                            <label>Funcionario:</label>
                                            <input type="text" id="funcionario" name="funcionario" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Dígite la contraseña:</label>
                                            <input type="password" id="firstPass" name="firstPass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Dígite la contraseña nuevamente:</label>
                                            <input type="password" id="secondPass" name="secondPass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label id="mensaje"></label>
                                        </div>
                                        <div class="modal-footer">
                                            <input type=button value="Guardar" id="passFuncionario" name="passFuncionario" class="col-3 mt-4 btn btn-outline-primary btn btn-guardar">
                                            <button type="button" class="btn btn-outline-secondary col-3 mt-4" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
    <script src="public/js/modalCambioClave.js"></script>
</body>

</html>