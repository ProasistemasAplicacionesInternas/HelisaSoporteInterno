<?php
require_once('../model/vinculo.php');
require __DIR__ . '/vendor/autoload.php';

class CrudPeticionesSg
{
    public function crearPeticionesSg($create)
    {
        $db = Conectar::acceso();
        $creaPeticionSg = $db->prepare('INSERT INTO peticiones_sg (fecha_peticion, usuario_creacionsg, estado_peticion, categoria, descripcion_peticionsg, imagen, imagen2, imagen3, imagen4, imagen5) VALUES (:fecha_peticion, :usuario_creacionsg, :estado_peticion, :categoria, :descripcion_peticionsg, :imagen, :imagen2, :imagen3, :imagen4, :imagen5)');
        $creaPeticionSg->bindValue(':fecha_peticion', $create->getFechaPeticionSg());
        $creaPeticionSg->bindValue(':usuario_creacionsg', $create->getUsuarioCreacionSg());
        $creaPeticionSg->bindValue(':estado_peticion', $create->getEstadoPeticionSg());
        $creaPeticionSg->bindValue(':categoria', $create->getcategoriaSg());
        $creaPeticionSg->bindValue(':descripcion_peticionsg', $create->getDescripcionPeticionSg());
        $creaPeticionSg->bindValue(':imagen', $create->getImagenPeticionSeguridad1());
        $creaPeticionSg->bindValue(':imagen2', $create->getImagenPeticionSeguridad2());
        $creaPeticionSg->bindValue(':imagen3', $create->getImagenPeticionSeguridad3());
        $creaPeticionSg->bindValue(':imagen4', $create->getImagenPeticionSeguridad4());
        $creaPeticionSg->bindValue(':imagen5', $create->getImagenPeticionSeguridad5());
        $creaPeticionSg->execute();
        $id = $db->lastInsertId();

        $colsultarUsuario = $db->prepare('SELECT identificacion FROM funcionarios WHERE usuario = :usuario_creacionsg');
        $colsultarUsuario->bindValue(':usuario_creacionsg', $create->getusuarioCreacionSg());
        $colsultarUsuario->execute();
        $filtro = $colsultarUsuario->fetch(PDO::FETCH_ASSOC);
        $idFuncionario = $filtro['identificacion'];
        $funcionRealizada = "El funcionario realizó una petición de categoría: " . $create->getcategoriaSg();
        $insertaFuncion = $db->prepare("INSERT INTO funciones_funcionarios (codigo, id_funcionario, fecha_registro, funcion_realizada, IP) VALUES (0, :id_funcionario, CURDATE(), :funcion_realizada, :ip)");
        $insertaFuncion->bindValue(':id_funcionario', $idFuncionario);
        $insertaFuncion->bindValue(':funcion_realizada', $funcionRealizada);
        $insertaFuncion->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
        $insertaFuncion->execute();

        $clase = new CrudPeticionesSg();
        $insertaObservacion = $clase->insertaObservacion($id, $create->getDescripcionPeticionSg(), $create->getUsuarioCreacionSg(), $create->getFechaPeticionSg(), $create->getEstadoPeticionSg());
    }

    public function consultarPeticionesSg()
    {
        $db = conectar::acceso();
        $listaPeticiones = [];
        $consultarPeticionSg = $db->prepare('SELECT id_peticionessg, fecha_peticion, fecha_atencion, usuario_creacionsg, peticiones_sg.descripcion_peticionsg, funcionarios.area, funcionarios.mail, estado.descripcion AS estado_peticion, categorias_sg.nombre_categoria AS categoria, usuario_atencion, conclusiones, funcionarios.area FROM peticiones_sg LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg LEFT JOIN areas ON areas.id_area=funcionarios.area LEFT JOIN categorias_sg ON categorias_sg.id_categoria=peticiones_sg.categoria LEFT JOIN estado ON estado.id_estado=peticiones_sg.estado_peticion WHERE (estado_peticion = :estadoN OR estado_peticion =:estadoP OR estado_peticion=:estadoPrc) ORDER BY id_peticionessg DESC;');
        $consultarPeticionSg->bindValue('estadoN', '1');
        $consultarPeticionSg->bindValue('estadoP', '3');
        $consultarPeticionSg->bindValue('estadoPrc', '22');
        $consultarPeticionSg->execute();
        foreach ($consultarPeticionSg->fetchAll() as $listado) {
            $consulta = new PeticionSg();
            $consulta->setIdPeticionSg($listado['id_peticionessg']);
            $consulta->setFechaPeticionSg($listado['fecha_peticion']);
            $consulta->setDescripcionPeticionSg($listado['descripcion_peticionsg']);
            $consulta->setFechaAtendidoSg($listado['fecha_atencion']);
            $consulta->setEstadoPeticionSg($listado['estado_peticion']);
            $consulta->setCategoriaSg($listado['categoria']);
            $consulta->setConclusionesPeticionSg($listado['conclusiones']);
            $consulta->setUsuarioAtencionSg($listado['usuario_atencion']);
            $consulta->setAreaFuncionario($listado['area']);
            $consulta->setUsuarioCreacionSg($listado['usuario_creacionsg']);
            $consulta->setEmailFuncionario($listado['mail']);
            $listaPeticiones[] = $consulta;
        }

        return $listaPeticiones;
    }

    public function consultarPeticionesFuncionarioSeguridad()
    {
        $db = conectar::acceso();
        $listaPeticiones = [];
        $consultarPeticion = $db->prepare('SELECT id_peticionessg, categorias_sg.nombre_categoria AS categoria_sg, fecha_peticion, descripcion_peticionsg, estado.descripcion AS estado_peticion, fecha_atencion, usuario_atencion, usuario_creacionsg, funcionarios.mail, conclusiones, revisado 
    FROM peticiones_sg 
    LEFT JOIN categorias_sg ON categorias_sg.id_categoria=peticiones_sg.categoria
    LEFT JOIN estado ON estado.id_estado=peticiones_sg.estado_peticion
    LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg
    WHERE usuario_creacionsg=:funcionario AND revisado=:noRevisado');
        $consultarPeticion->bindValue('noRevisado', 1);
        $consultarPeticion->bindValue('funcionario', $_SESSION['usuario']);
        $consultarPeticion->execute();
        foreach ($consultarPeticion->fetchAll() as $listado) {
            $consulta = new PeticionSg();
            $consulta->setIdPeticionSg($listado['id_peticionessg']);
            $consulta->setCategoriaSg($listado['categoria_sg']);
            $consulta->setFechaPeticionSg($listado['fecha_peticion']);
            $consulta->setDescripcionPeticionSg($listado['descripcion_peticionsg']);
            $consulta->setEstadoPeticionSg($listado['estado_peticion']);
            $consulta->setFechaAtendidoSg($listado['fecha_atencion']);
            $consulta->setUsuarioAtencionSg($listado['usuario_atencion']);
            $consulta->setUsuarioCreacionSg($listado['usuario_creacionsg']);
            $consulta->setConclusionesPeticionSg($listado['conclusiones']);
            $consulta->setEmailFuncionario($listado['mail']);
            $consulta->setMarcaRevisadoSg($listado['revisado']);
            $listaPeticiones[] = $consulta;
        }
        return $listaPeticiones;
    }

    public function cambiaEstadoSg($state)
    {

        $db = conectar::acceso();

        $actualizaEstado = $db->prepare("UPDATE peticiones_sg SET estado_peticion=:estado, fecha_atencion=:fecha_atendido, usuario_atencion=:usuario_atiende WHERE id_peticionessg=:numero_peticion");
        $actualizaEstado->bindValue('numero_peticion', $state->getIdPeticionSg());
        $actualizaEstado->bindValue('estado', $state->getEstadoPeticionSg());
        $actualizaEstado->bindValue('fecha_atendido', $state->getFechaAtendidoSg());
        $actualizaEstado->bindValue('usuario_atiende', $state->getUsuarioAtencionSg());
        $actualizaEstado->execute();

        $colsultarUsuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
        $colsultarUsuario->bindValue('usuario', $state->getUsuarioAtencionSg());
        $colsultarUsuario->execute();
        $filtro = $colsultarUsuario->fetch(PDO::FETCH_ASSOC);
        $idUsuario = $filtro['id_usuario'];
        $funcionRealizada = "El usuario cambio el estado del  caso de seguridad numero: " . $state->getIdPeticionSg() . "a estado: " . $state->getEstadoPeticionSg();
        $insertaFuncion = $db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
        $insertaFuncion->bindValue('id_usuario', $idUsuario);
        $insertaFuncion->bindValue('funcion_realizada', $funcionRealizada);
        $insertaFuncion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
        $insertaFuncion->execute();
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

    public function modificarPeticionesSgResuelto($update)
    {
        $db = conectar::acceso();
        $estado = $update->getEstadoPeticionSg();
        $codigoSg = $update->getIdPeticionSg();
        $fechaAtendido = $update->getFechaAtendidoSg();
        $usuarioCreacion = $update->getUsuarioCreacionSg();
        $usuarioAtendido = $update->getUsuarioAtencionSg();
        $conclusiones = $update->getConclusionesPeticionSg();


        $correo = $update->getEmailFuncionario();
        if ($estado == 2) {

            $clase = new CrudPeticionesSg();
            $insertaObservacion =  $clase->insertaObservacion($update->getIdPeticionSg(), $update->getConclusionesPeticionSg(), $update->getUsuarioAtencionSg(), $update->getFechaAtendidoSg(), $update->getEstadoPeticionSg());

            $finalizaSolicituSg = $db->prepare('UPDATE peticiones_sg SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, estado_peticion=:estado_peticion WHERE id_peticionessg=:cod_peticion');
            $finalizaSolicituSg->bindValue('cod_peticion', $update->getIdPeticionSg());
            $finalizaSolicituSg->bindValue('fecha_atencion', $update->getFechaAtendidoSg());
            $finalizaSolicituSg->bindValue('usuario_atencion', $update->getUsuarioAtencionSg());
            $finalizaSolicituSg->bindValue('conclusiones', $update->getConclusionesPeticionSg());
            $finalizaSolicituSg->bindValue('estado_peticion', $update->getEstadoPeticionSg());
            $finalizaSolicituSg->execute();
            if ($finalizaSolicituSg) {
                $colsultarUsuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
                $colsultarUsuario->bindValue('usuario', $usuarioAtendido);
                $colsultarUsuario->execute();
                $filtro = $colsultarUsuario->fetch(PDO::FETCH_ASSOC);
                $idUsuario = $filtro['id_usuario'];
                $funcionRealizada = "El usuario atiendio con exito el siguiente ticket: " . $codigoSg . "del area de ";

                if ($colsultarUsuario) {
                    $insertaFuncion = $db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                    $insertaFuncion->bindValue('id_usuario', $idUsuario);
                    $insertaFuncion->bindValue('funcion_realizada', $funcionRealizada);
                    $insertaFuncion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
                    $insertaFuncion->execute();

                    if ($insertaFuncion) {
                        $mail = new PHPMailer(true); // Passing `true` enables exceptions
                        try {
                            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'no-responder@helisa.com';                 // SMTP username
                            $mail->Password = 'pdqMG3@5FYV2PRP@Teh@Y@aoKEufrV';                           // SMTP password C3cwrsl6k1DN8am*2021Ftwv2*
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
                            $cuerpo .= "<h5><b>Resumen del problema : </b></h5><h5 id='solicitud'>" . $update->getDescripcionPeticionSg() . "</h5>";
                            $cuerpo .= "</div><div id='div_cinco'>";
                            $cuerpo .= "<h5><b>La conclusion que ha dado el asesor : </b></h5><h5 id='conclusion'>" . html_entity_decode($update->getConclusionesPeticionSg()) . "</h5>";
                            $cuerpo .= "</div><div id='div_seis'>";
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
            $finalizaSolicitudmai = $db->prepare('UPDATE peticiones_sg SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, estado_peticion=:estado_peticion WHERE id_peticionessg=:cod_peticion');
            $finalizaSolicitudmai->bindValue('cod_peticion', $update->getIdPeticionSg());
            $finalizaSolicitudmai->bindValue('fecha_atencion', $update->getFechaAtendidoSg());
            $finalizaSolicitudmai->bindValue('usuario_atencion', $update->getUsuarioAtencionSg());
            $finalizaSolicitudmai->bindValue('conclusiones', $update->getConclusionesPeticionSg());
            $finalizaSolicitudmai->bindValue('estado_peticion', $update->getEstadoPeticionSg());
            $finalizaSolicitudmai->execute();

            $clase = new CrudPeticionesSg();
            $insertaObservacion =  $clase->insertaObservacion($update->getIdPeticionSg(), $update->getConclusionesPeticionSg(), $update->getUsuarioAtencionSg(), $update->getFechaAtendidoSg(), $update->getEstadoPeticionSg());
        }
    }

    public function modificarPeticionesSgPendiente($update)
    {

        $db = conectar::acceso();

        $finalizaSolicituSg = $db->prepare('UPDATE peticiones_sg SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, estado_peticion=:estado_peticion WHERE id_peticionessg=:cod_peticion');
        $finalizaSolicituSg->bindValue('cod_peticion', $update->getidPeticionSg());
        $finalizaSolicituSg->bindValue('fecha_atencion', $update->getFechaAtendidoSg());
        $finalizaSolicituSg->bindValue('usuario_atencion', $update->getUsuarioAtencionSg());
        $finalizaSolicituSg->bindValue('conclusiones', $update->getConclusionesPeticionSg());
        $finalizaSolicituSg->bindValue('estado_peticion', $update->getEstadoPeticionSg());
        $finalizaSolicituSg->execute();

        $clase = new CrudPeticionesSg();
        $insertaObservacion =  $clase->insertaObservacion($update->getIdPeticionSg(), $update->getConclusionesPeticionSg(), $update->getUsuarioAtencionSg(), $update->getFechaAtendidoSg(), $update->getEstadoPeticionSg());
    }




    public function modificarPeticionesSgEnProceso($update)
    {
        $db = conectar::acceso();
        $estado = $update->getEstadoPeticionSg();
        $codigoSg = $update->getIdPeticionSg();
        $fechaAtendido = $update->getFechaAtendidoSg();
        $usuarioCreacion = $update->getUsuarioCreacionSg();
        $usuarioAtendido = $update->getUsuarioAtencionSg();
        $conclusiones = $update->getConclusionesPeticionSg();

        $correo = $update->getEmailFuncionario();
        if ($estado == 22) {

            $clase = new CrudPeticionesSg();
            $insertaObservacion =  $clase->insertaObservacion($update->getIdPeticionSg(), $update->getConclusionesPeticionSg(), $update->getUsuarioAtencionSg(), $update->getFechaAtendidoSg(), $update->getEstadoPeticionSg());

            $finalizaSolicituSg = $db->prepare('UPDATE peticiones_sg SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, estado_peticion=:estado_peticion WHERE id_peticionessg=:cod_peticion');
            $finalizaSolicituSg->bindValue('cod_peticion', $update->getIdPeticionSg());
            $finalizaSolicituSg->bindValue('fecha_atencion', $update->getFechaAtendidoSg());
            $finalizaSolicituSg->bindValue('usuario_atencion', $update->getUsuarioAtencionSg());
            $finalizaSolicituSg->bindValue('conclusiones', $update->getConclusionesPeticionSg());
            $finalizaSolicituSg->bindValue('estado_peticion', $update->getEstadoPeticionSg());
            $finalizaSolicituSg->execute();
            if ($finalizaSolicituSg) {
                $colsultarUsuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
                $colsultarUsuario->bindValue('usuario', $usuarioAtendido);
                $colsultarUsuario->execute();
                $filtro = $colsultarUsuario->fetch(PDO::FETCH_ASSOC);
                $idUsuario = $filtro['id_usuario'];
                $funcionRealizada = "El usuario atiendio con exito el siguiente ticket: " . $codigoSg . "del area de ";

                if ($colsultarUsuario) {
                    $insertaFuncion = $db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                    $insertaFuncion->bindValue('id_usuario', $idUsuario);
                    $insertaFuncion->bindValue('funcion_realizada', $funcionRealizada);
                    $insertaFuncion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
                    $insertaFuncion->execute();

                    if ($insertaFuncion) {
                        $mail = new PHPMailer(true); // Passing `true` enables exceptions
                        try {
                            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'no-responder@helisa.com';                 // SMTP username
                            $mail->Password = 'pdqMG3@5FYV2PRP@Teh@Y@aoKEufrV';                           // SMTP password C3cwrsl6k1DN8am*2021Ftwv2*
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                    // TCP port to connect to
                            $mail->setFrom('no-responder@helisa.com');
                            $mail->addAddress($correo);
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $subjects = "Devolucion Ticket Seguridad";
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
                            $cuerpo .= "<h5>Señor(a) " . $usuarioCreacion . " su ticket con numero: " . $codigoSg . ", se ha devuelto por favor validar nuevamente la solicitud en la plataforma. A continuación se daran mas detalles del proceso.</h5>";
                            $cuerpo .= "</div><div id='div_dos'>";
                            $cuerpo .= "<h5><b>Motivo de devolucion : </b></h5><h5 id='conclusion'>" . html_entity_decode($update->getConclusionesPeticionSg()) . "</h5>";


                            $cuerpo .= "</div><div id='div_seis'>";
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
            $finalizaSolicitudmai = $db->prepare('UPDATE peticiones_sg SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, estado_peticion=:estado_peticion WHERE id_peticionessg=:cod_peticion');
            $finalizaSolicitudmai->bindValue('cod_peticion', $update->getIdPeticionSg());
            $finalizaSolicitudmai->bindValue('fecha_atencion', $update->getFechaAtendidoSg());
            $finalizaSolicitudmai->bindValue('usuario_atencion', $update->getUsuarioAtencionSg());
            $finalizaSolicitudmai->bindValue('conclusiones', $update->getconClusionesPeticionSg());
            $finalizaSolicitudmai->bindValue('estado_peticion', $update->getEstadoPeticionSg());
            $finalizaSolicitudmai->execute();

            $clase = new CrudPeticionesSg();
            $insertaObservacion =  $clase->insertaObservacion($update->getIdPeticionSg(), $update->getConclusionesPeticionSg(), $update->getUsuarioAtencionSg(), $update->getFechaAtendidoSg(), $update->getEstadoPeticionSg());
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
        $estado = $redirect->getEstadoPeticionSg();
        $codigoSg = $redirect->getIdPeticionSg();
        $fechaAtendido = $redirect->getFechaAtendidoSg();
        $usuarioCreacion = $redirect->getUsuarioCreacionSg();
        $usuarioAtendido = $redirect->getUsuarioAtencionSg();
        $conclusiones = $redirect->getConclusionesPeticionSg();
        $archivo = $redirect->getArchivos();
        $correo = $redirect->getEmailFuncionario();

        $devolverSolicitudSg = $db->prepare('UPDATE peticiones_sg SET estado_peticion=:estado_peticion, usuario_creacionsg=:usuario_creacionsg, fecha_peticion=:fecha_peticion, conclusiones=:conclusiones WHERE id_peticionessg=:cod_peticion');
        date_default_timezone_set('America/Bogota');

        $devolverSolicitudSg->bindValue('cod_peticion', $redirect->getIdPeticionSg());
        $devolverSolicitudSg->bindValue('conclusiones', $redirect->getConclusionesPeticionSg());
        $devolverSolicitudSg->bindValue('estado_peticion', $redirect->getEstadoPeticionSg());
        $devolverSolicitudSg->bindValue('fecha_peticion', $redirect->getFechaAtendidoSg());
        $devolverSolicitudSg->bindValue('usuario_creacionsg', $redirect->getUsuarioCreacionSg());
        $devolverSolicitudSg->execute();

        $clase = new CrudPeticionesSg();
        $insertaObservacion =  $clase->insertaObservacion($redirect->getIdPeticionSg(), $redirect->getConclusionesPeticionSg(), $redirect->getUsuarioCreacionSg(), $redirect->getFechaAtendidoSg(), $redirect->getEstadoPeticionSg());
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
        $liberando->bindValue('cod_peticion', $marcar->getIdPeticionSg());
        $liberando->execute();
        if ($liberando) {
            echo 1;
        } else {
            echo 2;
        }
    }
}
