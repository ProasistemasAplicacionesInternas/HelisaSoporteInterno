<?php 
require_once('../model/vinculo.php');

class Crudproductos{
	
public function mostrarProductos(){

		$db=conectar::acceso();
		$productos=[];

		$consultar_productos=$db->prepare('SELECT  id_producto,nombre_producto FROM productos_mai WHERE uso=:uses ORDER BY nombre_producto');
        $consultar_productos->bindValue('uses',1);
        $consultar_productos->execute();

			while ($listado_productos=$consultar_productos->fetch(PDO::FETCH_ASSOC)) {
					$productos[]=$listado_productos;	
			}
			return $productos;
		}
	}
?>
