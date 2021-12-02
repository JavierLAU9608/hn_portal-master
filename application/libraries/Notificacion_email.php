<?php

require_once(APPPATH . '/libraries/Send_mail.php');

class notificacion_email {

    var $obj_email;
    var $controlador;
    var $_email_no_reply;
    var $_destinos;
    var $asunto;
    var $_datos;
    var $_diseno;

    function __construct()
    {
        $this->controlador = & get_instance();
        $this->_email_no_reply = $this->controlador->config->item('email-no-reply');
        $this->obj_email = new Send_Mail();
        $this->_datos['nombre_sistema'] = $this->controlador->app_config('nombre_sistema');
        $this->_datos['direccion_empresa'] = $this->controlador->sitio->st_get_informacion_simple_directa('direccion');

        $telefonos_empresa = $this->controlador->sitio->st_get_informacion_multiple('telefono');
        $telefonos = array();
        foreach ($telefonos_empresa as $key => $t)
        {
            $telefonos[$key]['telefono'] = $t['value'];
        }
        $this->_datos['telefonos_empresa'] = $telefonos;
        $this->_datos['swift'] = $this->controlador->sitio->st_get_informacion_simple_directa('swift');
        $this->_datos['cuentabanco'] = $this->controlador->sitio->st_get_informacion_simple_directa('cuentabanco');
        $this->_datos['titularcuenta'] = $this->controlador->sitio->st_get_informacion_simple_directa('titularcuenta');
        $this->_datos['banco'] = $this->controlador->sitio->st_get_informacion_simple_directa('banco');
        $this->_datos['email_empresa'] = $this->controlador->sitio->st_get_informacion_simple_directa('correoreserva1');
        $this->_datos['url_sitio'] = base_url();
    }

    function set_datos($nuevos_datos)
    {
        $this->_datos = array_merge($this->_datos, $nuevos_datos);
    }

    function notificacion_recuperar_contrasena($informacion)
    {
        $this->obj_email->_email_view = 'email/recuperar_contrasena';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = trans("mail_asunto_recuperar_contrasenna");
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['correo']));
        $this->obj_email->send();
    }

    function notificacion_usuario_creado($informacion)
    {
        $this->obj_email->_email_view = 'email/usuario_creado';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = trans("mail_asunto_usuario_creado");
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['correo']));
        $this->obj_email->send();
    }

    function boletin($informacion)
    {
        $informacion['asunto'] = trans('mail_asunto_boletin');
        $this->obj_email->_email_view = 'email/boletin';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = trans("mail_asunto_boletin");
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => $informacion['subscritor']);
        $this->obj_email->send();
    }

    function notificacion_reserva_cancelada($informacion, $productos)
    {
        $informacion['productos_carrito'] = $this->renderizar_vistas_productos($productos);
        $informacion['asunto'] = trans('mail_asunto_reservacion_cancelada', array('no_reserva' => $informacion['no_reserva']));
        $this->obj_email->_email_view = 'email/reserva_cancelada';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = $informacion['asunto'];
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['email']), 1 => array('email_notificacion' => $this->_datos['email_empresa']));
        $this->obj_email->send();
    }

    function notificacion_reserva_x_pagar($asunto, $informacion, $productos)
    {
        $informacion['productos'] = $productos;
        $this->obj_email->_email_view = 'email/reserva_x_pagar';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = $asunto;
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['email']));
        $this->obj_email->send();
    }

    function notificacion_solicitud_contacto($informacion)
    {
        $this->obj_email->_email_view = 'email/solicitud_contacto';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = $informacion['asunto'];
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $this->_datos['email_empresa']));

        $this->obj_email->send();
    }

    private function renderizar_vistas_productos($productos, $otros_detalles = array())
    {
        foreach ($productos as $key => &$producto)
        {
            if (isset($producto['options']['tipo'])) {
                $tipo_producto = $producto['options']['tipo'];
                $producto['plantilla_producto'] = $this->controlador->load->view('productos/' . $tipo_producto . '/template_email', array('producto' => $producto, 'otros_detalles' => $otros_detalles), true);
            }
        }
        return $productos;
    }

    function notificacion_pago_transferencia($informacion, $productos)
    {
        $informacion['productos_carrito'] = $this->renderizar_vistas_productos($productos);
        $informacion['asunto'] = trans('mail_asunto_pago_transferencia', array('no_reserva' => $informacion['no_reserva']));
        $this->obj_email->_email_view = 'email/pago_transferencia';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = $informacion['asunto'];
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['email']), 1 => array('email_notificacion' => $this->_datos['email_empresa']));
        $this->obj_email->send();
    }

    function notificacion_pago_pasarela($informacion, $productos)
    {
        // add correo de cancelación
        $email_cancelacion = $this->controlador->sitio->st_get_informacion_simple_directa('email_cancelacion');
        $informacion['email_cancelacion'] = $email_cancelacion;

        $informacion['productos_carrito'] = $this->renderizar_vistas_productos($productos);
        $informacion['asunto'] = trans('mail_asunto_pago_pasarela', array('no_reserva' => $informacion['no_reserva']));
        $this->obj_email->_email_view = 'email/pago_pasarela';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = $informacion['asunto'];
        $this->obj_email->_from = $this->_email_no_reply;

        $destinatarios = array();

        // propietario de la reserva
        $this->add_destinatario($destinatarios, $informacion['email']);

        // propietario de la tarjeta
        if (isset($informacion['email_titualar_tarjeta']))
        {
            $this->add_destinatario($destinatarios, $informacion['email_titualar_tarjeta']);
        }

        // encargado de la reserva
        $this->add_destinatario($destinatarios, $this->controlador->sitio->st_get_informacion_simple_directa('correoreserva1'));
        $this->add_destinatario($destinatarios, $this->controlador->sitio->st_get_informacion_simple_directa('correoreserva2'));

        // en caso de que los eventos se desactiven A CONFIRMAR
        $correos_de_responsables_eventos = $this->responsables_eventos($productos);
        if (count($correos_de_responsables_eventos) > 0)
        {
            // cada responsable de evento
            foreach ($correos_de_responsables_eventos as $correo)
            {
                $this->add_destinatario($destinatarios, $correo);
            }

            // encargado de los eventos
            $enc_eventos = $this->controlador->sitio->st_get_informacion_simple_directa('correoreservaevento');
            $this->add_destinatario($destinatarios, $enc_eventos);
        }

        // agregado para notificar por producto
        $correo = $this->controlador->sitio->st_get_informacion_simple_directa('email_riesgo');
        $this->add_destinatario($destinatarios, $correo);
        if ($this->has_productos_tipos($productos, 'oferta')) {
            $correo = $this->controlador->sitio->st_get_informacion_simple_directa('email_oferta');
            $this->add_destinatario($destinatarios, $correo);
        } elseif ($this->has_productos_tipos($productos, 'restaurante') ) {
            $correo = $this->controlador->sitio->st_get_informacion_simple_directa('email_restaurante');
            $this->add_destinatario($destinatarios, $correo);
        }

        $this->add_destinatario($destinatarios, 'posicionamientoweb@bidaiondo.com');
        $this->add_destinatario($destinatarios, 'webmaster@gcnacio.gca.tur.cu');
        $this->add_destinatario($destinatarios, 'roll3lg@gmail.com');

        foreach ($destinatarios as $correo)
        {
            $this->obj_email->_to [] = array('email_notificacion' => $correo);
        }

        $this->obj_email->send();
    }

    function notificacion_cambio_de_responsable($reserva)
    {
        $data = $this->_datos;
        $data['reserva'] = $reserva;
        $html = $this->controlador->twig->render('email/cambio_responsable', $data);

        $subject = trans('mail_asunto_responsable_modificado');
        $from = $this->_email_no_reply;
        $from_name = $this->_datos['nombre_sistema'];

        $destinatarios = array();

        // encargado de la reserva
        $this->add_destinatario($destinatarios, $this->controlador->sitio->st_get_informacion_simple_directa('correoreserva1'));
        $this->add_destinatario($destinatarios, $this->controlador->sitio->st_get_informacion_simple_directa('correoreserva2'));

        $this->add_destinatario($destinatarios, 'posicionamientoweb@bidaiondo.com');
        $this->add_destinatario($destinatarios, 'webmaster@gcnacio.gca.tur.cu');

        foreach ($destinatarios as $destinatario) {
            $this->obj_email->_send_email($from_name, $from, $destinatario, $subject, $html);
        }
    }

    function notificacion_pago_pasarela_error($informacion, $productos, $error)
    {
        $informacion['productos_carrito'] = $this->renderizar_vistas_productos($productos);
        $informacion['asunto'] = trans('mail_asunto_pago_pasarela_error', array('no_reserva' => $informacion['no_reserva']));

        if (strrpos($error, "9104") === false) {
            $this->obj_email->_email_view = 'email/pago_pasarela_error';
        } else {
            $this->obj_email->_email_view = 'email/pago_pasarela_seguridad';
        }

        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = $informacion['asunto'];
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['email']),
            1 => array('email_notificacion' => $this->_datos['email_empresa'])
        );
        $this->obj_email->send();
    }

    function has_productos_tipos($productos, $tipo)
    {
        foreach ($productos as $key => $item) {
            if (isset($item['options']['tipo']) && $item['options']['tipo'] == $tipo )
            {
                return true;
            }
        }

        return false;
    }

    function add_destinatario(&$destinatarios, $email)
    {
        if (trim($email) == '') {
            return;
        }

        if (!in_array($email, $destinatarios))
        {
            $destinatarios [] = $email;
        }
    }

    function notificacion_reserva_aconfirmar($informacion, $productos)
    {
        $informacion['productos_carrito'] = $this->renderizar_vistas_productos($productos);
        $informacion['asunto'] = trans('mail_asunto_pago_a_confirmar', array('no_reserva' => $informacion['no_reserva']));
        $this->obj_email->_email_view = 'email/productos_aconfirmar';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = $informacion['asunto'];
        $this->obj_email->_from = $this->_email_no_reply;

        $destinatarios = array();
        // propietario de la reserva
        $this->add_destinatario($destinatarios,$informacion['email']);

        // propietario de la tarjeta
        if (isset($informacion['email_titualar_tarjeta']))
        {
            $this->add_destinatario($destinatarios, $informacion['email_titualar_tarjeta']);
        }

        // encargado de la reserva
        $this->add_destinatario($destinatarios, $this->controlador->sitio->st_get_informacion_simple_directa('correoreserva1'));
        $this->add_destinatario($destinatarios, $this->controlador->sitio->st_get_informacion_simple_directa('correoreserva2'));

        $correos_de_responsables_eventos = $this->responsables_eventos($productos);
        if (count($correos_de_responsables_eventos) > 0)
        {
            // cada responsable de evento
            foreach ($correos_de_responsables_eventos as $correo)
            {
               $this->add_destinatario($destinatarios, $correo);
            }

            // encargado de los eventos
            $this->add_destinatario($destinatarios, $this->controlador->sitio->st_get_informacion_simple_directa('correoreservaevento'));
        }

        foreach ($destinatarios as $correo)
        {
            $this->obj_email->_to [] = array('email_notificacion' => $correo);
        }

        $this->obj_email->send();
    }

    /**
     * Devuelve los correos de los responsables de los eventos, se maneja como array pues se pueden
     * reservar varios eventos a la misma vez.
     *
     * @param type $productos
     * @return array
     */
    private function responsables_eventos($productos)
    {
        $resp = array();
        foreach ($productos as $key => $value)
        {
            if ($value['name'] == 'evento')
            {
                $resp [] = $value['options']['email'];
            }
        }

        return $resp;
    }

    function notificacion_reserva_confirmada($informacion, $productos)
    {
        $informacion['productos_carrito'] = $this->renderizar_vistas_productos($productos);
        $informacion['asunto'] = trans('mail_asunto_reserva_confirmada', array('no_reserva' => $informacion['no_reserva']));
        $this->obj_email->_email_view = 'email/reserva_confirmada';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = $informacion['asunto'];
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['email']));
        $this->obj_email->send();
    }

    function notificacion_reserva_cancelada_administrador($informacion, $productos)
    {
        $informacion['productos_carrito'] = $this->renderizar_vistas_productos($productos);
        $informacion['asunto'] = trans('mail_asunto_reserva_confirmacion_cancelada', array('no_reserva' => $informacion['no_reserva']));
        $this->obj_email->_email_view = 'email/reserva_cancelada_admin';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = $informacion['asunto'];
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['email']));
        $this->obj_email->send();
    }

    function notificacion_reserva_pagada_transferencia($informacion, $productos, $num_transferencia)
    {
        $informacion['productos_carrito'] = $this->renderizar_vistas_productos($productos);
        $informacion['asunto'] = trans('mail_asunto_reserva_pagada_transferencia', array('no_reserva' => $informacion['no_reserva']));
        $informacion['no_transferencia'] = $num_transferencia;
        $this->obj_email->_email_view = 'email/reserva_pagada_transferencia';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = $informacion['asunto'];
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['email']));
        $this->obj_email->send();
    }

    function notificacion_reserva_editada_pagada($informacion, $productos)
    {
        $informacion['productos_carrito'] = $this->renderizar_vistas_productos($productos);
        $this->obj_email->_email_view = 'email/reserva_editada_pagada';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = trans("C_Reserva_Editada_Pagada");
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['email']), 1 => array('email_notificacion' => $this->_datos['email_empresa']));
        $this->obj_email->send();
    }

    function notificacion_devolucion_dinero_cliente($informacion)
    {
        $this->obj_email->_email_view = 'email/devolucion_dinero_cliente';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = trans("C_Devolucion_Dinero");
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['email']), 1 => array('email_notificacion' => $this->_datos['email_empresa']));
        $this->obj_email->send();
    }

    function notificacion_reserva_prestatario($informacion, $producto, $asunto = NULL)
    {
        $this->obj_email->_email_view = 'email/correo_prestatario_producto';

        $informacion['plantilla_producto'] = $this->controlador->load->view('email/prestatario_templates/' . $informacion['tipo_producto'], array('producto' => $producto), true);

        if (isset($producto['detalles_adicionales']) || isset($producto['informacion_adicional']['detalles_adicionales']))
            $informacion['nota'] = isset($producto['detalles_adicionales']) ? $producto['detalles_adicionales'] : $producto['informacion_adicional']['detalles_adicionales'];
        else
            $informacion['nota'] = '';

        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        if ($asunto == NULL)
            $asunto = 'C_Solicitud_Reserva';
        $this->obj_email->_subject = trans($asunto) . ' ' . $producto['no_reserva'];
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['email_prestatario']), 1 => array('email_notificacion' => $this->_datos['email_empresa']));
        $this->obj_email->send();
    }

    function notify_development_error_reserve($extra = array())
    {
        $message = $this->controlador->load->view('email/reserva_error_development', $extra, true);
        $subject = "Error reserva";

        $mail = $this->obj_email;

        $mail->_send_email('Nacional', 'noreply@hotelnacional.cu', 'roll3lg@gmail.com', $subject, $message);

        $mail->_send_email('Nacional', 'noreply@hotelnacional.cu', 'lgglez2013@gmail.com', $subject, $message);
    }

    function nuevo_contacto($informacion)
    {
        $this->obj_email->_email_view = 'email/contacto';
        $this->obj_email->_data_mail = array_merge($this->_datos, $informacion);
        $this->obj_email->_subject = trans("mail_asunto_contacto");
        $this->obj_email->_from = $this->_email_no_reply;
        $this->obj_email->_to = array(0 => array('email_notificacion' => $informacion['correo']));

        $destinatarios = [
            'webmaster@gcnacio.gca.tur.cu',
            'hotelnacionaldecuba@gmail.com',
            'ventas@gcnacio.gca.tur.cu',
            'jcomercial@gcnacio.gca.tur.cu',
            'comercial1@gcnacio.gca.tur.cu',
            'comercial3@gcnacio.gca.tur.cu',
            'eventos@gcnacio.gca.tur.cu',
            'comercial5@gcnacio.gca.tur.cu',
        ];
        foreach ($destinatarios as $correo)
        {
            $this->obj_email->_to [] = array('email_notificacion' => $correo);
        }

        $this->obj_email->send();
    }
}

?>