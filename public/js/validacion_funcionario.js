    $('#btn-guardar').click(function() {
        var arrayAcceso = [];
        var numeroInput = document.getElementsByClassName('acceso');
        var numeroAcceso = (numeroInput.length) / 4;
        $('.acceso').each(function() {
            arrayAcceso.push($(this).attr("id") + "=" + encodeURIComponent($(this).val()));
        });
        if ($('#formularioCrear').smkValidate()) {
            var infoCliente = arrayAcceso.join("&") +
                '&f_identificacion=' + $('#f_identificacion').val() +
                '&f_nombre=' + ($('#f_nombre').val()) +
                '&f_correo=' + $('#f_correo').val() +
                '&f_correo2=' + $('#f_correo2').val() +
                '&f_extension=' + $('#f_extension').val() +
                '&f_area=' + $('#f_area').val() +
                '&f_cargo=' + $('#f_cargo').val() +
                '&f_usuario=' + $('#f_usuario').val() +
                '&f_contrasena=' + $('#f_contrasena').val() +
                '&f_rol_funcionario=' + $('#f_rol_funcionario').val() +
                '&f_centroCostos=' + $('#f_centroCostos').val() +
                /* '&cantidad=' + numeroAcceso + */
                '&f_departamentoInterno=' + $('#f_departamentosInt').val() +
                '&crear=1';
            $.ajax({
                type: 'POST',
                url: '../controller/controlador_funcionarios.php',
                data: infoCliente

            }).done(function(data){
                console.log(data);
                if (data == 1) {
                    $('#formularioCrear').smkClear();
                    window.close();
                } else if (data == 3) {
                    $.smkAlert({
                        text: 'Revisa la correcta digitacion de la misma o revisa los usuarios ya creados.',
                        type: 'warning'
                    });
                    $.smkAlert({
                        text: 'La idnetificacion que deseas ingresar, ya se encuentra registrada dentro de la plataforma.',
                        type: 'warning'
                    });
                } else {
                    $.smkAlert({
                        text: 'Se presento un problema intente de nuevo',
                        type: 'danger'
                    });
                }

            });
        }
    });
    $('#cerrar_creacion').click(function() {
        window.close();
    })


/* OLD CREACION DE ACCESOS
    Crea input para los accesos de manera dinamica(sin funcionalidad despues de la creaccio de acceso a plataformas)

    $(document).ready(function() {
    var consecutivo = 0;
    $('#btn-creaAcceso').click(function() {
        if (consecutivo <= 10000) {
            consecutivo = consecutivo + 1;

            var tipo_acceso = document.getElementById("tipo_acceso");
            var input_tipoAcceso = document.createElement("select"); 

            var usuario = document.getElementById("usuario");
            var input_usuario = document.createElement("input");

            var clave = document.getElementById("clave");
            var input_clave = document.createElement("input");

            var fechaRegistro = document.getElementById("fechaRegistro");
            var input_fechaRegistro = document.createElement("input");


            var miOption1 = document.createElement("option");
            var miOption2 = document.createElement("option");
            var miOption3 = document.createElement("option");
            var miOption4 = document.createElement("option");
            var miOption5 = document.createElement("option");
            var miOption6 = document.createElement("option");
            var miOption7 = document.createElement("option");
            var miOption8 = document.createElement("option");
            var miOption9 = document.createElement("option");
            
            var miOption10 = document.createElement("option");
            var miOption11 = document.createElement("option");
            var miOption12 = document.createElement("option");
            var miOption13 = document.createElement("option");
            var miOption14 = document.createElement("option");
            var miOption15 = document.createElement("option");
            var miOption16 = document.createElement("option");
            var miOption17 = document.createElement("option");
            var miOption18 = document.createElement("option");
            var miOption19 = document.createElement("option");
            var miOption20 = document.createElement("option");

            var miOption21 = document.createElement("option");
            var miOption22 = document.createElement("option");
            var miOption23 = document.createElement("option");
            var miOption24 = document.createElement("option");
            var miOption25 = document.createElement("option");
            var miOption26 = document.createElement("option");
            var miOption27 = document.createElement("option");
            var miOption28 = document.createElement("option");
            var miOption29 = document.createElement("option");
            var miOption30 = document.createElement("option");

            var miOption31 = document.createElement("option");
            var miOption32 = document.createElement("option");
            var miOption33 = document.createElement("option");
            var miOption34 = document.createElement("option");


            miOption1.setAttribute("value", "1");
            miOption1.setAttribute("label", "ScreenConnect");
            input_tipoAcceso.appendChild(miOption1);

            miOption2.setAttribute("value", "2");
            miOption2.setAttribute("label", "Soporte Infraestructura");
            input_tipoAcceso.appendChild(miOption2);

            miOption3.setAttribute("value", "3");
            miOption3.setAttribute("label", "Utilidades -Dominio");
            input_tipoAcceso.appendChild(miOption3);

            miOption4.setAttribute("value", "4");
            miOption4.setAttribute("label", "Clave Celular");
            input_tipoAcceso.appendChild(miOption4);

            miOption5.setAttribute("value", "5");
            miOption5.setAttribute("label", "Elastix");
            input_tipoAcceso.appendChild(miOption5);

            miOption6.setAttribute("value", "6");
            miOption6.setAttribute("label", "Correo electr&oacutenico");
            input_tipoAcceso.appendChild(miOption6);

            miOption7.setAttribute("value", "7");
            miOption7.setAttribute("label", "N&uacutemero Celular Corporativo");
            input_tipoAcceso.appendChild(miOption7);

            miOption8.setAttribute("value", "8");
            miOption8.setAttribute("label", "Somos Helisa");
            input_tipoAcceso.appendChild(miOption8);

            miOption9.setAttribute("value", "9");
            miOption9.setAttribute("label", "Clave FTP Cloud");
            input_tipoAcceso.appendChild(miOption9);

            miOption10.setAttribute("value", "10");
            miOption10.setAttribute("label", "Servidor");
            input_tipoAcceso.appendChild(miOption10);

            miOption11.setAttribute("value", "11");
            miOption11.setAttribute("label", "Cloud Hosting");
            input_tipoAcceso.appendChild(miOption11);

            miOption12.setAttribute("value", "12");
            miOption12.setAttribute("label", "Moodle");
            input_tipoAcceso.appendChild(miOption12);

            miOption13.setAttribute("value", "13");
            miOption13.setAttribute("label", "Reco");
            input_tipoAcceso.appendChild(miOption13);

            miOption14.setAttribute("value", "14");
            miOption14.setAttribute("label", "Directorio Activo");
            input_tipoAcceso.appendChild(miOption14);

            miOption15.setAttribute("value", "15");
            miOption15.setAttribute("label", "Soporte Cloud");
            input_tipoAcceso.appendChild(miOption15);

            miOption16.setAttribute("value", "16");
            miOption16.setAttribute("label", "Mantis-Soporte");
            input_tipoAcceso.appendChild(miOption16);

            miOption17.setAttribute("value", "17");
            miOption17.setAttribute("label", "Mantis-Desarrollo");
            input_tipoAcceso.appendChild(miOption17);

            miOption18.setAttribute("value", "18");
            miOption18.setAttribute("label", "DyMAI/CGI");
            input_tipoAcceso.appendChild(miOption18);

            miOption19.setAttribute("value", "19");
            miOption19.setAttribute("label", "Antivirus");
            input_tipoAcceso.appendChild(miOption19);

            miOption20.setAttribute("value", "20");
            miOption20.setAttribute("label", "Consolas");
            input_tipoAcceso.appendChild(miOption20);

            miOption21.setAttribute("value", "21");
            miOption21.setAttribute("label", "Planos de copias");
            input_tipoAcceso.appendChild(miOption21);

            miOption22.setAttribute("value", "22");
            miOption22.setAttribute("label", "Maquinas Virtuales");
            input_tipoAcceso.appendChild(miOption22);
	    
	    miOption23.setAttribute("value", "23");
            miOption23.setAttribute("label", "Access Point");
            input_tipoAcceso.appendChild(miOption23);

            miOption24.setAttribute("value", "24");
            miOption24.setAttribute("label", "Hostdime");
            input_tipoAcceso.appendChild(miOption24);

            miOption25.setAttribute("value", "25");
            miOption25.setAttribute("label", "mi.com.co");
            input_tipoAcceso.appendChild(miOption25);

            miOption26.setAttribute("value", "26");
            miOption26.setAttribute("label", "Huellero");
            input_tipoAcceso.appendChild(miOption26);

            miOption27.setAttribute("value", "27");
            miOption27.setAttribute("label", "Godaddy");
            input_tipoAcceso.appendChild(miOption27);

            miOption28.setAttribute("value", "28");
            miOption28.setAttribute("label", "Extensi&oacuten");
            input_tipoAcceso.appendChild(miOption28);

            miOption29.setAttribute("value", "29");
            miOption29.setAttribute("label", "Firewall");
            input_tipoAcceso.appendChild(miOption29);

            miOption30.setAttribute("value", "30");
            miOption30.setAttribute("label", "Nodos");
            input_tipoAcceso.appendChild(miOption30);

            miOption31.setAttribute("value", "31");
            miOption31.setAttribute("label", "NDC-Host");
            input_tipoAcceso.appendChild(miOption31);

            miOption32.setAttribute("value", "32");
            miOption32.setAttribute("label", "CRM");
            input_tipoAcceso.appendChild(miOption32);

            miOption33.setAttribute("value", "33");
            miOption33.setAttribute("label", "Atento");
            input_tipoAcceso.appendChild(miOption33);

            miOption34.setAttribute("value", "34");
            miOption34.setAttribute("label", "Soporte Premium");
            input_tipoAcceso.appendChild(miOption34);


            input_tipoAcceso.type = 'text'; 
            $(input_tipoAcceso).addClass('form-control my-2 info acceso');
            $(input_tipoAcceso).attr('required', true);
            $(input_tipoAcceso).prop('id', 'tipo_acceso' + consecutivo);

            input_usuario.type = 'text';
            $(input_usuario).addClass('form-control my-2 info acceso');
            $(input_usuario).attr('required', true);
            $(input_usuario).prop('id', 'usuario' + consecutivo);

            input_clave.type = 'text';
            $(input_clave).addClass('form-control my-2 info acceso');
            $(input_clave).attr('required', 'true');
            $(input_clave).prop('id', 'clave' + consecutivo);

            input_fechaRegistro.type = 'date';
            $(input_fechaRegistro).addClass('form-control my-2 info acceso');
            $(input_fechaRegistro).attr('required', true);
            $(input_fechaRegistro).prop('id', 'fechaRegistro' + consecutivo);

        }

        tipo_acceso.appendChild(input_tipoAcceso);
        usuario.appendChild(input_usuario);
        clave.appendChild(input_clave);
        fechaRegistro.appendChild(input_fechaRegistro);

        
    });


    $('#btn-eliminaAcceso').click(function() {
        if (consecutivo != 0) {
            $('#tipo_acceso' + consecutivo).remove();
            $('#usuario' + consecutivo).remove();
            $('#clave' + consecutivo).remove();
            $('#fechaRegistro' + consecutivo).remove();

            consecutivo = consecutivo - 1;
        }
    }); 
    
    });*/

