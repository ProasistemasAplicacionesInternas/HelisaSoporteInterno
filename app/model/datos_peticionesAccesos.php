<?php 
class datosPeticionAccesos{

	private $idPeticion;
	private $fechaAtendido;
	private $estadoPeticion;
	private $usuarioAtendio;
	//****************camelCase******************
	private $id_peticion;
    private $fecha_creacion;
    private $usuario_creacion;
    private $fecha_atendido;
    private $usuario_atendio;
    private $estado_peticion;
	private $estado_descripcion;
    private $descripcion;
	private $plataformas;
    private $conclusiones;
	private $revisado;
	private $aprobado;
	private $tipo;
	/*--- Accesos*/
	private $nombre;
	private $clave;
	private $fecha;
	private $estado;
	private $plataforma;
	private $id_acceso;
    
//************************************************
	public function getId_peticion(){
	    return $this->id_peticion;
	}
	public function setId_peticion($id_peticion){
	    $this->id_peticion = $id_peticion;
    }
//*************************************************
	public function getFecha_creacion(){
	    return $this->fecha_creacion;
	}
	public function setFecha_creacion($fecha_creacion){
	    $this->fecha_creacion = $fecha_creacion;
    }
//*************************************************
    public function getUsuario_creacion(){
	    return $this->usuario_creacion;
	}
	public function setUsuario_creacion($usuario_creacion){
	    $this->usuario_creacion = $usuario_creacion;
    }
//*************************************************
    public function getFecha_atendido(){
	    return $this->fecha_atendido;
	}
	public function setFecha_atendido($fecha_atendido){
	    $this->fecha_atendido = $fecha_atendido;
	}
//*************************************************
    public function getUsuario_atendio(){
	    return $this->usuario_atendio;
	}
	public function setUsuario_atendio($usuario_atendio){
	    $this->usuario_atendio= $usuario_atendio;
	}
//*************************************************
    public function getEstado_peticion(){
	    return $this->estado_peticion;
	}
	public function setEstado_peticion($estado_peticion){
	    $this->estado_peticion = $estado_peticion ;
	}
//*************************************************
	public function getEstado_descripcion(){
		return $this->estado_descripcion;
	}
	public function setEstado_descripcion($estado_descripcion){
		$this->estado_descripcion = $estado_descripcion ;
	}
//*************************************************
    public function getDescripcion(){
	    return $this->descripcion;
	}
	public function setDescripcion($descripcion ){
	    $this->descripcion = $descripcion;
	}
//*************************************************
	public function getPlataformas(){
		return $this->plataformas ;
	}
	public function setPlataformas($plataformas){
		$this->plataformas = $plataformas;
	}
//*************************************************
    public function getConclusiones(){
	    return $this->conclusiones ;
	}
	public function setConclusiones($conclusiones){
	    $this->conclusiones = $conclusiones;
	}
//*************************************************
    public function getRevisado(){
	    return $this->revisado;
	}
	public function setRevisado($revisado){
	    $this->revisado = $revisado;
	}
//*************************************************
	public function getAprobado(){
		return $this->aprobado;
	}
	public function setAprobado($aprobado){
		$this->aprobado = $aprobado;
	}
//*************************************************
	public function getTipo(){
		return $this->tipo;
	}
	public function setTipo($tipo){
		$this->tipo = $tipo;
	}


//*************************************************
	public function getNombre(){
		return $this->nombre;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
//*************************************************
	public function getClave(){
		return $this->clave;
	}
	public function setClave($clave){
		$this->clave = $clave;
	}
//*************************************************
	public function getFecha(){
		return $this->fecha;
	}
	public function setFecha($fecha){
		$this->fecha = $fecha;
	}
//*************************************************
	public function getEstado(){
		return $this->estado;
	}
	public function setEstado($estado){
		$this->estado = $estado;
	}
//*************************************************
	public function getPlataforma(){
		return $this->plataforma;
	}
	public function setPlataforma($plataforma){
		$this->plataforma = $plataforma;
	}
//*************************************************
	public function getId_acceso(){
		return $this->id_acceso;
	}
	public function setId_acceso($id_acceso){
		$this->id_acceso = $id_acceso;
	}

//********************camelCase***********************
	public function getIdPeticion(){
		return $this->idPeticion;
	}
	public function setIdPeticion($idPeticion){
		$this->idPeticion = $idPeticion;
	}

	//*************************************************
    public function getFechaAtendido(){
	    return $this->fechaAtendido;
	}
	public function setFechaAtendido($fechaAtendido){
	    $this->fechaAtendido = $fechaAtendido;
	}

	//*************************************************
    public function getEstadoPeticion(){
	    return $this->estadoPeticion;
	}
	public function setEstadoPeticion($estadoPeticion){
	    $this->estadoPeticion = $estadoPeticion ;
	}
	//*************************************************
    public function getUsuarioAtendio(){
	    return $this->usuarioAtendio;
	}
	public function setUsuarioAtendio($usuarioAtendio){
	    $this->usuarioAtendio= $usuarioAtendio;
	}
}
?>