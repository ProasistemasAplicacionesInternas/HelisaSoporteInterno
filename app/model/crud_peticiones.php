<?php
require_once('../model/vinculo.php');
require __DIR__ . '/vendor/autoload.php';


class CrudPeticiones
{

	//********************************************************************************//
	//***********SQL PARA LA CREACION DE UNA PETICION DE FUNCIONARIO******************//
	//********************************************************************************//

	public function crearPeticiones($create)
	{
		$db = Conectar::acceso();
		$crea_peticion = $db->prepare('INSERT INTO peticiones(fecha_peticion, usuario, estado, categoria, descripcion, imagen, imagen2, imagen3, activo,nivel_encuesta)
        VALUES(:fecha_peticion, :usuario, :estado, :categoria, :descripcion, :imagen, :imagen2, :imagen3, :activo, :x)');

		$crea_peticion->bindValue('fecha_peticion', $create->getP_fechapeticion());
		$crea_peticion->bindValue('usuario', $create->getP_usuario());
		$crea_peticion->bindValue('estado', $create->getP_estado());
		$crea_peticion->bindValue('categoria', $create->getP_categoria());
		$crea_peticion->bindValue('descripcion', $create->getP_descripcion());
		$crea_peticion->bindValue('imagen', $create->getP_cargarimagen());
		$crea_peticion->bindValue('imagen2', $create->getP_cargarimagen2());
		$crea_peticion->bindValue('imagen3', $create->getP_cargarimagen3());
		$crea_peticion->bindValue('activo', $create->getP_activo());
		$crea_peticion->bindValue('x', 0);
		$crea_peticion->execute();

		$colsultar_usuario = $db->prepare('SELECT identificacion from funcionarios where usuario =:usuario');
		$colsultar_usuario->bindValue('usuario', $create->getP_usuario());
		$colsultar_usuario->execute();
		$filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
		$id_funcionario = $filtro['identificacion'];
		$funcion_realizada = "El funcionario Realizo una peticion de categoria: " . $create->getP_categoria();
		$inserta_funcion = $db->prepare("INSERT INTO funciones_funcionarios (codigo, id_funcionario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_funcionario , curdate() , :funcion_realizada ,:ip )");
		$inserta_funcion->bindValue('id_funcionario', $id_funcionario);
		$inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
		$inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
		$inserta_funcion->execute();

		echo 1;
	}


	//****************************************************************************************//
	//********* SQL PARA LA CONSULTAR LAS PETICIONES DEL FUNCIONARIO DESDE SU USUARIO ********//
	//****************************************************************************************//

	public function consultarPeticionesFuncionario()
	{
		$db = conectar::acceso();
		$lista_peticiones = [];
		$consultar_peticion = $db->prepare('SELECT  numero_peticion, fecha_peticion,peticiones.descripcion, categoria, fecha_atendido, estado, usuario_atiende, conclusiones, categorias.nombre_categoria, estado.descripcion AS nombreestado,revisado FROM peticiones LEFT JOIN categorias ON categorias.id_categoria=peticiones.categoria LEFT JOIN estado ON estado.id_estado=peticiones.estado WHERE usuario=:funcionario AND (estado=:estadoN OR estado=:estadoR OR estado=:estadoP OR estado=:estadoS OR estado=:estadoT) AND revisado=:noRevisado ORDER BY nombreestado DESC');
		$consultar_peticion->bindValue('funcionario', $_SESSION['usuario']);
		$consultar_peticion->bindValue('estadoN', '1');
		$consultar_peticion->bindValue('estadoR', '2');
		$consultar_peticion->bindValue('estadoP', '3');
		$consultar_peticion->bindValue('estadoT', '4');
		$consultar_peticion->bindValue('estadoS', '8');
		$consultar_peticion->bindValue('noRevisado', 1);
		$consultar_peticion->execute();
		foreach ($consultar_peticion->fetchAll() as $listado) {
			$consulta = new Peticion();
			$consulta->setP_nropeticion($listado['numero_peticion']);
			$consulta->setP_fechapeticion($listado['fecha_peticion']);
			$consulta->setP_descripcion($listado['descripcion']);
			$consulta->setP_fechaatendido($listado['fecha_atendido']);
			$consulta->setP_estado($listado['nombreestado']);
			$consulta->setP_categoria($listado['nombre_categoria']);
			$consulta->setP_conclusiones($listado['conclusiones']);
			$consulta->setP_usuarioatiende($listado['usuario_atiende']);
			$consulta->setRevisado($listado['revisado']);
			$lista_peticiones[] = $consulta;
		}
		return $lista_peticiones;
	}

	//***********************************************************************************//
	//************** SQL PARA LA CONSULTAR LAS PETICIONES PENDIENTES DE ATENCION ********//
	//***********************************************************************************//

	public function peticionesFinalizadas()
	{
		$db = conectar::acceso();
		$lista_peticiones = [];
		$consultar_peticion = $db->prepare('SELECT  numero_peticion, fecha_peticion, usuario,categorias.nombre_categoria, descripcion, fecha_atendido, usuario_atiende, conclusiones FROM peticiones LEFT JOIN categorias ON id_categoria=categoria WHERE estado=:estadoD OR estado=:estadoC');

		$consultar_peticion->bindValue('estadoC', '4');
		$consultar_peticion->bindValue('estadoD', '2');
		$consultar_peticion->execute();

		foreach ($consultar_peticion->fetchAll() as $listado) {
			$consulta = new Peticion();
			$consulta->setP_nropeticion($listado['numero_peticion']);
			$consulta->setP_fechapeticion($listado['fecha_peticion']);
			$consulta->setP_usuario($listado['usuario']);
			$consulta->setP_categoria($listado['nombre_categoria']);
			$consulta->setP_descripcion($listado['descripcion']);
			$consulta->setP_fechaatendido($listado['fecha_atendido']);
			$consulta->setP_usuarioatiende($listado['usuario_atiende']);
			$consulta->setP_conclusiones($listado['conclusiones']);

			$lista_peticiones[] = $consulta;
		}
		return $lista_peticiones;
	}


	//***********************************************************************************//
	//*********** SQL PARA LA CONSULTAR LAS PETICIONES NUEVAS Y PENDIENTES **************//
	//********** PARA VISUALIZAR LOS SOPORTES DESDE LA ATENCION DEL ASESOR **************//
	//***********************************************************************************//

	public function consultarPeticiones()
	{
		$db = conectar::acceso();
		$lista_peticiones = [];
		$consultar_peticion = $db->prepare('SELECT  numero_peticion, fecha_peticion, peticiones.usuario, fecha_atendido, peticiones.estado, peticiones.categoria, peticiones.descripcion, 
			peticiones.imagen, activos_internos.nombre_activo, activos_internos.codigo_activo, funcionarios.extension, funcionarios.area,funcionarios.mail, areas.descripcion 
			AS descripcion1, categorias.nombre_categoria, estado.descripcion AS nombreestado, conclusiones, imagen2, imagen3 
            FROM peticiones 
            LEFT JOIN funcionarios ON funcionarios.usuario=peticiones.usuario 
            LEFT JOIN areas ON id_area=area 
            LEFT JOIN categorias ON id_categoria=categoria LEFT JOIN estado ON id_estado=peticiones.estado 
            LEFT JOIN activos_internos ON id_activo=activo 
            WHERE (peticiones.estado= :estadoU OR peticiones.estado= :estadoT) ');
		$consultar_peticion->bindValue('estadoU', '1');
		$consultar_peticion->bindValue('estadoT', '3');
		$consultar_peticion->execute();
		foreach ($consultar_peticion->fetchAll() as $listado) {
			$consulta = new Peticion();
			$consulta->setP_nropeticion($listado['numero_peticion']);
			$consulta->setP_fechapeticion($listado['fecha_peticion']);
			$consulta->setP_usuario($listado['usuario']);
			$consulta->setP_fechaatendido($listado['fecha_atendido']);
			$consulta->setP_estado($listado['nombreestado']);
			$consulta->setP_categoria($listado['nombre_categoria']);
			$consulta->setP_descripcion($listado['descripcion']);
			$consulta->setP_cargarimagen($listado['imagen']);
			$consulta->setP_cargarimagen2($listado['imagen2']);
			$consulta->setP_cargarimagen3($listado['imagen3']);
			$consulta->setP_activo($listado['nombre_activo']);
			$consulta->setP_codigoactivo($listado['codigo_activo']);
			$consulta->setP_area($listado['descripcion1']);
			$consulta->setP_Extension($listado['extension']);
			$consulta->setP_correo($listado['mail']);
			$consulta->setP_conclusiones($listado['conclusiones']);


			$lista_peticiones[] = $consulta;
		}
		return $lista_peticiones;
	}

	//*************************************************************************************//
	//************** SQL PARA LA MODIFICAR DE UNA PETICION DE FUNCIONARIO *****************//
	//***** SE UTILIZA PARA GUARDAR LAS CONCLUSIONES DESPUES DE REALIZADO EL SOPORTE ******//
	//*************************************************************************************//

	public function modificarPeticiones($update)
	{

		$estado_peto = $update->getP_estado();

		$correo = $update->getP_correo();
		$peticion = $update->getP_nropeticion();
		$archivo = $update->getArchivos();

		if ($estado_peto == 2) {
			$db = conectar::acceso();
			$modificar_peticion = $db->prepare('UPDATE peticiones SET  estado=:p_estado, conclusiones=:p_conclusiones, imagen2=:archivo,  fecha_atendido=:p_fechaatendido, usuario_atiende=:p_usuarioatiende   WHERE numero_peticion=:p_numeroPeticion');
			$modificar_peticion->bindValue('p_numeroPeticion', $update->getP_nropeticion());
			$modificar_peticion->bindValue('p_estado', $update->getP_estado());
			$modificar_peticion->bindValue('p_conclusiones', $update->getP_conclusiones());
			$modificar_peticion->bindValue('p_fechaatendido', $update->getP_fechaatendido());
			$modificar_peticion->bindValue('p_usuarioatiende', $update->getP_usuarioatiende());
			$modificar_peticion->bindValue('archivo', $update->getArchivos());

			$modificar_peticion->execute();

			$colsultar_usuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
			$colsultar_usuario->bindValue('usuario', $update->getP_usuarioatiende());
			$colsultar_usuario->execute();
			$filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
			$id_usuario = $filtro['id_usuario'];
			$funcion_realizada = "El usuario atiendio con exito el siguiente ticket: " . $update->getP_nropeticion();
			$inserta_funcion = $db->prepare("INSERT INTO funciones (id_usuario, fecha_registro, funcion_realizada,IP) VALUES (:id_usuario , curdate() , :funcion_realizada ,:ip )");
			$inserta_funcion->bindValue('id_usuario', $id_usuario);
			$inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
			$inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
			$inserta_funcion->execute();


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
				$mail->addAddress("$correo");
				$mail->isHTML(true); // Set email format to HTML
				$subjects = "Conclusión infraestructura";
				$cuerpo = "<style type='text/css'> *

							{ 
								font-size: 15px;
							}
							#uno,#dos,#tres,#cuatro,#cinco
							{
							 width: 38px!important;height: 38px!important;border-radius: 50%!important;background: #ffffff!important;border: 2px solid #000!important;color: #000!important;text-align: center!important;font-weight: bold!important;padding: 1%;margin: 0% 2%;cursor: pointer !important;
							}
							#uno:hover,#dos:hover,#tres:hover,#cuatro:hover,#cinco:hover

							{
							 border-radius: 0% !important;box-shadow: 2px 2px 5px #58023a;
							}
							h5
							{
								font-weight: 100; margin: 10px 0px;
							}
							textarea
							{
								width: 60%;height: 100px;margin-bottom: 2%; border:0;padding: 6px;
							}
							#segundo
							{
								background: #a00f6d;padding: 12px;text-align: center;margin: 3% 0%;
							}
							input
							{
								border:0;
							}
							b
							{
								width:30%;
							}
							#div_dos,#div_tres,#div_cuatro,#div_cinco,#div_seis
							{ 
								display:flex;
							}
							p
							{
								margin-top:5%;
							}
							</style>";
				$cuerpo .= "<div><div>";
				$cuerpo .= "<h5>Señor(a) " . $update->getP_usuario() . " su ticket con numero: " . $peticion . ", ha sido resuelto por uno de nuestro asesores. A continuación se daran mas detalles del proceso.</h5>";
				$cuerpo .= "</div><div id='div_dos'>";
				$cuerpo .= "<h5><b>Atendido por : </b></h5><h5 id='usuario'>" . $update->getP_usuarioatiende() . "</h5>";
				$cuerpo .= "</div><div id='div_tres'>";
				$cuerpo .= "<h5><b>Fecha en la cual el soporte fue creado : </b></h5><h5 id='fecha_solicitud'>" . $update->getP_fechaatendido() . "</h5>";
				$cuerpo .= "</div><div id='div_cuatro'>";
				$cuerpo .= "<h5><b>Resumen del problema : </b></h5><h5 id='solicitud'>" . $update->getP_descripcion() . "</h5>";
				$cuerpo .= "</div><div id='div_cinco'>";
				$cuerpo .= "<h5><b>La conclusion que ha dado el asesor : </b></h5><h5 id='conclusion'>" . html_entity_decode($update->getP_conclusiones()) . "</h5>";
				$cuerpo .= "</div><div id='div_seis'>";
				$cuerpo .= "<p><i><b>Por favor, califica el servicio prestado de 1 a 5, donde 1 es poco satisfactorio y 5 es muy satisfactorio.</b>Recuerde que al dar click en cualquiera de los botones, el valor se guardara automaticamente y solo guardara un resultado.</i></p>";
				$cuerpo .= "</div></div>";
				$cuerpo .= "<div class='row' id='segundo'><div>

				<a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticion.php?encuesta=encuesta&nro=1&peticion=" . $peticion . "'><input type='submit' id='uno' value='1'></a>

				<a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticion.php?encuesta=encuesta&nro=2&peticion=" . $peticion . "'><input type=submit id=dos value=2></a>

				<a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticion.php?encuesta=encuesta&nro=3&peticion=" . $peticion . "'><input type=submit id=tres value=3></a>
				<a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticion.php?encuesta=encuesta&nro=4&peticion=" . $peticion . "'><input type=submit id=cuatro value=4></a>

				<a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticion.php?encuesta=encuesta&nro=5&peticion=" . $peticion . "'><input type=submit id=cinco value=5></a>
							</div>
							</div>";
				$body = utf8_decode($cuerpo);
				$subject = utf8_decode($subjects);
				$mail->Subject = $subject;
				$mail->MsgHTML($body);

				$existencia_archivo = "../../temporal/" . $archivo;

				if (file_exists($existencia_archivo)) {
					$mail->addAttachment("../../temporal/" . $archivo);
				} else {
				}

				$mail->send();
			} catch (Exception $e) {
				echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}
		} else {
			$db = conectar::acceso();
			$modificar_peticion = $db->prepare('UPDATE peticiones SET  estado=:p_estado, conclusiones=:p_conclusiones, fecha_atendido=:p_fechaatendido, usuario_atiende=:p_usuarioatiende   WHERE numero_peticion=:p_numeroPeticion');
			$modificar_peticion->bindValue('p_numeroPeticion', $update->getP_nropeticion());
			$modificar_peticion->bindValue('p_estado', $update->getP_estado());
			$modificar_peticion->bindValue('p_conclusiones', $update->getP_conclusiones());
			$modificar_peticion->bindValue('p_fechaatendido', $update->getP_fechaatendido());
			$modificar_peticion->bindValue('p_usuarioatiende', $update->getP_usuarioatiende());
			$modificar_peticion->execute();
		}
	}

	//****************************************************************************************//
	//******* SQL PARA CAMBIAR EL ESTADO DE LA PETICION CUANDO LA SELECCIONA EL ASESOR *******//
	//****************************************************************************************//

	public function cambiaEstado($state)
	{

		$db = conectar::acceso();

		$actualiza_estado = $db->prepare("UPDATE peticiones SET estado=:estado, fecha_atendido=:fecha_atendido, usuario_atiende=:usuario_atiende WHERE numero_peticion=:numero_peticion");
		$actualiza_estado->bindValue('numero_peticion', $state->getP_nropeticion());
		$actualiza_estado->bindValue('estado', $state->getP_estado());
		$actualiza_estado->bindValue('fecha_atendido', $state->getP_fechaatendido());
		$actualiza_estado->bindValue('usuario_atiende', $state->getP_usuarioatiende());
		$actualiza_estado->execute();

		$colsultar_usuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
		$colsultar_usuario->bindValue('usuario', $state->getP_usuarioatiende());
		$colsultar_usuario->execute();
		$filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
		$id_usuario = $filtro['id_usuario'];
		$funcion_realizada = "El usuario cambio el estado del  ticket: " . $state->getP_nropeticion() . "a estado: " . $state->getP_estado();
		$inserta_funcion = $db->prepare("INSERT INTO funciones (id_usuario, fecha_registro, funcion_realizada,IP) VALUES (:id_usuario , curdate() , :funcion_realizada ,:ip )");
		$inserta_funcion->bindValue('id_usuario', $id_usuario);
		$inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
		$inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
		$inserta_funcion->execute();
	}

	//***********************************************************************************//
	//************** SQL PARA LA CONSULTAR TODAS LAS PETICIONES *************************//
	//***********************************************************************************//

	public function peticionesSeleccionadas()
	{
		$db = conectar::acceso();
		$lista_peticiones = [];
		$consultar_peticion = $db->prepare('SELECT  numero_peticion, fecha_peticion, peticiones.usuario, fecha_atendido, peticiones.estado, peticiones.categoria, peticiones.descripcion, imagen, activo, funcionarios.extension, funcionarios.area,funcionarios.mail, areas.descripcion AS descripcion1, categorias.nombre_categoria, estado.descripcion AS nombreestado, conclusiones, usuario_atiende FROM peticiones LEFT JOIN funcionarios ON funcionarios.usuario=peticiones.usuario LEFT JOIN areas ON id_area=area LEFT JOIN categorias ON id_categoria=categoria LEFT JOIN estado ON id_estado=peticiones.estado WHERE peticiones.estado=:estadoO');
		$consultar_peticion->bindValue('estadoO', '8');
		$consultar_peticion->execute();

		foreach ($consultar_peticion->fetchAll() as $listado) {
			$consulta = new Peticion();
			$consulta->setP_nropeticion($listado['numero_peticion']);
			$consulta->setP_fechapeticion($listado['fecha_peticion']);
			$consulta->setP_usuario($listado['usuario']);
			$consulta->setP_fechaatendido($listado['fecha_atendido']);
			$consulta->setP_estado($listado['nombreestado']);
			$consulta->setP_categoria($listado['nombre_categoria']);
			$consulta->setP_descripcion($listado['descripcion']);
			$consulta->setP_cargarimagen($listado['imagen']);
			$consulta->setP_activo($listado['activo']);
			$consulta->setP_area($listado['descripcion1']);
			$consulta->setP_Extension($listado['extension']);
			$consulta->setP_correo($listado['mail']);
			$consulta->setP_conclusiones($listado['conclusiones']);
			$consulta->setP_usuarioatiende($listado['usuario_atiende']);

			$lista_peticiones[] = $consulta;
		}
		return $lista_peticiones;
	}

	//***********************************************************************************//
	//************** SQL PARA LA CONSULTAR TODAS LAS PETICIONES *************************//
	//***********************************************************************************//

	public function liberar($liberar)
	{
		$db = conectar::acceso();
		$liberar_soporte = $db->prepare("UPDATE peticiones SET estado=:estadoL, usuario_atiende=:usuarioL WHERE numero_peticion=:numero_peticionL");
		$liberar_soporte->bindValue('numero_peticionL', $liberar->getP_nropeticion());
		$liberar_soporte->bindValue('estadoL', $liberar->getP_estado());
		$liberar_soporte->bindValue('usuarioL', $liberar->getP_usuarioatiende());
		$liberar_soporte->execute();
		$colsultar_usuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
		$colsultar_usuario->bindValue('usuario', $liberar->getP_usuarioatiende());
		$colsultar_usuario->execute();
		$filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
		$id_usuario = $filtro['id_usuario'];
		$funcion_realizada = "El usuario libero el  ticket: " . $liberar->getP_nropeticion();
		$inserta_funcion = $db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES ('0', :id_usuario , curdate() , :funcion_realizada ,:ip )");
		$inserta_funcion->bindValue('id_usuario', $id_usuario);
		$inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
		$inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
		$inserta_funcion->execute();
	}

	//***********************************************************************************//
	//********************* SQL PARA LA COMENTAR LAS PETICIONES *************************//
	//***********************************************************************************//

	public function comentarioPeticion($insertar)
	{
		$db = conectar::acceso();
		$comentar = $db->prepare('INSERT INTO comentarios_peticiones(id_peticion,responsable,fecha_registro,comentario) VALUES(:id_peticiones,:responsables,:fecha_registros,:comentarios)');
		$comentar->bindValue('id_peticiones', $insertar->getP_nropeticion());
		$comentar->bindValue('responsables', $insertar->getP_usuario());
		$comentar->bindValue('fecha_registros', $insertar->getP_fechapeticion());
		$comentar->bindValue('comentarios', $insertar->getComentario());
		$comentar->execute();

		if ($comentar)
			echo 1;
		else
			echo 0;
	}

	//***********************************************************************************//
	//***************************** SQL PARA LISTAR COMENTARIOS *************************//
	//***********************************************************************************//

	public function listaComentario($id_peticiones)
	{
		$_POST['id_peticion'];
		$lista_comentario = [];
		$db = conectar::acceso();
		$lista = $db->prepare('SELECT id_peticion,comentario FROM comentarios_peticiones WHERE id_peticion=:peticiones');
		$lista->bindValue('peticiones', $id_peticiones);
		$lista->execute();
		foreach ($lista->fetchAll() as $listas) {

			$consulta = new Peticion();
			$consulta->setPeticion_co($listas['id_peticion']);
			$consulta->setComentario($listas['comentario']);

			$lista_comentario[] = $consulta;
		}
		return $lista_comentario;
	}


	public function encuesta($peticion)
	{

		$db = conectar::acceso();
		$consulta_encuesta = $db->prepare('SELECT nivel_encuesta FROM peticiones WHERE numero_peticion =:numero_peticion');
		$consulta_encuesta->bindValue('numero_peticion', $peticion->getP_nropeticion());
		$consulta_encuesta->execute();
		$filter = $consulta_encuesta->fetch(PDO::FETCH_ASSOC);
		$nivel_encuesta = $filter['nivel_encuesta'];
		if ($nivel_encuesta != 0) {
			echo 'No se realiza el cambio';
		} else {
			$insertar_encuesta = $db->prepare('UPDATE peticiones SET nivel_encuesta=:nivel WHERE numero_peticion=:numero_peticion');
			$insertar_encuesta->bindValue('numero_peticion', $peticion->getP_nropeticion());
			$insertar_encuesta->bindValue('nivel', $peticion->getestado_encuesta());
			$insertar_encuesta->execute();
		}
	}

	public function marcarRevisado($marcar)
	{
		$db = conectar::acceso();
		$revisando = $db->prepare('UPDATE peticiones SET revisado=:revisado WHERE numero_peticion=:cod_peticion');
		$revisando->bindValue('revisado', 2);
		$revisando->bindValue('cod_peticion', $marcar->getP_nropeticion());
		$revisando->execute();
		if ($revisando) {
			echo 1;
		} else {
			echo 2;
		}
	}

	public function redireccionaPeticiones($redirect)
	{
		$db = conectar::acceso();
		$redireccionando = $db->prepare('INSERT INTO peticiones_mai(descripcion_peticion, usuario_creacion, fecha_peticion, estado_peticion, producto_mai, imagen, conclusiones, imagen2, imagen3)VALUES(:descripcion_peticion, :usuario_creacion, :fecha_peticion, :estado_peticion, :producto_mai, :imagen, :conclusiones, :imagen2, :imagen3)');
		$redireccionando->bindValue('descripcion_peticion', $redirect->getP_descripcion());
		$redireccionando->bindValue('usuario_creacion', $redirect->getP_usuario());
		date_default_timezone_set('America/Bogota');
		$redireccionando->bindValue('fecha_peticion', $redirect->getP_fechapeticion());
		$redireccionando->bindValue('estado_peticion', 1);
		$redireccionando->bindValue('producto_mai', 15);
		$redireccionando->bindValue('imagen', $redirect->getP_cargarimagen());
		$redireccionando->bindValue('imagen2', $redirect->getP_cargarimagen2());
		$redireccionando->bindValue('imagen3', $redirect->getP_cargarimagen3());
		$redireccionando->bindValue('conclusiones', $redirect->getP_conclusiones());
		$redireccionando->execute();
		if ($redireccionando) {
			$registro = $db->lastInsertId();
			$db = conectar::acceso();
			$modificar_peticion = $db->prepare('UPDATE peticiones SET  estado=:p_estado, conclusiones=:p_conclusiones, fecha_atendido=:p_fechaatendido, usuario_atiende=:p_usuarioatiende, redireccionado=:redireccionado WHERE numero_peticion  =:p_numeroPeticion');
			$modificar_peticion->bindValue('p_numeroPeticion', $redirect->getP_nropeticion());
			$modificar_peticion->bindValue('p_estado', $redirect->getP_estado());
			$modificar_peticion->bindValue('p_conclusiones', $redirect->getP_conclusiones());
			$modificar_peticion->bindValue('p_fechaatendido', $redirect->getP_fechaatendido());
			$modificar_peticion->bindValue('p_usuarioatiende', $redirect->getP_usuarioatiende());
			$modificar_peticion->bindValue('redireccionado', $registro);
			$modificar_peticion->execute();
		}
	}
}
