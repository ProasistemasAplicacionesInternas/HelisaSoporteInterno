<?php 
//************************************************************************************//
//********************* FORMULARIO PARA LA CREACION DE FUNCIONARIOS ******************//
//************************************************************************************//
        ini_set("session.cookie_lifetime",18000);
        ini_set("session.gc_maxlifetime",18000);
        session_start();
        require('../controller/controlador_activosFijos.php');
        require('../controller/controlador_gruposActivos.php');
        require('../controller/controlador_areas.php');
        require('../controller/controlador_funcionarios.php');
        
        require_once('../model/crud_peticiones.php');
        require_once('../model/crud_mantenimientos.php');
        require_once('../model/crud_traslados.php');
        
        require_once('../model/datos_peticion.php');
        require_once('../model/datos_mantenimientos.php');
        require_once('../model/datos_traslados.php');

    

    if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
     }
        $af_idActivo=$_POST['af_id'];
        $af_codigo=$_POST['af_codigo'];
        $af_serial=$_POST['af_serial'];
        $af_marca=$_POST['af_marca'];
        $af_modelo=$_POST['af_modelo'];
        $af_nombre=$_POST['af_nombre'];
        $af_fechaCompra=$_POST['af_fechaCompra'];
        $af_grupo=$_POST['af_categoria'];
        $af_estado=$_POST['af_estado'];
        $af_ubicacion=$_POST['af_area'];
        $af_responsable=$_POST['af_responsable'];    
        $af_fechaAsignacion=$_POST['af_fechaAsignacion'];
        $af_observaciones=$_POST['af_observaciones'];
        //-----------------------------------------------------
        $af_ram=$_POST['af_ram'];
        $af_discoDuro=$_POST['af_discoDuro'];
        $af_procesador=$_POST['af_procesador'];
        $af_so=$_POST['af_so'];
        $af_licenciaSo=$_POST['af_licenciaSo'];
        $af_dominio=$_POST['af_dominio'];
        $af_aplicaciones=$_POST['af_aplicaciones'];
        $af_office=$_POST['af_office'];
        $af_antivirus=$_POST['af_antivirus'];
        $af_areaCreacion = $_POST['af_areaCreacion'];

        

        $consultar = new crudActivos();
        
        $consultaPeticiones=$consultar->peticionesActivo();
        $consultaMantenimientos=$consultar->mantenimientosActivo();
        $consultaTraslados=$consultar->trasladosActivo();

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
    <link rel="stylesheet" type="text/css" href="../../public/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../../public/css/buttons.dataTables.min.css" media="screen">
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
            <h6 class="mt-3">Control De Actividades</h6>
        </div>
            <div class="col-12 ml-5">
                <form action="../controller/controlador_activosFijos.php" method="post" class="form-group">
                    
                    <div class="row">
                        <div class="col-1">
                            <div class="form-group">
                                <label>Id Activo</label>
                                <input type="text" id="af_id" name="af_id" class="form-control info" maxlength="25" autocomplete="off" value="<?php echo $af_idActivo?>" readonly>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Código De Activo</label>
                                <input type="text" id="af_codigo" name="af_codigo" class="form-control info" maxlength="25" autocomplete="off" value="<?php echo $af_codigo?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Serial</label>
                                <input type="text" id="af_serial" name="af_serial" class="form-control info" maxlength="260" autocomplete="off" value="<?php echo $af_serial?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" id="af_marca" name="af_marca" class="form-control info" maxlength="6" autocomplete="off" value="<?php echo $af_marca?>" readonly>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input type="text" id="af_modelo" name="af_modelo" class="form-control info" maxlength="6" autocomplete="off" value="<?php echo $af_modelo?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="af_nombre" name="af_nombre" class="form-control info" maxlength="100" autocomplete="off" value="<?php echo $af_nombre?>" readonly>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Fecha Compra</label>
                                <input type="date" id="af_fechaCompra" name="af_fechaCompra" class="form-control info" value="<?php echo $af_fechaCompra ?>" readonly>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Grupo Del Activo</label>
                                <select class="form-control info" id="af_categoria" name="af_categoria" value="<?php echo $af_grupo?>" readonly>
                                    <?php if($codigoGrupo==0){ echo 
                                        "<option value='' selected>Seleccione un grupo</option>";
                                    }else{
                                        echo "<option value='" . $codigoGrupo. "'>". $nombreGrupo. "    </option>";}?>
                                    }?>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <label>Area creacion</label>
                                <input type="text" id="af_despartamento" name="af_departamento" class="form-control info" maxlength="100" autocomplete="off" value="<?php echo $af_areaCreacion?>" readonly>
                            </div>
                        </div>
                        
                        <div class="col-2">
                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control info" id="af_estado" name="af_estado" value="<?php echo $af_estado?>" readonly>
                                    <?php if($codigoEstado==14){ echo 
                                        '<option value="14">Asignado</option>';
                                    }else if($codigoEstado==15){
                                        echo '
                                        <option value="15">Disponible</option>';
                                    } else if($codigoEstado==11){
                                         echo '
                                        <option value="11">Dado de Baja</option>';
                                    }?>                                                                  
                                </select>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <label>Ubicación/Área</label>
                                <select class="form-control info" id="af_area" name="af_area"readonly>
                                    <?php if($codigoArea==0){ echo 
                                        "<option value='" . $codigoArea="18" . "'>". $nombreArea="Tecnologia" . "</option>";
                                    }else{
                                        echo "<option value='" . $codigoArea . "'>". $nombreArea . "    </option>";}?>
                                    }?>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Funcionario Responsable</label>
                                <select class="form-control info" id="af_responsable" name="af_responsable" value="<?php echo $af_responsable?>" readonly>
                                    <?php if($identificacionResponsable==0){ echo 
                                        "<option value='" . $identificacionResponsable="800042928". "'>". $nombreResponsable="AREA INFRAESTRUCTURA". "    </option>";
                                    }else{
                                        echo "<option value='" . $identificacionResponsable. "'>". $nombreResponsable. "    </option>";}?>
                                    }?>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <label for="">Fecha Asignación</label>
                                <input type="date" id="af_fechaAsignacion" name="af_fechaAsignacion" class="form-control info" value="<?php echo $af_fechaAsignacion ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <span id="datos_adicionales">  
                    <div class="row">
                        <div class="col-9 mt-4">
                            <div class="form-group">
                                <label><h5 style="color:#5BB94B"> Datos Hardware <h5></label>
                            </div>
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Ram</label>
                                <input type="text" id="af_ram" name="af_ram" class="form-control info" value="<?php echo $af_ram ?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Disco Duro</label>
                                <input type="text" id="af_discoDuro" name="af_discoDuro" class="form-control info" value="<?php echo $af_discoDuro ?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Procesador</label>
                                <input type="text" id="af_procesador" name="af_procesador" class="form-control info" value="<?php echo $af_procesador ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-9 mt-4">
                            <div class="form-group">
                                <label><h5 style="color:#5BB94B">Datos Software<h5></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Sistema Operativo</label>
                                <input type="text" id="af_so" name="af_so" class="form-control info" value="<?php echo $af_so ?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Licencia Sistema Operativo</label>
                                <input type="text" id="af_licenciaSo" name="af_licenciaSo" class="form-control info" value="<?php echo $af_licenciaSo ?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Dominio</label>
                                <input type="text" id="af_dominio" name="af_dominio" class="form-control info" value="<?php echo $af_dominio ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="col-9">
                            <div class="form-group">
                                <label>Aplicaciones Instaladas</label>
                                <input type="text" id="af_aplicaciones" name="af_aplicaciones" class="form-control info" value="<?php echo $af_aplicaciones ?>" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Licencia Office</label>
                                <input type="text" id="af_office" name="af_office" class="form-control info" value="<?php echo $af_office ?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Licencia Antivirus</label>
                                <input type="text" id="af_antivirus" name="af_antivirus" class="form-control info" value="<?php echo $af_antivirus ?>" readonly>
                            </div>
                        </div>                            
                    </div>
                </span>
                    <div class="row">
                        <div class="col-3">
                                <div class="form-group">
                                    <label>Observaciones</label>
                                    <textarea name="af_observaciones" id="af_observaciones" cols="181" rows="4" disabled><?php echo $af_observaciones?></textarea>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
               

            <div class="row">
                    <div class="col-12 mt-4 pl-5">
                        <h3 style="color:#5BB94B">-------------------------------Soportes Realizados--------------------------------- </h3>
                    </div>
                
                <div class="col">
                    <table class="table table-bordered tablesorter" id="tabla1">
                        <thead>
                            <th>#</th>
                            <th>Fecha Soporte</th>
                            <th>Usuario</th>
                            <th>Descripción</th>
                            <!--<th>categoria</th>-->
                            <th>Estado</th>
                            <th>Fecha Atendido</th>
                            <th>Usuario Atendio</th>
                            <th>Conclusiones</th>
                            <!--<th>Imagen</th>-->
                        </thead>

                        <tbody>
                            <?php foreach($consultaPeticiones as $datos1): ?>
                            <tr>
                                <td>
                                    <?php echo $datos1->getP_nropeticion(); ?></td>
                                <td>
                                    <?php echo $datos1->getP_fechapeticion(); ?></td>
                                <td>
                                    <?php echo $datos1->getP_usuario(); ?></td>
                                <td>
                                    <?php echo $datos1->getP_descripcion(); ?></td>
                                <!--<td>
                                    <?php echo $datos1->getP_categoria(); ?></td>-->
                                <td>
                                    <?php echo $datos1->getP_estado(); ?></td>
                                <td>
                                    <?php echo $datos1->getP_fechaatendido(); ?></td>
                                <td>
                                    <?php echo $datos1->getP_usuarioatiende(); ?></td>
                                <td>
                                    <?php echo $datos1->getP_conclusiones(); ?></td>
                                <!--<td>
                                    <span id="carta<?php echo $datos1->getP_nropeticion(); ?>"><span style="display:none"><?php echo $datos1->getP_cargarimagen();?></span></span><?php if ($datos1->getP_cargarimagen()!= '2'){ echo '<a class="btn btn-info" href="../../cartas/' . $datos1->getP_cargarimagen() . '" target="_blanck" id="imagen" name="imagen" ">Imagen</a>';} ?>
                                </td>-->
                                <?php 
                        endforeach;
                        ?>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                    <div class="col-11 mt-5 pl-5">
                        <h3 style="color:#5BB94B">----------------------------Mantenimientos Realizados---------------------------- </h3>
                    </div>
                
                <div class="col">
                    <table class="table table-bordered tablesorter" id="tabla2">
                        <thead>
                            <th>#</th>
                            <th>Fecha Mantenimiento</th>
                            <th>Descripcion Mantenimiento</th>
                            <th>Responsable</th>
                            <th>Costo</th>
                        </thead>

                        <tbody>
                            <?php foreach($consultaMantenimientos as $datos2): ?>
                            <tr>
                                <td>
                                    <?php echo $datos2->getCodigo_mantenimiento(); ?></td>
                                <td>
                                    <?php echo $datos2->getFecha_mantenimiento(); ?></td>
                                <td>
                                    <?php echo $datos2->getDescripcion_mantenimiento(); ?></td>
                                <td>
                                    <?php echo $datos2->getResponsable_mantenimiento(); ?></td>
                                <td>
                                    <?php echo $datos2->getCosto_mantenimiento(); ?></td> 
                                
                                <?php 
                        endforeach;
                        ?>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                    <div class="col-11 mt-5 pl-5">
                        <h3 style="color:#5BB94B">-------------------------------Traslados Realizados-------------------------------- </h3>
                    </div>
                
                <div class="col">
                    <table class="table table-bordered tablesorter" id="tabla3">
                        <thead>
                            <th>#</th>
                            <th>Funcionario Origen</th>
                            <th>Fecha Asignación</th>
                            <th>Funcionario Destino</th>
                            <th>Fecha Traslado</th>
                            <th>Descripción Traslado</th>
                        </thead>

                        <tbody>
                            <?php foreach($consultaTraslados as $datos2): ?>
                            <tr>
                                <td>
                                    <?php echo $datos2->getId_traslado(); ?></td>
                                <td>
                                    <?php echo $datos2->getFuncionario_inicial(); ?></td>
                                <td>
                                    <?php echo $datos2->getFecha_inicial(); ?></td>
                                <td>
                                    <?php echo $datos2->getFuncionario_final(); ?></td>
                                <td>
                                    <?php echo $datos2->getFecha_traslado(); ?></td>
                                <td>
                                    <?php echo $datos2->getDescripcion_traslado(); ?></td>
                                
                                <?php 
                        endforeach;
                        ?>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>
    <script src="../../public/js/datatables.min.js"></script>
    <script src="../../public/js/tablas.js"></script>
    <script src="../../public/js/filtroActivos.js"></script>
    <script src="../../public/js/tablas_control_actividades.js"></script>
    <script src="../../public/js/jszip.min.js"></script>   
    <script src="../../public/js/bloqueoTeclas.js"></script>
</body>
</html>