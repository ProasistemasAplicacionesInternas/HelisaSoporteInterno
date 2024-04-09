<?php 
header('Cache-Control: no cache'); //duplicidad pantalla
session_cache_limiter('private_no_expire');//
ini_set("session.cookie_lifetime",18000);
ini_set("session.gc_maxlifetime",18000);
    
    session_start();

    if(!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])){
    
    header('location:../../login.php');
    }
    
    require_once('../controller/controlador_peticionesAccesos.php');
    require_once('../controller/controlador_plataformas.php');
    require_once('../controller/controladorAccesosFuncionario.php');
    $peticion=$_POST['id_peticion']; 
    $usuario_creacion=$_POST['usuario_creacion'];
    $fecha_creacion=$_POST['fecha_creacion'];
    $descripcion=$_POST['descripcion'];
    $tipo = $_POST['tipo'];
    $conclusiones=$_POST['conclusiones'];
    $platarformasArreglo = explode (',', $plataformasPeticion);
    $numElement  = count($platarformasArreglo);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/buttons.dataTables.min.css" media="screen">
    <link rel="stylesheet" href="../../public/css/peticionAcceso.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/v4-shims.css">
</head>

<body>
    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/Logo_blanco.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 pl-3">
                <h6>Atendiendo Solicitud Accesos</h6>
            </div>
            <div class="col-6 ml-8">
                <div class="form-group">
                    <form action="../controller/controlador_peticionesAccesos.php" class="form-group mt-3"
                        method="POST">
                        <div class="col-12">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label>id Solicitud</label>
                                    <input type="text" id="id_peticion" name="id_peticion" class="form-control"
                                        value="<?php echo $peticion;?>" readonly>
                                </div>

                                <div class="col-4">
                                    <label>Fecha Solicitud</label>
                                    <input type="text" id="fecha_creacion" name="fecha_creacion" class="form-control"
                                        value="<?php echo  $fecha_creacion;?>" readonly>
                                </div>

                                <div class="col-4">
                                    <label>Fecha registro usuario</label>
                                    <input type="text" id="fecha_registro" name="fecha_registro" class="form-control"
                                        value="<?php echo $f_fechaRegistro;?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label>Usuario </label>
                                    <input type="text" id="usuario_creacion" name="usuario_creacion"
                                        class="form-control" value="<?php echo  $usuario_creacion;?>" readonly>
                                </div>
                                <div class="col-5">
                                    <label>Nombre</label>
                                    <input type="text" id="p_nombre" name="p_nombre" class="form-control"
                                        value="<?php echo $f_nombre;?>" title="<?=$f_nombre?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-7">
                                    <label>Correo Coorporativo</label>
                                    <input type="text" id="p_correo" name="p_correo" class="form-control"
                                        value="<?php echo $f_correo;?>" title="<?=$f_correo?>" readonly>
                                </div>

                                <div class="col-4">
                                    <label>Identificación</label>
                                    <input type="text" id="p_identificacion" name="p_identificacion" class="form-control"
                                        value="<?php echo $f_identificacion;?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-11">
                                    <label>Correo Personal</label>
                                    <input type="text" id="p_correo2" name="p_correo2" class="form-control"
                                        value="<?php echo $f_correo2;?>" title="<?=$f_correo?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="">Descripción</label>
                                    <textarea id="descripcion" name="descripcion" class="form-control col-11 data"
                                        readonly><?php echo $descripcion;?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div>
                                        <label for="">Observaciones</label>
                                    </div>
                                    <textarea name="conclusiones" id="conclusiones" class="form-control col-11 data"
                                        readonly><?=strip_tags($conclusiones,'<br/>')?></textarea>
                                </div>
                                <div class="col-5">
                                    <label>Tipo</label>
                                    <input type="hidden" name="tipo" value="<?php echo $tipo ?>">
                                    <input type="text" class="form-control col-11 data" value="<?php 
                                switch($tipo){
                                    case 0:echo "Modificación";break;
                                    case 1:echo "Activación";break;
                                    case 2:echo "Inactivación";break;
                                    case 3:echo "Novedades";break;
                                    case 4:echo "Reactivación";break;
                                    Default:echo "Modificación";}?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <div>
                                        <label for="">Conclusiones</label>
                                    </div>
                                    <textarea name="conclusionesAdd" id="conclusionesAdd"
                                        class="form-control col-11 data" placeholder="Campo No Obligatorio"></textarea>
                                </div>
                            </div>


                            <?php if($tipo == 1):?>
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label>Accesos</label>
                                        <div class="row">
                                            <span class="col-4 mt-2"><b>Plataforma</b></span>
                                            <span class="col-3 mt-2"><b>Nombre Usuario</b></span>
                                            <span class="col-3 mt-2"><b>Contrase&ntilde;a</b></span>
                                            <span class="col-2 mt-2"><b>Estado</b></span>
                                        </div>

                                        <div>
                                            <?php 
                                            $numeracion=0;
                                            foreach($plataformas as $listado):
                                                for($x=0; $x<$numElement;$x++):
                                                    if(($listado['estado'] == 5) && ($platarformasArreglo[$x] == $listado['id_plataforma']) && (($listado['admin_usuario'] == $_SESSION['usuario']) || ($consultaMai == 1))):?>
                                            <div class="row mt-2">
                                                <div class="col-4 sm-4">
                                                    <input type="hidden" class="form-control"
                                                        name="plataforma<?php echo $numeracion;?>"
                                                        value="<?php echo $listado['id_plataforma'];?>">
                                                    <input type="text" title="<?=$listado['descripcion'];?>"
                                                        class="form-control"
                                                        value="<?php echo $listado['descripcion'];?>" readonly>
                                                </div>
                                                <div class="col-3 sm-2">
                                                    <input type="text" class="form-control" autocomplete="off"
                                                        id="nombre_usuario<?php echo $numeracion;?>"
                                                        name="nombre_usuario<?php echo $numeracion;?>"
                                                        placeholder="Nombre" required>
                                                </div>
                                                <div class="col-3 sm-2">
                                                    <input type="text" class="form-control"
                                                        id="clave<?php echo $numeracion;?>"
                                                        name="clave<?php echo $numeracion;?>" placeholder="Password"
                                                        required>
                                                </div>
                                                <div class="col-2 sm-3">
                                                    <select style="height:31px;" class="form-control"
                                                        id="estado<?php echo $numeracion;?>"
                                                        name="estado<?php echo $numeracion;?>"
                                                        onchange="aprobacionPlataformas('<?php echo $numeracion;?>');">
                                                        <option value='12'>Aprobado</option>
                                                        <option value='13'>No aprobado</option>
                                                        <option value='3'>Pendiente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php $numeracion++;
                                                endif;
                                            endfor;
                                            
                                            endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>



                            <?php if($tipo == 2):?>
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label>Accesos</label>
                                        <div class="row">
                                            <span class="col-4 mt-2"><b>Tipo Acceso</b></span>
                                            <span class="col-3 mt-2"><b>Nombre Usuario</b></span>
                                            <span class="col-3 mt-2"><b>Estado</b></span>
                                        </div>

                                        <div>
                                            <?php $numeracion =0; foreach($accesosPlataformasxUsuario as $listado):?>
                                            <?php for($x=0; $x<$numElement; $x++):?>
                                            <?php if(($listado->getPlataformaAdministrador() == $_SESSION['usuario'] || $consultaMai == 1) && ($platarformasArreglo[$x] == $listado->getPlataforma())):?>
                                            <div class="row mt-3">
                                                <div class="col-sm-4">
                                                    <input type="hidden" name="plataforma<?php echo $numeracion;?>"
                                                        value="<?php echo $listado->getPlataforma();?>">
                                                    <input type="hidden"
                                                        name="accesoPlataforma<?php echo $numeracion;?>"
                                                        value="<?php echo $listado->getid_accesoPlataforma();?>">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $listado->getPlataformaDescripcion();?>"
                                                        readonly>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control"
                                                        name="nombre_usuario<?php echo $numeracion;?>"
                                                        value="<?php echo $listado->getUsuario();?>" readonly required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control" name="estado<?php echo $numeracion;?>">
                                                        <option value='12'>Aprobado</option>
                                                        <option value='13'>No aprobado</option>
                                                        <option value='3' style='display:none'>Pendiente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php $numeracion++;
                                                endif;
                                                endfor;?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php if($tipo == 3):?>
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label>Accesos</label>
                                        <div class="row">
                                            <span class="col-4 mt-2"><b>Tipo Acceso</b></span>
                                            <span class="col-3 mt-2"><b>Nombre Usuario</b></span>
                                            <span class="col-3 mt-2"><b>Estado</b></span>
                                        </div>

                                        <div>
                                            <?php $numeracion =0; foreach($accesosPlataformasxUsuario as $listado):?>
                                            <?php for($x=0; $x<$numElement; $x++):?>
                                            <?php if(($listado->getPlataformaAdministrador() == $_SESSION['usuario'] || $consultaMai == 1) && ($platarformasArreglo[$x] == $listado->getPlataforma())):?>
                                            <div class="row mt-3">
                                                <div class="col-sm-4">
                                                    <input type="hidden" name="plataforma<?php echo $numeracion;?>"
                                                        value="<?php echo $listado->getPlataforma();?>">
                                                    <input type="hidden"
                                                        name="accesoPlataforma<?php echo $numeracion;?>"
                                                        value="<?php echo $listado->getid_accesoPlataforma();?>">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $listado->getPlataformaDescripcion();?>"
                                                        readonly>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control"
                                                        name="nombre_usuario<?php echo $numeracion;?>"
                                                        value="<?php echo $listado->getUsuario();?>" readonly required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control" name="estado<?php echo $numeracion;?>">
                                                        <option value='12'>Aprobado</option>
                                                        <option value='13'>No aprobado</option>
                                                        <option value='3' style='display:none'>Pendiente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php $numeracion++;
                                                endif;
                                                endfor;?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php if($tipo == 4):?>
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label>Accesos</label>
                                        <div class="row">
                                            <span class="col-4 mt-2"><b>Plataforma</b></span>
                                            <span class="col-2 mt-2"><b>Nombre Usuario</b></span>
                                            <span class="col-2 mt-2"><b>Estado</b></span>
                                        </div>
                                        <div>
                                            <?php $numeracion =0; foreach($accesosPlataformasxUsuarioInactivo as $listado):?>
                                            <?php for($x=0; $x<$numElement; $x++):?>
                                            <?php if(($listado->getPlataformaAdministrador() == $_SESSION['usuario'] || $consultaMai == 1) && ($platarformasArreglo[$x] == $listado->getPlataforma())):?>
                                            <div class="row mt-3">
                                                <div class="col-sm-4">
                                                    <input type="hidden" name="plataforma<?php echo $numeracion;?>"
                                                        value="<?php echo $listado->getPlataforma();?>">
                                                    <input type="hidden"
                                                        name="accesoPlataforma<?php echo $numeracion;?>"
                                                        value="<?php echo $listado->getid_accesoPlataforma();?>">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $listado->getPlataformaDescripcion();?>"
                                                        readonly>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control"
                                                    name="nombre_usuario<?php echo $numeracion;?>"
                                                    value="<?php echo $listado->getUsuario();?>" readonly required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control" name="estado<?php echo $numeracion;?>">
                                                        <option value='12'>Aprobado</option>
                                                        <option value='13'>No aprobado</option>
                                                        <option value='3' style='display:none'>Pendiente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php $numeracion++;
                                                endif;
                                                endfor;?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>



                            <div class="row">
                                <div class="col-6">
                                    <input type="hidden" value="<?php echo $plataformasPeticion;?>"
                                        name="plataformasPeticion">
                                    <input type="hidden" value="<?php echo $numeracion;?>" name="numeracion">
                                    <input type="hidden" value="<?php echo $f_identificacion;?>" id="f_identificacion"
                                        name="f_identificacion">
                                    <input type="submit" value="Guardar" name="guardarInserciones"
                                        class="btn btn-primary mt-3">
                                    <input class="btn btn-danger mt-3" style="max-width:90px;" value="Liberar"
                                        onclick="liberarPeticion(<?php echo $peticion;?>);">
                                </div>
                            </div>


                        </div>
                    </form>

                </div>
            </div>
            <div class="container-fluid col-6">
                <div class="" class="dataConsulta">
                    <div class="">
                        <table id="tabla" class="table table-striped  " style="width:100%; text-align:center;">
                            <thead style="background-color: #d9007f; color:white;">
                                <tr>
                                    <th>Usuarios</th>
                                    <th>Plataforma</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($consultarPlataformasActivas as $datos){ ?>
                                <tr>
                                    <th style="font-weight:normal"><?php echo $datos->getUsuario(); ?></th>
                                    <th style="font-weight:normal"><?php echo $datos->getPlataforma(); ?></th>
                                    <th style="font-weight:normal"><?php echo $datos->getFecha_registro(); ?></th>
                                </tr>
                                <?php }?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/datatables.min.js"></script>
    <script src="../../public/js/dataTables.buttons.min.js"></script>
    <script src="../../public/js/buttons.flash.min.js"></script>
    <script src="../../public/js/jszip.min.js"></script>
    <script src="../../public/js/pdfmake.min.js"></script>
    <script src="../../public/js/vfs_fonts.js"></script>
    <script src="../../public/js/buttons.html5.min.js"></script>
    <script src="../../public/js/buttons.print.min.js"></script>
    <script src="../../public/js/tablaPlataformas.js"></script>
    <script src="../../public/js/moment.min.js"></script>
    <script src="../../public/js/daterangepicker.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/peticionesAccesosInsercion.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
</body>

</html>