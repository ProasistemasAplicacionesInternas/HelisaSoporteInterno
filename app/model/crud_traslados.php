<?php 
require_once('../model/vinculo.php');
require __DIR__ . '/vendor/autoload.php';//Correo

class CrudTraslados{
	
//***************************************************************************************//
//******************************* SQL PARA CREAR traslado *******************************//
//***************************************************************************************//

		public function crearTraslado($create){
			$db=Conectar::acceso();
			$residuo = $create->getFuncionario_final();			
			$fechaTraslado = $create->getFecha_traslado();			
			$activoTraslado = $create->getActivo_traslado();			
			$descripcionTraslado = $create->getDescripcion_traslado();			
			$nombre = $create->getNombre();			
			
			$crea_traslado=$db->prepare('INSERT INTO traslados(funcionario_inicial, fecha_asignado, funcionario_final, fecha_traslado, activo_traslado, descripcion_traslado, estado_traslado )VALUES(:t_funcionarioI, :t_fechaA, :t_funcionarioF, :t_fechaT, :t_activo, :t_descripcion, :estado)');
			$crea_traslado->bindValue('t_funcionarioI',$create->getFuncionario_inicial());
			$crea_traslado->bindValue('t_fechaA',$create->getFecha_inicial());
			$crea_traslado->bindValue('t_funcionarioF',$create->getFuncionario_final());
            $crea_traslado->bindValue('t_fechaT',$create->getFecha_traslado());
            $crea_traslado->bindValue('t_activo',$create->getActivo_traslado());
			$crea_traslado->bindValue('t_descripcion',$create->getDescripcion_traslado());            
			$crea_traslado->bindValue('estado',3);            
			$crea_traslado->execute();

			if ($crea_traslado) {

				if($residuo == '071101005')
					$estados = 11;	
				else 
				    $estados = 14;			   		

				$modifica_responsable=$db->prepare('UPDATE activos_internos SET responsable_activo=:responsable, fecha_asignacion=:fecha_traslado, estado_activo=:estadoA WHERE id_activo=:t_activo');
				$modifica_responsable->bindValue('t_activo',$create->getActivo_traslado());
				$modifica_responsable->bindValue('responsable',$create->getFuncionario_final());
				$modifica_responsable->bindValue('fecha_traslado',$create->getFecha_traslado());
				$modifica_responsable->bindValue('estadoA',$estados);
				

				
				$modifica_responsable->execute();

				$colsultar_usuario=$db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
                          $colsultar_usuario->bindValue('usuario', $create->getNombre());
                          $colsultar_usuario->execute();
                          $filtro=$colsultar_usuario->fetch(PDO::FETCH_ASSOC);
                          $id_usuario=$filtro['id_usuario'];
                           $funcion_realizada = "El usuario realizo un traslado de un activo, el activo : ".$create->getActivo_traslado()." se traslado a : ".$residuo;
                           $inserta_funcion=$db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                           $inserta_funcion->bindValue('id_usuario',$id_usuario);
                           $inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
                           $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
                           $inserta_funcion->execute();
			}
		}






//***************************************************************************************//
//******************************* SQL PARA CREAR ACEPTAR TRASLADO *******************************//
//***************************************************************************************//


	public function anulaTraslado($create){

		$db=Conectar::acceso();
		$lastUsertivo = $create->getFuncionario_inicial();
		$activo = $create->getActivo_traslado()	;
			$acepta_traslado=$db->prepare('UPDATE traslados SET estado_traslado=6 WHERE funcionario_final =:usuario_inicial AND activo_traslado=:id_activo ORDER BY id_traslado DESC LIMIT 1');
			$acepta_traslado->bindValue('usuario_inicial', $lastUsertivo );          
			$acepta_traslado->bindValue('id_activo', $activo );          
			$acepta_traslado->execute();
			if ($acepta_traslado) {
					echo 1;
				}else{
					echo 2;
				}
	}
//***************************************************************************************//
//******************************* SQL PARA CREAR ACEPTAR TRASLADO *******************************//
//***************************************************************************************//

		public function aceptaTraslado($create){

			$db=Conectar::acceso();
			$activo = $create->getId_traslado();	
			$fechaAsignacion = $create->getFecha_traslado();
			$colsultar_activo=$db->prepare('SELECT id_activo, responsable_activo, nombre_activo from activos_internos where codigo_activo =:codigo_activoA');
            $colsultar_activo->bindValue('codigo_activoA', $activo);
            $colsultar_activo->execute();
            	$filtro=$colsultar_activo->fetch(PDO::FETCH_ASSOC);		
				$id_activo = $filtro['id_activo'];
				$responsable_activo = $filtro['responsable_activo'];
				$nombre_activo = $filtro['nombre_activo'];
				if ($id_activo != 0) {
					$acepta_traslado=$db->prepare('UPDATE traslados SET estado_traslado=14 WHERE activo_traslado =:id_activo ORDER BY id_traslado DESC LIMIT 1');
					$acepta_traslado->bindValue('id_activo', $id_activo );          
					$acepta_traslado->execute();
				}
					if ($acepta_traslado) {
						$funcion_realizada = "El usuario ".$responsable_activo." acepto el traslado del activo : ".$activo." ";
                           	$inserta_funcion=$db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                           	$inserta_funcion->bindValue('id_usuario', null);
                        	$inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
                        	$inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
                        	$inserta_funcion->execute();
							$this->correoTraslado($activo, $responsable_activo, $fechaAsignacion, $nombre_activo);
						echo 1;
					}else{
						echo 2;
					}
		}

		public function consultarActivosPendientesFuncionario($create) {
			$db=Conectar::acceso();// se cambia conectar::acceso() a Conexion::acceso() 
			$lista_activos = [];
			$buscarIdentidad = $db->prepare("SELECT id_activo FROM activos_internos WHERE codigo_activo=:activo");
			$buscarIdentidad->bindValue('activo', $create->getId_traslado());
			$buscarIdentidad->execute();
		
			$resultado = $buscarIdentidad->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $fila) {
				// echo $fila['id_activo'];
				$consultar_activo = $db->prepare("SELECT * FROM traslados where activo_traslado=:activo and estado_traslado=:estado");
				$consultar_activo->bindValue('activo', $fila['id_activo']); // se agrega ['id_activo'] a $fila
				$consultar_activo->bindValue('estado', 3);
				$consultar_activo->execute();
				if ($consultar_activo->rowCount() > 0) { // se cambia $colsultar_activo a $consultar_activo y se usa rowCount() para verificar si la consulta devuelve filas
					echo 2;
				} else {
					echo 1;
				}
			}
		}
		



//****************************************************************************************//
//**************************** SQL PARA CONSULTAR trasladoS ******************************//
//****************************************************************************************//

		public function consultarTraslados(){
			$db=conectar::acceso();
			$lista_traslados=[];
			$consultar_traslado=$db->query('SELECT id_traslado, funcionario_inicial, fecha_asignado, funcionario_final, fecha_traslado, activo_traslado');

			foreach ($consultar_traslado->fetchAll() as $listado) {
				$consulta = new traslado();
				$consulta->setId_traslado($listado['id_traslado']);
				$consulta->setFuncionario_inicial($listado['funcionario_inicial']);	
				$consulta->setFecha_inicial($listado['fecha_asignado']);	
                $consulta->setFuncionario_final($listado['funcionario_final']);
				$consulta->setFecha_traslado($listado['fecha_traslado']);	
				$consulta->setActivo_traslado($listado['activo_traslado']);	
				
				$lista_traslados[]=$consulta;	
			}
			return $lista_traslados;
		}


//****************************************************************************************//
//**************************** ENVIA CORREO DE TRASLADO ******************************//
//****************************************************************************************//


		public function correoTraslado($activo, $responsable_activo, $fechaAsignacion, $nombre_activo ){
			$db=Conectar::acceso();
			$buscaFuncionario=$db->prepare('SELECT nombre, mail, mail2 FROM funcionarios WHERE identificacion=:usuario');
			$buscaFuncionario->bindvalue('usuario', $responsable_activo);
			$buscaFuncionario->execute();
			$datos = $buscaFuncionario->Fetch(PDO::FETCH_ASSOC);
			$nombreFuncionario = $datos['nombre'];
			$mail1 = $datos['mail'];
			$mail2 = $datos['mail2'];




            $mail = new PHPMailer(true); // Passing `true` enables exceptions
            try {
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'no-responder@helisa.com'; // SMTP username
            $mail->Password = 'jkO5w6NqsJf7jRCop1X*#*'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to
            $mail->setFrom('no-responder@helisa.com');
            $mail->addAddress("$mail1");
            $mail->addAddress("$mail2");					
            $mail->isHTML(true); // Set email format to HTML
        
            $cuerpo="<style type='text/css'> 
            *{ 
                font-size: 15px;
            }
            p{
                margin-top:5%;
            }
            table, th, td {
                border: 1px solid;
            }
            table {
                width: 85%;
                border-collapse: collapse;
            }
            thead {
                background-color: #e83e8c;
            }
            </style>";
            
            $cuerpo.= "<p>Cordial saludo. ". $nombreFuncionario ."<br>
			De acuerdo a la aceptación realizada en la plataforma de Soporte Interno <br>
			El presente correo tiene como fin reconfirmar la aceptación que usted a realizado de los siguientes activos que le han sido asignados, que le permitirá el desarrollo de sus funciones en la compañía:</p><br>";
            $cuerpo.="<div><table> <thead> <th>Nombre del activo</th><th>Cod. Activo</th><th>Fecha traslado</th> </thead> <tbody>";
			$cuerpo .= "<tr><td>". $nombre_activo." </td><td>".$activo."</td><td>".$fechaAsignacion."</td></tr>";
            $cuerpo.="</tbody></table></div> <br><br>";
			$cuerpo.='<strong>CLAUSULA DE COMPROMISO</strong> <br><br>


			
			- <strong>ITEM DE RESPONSABILIDAD</strong>: <p>Como trabajador de Proasistemas, recibo los activos y/o inventarios relacionados en la
			presenta acta y sus anexos a conformidad, en buen estado y acepto que he revisado que todos se
			encuentren funcionando los cuales estarán bajo mi responsabilidad, les daré el uso y trato adecuado al
			desempeño de mis funciones y la destinación prevista para cada uno de ellos. Asumiré el daño o la pérdida
			de los mismos originados por mi negligencia, mal uso, falta de control o incumplimiento de los instructivos
			y reglamentos definidos para la conservación y custodia de los mismos. Me comprometo a informar
			oportunamente al Departamento de Administración sobre cualquier desplazamiento, siniestro,
			reparación, traslado, reintegro, cambio de responsable temporal o definitivo, por medio de los formatos
			respectivos y sobre cualquier situación que ponga en inminente riesgo los bienes de la empresa. Se
			considera falta grave por el Reglamento Interno de Trabajo que por mal manejo de los activos o bienes
			de la empresa se dañen o pierdan y en tal evento autorizo a la empresa efectuar el descuento
			correspondiente al valor de reposición del bien afectado, deduciéndolo de mis salarios, prestaciones
			sociales o eventuales indemnizaciones a mi favor.</p>
			<p>En caso de que usted no haya realizado la aceptación de los activos relacionados en el cuadro anterior comuníquese
			de forma INMEDIATA con su jefe directo y/o con el departamento de tecnología y/o administración, de lo contrario 
			se dará por aprobada la aceptación realizada.</p><br><br>


			<strong>RECOMENDACIONES PARA EL USO DE LOS ACTIVOS FIJOS:</strong><br><br>
			Los elementos entregados son frágiles y requieren los siguientes cuidados por parte del empleado con el propósito de alargar su vida útil.<br><br>
			- No halar<br>
			- No golpear<br>
			- No mojar<br>
			- Desconectar si presenta algún daño eléctrico<br>
			- No comer o beber en su puesto de trabajo o escritorio, para evitar derrames y daños en los equipos o<br>
			muebles de oficina.<br>
			- Siéntese de forma correcta en las sillas giratorias, no coloque los pies sobre la base o las rodachinas y mucho menos en el asiento; los zapatos, en especial las suelas alojan compuestos que pueden ensuciar las sillas o en el caso de las mujeres (tacones) pueden dañar el tapizado o la estructura.<br><br>
			<strong><p></p>En caso de presentar alguna novedad referente al activo que acaba de aceptar por favor genere el reporte de forma INMEDIATA de la siguiente forma:<br>
			Activos tecnológicos: Genere un ticket bajo la categoría "Soporte sobre equipos tecnológicos" seleccionado el número del activo sobre el cual tiene la novedad e indique la observación relacionada con el activo recibido.
			Activos Administrativos. Envié correo notificando la novedad sobre el activo asignado a la dirección de correo administracion@helisa.com.</p></strong><br><br>
			El empleado ha recibido instrucciones precisas para el correcto uso de los activos';
            $body = utf8_decode($cuerpo);
            $subject = "Aceptación entrega de activos tecnológicos y/o de tipo administrativo";
			$subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
            $mail->Subject = $subject;
            $mail->MsgHTML($body);
            $mail->send();

            } 
            catch (Exception $e){ 
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo; 
            }

        }
}

 ?>