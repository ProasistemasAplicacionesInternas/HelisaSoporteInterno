<?php 

	class Accesos{
		
		private $id_accesos;
		private $descripcion;

	public function getId_accesos(){
		    return $this->id_accesos;
		}
		public function setId_accesos($id_accesos){
		    $this->id_accesos = $id_accesos;
		    }

	public function getDescripcion(){
		    return $this->descripcion;
		}
		public function setDescripcion($descripcion){
		    $this->descripcion = $descripcion;
		    }	

	}	

 ?>