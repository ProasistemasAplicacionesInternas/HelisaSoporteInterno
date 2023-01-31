<!---- Para el modificar la clave del tipo de acceso de la boveda ---->

<div class="modal fade mt-4" id="claveAcceso" tabindex="-1" role="dialog" aria-labelledby="detalleAcceso" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Modificar Acceso</h6>               
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form id="form-acceso" >
                                <div class="form-group">
                                    <div>
                                        <input type="hidden" id="codigosX" name="codigosX" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="">Clave</label>
                                    </div>
                                    <div>
                                        <input type="text" id="clavesBoveda" name="clavesBoveda" class="form-control info" required>
                                    </div>
                                </div>                                                                                          
                              
                                <div class="modal-footer">
                                    <button type="button" id="btn-cerrarModal" class="btn btn-secondary btn-sm ">Cancelar</button>
                                    <button type="button" class="btn btn-danger btn-sm" id="btn-cambiarClave">Modificar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>