<?php

    class Maquina{
        
     /*********************** JOHANA WAS HERE 31-07-19 ***********************/        
            private $id_maquina;
            private $nombre_maquina;
            private $ubicacion_maquina;
            private $IP_maquina;
            private $IP_publica;
            private $puerto_maquina;
            private $fecha_compra_maquina;
            private $tipo_maquina;
            private $memoria_maquina;
            private $disco_maquina;
            private $procesador_maquina;
            private $dominio_maquina;
            private $responsable_maquina;
            private $usuario_administrador;
            private $usuario_estandar;
            private $sistema_operativo;
            private $programas_instalados;
            private $uso;
            private $tiempo_uso;
            private $backup;
            private $ruta_backup;
            private $frecuencia_backup;
            private $persona_genera;
            private $persona_entrega;
            private $cargo_entrega;
            private $fecha_entrega;
            private $persona_recibe;
            private $cargo_recibe;
            private $fecha_recibe;
            private $numeroServidor;
            private $nombreServidor; 
            private $estadoM; 
            private $nombre;           
           
        function __construct(){}
        
        
     /****************************************************************/
        public function getIDmaquina(){
            return $this->id_maquina;
        }

        public function setIDmaquina($id_maquina){
            $this->id_maquina = $id_maquina;
        }
     /****************************************************************/       
        public function getNombre_maquina()
        {
            return $this->nombre_maquina;
        }
        
        public function setNombre_maquina($nombre_maquina)
        {
            $this->nombre_maquina = $nombre_maquina;
            return $this;
        }
     /****************************************************************/
        public function getUbicacion_maquina()
               {
                   return $this->ubicacion_maquina;
               }
               
               public function setUbicacion_maquina($ubicacion_maquina)
               {
                   $this->ubicacion_maquina = $ubicacion_maquina;
                   return $this;
               }       
     /****************************************************************/
        public function getIP_maquina()
               {
                   return $this->IP_maquina;
               }
               
               public function setIP_maquina($IP_maquina)
               {
                   $this->IP_maquina = $IP_maquina;
                   return $this;
               }       
     /****************************************************************/
        public function getIP_publica()
               {
                   return $this->IP_publica;
               }
               
               public function setIP_publica($IP_publica)
               {
                   $this->IP_publica = $IP_publica;
                   return $this;
               }       
     /****************************************************************/       
        public function getPuerto_maquina()
        {
            return $this->puerto_maquina;
        }
        
        public function setPuerto_maquina($puerto_maquina)
        {
            $this->puerto_maquina = $puerto_maquina;
            return $this;
        }
     /****************************************************************/       
        public function getFecha_compra_maquina()
        {
            return $this->fecha_compra_maquina;
        }
        
        public function setFecha_compra_maquina($fecha_compra_maquina)
        {
            $this->fecha_compra_maquina = $fecha_compra_maquina;
            return $this;
        }
     /****************************************************************/       
        public function getTipo_maquina()
        {
            return $this->tipo_maquina;
        }
        
        public function setTipo_maquina($tipo_maquina)
        {
            $this->tipo_maquina = $tipo_maquina;
            return $this;
        }
     /****************************************************************/ 
        public function getMemoria_maquina()
              {
                  return $this->memoria_maquina;
              }
              
              public function setMemoria_maquina($memoria_maquina)
              {
                  $this->memoria_maquina = $memoria_maquina;
                  return $this;
              }      
     /****************************************************************/       
        public function getDisco_maquina()
        {
            return $this->disco_maquina;
        }
        
        public function setDisco_maquina($disco_maquina)
        {
            $this->disco_maquina = $disco_maquina;
            return $this;
        }
     /****************************************************************/       
        public function getProcesador_maquina()
        {
            return $this->procesador_maquina;
        }
        
        public function setProcesador_maquina($procesador_maquina)
        {
            $this->procesador_maquina = $procesador_maquina;
            return $this;
        }
     /****************************************************************/       
        public function getDominio_maquina()
        {
            return $this->dominio_maquina;
        }
        
        public function setDominio_maquina($dominio_maquina)
        {
            $this->dominio_maquina = $dominio_maquina;
            return $this;
        }
     /****************************************************************/       
        public function getResponsable_maquina()
        {
            return $this->responsable_maquina;
        }
        
        public function setResponsable_maquina($responsable_maquina)
        {
            $this->responsable_maquina = $responsable_maquina;
            return $this;
        }
     /****************************************************************/       
        public function getUsuario_administrador()
        {
            return $this->usuario_administrador;
        }
        
        public function setUsuario_administrador($usuario_administrador)
        {
            $this->usuario_administrador = $usuario_administrador;
            return $this;
        }
     /****************************************************************/       
        public function getUsuario_estandar()
        {
            return $this->usuario_estandar;
        }
        
        public function setUsuario_estandar($usuario_estandar)
        {
            $this->usuario_estandar = $usuario_estandar;
            return $this;
        }
     /****************************************************************/       
        public function getSistema_operativo()
        {
            return $this->sistema_operativo;
        }
        
        public function setSistema_operativo($sistema_operativo)
        {
            $this->sistema_operativo = $sistema_operativo;
            return $this;
        }
     /****************************************************************/  
        public function getProgramas_instalados()
             {
                 return $this->programas_instalados;
             }
             
             public function setProgramas_instalados($programas_instalados)
             {
                 $this->programas_instalados = $programas_instalados;
                 return $this;
             }     
     /****************************************************************/       
        public function getUso()
        {
            return $this->uso;
        }
        
        public function setUso($uso)
        {
            $this->uso = $uso;
            return $this;
        }
     /****************************************************************/  
        public function getTiempo_uso()
             {
                 return $this->tiempo_uso;
             }
             
             public function setTiempo_uso($tiempo_uso)
             {
                 $this->tiempo_uso = $tiempo_uso;
                 return $this;
             }     
     /****************************************************************/         
        public function getBackup()
        {
            return $this->backup;
        }
        
        public function setBackup($backup)
        {
            $this->backup = $backup;
            return $this;
        }
     /****************************************************************/ 
        public function getRuta_backup()
              {
                  return $this->ruta_backup;
              }
              
              public function setRuta_backup($ruta_backup)
              {
                  $this->ruta_backup = $ruta_backup;
                  return $this;
              }      
     /****************************************************************/  
        public function getFrecuencia_backup()
             {
                 return $this->frecuencia_backup;
             }
             
             public function setFrecuencia_backup($frecuencia_backup)
             {
                 $this->frecuencia_backup = $frecuencia_backup;
                 return $this;
             }     
     /****************************************************************/    
        public function getPersona_genera()
           {
               return $this->persona_genera;
           }
           
           public function setPersona_genera($persona_genera)
           {
               $this->persona_genera = $persona_genera;
               return $this;
           }   
     /****************************************************************/
        public function getPersona_entrega()
               {
                   return $this->persona_entrega;
               }
               
               public function setPersona_entrega($persona_entrega)
               {
                   $this->persona_entrega = $persona_entrega;
                   return $this;
               }       
     /****************************************************************/
        public function getCargo_entrega()
               {
                   return $this->cargo_entrega;
               }
               
               public function setCargo_entrega($cargo_entrega)
               {
                   $this->cargo_entrega = $cargo_entrega;
                   return $this;
               }       
     /****************************************************************/       
        public function getFecha_entrega()
        {
            return $this->fecha_entrega;
        }
        
        public function setFecha_entrega($fecha_entrega)
        {
            $this->fecha_entrega = $fecha_entrega;
            return $this;
        }
     /****************************************************************/   
        public function getPersona_recibe()
            {
                return $this->persona_recibe;
            }
            
            public function setPersona_recibe($persona_recibe)
            {
                $this->persona_recibe = $persona_recibe;
                return $this;
            }    
     /****************************************************************/  
        public function getCargo_recibe()
             {
                 return $this->cargo_recibe;
             }
             
             public function setCargo_recibe($cargo_recibe)
             {
                 $this->cargo_recibe = $cargo_recibe;
                 return $this;
             }     
     /****************************************************************/    
        public function getFecha_recibe()
           {
               return $this->fecha_recibe;
           }
           
           public function setFecha_recibe($fecha_recibe)
           {
               $this->fecha_recibe = $fecha_recibe;
               return $this;
           }   
     /****************************************************************/  
        public function getNumeroServidor()
             {
                 return $this->numeroServidor;
             }
             
             public function setNumeroServidor($numeroServidor)
             {
                 $this->numeroServidor = $numeroServidor;
                 return $this;
             }     
     /****************************************************************/  
        public function getEstadoM()
             {
                 return $this->estadoM;
             }
             
             public function setEstadoM($estadoM)
             {
                 $this->estadoM = $estadoM;
                 return $this;
             }     
     /****************************************************************/  
        public function getNombreServidor()
        {
            return $this->nombreServidor;
        }
        
        public function setNombreServidor($nombreServidor)
        {
            $this->nombreServidor = $nombreServidor;
            return $this;
        }
          public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
     /****************************************************************/       
     /*********************** JOHANA WAS HERE 31-07-19 ***********************/        

    }
?>