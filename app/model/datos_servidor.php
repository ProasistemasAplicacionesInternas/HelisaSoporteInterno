<?php 

	class Servidor{
		private $id_servidor;
		private $serial_servidor;
		private $activo_fijo;
		private $marca_servidor;
		private $nombre_servidor;
		private $ubicacion_servidor;
		private $IP_servidor;
		private $IP_publica;
		private $puerto_servidor;
		private $fecha_compra_servidor;
		private $memoria_servidor;
		private $disco_servidor;
		private $procesador_servidor;
		private $responsable_servidor;
		private $sistema_operativo;
		private $programas_instalados;
		private $uso;
		private $persona_genera;
		private $persona_entrega;
		private $persona_recibe;
		private $tipoServidor;
		private $id_usuario_servidor;
		private $nombre_usuario_servidor;
		private $tipo_usuario_servidor;
		private $cantidadMaquinas;
		/*-----------------@jefferson.correa--------------*/
		private $usuarioAdministrador;
		private $usuarioEstandar;
		/*********************** JOHANA WAS HERE 30-07-19 ***********************/
		private $fisico_servidor;
		private $dominio_servidor;
		private $tiempo_uso;
		private $backup;
		private $frecuencia_backup;
		private $fecha_entrega;
		private $cargo_entrega;
		private $fecha_recibe;
		private $cargo_recibe;
		private $ruta_backup;
		private $nombre;
		/*********************** JOHANA WAS HERE 30-07-19 ***********************/
		

		function _construct(){}

		public function getUsuarioAdministrador(){
		    return $this->usuarioAdministrador;
		}
		public function setUsuarioAdministrador($usuarioAdministrador){
		    $this->usuarioAdministrador = $usuarioAdministrador;
		    }

		public function getUsuarioEstandar(){
		    return $this->usuarioEstandar;
		}
		public function setUsuarioEstandar($usuarioEstandar){
		    $this->usuarioEstandar = $usuarioEstandar;
		    }
		/*-----------------@jefferson.correa--------------*/

	 /**************************************************************************/
		public function getIDservidor(){
			return $this->id_servidor;
		}
		public function setIDservidor($id_servidor){
			$this->id_servidor = $id_servidor;
		}
	 /**************************************************************************/
		public function getSerial_servidor(){
			return $this->serial_servidor;
		}
		public function setSerial_servidor($serial_servidor){
			$this->serial_servidor = $serial_servidor;
		}
	 /**************************************************************************/
		public function getActivo_fijo(){
			return $this->activo_fijo;
		}
		public function setActivo_fijo($activo_fijo){
			$this->activo_fijo = $activo_fijo;
		}
	 /**************************************************************************/
		public function getMarca_servidor(){
			return $this->marca_servidor;
		}
		public function setMarca_servidor($marca_servidor){
			$this->marca_servidor = $marca_servidor;
		}
	 /**************************************************************************/
		public function getNombre_servidor(){
			return $this->nombre_servidor;
		}
		public function setNombre_servidor($nombre_servidor){
			$this->nombre_servidor = $nombre_servidor;
		}
	/**************************************************************************/
		public function getUbicacion_servidor(){
			return $this->ubicacion_servidor;
		}
		public function setUbicacion_servidor($ubicacion_servidor){
			$this->ubicacion_servidor = $ubicacion_servidor;
		}
	 /**************************************************************************/
		public function getIP_servidor(){
			return $this->IP_servidor;
		}
		public function setIP_servidor($IP_servidor){
			$this->IP_servidor = $IP_servidor;
		}
	 /**************************************************************************/
		public function getIP_publica(){
			return $this->IP_publica;
		}
		public function setIP_publica($IP_publica){
			$this->IP_publica = $IP_publica;
		}
	 /**************************************************************************/
		public function getPuerto_servidor(){
			return $this->puerto_servidor;
		}
		public function setPuerto_servidor($puerto_servidor){
			$this->puerto_servidor = $puerto_servidor;
		}
	 /**************************************************************************/
		public function getFecha_compra_servidor(){
			return $this->fecha_compra_servidor;
		}
		public function setFecha_compra_servidor($fecha_compra_servidor){
			$this->fecha_compra_servidor = $fecha_compra_servidor;
		}
	 /**************************************************************************/
		public function getMemoria_servidor(){
			return $this->memoria_servidor;
		}
		public function setMemoria_servidor($memoria_servidor){
			$this->memoria_servidor = $memoria_servidor;
		}
	 /**************************************************************************/
		public function getDisco_servidor(){
			return $this->disco_servidor;
		}
		public function setDisco_servidor($disco_servidor){
			$this->disco_servidor = $disco_servidor;
		}
	 /**************************************************************************/
		public function getProcesador_servidor(){
			return $this->procesador_servidor;
		}
		public function setProcesador_servidor($procesador_servidor){
			$this->procesador_servidor = $procesador_servidor;
		}
	 /**************************************************************************/
		public function getResponsable_servidor(){
			return $this->responsable_servidor;
		}
		public function setResponsable_servidor($responsable_servidor){
			$this->responsable_servidor = $responsable_servidor;
		}
	 /**************************************************************************/
		public function getSistema_operativo()
		{
		    return $this->sistema_operativo;
		}
		
		public function setSistema_operativo($sistema_operativo)
		{
		    $this->sistema_operativo = $sistema_operativo;
		    return $this;
		}
	 /**************************************************************************/
		public function getProgramas_instalados()
		{
		    return $this->programas_instalados;
		}
		
		public function setProgramas_instalados($programas_instalados)
		{
		    $this->programas_instalados = $programas_instalados;
		    return $this;
		}
	 /**************************************************************************/
		public function getUso()
		{
		    return $this->uso;
		}
		
		public function setUso($uso)
		{
		    $this->uso = $uso;
		    return $this;
		}
	 /**************************************************************************/
		public function getPersona_genera()
		{
		    return $this->persona_genera;
		}
		
		public function setPersona_genera($persona_genera)
		{
		    $this->persona_genera = $persona_genera;
		    return $this;
		}
	 /**************************************************************************/
		public function getPersona_entrega()
		{
		    return $this->persona_entrega;
		}
		
		public function setPersona_entrega($persona_entrega)
		{
		    $this->persona_entrega = $persona_entrega;
		    return $this;
		}
	 /**************************************************************************/
		public function getPersona_recibe()
		{
		    return $this->persona_recibe;
		}
		
		public function setPersona_recibe($persona_recibe)
		{
		    $this->persona_recibe = $persona_recibe;
		    return $this;
		}
	 /**************************************************************************/
		public function getTipoServidor()
		{
		    return $this->tipoServidor;
		}
		
		public function setTipoServidor($tipoServidor)
		{
		    $this->tipoServidor = $tipoServidor;
		    return $this;
		}
	 /**************************************************************************/
	 	public function getId_usuario_servidor()
	 	{
	 	    return $this->id_usuario_servidor;
	 	}
	 	
	 	public function setId_usuario_servidor($id_usuario_servidor)
	 	{
	 	    $this->id_usuario_servidor = $id_usuario_servidor;
	 	    return $this;
	 	}
	 /**************************************************************************/
	 	public function getNombre_usuario_servidor()
	 	{
	 	    return $this->nombre_usuario_servidor;
	 	}
	 	
	 	public function setNombre_usuario_servidor($nombre_usuario_servidor)
	 	{
	 	    $this->nombre_usuario_servidor = $nombre_usuario_servidor;
	 	    return $this;
	 	}
	 
	 /**************************************************************************/
	 	public function getTipo_usuario_servidor()
	 	{
	 	    return $this->tipo_usuario_servidor;
	 	}
	 	
	 	public function setTipo_usuario_servidor($tipo_usuario_servidor)
	 	{
	 	    $this->tipo_usuario_servidor = $tipo_usuario_servidor;
	 	    return $this;
	 	}
	 /**************************************************************************/
	 	public function getCantidadMaquinas()
	 	{
	 	    return $this->cantidadMaquinas;
	 	}
	 	
	 	public function setCantidadMaquinas($cantidadMaquinas)
	 	{
	 	    $this->cantidadMaquinas = $cantidadMaquinas;
	 	    return $this;
	 	}
	 /*************************************************************************/

	 /*********************** JOHANA WAS HERE 30-07-19 ***********************/
	 	public function getFisico_servidor()
	 	{
	 	    return $this->fisico_servidor;
	 	}
	 	
	 	public function setFisico_servidor($fisico_servidor)
	 	{
	 	    $this->fisico_servidor = $fisico_servidor;
	 	    return $this;
	 	}
	 /*************************************************************************/
	 	public function getDominio_servidor()
	 	{
	 	    return $this->dominio_servidor;
	 	}
	 	
	 	public function setDominio_servidor($dominio_servidor)
	 	{
	 	    $this->dominio_servidor = $dominio_servidor;
	 	    return $this;
	 	}
	 /*************************************************************************/
	 	public function getTiempo_uso()
	 	{
	 	    return $this->tiempo_uso;
	 	}
	 	
	 	public function setTiempo_uso($tiempo_uso)
	 	{
	 	    $this->tiempo_uso = $tiempo_uso;
	 	    return $this;
	 	}
	 /*************************************************************************/
	 	public function getBackup()
	 	{
	     	return $this->backup;
		}
	 
	 	public function setBackup($backup)
	 	{
	     	$this->backup = $backup;
	     	return $this;
	 	}
	 /*************************************************************************/
	 	public function getFrecuencia_backup()
	 	{
	     	return $this->frecuencia_backup;
	 	}
	 
	 	public function setFrecuencia_backup($frecuencia_backup)
	 	{
	    	 $this->frecuencia_backup = $frecuencia_backup;
	     	return $this;
		}
	 /*************************************************************************/
	 	public function getFecha_entrega()
	 	{
	 	    return $this->fecha_entrega;
	 	}
	 	
	 	public function setFecha_entrega($fecha_entrega)
	 	{
	 	    $this->fecha_entrega = $fecha_entrega;
	 	    return $this;
	 	}
	 /*************************************************************************/
	 	public function getCargo_entrega()
	 	{
	    	return $this->cargo_entrega;
	 	}
	 
	 	public function setCargo_entrega($cargo_entrega)
	 	{
	     	$this->cargo_entrega = $cargo_entrega;
	     	return $this;
	 	}
	 /*************************************************************************/
	 	public function getFecha_recibe()
	 	{
	     	return $this->fecha_recibe;
	 	}
	 
	 	public function setFecha_recibe($fecha_recibe)
	 	{
	     	$this->fecha_recibe = $fecha_recibe;
	     	return $this;
	 	}
	 /*************************************************************************/
	 	public function getCargo_recibe()
	 	{
	 	    return $this->cargo_recibe;
	 	}
	 	
	 	public function setCargo_recibe($cargo_recibe)
	 	{
	 	    $this->cargo_recibe = $cargo_recibe;
	 	    return $this;
	 	}
	 /*************************************************************************/
	 	public function getRuta_backup()
	 	{
	 	    return $this->ruta_backup;
	 	}
	 	
	 	public function setRuta_backup($ruta_backup)
	 	{
	 	    $this->ruta_backup = $ruta_backup;
	 	    return $this;
	 	}
	 	 public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
	 /*************************************************************************/
	 /*********************** JOHANA WAS HERE 30-07-19 ***********************/

	}
 ?>