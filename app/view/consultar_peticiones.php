<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es"> 
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />

</head>
<body>
    <?php
    ini_set("session.cookie_lifetime","18000");
    ini_set("session.gc_maxlifetime","18000");

    session_start();
   
        if(!isset($_SESSION['usuario'])|| empty($_SESSION['usuario'])){
       
       header('location:../../login.php');
   }

        require('../model/crud_peticiones.php');
        require('../model/datos_peticion.php');

        $crud = new CrudPeticiones();
        $datos1 = new Peticion();

        $consultaPeticiones=$crud->consultarPeticiones();

    ?>
    <div class="container-fluid" id="infos3" name="infos3">
            <div class="row">
                <div class="col-11 mt-4 pl-5">
                    <h6>Solicitudes</h6>
                </div>


                <div class="col">

                    <table class="table table-striped">
                        <thead>
                            <th>Nro Ticket</th>
                            <th>Usuario</th>
                            <th>Area</th>
                            <th>Extension</th>
                            <th>categoria</th>
                            <th>Estado</th>
                            <th>Conclusiones</th>                           
                            <th>Modificar</th>
                            
                        </thead>

                        <tbody>

                            <?php foreach($consultaPeticiones as $datos1): ?>
                            <tr>

                                <td>
                                    <?php echo $datos1->getP_nropeticion(); ?>
                                </td>
                                <td>
                                    <?php echo $datos1->getP_usuario(); ?>
                                </td>
                                <td>
                                    <?php echo $datos1->getP_area(); ?>
                                </td>
                                <td>
                                    <?php echo $datos1->getP_Extension(); ?>
                                </td>
                                <td>
                                    <?php echo $datos1->getP_categoria(); ?>
                                </td>                             
                                <td>
                                    <?php echo $datos1->getP_estado(); ?>
                                </td>
                                <td>
                                    <?= html_entity_decode($datos1->getP_conclusiones()); ?>
                                </td>
                               
                                <td>
                                    <form action="app/view/seleccionar_peticion.php" method="post">
                                        <input type="hidden" name="p_nropeticion" id="p_nropeticion" value="<?php echo $datos1->getP_nropeticion();?>">

                                        <input type="hidden" name="p_fechapeticion" id="p_fechapeticion" value="<?php echo $datos1->getP_fechapeticion();?>">

                                        <input type="hidden" name="p_usuario" id="p_usuario" value="<?php echo $datos1->getP_usuario();?>">

                                        <input type="hidden" name="p_extension" id="p_extension" value="<?php echo $datos1->getP_extension();?>">

                                        <input type="hidden" name="p_correo" id="p_correo" value="<?php echo $datos1->getP_correo(); ?>">

                                        <input type="hidden" name="p_categoria" id="p_categoria" value="<?php echo $datos1->getP_categoria()?>">

                                        <input type="hidden" name="p_activo" id="p_activo" value="<?php echo $datos1->getP_activo()?>">

                                        <input type="hidden" name="p_codigoactivo" id="p_codigoactivo" value="<?php echo $datos1->getP_codigoactivo(); ?>">

                                        <input type="hidden" name="p_descripcion" id="p_descripcion" value="<?php echo $datos1->getP_descripcion(); ?>" >

                                        <input type="hidden" name="p_cargarimagen" id="p_cargarimagen" value="<?php echo $datos1->getP_cargarimagen(); ?>">
                                        
                                        <input type="hidden" name="p_cargarimagen2" id="p_cargarimagen2" value="<?php echo $datos1->getP_cargarimagen2(); ?>">
                                        
                                        <input type="hidden" name="p_cargarimagen3" id="p_cargarimagen3" value="<?php echo $datos1->getP_cargarimagen3(); ?>">

                                        <input type="hidden" name="p_estado" id="p_estado" value="<?php echo $datos1->getP_estado(); ?>">

                                        <input type="hidden" name="p_conclusiones" id="p_conclusiones" value="<?php echo $datos1->getP_conclusiones(); ?>">

                                        <input type="submit" value="Seleccionar" name="seleccionar" id="seleccionar" class="btn btn-info">
                                        
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
        <script src="../../public/js/bloqueoTeclas.js"></script>
</body>
</html>