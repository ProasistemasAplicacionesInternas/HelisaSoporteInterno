<?php
class PeticionMai
{

	// new Variables CamelCase

	private $idPeticionMai;
	private $productoPeticionMai;
	private $fechaPeticionMai;
	private $descripcionPeticionMai;
	private $estadoPeticionMai;
	private $fechaAtendidoMai;
	private $marcaRevisado;
	private $usuarioAtencionMai;
	private $conclusionesPeticionMai;
	private $reqJustification;
	private $reqName;
	private $usuarioCreacionMai;
	private $imagenPeticionMai;
	private $imagenPeticionMai2;
	private $imagenPeticionMai3;

	// Old Variables

	private $id_peticionMai;
	private $fecha_peticionMai;
	private $usuario_creacionMai;
	private $fecha_atendidoMai;
	private $estado_peticionMai;
	private $producto_peticionMai;
	private $descripcion_peticionMai;
	private $imagen_peticionMai;
	private $imagen_peticionMai2;
	private $imagen_peticionMai3;
	private $conclusiones_peticionMai;
	private $usuario_atencionMai;
	private $codigo_redireccionadoMai;
	private $categoria_redireccionado;
	private $area_funcionario;
	private $extension_funcionario;
	private $email_funcionario;
	private $marca_revisado;
	private $tipoPeticion;
	private $archivos;
	private $version;
	private $numero_version;
	private $sprint;
	private $gestion;
	private $req_Justification;
	private $req_Name;


	//Camel Case

	public function getIdPeticionMai()
	{
		return $this->idPeticionMai;
	}
	public function setIdPeticionMai($idPeticionMai)
	{
		$this->idPeticionMai = $idPeticionMai;
	}

	public function getProductoPeticionMai()
	{
		return $this->productoPeticionMai;
	}
	public function setProductoPeticionMai($productoPeticionMai)
	{
		$this->productoPeticionMai = $productoPeticionMai;
	}

	public function getFechaPeticionMai()
	{
		return $this->fechaPeticionMai;
	}
	public function setFechaPeticionMai($fechaPeticionMai)
	{
		$this->fechaPeticionMai = $fechaPeticionMai;
	}

	public function getDescripcionPeticionMai()
	{
		return $this->descripcionPeticionMai;
	}
	public function setDescripcionPeticionMai($descripcionPeticionMai)
	{
		$this->descripcionPeticionMai = $descripcionPeticionMai;
	}

	public function getEstadoPeticionMai()
	{
		return $this->estadoPeticionMai;
	}
	public function setEstadoPeticionMai($estadoPeticionMai)
	{
		$this->estadoPeticionMai = $estadoPeticionMai;
	}

	public function getFechaAtendidoMai()
	{
		return $this->fechaAtendidoMai;
	}
	public function setFechaAtendidoMai($fechaAtendidoMai)
	{
		$this->fechaAtendidoMai = $fechaAtendidoMai;
	}

		public function getMarcaRevisado()
	{
		return $this->marcaRevisado;
	}
	public function setMarcaRevisado($marcaRevisado)
	{
		$this->marcaRevisado = $marcaRevisado;
	}

	public function getUsuarioAtencionMai()
	{
		return $this->usuarioAtencionMai;
	}
	public function setUsuarioAtencionMai($usuarioAtencionMai)
	{
		$this->usuarioAtencionMai = $usuarioAtencionMai;
	}

	public function getConclusionesPeticionMai()
	{
		return $this->conclusionesPeticionMai;
	}
	public function setConclusionesPeticionMai($conclusionesPeticionMai)
	{
		$this->conclusionesPeticionMai = $conclusionesPeticionMai;
	}

	public function getReqJustification()
	{
		return $this->reqJustification;
	}
	public function setReqJustification($reqJustification)
	{
		$this->reqJustification = $reqJustification;
	}

	public function getReqName()
	{
		return $this->reqName;
	}
	public function setReqName($reqName)
	{
		$this->reqName = $reqName;
	}

	public function getUsuarioCreacionMai()
	{
		return $this->usuarioCreacionMai;
	}
	public function setUsuarioCreacionMai($usuarioCreacionMai)
	{
		$this->usuarioCreacionMai = $usuarioCreacionMai;
	}

	public function getImagenPeticionMai()
	{
		return $this->imagenPeticionMai;
	}
	public function setImagenPeticionMai($imagenPeticionMai)
	{
		$this->imagenPeticionMai = $imagenPeticionMai;
	}

	public function getImagenPeticionMai2()
	{
		return $this->imagenPeticionMai2;
	}
	public function setImagenPeticionMai2($imagenPeticionMai2)
	{
		$this->imagenPeticionMai2 = $imagenPeticionMai2;
	}

	public function getImagenPeticionMai3()
	{
		return $this->imagenPeticionMai3;
	}
	public function setImagenPeticionMai3($imagenPeticionMai3)
	{
		$this->imagenPeticionMai3 = $imagenPeticionMai3;
	}



















	//************************************************
	public function getId_peticionMai()
	{
		return $this->id_peticionMai;
	}
	public function setId_peticionMai($id_peticionMai)
	{
		$this->id_peticionMai = $id_peticionMai;
	}
	//*************************************************
	public function getFecha_peticionMai()
	{
		return $this->fecha_peticionMai;
	}
	public function setFecha_peticionMai($fecha_peticionMai)
	{
		$this->fecha_peticionMai = $fecha_peticionMai;
	}
	//*************************************************
	public function getUsuario_creacionMai()
	{
		return $this->usuario_creacionMai;
	}
	public function setUsuario_creacionMai($usuario_creacionMai)
	{
		$this->usuario_creacionMai = $usuario_creacionMai;
	}
	//*************************************************
	public function getFecha_atendidoMai()
	{
		return $this->fecha_atendidoMai;
	}
	public function setFecha_atendidoMai($fecha_atendidoMai)
	{
		$this->fecha_atendidoMai = $fecha_atendidoMai;
	}
	//*************************************************
	public function getEstado_peticionMai()
	{
		return $this->estado_peticionMai;
	}
	public function setEstado_peticionMai($estado_peticionMai)
	{
		$this->estado_peticionMai = $estado_peticionMai;
	}
	//*************************************************
	public function getProducto_peticionMai()
	{
		return $this->producto_peticionMai;
	}
	public function setProducto_peticionMai($producto_peticionMai)
	{
		$this->producto_peticionMai = $producto_peticionMai;
	}
	//*************************************************
	public function getDescripcion_peticionMai()
	{
		return $this->descripcion_peticionMai;
	}
	public function setDescripcion_peticionMai($descripcion_peticionMai)
	{
		$this->descripcion_peticionMai = $descripcion_peticionMai;
	}
	//*************************************************
	public function getImagen_peticionMai()
	{
		return $this->imagen_peticionMai;
	}
	public function setImagen_peticionMai($imagen_peticionMai)
	{
		$this->imagen_peticionMai = $imagen_peticionMai;
	}
	//*************************************************
	public function getImagen_peticionMai2()
	{
		return $this->imagen_peticionMai2;
	}
	public function setImagen_peticionMai2($imagen_peticionMai2)
	{
		$this->imagen_peticionMai2 = $imagen_peticionMai2;
	}
	//*************************************************
	public function getImagen_peticionMai3()
	{
		return $this->imagen_peticionMai3;
	}
	public function setImagen_peticionMai3($imagen_peticionMai3)
	{
		$this->imagen_peticionMai3 = $imagen_peticionMai3;
	}
	//*************************************************
	public function getConclusiones_peticionMai()
	{
		return $this->conclusiones_peticionMai;
	}
	public function setConclusiones_peticionMai($conclusiones_peticionMai)
	{
		$this->conclusiones_peticionMai = $conclusiones_peticionMai;
	}
	//*************************************************
	public function getUsuario_atencionMai()
	{
		return $this->usuario_atencionMai;
	}
	public function setUsuario_atencionMai($usuario_atencionMai)
	{
		$this->usuario_atencionMai = $usuario_atencionMai;
	}
	//*************************************************
	public function getCodigo_redireccionadoMai()
	{
		return $this->codigo_redireccionadoMai;
	}
	public function setCodigo_redireccionadoMai($codigo_redireccionadoMai)
	{
		$this->codigo_redireccionadoMai = $codigo_redireccionadoMai;
	}
	//*************************************************
	public function getCategoria_redireccionado()
	{
		return $this->categoria_redireccionado;
	}
	public function setCategoria_redireccionado($categoria_redireccionado)
	{
		$this->categoria_redireccionado = $categoria_redireccionado;
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
	public function getMarca_revisado()
	{
		return $this->marca_revisado;
	}
	public function setMarca_revisado($marca_revisado)
	{
		$this->marca_revisado = $marca_revisado;
	}
	//*************************************************
	public function getReq_Justification()
	{
		return $this->req_Justification;
	}
	public function setReq_Justification($req_Justification)
	{
		$this->req_Justification = $req_Justification;
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
	//*************************************************
	public function getName()
	{
		return $this->tipoPeticion;
	}
	public function setName($tipoPeticion)
	{
		$this->tipoPeticion = $tipoPeticion;
	}
	//*************************************************
	public function getArchivos()
	{
		return $this->archivos;
	}

	public function setArchivos($archivos)
	{
		$this->archivos = $archivos;
	}

	public function getVersion()
	{
		return $this->version;
	}
	public function setVersion($version)
	{
		$this->version = $version;
	}

	public function getNumero_version()
	{
		return $this->numero_version;
	}
	public function setNumero_version($numero_version)
	{
		$this->numero_version = $numero_version;
	}

	public function getSprint()
	{
		return $this->sprint;
	}
	public function setSprint($sprint)
	{
		$this->sprint = $sprint;
	}

	public function getGestion()
	{
		return $this->gestion;
	}
	public function setGestion($gestion)
	{
		$this->gestion = $gestion;
	}
}
