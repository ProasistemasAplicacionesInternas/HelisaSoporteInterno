<?php
       if(!isset($_SESSION['usuario']) || $_SESSION['id_roles']!=1){
        header('location:../../login.php');
            }
?>
<div class="modal fade bd-example-modal-sm" id="modifica-usuario" tabindex="-1" role="dialog" aria-labelledby="modifica-usuario" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Modificar Usuario</h6>
                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form action="../controller/control_crea_usuario.php" method="post" class="form-group">
                                <div class="row">
                                    <div class="col-12 mt-1"><label for="">Usuario</label>
                                    </div>
                                    <div class="col-12"><input type="text" id="alias" name="alias" class="crea_data form-control" ></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="">Rol</label></div>
                                    <div class="col-12"><select class="custom-select" name="id_roles" id="id_roles" required>
                                            <option value=""></option>
                                            <?php

                                                        foreach($matriz_roles as $rol){
                                                        echo "<option value='".$rol["id_roles"]."'>".$rol["descripcion"] ."</option>" ;
 
                                                          }  

                                                        ?>
                                        </select></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="">Correo</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="email" id="correo" name="correo" class="crea_data form-control" maxlength="60" required autocomplete="off">
                                    </div>
                                    <div class="col-12 mt-1"> <label for="">Contrase&ntilde;a</label></div>
                                    <div class="col-12">
                                        <input type="password" id="contrasena" name="contrasena" class="crea_data form-control" maxlength="60" required autocomplete="off">
                                    </div>
                                    <div class="col-12">
                                        <label class="mt-2" id="valida"></label>
                                    </div>
                                </div>
                                <input type="submit" value="Modificar" id="modificar" name="modificar" class="mt-4 btn btn-primary btn-sm btn-guardar">
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
