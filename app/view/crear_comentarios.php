<div class="modal fade bd-example" id="crearComentario" tabindex="-1" role="dialog" aria-labelledby="crearComentario" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Comentar</h6>
                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                      <form id="form-comentario">
                        <div class="panel row">
                        <input type="hidden" name="id_peticion" id="id_peticion" class="id_peticion">
                        </div>

                        <div class="panel row">
                          <div class="col-12">
                            <div class="form-group">                             
                              <textarea type="text" id="comentario" name="comentario" placeholder="Comentario" class="form-control info"></textarea>     
                            </div>
                          </div>                            
                        </div>                                                                    
                                                                              
                       <div class="col-12" >                      
                        <button type="button" class="btn btn-success" id="btn-comentar" name="btn-comentar"> Guardar</button>
                      </div> 
                      </form> 
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>

</div>