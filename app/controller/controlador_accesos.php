<?php 
if(isset($_POST['accederModificar'])) {
 
if (isset($_POST['modificar'])) {

    $datosListados=$crud->consultaModificar();

    $codigoArea=$datosListados['id_area'];
    $nombreArea=$datosListados['descripcion1'];
    $codigoCargo=$datosListados['id_cargo'];
    $nombreCargo=$datosListados['descripcion2'];
    $codigoEstado=$datosListados['id_estado'];
    $nombreEstado=$datosListados['descripcion3'];
   

    $datosModificacion=$crud->consultarFuncionarios();
}


}
 ?>