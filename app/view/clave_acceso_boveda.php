<div class="modal fade mt-4" id="claveBovedaModal" tabindex="-1" role="dialog" aria-labelledby="claveBovedaModal" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ingrese la clave de la boveda</h6>                
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                                <div class="form-group">
                                    <div>
                                        <label for="">Clave</label>
                                    </div>
                                    <div>
                                        <input type="password" id="claveBovedaPrimero" name="claveBovedaPrimero" class="form-control info" required>
                                        <input type="hidden" name="accesoAprobado" value="1">
                                        <div id="message" style="display:none;">
                                            <label style="color:red;">La contraseña es incorrecta</label>
                                        </div>
                                    </div>
                                </div>                                                              
                              
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" id="btn-cancelarBoveda">Cancelar</button>
                                    <button type="button" class="btn btn-primary btn-sm" id="btn-claveBoveda">Aceptar</button>
                                    
                                </div>
                            <form action="app/view/boveda.php" method="POST">
                                <input type="hidden" name="accesoAprobado" value="1">
                                <button type="submit" style="display:none;" id="submitBovedaModal"> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>