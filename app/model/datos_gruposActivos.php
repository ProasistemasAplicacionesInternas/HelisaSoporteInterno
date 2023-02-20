<?php 

	class gruposActivos{
	
	private $id_grupo;	
	private $nombre_grupo;
	private $area_grupo;

	public function getId_grupos(){return $this->id_grupos;}
	public function setId_grupos($id_grupos){$this->id_grupos = $id_grupos;}

	public function getNombre_grupos(){ return $this->nombre_grupos;}
	public function setNombre_grupos($nombre_grupos){$this->nombre_grupos = $nombre_grupos;}
	
	public function getArea_grupo(){ return $this->$area_grupo;}
	public function setArea_grupo($area_grupo){$this->$area_grupo = $$area_grupo;}
	}

 ?>