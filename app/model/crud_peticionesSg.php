<?php
require_once('../model/vinculo.php');
require __DIR__ . '/vendor/autoload.php';

class CrudPeticionesSg
{
    public function crearPeticionesSg($create)
    {
        $db = Conectar::acceso();
        $crea_peticionSg = $db->prepare('INSERT INTO peticiones_sg(fecha_peticion, usuario_creacionsg, estado_peticion, categoria, descripcion_peticionsg, imagen, imagen2, imagen3)
        VALUES(:fecha_peticion, :usuario_creacionsg, :estado_peticion, :categoria, :descripcion, :imagen, :imagen2, :imagen3)');

        $crea_peticionSg->bindValue(':fecha_peticion', $create->getfecha_peticionSg());
        $crea_peticionSg->bindValue(':usuario_creacionsg', $create->getusuario_creacionSg());
        $crea_peticionSg->bindValue(':estado_peticion', $create->getestado_peticionSg());
        $crea_peticionSg->bindValue(':categoria', $create->getcategoriaSg());
        $crea_peticionSg->bindValue(':descripcion', $create->getdescripcion_peticionSg());
        $crea_peticionSg->bindValue(':imagen', $create->getimagenPeticionSeguridad1());
        $crea_peticionSg->bindValue(':imagen2', $create->getimagenPeticionSeguridad2());
        $crea_peticionSg->bindValue(':imagen3', $create->getimagenPeticionSeguridad3());
        $crea_peticionSg->execute();

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
    }

    public function consultarPeticionesSg()
    {
        $db = conectar::acceso();
        $lista_peticiones = [];
        $consultar_peticionSg = $db->prepare   ('SELECT id_peticionessg, fecha_peticion, fecha_atencion, usuario_creacionsg, peticiones_sg.descripcion_peticionsg, estado.descripcion AS estado_peticion, categorias.nombre_categoria AS categoria, usuario_atencion, conclusiones, funcionarios.area FROM peticiones_sg LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg LEFT JOIN areas ON areas.id_area=funcionarios.area LEFT JOIN categorias ON categorias.id_categoria=peticiones_sg.categoria LEFT JOIN estado ON estado.id_estado=peticiones_sg.estado_peticion WHERE usuario_creacionsg =:funcionario AND (estado_peticion =:estadoN OR estado_peticion = :estadoR OR estado_peticion =:estadoP) ORDER BY id_peticionessg DESC;');
        $consultar_peticionSg->bindValue('funcionario', $_SESSION['usuario']);
        $consultar_peticionSg->bindValue('estadoN', '1');
        $consultar_peticionSg->bindValue('estadoR', '2');
        $consultar_peticionSg->bindValue('estadoP', '3');
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
            $consulta->setUsuario_atencionSg($listado['usuario_atencion']);
            $consulta->setUsuario_creacionSg($listado['usuario_creacionsg']);
            $lista_peticiones[] = $consulta;
        }

        return $lista_peticiones;
    }

    /*     public function cambiaEstadoMai($state)
    {

        $db = conectar::acceso();

        $actualiza_estado = $db->prepare("UPDATE peticiones_mai SET estado_peticion=:estado, fecha_atencion=:fecha_atendido, usuario_atencion=:usuario_atiende WHERE id_peticionmai=:numero_peticion");
        $actualiza_estado->bindValue('numero_peticion', $state->getId_peticionMai());
        $actualiza_estado->bindValue('estado', $state->getEstado_peticionMai());
        $actualiza_estado->bindValue('fecha_atendido', $state->getFecha_atendidoMai());
        $actualiza_estado->bindValue('usuario_atiende', $state->getUsuario_atencionMai());
        $actualiza_estado->execute();

        $colsultar_usuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
        $colsultar_usuario->bindValue('usuario', $state->getUsuario_atencionMai());
        $colsultar_usuario->execute();
        $filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
        $id_usuario = $filtro['id_usuario'];
        $funcion_realizada = "El usuario cambio el estado del  ticket de aplicaciones internas numero: " . $state->getId_peticionMai() . "a estado: " . $state->getEstado_peticionMai();
        $inserta_funcion = $db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
        $inserta_funcion->bindValue('id_usuario', $id_usuario);
        $inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
        $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
        $inserta_funcion->execute();
    } */

    public function consultarPeticionesFuncionarioSeguridad()
    {
        $db = conectar::acceso();
        $lista_peticiones = [];
        $consultar_peticionSg = $db->prepare   ('SELECT id_peticionessg, fecha_peticion, fecha_atencion, usuario_creacionsg, peticiones_sg.descripcion_peticionsg, estado.descripcion AS estado_peticion, categorias.nombre_categoria AS categoria, usuario_atencion, conclusiones, funcionarios.area FROM peticiones_sg LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg LEFT JOIN areas ON areas.id_area=funcionarios.area LEFT JOIN categorias ON categorias.id_categoria=peticiones_sg.categoria LEFT JOIN estado ON estado.id_estado=peticiones_sg.estado_peticion WHERE usuario_creacionsg =:funcionario AND (estado_peticion =:estadoN OR estado_peticion = :estadoR OR estado_peticion =:estadoP) ORDER BY id_peticionessg DESC;');
        $consultar_peticionSg->bindValue('funcionario', $_SESSION['usuario']);
        $consultar_peticionSg->bindValue('estadoN', '1');
        $consultar_peticionSg->bindValue('estadoR', '2');
        $consultar_peticionSg->bindValue('estadoP', '3');
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
            $consulta->setUsuario_atencionSg($listado['usuario_atencion']);
            $consulta->setUsuario_creacionSg($listado['usuario_creacionsg']);
            $lista_peticiones[] = $consulta;
        }

        return $lista_peticiones;
    }

    function insertaObservacion($nroTicket, $descripcion, $usuario, $fechaCreacion, $estado)
    {
        $db = conectar::acceso();
        $insercion = $db->prepare('INSERT INTO observaciones_sg(id_ticket_sg, descripcion_observacion, usuario_creacion, fecha_observacion, estado_observacion) VALUES(:id_ticket_sg,:descripcion_observacion,:usuario_creacion,:fecha_observacion,:estado_observacion)');
        $insercion->bindValue('id_ticket_sg', $nroTicket);
        $insercion->bindValue('descripcion_observacion', $descripcion);
        $insercion->bindValue('usuario_creacion', $usuario);
        $insercion->bindValue('fecha_observacion', $fechaCreacion);
        $insercion->bindValue('estado_observacion', $estado);
        $insercion->execute();
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
        $funcion_realizada = "El usuario cambio el estado del  ticket de aplicaciones internas numero: " . $state->getId_peticionSg() . "a estado: " . $state->getEstado_peticionSg();
        $inserta_funcion = $db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
        $inserta_funcion->bindValue('id_usuario', $id_usuario);
        $inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
        $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
        $inserta_funcion->execute();
    }

    public function mostrartipoSoporteSg()
    {

        $db = conectar::acceso();
        $tipoSoporte = [];

        $consultar_soportemai = $db->prepare("SELECT id, nombre FROM tipo_soportemai WHERE usos=:uses ORDER BY nombre");
        $consultar_soportemai->bindValue('uses', 1);
        $consultar_soportemai->execute();

        while ($listado_soporte = $consultar_soportemai->fetch(PDO::FETCH_ASSOC)) {
            $tipoSoporte[] = $listado_soporte;
        }
        return $tipoSoporte;
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
        $fechaAtendido = $update->getFecha_atendidoMai();
        $usuarioCreacion = $update->getUsuario_creacionMai();
        $usuarioAtendido = $update->getUsuario_atencionMai();
        $conclusiones = $update->getConclusiones_peticionMai();
        $version = $update->getVersion();
        $numero_version = $update->getNumero_version();
        $sprint = $update->getSprint();
        $gestion = $update->getGestion();
        $archivo = $update->getArchivos();


        $correo = $update->getEmail_funcionario(); ///boton resuelto
        if ($estado == 2) {

            $clase = new CrudPeticionesSg();
            $insertaObservacion =  $clase->insertaObservacion($update->getId_peticionMai(), $update->getConclusiones_peticionMai(), $update->getUsuario_atencionMai(), $update->getFecha_atendidoMai(), $update->getEstado_peticionMai());

            $finaliza_solicitudmai = $db->prepare('UPDATE peticiones_mai SET fecha_atencion=:fecha_atencion, imagen2=:archivo, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, estado_peticion=:estado_peticion, tipo_soportemai=:tipo_soportemai, numero_version=:numero_version, version=:version, sprint=:sprint, gestion=:gestion WHERE id_peticionmai=:cod_peticion');
            $finaliza_solicitudmai->bindValue('cod_peticion', $update->getId_peticionMai());
            $finaliza_solicitudmai->bindValue('fecha_atencion', $update->getFecha_atendidoMai());
            $finaliza_solicitudmai->bindValue('usuario_atencion', $update->getUsuario_atencionMai());
            $finaliza_solicitudmai->bindValue('conclusiones', $update->getConclusiones_peticionMai());
            $finaliza_solicitudmai->bindValue('estado_peticion', $update->getEstado_peticionMai());
            $finaliza_solicitudmai->bindValue('tipo_soportemai', $update->getName());
            $finaliza_solicitudmai->bindValue('version', $update->getVersion());
            $finaliza_solicitudmai->bindValue('numero_version', $update->getNumero_version());
            $finaliza_solicitudmai->bindValue('sprint', $update->getSprint());
            $finaliza_solicitudmai->bindValue('gestion', $update->getGestion());
            $finaliza_solicitudmai->bindValue('archivo', $update->getArchivos());
            $finaliza_solicitudmai->execute();
            if ($finaliza_solicitudmai) {
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
                            $cuerpo .= "<h5><b>Resumen del problema : </b></h5><h5 id='solicitud'>" . $update->getDescripcion_peticionMai() . "</h5>";
                            $cuerpo .= "</div><div id='div_cinco'>";
                            $cuerpo .= "<h5><b>La conclusion que ha dado el asesor : </b></h5><h5 id='conclusion'>" . html_entity_decode($update->getConclusiones_peticionMai()) . "</h5>";
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

                            $existencia_archivo = "../../cartas/" . $archivo;

                            if (file_exists($existencia_archivo)) {
                                $mail->addAttachment("../../cartas/" . $archivo);
                            } else {
                            }
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
                echo "No se pudo modificar la peticion Mai";
            }
        } else {
            $finaliza_solicitudmai = $db->prepare('UPDATE peticiones_mai SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, estado_peticion=:estado_peticion, tipo_soportemai=:tipo_soportemai, sprint=:sprint, gestion=:gestion WHERE id_peticionmai=:cod_peticion');
            $finaliza_solicitudmai->bindValue('cod_peticion', $update->getId_peticionMai());
            $finaliza_solicitudmai->bindValue('fecha_atencion', $update->getFecha_atendidoMai());
            $finaliza_solicitudmai->bindValue('usuario_atencion', $update->getUsuario_atencionMai());
            $finaliza_solicitudmai->bindValue('conclusiones', $update->getConclusiones_peticionMai());
            $finaliza_solicitudmai->bindValue('estado_peticion', $update->getEstado_peticionMai());
            $finaliza_solicitudmai->bindValue('tipo_soportemai', $update->getName());
            $finaliza_solicitudmai->bindValue('sprint', $update->getSprint());
            $finaliza_solicitudmai->bindValue('gestion', $update->getGestion());
            $finaliza_solicitudmai->execute();

            $clase = new CrudPeticionesMai();
            $insertaObservacion =  $clase->insertaObservacion($update->getId_peticionMai(), $update->getConclusiones_peticionMai(), $update->getUsuario_atencionMai(), $update->getFecha_atendidoMai(), $update->getEstado_peticionMai());
        }
    }

    public function traeObservaciones($ticket)
    {
        $db = conectar::acceso();
        $activosResponsable = [];
        $consultar_obs = $db->prepare('SELECT descripcion_observacion, usuario_creacion, fecha_observacion, estado.descripcion AS estado FROM observaciones_mai 
        LEFT JOIN estado ON estado.id_estado=observaciones_mai.estado_observacion WHERE id_ticket=:id_ticket AND (estado_observacion=2 OR estado_observacion=3) ORDER BY id_observacion DESC');
        $consultar_obs->bindValue('id_ticket', $ticket);
        $consultar_obs->execute();
        $observaciones = [];

        while ($listado_obs = $consultar_obs->fetch(PDO::FETCH_ASSOC)) {
            $observaciones[] = $listado_obs;
        }
        return $observaciones;
    }
}
