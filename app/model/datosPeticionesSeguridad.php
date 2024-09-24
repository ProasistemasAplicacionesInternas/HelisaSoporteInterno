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

	// old variables


	/* private $id_peticionSg;
	private $fecha_peticionSg;
	private $usuario_creacionSg;
	private $fecha_atendidoSg;
	private $estado_peticionSg;
	
	private $descripcion_peticionSg;

	private $conclusiones_PeticionSg;
	private $usuario_atencionSg;
	private $area_funcionario;
	private $extension_funcionario;
	private $email_funcionario;
	private $req_Name;
 */
	

	//************************************************
	/* public function getId_peticionSg()
	{
		return $this->id_peticionSg;
	}
	public function setId_peticionSg($id_peticionSg)
	{
		$this->id_peticionSg = $id_peticionSg;
	}
	//*************************************************
	public function getFecha_peticionSg()
	{
		return $this->fecha_peticionSg;
	}
	public function setFecha_peticionSg($fecha_peticionSg)
	{
		$this->fecha_peticionSg = $fecha_peticionSg;
	}
	//*************************************************
	public function getUsuario_creacionSg()
	{
		return $this->usuario_creacionSg;
	}
	public function setUsuario_creacionSg($usuario_creacionSg)
	{
		$this->usuario_creacionSg = $usuario_creacionSg;
	}
	//*************************************************
	public function getFecha_atendidoSg()
	{
		return $this->fecha_atendidoSg;
	}
	public function setFecha_atendidoSg($fecha_atendidoSg)
	{
		$this->fecha_atendidoSg = $fecha_atendidoSg;
	}
	//*************************************************

	public function getEstado_peticionSg()
	{
		return $this->estado_peticionSg;
	}
	public function setEstado_peticionSg($estado_peticionSg)
	{
		$this->estado_peticionSg = $estado_peticionSg;
	}
	//*************************************************

	}
	//*************************************************
	public function getdescripcion_peticionSg()
	{
		return $this->descripcion_peticionSg;
	}
	public function setdescripcion_peticionSg($descripcion_peticionSg)
	{
		$this->descripcion_peticionSg = $descripcion_peticionSg;
	}
	//*************************************************
	
	//*************************************************
	public function getconclusiones_PeticionSg()
	{
		return $this->conclusiones_PeticionSg;
	}
	public function setConclusiones_peticionSg($conclusiones_PeticionSg)
	{
		$this->conclusiones_PeticionSg = $conclusiones_PeticionSg;
	}
	//*************************************************
	public function getUsuario_atencionSg()
	{
		return $this->usuario_atencionSg;
	}
	public function setUsuario_atencionSg($usuario_atencionSg)
	{
		$this->usuario_atencionSg = $usuario_atencionSg;
	}
	//*************************************************
	public function getArea_funcionario()
	{
		return $this->area_funcionario;
	}
	public function setArea_funcionario($area_funcionario)
	{
		$this->area_funcionario = $area_funcionario;
	}
	//*************************************************
	public function getExtension_funcionario()
	{
		return $this->extension_funcionario;
	}
	public function setExtension_funcionario($extension_funcionario)
	{
		$this->extension_funcionario = $extension_funcionario;
	}
	//*************************************************
	public function getEmail_funcionario()
	{
		return $this->email_funcionario;
	}
	public function setEmail_funcionario($email_funcionario)
	{
		$this->email_funcionario = $email_funcionario;
	}
	//*************************************************
	public function getReq_Name()
	{
		return $this->req_Name;
	}
	public function setReq_Name($req_Name)
	{
		$this->req_Name = $req_Name;
	}



 */
}
