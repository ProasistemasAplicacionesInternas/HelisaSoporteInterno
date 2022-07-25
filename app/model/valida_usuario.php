<?php


require_once    ("../model/vinculo.php");
    
    
    
class ValidaUsuario{

    public function valida($verifica){

        $claveLogin=$_POST['clave'];
            
            /*--------------REALIZA UN QUERY PARA LA CONSULTA DE LOS DATOS---------------*/
                     
       $db=conectar::acceso();
        
        $confirma_usuario=$db->prepare('SELECT usuario, clave, validacion,estado.id_estado,timestampdiff(day, fecha_registro , now()) as dias FROM usuarios LEFT JOIN estado ON uestado=id_estado WHERE usuario=:usuario ');

        $confirma_usuario->bindValue('usuario',$verifica->getNombre()); 
        $confirma_usuario->execute();

        $existe_usuario=$confirma_usuario->rowCount();
        if($existe_usuario != 0){/* si el resultado es 0 nos reenviara a loin de lo contrario realizara el proceso */

            $dataUsuario=$confirma_usuario->fetch(PDO::FETCH_ASSOC);

            $codigoEstado=$dataUsuario['id_estado'];
            $baseClave=$dataUsuario['clave'];
            $validar=$dataUsuario['validacion'];
            $dias=$dataUsuario['dias'];

            $db=conectar::acceso();
            $validacion_clave=$db->prepare('SELECT clave FROM usuarios WHERE clave=:u_clave');
            $validacion_clave->bindValue('u_clave',$verifica->getClave());
            $validacion_clave->execute();
            $loginClave=$validacion_clave->rowCount();

            if($validar==0 && $loginClave && ($codigoEstado != 6)){

                session_start();

                $_SESSION["usuario"] = $dataUsuario['usuario'];

                header("location:../view/view_encriptar_usuario.php");

            } else {

                if ($dias >= 90 || $dias  <= -90) {
                    
                        $passwordLogin=password_verify($claveLogin, $baseClave);
                        if ($passwordLogin && ($codigoEstado != 6) ){
                
                            session_start();
                            $_SESSION["usuario"]=$dataUsuario['usuario'];
                            $rol=  $_SESSION["usuario"];
                            
                            $seleccion=("SELECT id_roles,intentos FROM usuarios WHERE  usuario='$rol'");
                        
                            $resultado=$db->query($seleccion);
                            $data=$resultado->fetch(PDO::FETCH_ASSOC);   
                            $id_roles=$data['id_roles'];
                            $intentos=$data['intentos'];
                            $_SESSION['id_roles']=$id_roles; 
                            $_SESSION['intentos']=$intentos; 

                            $actualizar_intentos = $db->prepare('UPDATE usuarios SET intentos=:intento WHERE usuario=:user');             
                            $actualizar_intentos->bindValue('intento',0);
                            $actualizar_intentos->bindValue('user',$verifica->getNombre());
                            $actualizar_intentos->execute();

                            $intentos = $db->prepare('INSERT INTO intentos_usuarios(usuario,fecha,cantidad_exitos,IP) VALUES(:user,:data,:success,:ip)');
                            $intentos->bindValue('user',$verifica->getNombre());
                            date_default_timezone_set('America/Bogota');
                            $intentos->bindValue('data',date('Y-m-d H:i:s'));
                            $intentos->bindValue('success',1);
                            $intentos->bindValue('ip', $_SERVER['REMOTE_ADDR']);
                            $intentos->execute();
                        
                            header("location:../view/cambio_contrasena_obligatorio.php");

                        } else {
                            $db=conectar::acceso();
                            $consulta = $db->prepare('SELECT intentos FROM usuarios WHERE usuario=:user');
                            $consulta->bindValue('user',$verifica->getNombre());
                            $consulta->execute();
                            $filtro = $consulta->fetch(PDO::FETCH_ASSOC);
                            $intentos=$filtro['intentos'];
                            $intentos++;                

                            if($intentos <= 3){

                                $validaIntentos = $db->prepare('UPDATE usuarios SET intentos=:intento WHERE usuario=:user');
                                $validaIntentos->bindValue('user',$verifica->getNombre());
                                $validaIntentos->bindValue('intento',$intentos);
                                $validaIntentos->execute();

                                $intentos = $db->prepare('INSERT INTO intentos_usuarios(usuario,fecha,cantidad_fallidos,IP) VALUES(:user,:data,:failed,:ip)');
                                $intentos->bindValue('user',$verifica->getNombre());
                                date_default_timezone_set('America/Bogota');
                                $intentos->bindValue('data',date('Y-m-d H:i:s'));
                                $intentos->bindValue('failed',1);
                                $intentos->bindValue('ip', $_SERVER['REMOTE_ADDR']);
                                $intentos->execute();

                                header("location:../../login.php?vrTx2e/:fgtyjf45yTsdbbgh=ghtyn%4/tSQ34&cty6Dd54=1&val=ghtf43&valrtv675474");

                            } else {

                                $intentos = $db->prepare('INSERT INTO intentos_usuarios(usuario,fecha,cantidad_fallidos,IP) VALUES(:user,:data,:failed,:ip)');
                                $intentos->bindValue('user',$verifica->getNombre());
                                date_default_timezone_set('America/Bogota');
                                $intentos->bindValue('data',date('Y-m-d H:i:s'));
                                $intentos->bindValue('failed',1);
                                $intentos->bindValue('ip', $_SERVER['REMOTE_ADDR']);
                                $intentos->execute();

                                $Inactivar=$db->prepare('UPDATE usuarios SET ufecha_inactivacion = :ufecha_inactivacion, descripcion = :descripcion, ufecha_sistema = :ufecha_sistema, usuario_inactiva=:usuario_inactiva, uestado = :uestado WHERE usuario = :usuario');

                                $bloqueo = 'Usuario inactivado por maximo de intentos fallidos al intentar entrar a la plataforma';
                            date_default_timezone_set('America/Bogota');
                                $Inactivar->bindValue('usuario', $verifica->getNombre());
                                $Inactivar->bindValue('ufecha_inactivacion', date('Y-m-d H:i:s'));
                                $Inactivar->bindValue('descripcion', $bloqueo);                     
                                $Inactivar->bindValue('ufecha_sistema', date('Y-m-d H:i:s'));
                                $Inactivar->bindValue('uestado',6);
                                $Inactivar->bindValue('usuario_inactiva', 'Proceso de inactivacion');
                                $Inactivar->execute();

                                header("location:../../login.php?vrTx2e/:fgtyjf45yTsdbbgh=ghtyn%gtSQ34&cty6Dd54=2&val=ghtf43&valrtv675474");

                            }
                            
                        }
                    }  else {

                            $passwordLogin=password_verify($claveLogin, $baseClave);
                            
                            if ($passwordLogin && ($codigoEstado != 6) ){
                            
                                session_start();
                            
                                $_SESSION["usuario"]=$dataUsuario['usuario'];
                                $rol=  $_SESSION["usuario"];
                                
                                $seleccion=("SELECT id_roles,intentos FROM usuarios WHERE  usuario='$rol'");
                            
                                $resultado=$db->query($seleccion);
                                $data=$resultado->fetch(PDO::FETCH_ASSOC);   
                                $id_roles=$data['id_roles'];
                                $intentos=$data['intentos'];
                                $_SESSION['id_roles']=$id_roles; 
                                $_SESSION['intentos']=$intentos; 

                                $actualizar_intentos = $db->prepare('UPDATE usuarios SET intentos=:intento WHERE usuario=:user');             
                                $actualizar_intentos->bindValue('intento',0);
                                $actualizar_intentos->bindValue('user',$verifica->getNombre());
                                $actualizar_intentos->execute();

                                $intentos = $db->prepare('INSERT INTO intentos_usuarios(usuario,fecha,cantidad_exitos,IP) VALUES(:user,:data,:success,:ip)');
                                $intentos->bindValue('user',$verifica->getNombre());
                                date_default_timezone_set('America/Bogota');
                                $intentos->bindValue('data',date('Y-m-d H:i:s'));
                                $intentos->bindValue('success',1);
                                $intentos->bindValue('ip', $_SERVER['REMOTE_ADDR']);
                                $intentos->execute();
                            
                                header("location:../../dashboard.php");

                            } else {
                                $db=conectar::acceso();
                                $consulta = $db->prepare('SELECT intentos FROM usuarios WHERE usuario=:user');
                                $consulta->bindValue('user',$verifica->getNombre());
                                $consulta->execute();
                                $filtro = $consulta->fetch(PDO::FETCH_ASSOC);
                                $intentos=$filtro['intentos'];
                                $intentos++;                

                                if($intentos <= 3){

                                    $validaIntentos = $db->prepare('UPDATE usuarios SET intentos=:intento WHERE usuario=:user');
                                    $validaIntentos->bindValue('user',$verifica->getNombre());
                                    $validaIntentos->bindValue('intento',$intentos);
                                    $validaIntentos->execute();

                                    $intentos = $db->prepare('INSERT INTO intentos_usuarios(usuario,fecha,cantidad_fallidos,IP) VALUES(:user,:data,:failed,:ip)');
                                    $intentos->bindValue('user',$verifica->getNombre());
                                    date_default_timezone_set('America/Bogota');
                                    $intentos->bindValue('data',date('Y-m-d H:i:s'));
                                    $intentos->bindValue('failed',1);
                                    $intentos->bindValue('ip', $_SERVER['REMOTE_ADDR']);
                                    $intentos->execute();

                                    header("location:../../login.php?vrTx2e/:fgtyjf45yTsdbbgh=ghtyn%4/tSQ34&cty6Dd54=1&val=ghtf43&valrtv675474");

                                } else {

                                    $intentos = $db->prepare('INSERT INTO intentos_usuarios(usuario,fecha,cantidad_fallidos,IP) VALUES(:user,:data,:failed,:ip)');
                                    $intentos->bindValue('user',$verifica->getNombre());
                                    date_default_timezone_set('America/Bogota');
                                    $intentos->bindValue('data',date('Y-m-d H:i:s'));
                                    $intentos->bindValue('failed',1);
                                    $intentos->bindValue('ip', $_SERVER['REMOTE_ADDR']);
                                    $intentos->execute();

                                    $Inactivar=$db->prepare('UPDATE usuarios SET ufecha_inactivacion = :ufecha_inactivacion, descripcion = :descripcion, ufecha_sistema = :ufecha_sistema, usuario_inactiva=:usuario_inactiva, uestado = :uestado WHERE usuario = :usuario');

                                    $bloqueo = 'Usuario inactivado por maximo de intentos fallidos al intentar entrar a la plataforma';
                                date_default_timezone_set('America/Bogota');
                                    $Inactivar->bindValue('usuario', $verifica->getNombre());
                                    $Inactivar->bindValue('ufecha_inactivacion', date('Y-m-d H:i:s'));
                                    $Inactivar->bindValue('descripcion', $bloqueo);                     
                                    $Inactivar->bindValue('ufecha_sistema', date('Y-m-d H:i:s'));
                                    $Inactivar->bindValue('uestado',6);
                                    $Inactivar->bindValue('usuario_inactiva', 'Proceso de Inactivacion');
                                    $Inactivar->execute();

                                    header("location:../../login.php?vrTx2e/:fgtyjf45yTsdbbgh=ghtyn%gtSQ34&cty6Dd54=2&val=ghtf43&valrtv675474");
                                }                            
                            }
                    }  
            }
        }else{
            header("location:../../login.php");
        } 
    }

        public function validacion($valida){

            session_start(); 
 
            if(!isset($_SESSION['intentos'])) 
            $_SESSION['intentos'] = 0; 
        else {      

         $_SESSION['intentos'] ++ ; 

         if ($_SESSION['intentos'] <= 3 ) { 
           
                 $claveLogin=$_POST['claves'];

                $db=conectar::acceso();

              $confirma_usuario=$db->prepare('SELECT usuario, clave FROM usuarios WHERE usuario=:usuario');

            $confirma_usuario->bindValue('usuario',$valida->getNombre());
            $confirma_usuario->execute();
            $existe_usuario=$confirma_usuario->rowCount();
            $dataUsuario=$confirma_usuario->fetch(PDO::FETCH_ASSOC);
            $baseClave=$dataUsuario['clave'];
            
            $passwordLogin=password_verify($claveLogin, $baseClave);
          
            if ($passwordLogin && (!empty($dataUsuario['usuario'])) ){

                  echo 1;
            } else{
              

                   echo 0;
            }

        } else {
              $_SESSION['intentos'] = 0; 
            echo 2;
        }
 
     }
                

  }
        /* valida unicamente la contraseña del usuario con la contraseña ingresada (proceso modificar contraseña) */
        public function validar($usuario){
            $db=conectar::acceso();

            $confirmarUsuario = $db->prepare('SELECT usuario,clave FROM usuarios WHERE usuario = :usuario');
            $confirmarUsuario->bindValue('usuario',$usuario->getNombre());
            $confirmarUsuario->execute();
            $dataUsuario = $confirmarUsuario->fetch(PDO::FETCH_ASSOC);
            $usuarioClave = $dataUsuario['clave'];

            $verificacionContrasena = password_verify($usuario->getClave(),$usuarioClave);
            
            if($verificacionContrasena){
                echo 1;
            }else{
                echo 0;
            }


        }

}
?>
