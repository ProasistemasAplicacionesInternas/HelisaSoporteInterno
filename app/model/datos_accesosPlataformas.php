<?php 
    class datosAccesosPlataformas{

        private $id_accesoPlataforma;
        private $plataforma;
        private $plataforma_descripcion;
        private $plataforma_administrador;
        private $id_usuario;
        private $usuario;
        private $clave;
        private $estado;
        private $estado_Descripcion;
        private $fecha_registro;
        private $fecha_inactivacion;

        public function setId_accesoPlataforma($id_accesoPlataforma){
            $this->id_accesoPlataforma = $id_accesoPlataforma;
        }
        public function getid_accesoPlataforma(){
            return $this->id_accesoPlataforma;
        }

        public function setPlataforma($plataforma){
            $this->plataforma = $plataforma;
        }
        public function getPlataforma(){
            return $this->plataforma;
        }
        
        public function setPlataformaDescripcion($plataforma_descripcion){
            $this->plataforma_descripcion = $plataforma_descripcion;
        }
        public function getPlataformaDescripcion(){
            return $this->plataforma_descripcion;
        }
        
        public function setPlataformaAdministrador($plataforma_administrador){
            $this->plataforma_administrador = $plataforma_administrador;
        }
        public function getPlataformaAdministrador(){
            return $this->plataforma_administrador;
        }

        public function setId_usuario($id_usuario){
            $this->id_usuario = $id_usuario;
        }
        public function getId_usuario(){
            return $this->id_usuario;
        }
        
        
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }
        public function getUsuario(){
            return $this->usuario;
        }

        public function setClave($clave){
            $this->clave = $clave;
        }
        public function getClave(){
            return $this->clave;
        }
        
        public function setEstado($estado){
            $this->estado = $estado;
        }
        public function getEstado(){
            return $this->estado;
        }
        
        public function setEstadoDescripcion($estado_Descripcion){
            $this->estado_Descripcion = $estado_Descripcion;
        }
        public function getEstadoDescripcion(){
            return $this->estado_Descripcion;
        }
        public function setFecha_registro($fecha_registro){
            $this->fecha_registro = $fecha_registro;
        }
        public function getFecha_registro(){
            return $this->fecha_registro;
        }
        
        public function setFecha_inactivacion($fecha_inactivacion){
            $this->fecha_inactivacion = $fecha_inactivacion;
        }
        public function getFecha_inactivacion(){
            return $this->fecha_inactivacion;
        }

    }
?>