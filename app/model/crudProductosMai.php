<?php 
require_once('../model/vinculo.php');

class Crudproductos{
	
public function mostrarProductos(){

		$db=conectar::acceso();
		$productos=[];

		$consultarProductos=$db->prepare('SELECT  id_producto,nombre_producto FROM productos_mai WHERE uso=:uses ORDER BY nombre_producto');
        $consultarProductos->bindValue('uses',1);
        $consultarProductos->execute();

			while ($listadoProductos=$consultarProductos->fetch(PDO::FETCH_ASSOC)) {
					$productos[]=$listadoProductos;	
			}
			return $productos;
		}
	}
?>
