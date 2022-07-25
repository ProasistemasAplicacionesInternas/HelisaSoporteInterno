<?php 
	class DatosProductos{
		private $id_producto;
		private $descripcion;

	public function getId_producto(){
		    return $this->id_producto;
		}
		public function setId_producto($id_producto){
		    $this->id_producto = $id_producto;
		    }

	public function getDescripcion(){
		    return $this->descripcion;
		}
		public function setDescripcion($descripcion){
		    $this->descripcion = $descripcion;
		    }	
	}	
?>