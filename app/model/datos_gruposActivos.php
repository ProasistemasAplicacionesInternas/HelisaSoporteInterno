<?php

class gruposActivos
{

	private $id_grupo;
	private $nombre_grupo;
	private $area_grupo;
	private $categoria;

	public function getId_grupo()
	{
		return $this->id_grupo;
	}
	public function setId_grupo($id_grupo)
	{
		$this->id_grupo = $id_grupo;
	}

	public function getNombre_grupo()
	{
		return $this->nombre_grupo;
	}
	public function setNombre_grupos($nombre_grupo)
	{
		$this->nombre_grupo = $nombre_grupo;
	}

	public function getAreaGrupo()
	{
		return $this->area_grupo;
	}
	
	public function setAreaGrupo($area_grupo): self
	{
		$this->area_grupo = $area_grupo;

		return $this;
	}

	public function getCategoria()
	{
		return $this->categoria;
	}

	public function setCategoria($categoria): self
	{
		$this->categoria = $categoria;

		return $this;
	}
}

?>