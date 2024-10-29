<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Aplicaciones Internas</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/peticion.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../public/css/peticionesmai.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
    <link rel="stylesheet" href="../../public/css/seleccionarPeticionesMai.css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">

</head>

<body>
    <?php
    header('Cache-Control: no cache'); //duplicidad pantalla
    session_cache_limiter('private_no_expire'); //
    ini_set("session.cookie_lifetime", 18000);
    ini_set("session.gc_maxlifetime", 18000);

    session_start();
    if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
        header('location:../../login.php');
    } else {
        $user = $_SESSION['usuario'];
    }

    include('../controller/controlador_soportemai.php');
    include('../controller/controlador_seleccionPeticion.php');
    $codigo = $_POST['p_nropeticion'];
    $fechapeticion = $_POST['p_fechapeticion'];
    $usuario = $_POST['p_usuario'];
    $extension = $_POST['p_extension'];
    $correo = $_POST['p_correo'];
    $categoria = $_POST['p_categoria'];
    $descripcion = $_POST['p_descripcion'];
    $imagen = $_POST['p_cargarimagen'];
    $imagen2 = $_POST['p_cargarimagen2'];
    $imagen3 = $_POST['p_cargarimagen3'];
    $estado = $_POST['p_estado'];
    $name = $_POST['soporteMai'];
    $req_nombre = $_POST['req_nombre'];
    $req_justificacxion = $_POST['req_justificacion'];
    $conclusiones = $_POST['p_conclusiones'];
    if ($name == "Requerimientos") {
        $sprint = $_POST['p_sprint'];
        $gestion = $_POST['p_gestion'];
    }

    require_once("../controller/trae_observaciones.php");

    ?>


    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/Logo_blanco.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div>
            <div class='box1'>
                <form action="../controller/controlador_peticionmai.php" method="post" enctype="multipart/form-data">
                    <div style="display:none">
                        <input type="text" id="user" name="user" class="form-control" value="<?php echo $user; ?>" readonly>
                    </div>
                    <div class="row">
                        <div class="peq">
                            <label>Cod</label>
                            <input type="text" id="p_nropeticion" name="p_nropeticion" class="form-control" value="<?php echo $codigo; ?>" readonly>
                        </div>
                        <div class="medium">
                            <label>Fecha Solicitud</label>
                            <input type="text" id="p_fechapeticion" name="p_fechapeticion" class="form-control" value="<?php echo  $fechapeticion; ?>" readonly>
                        </div>
                        <div class="medium">
                            <label>Usuario</label>
                            <input type="text" id="p_usuario" name="p_usuario" class="form-control" value="<?php echo  $usuario; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="little">
                            <label>Ext</label>
                            <input type="text" id="p_extension" name="p_extension" class="form-control" value="<?php echo $extension; ?>" readonly>
                        </div>
                        <div class="normal">
                            <label>Correo</label>
                            <input type="text" id="p_correo" name="p_correo" class="form-control" value="<?php echo $correo; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="bigGiant">
                            <label>Producto</label>
                            <input type="text" id="p_categoria" name="p_categoria" class="form-control" value="<?php echo $categoria; ?>  " readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="bigGiant" id="div_nombre">
                            <label>Nombre del requerimiento</label>
                            <input type="text" id="req_nombre" name="req_nombre" class="form-control" value="<?php echo $req_nombre; ?>  " readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="giant">
                            <label for="">Descripción</label>
                            <textarea id="p_descripcion" name="p_descripcion" class="form-control col-12" rows="4" readonly><?php echo $descripcion; ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="giant" id="div_justificacion">
                            <label for="">Justificacion del requerimiento</label>
                            <textarea id="req_justificacion" name="req_justificacion" class="form-control col-12" rows="4" readonly><?php echo $req_justificacxion; ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="littleMedium">
                            <label id="label">Tipo de petición</label>
                            <select id="soporteMai" name="soporteMai" class="selectView">
                                <?php
                                foreach ($listado_soporte as $tipoSoporte) {
                                    echo "<option value='" . $tipoSoporte['id'] . "'";
                                    if ($name == $tipoSoporte['nombre']) {
                                        echo 'selected';
                                    }
                                    echo ">" . $tipoSoporte["nombre"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="littleMedium">
                            <label id="label">Estado</label>
                            <select name="p_estado" id="p_estado" class="selectView" required>
                                <option value=""></option>
                                <?php if ($name == "Requerimientos") : ?>
                                    <option value="3">Pendiente</option>
                                    <option value="19">Gestión de Cambios</option>
                                    <option value="18">En Desarrollo</option>
                                    <option value="20">En Pruebas Solicitante</option>
                                    <option value="24">En Pruebas Test</option>
                                    <option value="21">Cargue de Versión</option>
                                    <option value="2">Resuelto</option>
                                    <option value="4">Redireccionado</option>
                                    <option value="23">Backlog</option>
                                    <option value="25">En Producción</option>
                                    <option value="26">Descartado</option>
                                <?php elseif (true) : ?>
                                    <option value= "2">Resuelto</option>
                                    <option value= "3">Pendiente</option>
                                    <option value= "4">Redireccionado</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <?php if ($name == "Requerimientos") : ?>
                            <div class="littleMedium">
                                <label id="label">Gestionado</label>
                                <br>
                                <?php if ($gestion == "SI") : ?>
                                    <input type="checkbox" class="col-4" id="gestionado" name="gestionado" checked>
                                <?php else : ?>
                                    <input type="checkbox" class="col-4" id="gestionado" name="gestionado">
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                        <div class="littleMedium">
                            <label id="label">¿Requiere Versión?</label>
                            <select name="version" id="version" class="selectView" required>
                                <option value="Si">Si Requiere</option>
                                <option value="No" selected>No Requiere</option>
                            </select>
                        </div>
                        <div class="littleMedium" id="nVersionDiv">
                            <label>Numero version</label>
                            <input class="selectView " type="text" name="nVersion" id="nVersion" placeholder="Número de versión" />
                        </div>
                        <?php if ($name == "Requerimientos") : ?>
                            <div class="littleMedium">
                                <div class="giant">
                                    <label for="">Sprint</label>
                                    <input id="sprint" name="sprint" placeholder="# de sprint" class="form-control col-9 selectView" required value="<?php echo $sprint; ?>"></input>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mt-3">
                        <?php if ($imagen != '2') { ?>
                            <input type="hidden" id="imagenCa" name="imagenCa" value="<?php echo $imagen; ?>">
                            <div class="contenedorImagenes">
                                <label for="">Imagen</label><br><br>
                                <a href="../../cartas/<?= $imagen ?>" target="_blanck">
                                    <img src="../../cartas/<?php echo ($imagen) ?>" alt="" width="413" height="250">
                                </a>
                            </div>
                        <?php } else { ?>
                            <input type="hidden" id="imagenCa" name="imagenCa" value="2">
                        <?php } ?>

                        <?php if ($imagen2 != '2') {
                            echo ' '; ?>
                            <input type="hidden" id="imagen2" name="imagen2" value="<?php echo $imagen2; ?>">
                            <div class="contenedorImagenes2">
                                <label for="">Imagen 2</label><br><br>
                                <a href="../../cartas/<?= $imagen2 ?>" target="_blanck">
                                    <img src="../../cartas/<?php echo ($imagen2) ?>" alt="" width="413" height="250">
                                </a>
                            </div>
                        <?php } else { ?>
                            <input type="hidden" id="imagen2" name="imagen2" value="2">
                        <?php } ?>
                        <?php if ($imagen3 != '2') {
                            echo ' '; ?>
                            <input type="hidden" id="imagen3" name="imagen3" value="<?php echo $imagen3; ?>">
                            <div class="contenedorImagenes3">
                                <label for="">Imagen 3</label><br>
                                <a href="../../cartas/<?= $imagen3 ?>" target="_blanck">
                                    <img src="../../cartas/<?php echo ($imagen3) ?>" alt="" width="313" height="150">
                                </a>
                            </div>
                        <?php } else { ?>
                            <input type="hidden" id="imagen3" name="imagen3" value="2">
                        <?php } ?>
                    </div><br>
                    <div class="row">
                        <div class="giant">
                            <label for="">Observaciones</label>
                            <textarea id="p_conclusiones" name="p_conclusiones" class="form-control col-12" rows="8" required><?= strip_tags('<br/>') ?></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="giant">
                            <div class="col-6 mt-2" id="imagenDiv">
                                <label id="label">Seleccione el documento </label>
                                <input type="file" id="imagen[]" name="imagen[]">
                            </div>
                            <label class="mt-2" id="textImg" style="min-width:150%"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="giant">
                            <input type="submit" value="Guardar" id="aceptar_petmai" name="aceptar_petmai" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <div class='col-6 box2'>
                <?php if (count($observaciones) != 0) :
                    foreach ($observaciones as $observacion) {
                ?>
                        <div class="boxObs">
                            <div class="row">
                                <div class="medium">
                                    <label>Fecha </label>
                                    <input type="text" id="obsData" name="obsData" class="form-control" value="<?php echo $observacion['fecha_observacion']; ?>  " readonly>
                                </div>

                                <div class="little">
                                    <label>Usuario </label>
                                    <input type="text" id="obsUser" name="obsUser" class="form-control" value="<?php echo $observacion['usuario_creacion']; ?>  " readonly>
                                </div>

                                <div class="littleMedium">
                                    <label>Estado </label>
                                    <input type="text" id="obsStatus" name="obsStatus" class="form-control" value="<?php echo $observacion['estado']; ?>  " readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="giant">
                                    <label for="">Observaciones</label>
                                    <textarea id="obs" name="obs" class="form-control" rows="4" readonly><?php echo  $observacion['descripcion_observacion'] ?></textarea>
                                </div>
                            </div>
                            <div class="line row">
                                <div class="giant">

                                </div>
                            </div>
                        </div>
                <?php
                    }
                endif;
                ?>
            </div>
        </div>
    </div>
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/correo_archivos.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/despliegueVersion.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    <script src="../../public/js/seleccionar_peticionmai.js"></script>
</body>

</html>