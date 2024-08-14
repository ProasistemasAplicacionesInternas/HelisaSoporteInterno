<?php
require_once('../model/vinculo.php');
require __DIR__ . '/vendor/autoload.php';

class CrudPeticionesSg
{
    public function crearPeticionesSg($create)
    {
        $db = Conectar::acceso();
        $crea_peticionSg = $db->prepare('INSERT INTO peticiones_sg (fecha_peticion, usuario_creacionsg, estado_peticion, categoria, descripcion_peticionsg, imagen, imagen2, imagen3, imagen4, imagen5) VALUES (:fecha_peticion, :usuario_creacionsg, :estado_peticion, :categoria, :descripcion_peticionsg, :imagen, :imagen2, :imagen3, :imagen4, :imagen5)');
        $crea_peticionSg->bindValue(':fecha_peticion', $create->getfecha_peticionSg());
        $crea_peticionSg->bindValue(':usuario_creacionsg', $create->getusuario_creacionSg());
        $crea_peticionSg->bindValue(':estado_peticion', $create->getestado_peticionSg());
        $crea_peticionSg->bindValue(':categoria', $create->getcategoriaSg());
        $crea_peticionSg->bindValue(':descripcion_peticionsg', $create->getdescripcion_peticionSg());
        $crea_peticionSg->bindValue(':imagen', $create->getimagenPeticionSeguridad1());
        $crea_peticionSg->bindValue(':imagen2', $create->getimagenPeticionSeguridad2());
        $crea_peticionSg->bindValue(':imagen3', $create->getimagenPeticionSeguridad3());
        $crea_peticionSg->bindValue(':imagen4', $create->getimagenPeticionSeguridad4());
        $crea_peticionSg->bindValue(':imagen5', $create->getimagenPeticionSeguridad5());
        $crea_peticionSg->execute();
        $id = $db->lastInsertId();

        $colsultar_usuario = $db->prepare('SELECT identificacion FROM funcionarios WHERE usuario = :usuario_creacionsg');
        $colsultar_usuario->bindValue(':usuario_creacionsg', $create->getusuario_creacionSg());
        $colsultar_usuario->execute();
        $filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
        $id_funcionario = $filtro['identificacion'];
        $funcion_realizada = "El funcionario realizó una petición de categoría: " . $create->getcategoriaSg();
        $inserta_funcion = $db->prepare("INSERT INTO funciones_funcionarios (codigo, id_funcionario, fecha_registro, funcion_realizada, IP) VALUES (0, :id_funcionario, CURDATE(), :funcion_realizada, :ip)");
        $inserta_funcion->bindValue(':id_funcionario', $id_funcionario);
        $inserta_funcion->bindValue(':funcion_realizada', $funcion_realizada);
        $inserta_funcion->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
        $inserta_funcion->execute();

        $clase = new CrudPeticionesSg();
        $insertaObservacion = $clase->insertaObservacion($id, $create->getdescripcion_peticionSg(), $create->getusuario_creacionSg(), $create->getfecha_peticionSg(), $create->getestado_peticionSg());
    }

    public function consultarPeticionesSg()
    {
        $db = conectar::acceso();
        $lista_peticiones = [];
        $consultar_peticionSg = $db->prepare('SELECT id_peticionessg, fecha_peticion, fecha_atencion, usuario_creacionsg, peticiones_sg.descripcion_peticionsg, funcionarios.area, funcionarios.mail, estado.descripcion AS estado_peticion, categorias.nombre_categoria AS categoria, usuario_atencion, conclusiones, funcionarios.area FROM peticiones_sg LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg LEFT JOIN areas ON areas.id_area=funcionarios.area LEFT JOIN categorias ON categorias.id_categoria=peticiones_sg.categoria LEFT JOIN estado ON estado.id_estado=peticiones_sg.estado_peticion WHERE usuario_creacionsg =:funcionario AND (estado_peticion = :estadoN OR estado_peticion =:estadoP OR estado_peticion=:estadoPrc) ORDER BY id_peticionessg DESC;');
        $consultar_peticionSg->bindValue('funcionario', $_SESSION['usuario']);
        $consultar_peticionSg->bindValue('estadoN', '1');
        $consultar_peticionSg->bindValue('estadoP', '3');
        $consultar_peticionSg->bindValue('estadoPrc', '22');
        $consultar_peticionSg->execute();
        foreach ($consultar_peticionSg->fetchAll() as $listado) {
            $consulta = new PeticionSg();
            $consulta->setid_peticionSg($listado['id_peticionessg']);
            $consulta->setfecha_peticionSg($listado['fecha_peticion']);
            $consulta->setdescripcion_peticionSg($listado['descripcion_peticionsg']);
            $consulta->setfecha_atendidoSg($listado['fecha_atencion']);
            $consulta->setestado_peticionSg($listado['estado_peticion']);
            $consulta->setcategoriaSg($listado['categoria']);
            $consulta->setconclusiones_PeticionSg($listado['conclusiones']);
            $consulta->setusuario_atencionSg($listado['usuario_atencion']);
            $consulta->setArea_funcionario($listado['area']);
            $consulta->setUsuario_creacionSg($listado['usuario_creacionsg']);
            $consulta->setEmail_funcionario($listado['mail']);
            $lista_peticiones[] = $consulta;
        }

        return $lista_peticiones;
    }

    public function consultarPeticionesFuncionarioSeguridad()
    {
        $db = conectar::acceso();
        $lista_peticiones = [];
        $consultar_peticion = $db->prepare('SELECT id_peticionessg, categorias.nombre_categoria AS categoria, fecha_peticion, descripcion_peticionsg, estado.descripcion AS estado_peticion, fecha_atencion, usuario_atencion, conclusiones, revisado 
    FROM peticiones_sg 
    LEFT JOIN categorias ON categorias.id_categoria=peticiones_sg.categoria
    LEFT JOIN estado ON estado.id_estado=peticiones_sg.estado_peticion 
    WHERE usuario_creacionsg=:funcionario AND revisado=:noRevisado');
        $consultar_peticion->bindValue('noRevisado', 1);
        $consultar_peticion->bindValue('funcionario', $_SESSION['usuario']);
        $consultar_peticion->execute();
        foreach ($consultar_peticion->fetchAll() as $listado) {
            $consulta = new PeticionSg();
            $consulta->setid_peticionSg($listado['id_peticionessg']);
            $consulta->setcategoriaSg($listado['categoria']);
            $consulta->setfecha_peticionSg($listado['fecha_peticion']);
            $consulta->setdescripcion_peticionSg($listado['descripcion_peticionsg']);
            $consulta->setestado_peticionSg($listado['estado_peticion']);
            $consulta->setfecha_atendidoSg($listado['fecha_atencion']);
            $consulta->setusuario_atencionSg($listado['usuario_atencion']);
            $consulta->setconclusiones_PeticionSg($listado['conclusiones']);
            $consulta->setmarcaRevisadoSg($listado['revisado']);
            $lista_peticiones[] = $consulta;
        }
        return $lista_peticiones;
    }

    public function cambiaEstadoSg($state)
    {

        $db = conectar::acceso();

        $actualiza_estado = $db->prepare("UPDATE peticiones_sg SET estado_peticion=:estado, fecha_atencion=:fecha_atendido, usuario_atencion=:usuario_atiende WHERE id_peticionessg=:numero_peticion");
        $actualiza_estado->bindValue('numero_peticion', $state->getId_peticionSg());
        $actualiza_estado->bindValue('estado', $state->getEstado_peticionSg());
        $actualiza_estado->bindValue('fecha_atendido', $state->getFecha_atendidoSg());
        $actualiza_estado->bindValue('usuario_atiende', $state->getUsuario_atencionSg());
        $actualiza_estado->execute();

        $colsultar_usuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
        $colsultar_usuario->bindValue('usuario', $state->getUsuario_atencionSg());
        $colsultar_usuario->execute();
        $filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
        $id_usuario = $filtro['id_usuario'];
        $funcion_realizada = "El usuario cambio el estado del  caso de seguridad numero: " . $state->getId_peticionSg() . "a estado: " . $state->getEstado_peticionSg();
        $inserta_funcion = $db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
        $inserta_funcion->bindValue('id_usuario', $id_usuario);
        $inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
        $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
        $inserta_funcion->execute();
    }

    public function coloresR($dias, $hora, $mes)
    {
        if (($dias > 0 || $hora >= 8) && $mes == 0) {
            return '#dd9933';
        } else if ($mes > 0) {
            return '#ed7105';
        } else {
            return '#35c3558c';
        }
    }

    public function modificarPeticionesSg($update)
    {
        $db = conectar::acceso();
        $estado = $update->getEstado_peticionSg();
        $codigoSg = $update->getId_peticionSg();
        $fechaAtendido = $update->getFecha_atendidoSg();
        $usuarioCreacion = $update->getUsuario_creacionSg();
        $usuarioAtendido = $update->getUsuario_atencionSg();
        $conclusiones = $update->getConclusiones_peticionSg();


        $correo = $update->getEmail_funcionario(); ///boton resuelto
        if ($estado == 2) {

            $clase = new CrudPeticionesSg();
            $insertaObservacion =  $clase->insertaObservacion($update->getId_peticionSg(), $update->getConclusiones_peticionSg(), $update->getUsuario_atencionSg(), $update->getFecha_atendidoSg(), $update->getEstado_peticionSg());

            $finaliza_solicituSg = $db->prepare('UPDATE peticiones_sg SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, estado_peticion=:estado_peticion WHERE id_peticionessg=:cod_peticion');
            $finaliza_solicituSg->bindValue('cod_peticion', $update->getid_peticionSg());
            $finaliza_solicituSg->bindValue('fecha_atencion', $update->getfecha_atendidoSg());
            $finaliza_solicituSg->bindValue('usuario_atencion', $update->getusuario_atencionSg());
            $finaliza_solicituSg->bindValue('conclusiones', $update->getconclusiones_PeticionSg());
            $finaliza_solicituSg->bindValue('estado_peticion', $update->getestado_peticionSg());
            $finaliza_solicituSg->execute();
            if ($finaliza_solicituSg) {
                $colsultar_usuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
                $colsultar_usuario->bindValue('usuario', $usuarioAtendido);
                $colsultar_usuario->execute();
                $filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
                $id_usuario = $filtro['id_usuario'];
                $funcion_realizada = "El usuario atiendio con exito el siguiente ticket: " . $codigoSg . "del area de Mantenimiento de Aplicaciones internas";

                if ($colsultar_usuario) {
                    $inserta_funcion = $db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                    $inserta_funcion->bindValue('id_usuario', $id_usuario);
                    $inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
                    $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
                    $inserta_funcion->execute();
                    /*************************ESTO ES ENVIO MEDIANTE EL BOTON DE SELECCIONAR*******************************************************************************/

                    if ($inserta_funcion) {
                        $mail = new PHPMailer(true); // Passing `true` enables exceptions
                        try {
                            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'no-responder@helisa.com';                 // SMTP username
                            $mail->Password = 'jkO5w6NqsJf7jRCop1X*#*';                           // SMTP password C3cwrsl6k1DN8am*2021Ftwv2*
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                    // TCP port to connect to
                            $mail->setFrom('no-responder@helisa.com');
                            $mail->addAddress($correo);
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $subjects = "Conclusión Aplicaciones Internas";
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
                            $cuerpo .= "<h5>Señor(a) " . $usuarioCreacion . " su ticket con numero: " . $codigoSg . ", ha sido resuelto por uno de nuestro asesores. A continuación se daran mas detalles del proceso.</h5>";
                            $cuerpo .= "</div><div id='div_dos'>";
                            $cuerpo .= "<h5><b>Atendido por : </b></h5><h5 id='usuario'>" . $usuarioAtendido . "</h5>";
                            $cuerpo .= "</div><div id='div_tres'>";
                            $cuerpo .= "<h5><b>Fecha en la cual el soporte fue creado : </b></h5><h5 id='fecha_solicitud'>" . $fechaAtendido . "</h5>";
                            $cuerpo .= "</div><div id='div_cuatro'>";
                            $cuerpo .= "<h5><b>Resumen del problema : </b></h5><h5 id='solicitud'>" . $update->getdescripcion_peticionSg() . "</h5>";
                            $cuerpo .= "</div><div id='div_cinco'>";
                            $cuerpo .= "<h5><b>La conclusion que ha dado el asesor : </b></h5><h5 id='conclusion'>" . html_entity_decode($update->getconclusiones_PeticionSg()) . "</h5>";
                            $cuerpo .= "</div><div id='div_seis'>";
                            $cuerpo .= "<p><i><b>Por favor, califica el servicio prestado de 1 a 5, donde 1 es poco satisfactorio y 5 es muy satisfactorio.</b>Recuerde que al dar click en cualquiera de los botones, el valor se guardara automaticamente y solo guardara un resultado.</i></p>";
                            $cuerpo .= "</div></div>";
                            $cuerpo .= "<div class='row' id='segundo'><div>

                                <a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticionmai.php?encuesta=encuesta&nro=1&peticion=" . $codigoSg . "'><input type='submit' id='uno' value='1'></a>

                                <a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticionmai.php?encuesta=encuesta&nro=2&peticion=" . $codigoSg . "'><input type=submit id=dos value=2></a>

                                <a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticionmai.php?encuesta=encuesta&nro=3&peticion=" . $codigoSg . "'><input type=submit id=tres value=3></a>
                                <a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticionmai.php?encuesta=encuesta&nro=4&peticion=" . $codigoSg . "'><input type=submit id=cuatro value=4></a>

                                <a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticionmai.php?encuesta=encuesta&nro=5&peticion=" . $codigoSg . "'><input type=submit id=cinco value=5></a>
                            </div>
                            </div>";
                            $body = utf8_decode($cuerpo);
                            $subject = utf8_decode($subjects);
                            $mail->Subject = $subject;
                            $mail->MsgHTML($body);

                            $mail->send();
                        } catch (Exception $e) {
                            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                        }
                    } else {
                        echo "No se inserto función";
                    }
                } else {
                    echo "No se encontro el usuario";
                }
            } else {
                echo "No se pudo modificar la solicitud de seguridad";
            }
        } else {
            $finaliza_solicitudmai = $db->prepare('UPDATE peticiones_sg SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, estado_peticion=:estado_peticion WHERE id_peticionessg=:cod_peticion');
            $finaliza_solicitudmai->bindValue('cod_peticion', $update->getId_peticionSg());
            $finaliza_solicitudmai->bindValue('fecha_atencion', $update->getfecha_atendidoSg());
            $finaliza_solicitudmai->bindValue('usuario_atencion', $update->getUsuario_atencionSg());
            $finaliza_solicitudmai->bindValue('conclusiones', $update->getconclusiones_PeticionSg());
            $finaliza_solicitudmai->bindValue('estado_peticion', $update->getestado_peticionSg());
            $finaliza_solicitudmai->execute();

            $clase = new CrudPeticionesSg();
            $insertaObservacion =  $clase->insertaObservacion($update->getId_peticionSg(), $update->getConclusiones_peticionSg(), $update->getUsuario_atencionSg(), $update->getFecha_atendidoSg(), $update->getEstado_peticionSg());
        }
    }

    function insertaObservacion($nroTicket, $descripcion, $usuario, $fechaCreacion, $estado)
    {
        $db = conectar::acceso();
        $insercion = $db->prepare('INSERT INTO observaciones_sg(id_ticket_sg, descripcion_observaciones, usuario_creacion, fecha_observacion, estado_observacion) VALUES(:id_ticket_sg,:descripcion_observaciones,:usuario_creacion,:fecha_observacion,:estado_observacion)');
        $insercion->bindValue('id_ticket_sg', $nroTicket);
        $insercion->bindValue('descripcion_observaciones', $descripcion);
        $insercion->bindValue('usuario_creacion', $usuario);
        $insercion->bindValue('fecha_observacion', $fechaCreacion);
        $insercion->bindValue('estado_observacion', $estado);
        $insercion->execute();
    }

    public function traeObservaciones($ticket)
    {
        $db = conectar::acceso();
        $consultar_obs = $db->prepare('SELECT descripcion_observaciones, usuario_creacion, fecha_observacion, estado.descripcion AS estado FROM observaciones_sg 
        LEFT JOIN estado ON estado.id_estado=observaciones_sg.estado_observacion WHERE id_ticket_sg=:id_ticket_sg AND (estado_observacion=2 OR estado_observacion=3 OR estado_observacion=22) ORDER BY id_observaciones_sg DESC');
        $consultar_obs->bindValue('id_ticket_sg', $ticket);
        $consultar_obs->execute();
        $observaciones = [];

        while ($listado_obs = $consultar_obs->fetch(PDO::FETCH_ASSOC)) {
            $observaciones[] = $listado_obs;
        }
        return $observaciones;
    }

    public function redireccionaSeguridad($redirect)
    {
        $db = conectar::acceso();
        $estado = $redirect->getEstado_peticionSg();
        $codigoSg = $redirect->getId_peticionSg();
        $fechaAtendido = $redirect->getFecha_atendidoSg();
        $usuarioCreacion = $redirect->getUsuario_creacionSg();
        $usuarioAtendido = $redirect->getUsuario_atencionSg();
        $conclusiones = $redirect->getConclusiones_peticionSg();
        $archivo = $redirect->getArchivos();
        $correo = $redirect->getEmail_funcionario();

        $devolverSolicitudSg = $db->prepare('UPDATE peticiones_sg SET estado_peticion=:estado_peticion, usuario_creacionsg=:usuario_creacionsg, fecha_peticion=:fecha_peticion, conclusiones=:conclusiones WHERE id_peticionessg=:cod_peticion');
        date_default_timezone_set('America/Bogota');

        $devolverSolicitudSg->bindValue('cod_peticion', $redirect->getId_peticionSg());
        $devolverSolicitudSg->bindValue('conclusiones', $redirect->getconclusiones_PeticionSg());
        $devolverSolicitudSg->bindValue('estado_peticion', $redirect->getestado_peticionSg());
        $devolverSolicitudSg->bindValue('fecha_peticion', $redirect->getfecha_atendidoSg());
        $devolverSolicitudSg->bindValue('usuario_creacionsg', $redirect->getUsuario_creacionSg());
        $devolverSolicitudSg->execute();

        $clase = new CrudPeticionesSg();
        $insertaObservacion =  $clase->insertaObservacion($redirect->getId_peticionSg(), $redirect->getconclusiones_PeticionSg(), $redirect->getUsuario_creacionSg(), $redirect->getfecha_atendidoSg(), $redirect->getestado_peticionSg());
    }

    function consultarArchivos($conn, $codigo)
    {
        $db = conectar::acceso();
        $query = "SELECT imagen FROM peticiones_sg WHERE id_peticionessg = id_peticionessg";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Error al preparar la consulta: " . $conn->error);
        }

        $stmt->bind_param('s', $codigo);
        $stmt->execute();
        $result = $stmt->get_result();

        $documentos = [];
        while ($row = $result->fetch_assoc()) {
            $documentos[] = $row['archivo'];
        }

        $stmt->close();

        return $documentos;
    }

    public static function obtenerArchivosDeTicket($ticketId)
    {
        $db = Conectar::acceso();
        $query = 'SELECT imagen, imagen2, imagen3, imagen4, imagen5 FROM peticiones_sg WHERE id_peticionessg = :ticket_id';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':ticket_id', $ticketId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $archivos = [];
        if ($result) {
            foreach ($result as $archivo) {
                if (!empty($archivo) && $archivo !== '2') {
                    $archivos[] = $archivo;
                }
            }
        }
        return $archivos;
    }
    
    public function marcarRevisado($marcar)
    {
        $db = conectar::acceso();
        $liberando = $db->prepare('UPDATE peticiones_sg SET revisado=:revisado WHERE id_peticionessg=:cod_peticion');
        $liberando->bindValue('revisado', 2);
        $liberando->bindValue('cod_peticion', $marcar->getId_peticionSg());
        $liberando->execute();
        if ($liberando) {
            echo 1;
        } else {
            echo 2;
        }
    }
}
