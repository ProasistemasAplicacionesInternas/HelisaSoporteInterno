<?php 

	class Area{
		
		private $id_area;
		private $descripcion;

	public function getId_area(){
		    return $this->id_area;
		}
		public function setId_area($id_area){
		    $this->id_area = $id_area;
		    }

	public function getDescripcion(){
		    return $this->descripcion;
		}
		public function setDescripcion($descripcion){
		    $this->descripcion = $descripcion;
		    }	

	}	

 ?>