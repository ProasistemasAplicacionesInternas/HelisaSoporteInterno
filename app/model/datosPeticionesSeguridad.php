<?php
class PeticionSg
{

	private $id_peticionSg;
	private $fecha_peticionSg;
	private $usuario_creacionSg;
	private $fecha_atendidoSg;
	private $estado_peticionSg;
	private $categoriaSg;
	private $descripcion_peticionSg;
	private $imagenPeticionSeguridad1;
	private $imagenPeticionSeguridad2;
	private $imagenPeticionSeguridad3;
	private $imagenPeticionSeguridad4;
	private $imagenPeticionSeguridad5;
	private $conclusiones_PeticionSg;
	private $usuario_atencionSg;
	private $area_funcionario;
	private $extension_funcionario;
	private $email_funcionario;
	private $archivos;
	private $tipoPeticion;
	private $req_Name;
	private $name;

	//************************************************
	public function getId_peticionSg()
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
	public function getcategoriaSg()
	{
		return $this->categoriaSg;
	}
	public function setcategoriaSg($categoriaSg)
	{
		$this->categoriaSg = $categoriaSg;
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
	public function getimagenPeticionSeguridad1()
	{
		return $this->imagenPeticionSeguridad1;
	}
	public function setimagenPeticionSeguridad1($imagenPeticionSeguridad1)
	{
		$this->imagenPeticionSeguridad1 = $imagenPeticionSeguridad1;
	}
	//*************************************************
	public function getimagenPeticionSeguridad2()
	{
		return $this->imagenPeticionSeguridad2;
	}
	public function setimagenPeticionSeguridad2($imagenPeticionSeguridad2)
	{
		$this->imagenPeticionSeguridad2 = $imagenPeticionSeguridad2;
	}
	//*************************************************
	public function getimagenPeticionSeguridad3()
	{
		return $this->imagenPeticionSeguridad3;
	}
	public function setimagenPeticionSeguridad3($imagenPeticionSeguridad3)
	{
		$this->imagenPeticionSeguridad3 = $imagenPeticionSeguridad3;
	}
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
	
/* 	public function getname()
	{
		return $this->tipoPeticion;
	}
	public function setname($tipoPeticion)
	{
		$this->tipoPeticion = $tipoPeticion;
	} */
	//*************************************************
	public function getArchivos()
	{
		return $this->archivos;
	}

	public function setArchivos($archivos)
	{
		$this->archivos = $archivos;
	}

	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}
}
