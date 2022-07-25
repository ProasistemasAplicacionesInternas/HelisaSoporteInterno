<?php
       if(!isset($_SESSION['usuario']) || $_SESSION['id_roles']!=1){
        header('location:../../login.php');
            }
?>
   <div class="modal fade bd-example-modal-sm" id="elimina-usuario" name="elimina-usuario" tabindex="-1" role="dialog" aria-labelledby="elimina-usuario" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Esta seguro que quiere eliminar el usuario:</h6>
                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-12">
                        <form action="app/controller/control_elimina_usuario.php" method="post" class="form-group ">
                            <input type="text" class="form-control crea_data" id="alias" name="alias" readonly>
                            <input type="submit" value="Confirmar eliminación" id="eliminar" name="eliminar" class="mt-4 btn btn-danger btn-sm btn-guardar">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
