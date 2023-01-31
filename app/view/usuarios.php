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
        require('../controller/Selector_estados.php');


        $cartilla= new DatosUsuario();
        $info= new Usuario();
        $consultaUsuario=$cartilla->consultaUsuario();
      

        
?>
    <div class="container" id="data">
        <div class="row">
            <div class="col-11 mt-4 pl-5" id="consulta">
                <h5 class="mt-1">Cartilla de Usuarios</h5>
            </div>

            <div class="col-md-1" id="consulta">
                <a href="" data-toggle="modal" data-target="#crear-usuario" data-backdrop="static"><img src="public/img/nuevo.png" alt="" id="adicionar"></a>
            </div>

                <div class="col">
                    <table class="table table-striped" id="tabla">
                        <thead>
                            <th style="display:none;"></th>
                            <th style="display:none;"></th>
                            <th>Usuario</th>
                            <th style="display:none;"></th>
                            <th>Rol</th>
                            <th>Correo</th>                          
                            <!--<th style="width:60px;">Eliminar</th>-->
                            <th>Modificar</th>
                            <th>Inactivar</th>
                        </thead>
                        <tbody>
                            <?php foreach($consultaUsuario as $info): ?>
                            <tr>
                                <td style="display:none;">
                                    <span id="id_usuario<?php echo $info->getIDusuario();?>"><?php echo $info->getIDusuario() ?></span>
                                </td>
                                <td style="display:none;">
                                    <span id="id_usuarioX<?php echo $info->getIDusuario();?>"><?php echo $info->getIDusuario() ?></span>
                                </td>
                                <td>
                                    <span id="usuario<?php echo $info->getIDusuario();?>"><?php echo $info->getNombre() ?></span>
                                </td>
                                <td style="display:none;">
                                    <span id="contrasena<?php echo $info->getIDusuario();?>"><?php echo $info->getClave() ?></span>
                                </td>
                                <td>
                                    <span id="rol<?php echo $info->getIDusuario();?>"><?php echo $info->getRoles() ?></span>
                                </td>
                                <td>
                                    <span id="correo<?php echo $info->getIDusuario();?>"><?php echo $info->getCorreo() ?></span>
                                </td>
                            
                                
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm modifica-usuario" data-toggle="modal" data-target="#modifica-usuario" id="btn-modificarUsuario" name="btn-modificarUsuario" value="<?php echo $info->getIDusuario(); ?>"><span>Modificar</span></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm inactiva-usuario" data-toggle="modal" data-target="#inactiva-usuario" id="btn-inactivaUsuario" name="btn-inactivaUsuario" value="<?php echo $info->getIDusuario(); ?>"><span>Inactivar</span></button>
                                </td>
                            </tr>
                            <?php 
                        endforeach;
                        ?>
                        </tbody>
                    </table>
<?php /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ////////////////////////////////// VENTANA MODAL DE LA MODIFICACION DEL USUARIO ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>              

                    <div class="modal fade mt-4" id="modifica-usuario" tabindex="-1" role="dialog" aria-labelledby="modifica-usuario" aria-hidden="true">
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
                                                    <form action="app/controller/modifica_usuario.php" method="post" class="form-group">
                                                        
                                                        <div style="display: none;"><input type="text" id="id_usuario" name="id_usuario" class="crea_dataS" autofocus ></div>

                                                        <label for="">Nombre</label>
                                                        <div><input type="text" name="usuario" id="usuario" class="crea_data" maxlength="29" autocomplete="off" autofocus  readonly></div>

                                                        <label for="">Contrasena</label>
                                                        <div><input type="password" name="contrasena" id="contrasena" class="crea_data" maxlength="29" autocomplete="off" autofocus required></div>

                                                        <label for="">Correo</label>
                                                        <input type="text" id="correo" name="correo" class="crea_data" maxlength="29"  autocomplete="off" required>

                                                        <label for="">Tipo de validación</label>
                                                        <div>
                                                            <select name="tipoValidacion" id="tipoValidacion">
                                                                <option value="1" >Google Authenticator</option>
                                                                <option value="2" >Token por Correo</option>
                                                            </select>
                                                        </div>
                                                        </br>
                                                        <label for="">Eliminar Código QR</label></br>
                                                        <input type=submit value="Borrar Código" id="borrarCodigo" name="borrarCodigo" class="btn btn-danger btn-sm btn-borrarCodigo">                                              
                                                        <div class="modal-footer">
                                                            <input type=submit value="Guardar" id="guardar" name="guardar" class="mt-4 btn btn-primary btn-sm btn-guardar">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ////////////////////////////////// VENTANA MODAL DE LA INACTIVACION DEL USUARIO ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>     


                         <div class="modal fade mt-4" id="inactiva-usuario" tabindex="-1" role="dialog" aria-labelledby="inactiva-usuario" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Modifica Usuario</h6>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid cotenedor">
                                            <div class="row fila">
                                                <div class="col-12">
                                                    <form action="app/controller/modifica_usuario.php" method="post" class="form-group">
                                                        
                                                        <div  style="display:none;"><input type="text" id="id_usuarioX" name="id_usuarioX" class="crea_dataS" autofocus ></div>

                                                        <label for="">Fecha Inactivo</label>
                                                        <div><input type="date" name="fechaInactivo" id="fechaInactivo" class="crea_data" required></div>

                                                        <label for="">Observaci&oacuten</label>
                                                        <div> <textarea type="password" name="descripcion" id="descripcion" class="crea_data" required></textarea></div>

                                                        <div class="modal-footer">
                                                            <input type=submit value="Inactivar" id="inactivar" name="inactivar" class="mt-4 btn btn-danger btn-sm btn-inactivar"></div>
                                                    </form>
                                                </div>
                                            </div>
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
    <script src="public/js/valida_usuario.js"></script>
    <script src="public/js/selector_usuario.js?b2"></script>
    <script src="public/js/inactivar_usuario.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
    <?php require ('crear_usuario.php');?>
    <?php require ('actualiza_usuario.php');?>
    
</body>

</html>