<?php
    require_once("../model/vinculo.php");
    class centroCostos{
      
        public function getcentroCostos(){
            $db=Conectar::acceso();
            $centroCostos = [];
            
            $consulta_centroCostos=$db->query("SELECT id_centroCostos, descripcion, codigo, (SELECT COUNT(*) FROM funcionarios WHERE funcionarios.centro_de_costos = centro_de_costos.id_centroCostos && funcionarios.festado = 5) AS personasxCentroCostos  FROM centro_de_costos");
            
            while($listado_centroCostos=$consulta_centroCostos->fetch(PDO::FETCH_ASSOC)){
                $this->centroCostos[]=$listado_centroCostos;
            }

           
            $db=null;
            return $this->centroCostos;
        }

        public function getCodigoCentro($id_centro) {
            $db=Conectar::acceso();
            $centroCostos = [];
            
            $consulta_centroCostos=$db->query("SELECT id_centroCostos, codigo FROM centro_de_costos WHERE id_centroCostos = '$id_centro'");
            
            while($listado_centroCostos=$consulta_centroCostos->fetch(PDO::FETCH_ASSOC)){
                $this->centroCostos[]=$listado_centroCostos;
            }

           
            $db=null;
            return $this->centroCostos;
        }

        public function crearCentroCostos($descripcion,$codigo){
            $db=Conectar::acceso();
            $consulta_codigo=$db->prepare('SELECT codigo FROM centro_de_costos WHERE codigo = :codigo');
            $consulta_codigo->bindValue('codigo',$codigo);
            $consulta_codigo->execute();

            if($consulta_codigo){
                $numeroConsidencias = $consulta_codigo->rowCount();

                if($numeroConsidencias >= 1){
                    $db = null;
                    return 2;
                }else{
                    $crearCentroCostos=$db->prepare('INSERT INTO centro_de_costos(descripcion,codigo) VALUES(:descripcion,:codigo)');
                    $crearCentroCostos->bindValue('descripcion',$descripcion);
                    $crearCentroCostos->bindValue('codigo',$codigo);
                    $crearCentroCostos->execute();


                    if($crearCentroCostos){
                        return 1;
                    }else{
                        return 0;
                    }
                }

            }else{
                return 0;
            }
            $db=null;

        }



    }
?>