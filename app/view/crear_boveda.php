<div class="modal fade mt-4" id="clavePrimera" tabindex="-1" role="dialog" aria-labelledby="clavePrimera" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ingrese la nueva clave de la boveda</h6>                           
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form id="form-pass" >                                
                                <div class="form-group">
                                    <div>
                                        <label for="">Clave</label>
                                    </div>
                                    <div>
                                        <input type="password" id="claveBoveda" name="claveBoveda" class="form-control info" required>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <div>
                                        <label for="">Verificar Clave</label>
                                    </div>
                                    <div>
                                        <input type="password" id="claveBovedaSegundo" name="claveBovedaSegundo" class="form-control info" required>
                                    </div>
                                </div>                                                            
                            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" id="btn-cancelarBoveda">Cancelar</button>
                                    <button type="button" class="btn btn-primary btn-sm" id="btn-insertarClave">Aceptar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>