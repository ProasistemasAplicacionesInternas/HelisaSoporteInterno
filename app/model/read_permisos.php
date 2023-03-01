<?php
    require_once('vinculo.php');

    class permisos{
        private $db;

        public function __Construct(){
            $this->db = Conectar::acceso();
        }

        public function terminarConexion(){
            $this->db = null;
        }
    
        /*********************************************************/
        /*** Consulta si un usuario es director o auxiliar *******/
        /******** Retorna 0 o el numero de Departamento **********/
        /*********************************************************/
        public function consultaPermisosDirector($usuario){
            $consulta = $this->db->prepare("SELECT DP.id_departamento  FROM departamentos_internos DP 
            LEFT JOIN areas A ON A.id_departamento = DP.id_departamento && A.descripcion LIKE 'Dirección%' 
            LEFT JOIN cargos C ON C.id_area = A.id_area &&  C.descripcion LIKE 'Director%'  
            LEFT JOIN funcionarios F ON F.cargo = C.id_cargo && F.festado = 5 
            WHERE F.usuario = :usuario
            UNION 
            SELECT DP.id_departamento FROM cargos C 
            LEFT JOIN funcionarios F ON F.cargo = C.id_cargo && F.festado = 5 
            LEFT JOIN areas A on A.id_area = C.id_area
            LEFT JOIN departamentos_internos DP on DP.id_departamento = A.id_departamento
            WHERE C.auxiliarDp = 1 && F.usuario = :usuario");
            $consulta->bindValue('usuario',$usuario);
            $consulta->execute();

            if($consulta && $consulta->rowCount() > 0){
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                $dato = $resultado['id_departamento'];
            }else{
                $dato = 0;
            }
            
            $this->terminarConexion();
            return $dato;
        }


        /*********************************************************/
        /***** Consulta si un usuario es Administrador de -*******/
        /***************** una o mas plataformas *****************/
        /*********************************************************/
        public function consultarPermisosAdministrador($usuario){
            $plataformas = [];
            $consulta_plataformas = $this->db->prepare("SELECT id_plataforma, plataformas.descripcion, nombre, administrador FROM plataformas LEFT JOIN funcionarios ON administrador = identificacion WHERE usuario = :usuario && plataformas.estado = 5");
            $consulta_plataformas->bindValue('usuario',$usuario);
            $consulta_plataformas->execute();

            if($consulta_plataformas->rowCount() > 0){
                $dato =  1;
            }else{
                $dato = 0;
            }
            
            $this->terminarConexion();
            return $dato;
        }
            
        /* ************************************************************ */
        /* *** Consulta si el funcionario tienes peticiones_accesos *** */
        /* ***************** finalizadas sin aceptar) ***************** */
        /* ************************************************************ */
        public function consultaPeticionesAccesosNoAcep($usuario){
<<<<<<< HEAD
            $db = Conectar::acceso();
            $consultaIdentificacion = $this->db->prepare('SELECT identificacion FROM funcionarios WHERE usuario=:usuarioF');
            $consultaIdentificacion->bindValue('usuarioF', $usuario);
            $consultaIdentificacion->execute();
            $identificacion = $consultaIdentificacion->fetch(PDO::FETCH_ASSOC);
                $consulta = $this->db->prepare('SELECT * FROM peticiones_accesos WHERE usuario_creacion = :usuario && estado = 2 && revisado = 0');
                $consulta->bindValue('usuario',$usuario);
                $consulta->execute();
                $total = $consulta->rowCount();
                if($total == 0){
                    $consultaT = $this->db->prepare('SELECT * FROM traslados WHERE funcionario_final = :usuario && estado_traslado = 3');
                    $consultaT->bindValue('usuario',$identificacion['identificacion']);
                    $consultaT->execute();
                    $totalT = $consultaT->rowCount();
                    if($totalT == 0){
                        echo 2;
                    }else{
                        echo 1;
                    }
                }else{
                    echo 0;
                }
=======
            $consulta = $this->db->prepare('SELECT * FROM peticiones_accesos WHERE usuario_creacion = :usuario && estado = 2 && revisado = 0');
            $consulta->bindValue('usuario',$usuario);
            $consulta->execute();

            $total = $consulta->rowCount();
            return $total;
>>>>>>> d07a9fb8f4e0c98d70372638cf652c5cce3d289e
        }


    }
?>