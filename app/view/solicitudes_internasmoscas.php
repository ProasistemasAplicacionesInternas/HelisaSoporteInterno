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

        require('../model/crud_peticionesmai.php');
        require('../model/datos_peticionesmai.php');



        $crud = new CrudPeticionesMai();
        $datos1 = new PeticionMai();
       


        $consultaPeticiones=$crud->consultarPeticionesMai();
      

    ?>
    <div class="container-fluid" id="infosSolicitudesInternas" name="infosSolicitudesInternas">
            <div class="row">
                <div class="col-11 mt-4 pl-5">
                    <h6>Solicitudes Internas</h6>
                </div>


                <div class="col">

                    <table class="table table-striped">
                        <thead>
                            <th>Nro Ticket</th>
                            <th>Usuario</th>
                            <th>Fecha solicitud</th>
                            <th>Area</th>
                            <th>Extension</th>
                            <th>Producto</th>
                            <th>Atiende</th>
                            <th>Estado</th>
			                <th>Tipo de Peticion</th>
                            <th>Conclusiones</th>
                            <th>Tiempo</th>
                            <th>Modificar</th>
                            
                        </thead>

                        <tbody>

                            <?php foreach($consultaPeticiones as $datos1): ?>
                            <tr>
                                <?php 
                                    date_default_timezone_set('America/Bogota');
                                    $fecha1 = new DateTime($datos1->getFecha_peticionMai());
                                    $fecha2 = new DateTime('now');
                                    
                                    $intervalo = $fecha2->diff($fecha1);

                                    $varH = $intervalo->format('%H');
                                    $varD = $intervalo->format('%D');

                                    $color = $crud->coloresR($varD,$varH); 
                                ?>
                                <td style="background-color:<?=$color ?>;"> 
                                    <?php echo $datos1->getId_peticionMai(); ?>
                                </td>
                                <td style="background-color:<?=$color ?>;">
                                    <?php echo $datos1->getUsuario_creacionMai(); ?>
                                </td>
                                <td style="background-color:<?=$color ?>;">
                                    <?php echo $datos1->getFecha_peticionMai(); ?>
                                </td>
                                <td style="background-color:<?=$color ?>;">
                                    <?php echo $datos1->getArea_funcionario(); ?>
                                </td>
                                <td style="background-color:<?=$color ?>;">
                                    <?php echo $datos1->getExtension_funcionario(); ?>
                                </td>
                                <td style="background-color:<?=$color ?>;">
                                    <?php echo $datos1->getProducto_peticionMai(); ?>
                                </td>
                                <td style="background-color:<?=$color ?>;">
                                    <?php echo $datos1->getUsuario_atencionMai(); ?>
                                </td>                             
                                <td style="background-color:<?=$color ?>;">
                                    <?php echo $datos1->getEstado_peticionMai(); ?>
                                </td>
                                
                                <td style="background-color:<?=$color ?>;">
                                    <?php echo $datos1->getName(); ?>
                                </td>

                            

                                <td style="background-color:<?=$color ?>;">
                                    <?= html_entity_decode($datos1->getConclusiones_peticionMai()); ?>
                                </td>
                                <td style="background-color:<?=$color ?>;">
                                    <?php 
                                        date_default_timezone_set('America/Bogota');
                                        $fecha1 = new DateTime($datos1->getFecha_peticionMai());
                                        $fecha2 = new DateTime('now');

                                        $intervalo = $fecha2->diff($fecha1);
                                        echo $intervalo->format('%D:%H:%I:%S');
                                    ?>
                                </td>
                               
                                <td style="background-color:<?=$color ?>;">
                                    <form action="app/view/seleccionar_peticionmai.php" method="post">
                                        <input type="hidden" name="p_nropeticion" id="p_nropeticion" value="<?php echo $datos1->getId_peticionMai();?>">

                                        <input type="hidden" name="p_fechapeticion" id="p_fechapeticion" value="<?php echo $datos1->getFecha_peticionMai();?>">

                                        <input type="hidden" name="p_usuario" id="p_usuario" value="<?php echo $datos1->getUsuario_creacionMai();?>">

                                        <input type="hidden" name="p_extension" id="p_extension" value="<?php echo $datos1->getExtension_funcionario();?>">

                                        <input type="hidden" name="p_correo" id="p_correo" value="<?php echo $datos1->getEmail_funcionario(); ?>">

                                        <input type="hidden" name="p_categoria" id="p_categoria" value="<?php echo $datos1->getProducto_peticionMai()?>">

                                        <input type="hidden" name="p_descripcion" id="p_descripcion" value="<?php echo $datos1->getDescripcion_peticionMai(); ?>" >

                                        <input type="hidden" name="p_cargarimagen" id="p_cargarimagen" value="<?php echo $datos1->getImagen_peticionMai(); ?>">
                                        
                                        <input type="hidden" name="p_cargarimagen2" id="p_cargarimagen2" value="<?php echo $datos1->getImagen_peticionMai2(); ?>">
                                        
                                        <input type="hidden" name="p_cargarimagen3" id="p_cargarimagen3" value="<?php echo $datos1->getImagen_peticionMai3(); ?>">

                                        <input type="hidden" name="p_estado" id="p_estado" value="<?php echo $datos1->getEstado_peticionMai(); ?>">

                                        <input type="hidden" name="p_conclusiones" id="p_conclusiones" value="<?php echo $datos1->getConclusiones_peticionMai(); ?>">

                                        <input type="hidden" name="soporteMai" id="soporteMai" value="<?php echo $datos1->getName(); ?>">

                                        <input type="hidden" name="usuario_atencion" id="usuario_atencion" value=<?php echo $datos1->getUsuario_atencionMai(); ?>></input>

                                        <input type="submit" value="Seleccionar" name="seleccionar_peticionmai" id="seleccionar_peticionmai" class="btn btn-info">
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