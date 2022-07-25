<div class="modal fade bd-example-modal-sm" id="datos-funcionario" tabindex="-1" role="dialog" aria-labelledby="datos-funcionario" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Modificar Contraseña</h6>
                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form action="app/controller/controlador_funcionarios.php" method="post" class="form-group">
                                <div class="row">
                                    <div class="col-12 mt-1"><label for="">Usuario</label>
                                    </div>
                                    <div class="col-12"><input type="text" id="usuario" name="usuario" placeholder="<?php echo $_SESSION['usuario']?>" class="crea_data form-control" readonly></div>
                                </div>

                                <!-- -------------validacion de contraseña actual para la modificacaion de la contraseña -->
                                <div class="row" id="ValidarcontrasenaActual-Div">
                                    <div class="col-12 mt-1">
                                        <label for="">Contrase&ntilde;a Actual</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="password" id="contrasenaActual" name="contrasenaActual" class="crea_data form-control" maxlength="45" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="mt-2" id="validaCA"></label>
                                    </div>
                                </div>
                                <input type="button" value="Continuar" id="validarContrasenaActual" name="validarContrasenaActual" class="mt-4 btn btn-primary btn-sm btn-cambiar_contrasena" disabled> 
                                
                                <!-- ----------------------------------------------------------------------------------- -->
                                <div id="continuarModificacion-Div" style="display:none;">
                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="">Nueva Contrase&ntilde;a</label></div>
                                    <div class="col-12"><input type="password" id="clave" name="clave" class="crea_data form-control" maxlength="20" required></div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="">Confirmar Contrase&ntilde;a</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="password" id="confirma" name="confirma" class="crea_data form-control" maxlength="20" required> 
                                    </div>
                                    <div class="col-12">
                                        <label class="mt-2" id="valida"></label>
                                    </div>
                                    <div class="col-12" id="valida-div" style="width: 22%;text-align: center;float: right;margin: 5% 12% -1% -10%;   border: 1px solid #d9007f;padding: 13px;border-radius: 16px;box-shadow: 0px 0px 5px #bfbfbf;display: none; position: relative;left: 10%;">
                                    <label class="mt-2" id="valida2" style="color: #000000!important;font-weight: 100;"></label>
                                   </div>  
                                </div>

                                <input type="submit" value="Guardar" id="cambiar_contrasena" name="cambiar_contrasena" class="mt-4 btn btn-primary btn-sm btn-cambiar_contrasena" disabled>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>