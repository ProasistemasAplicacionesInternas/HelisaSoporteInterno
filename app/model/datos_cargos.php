<?php 
 
class Cargo{
	
	private $id_cargo;
	private $descripcion;

	public function getId_cargo(){
	    return $this->id_cargo;
	}
		public function setId_cargo($id_cargo){
	    	$this->id_cargo = $id_cargo;
	    }

	public function getDescripcion()
	{
	    return $this->descripcion;
	}
	
	public function setDescripcion($descripcion)
	{
	    $this->descripcion = $descripcion;
	    return $this;
	}

}

?>