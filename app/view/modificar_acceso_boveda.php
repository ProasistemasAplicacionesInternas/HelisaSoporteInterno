<div class="modal fade mt-4" id="detalleAcceso" tabindex="-1" role="dialog" aria-labelledby="detalleAcceso" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Modificar Acceso</h6>
                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form id="form-acceso" >
                                <div class="form-group">
                                    <div>
                                        <input type="hidden" id="codigos" name="codigos" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="">Nombre</label>
                                    </div>
                                    <div>
                                        <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control info" required>
                                    </div>
                                </div>                              

                                <div class="form-group">
                                    <div>
                                        <label for="">Fecha Registro</label>
                                    </div>
                                    <div>
                                        <input type="date" id="fechas" name="fechas" class="form-control info" readonly>
                                    </div>
                                </div>                                
                              
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" id="btn-cambiosAcceso">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>