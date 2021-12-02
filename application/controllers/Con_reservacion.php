<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Con_reservacion extends APP_Controller
{

    var $root_productos = 'productos/';

    function __construct()
    {
        parent::__construct();
        $this->url_base .= trans('ruta_carro_compra');
        $this->load->model('mod_reservacion', 'reservacion');
    }

    public function carro_compra()
    {
        app_clear_reservas_activas();
        $datos = array();
        $lista_productos_carro = $this->cart->contents();

        $this->load->model('mod_alojamiento', 'alojamiento');
        foreach ($lista_productos_carro as $key => &$producto) {
            $producto['options']['template_car'] = $this->twig->render($this->root_productos . $producto['options']['tipo'] . '/template_car',
                array(
                    'key_producto' => $key,
                    'producto' => $producto,
                    'datos_adicionales' => $producto['options'],
                    'hotel' => $this->alojamiento->get_hotel()
                ), true);
        }
        $datos['lista_productos_carro'] = $lista_productos_carro;
        $datos['total_productos'] = $this->cart->total_items();
        $datos['total_monto'] = $this->cart->total();

        $datos['items'] = $this->_menu_vertical();
        $datos['item_activo'] = '';

        //$this->load->view('carro_compra', $datos);
        $this->display('carro_compra', $datos);
    }

    public function cancelar_producto_car($rowid)
    {
        $this->cart->remove($rowid);
        $this->go();
    }

    public function cancelar_producto_confirmado_car($rowid)
    {
        $usuario_registrado = app_usuario();
        $rowid = trim($rowid);
        $producto = $this->cart->get_item($rowid);
        if ($usuario_registrado['id'] > 0) {
            //preguntar si el titular de la tarjeta es el usuario que esta registrado
            if ($this->reservacion->valida_cliente_reserva($usuario_registrado['id'], $producto['options']['id_reserva_confirmada'])) {
                //en caso verdadero eliminar la reserva en cascada
                $tipo_producto = $producto['options']['tipo'];
                $obj_modelo_producto = 'reservacion_producto_' . $tipo_producto;

                $this->load->model('mod_reservacion_' . $tipo_producto, $obj_modelo_producto);

                if ($this->$obj_modelo_producto->eliminar_reserva_confirmada($producto['options']['id_reserva_confirmada']) == true) {
                    $this->cart->remove($rowid);
                }
                $this->go();
            } else
                $this->go();
        } else
            $this->go();
    }

    public function cancelar_producto_pagado($str_producto, $id_reserva)
    {
        $usuario_registrado = app_usuario();
        if ($this->reservacion->valida_cliente_reserva($usuario_registrado['id'], $id_reserva) == true) {
            $obj_modelo_reserva_producto = $str_producto . 'reservacion';

            $this->load->model('mod_reservacion_' . $str_producto, $obj_modelo_reserva_producto);

            $reserva = $this->$obj_modelo_reserva_producto->get_reserva($id_reserva);
            if ($reserva['options']['estado'] == 4) {
                $reserva['options']['tipo'] = $str_producto;
                $modulos = app_config('producto_modulo_key');
                $modulos[$str_producto];

                $dias_antelacion = app_diferencia_fecha(app_now(), $reserva['options']['fecha']);
                if ($dias_antelacion > 0) {
                    $this->load->model('mod_seguridad', 'seguridad');
                    $usuario_tarjeta = $this->seguridad->get_usuario(array('id' => $reserva['options']['titular_tarjeta_fk']));
                    $usuario_reserva = $this->seguridad->get_usuario(array('id' => $reserva['options']['persona_reserva_fk']));
                    $datos_email_reserva = array(
                        'nombre' => $usuario_reserva['nombre'],
                        'email' => $usuario_reserva['correo'],
                        'titualar_tarjeta' => $usuario_tarjeta['nombre'],
                        'titular_reserva' => $usuario_reserva['nombre'],
                        'no_reserva' => $reserva['options']['no_reserva']
                    );
                    $importe_reserva = $reserva['price'];
                    $datos_email_reserva['importe_reserva'] = (app_rate_cambio($importe_reserva, 'ltr'));
                    $politica = $this->reservacion->get_politica_cancelar($modulos[$str_producto], $dias_antelacion);
                    $reintegro = $importe_reserva;
                    $descuento = 0;
                    $por_ciento = 0;
                    if ($politica) {
                        $por_ciento = $politica['porciento'];
                        $descuento = ($importe_reserva * $por_ciento) / 100;
                        if ($descuento < $politica['valor_minimo']) {
                            $descuento = $politica['valor_minimo'];
                        }
                        $reintegro = $importe_reserva - $descuento;
                    }
                    $datos_email_reserva['descuento'] = app_rate_cambio($descuento, 'ltr');
                    $datos_email_reserva['reintegro'] = app_rate_cambio($reintegro, 'ltr');
                    $this->load->library('notificacion_email');
                    $this->reservacion->actualizar_reserva($id_reserva, array('estado_fk' => 6));
                    $operacion_cancelar = array('fecha' => app_now(),
                        'tipo_operacion_fk' => 2,
                        'reserva_fk' => $id_reserva,
                        'precio_total' => $importe_reserva,
                        'politica_porciento' => $por_ciento,
                        'penalizacion' => $descuento
                    );
                    $this->reservacion->insert_operacion_reserva($operacion_cancelar);
                    $this->notificacion_email->notificacion_reserva_cancelada($datos_email_reserva, array(0 => $reserva));
                    $this->display('informativas/reserva_cancelada', $datos_email_reserva);
                } else {
                    $this->_error(trans('error_acceso_no_autorizado'));
                }
            } else {
                $this->_error(trans('error_acceso_no_autorizado'));
            }
        } else {
            $this->_error(trans('error_acceso_no_autorizado'));
        }
    }

    public function editar_reserva_car($rowid)
    {
        if ($reserva = $this->cart->get_item($rowid)) {
            $tipo_producto = $reserva['options']['tipo'];
            $this->session->set_userdata(array('reserva_activa_' . $tipo_producto => $rowid));
            $url_reserva = trans('ruta_reservar_' . $tipo_producto, $reserva['options']);
            redirect(base_url($url_reserva));
        } else
            $this->go();
    }

    public function datos_reserva()
    {
        if ($this->cart->total_items() > 0) {
            $datos = array();
            $datos['formas_pago'] = $this->reservacion->get_formas_pago();
            //COMPROBAR RELEASE DE LA FORMA DE PAGO
            $formas_pago_validas = array();
            $fecha_actual = app_now();
            $menor_fecha_productos = $this->cart->menor_fecha();
            foreach ($datos['formas_pago'] as $keyfp => $fp) {
                $fecha_posible = app_dateadd($fecha_actual, $fp['release']);
                if ($fecha_posible < $menor_fecha_productos)
                    $formas_pago_validas[] = $fp;
            }
            $datos['formas_pago'] = $formas_pago_validas;
            //FIN DE COMPROBAR RELEASE
            //INICIO PARA EL HN
            $todos_restaurantes = true;
            $productos = $this->cart->contents();
            foreach ($productos as $p) {
                if ($p['options']['tipo'] !== 'restaurante')
                    $todos_restaurantes = false;
            }
            if ($todos_restaurantes == true) {
                //ELIMINAR LA FORMA DE PAGO TRANSFERENCIA
                $key_transferencia = NULL;
                foreach ($datos['formas_pago'] as $keyfp => $fp) {
                    if ($fp['id'] == 3) {
                        unset($datos['formas_pago'][$keyfp]);
                        break;
                    }
                }
            }
            //FIN PARA HN

            //TARJETAS
            $tarjetas = $this->_tarjetas_comercio();
            //print_r($tarjetas);exit;
            $datos['tarjetas'] = $tarjetas;
            $datos['existen_productos_no_confirmar'] = $this->cart->todos_a_confirmar();
            $datos['usuario'] = $this->session->flashdata('temp_post') == null ? app_usuario() : $this->session->flashdata('temp_post');
            $datos['flash_error'] = $this->session->flashdata('flash_error');
            $datos['marcado_regalo'] = $this->session->flashdata('marcado_como_regalo');

            $datos['paises'] = app_paises();
            $this->display('datos_reserva', $datos);
        } else
            $this->go();
    }

    public function pagar_pago_calendario($producto, $id)
    {
        if ($pago = $this->reservacion->get_pago_del_calendario($id)) {
            $obj_modelo_producto = $producto . 'reservacion';
            $this->load->model('mod_reservacion_' . $producto, $obj_modelo_producto);
            if ($reserva = $this->$obj_modelo_producto->get_reserva($pago['reserva_fk'])) {
                if ($pago['pago_porciento'] == 't')
                    $importe_a_pagar = ($reserva['price'] * $pago['precio']) / 100;
                else
                    $importe_a_pagar = $pago['precio'];

                $reserva['options']['tipo'] = $producto;

                $this->load->model('mod_seguridad', 'seguridad');
                //ALMACENAR LOS PRODUCTOS QUE SE PAGARAN EN LA PASARELA
                $info = array('productos_a_pagar' => serialize(array(0 => $reserva)),
                    'reserva_base' => serialize($reserva),
                    'datos_titular_tarjeta' => serialize($this->seguridad->get_usuario(array('id' => $reserva['options']['titular_tarjeta_fk']))),
                    'datos_titular_reserva' => serialize($this->seguridad->get_usuario(array('id' => $reserva['options']['persona_reserva_fk']))),
                    'fecha' => date("Y/m/d", strtotime('now')),
                    'estado' => 0,
                    'calendario_fk' => $pago['id']
                );

                $this->_enviar_formulario_pasarela($info, $importe_a_pagar);
            }
        } else
            $this->_error(trans('error_inesperado'));
    }

    public function confirmar_pagar()
    {
        if ($this->cart->total_items() > 0) {
            if ($this->input->post("btn_confirmar_y_pagar")) {
                //$this->input->post("aceptar_terminos")
                $this->load->helper(array('form'));
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('', '<br/>');
                $validador = 'datos_reserva';
                if ($this->input->post("titular_diferente")) {
                    $validador = 'datos_reserva_regalo';
                }
                if ($this->form_validation->run($validador) == FALSE) {
                    $this->session->set_flashdata('flash_error', validation_errors());
                    $this->session->set_flashdata('temp_post', $_POST);
                    $this->session->set_flashdata('marcado_como_regalo', $this->input->post("titular_diferente"));
                    redirect(base_url(trans('ruta_datos_reserva')));
                    exit();
                }

                $this->load->library('notificacion_email');
                $datos_titular_reserva = array();
                $datos_titular_tarjeta = array();

                $datos_titular_reserva['nombre'] = $this->input->post("nombre_titular");
                $datos_titular_reserva['email'] = $this->input->post("email_titular");
                $datos_titular_reserva['pais'] = $this->input->post("pais_titular");
                $datos_titular_reserva['telefono'] = $this->input->post("telefono_titular");
                $datos_titular_reserva['pasaporte'] = $this->input->post("pasaporte_titular");
                $tarjeta = $this->input->post("optionsRadios");

                if ($this->input->post("titular_diferente")) {
                    $datos_titular_tarjeta['nombre'] = $this->input->post("nombre_titular_tarjeta");
                    $datos_titular_tarjeta['email'] = $this->input->post("email_titular_tarjeta");
                    $datos_titular_tarjeta['pais'] = $this->input->post("pais_titular_tarjeta");
                    $datos_titular_tarjeta['telefono'] = $this->input->post("telefono_titular_tarjeta");
                    $datos_titular_tarjeta['pasaporte'] = $this->input->post("pasaporte_titular_tarjeta");
                    $this->_usuario_reserva($datos_titular_tarjeta);
                } else {
                    $datos_titular_tarjeta = $datos_titular_reserva;
                }

                $this->_usuario_reserva($datos_titular_reserva);

                $reserva_titular_reserva = $this->seguridad->get_usuario(array('correo' => $datos_titular_reserva['email']));
                $reserva_titular_tarjeta = $this->seguridad->get_usuario(array('correo' => $datos_titular_tarjeta['email']));

                $identificador_car = md5(microtime());

                //PROCESO PRINCIPAL DE LA RESERVA
                //0 Clasificar el tipo de pago en transferencia o pasarela
                $modalidad_pago = '';
                //en la BD la tabla frontend_forma_pago transferencia es el 3 y pasarela es el 2
                if ($this->input->post("forma_pago") == 3) {
                    $modalidad_pago = 3;
                } else {
                    $modalidad_pago = 2;
                }
                //0.1 Obtener el monto total a pagar
                $importe_carro_compra = $this->cart->informacion_carro_compra();
                $monto_total_a_pagar = $importe_carro_compra['importe_pagar'];
                $monto_total_a_confirmar = $importe_carro_compra['importe_no_pagar'];
                //1 Obtener las reservas a confirmar
                $productos_carro_compra = $this->cart->desglozar_carro_compra();
                $productos_a_confirmar = $productos_carro_compra['aconfirmar'];
                $producto_a_pagar = $productos_carro_compra['pagar'];
                $total_productos_a_confirmar = $productos_carro_compra['total_a_confirmar'];
                $total_productos_a_pagar = $productos_carro_compra['total_a_pagar'];
                $total_productos = $productos_carro_compra['total'];

                $reserva_base = array('titular_tarjeta_fk' => $reserva_titular_tarjeta['id'],
                    'persona_reserva_fk' => $reserva_titular_reserva['id'],
                    'forma_pago_fk' => $modalidad_pago,
                    'estado_fk' => 0,
                    'key_car' => $identificador_car,
                    'pk_idioma' => $this->idioma_current['id'],
                    'pk_moneda' => $this->moneda_current['id'],
                    'no_reserva' => $this->_generar_no_reserva($datos_titular_tarjeta['pais'], $total_productos),
                    'tarjeta' => $tarjeta,
                );
                $datos_email_reserva = array('nombre' => $datos_titular_tarjeta['nombre'],
                    'email' => $datos_titular_tarjeta['email'],
                    'titualar_tarjeta' => $datos_titular_tarjeta['nombre'],
                    'titular_reserva' => $datos_titular_reserva['nombre'],
                    'pasaporte' => $datos_titular_reserva['pasaporte'],
                    'no_reserva' => $reserva_base['no_reserva']
                );
                //1.1 Si existe reservas a confirmar insertarlas en la BD
                if ($total_productos_a_confirmar > 0) {
                    //frontend_estado_reserva el 2 es espera_confirmacion_admin
                    $this->_procesar_reservas_aconfirmar($productos_a_confirmar, $monto_total_a_confirmar, $identificador_car, $reserva_base, $datos_email_reserva);
                    //1.2 Eliminar de la session las reservas a confirmar
                    if ($total_productos_a_confirmar == $total_productos) {
                        //1.3 Si todas las reservas son de a confirmar enviar a la pagina de info reservas a confirmar
                        redirect(base_url('con_reservacion/info_reserva_aconfirmar/' . $identificador_car));
                    }
                }
                switch ($modalidad_pago) {
                    case 3:
                    {
                        $this->_procesar_transferencia($producto_a_pagar, $monto_total_a_pagar, $identificador_car, $reserva_base, $datos_email_reserva);
                        break;
                    }
                    case 2:
                    {
                        $this->_enviar_a_la_pasarela($identificador_car, $producto_a_pagar, $importe_carro_compra, $reserva_base, $datos_titular_tarjeta, $datos_titular_reserva, $tarjeta);
                        break;
                    }
                }
                //END DEL PROCESO PRINCIPAL DE LA RESERVA
            } else
                $this->go();
        } else
            $this->go();
    }

    /*
      Comprueba si el correo existe registrado, en caso contrario crea un nuevo usuario con los datos del titular
      y envia la informacion por correo al cliente
     */

    private function _usuario_reserva($datos_titular_tarjeta)
    {
        //buscar si existe creado el titular de la tarjeta y si no esta crear usuario
        $this->load->model('mod_seguridad', 'seguridad');
        if (!$this->seguridad->get_usuario(array('correo' => $datos_titular_tarjeta['email']))) {
            $this->load->library('generarpass');
            $datos_titular_tarjeta['contrasena'] = $this->generarpass->generar_pass();

            $datos_titular_tarjeta['link_activacion'] = 'link';
            $codigo_activacion = md5(microtime());
            $info = array(
                'nombre' => $datos_titular_tarjeta['nombre'],
                'correo' => $datos_titular_tarjeta['email'],
                'password' => $datos_titular_tarjeta['contrasena'],
                'telefono' => $datos_titular_tarjeta['telefono'],
                'confirm_mail' => 'f',
                'pais_fk' => $datos_titular_tarjeta['pais'] == '' ? NULL : $datos_titular_tarjeta['pais'],
                'pasaporte' => $datos_titular_tarjeta['pasaporte'] == '' ? NULL : $datos_titular_tarjeta['pasaporte'],
                'active_code' => $codigo_activacion
            );
            if ($this->seguridad->insert_usuario($info)) {
                // y enviar correo de usuario creado con pass nuevo
                $info['link_activacion'] = base_url(trans('ruta_activar_cuenta', array('codigo' => $codigo_activacion)));
                $this->notificacion_email->notificacion_usuario_creado($info);
            } else
                redirect(base_url(trans('ruta_datos_reserva')));
        } else {
            $email = $datos_titular_tarjeta['email'];
            $passport = $datos_titular_tarjeta['pasaporte'];
            $user = $this->session->userdata('usuario_registrado');
            $paisId = $datos_titular_tarjeta['pais'];

            // actualizar la sesión
            if ($user['correo'] == $email) {
                $user['pais_fk'] = $paisId;
                $user['pasaporte'] = $passport;

                $this->session->set_userdata(array('usuario_registrado' => $user));
            }

            //actualizazr el pasaporte si viene por parametro
            if ($passport) {
                $info = array('pasaporte' => $passport, 'pais_fk' => $paisId);
                $condicion = array('correo' => $email);
                $this->seguridad->update($info, $condicion);
            }
        }
    }

    private function _generar_no_reserva($pais, $cantidad_productos)
    {
        $pais = app_relleno($pais, 3);
        $cantidad_productos = app_relleno($cantidad_productos, 2);
        $idioma = $this->idioma_current['id'];
        $tipo_cliente = app_relleno('C', 3, '0', 'r');

        $consecutivo = $this->reservacion->get_no_consecutivo_reserva();
        $consecutivo = app_relleno($consecutivo, 5);

        $no_reserva = 'HN-';
        $no_reserva .= $pais . '' . $idioma . '' . $tipo_cliente . '' . $cantidad_productos . '' . $consecutivo;
        return $no_reserva;
    }

    private function _almacenar_reserva($reserva, $reserva_base)
    {
        if (isset($reserva['options']['aconfirmar']) && $reserva['options']['aconfirmar'] == 2) {
            $id = (isset($reserva['options']['id_reserva_confirmada'])) ? $reserva['options']['id_reserva_confirmada'] : $reserva['id_reserva_confirmada'];
            return $this->_actualizar_reserva_confirmada($id, $reserva_base);
        } else {
            $reserva_general = array(
                'titular_tarjeta_fk' => $reserva_base['titular_tarjeta_fk'],
                'persona_reserva_fk' => $reserva_base['persona_reserva_fk'],
                'forma_pago_fk' => $reserva_base['forma_pago_fk'],
                'estado_fk' => $reserva_base['estado_fk'],
                'reserva_padre_fk' => NULL,
                'fecha_creada' => date("Y-m-d", strtotime('now')),
                'fecha_modificada' => NULL,
                'key_car' => $reserva_base['key_car'],
                'nota' => (isset($reserva['options']['detalles']) ? $reserva['options']['detalles'] : ''),
                'pk_idioma' => $reserva_base['pk_idioma'],
                'pk_moneda' => $reserva_base['pk_moneda'],
                'no_reserva' => $reserva_base['no_reserva'],
                'tarjeta' => $reserva_base['tarjeta'],
            );

            $tipo_producto = $reserva['options']['tipo'];
            $obj_modelo_producto = 'reservacion_producto_' . $tipo_producto;

            $this->load->model('mod_reservacion_' . $tipo_producto, $obj_modelo_producto);

            if ($id_bd_reserva = $this->$obj_modelo_producto->procesar_insert_reserva($reserva_general, $reserva))
                return $id_bd_reserva;
            return false;
        }
    }

    private function _actualizar_reserva_confirmada($id_reserva, $reserva_base)
    {
        if ($this->reservacion->actualizar_reserva($id_reserva, array('forma_pago_fk' => $reserva_base['forma_pago_fk'], 'estado_fk' => $reserva_base['estado_fk'], 'key_car' => $reserva_base['key_car'], 'fecha_modificada' => date("Y-m-d", strtotime('now')), 'titular_tarjeta_fk' => $reserva_base['titular_tarjeta_fk'], 'persona_reserva_fk' => $reserva_base['persona_reserva_fk'], 'pk_idioma' => $reserva_base['pk_idioma'])))
            return $id_reserva;
        return false;
    }

    private function _procesar_reservas_aconfirmar($productos, $monto_total, $identificador_car, $reserva_base, $datos_email_reserva)
    {
        $reserva_base['estado_fk'] = 2;
        foreach ($productos as $key_producto => $producto_aconfirmar) {
            if ($id_reserva = $this->_almacenar_reserva($producto_aconfirmar, $reserva_base)) {
                $this->cart->remove($key_producto);
            } else {
                $this->cart->remove($key_producto);
            }
        }

        $datos_email_reserva['importe_aconfirmar_carro'] = app_rate_cambio($monto_total, 'ltr');

        $datos_email_reserva['invitacion_pago'] = trans('email_invitacion_pago', array('link' => base_url('invitacion-pago/' . $id_reserva)));
        $datos_email_reserva['link_invitacion_pago'] = base_url('invitacion-pago/' . $id_reserva);

        $this->notificacion_email->notificacion_reserva_aconfirmar($datos_email_reserva, $productos);
    }

    private function _procesar_transferencia($productos, $monto_total, $identificador_car, $reserva_base, $datos_email_reserva)
    {
        $errores = 0;
        $reserva_base['estado_fk'] = 3;
        foreach ($productos as $key_producto => &$producto_pagar) {
            if ($this->_almacenar_reserva($producto_pagar, $reserva_base)) {
                if ($producto_pagar['options']['aconfirmar'] != 2)
                    $producto_pagar['no_reserva'] = $reserva_base['no_reserva'];
                $this->cart->remove($key_producto);
            } else {
                $errores++;
            }
        }
        $datos_email_reserva['importe_pagar_carro'] = app_rate_cambio($monto_total, 'ltr');
        $this->notificacion_email->notificacion_pago_transferencia($datos_email_reserva, $productos);
        redirect(base_url('con_reservacion/info_pago_transferencia/' . $identificador_car));
    }

    private function _procesar_pago_pasarela($producto_a_pagar, $reserva_base, $datos_titular_tarjeta, $datos_titular_reserva, $monto_total_operacion, $codigo, $comercio)
    {
        //3 Si el pago es de tipo pasarela
        //3.1 Guardar las reservas en la base de datos
        //3.2 Eliminar de la session las reservas
        //3.3 notificar
        $reserva_base['estado_fk'] = 4;
        $monto_total = 0;
        $existe_reserva_editada = false;
        $monto_total = $this->_get_precio_total_reservas($producto_a_pagar);

        $this->load->library('notificacion_email');

        foreach ($producto_a_pagar as $key_producto => $producto_pagar) {
            if (isset($producto_pagar['aconfirmar'])) {
                $producto_pagar['options']['aconfirmar'] = $producto_pagar['aconfirmar'];
            }
            if ($id_r = $this->_almacenar_reserva($producto_pagar, $reserva_base)) { /// aqui se vuelve a insertar
                if (isset($producto_pagar['aconfirmar']) && $producto_pagar['aconfirmar'] != 2)
                    $producto_pagar['no_reserva'] = $reserva_base['no_reserva'];
                $this->cart->remove($key_producto);
                $this->reservacion->insert_operacion_reserva(array('fecha' => date('Y/m/d', strtotime('now')),
                    'precio_total' => ($monto_total_operacion),
                    'numero_transferencia' => $codigo,
                    'reserva_fk' => $id_r,
                    'tipo_operacion_fk' => 1,
                ));
            } else {
                // notificar a los desarrolladores que una reserva no se ha podido agregar y quedó colgada
                $extra = array(
                    'titular_tarjeta' => $datos_titular_tarjeta,
                    'titular_reserva' => $datos_titular_reserva,
                    'monto' => $monto_total_operacion,
                    'producto' => $producto_pagar,
                    'reserva' => $reserva_base,
                );
                $this->notificacion_email->notify_development_error_reserve($extra);
            }
        }

        $pais = $this->sitio->st_get_pais($datos_titular_reserva['pais']);

        $datos_email_reserva = array(
            'nombre' => $datos_titular_reserva['nombre'],
            'email' => $datos_titular_reserva['email'],
            'pais' => $pais['nombre'],
            'telefono' => $datos_titular_reserva['telefono'],
            'titualar_tarjeta' => $datos_titular_tarjeta['nombre'],
            'titular_reserva' => $datos_titular_reserva['nombre'],
            'pasaporte' => $datos_titular_reserva['pasaporte'],
            'no_reserva' => $reserva_base['no_reserva'],
            'importe_pagar_carro' => app_rate_cambio($monto_total_operacion, 'ltr'),
            'pagado_a' => $comercio,
            'codigo' => $codigo,
            // ver esto
            'no_operacion' => $id_r,
            'no_referencia' => $codigo,
        );


        if ($datos_titular_reserva['email'] != $datos_titular_tarjeta['email']) {
            $datos_email_reserva ['email_titualar_tarjeta'] = $datos_titular_tarjeta['email'];
        }

        $this->notificacion_email->notificacion_pago_pasarela($datos_email_reserva, $producto_a_pagar);
    }

    private function _enviar_a_la_pasarela($identificador_car, $producto_a_pagar, $importe_carro_compra, $reserva_base, $datos_titular_tarjeta, $datos_titular_reserva, $tarjeta = 2)
    {
        $importe_a_pagar = $importe_carro_compra['importe_pagar'];
        //ALMACENAR LOS PRODUCTOS QUE SE PAGARAN EN LA PASARELA
        $info = array('productos_a_pagar' => serialize($producto_a_pagar),
            'reserva_base' => serialize($reserva_base),
            'datos_titular_tarjeta' => serialize($datos_titular_tarjeta),
            'datos_titular_reserva' => serialize($datos_titular_reserva),
            'fecha' => date("Y/m/d", strtotime('now')),
            'estado' => 0
        );
        $this->cart->destroy();
        $this->_enviar_formulario_pasarela($info, $importe_a_pagar, $tarjeta);
    }

    private function _enviar_formulario_pasarela($informacion, $importe, $tarjeta = 2)
    {
        //LOS DATOS DE LA EMPRESA
        $comercio = $this->sitio->st_get_informacion_simple_directa('id_comercio');
        $palabra_secreta = $this->sitio->st_get_informacion_simple_directa('palabra_secreta');
        //INFORMACION DE MONEDA
        $moneda_base = $this->moneda_current_iso;
        $importe_pagar = app_rate_cambio($importe);
        $importe_pagar = $importe_pagar['precio'];
        $importe_pagar = $importe_pagar * 100;

        $transaccion = $this->reservacion->insert_productos_a_pagar_en_pasarela($informacion);

        $firma = $this->_firma_pasarela($comercio, $transaccion, $importe_pagar, $moneda_base, 'P', $palabra_secreta);

        $this->reservacion->update_productos_a_pagar_en_pasarela(array('firma' => $firma), array('id' => $transaccion));
        //OBTENER LAS URL DE LAS PASARELAS
        $this->config->load('config_pasarela');
        $url = $this->config->item('pasarela');
        $variable_pasarela = $this->config->item('variable_pasarela');
        if ($importe_pagar >= 100000) {
            $url = $this->config->item('pasarela3d');
            $variable_pasarela = $this->config->item('variable_pasarela3d');
        }
        //EL FORMULARIO
        print '<form style="visibility:hidden" method="post" id="form_pasarlea" name="form_pasarela" action="' . $url . '">';
        print '<input type="text" name="comercio" value="' . $comercio . '" />';
        print '<input type="text" name="transaccion" value="' . $transaccion . '" />';
        print '<input type="text" name="importe" value="' . $importe_pagar . '" />';
        print '<input type="text" name="moneda" value="' . $moneda_base . '" />';
        print '<input type="text" name="operacion" value="P" />';
        print '<input type="text" name="firma" value="' . $firma . '" />';
        print '<input type="hidden" name="amex" value="' . $tarjeta . '"/>';

        // este fragmento es sólo para la pasarela de pruebas
        /*if (defined('ENVIRONMENT')) {
            if (ENVIRONMENT == 'development') {
                print '<input type="text" name="pasarela" value="' . $variable_pasarela . '" />';
            }
        }*/

        print '</form>';
        print '<script language="javascript">';
        print 'document.getElementById("form_pasarlea").submit();';
        print '</script>';
    }

    private function _firma_pasarela($comercio, $transaccion, $importe, $moneda, $operacion, $palabra)
    {
        return hash('sha256', ($comercio . $transaccion . $importe . $moneda . $operacion . $palabra));
    }

    private function cargar_carro_from_salva($salva)
    {
        $producto_reservado = unserialize(trim($salva->productos_a_pagar));

        $new_prod = array();
        foreach ($producto_reservado as $key => $prod) {
            $key_producto = $this->generar_key_producto();
            $temp = explode('_', $key);
            $key_producto = $temp[0] . $key_producto;

            foreach ($prod as $_k => $p) {
                $new_prod[$key_producto][$_k] = $p;
            }

            $new_prod[$key_producto]['id'] = $key_producto;
            $new_prod[$key_producto]['rowid'] = $key_producto;
        }

        $this->cart->insert($new_prod);
    }

    public function pasarela_curl()
    {
        $transaccion = trim($_REQUEST['transaccion']);
        $log_title = 'Log: ' . $transaccion;

        $this->log_pasarela($log_title . ' Inicio de TPV', json_encode($_REQUEST));

        //error_reporting(0);
        $comercio = trim($_REQUEST['comerc']);
        $importe = trim($_REQUEST['importe']);
        $moneda_pasarela = trim($_REQUEST['moneda']);
        $resultado = trim($_REQUEST['resultado']);
        $codigo = trim($_REQUEST['codigo']);
        $fecha = urldecode(($_REQUEST['fecha']));
        $firma_pasarlea = trim($_REQUEST['firma']);
        $error = isset($_REQUEST['error']) ? trim($_REQUEST['error']) : '';
        $response = array();

        if (isset($transaccion) && $transaccion != '') {
            //datos para corroborar la firma
            $salva = $this->reservacion->get_reserva_pasarela($transaccion);
            $response[] = 'Transacción OK';

            if ($salva) {
                $response[] = 'Salva OK';

                //datos para corroborar la firma
                //-------LOS DATOS DE LA EMPRESA-----------------------------
                $comercio_sistem = $this->sitio->st_get_informacion_simple_directa('id_comercio');
                $palabra_secreta_sistem = $this->sitio->st_get_informacion_simple_directa('palabra_secreta');

                $firma_operacion = hash('sha256', ($comercio_sistem . $transaccion . $importe . $moneda_pasarela . $resultado . $codigo . $fecha . $palabra_secreta_sistem));
                if ($firma_pasarlea == trim($firma_operacion)) {
                    $response[] = 'Firma OK';

                    if ($resultado == 'A' || $resultado == 'a') {
                        $response[] = 'Aprobado OK';

                        //if ($salva->estado == 0) {
                        //$response[] = 'Estado 0 OK';

                        $producto_a_pagar = unserialize(trim($salva->productos_a_pagar));
                        $reserva_base = unserialize(trim($salva->reserva_base));
                        $datos_titular_tarjeta = unserialize(trim($salva->datos_titular_tarjeta));
                        $datos_titular_reserva = unserialize(trim($salva->datos_titular_reserva));
                        $this->reservacion->update_productos_a_pagar_en_pasarela(array('estado' => 2, 'fecha_pagado' => date("Y/m/d", strtotime($fecha)), 'codigo' => $codigo, 'pagado_a' => $comercio), array('id' => $transaccion));

                        if ($salva->calendario_fk > 0) {
                            $response[] = 'Calendario OK';

                            $this->reservacion->update_pago_del_calendario(array('estado' => 't'), array('id' => $salva->calendario_fk));
                        } else {
                            $response[] = 'Procesar OK';

                            // actualizar estado de la reserva desde reserva_prod_pasarela
                            $numero = $salva->reserva_fk;
                            $this->reservacion->actualizar_reserva($numero, array('estado_fk' => 4));

                            $this->_procesar_pago_pasarela($producto_a_pagar, $reserva_base, $datos_titular_tarjeta, $datos_titular_reserva, ($importe / 100), $codigo, $comercio);
                        }
                        //}

                        $response[] = 'Fin OK';

                        $this->log_pasarela($log_title . ' Fin', json_encode($response));
                        echo json_encode($response);
                        exit();
                    } else {
                        $response[] = 'Error - Pago Denegado';

                        $this->notify_pago_denegado($transaccion, $error);

                        $this->reservacion->update_productos_a_pagar_en_pasarela(
                            array(
                                'estado' => 1,
                                'error' => utf8_decode($error),
                                'notificado' => 1
                            ),
                            array('id' => $transaccion)
                        );

                        $this->log_pasarela($log_title . ' Fin', json_encode($response));
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response[] = 'Error - Firma incorrecta';
                    $this->log_pasarela($log_title . ' Fin', json_encode($response));
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response[] = 'Error - Transacción no encontrada';

                $pago_pasarela_confirmado = $this->reservacion->get_reserva_pasarela_confirmada($transaccion);
                if ($pago_pasarela_confirmado) {
                    $response[] = 'Pago confirmado';

                    $this->reservacion->update_productos_a_pagar_en_pasarela(array('estado' => 3), array('id' => $transaccion));

                    // actualizar estado de la reserva desde reserva_prod_pasarela
                    $numero = $pago_pasarela_confirmado->reserva_fk;
                    $this->reservacion->actualizar_reserva($numero, array('estado_fk' => 4));

                    $this->log_pasarela($log_title . ' Fin', json_encode($response));
                    echo json_encode($response);
                    exit();
                }

                $response[] = 'Ni idea...';

                $this->log_pasarela($log_title . ' No se encontró la transacción salva: (' . sizeof($salva) . ') reserva: (' . sizeof($pago_pasarela_confirmado) . ')', json_encode([]));
                echo json_encode($response);
                exit();
            }
        } else {
            $response[] = 'Error - no hay transacción';

            $this->log_pasarela($log_title . ' Fin', json_encode($response));
            echo json_encode($response);
            exit();
        }
    }

    /*
      Enviar correo al cliente de la reserva cancelada
      @ $operacion(integer) - > 1 = Aprobada
      $operacion(integer) - > 2 = Cancelada
      return  si o no
     */

    public function notificar_reserva($operacion, $id_reserva, $num_transaccion = NULL)
    {
        // este metodo devuelve un json
        // esto evita q en desarrollo el json esté contaminado con warnings
        if (defined('ENVIRONMENT')) {
            if (ENVIRONMENT == 'development') {
                error_reporting(0);
            }
        }

        $reservas = false;
        $identificadores_productos = app_productos();
        foreach ($identificadores_productos as $identificador) {
            $obj_modelo_producto = $identificador . 'reservacion';
            $this->load->model('mod_reservacion_' . $identificador, $obj_modelo_producto);
            $existe_reserva = $this->$obj_modelo_producto->get_reserva($id_reserva);
            if ($existe_reserva !== false) {
                $this->str_producto = $identificador;
                $existe_reserva['id'] = $this->generar_key_producto();
                $existe_reserva['options']['tipo'] = $identificador;
                $reservas = $existe_reserva;
                break;
            }
        }
        if ($reservas !== false) {
            $reserva_listado = array(0 => $reservas);
            $reserva = $reservas;
            $this->load->model('mod_seguridad', 'seguridad');
            $usuario_tarjeta = $this->seguridad->get_usuario(array('id' => $reserva['options']['titular_tarjeta_fk']));
            $usuario_reserva = $this->seguridad->get_usuario(array('id' => $reserva['options']['persona_reserva_fk']));

            $datos_email_reserva = array(
                'nombre' => $usuario_reserva['nombre'],
                'email' => $usuario_reserva['correo'],
                'titualar_tarjeta' => $usuario_tarjeta['nombre'],
                'titular_reserva' => $usuario_reserva['nombre'],
                'no_reserva' => $reserva['options']['no_reserva'],
                'no_confirmacion' => $reserva['options']['numero_confirmacion']
            );
            $importe_reserva = $reserva['price'];

            $datos_email_reserva['importe_reserva'] = (app_rate_cambio($importe_reserva, 'ltr'));
            $idioma_reserva = $this->sitio->st_get_idioma(array('id' => $reserva['options']['pk_idioma']));

            $this->cargar_idiomas($idioma_reserva['codigo']);

            $this->load->library('notificacion_email');
            if ((int)$operacion === 1) {
                $datos_email_reserva['invitacion_pago'] = trans('email_invitacion_pago', array('link' => base_url('invitacion-pago/' . $id_reserva)));
                $datos_email_reserva['link_invitacion_pago'] = base_url('invitacion-pago/' . $id_reserva);

                $this->notificacion_email->notificacion_reserva_confirmada($datos_email_reserva, $reserva_listado);
            } elseif ((int)$operacion === 2) {
                $this->notificacion_email->notificacion_reserva_cancelada_administrador($datos_email_reserva, $reserva_listado);
            } elseif ((int)$operacion === 3) {
                $this->notificacion_email->notificacion_reserva_pagada_transferencia($datos_email_reserva, $reserva_listado, $num_transaccion);
            }
            print json_encode(array('success' => true, 'msg' => 'Mensaje Enviado'));
            exit();
        } else {
            print json_encode(array('success' => false, 'msg' => 'Mensaje NO Enviado'));
            exit();
        }

        return false;
    }

    public function info_reserva_aconfirmar($id_car)
    {
        $datos = array();
        $this->display('informativas/productos_a_confirmar', $datos);
    }

    public function info_pago_transferencia($id_car)
    {
        $datos = array();
        $datos['swift'] = $this->sitio->st_get_informacion_simple_directa('swift');
        $datos['cuentabanco'] = $this->sitio->st_get_informacion_simple_directa('cuentabanco');
        $datos['titularcuenta'] = $this->sitio->st_get_informacion_simple_directa('titularcuenta');
        $datos['banco'] = $this->sitio->st_get_informacion_simple_directa('banco');
        $this->display('informativas/pago_transferencia', $datos);
    }

    public function info_pago_pasarela_aceptado()
    {
        $a = $this->session->flashdata();

        $importe = isset($a['a']) ? $a['a'] / 100 : 0;

        $datos = array(
            'currency' => 'EUR',
            'amount' => $importe,
            'transaction' => isset($a['t']) ? $a['t'] : 0,
        );
        $this->display('informativas/pago_pasarela', $datos);
    }

    public function info_pago_pasarela_denegado()
    {
        $datos = array();
        $this->display('informativas/pago_pasarela_denegado', $datos);
    }

    public function voucher($producto, $id_reserva)
    {
        $this->load->library('pdf/ezpdf');
        $this->load->helper('download');
        $usuario_registrado = app_usuario();
        if ($this->reservacion->valida_cliente_reserva($usuario_registrado['id'], $id_reserva) == true) {
            $obj_modelo_reserva_producto = $producto . 'reservacion';
            $obj_modelo_producto = $producto . 'model';

            $this->load->model('mod_reservacion_' . $producto, $obj_modelo_reserva_producto);
            $this->load->model('mod_' . $producto, $obj_modelo_producto);

            $reserva = $this->$obj_modelo_reserva_producto->get_reserva($id_reserva);
            if ($reserva['options']['estado'] == 4) {
                $this->lang->load('voucher', $this->idioma_current_code);
                $datos['reserva'] = $reserva;
                $datos['items'] = $this->$obj_modelo_producto->voucher($reserva);
                $datos['direccion_empresa'] = $this->sitio->st_get_informacion_simple_directa('direccion');
                $datos['telefonos_empresa'] = $this->sitio->st_get_informacion_multiple('telefonoreserva');
                $datos['servicio'] = $producto;
                $datos['email'] = $this->sitio->st_get_informacion_simple_directa('correoreserva1');

                $datos['url_sitio'] = base_url();

                // nuevo
                $_temp = $this->reservacion->get_operacion_reserva(array('reserva_fk' => $id_reserva, 'tipo_operacion_fk' => 1));
                $_data_reserva = $this->reservacion->get_reserva_producto_pasarela(array('codigo' => $_temp['numero_transferencia']));
                $datos['codigo'] = $_temp['numero_transferencia'];
                $datos['pagado_a'] = $_data_reserva['pagado_a'];
                /////

                $datos = array_merge($datos, array('datos_reserva' => $reserva));

                $this->load->model('mod_seguridad', 'seguridad');

                $info_cliente = $this->seguridad->get_usuario(array('id' => $reserva['options']['persona_reserva_fk']));
                $datos['pais'] = $this->sitio->st_get_pais($info_cliente['pais_fk']);
                $datos = array_merge($datos, array('nombre_cliente' => $info_cliente['nombre'], 'nacionalidad' => $info_cliente['pais_fk']));

                $this->load->library('pdf/ezpdf');
                $this->load->helper('download');
                $this->load->view('administracion/voucher', $datos);
            } else {
                $this->_error(trans('error_acceso_no_autorizado'));
            }
        } else {
            $this->_error(trans('error_acceso_no_autorizado'));
        }
    }

    public function error_pago()
    {
        $email = 'jcomercial@gcnacio.gca.tur.cu';
        $this->_error(trans('reserva_error_pago', array('link' => base_url('carro-compra'), 'email' => $email)));
    }

    private function _get_precio_total_reservas($reservas)
    {
        $importe_reserva = 0;
        foreach ($reservas as $r) {
            $importe_reserva += $r['price'];
        }
        return $importe_reserva;
    }

    private function enviar_a_la_pasarela($identificador_car, $producto_a_pagar, $importe_carro_compra, $reserva_base, $datos_titular_tarjeta, $datos_titular_reserva, $numero)
    {
        //-------LOS DATOS DE LA EMPRESA-----------------------------
        $comercio = $this->sitio->st_get_informacion_simple_directa('id_comercio');
        $palabra_secreta = $this->sitio->st_get_informacion_simple_directa('palabra_secreta');

        $this->load->model('mod_idioma_moneda', 'moneda');

        $tarjeta = 0;
        try {
            foreach ($producto_a_pagar as $k => $item) {
                if (isset($item['options']['tarjeta'])) {
                    $tarjeta = $item['options']['tarjeta'];
                }
            }
        } catch (Exception $exception) {
        }

        //fin de los datos de la empresa

        $moneda = $this->moneda->select_moneda_id()->row_array();
        $moneda_base = $moneda['codigo_iso'];
        if ($reserva_base['pk_moneda'] != NULL) {
            $moneda = $this->moneda->select_moneda_id($reserva_base['pk_moneda'])->row_array();
            $moneda_base = $moneda['codigo_iso'];
            $importe_carro_compra = round($importe_carro_compra['importe_pagar'] * $moneda['tasa'], 2);
        } else
            $importe_carro_compra = round($importe_carro_compra['importe_pagar'], 2);

        $importe_carro_compra = $importe_carro_compra * 100;

        //------ALAMCENAR LOS PRODUCTOS QUE SE PAGARAN EN LA PASARELA
        $this->load->model('mod_reservacion', 'grl_reservacion');
        $info = array('productos_a_pagar' => serialize($producto_a_pagar),
            'reserva_base' => serialize($reserva_base),
            'datos_titular_tarjeta' => serialize($datos_titular_tarjeta),
            'datos_titular_reserva' => serialize($datos_titular_reserva),
            'fecha' => date("Y/m/d", strtotime('now')),
            'estado' => 0,
            'reserva_fk' => $numero
        );
        $transaccion = $this->grl_reservacion->insert_productos_a_pagar_en_pasarela($info);

        $firma = $this->_firma_pasarela($comercio, $transaccion, $importe_carro_compra, $moneda_base, 'P', $palabra_secreta);

        $this->grl_reservacion->update_productos_a_pagar_en_pasarela(array('firma' => $firma), array('id' => $transaccion));
        //FIN DE ALMACENAR LOS PRODUCTOS
        //OBTENER LAS URL DE LAS PASARELAS
        $this->config->load('config_pasarela');
        $variable_pasarela = $this->config->item('variable_pasarela');
        $url = $this->config->item('pasarela');
        if ($importe_carro_compra >= 100000) {
            $variable_pasarela = $this->config->item('variable_pasarela3d');
            $url = $this->config->item('pasarela3d');
        }
        //los datos de la empresa

        print '<form style="visibility:hidden" method="post" id="form_pasarlea" name="form_pasarela" action="' . $url . '">';
        print '<input type="text" name="comercio" value="' . $comercio . '" />';
        print '<input type="text" name="transaccion" value="' . $transaccion . '" />';
        print '<input type="text" name="importe" value="' . $importe_carro_compra . '" />';
        print '<input type="text" name="moneda" value="' . $moneda_base . '" />';
        print '<input type="text" name="operacion" value="P" />';
        print '<input type="text" name="firma" value="' . $firma . '" />';
        print '<input type="hidden" name="amex" value="' . $tarjeta . '"/>';

        // este fragmento es sólo para la pasarela de pruebas
        if (defined('ENVIRONMENT')) {
            if (ENVIRONMENT == 'development') {
                print '<input type="text" name="pasarela" value="' . $variable_pasarela . '" />';
            }
        }

        print '</form>';
        print '<script language="javascript">';
        print 'document.getElementById("form_pasarlea").submit();';
        print '</script>';
    }

    function invitacion_pago($numero)
    {
        $reserva = false;
        $identificadores_productos = app_productos();
        foreach ($identificadores_productos as $identificador) {
            $obj_modelo_producto = $identificador . 'reservacion';
            $this->load->model('mod_reservacion_' . $identificador, $obj_modelo_producto);
            $existe_reserva = $this->$obj_modelo_producto->get_reserva($numero);
            if ($existe_reserva !== false) {
                if ($existe_reserva['options']['estado'] != 4) { // evitar que se pague 2 veces la misma reserva
                    $this->str_producto = $identificador;
                    $existe_reserva['id'] = $this->generar_key_producto();
                    $existe_reserva['options']['tipo'] = $identificador;
                    $reserva = $existe_reserva;

                    $id_reserva_ltr = $identificador . '_reserva_' . md5(microtime());
                    break;
                }
            }
        }

        if ($reserva != false) {
            $reserva['aconfirmar'] = 2;
            $reserva['id_reserva_confirmada'] = $numero;
            $this->load->model('mod_registrarse', 'buscar_usuario');

            $id_user_reserva = $reserva['options']['persona_reserva_fk'];
            $id_prop_tarjeta = $reserva['options']['persona_reserva_fk'];
            $usuario_reserva = $this->buscar_usuario->buscar_usuario_por_id($id_user_reserva);

            $datos_titular_reserva['nombre'] = $usuario_reserva->nombre;
            $datos_titular_reserva['email'] = $usuario_reserva->correo;
            $datos_titular_reserva['pais'] = $usuario_reserva->pais_fk;
            $datos_titular_reserva['telefono'] = $usuario_reserva->telefono;
            $datos_titular_reserva['pasaporte'] = $usuario_reserva->pasaporte;

            if ($id_prop_tarjeta != $id_user_reserva) {
                $usuario_tarjeta = $this->buscar_usuario->buscar_usuario_por_id($id_prop_tarjeta);

                $datos_titular_tarjeta['nombre'] = $usuario_tarjeta->nombre;
                $datos_titular_tarjeta['email'] = $usuario_tarjeta->correo;
                $datos_titular_tarjeta['pais'] = $usuario_tarjeta->pais_fk;
                $datos_titular_tarjeta['telefono'] = $usuario_tarjeta->telefono;
                $datos_titular_tarjeta['pasaporte'] = $usuario_tarjeta->pasaporte;
            } else {
                $datos_titular_tarjeta = $datos_titular_reserva;
            }

            $this->load->model('mod_reservacion', 'grl_reservacion');
            $detalles_reserva = $this->grl_reservacion->get_datos_reserva($numero);

            $importe_reserva = $this->_get_precio_total_reservas(array(0 => $reserva));

            $identificador_car = md5(microtime());

            $reserva_base = array('titular_tarjeta_fk' => $reserva['options']['titular_tarjeta_fk'],
                'persona_reserva_fk' => $reserva['options']['persona_reserva_fk'],
                'forma_pago_fk' => 2,
                'estado_fk' => 7,
                'key_car' => $identificador_car,
                'pk_idioma' => $reserva['options']['pk_idioma'],
                'pk_moneda' => $detalles_reserva['pk_moneda'],
                'no_reserva' => $reserva['options']['no_reserva']);

            $this->enviar_a_la_pasarela($detalles_reserva['key_car'], array($id_reserva_ltr => $reserva), array('importe_pagar' => $importe_reserva), $reserva_base, $datos_titular_tarjeta, $datos_titular_reserva, $numero);
        }

        $this->_error(trans('error_encabezado'));
    }

    private function log_pasarela($nombre, $data)
    {
        $this->load->model('mod_seguridad', 'model');
        $info = array();
        $info['nombre'] = $nombre;
        $info['datos'] = $data;

        $this->model->pasarela_logs($info);
    }

    public function voucheradmin($producto, $id_reserva)
    {
        $this->load->library('pdf/ezpdf');
        $this->load->helper('download');

        $obj_modelo_reserva_producto = $producto . 'reservacion';
        $obj_modelo_producto = $producto . 'model';

        $this->load->model('mod_reservacion_' . $producto, $obj_modelo_reserva_producto);
        $this->load->model('mod_' . $producto, $obj_modelo_producto);

        $reserva = $this->$obj_modelo_reserva_producto->get_reserva($id_reserva);
        if ($reserva['options']['estado'] == 4 || $reserva['options']['estado'] == 6) {
            $this->lang->load('voucher', $this->idioma_current_code);
            $datos['reserva'] = $reserva;
            $datos['items'] = $this->$obj_modelo_producto->voucher($reserva, true);
            $datos['direccion_empresa'] = $this->sitio->st_get_informacion_simple_directa('direccion');
            $datos['telefonos_empresa'] = $this->sitio->st_get_informacion_multiple('telefonoreserva');
            $datos['servicio'] = $producto;
            $datos['email'] = $this->sitio->st_get_informacion_simple_directa('correoreserva1');

            $datos['url_sitio'] = base_url();

            // nuevo
            $_temp = $this->reservacion->get_operacion_reserva(array('reserva_fk' => $id_reserva, 'tipo_operacion_fk' => 1));
            $_data_reserva = $this->reservacion->get_reserva_producto_pasarela(array('codigo' => $_temp['numero_transferencia']));
            $datos['codigo'] = $_data_reserva['codigo'];
            $datos['pagado_a'] = $_data_reserva['pagado_a'];
            $datos['transaccion'] = $id_reserva;
            /////

            $no_transferencia = $this->get_numero_trans($id_reserva);
            $datos['numero_reserva'] = $no_transferencia;

            $datos = array_merge($datos, array('datos_reserva' => $reserva));

            $this->load->model('mod_seguridad', 'seguridad');

            $info_cliente = $this->seguridad->get_usuario(array('id' => $reserva['options']['persona_reserva_fk']));
            $datos['pais'] = $this->sitio->st_get_pais($info_cliente['pais_fk']);
            $datos = array_merge(
                $datos,
                array(
                    'nombre_cliente' => $info_cliente['nombre'],
                    'nacionalidad' => $info_cliente['pais_fk'],
                    'correo' => $info_cliente['correo'],
                    'telefono' => $info_cliente['telefono'],
                )
            );

            $this->load->library('pdf/ezpdf');
            $this->load->helper('download');
            $this->load->view('administracion/voucher', $datos);
        } else {
            $this->_error(trans('error_acceso_no_autorizado'));
        }
    }

    public function voucheremail($key_car)
    {
        $this->load->model('mod_reservacion_alojamiento', 'alojamiento');
        $reservas = $this->alojamiento->get_reservaByKeycar($key_car);

        if (!$reservas) {
            $this->_error(trans('error_acceso_no_autorizado'));
        }

        if (count($reservas) > 1) {
            // parche kk
            echo '<script type="text/javascript">';
            foreach ($reservas as $item) {
                echo 'window.open("' . base_url() . 'cuenta/voucheradmin/alojamiento/' . $item['id'] . '", "_blank");';
            }
            echo '</script>';
        } else {
            foreach ($reservas as $item) {
                return $this->voucher('alojamiento', $item['id']);
            }
        }
    }

    private function get_numero_trans($id)
    {
        $this->load->model('mod_reservacion', 'mod_reservacion');

        return $this->mod_reservacion->get_numero_reserva($id);
    }

    public function notify_pago_denegado($transaccion, $error)
    {
        $salva = $this->reservacion->get_reserva_pasarela($transaccion);

        if ($salva && $salva->notificado == 0) {
            $reserva_base = unserialize(trim($salva->reserva_base));
            $datos_titular_tarjeta = unserialize(trim($salva->datos_titular_tarjeta));
            $datos_titular_reserva = unserialize(trim($salva->datos_titular_reserva));
            $producto_a_pagar = unserialize(trim($salva->productos_a_pagar));

            $arrk = array_keys($producto_a_pagar);
            $monto_total_operacion = $producto_a_pagar[$arrk[0]]['subtotal'];

            $datos_email_reserva = array(
                'nombre' => $datos_titular_tarjeta['nombre'],
                'email' => $datos_titular_tarjeta['email'],
                'titualar_tarjeta' => $datos_titular_tarjeta['nombre'],
                'titular_reserva' => $datos_titular_reserva['nombre'],
                'pasaporte' => $datos_titular_reserva['pasaporte'],
                'no_reserva' => $reserva_base['no_reserva'],
                'importe_pagar_carro' => ($monto_total_operacion),
                'key_car' => $reserva_base['key_car'],
                'transaccion' => $transaccion
            );

            $this->load->library('notificacion_email');
            $this->notificacion_email->notificacion_pago_pasarela_error($datos_email_reserva, $producto_a_pagar, $error);
        }
    }

    public function invitacion_pago_denegado($transaccion)
    {
        $salva = $this->reservacion->get_reserva_pasarela($transaccion);
        //if (sizeof($salva) == 1 && $salva->notificado != 0) {

        $reserva_base = unserialize(trim($salva->reserva_base));
        $datos_titular_tarjeta = unserialize(trim($salva->datos_titular_tarjeta));
        $datos_titular_reserva = unserialize(trim($salva->datos_titular_reserva));

        $producto_a_pagar = unserialize(trim($salva->productos_a_pagar));

        $importe_a_pagar = 0;
        foreach ($producto_a_pagar as $key => $val) {
            $importe_a_pagar += $val['subtotal'];
        }

        $info = array(
            'productos_a_pagar' => serialize($producto_a_pagar),
            'reserva_base' => serialize($reserva_base),
            'datos_titular_tarjeta' => serialize($datos_titular_tarjeta),
            'datos_titular_reserva' => serialize($datos_titular_reserva),
            'fecha' => date("Y/m/d", strtotime('now')),
            'estado' => 0
        );

        // cambiar estado a no pagado antes de salir a la pasarela
        $this->reservacion->update_productos_a_pagar_en_pasarela(
            array(
                'estado' => 0,
                'notificado' => $salva->notificado + 1
            ),
            array('id' => $transaccion)
        );

        $tarjeta = 2;

        // enviar la transacción para que no se cree nuevamente
        $this->_enviar_formulario_pasarela($info, $importe_a_pagar, $tarjeta);
        /*} else {
            redirect(base_url('con_reservacion/error_pago'));
        }*/
    }

    private function _menu_vertical()
    {
        $menu_vertical = array();
        $menu_vertical['mi-cuenta'] = array('url' => trans('ruta_mi_cuenta'), 'titulo' => trans('user_micuenta'));
        $menu_vertical['historial'] = array('url' => trans('ruta_historial'), 'titulo' => trans('user_historial'));
        $menu_vertical['calendario'] = array('url' => trans('ruta_calendario_pagos'), 'titulo' => trans('user_pagos_pendientes'));
        //$menu_vertical['historial'] = array('url'=>trans('ruta_bar',array('slug'=>$b['slug'])),'titulo'=>trans('br_bar_nombre',array('nombre'=>$b['nombre'])));


        return $menu_vertical;
    }

    private function _tarjetas_comercio()
    {

        //LOS DATOS DE LA EMPRESA
        $comercio = $this->sitio->st_get_informacion_simple_directa('id_comercio');
        $url_admin = $this->sitio->st_get_informacion_simple_directa('url_tarjeta_admin');
        $tarjetas_activas = $this->sitio->st_get_informacion_simple_directa('tarjetas_array');
        $tarjetas_mostrar = array();

        $data = array("comercio" => $comercio);

        $server = '169.158.128.69';

        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POST => true,
            CURLOPT_VERBOSE => true,
            //CURLOPT_INTERFACE		=> $server,
            CURLOPT_URL => $url_admin,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_TIMEOUT => 10,
        );

        //INICIAR CURL CXN
        $ch = curl_init();

        //ASIGNAR PARAMETROS
        curl_setopt_array($ch, $options);

        //EJECUTAR CURL
        $output = curl_exec($ch);

        //COMPROBAR ERRORES
        if (curl_errno($ch)) {
            $crlerror = curl_error($ch);
            //$this->sitio->actualizar_tarjetas_activas($crlerror);
            return json_decode($tarjetas_activas);
        }

        //COMPROBAR ERRORES
        $crlerror = curl_error($ch);
        if ($crlerror) {
            return json_decode($tarjetas_activas);
        }

        //CERRAR CURL CXN
        curl_close($ch);

        if ($tarjetas_activas == $output) {
            return json_decode($output);
        } else {
            $this->sitio->actualizar_tarjetas_activas($output);
            return json_decode($output);
        }

        //print_r(json_decode($output));exit;
    }

    public function pasarela()
    {
        $transaccion = trim($_REQUEST['transaccion']);
        $log_title = 'Log: ' . $transaccion;
        $this->log_pasarela($log_title . ' Inicio pasarela', json_encode($_REQUEST));

        $importe = trim($_REQUEST['importe']);
        $moneda_pasarela = trim($_REQUEST['moneda']);
        $resultado = trim($_REQUEST['resultado']);

        if (strtolower($resultado) == 'a') {
            $this->session->set_flashdata(['t' => $transaccion, 'c' => $moneda_pasarela, 'a' => $importe]);

            $this->log_pasarela($log_title . ' Fin pasarela Aceptado', json_encode([]));
            redirect(base_url('con_reservacion/info_pago_pasarela_aceptado'));
        } else {
            $salva = $this->reservacion->get_reserva_pasarela($transaccion);

            $this->cargar_carro_from_salva($salva);

            $this->log_pasarela($log_title . ' Fin pasarela Denegado', json_encode([]));
            redirect(base_url('con_reservacion/info_pago_pasarela_denegado'));
        }
    }

    public function debug()
    {
        print_r($this->_tarjetas_comercio());

        //LOS DATOS DE LA EMPRESA
        /*$comercio = $this->sitio->st_get_informacion_simple_directa('id_comercio');
        $url_admin = $this->sitio->st_get_informacion_simple_directa('url_tarjeta_admin');
        $tarjetas_activas = $this->sitio->st_get_informacion_simple_directa('tarjetas_array');
        $tarjetas_mostrar = array();

        $data = array("comercio" => $comercio);

        $server = '169.158.128.69';

        $options = array(
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_POST            => true,
            CURLOPT_VERBOSE         => true,
            //CURLOPT_INTERFACE     => $server,
            CURLOPT_URL             => $url_admin,
            CURLOPT_POSTFIELDS      => $data,
            CURLOPT_TIMEOUT         => 10,
        );

        //print_r($options);

        //INICIAR CURL CXN
        $ch = curl_init();

        //ASIGNAR PARAMETROS
        curl_setopt_array($ch , $options);

        //EJECUTAR CURL
        $output = curl_exec($ch);

        //COMPROBAR ERRORES
        $crlerror = curl_error($ch);
        if ($crlerror) {
            print_r($crlerror) ;
            exit(0);
        }

        //CERRAR CURL CXN
        curl_close($ch);

          print_r($output);*/

    }
}
