<?php
class PeticionSg
{
	// camel case

	private $idPeticionSg;
	private $fechaFeticionSg;
	private $usuarioCreacionSg;
	private $fechaAtendidoSg;
	private $estadoPeticionSg;
	private $descripcionPeticionSg;
	private $usuarioAtencionSg;
	private $conclusionesPeticionSg;
	private $areaFuncionario;
	private $extensionFuncionario;
	private $emailFuncionario;
	private $reqName;
	private $peticionCom;
	private $marcaRevisadoSg;
	private $categoriaSg;
	private $imagenPeticionSeguridad1;
	private $imagenPeticionSeguridad2;
	private $imagenPeticionSeguridad3;
	private $imagenPeticionSeguridad4;
	private $imagenPeticionSeguridad5;
	private $archivos;
	private $tipoPeticion;
	private $name;
	


	public function getIdPeticionSg()
	{
		return $this->idPeticionSg;
	}
	public function setIdPeticionSg($idPeticionSg)
	{
		$this->idPeticionSg = $idPeticionSg;
	}

	public function getFechaPeticionSg()
	{
		return $this->fechaFeticionSg;
	}
	public function setFechaPeticionSg($fechaFeticionSg)
	{
		$this->fechaFeticionSg = $fechaFeticionSg;
	}

	public function getUsuarioCreacionSg()
	{
		return $this->usuarioCreacionSg;
	}
	public function setUsuarioCreacionSg($usuarioCreacionSg)
	{
		$this->usuarioCreacionSg = $usuarioCreacionSg;
	}

	public function getFechaAtendidoSg()
	{
		return $this->fechaAtendidoSg;
	}
	public function setFechaAtendidoSg($fechaAtendidoSg)
	{
		$this->fechaAtendidoSg = $fechaAtendidoSg;
	}

	public function getEstadoPeticionSg()
	{
		return $this->estadoPeticionSg;
	}
	public function setEstadoPeticionSg($estadoPeticionSg)
	{
		$this->estadoPeticionSg = $estadoPeticionSg;
	}

	public function getDescripcionPeticionSg()
	{
		return $this->descripcionPeticionSg;
	}
	public function setDescripcionPeticionSg($descripcionPeticionSg)
	{
		$this->descripcionPeticionSg = $descripcionPeticionSg;
	}

	public function getUsuarioAtencionSg()
	{
		return $this->usuarioAtencionSg;
	}
	public function setUsuarioAtencionSg($usuarioAtencionSg)
	{
		$this->usuarioAtencionSg = $usuarioAtencionSg;
	}

	public function getConclusionesPeticionSg()
	{
		return $this->conclusionesPeticionSg;
	}
	public function setConclusionesPeticionSg($conclusionesPeticionSg)
	{
		$this->conclusionesPeticionSg = $conclusionesPeticionSg;
	}

	public function getAreaFuncionario()
	{
		return $this->areaFuncionario;
	}
	public function setAreaFuncionario($areaFuncionario)
	{
		$this->areaFuncionario = $areaFuncionario;
	}

	public function getEmailFuncionario()
	{
		return $this->emailFuncionario;
	}
	public function setEmailFuncionario($emailFuncionario)
	{
		$this->emailFuncionario = $emailFuncionario;
	}

	public function getMarcaRevisadoSg()
	{
		return $this->marcaRevisadoSg;
	}
	public function setMarcaRevisadoSg($marcaRevisadoSg)
	{
		$this->marcaRevisadoSg = $marcaRevisadoSg;
	}

	public function getPeticionCom()
	{
		return $this->peticionCom;
	}
	public function setPeticionCom($peticionCom)
	{
		$this->peticionCom = $peticionCom;
	}

	public function getcategoriaSg()
	{
		return $this->categoriaSg;
	}
	public function setcategoriaSg($categoriaSg)
	{
		$this->categoriaSg = $categoriaSg;
	}
	
	public function getimagenPeticionSeguridad1()
	{
		return $this->imagenPeticionSeguridad1;
	}
	public function setimagenPeticionSeguridad1($imagenPeticionSeguridad1)
	{
		$this->imagenPeticionSeguridad1 = $imagenPeticionSeguridad1;
	}

	public function getimagenPeticionSeguridad2()
	{
		return $this->imagenPeticionSeguridad2;
	}
	public function setimagenPeticionSeguridad2($imagenPeticionSeguridad2)
	{
		$this->imagenPeticionSeguridad2 = $imagenPeticionSeguridad2;
	}

	public function getimagenPeticionSeguridad3()
	{
		return $this->imagenPeticionSeguridad3;
	}
	public function setimagenPeticionSeguridad3($imagenPeticionSeguridad3)
	{
		$this->imagenPeticionSeguridad3 = $imagenPeticionSeguridad3;
	}

	public function getimagenPeticionSeguridad4()
	{
		return $this->imagenPeticionSeguridad4;
	}
	public function setimagenPeticionSeguridad4($imagenPeticionSeguridad4)
	{
		$this->imagenPeticionSeguridad4 = $imagenPeticionSeguridad4;
	}

	public function getimagenPeticionSeguridad5()
	{
		return $this->imagenPeticionSeguridad5;
	}
	public function setimagenPeticionSeguridad5($imagenPeticionSeguridad5)
	{
		$this->imagenPeticionSeguridad5 = $imagenPeticionSeguridad5;
	}

	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}

	public function getArchivos()
	{
		return $this->archivos;
	}

	public function setArchivos($archivos)
	{
		$this->archivos = $archivos;
	}
}
