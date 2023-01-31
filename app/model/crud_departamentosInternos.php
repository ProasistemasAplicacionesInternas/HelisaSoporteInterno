<?php
    require_once("../model/vinculo.php");
    class departamentosInternos{
      
        public function getDepartamentosInternos(){
            $db=Conectar::acceso();
            $departamentosInternos = [];
            
            $consulta_departamentosInternos=$db->query("SELECT id_departamento, descripcion, estado, (SELECT COUNT(*) FROM funcionarios LEFT join cargos on cargos.id_cargo = cargo LEFT join areas ON areas.id_area = cargos.id_area left join departamentos_internos DP on DP.id_departamento = areas.id_departamento where DP.id_departamento = departamentos_internos.id_departamento && festado = 5) AS personasxDepartamento FROM departamentos_internos");
            
            while($listado_departamentosInternos=$consulta_departamentosInternos->fetch(PDO::FETCH_ASSOC)){
                $this->departamentosInternos[]=$listado_departamentosInternos;
            }

           
            $db=null;
            return $this->departamentosInternos;
        }

        public function getDepartamentoInternoxID($id_departamento){
            $db=Conectar::acceso();
            $departamentosInternos = [];
            
            $consulta_departamentosInternos=$db->query("SELECT id_departamento, descripcion, estado, (SELECT COUNT(*) FROM funcionarios LEFT join cargos on cargos.id_cargo = cargo LEFT join areas ON areas.id_area = cargos.id_area left join departamentos_internos DP on DP.id_departamento = areas.id_departamento where DP.id_departamento = departamentos_internos.id_departamento && festado = 5) AS personasxDepartamento FROM departamentos_internos WHERE id_departamento = $id_departamento");
            
            while($listado_departamentosInternos=$consulta_departamentosInternos->fetch(PDO::FETCH_ASSOC)){
                $this->departamentosInternos[]=$listado_departamentosInternos;
            }

           
            $db=null;
            return $this->departamentosInternos;
        }

        public function modificarDepartamento($id,$descripcion,$estado){
            $db=Conectar::acceso();
            $consulta1=$db->prepare("SELECT id_departamento AS numero FROM departamentos_internos WHERE descripcion = :descripcion && id_departamento != :id_departamento");
            $consulta1->bindValue('descripcion',$descripcion);
            $consulta1->bindValue('id_departamento',$id);
            $consulta1->execute();
            
            if($consulta1){
                $numeroDeConsidencias = $consulta1->rowCount();

                if($numeroDeConsidencias >=1){
                    $db=null;
                    return 2;
                }else{
                    $consulta=$db->prepare("UPDATE departamentos_internos SET descripcion = :descripcion, estado =:estado WHERE id_departamento = :id_departamento");
                    $consulta->bindValue('descripcion',$descripcion);
                    $consulta->bindValue('estado',$estado);
                    $consulta->bindValue('id_departamento',$id);
                    $consulta->execute();

                    $db=null;

                    if($consulta){
                        return 1;
                    }else{
                        return 0;
                    }
                }
            }else{
                $db=null;
                return 0;
            }

            
        }

        public function crearDepartamento($descripcion){
            $db=Conectar::acceso();
            $consulta=$db->prepare("SELECT id_departamento AS numero FROM departamentos_internos WHERE descripcion = :descripcion");
            $consulta->bindValue('descripcion',$descripcion);
            $consulta->execute();
            
            if($consulta){
                $numeroDeConsidencias = $consulta->rowCount();
    
                if($numeroDeConsidencias >= 1){
                    $db=null;
                    return 2;
                }else{
                    $insertar=$db->prepare("INSERT INTO  departamentos_internos(descripcion,estado) VALUES(:descripcion,5)");
                    $insertar->bindValue('descripcion',$descripcion);
                    $insertar->execute();

                    if($insertar){
                        $db=null;
                        return 1;
                    }else{
                        $db=null;
                        return 0;
                    }
                }
            }else{
                $db=null;
                return 0;
            }
            
        }


    }
    
?>