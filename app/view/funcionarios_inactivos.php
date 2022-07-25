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
       ini_set("session.cookie_lifetime",18000);
       ini_set("session.gc_maxlifetime",18000);

       session_start();
   
       if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
       }
        
       
        require_once('../model/crud_funcionarios.php');
        require_once('../model/datos_funcionarios.php');
        $consultar= new CrudFuncionarios();
        $datos= new Funcionario();

        if(isset($_GET['val']) && ($_GET['val'] == 1)){
            $consultarFuncionariosInactivos=$consultar->consultarFuncionariosRetiro();
        }elseif(isset($_GET['val']) && ($_GET['val'] == 2)){
            $consultarFuncionariosInactivos=$consultar->consultarFuncionariosInactivosC();
        }else{
            $consultarFuncionariosInactivos=$consultar->consultarFuncionariosInactivos();/* trae ambos inactivos y retirados */
        }
        
        $datos->getF_estado(); 
              
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Funcionarios Inactivos</h6>
            </div>          
            <div class="col">
                    <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                            <th style="width:50px;">Nro identificaci&oacute;n</th>
                            <th>Nombre</th>
                            <th style="width:50px;">Email</th>
                            <th style="width:50px;">Area</th>
                            <th style="width:50px;">Cargo</th>
                            <th style="width:50px;">Extension</th>
                            <th style="width:50px;">Usuario</th>
                            <th style="width:50px;">Fecha</th>
                            <th style="width:50px;">Observacion</th>
                            <th style="width:50px;">Modificar</th>
                    </thead>
                    <?php foreach($consultarFuncionariosInactivos as $datos): ?>
                    <tr>
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
                            <?php echo $datos->getF_fecha_inactivacion() ?></td>
                        <td>
                            <?php echo $datos->getDescripcionFinal() ?></td>  
                        <td> 
                            <form action="app/view/modificar_funcionario_Inactivo.php" method="post" target="_blank">
                                <input type="hidden" name="f_identificacion" id="f_identificacion" value="<?php echo $datos->getF_identificacion();?>">   
                                <input type="hidden" name="f_nombre" id="f_nombre" value="<?php echo $datos->getF_nombre();?>"> 
                                <input type="hidden" name="f_email" id="f_email" value="<?php echo $datos->getF_email();?>"> 
                                <input type="hidden" name="f_area" id="f_area" value="<?php echo $datos->getF_area();?>"> 
                                <input type="hidden" name="f_cargo" id="f_cargo" value="<?php echo $datos->getF_cargo();?>"> 
                                <input type="hidden" name="f_extension" id="f_extension" value="<?php echo $datos->getF_extension();?>"> 
                                <input type="hidden" name="f_usuario" id="f_usuario" value="<?php echo $datos->getF_usuario();?>"> 
                                <input type="hidden" name="f_contrasena" id="f_contrasena" value="<?php echo $datos->getF_contrasena();?>"> 


                            <input type="submit" value="Modificar" name="modificar" class="btn btn-info">
                            </form>
                        </td>
                    </tr>
                    <?php 
                        endforeach;
                        ?>
                </table>
            </div>

        </div>
    </div>
    
    
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>
