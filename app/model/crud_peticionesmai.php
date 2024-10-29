<?php
require_once('../model/vinculo.php');
require __DIR__ . '/vendor/autoload.php';

class CrudPeticionesMai
{

    //********************************************************************************//
    //***********SQL PARA LA CREACION DE UNA PETICION DE FUNCIONARIO******************//
    //********************************************************************************//

    public function crearPeticionesMai($create)
    {
        $db = Conectar::acceso();
        $crea_peticionMai = $db->prepare('INSERT INTO peticiones_mai(descripcion_peticion, usuario_creacion, fecha_peticion, estado_peticion, producto_mai, imagen, imagen2, imagen3, tipo_soportemai, req_nombre, req_justificacion)VALUES(:descripcion_peticion, :usuario_creacion, :fecha_peticion, :estado_peticion, :producto_mai, :imagen, :imagen2, :imagen3, :tipo, :req_name, :req_justification)');

        $crea_peticionMai->bindValue('descripcion_peticion', $create->getDescripcion_peticionMai());
        $crea_peticionMai->bindValue('usuario_creacion', $create->getUsuario_creacionMai());
        $crea_peticionMai->bindValue('fecha_peticion', $create->getFecha_peticionMai());
        $crea_peticionMai->bindValue('estado_peticion', $create->getEstado_peticionMai());
        $crea_peticionMai->bindValue('producto_mai', $create->getProducto_peticionMai());
        $crea_peticionMai->bindValue('imagen', $create->getImagen_peticionMai());
        $crea_peticionMai->bindValue('imagen2', $create->getImagen_peticionMai2());
        $crea_peticionMai->bindValue('imagen3', $create->getImagen_peticionMai3());
        $crea_peticionMai->bindValue('tipo', $create->getName());
        $crea_peticionMai->bindValue('req_name', $create->getReq_Name());
        $crea_peticionMai->bindValue('req_justification', $create->getReq_justification());
        $crea_peticionMai->execute();
        $id = $db->lastInsertId();

        $colsultar_usuario = $db->prepare('SELECT identificacion from funcionarios where usuario =:usuario');
        $colsultar_usuario->bindValue('usuario', $create->getUsuario_creacionMai());
        $colsultar_usuario->execute();
        $filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
        $id_funcionario = $filtro['identificacion'];
        $funcion_realizada = "El funcionario Realizo una peticion al area de Mantenimiento de aplicaciones internas para el Producto " . $create->getProducto_peticionMai();
        $inserta_funcion = $db->prepare("INSERT INTO funciones_funcionarios (codigo, id_funcionario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_funcionario , curdate() , :funcion_realizada ,:ip )");
        $inserta_funcion->bindValue('id_funcionario', $id_funcionario);
        $inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
        $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
        $inserta_funcion->execute();

        $clase = new CrudPeticionesMai();
        $insertaObservacion =  $clase->insertaObservacion($id, $create->getDescripcion_peticionMai(), $create->getUsuario_creacionMai(), $create->getFecha_peticionMai(), $create->getEstado_peticionMai());
    }


    public function consultarPeticionesMai()
    {
        $db = conectar::acceso();
        $lista_peticiones = [];
        $consultar_peticion = $db->prepare('SELECT  id_peticionmai, descripcion_peticion, usuario_creacion, fecha_peticion, estado.descripcion AS estado_peticion, 
            productos_mai.nombre_producto AS producto_mai, imagen,  fecha_atencion, usuario_atencion, conclusiones, funcionarios.extension, funcionarios.area,funcionarios.mail, 
            imagen2, imagen3, tipo_soportemai, tipo_soportemai.nombre, tipo_soportemai.id ,req_nombre, req_justificacion
            FROM peticiones_mai 
            LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_mai.usuario_creacion 
            LEFT JOIN areas ON areas.id_area=funcionarios.area 
            LEFT JOIN productos_mai ON productos_mai.id_producto=peticiones_mai.producto_mai 
            LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion 
            LEFT JOIN tipo_soportemai ON tipo_soportemai.id=peticiones_mai.tipo_soportemai
            WHERE (estado_peticion=:estadoU OR estado_peticion=:estadoT) AND (tipo_soportemai=:inconvenientes OR tipo_soportemai=:consultas OR tipo_soportemai=:solicitudes_internas) ORDER BY id_peticionmai ASC');
        $consultar_peticion->bindValue('estadoU', '1');
        $consultar_peticion->bindValue('estadoT', '3');
        $consultar_peticion->bindValue('inconvenientes', '1');
        $consultar_peticion->bindValue('consultas', '3');
        $consultar_peticion->bindValue('solicitudes_internas', '4');
        $consultar_peticion->execute();
        foreach ($consultar_peticion->fetchAll() as $listado) {
            $consulta = new PeticionMai();
            $consulta->setId_peticionMai($listado['id_peticionmai']);
            $consulta->setDescripcion_peticionMai($listado['descripcion_peticion']);
            $consulta->setUsuario_creacionMai($listado['usuario_creacion']);
            $consulta->setFecha_peticionMai($listado['fecha_peticion']);
            $consulta->setEstado_peticionMai($listado['estado_peticion']);
            $consulta->setProducto_peticionMai($listado['producto_mai']);
            $consulta->setImagen_peticionMai($listado['imagen']);
            $consulta->setImagen_peticionMai2($listado['imagen2']);
            $consulta->setImagen_peticionMai3($listado['imagen3']);
            $consulta->setFecha_atendidoMai($listado['fecha_atencion']);
            $consulta->setUsuario_atencionMai($listado['usuario_atencion']);
            $consulta->setConclusiones_peticionMai($listado['conclusiones']);
            $consulta->setExtension_funcionario($listado['extension']);
            $consulta->setArea_funcionario($listado['area']);
            $consulta->setEmail_funcionario($listado['mail']);
            $consulta->setReq_Justification($listado['req_justificacion']);
            $consulta->setReq_Name($listado['req_nombre']);
            $consulta->setName($listado['nombre']);

            $lista_peticiones[] = $consulta;
        }
        return $lista_peticiones;
    }

    public function consultarRequerimientos()
    {
        $db = conectar::acceso();
        $lista_peticiones = [];
        $consultar_peticion = $db->prepare('SELECT  id_peticionmai, descripcion_peticion, usuario_creacion, fecha_peticion, 
            estado.descripcion AS estado_peticion, productos_mai.nombre_producto AS producto_mai, imagen,  fecha_atencion, 
            usuario_atencion, conclusiones, funcionarios.extension, funcionarios.area,funcionarios.mail, imagen2, imagen3, tipo_soportemai, tipo_soportemai.nombre, tipo_soportemai.id, req_nombre, req_justificacion, sprint, gestion
            FROM peticiones_mai 
            LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_mai.usuario_creacion 
            LEFT JOIN areas ON areas.id_area=funcionarios.area 
            LEFT JOIN productos_mai ON productos_mai.id_producto=peticiones_mai.producto_mai 
            LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion 
            LEFT JOIN tipo_soportemai ON tipo_soportemai.id=peticiones_mai.tipo_soportemai
            WHERE (estado_peticion=:estadoU OR estado_peticion=:estadoT OR estado_peticion=:estadoE OR estado_peticion=:gestioncambios OR estado_peticion=:pruebas OR estado_peticion=:Cversion OR estado_peticion = :estadoB OR estado_peticion = :estadoPT /*OR estado_peticion = :estadoEP*/ /*OR estado_peticion = :estadoDE*/ ) AND (tipo_soportemai=:requerimientos) ORDER BY id_peticionmai ASC');
        $consultar_peticion->bindValue('estadoU', '1');
        $consultar_peticion->bindValue('estadoT', '3');
        $consultar_peticion->bindValue('estadoE', '18');
        $consultar_peticion->bindValue('estadoB', '23');
        $consultar_peticion->bindValue('estadoPT', '24');
        /*$consultar_peticion->bindValue('estadoEP', '25');*/
        /*$consultar_peticion->bindValue('estadoDE', '26');*/
        $consultar_peticion->bindValue('requerimientos', '2');
        $consultar_peticion->bindValue('gestioncambios', '19');
        $consultar_peticion->bindvalue('pruebas', '20');
        $consultar_peticion->bindvalue('Cversion', '21');
        $consultar_peticion->execute();
        foreach ($consultar_peticion->fetchAll() as $listado) {
            $consulta = new PeticionMai();
            $consulta->setId_peticionMai($listado['id_peticionmai']);
            $consulta->setDescripcion_peticionMai($listado['descripcion_peticion']);
            $consulta->setUsuario_creacionMai($listado['usuario_creacion']);
            $consulta->setFecha_peticionMai($listado['fecha_peticion']);
            $consulta->setEstado_peticionMai($listado['estado_peticion']);
            $consulta->setProducto_peticionMai($listado['producto_mai']);
            $consulta->setImagen_peticionMai($listado['imagen']);
            $consulta->setImagen_peticionMai2($listado['imagen2']);
            $consulta->setImagen_peticionMai3($listado['imagen3']);
            $consulta->setFecha_atendidoMai($listado['fecha_atencion']);
            $consulta->setUsuario_atencionMai($listado['usuario_atencion']);
            $consulta->setConclusiones_peticionMai($listado['conclusiones']);
            $consulta->setExtension_funcionario($listado['extension']);
            $consulta->setArea_funcionario($listado['area']);
            $consulta->setEmail_funcionario($listado['mail']);
            $consulta->setName($listado['nombre']);
            $consulta->setReq_Name($listado['req_nombre']);
            $consulta->setReq_Justification($listado['req_justificacion']);
            $consulta->setSprint($listado['sprint']);
            $consulta->setGestion($listado['gestion']);


            $lista_peticiones[] = $consulta;
        }
        return $lista_peticiones;
    }

    public function cambiaEstadoMai($state)
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
    }

    public function redireccionarPeticionesMai($redirect)
    {
        $db = conectar::acceso();
        $redirecciona_solicitud = $db->prepare('INSERT INTO peticiones(fecha_peticion, usuario, estado, categoria, descripcion, 
        imagen, conclusiones, imagen2, imagen3)VALUES(:fecha_peticion, :usuario, :estado, :categoria, :descripcion, 
        :imagen, :conclusiones, :imagen2, :imagen3)');
        date_default_timezone_set('America/Bogota');

        $redirecciona_solicitud->bindValue('fecha_peticion', $redirect->getFecha_peticionMai());
        $redirecciona_solicitud->bindValue('usuario', $redirect->getUsuario_creacionMai());
        $redirecciona_solicitud->bindValue('estado', 1);
        $redirecciona_solicitud->bindValue('categoria', 22);
        $redirecciona_solicitud->bindValue('descripcion', $redirect->getDescripcion_peticionMai());
        $redirecciona_solicitud->bindValue('imagen', $redirect->getImagen_peticionMai());
        $redirecciona_solicitud->bindValue('imagen2', $redirect->getImagen_peticionMai2());
        $redirecciona_solicitud->bindValue('imagen3', $redirect->getImagen_peticionMai3());
        $redirecciona_solicitud->bindValue('conclusiones', $redirect->getConclusiones_peticionMai());
        $redirecciona_solicitud->execute();
        if ($redirecciona_solicitud) {
            $registro = $db->lastInsertId();
            echo $registro;
            $db = conectar::acceso();
            $finaliza_solicitudmai = $db->prepare('UPDATE peticiones_mai SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, cod_redireccionado=:cod_redireccionado, estado_peticion=:estado_peticion WHERE id_peticionmai=:cod_peticion');
            $finaliza_solicitudmai->bindValue('cod_peticion', $redirect->getId_peticionMai());
            $finaliza_solicitudmai->bindValue('fecha_atencion', $redirect->getFecha_atendidoMai());
            $finaliza_solicitudmai->bindValue('usuario_atencion', $redirect->getUsuario_atencionMai());
            $finaliza_solicitudmai->bindValue('conclusiones', $redirect->getConclusiones_peticionMai());
            $finaliza_solicitudmai->bindValue('cod_redireccionado', $registro);
            $finaliza_solicitudmai->bindValue('estado_peticion', $redirect->getEstado_peticionMai());
            $finaliza_solicitudmai->execute();
        }
    }

    public function modificarPeticionesMai($update)
    {
        $db = conectar::acceso();
        $estado = $update->getEstado_peticionMai();
        $codigoMai = $update->getId_peticionMai();
        $fechaAtendido = $update->getFecha_atendidoMai();
        $usuarioCreacion = $update->getUsuario_creacionMai();
        $usuarioAtendido = $update->getUsuario_atencionMai();
        $conclusiones = $update->getConclusiones_peticionMai();
        $version = $update->getVersion();
        $numero_version = $update->getNumero_version();
        $sprint = $update->getSprint();
        $gestion = $update->getGestion();
        $archivo = $update->getArchivos();


        $correo = $update->getEmail_funcionario();
        if ($estado == 2) {

            $clase = new CrudPeticionesMai();
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
                $funcion_realizada = "El usuario atiendio con exito el siguiente ticket: " . $codigoMai . "del area de Mantenimiento de Aplicaciones internas";

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
                            $cuerpo .= "<h5>Señor(a) " . $usuarioCreacion . " su ticket con numero: " . $codigoMai . ", ha sido resuelto por uno de nuestro asesores. A continuación se daran mas detalles del proceso.</h5>";
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

                                <a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticionmai.php?encuesta=encuesta&nro=1&peticion=" . $codigoMai . "'><input type='submit' id='uno' value='1'></a>

                                <a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticionmai.php?encuesta=encuesta&nro=2&peticion=" . $codigoMai . "'><input type=submit id=dos value=2></a>

                                <a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticionmai.php?encuesta=encuesta&nro=3&peticion=" . $codigoMai . "'><input type=submit id=tres value=3></a>
                                <a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticionmai.php?encuesta=encuesta&nro=4&peticion=" . $codigoMai . "'><input type=submit id=cuatro value=4></a>

                                <a href='https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticionmai.php?encuesta=encuesta&nro=5&peticion=" . $codigoMai . "'><input type=submit id=cinco value=5></a>
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

    function insertaObservacion($nroTicket, $descripcion, $usuario, $fechaCreacion, $estado)
    {
        $db = conectar::acceso();
        $insercion = $db->prepare('INSERT INTO observaciones_mai(id_ticket,descripcion_observacion,usuario_creacion,fecha_observacion,estado_observacion) VALUES(:id_ticket,:descripcion_observacion,:usuario_creacion,:fecha_observacion,:estado_observacion)');
        $insercion->bindValue('id_ticket', $nroTicket);
        $insercion->bindValue('descripcion_observacion', $descripcion);
        $insercion->bindValue('usuario_creacion', $usuario);
        $insercion->bindValue('fecha_observacion', $fechaCreacion);
        $insercion->bindValue('estado_observacion', $estado);
        $insercion->execute();
    }

    public function encuesta($peticion)
    {

        $db = conectar::acceso();
        $consulta_encuesta = $db->prepare('SELECT nivel_encuesta FROM peticiones_mai WHERE id_peticionmai =:numero_peticion');
        $consulta_encuesta->bindValue('numero_peticion', $peticion->getId_peticionMai());
        $consulta_encuesta->execute();
        $filter = $consulta_encuesta->fetch(PDO::FETCH_ASSOC);
        $nivel_encuesta = $filter['nivel_encuesta'];
        if ($nivel_encuesta != 0) {
            echo 'No se realiza el cambio';
        } else {
            $insertar_encuesta = $db->prepare('UPDATE peticiones_mai SET nivel_encuesta=:nivel WHERE id_peticionmai=:numero_peticion');
            $insertar_encuesta->bindValue('numero_peticion', $peticion->getId_peticionMai());
            $insertar_encuesta->bindValue('nivel', $peticion->getEstado_peticionMai());
            $insertar_encuesta->execute();
        }
    }

    public function solicitudesEnProceso()
    {
        $db = conectar::acceso();
        $lista_peticionesMai = [];
        $consultar_peticionMai = $db->prepare('SELECT id_peticionmai, fecha_peticion, tipo_soportemai, estado.descripcion AS estado_peticion, 
            productos_mai.nombre_producto AS producto_mai, fecha_atencion, usuario_atencion, tipo_soportemai.nombre AS tipo_soportenombre, tipo_soportemai.id AS tipo_soporteid 
            FROM peticiones_mai LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion 
            LEFT JOIN productos_mai ON productos_mai.id_producto=peticiones_mai.producto_mai 
            LEFT JOIN tipo_soportemai ON tipo_soportemai.id=peticiones_mai.tipo_soportemai
            WHERE estado_peticion=:estadoSeleccionado');
        $consultar_peticionMai->bindValue('estadoSeleccionado', '8');
        $consultar_peticionMai->execute();

        foreach ($consultar_peticionMai->fetchAll() as $listado) {
            $consulta = new PeticionMai();
            $consulta->setId_peticionMai($listado['id_peticionmai']);
            $consulta->setFecha_peticionMai($listado['fecha_peticion']);
            $consulta->setEstado_peticionMai($listado['estado_peticion']);
            $consulta->setProducto_peticionMai($listado['producto_mai']);
            $consulta->setFecha_atendidoMai($listado['fecha_atencion']);
            $consulta->setUsuario_atencionMai($listado['usuario_atencion']);
            $consulta->setName($listado['tipo_soportenombre']);
            $lista_peticionesMai[] = $consulta;
        }
        return $lista_peticionesMai;
    }

    public function liberarSolicitudMai($liberty)
    {
        session_start();
        $db = conectar::acceso();
        $liberando = $db->prepare('UPDATE peticiones_mai SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, estado_peticion=:estado_peticion 
        WHERE  id_peticionmai=:cod_peticion ');
        date_default_timezone_set('America/Bogota');
        $liberando->bindValue('fecha_atencion', date("Y-m-d H:i:s"));
        $liberando->bindValue('usuario_atencion', $_SESSION['usuario']);
        $liberando->bindValue('estado_peticion', 3);
        $liberando->bindValue('cod_peticion', $liberty->getId_peticionMai());
        $liberando->execute();
        if ($liberando) {
            echo 1;
        }
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

    public function consultarPeticionesMaixFuncionario()
    {
        $db = conectar::acceso();
        $lista_peticiones = [];
        $consultar_peticion = $db->prepare('SELECT id_peticionmai, productos_mai.nombre_producto AS producto_mai, fecha_peticion, descripcion_peticion, estado.descripcion AS estado_peticion, fecha_atencion, usuario_atencion, conclusiones, revisado, tipo_soportemai, tipo_soportemai.nombre, tipo_soportemai.id 
            FROM peticiones_mai 
            LEFT JOIN productos_mai ON productos_mai.id_producto=peticiones_mai.producto_mai 
            LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion 
            LEFT JOIN tipo_soportemai ON tipo_soportemai.id=peticiones_mai.tipo_soportemai
            WHERE usuario_creacion=:funcionario AND revisado=:noRevisado');
        $consultar_peticion->bindValue('noRevisado', 1);
        $consultar_peticion->bindValue('funcionario', $_SESSION['usuario']);
        $consultar_peticion->execute();
        foreach ($consultar_peticion->fetchAll() as $listado) {
            $consulta = new PeticionMai();
            $consulta->setId_peticionMai($listado['id_peticionmai']);
            $consulta->setProducto_peticionMai($listado['producto_mai']);
            $consulta->setFecha_peticionMai($listado['fecha_peticion']);
            $consulta->setDescripcion_peticionMai($listado['descripcion_peticion']);
            $consulta->setEstado_peticionMai($listado['estado_peticion']);
            $consulta->setFecha_atendidoMai($listado['fecha_atencion']);
            $consulta->setUsuario_atencionMai($listado['usuario_atencion']);
            $consulta->setConclusiones_peticionMai($listado['conclusiones']);
            $consulta->setMarca_revisado($listado['revisado']);
            $consulta->setName($listado['nombre']);
            $lista_peticiones[] = $consulta;
        }
        return $lista_peticiones;
    }

    public function marcarRevisado($marcar)
    {
        $db = conectar::acceso();
        $liberando = $db->prepare('UPDATE peticiones_mai SET revisado=:revisado WHERE id_peticionmai=:cod_peticion');
        $liberando->bindValue('revisado', 2);
        $liberando->bindValue('cod_peticion', $marcar->getId_peticionMai());
        $liberando->execute();
        if ($liberando) {
            echo 1;
        } else {
            echo 2;
        }
    }

    public function mostrartipoSoporte()
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

    public function revisionSeleccionar($usuario)
    {
        $db = conectar::acceso();
        $revisionSeleccionar = $db->prepare('SELECT COUNT(*) AS cuenta FROM peticiones_mai WHERE usuario_atencion =:usuario AND estado_peticion =:Seleccionar');
        $revisionSeleccionar->bindValue('usuario', $usuario);
        $revisionSeleccionar->bindValue('Seleccionar', '8');
        $revisionSeleccionar->execute();
        if ($revisionSeleccionar) {
            $cuenta = $revisionSeleccionar->FETCH(PDO::FETCH_ASSOC);
            $contador = $cuenta['cuenta'];
            if ($contador > 0) {
                $revisionSeleccionarID = $db->prepare('SELECT id_peticionmai FROM peticiones_mai WHERE usuario_atencion =:usuario AND estado_peticion =:Seleccionar LIMIT 1');
                $revisionSeleccionarID->bindValue('usuario', $usuario);
                $revisionSeleccionarID->bindValue('Seleccionar', '8');
                $revisionSeleccionarID->execute();
                if ($revisionSeleccionarID) {
                    $id = $revisionSeleccionarID->FETCH(PDO::FETCH_ASSOC);
                    $ticket = $id['id_peticionmai'];
                    echo $ticket;
                } else {
                    echo 'error';
                }
            } else {
                echo 0;
            }
        } else {
            echo ('error 400');
        }
    }
    public function traeObservaciones($ticket)
    {
        $db = conectar::acceso();
        $activosResponsable = [];
        $consultar_obs = $db->prepare('SELECT descripcion_observacion, usuario_creacion, fecha_observacion, estado.descripcion AS estado FROM observaciones_mai 
        LEFT JOIN estado ON estado.id_estado=observaciones_mai.estado_observacion WHERE id_ticket=:id_ticket AND (estado_observacion=2 OR estado_observacion=3 OR estado_observacion=18 OR estado_observacion=19 OR estado_observacion=20 OR estado_observacion=21 OR estado_observacion=23 OR estado_observacion=24 OR estado_observacion=25 OR estado_observacion=26) ORDER BY id_observacion DESC');
        $consultar_obs->bindValue('id_ticket', $ticket);
        $consultar_obs->execute();
        $observaciones = [];

        while ($listado_obs = $consultar_obs->fetch(PDO::FETCH_ASSOC)) {
            $observaciones[] = $listado_obs;
        }
        return $observaciones;
    }
    
    public function clientesHelisaPlus(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS helisaCloud FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',1);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setHelisacloud($lista['helisaCloud']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function clientesHelisaPremium(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS helisaPremium FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',2);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setHelisapremium($lista['helisaPremium']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function clientesHelisaReco(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS helisaReco FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',3);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setHelisareco($lista['helisaReco']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function clientesSoporteInterno(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS soporteInterno FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',4);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setSoporteinterno($lista['soporteInterno']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function clientesHelisaDymai(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS helisaDymai FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',5);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setHelisadymai($lista['helisaDymai']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function clientesCentroSoporte(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS centroSoporte FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',6);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setCentrosoporte($lista['centroSoporte']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function CRMRegistro(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS registroCRM FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',7);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setCRMregistro($lista['registroCRM']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function clientesHelisaTalento(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS helisaTalento FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',8);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setHelisatalento($lista['helisaTalento']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function clientesHelisaConekta(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS helisaConekta FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',9);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setHelisaconekta($lista['helisaConekta']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function helisaComplementos(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS instComplementos FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',10);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setHelisacomplementos($lista['instComplementos']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function helisaAtento(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS helisaAtento FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',11);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setHelisaAtento($lista['helisaAtento']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function aivoChatbot(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS chatBot FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',12);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setAivochatbot($lista['chatBot']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function Cemex(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS cemex FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',13);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setHelisacemex($lista['cemex']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function helisaTablero(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS helisaTablero FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',14);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setHelisatablero($lista['helisaTablero']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
    public function reInfraestructura(){
        $db=conectar::acceso();
        $conteo=[];
        $totales=$db->prepare('SELECT COUNT(producto_mai) AS redireccionadoInfraestructura FROM peticiones_mai LEFT JOIN productos_mai ON peticiones_mai.producto_mai=productos_mai.id_producto RIGHT JOIN estado ON peticiones_mai.estado_peticion=estado.id_estado where peticiones_mai.producto_mai=:productomai AND peticiones_mai.tipo_soportemai=:tiposoporte AND peticiones_mai.estado_peticion != :resuelto');
        $totales->bindvalue('tiposoporte',2);
        $totales->bindvalue('productomai',15);
        $totales->bindvalue('resuelto', 2);
        $totales->execute();

        foreach ($totales->fetchAll() as $lista){
            $consulta= new PeticionMai();
            $consulta->setReinfraestructura($lista['redireccionadoInfraestructura']);
            $conteo[]=$consulta;
        }
        return $conteo;
    }
}
