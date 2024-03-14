<?php
//*************************************************************************************//
//********************* FORMULARIO PARA LA CREACION DE FUNCIONARIOS *******************//
//*************************************************************************************//

ini_set("session.cookie_lifetime", 18000);
ini_set("session.gc_maxlifetime", 18000);
session_start();

if (!isset($_SESSION['usuario'])) {

    header('location:../../login.php');
}
$af_id = $_POST['af_idA'];
$af_codigo = $_POST['af_codigoA'];
$af_serial = $_POST['af_serialA'];
$af_ram = $_POST['af_ram'];
$af_discoDuro = $_POST['af_discoDuro'];
$af_procesador = $_POST['af_procesador'];
$af_so = $_POST['af_so'];
$af_licenciado = $_POST['af_licenciaSo'];
$af_categoria = $_POST['af_categoria'];

require('../controller/controlador_funcionarios.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="../../public/css/verObservacionesAnteriores.css">
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
            <h6 class="mt-3">Generar Mantenimiento</h6>
            <div class="col-12 ml-5">
                <input type="text" id="m_grupoActivo" name="m_grupoActivo" class="form-control info" autocomplete="off"
                    value="<?php echo $af_categoria ?>" style="display:none ;" readonly>
                <form action="../controller/controlador_mantenimientos.php" method="post" enctype="multipart/form-data"
                    class="form-group">
                    <div class="row">
                        <div class="col-1">
                            <div class="form-group">
                                <label>Id Activo</label>
                                <input type="text" id="m_idActivo" name="m_idActivo" class="form-control info"
                                    autocomplete="off" value="<?php echo $af_id ?>" readonly>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Código Activo</label>
                                <input type="text" id="m_codigo" name="m_codigo" class="form-control info"
                                    maxlength="10" autocomplete="off" value="<?php echo $af_codigo ?>" readonly>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Serial Activo</label>
                                <input type="text" id="m_serial" name="m_serial" class="form-control info"
                                    maxlength="10" autocomplete="off" value="<?php echo $af_serial ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Fecha Mantenimiento</label>
                                <input type="date" id="m_fecha" name="m_fecha" class="form-control info" value=""
                                    required>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <label>Costo Mantenimiento</label>
                                <input type="text" id="m_costo" name="m_costo" class="form-control info" maxlength="10"
                                    autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group" id="repoweringButton" style="display: none;">
                            <label for="repotentiationSelect">Repotenciación</label>
                            <select class="form-control" id="repotentiationSelect" name="repotentiationSelect">
                                <option value="Si">Si</option>
                                <option value="No" selected="selected">No</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-left: 15px;">
                            <label>Se genera mejora</label>
                            <select class="form-control" id="mejora" name="mejora" onchange="mostrarCampo()">
                                <option value="Si">Si</option>
                                <option value="No" selected="selected">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row col-3">
                        <div class="form-group" id="campoMejora" style="display: none;">
                            <label>Costo Mejora</label>
                            <input type="text" class="form-control" id="costoMejora" name="costoMejora">
                        </div>
                    </div>

                    <div class="row col-8">
                        <div class="form-group ">
                            <label>Condición actual</label>
                            <select class="form-control " id="estadoAct" name="estadoAct" required>
                                <option value='' selected>Seleccione estado</option>
                                <option value='5'> 5 - Nuevo - Activos adquiridos menores a 1 año</option>
                                <option value='4'> 4 - Bueno - Activos aquiridos mayores a 1 año</option>
                                <option value='3'> 3 - Regular - Activos en uso que prseentan alguna</option>
                                <option value='2'> 2 - Malo - activos con una falla sustancial que no permite el
                                    correcto funcionamiento</option>
                                <option value='1'> 1 - Dado de baja - activos retirados por obsolencia o por condiciones
                                    que no permiten el correcto funcionamiento</option>
                            </select>
                        </div>
                    </div>

                    <div id="datos_adicionales" style="display: none;">
                        <div class="row">
                            <div class="col-12 mt-4">
                                <div class="form-group">
                                    <label>
                                        <h5> Datos Hardware </h5>
                                    </label>
                                </div>
                            </div>

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
                                    <input type="text" id="af_discoDuro" name="af_discoDuro" class="form-control info"
                                        value="<?php echo $af_discoDuro ?>">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Procesador</label>
                                    <input type="text" id="af_procesador" name="af_procesador" class="form-control info"
                                        value="<?php echo $af_procesador ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-4">
                                <div class="form-group">
                                    <label>
                                        <h5>Datos Software</h5>
                                    </label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>Sistema Operativo</label>
                                    <input type="text" id="af_so" name="af_so" class="form-control info"
                                        value="<?php echo $af_so ?>">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Licencia sistema opertaivo</label>
                                    <input type="text" id="af_licenciado" name="af_licenciado" class="form-control info"
                                        value="<?php echo $af_licenciado ?>">
                                </div>
                            </div>
                        </div><br>
                    </div>
                    <a href="#" id="verObservaciones" onclick="abrirModal()" style="margin-left: -1px;">Ver observaciones anteriores</a><br>
                    <div id="modal" class="modal">
                        <div class="modal-content">
                            <h2 >Observaciones anteriores</h2>
                            <hr class="lineas" style="border: 1px soli  d black;">
                            <p>Aquí va el contenido de las observaciones anteriores...</p>
                            <button onclick="cerrarModal()" class="btn btn-primary">Cerrar</button>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="m_descripcion" id="m_descripcion" cols="133" rows="5"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Documentos</label>
                                <input type="file" id=fileInput accept=".pdf" name="uploadedFile">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <input type="submit" value="Ingresar Mantenimiento" id="crear_mantenimiento"
                                name="crear_mantenimiento" class="mt-4 btn btn-primary btn-sm btn-guardar">
                        </div>
                        <div class="col-4">
                            <a href="../../dashboard.php" class="mt-4 btn btn-danger" style="height:30px" ;>Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="../../public/js/jquery-3.3.1.min.js"></script>
        <script src="../../public/js/mantenimientoActivos.js"></script>
        <script src="../../public/js/popper.js"></script>
        <script src="../../public/js/verObservacionesAnt.js"></script>
        <script src="../../public/js/bootstrap.min.js"></script>
        <script src="../../public/js/smoke.min.js"></script>
        <script src="../../public/js/es.min.js"></script>
        <script src="../../public/js/ocultar.js"></script>
        <script src="../../public/js/bloqueoTeclas.js"></script>
        <script src="../../public/js/validaPdfManteninmiento.js"></script>

</body>
</html>