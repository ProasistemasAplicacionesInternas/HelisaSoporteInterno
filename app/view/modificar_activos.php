<?php

$estados = array(
    '0' => 'No está definido',
    '1' => 'Dado de baja - activos retirados por obsolencia o por condiciones que no permiten el correcto funcionamiento',
    '2' => 'Malo - activos con una falla sustancial que no permite el correcto funcionamiento',
    '3' => 'Regular - Activos en uso que presentan alguna',
    '4' => 'Bueno - Activos adquiridos mayores a 1 año',
    '5' => 'Nuevo - Activos adquiridos menores a 1 año'
);

//*****************************************************************************************************//
//******************************* FORMULARIO PARA LA CREACION DE FUNCIONARIOS *************************//
//*****************************************************************************************************//

ini_set("session.cookie_lifetime", 18000);
ini_set("session.gc_maxlifetime", 18000);
session_start();

if (!isset($_SESSION['usuario'])) {

    header('location:../../login.php');
}

$af_codigo = $_POST['af_codigo'];
$af_serial = $_POST['af_serial'];
$af_marca = $_POST['af_marca'];
$af_modelo = $_POST['af_modelo'];
$af_nombre = $_POST['af_nombre'];
$af_fechaCompra = $_POST['af_fechaCompra'];
$af_grupo = $_POST['af_categoria'];
$af_estado = $_POST['af_estado'];
$af_estado_descripcion = $_POST['af_estado_descripcion'];
$af_area = $_POST['af_area'];
$af_ubicacion = $_POST['af_ubicacion'];
$af_responsable = $_POST['af_responsable'];
$af_fechaAsignacion = $_POST['af_fechaAsignacion'];
$af_observaciones = $_POST['af_observaciones'];
//-----------------------------------------------------
$af_ram = $_POST['af_ram'];
$af_discoDuro = $_POST['af_discoDuro'];
$af_procesador = $_POST['af_procesador'];
$hostName = $_POST['hostName'];
$af_so = $_POST['af_so'];
$af_licenciaSo = $_POST['af_licenciaSo'];
$af_dominio = $_POST['af_dominio'];
$af_aplicaciones = $_POST['af_aplicaciones'];
$af_office = $_POST['af_office'];
$af_antivirus = $_POST['af_antivirus'];
$af_areaCreacion = $_POST['af_areaCreacion'];
$af_imagenActivo = $_POST['af_imagenActivo'];
$costoCompra = $_POST['costoCompra'];
$tipoAct = $_POST['tipoAct'];
$vidaUtil = $_POST['vidaUtil'];
$estadoAct = $_POST['estadoAct'];
$traCategoria = $_POST['traCategoria'];
$sede = $_POST['sede'];


require_once ('../controller/controlador_activosFijos.php');
require ('../controller/controlador_areas.php');
require ('../controller/controlador_funcionarios.php');
require ('../controller/controlador_gruposActivos.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="../../public/css/activosFijos.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
</head>

<body>

    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/logo.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <h6 class="mt-3">Modificación De Activos Fijos</h6>
            <div class="col-13 ml-5">

                <form class="form-group" id="formularioModifica">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Código De Activo</label>
                                <input type="text" id="af_codigo" name="af_codigo" class="form-control info"
                                    maxlength="25" autocomplete="off" value="<?php echo $af_codigo ?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Serial</label>
                                <input type="text" id="af_serial" name="af_serial" class="form-control info"
                                    maxlength="260" autocomplete="off" value="<?php echo $af_serial ?>" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" id="af_marca" name="af_marca" class="form-control info"
                                    autocomplete="off" value="<?php echo $af_marca ?>" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input type="text" id="af_modelo" name="af_modelo" class="form-control info"
                                    autocomplete="off" value="<?php echo $af_modelo ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="af_nombre" name="af_nombre" class="form-control info"
                                    maxlength="100" autocomplete="off" value="<?php echo $af_nombre ?>" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Fecha Compra</label>
                                <input type="date" id="af_fechaCompra" name="af_fechaCompra" class="form-control info"
                                    value="<?php echo $af_fechaCompra ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Grupo Del Activo</label>
                                <input type="hidden" id="auxiliarCategoriaMod" name="auxiliarCategoriaMod"
                                    value="<?php echo $af_grupo ?>">
                                <select class="form-control info" id="af_categoria" name="af_categoria"
                                    value="<?php echo $af_grupo ?>" onchange="buscarCategoria2();" required>
                                    <option value=''>Seleccione Grupo Del Activo</option>

                                    <?php foreach ($listado_grupos as $grupos): ?>
                                        <?php if ($grupos['area_grupo'] == 32): ?>
                                            <option value="<?php echo $grupos['id_grupo']; ?>" class="administracion">
                                                <?php echo $grupos['nombre_grupo']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php foreach ($listado_grupos as $grupos): ?>
                                        <?php if ($grupos['area_grupo'] == 27): ?>
                                            <option value="<?php echo $grupos['id_grupo']; ?>" class="infraestructura">
                                                <?php echo $grupos['nombre_grupo']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-3">
                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control info" id="af_estado" name="af_estado" readonly>
                                    <option value="<?= $af_estado ?>">
                                        <?= $af_estado_descripcion ?>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Ubicación/Area</label>
                                <select class="form-control info" id="af_area" name="af_area"
                                    value="<?php echo $codigoArea ?>" readonly>

                                    <?php if ($codigoArea == 0) {
                                        echo
                                            "<option value='" . $codigoArea = "27" . "'>" . $nombreArea = "Infraestructura" . "</option>";
                                    } else {
                                        echo "<option value='" . $codigoArea . "'>" . $nombreArea . "    </option>";
                                    } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Ubicacion Activo</label>
                                <select class="form-control info" id="af_ubicacion" name="af_ubicacion" required>
                                    <?php if ($af_ubicacion == null): ?>
                                        <option value="" selected>Seleccione Estado</option>
                                        <option value="Trabajo en casa">Trabajo en casa</option>
                                        <option value="Activo de uso interno y externo">Activo de uso interno y externo
                                        </option>
                                        <option value="Oficina">otros</option>
                                    <?php else: ?>
                                        <option value='<?= $af_ubicacion ?>'><?= $af_ubicacion ?></option>
                                        <option value="Oficina">Oficina</option>
                                        <option value="Trabajo en casa">Trabajo en casa</option>
                                        <option value="Activo de uso interno y externo">Activo de uso interno y externo
                                        </option>";
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Area de Creacion</label>
                                <select class="form-control info" id="af_areaCreacion" name="af_areaCreacion" readonly>
                                    <option value="<?php echo $af_areaCreacion; ?>" selected>
                                        <?php echo $af_areaCreacion; ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="form-group">
                                <label>Funcionario Responsable</label>
                                <select class="form-control info" id="af_responsable" name="af_responsable"
                                    value="<?php echo $af_responsable ?>" readonly>
                                    <?php if ($identificacionResponsable == 0) {
                                        echo
                                            "<option value='" . $identificacionResponsable = "800042928" . "'>" . $nombreResponsable = "AREA INFRAESTRUCTURA" . "    </option>";
                                    } else {
                                        echo "<option value='" . $identificacionResponsable . "'>" . $nombreResponsable . "    </option>";
                                    } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Categoría</label>
                                <select class="form-control info" id="traCategoria" name="traCategoria"
                                    value="<?php echo $traCategoria ?>" required>
                                    <option value='' selected></option>
                                    <?php foreach ($listado_grupos as $grupos): ?>
                                        <?php if ($grupos['area_grupo'] == 32): ?>
                                            <option value="<?php echo $grupos['id_grupo']; ?>" class="administracion">
                                                <?php echo $grupos['nombre_grupo']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php foreach ($listado_grupos as $grupos): ?>
                                        <?php if ($grupos['area_grupo'] == 27): ?>
                                            <option value="<?php echo $grupos['id_grupo']; ?>" class="infraestructura">
                                                <?php echo $grupos['nombre_grupo']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Costo de compra</label>
                            <input type="text" id="costoCompra" name="costoCompra" class="form-control info" autocomplete="off" value="<?php echo $costoCompra ?>" readonly>
                        </div>
                    </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Tipo de activo</label>
                                <input type="text" class="form-control info" id="tipoAct" name="tipoAct"
                                    autocomplete="off" value="<?php echo $tipoAct ?>" required>
                                <input type="hidden" id="yearUvt">
                                <input type="hidden" id="valueUvt" name="valueUvt">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Vida útil</label>
                                <div class="input-group">
                                    <input type="text" id="vidaUtil" name="vidaUtil" class="form-control info"
                                        autocomplete="off" value="<?php echo $vidaUtil ?>" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">(meses)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label>Sede del activo</label>
                               <input type="text" id="sede" name="sede" class="form-control info" maxlength="100" autocomplete="off" value="<?php echo $sede?>"required>                                
                            </div>
                        </div>
                    </div> 
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Condición actual</label>
                                    <select class="form-control info" id="estadoAct" name="estadoAct" readonly>
                                        <option value="<?php echo $estadoAct; ?>" selected>
                                            <?php echo $estadoAct . " - " . $estados[$estadoAct]; ?></option>

                                        <?php
                                        foreach ($estados as $id => $texto) {
                                            if ($id != $estadoAct) {
                                                echo "<option value='$id'>$id - $texto</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                <label>Imagen del Activo</label><br>
                                <?php if ($af_imagenActivo != 'No aplica') { ?>

                                    <input type="hidden" id="imagenCa" name="imagenCa"
                                        value="<?php echo $af_imagenActivo; ?>">
                                    <a class="badge badge-light text" href="../../img/<?= $af_imagenActivo ?>"
                                        target="_blanck" id="imagen" name="imagen"
                                        style="text-decoration: underline; font-size: 15px;color: #bf1d1d;">
                                        Imagen
                                    </a>
                                <?php } else { ?>
                                    <input type="hidden" id="imagenCa" name="imagenCa" value="2">
                                <?php } ?>
                                </div>    
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div>
                                        <label>Cargar Imagen del activo</label>
                                    </div>
                                    <div>
                                        <input type="file" id="af_imagen1" name="af_imagen1">
                                    </div>
                                    <label class="mt-2" id="textImg" style="min-width:150%"></label>
                                </div>
                            </div>
                        </div>
                        <div id="datos_adicionales">
                            <div class="row">
                                <div class="col-9 mt-4">
                                    <div class="form-group">
                                        <label>
                                            <h5> Datos Hardware </h5>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Ram</label>
                                        <input type="text" id="af_ram" name="af_ram" class="form-control info"
                                            value="<?php echo $af_ram ?>">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Disco Duro</label>
                                        <input type="text" id="af_discoDuro" name="af_discoDuro"
                                            class="form-control info" value="<?php echo $af_discoDuro ?>">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Procesador</label>
                                        <input type="text" id="af_procesador" name="af_procesador"
                                            class="form-control info" value="<?php echo $af_procesador ?>">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Hostname</label>
                                        <input type="text" id="hostName" name="hostName"
                                            class="form-control info" value="<?php echo $hostName ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-9 mt-4">
                                    <div class="form-group">
                                        <label>
                                            <h5>Datos Software</h5>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Sistema Operativo</label>
                                        <input type="text" id="af_so" name="af_so" class="form-control info"
                                            value="<?php echo $af_so ?>">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Licencia Sistema Operativo</label>
                                        <input type="text" id="af_licenciaSo" name="af_licenciaSo"
                                            class="form-control info" value="<?php echo $af_licenciaSo ?>">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Dominio</label>
                                        <input type="text" id="af_dominio" name="af_dominio" class="form-control info"
                                            value="<?php echo $af_dominio ?>">
                                    </div>
                                </div>

                                <div class="col-9">
                                    <div class="form-group">
                                        <label>Aplicaciones Instaladas</label>
                                        <input type="text" id="af_aplicaciones" name="af_aplicaciones"
                                            class="form-control info" value="<?php echo $af_aplicaciones ?>"
                                            name="af_aplicaciones">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Licencia Office</label>
                                        <input type="text" id="af_office" name="af_office" class="form-control info"
                                            value="<?php echo $af_office ?>">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Licencia Antivirus</label>
                                        <input type="text" id="af_antivirus" name="af_antivirus"
                                            class="form-control info" value="<?php echo $af_antivirus ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Observaciones</label>
                                    <textarea name="af_observaciones" id="af_observaciones" cols="134" rows="5"
                                        required><?php echo $af_observaciones ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <input type="hidden" id="nombre_usu" name="nombre_usu"
                                    value="<?php echo $_SESSION['usuario'] ?>">
                                <input type="button" value="Modificar Activo" id="guardar_modificaciones"
                                    name="guardar_modificaciones" class="mt-4 btn btn-primary btn-sm btn-guardar">
                            </div>
                            <div class="col-4">
                                <a id="cerrar_modActivos" class="mt-4 btn btn-danger" style="height:30px;">Cancelar</a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>
    <script src="../../public/js/filtroActivos.js"></script>
    <script src="../../public/js/close.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    <script src="../../public/js/modificarActivo.js"></script>
    <script src="../../public/js/valida_imgenModifica.js"></script>
    <script src="../../public/js/buscarCategoria.js"></script>

</body>

</html>