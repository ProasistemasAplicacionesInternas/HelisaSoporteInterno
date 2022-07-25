<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Helisa | Soporte Infraestructura</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css" />

</head>

<body>
    <?php
       session_start();
        if(!isset($_SESSION['usuario'])|| empty($_SESSION['usuario'])){
        header('location:../../login.php');
            }
        require_once('../controller/Selector_rol.php');
        require_once('../model/crud_usuarios.php');
        require_once('../model/datos_usuario.php');            

        $cartilla= new DatosUsuario();
        $info= new Usuario();
        $consultaUsuarioInactivo=$cartilla->consultaUsuarioInactivo();
      

        
?>
    <div class="container" id="data">
        <div class="row">
            <div class="col-11 mt-4 pl-5" id="consulta">
                <h5 class="mt-1">Cartilla de Usuarios Inactivos</h5>
            </div>

            <!--<div class="col-md-1" id="consulta">
                <a href="" data-toggle="modal" data-target="#crear-usuario" data-backdrop="static"><img src="public/img/nuevo.png" alt="" id="adicionar"></a>
            </div>-->

                <div class="col">
                    <table class="table table-striped" id="tabla">
                        <thead>
                            <th style="display:none;"></th>
                            <th style="display:none;"></th>
                            <th>Usuario</th>
                            <th style="display:none;"></th>
                            <th>Rol</th>
                            <th>Correo</th> 
                            <th>Fecha Inactivaci&oacuten</th> 
                            <th>Observaci&oacuten</th>                          
                            <!--<th style="width:60px;">Eliminar</th>-->                           
                            <th>Activar</th>
                        </thead>
                    
                        <tbody>
                            <?php foreach($consultaUsuarioInactivo as $info): ?>

                            <tr>
                                <td style="display:none;">
                                <?php echo $info->getIDusuario() ?>
                                </td>

                                 <td style="display:none;">
                                <?php echo $info->getUestado() ?>
                                </td>  

                                <td>
                                <?php echo $info->getNombre() ?>
                                </td>

                                <td style="display:none;">
                                <?php echo $info->getClave() ?>
                                </td>

                                <td>
                                <?php echo $info->getRoles() ?>
                                </td>

                                <td>
                                <?php echo $info->getCorreo() ?>
                                </td>
                                
                                <td>
                                <?php echo $info->getUfecha_inactivacion() ?>
                                </td>

                                <td>
                                <?php echo $info->getDescripcion() ?>
                                </td>
                                
                                <td>                                 
                                          <form action="app/controller/modifica_usuario.php" method="post" class="form-group">

                                             <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $info->getIDusuario();?>">                                                                                                                 
                                        <input type=submit value="Activar" id="activar" name="activar" class="mt-2 btn btn-danger">
                                          </form>
                                   
                                  
                                </td>
                            </tr>
                            <?php 
                        endforeach;
                        ?>
                        </tbody>
                         
                    </table>
                </div>
            </div>
        </div>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/valida_usuario.js"></script>
    <script src="public/js/selector_usuario.js?V1"></script>
    <script src="public/js/inactivar_usuario.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
    <?php require ('crear_usuario.php');?>
    <?php require ('actualiza_usuario.php');?>
    
</body>

</html>