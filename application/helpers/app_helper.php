<?php
function app_config($conocer)
{
    $controlador = &get_instance();
    return $controlador->app_config($conocer);
}

function app_url_admin()
{
    return app_config('url_admin_upload');
}

function app_dir_admin()
{
    return app_config('dir_admin_upload');
}

function app_usuario()
{
    $controller = &get_instance();
    return $controller->session->userdata('usuario_registrado');
}

function app_menu_usuario()
{
    $controller = &get_instance();
    $controller->load->view('administracion/menu', array('datos_usuario' => app_usuario()));
}

function app_imagen_base64($ruta_imagen, $opciones = array())
{
    if (isset($opciones['ruta_interna'])) {
        $ruta_imagen = $ruta_imagen;
    } else {
        $ruta_imagen = app_dir_admin() . '/' . $ruta_imagen;
    }
    $controller = &get_instance();
    $controller->load->helper('file');

    $tipo_archivo = get_mime_by_extension($ruta_imagen);

    $contenido = base64_encode(file_get_contents($ruta_imagen));
    return 'data:' . $tipo_archivo . ';base64,' . $contenido;
}

function app_productos()
{
    return app_config('productos');
}

function app_existe_idioma_seleccionado()
{
    $controlador = &get_instance();
    return $controlador->session->userdata('language');
}

function app_idioma_defecto()
{
    $controlador = &get_instance();
    return $controlador->app_idioma_defecto();
}

function app_idioma_codigo()
{
    $controlador = &get_instance();
    return $controlador->idioma_current_code;
}

function app_idioma()
{
    $controlador = &get_instance();
    return $controlador->idioma_current;
}

function app_idiomas()
{
    $controlador = &get_instance();
    return $controlador->app_idiomas();
}

function app_moneda_defecto()
{
    $controlador = &get_instance();
    return $controlador->app_moneda_defecto();
}

function app_moneda()
{
    $controlador = &get_instance();
    return $controlador->moneda_current;
}

function app_monedas()
{
    $controlador = &get_instance();
    return $controlador->app_monedas();
}

function app_nombre_sistema()
{
    return app_config('nombre_sistema');
}

function app_hotel_id()
{
    $controlador = &get_instance();
    return $controlador->id_hotel_current;
}

function app_menu()
{
    $controlador = &get_instance();
    return $controlador->sitio->st_get_menu();
}

function app_menu_footer()
{
    $controlador = get_instance();
    return $controlador->sitio->st_get_menu_footer();
}

function app_parse($cadena, $valores)
{
    $controlador = &get_instance();
    return $controlador->parser->parse_string($cadena, $valores, true);
}

function app_tarjetas_creditos()
{
    $controlador = &get_instance();
    return $controlador->sitio->st_get_tarjeta_credito();
}

function app_redes_sociales()
{
    $controlador = &get_instance();
    return $controlador->sitio->st_get_redes_sociales();
}

function app_traduccion($nombreEsquema, $nombreTabla, $nombreCampo, $fk, $id, $default)
{
    $controller = &get_instance();
    $traduccion = $controller->sitio->st_traduccion($nombreEsquema, $nombreTabla, $nombreCampo, $fk, $id, $default);
    return $traduccion;
}

function app_id_url_amigable($esquema, $url, $campo, $tabla, $campot = NULL, $tablat = NULL, $llave = NULL)
{
    $controller = get_instance();
    return $controller->sitio->st_id_url_amigable($esquema, $url, $campo, $tabla, $campot, $tablat, $llave);
}

function app_select_paginacion($opciones = array())
{
    $rango = app_config('paginador_select');
    $select = '<select name="items_por_pagina">';
    for ($i = $rango['inicio']; $i <= $rango['final'];) {
        $select .= '<option value="' . $i . '">' . $i . '</option>';
        $i = $i + $rango['incremento'];
    }
    $select .= '</select>';
    print $select;
}

function app_paises()
{
    $controller = &get_instance();
    $controller->load->model('sitio');
    return $controller->sitio->st_get_paises();
}

function app_get_pais($id_pais)
{
    $controller = &get_instance();
    return $controller->sitio->st_get_pais($id_pais);
}

function app_strip_etiquetas($texto)
{
    $etiquetas_deseadas = '<a><h1><h2><h3><b></b><img><ul><li></ul></li><br><table><tr><td><thead><br>';
    return strip_tags($texto, $etiquetas_deseadas);
}

function app_word_wrap($texto, $cantidad_palabras)
{
    $lineas = array();
    $palabras = explode(' ', $texto);
    $contador_palabras = 0;
    $contador_lineas = 0;
    $lineas[$contador_lineas] = '';
    foreach ($palabras as $palabra) {
        $lineas[$contador_lineas] = $lineas[$contador_lineas] . ' ' . $palabra;
        $contador_palabras++;
        if ($contador_palabras >= $cantidad_palabras) {
            $contador_palabras = 0;
            $contador_lineas++;
            $lineas[$contador_lineas] = '';
        }
    }
    return $lineas;
}

function app_texto_salto_html($texto)
{
    return str_replace(array(chr(10)), '<br/>', $texto);
}

function app_strip_salto($texto)
{
    return str_replace(array(chr(10), '<br>', '<br/>'), '', $texto);
}

function app_dateadd($date, $dd = 0, $mm = 0, $yy = 0, $hh = 0, $mn = 0, $ss = 0)
{
    $date_r = getdate(strtotime($date));
    $date_result = date("Y-m-d", mktime(($date_r["hours"] + $hh), ($date_r["minutes"] + $mn), ($date_r["seconds"] + $ss), ($date_r["mon"] + $mm), ($date_r["mday"] + $dd), ($date_r["year"] + $yy)));
    return $date_result;
}

function app_comprobar_fecha($fecha)
{
    if (checkdate(date("m", $fecha), date("d", $fecha), date("Y", $fecha)))
        return true;
    return false;
}

function comprobar_fecha($fecha)
{
    if (checkdate(date("m", $fecha), date("d", $fecha), date("Y", $fecha)))
        return true;
    return false;
}

function app_diferencia_fecha($fecha_string1, $fecha_string2, $fin_semana = NULL)
{
    $fecha_uno = mktime(0, 0, 0, date("m", strtotime($fecha_string1)), date("d", strtotime($fecha_string1)), date("Y", strtotime($fecha_string1)));
    $fecha_dos = mktime(0, 0, 0, date("m", strtotime($fecha_string2)), date("d", strtotime($fecha_string2)), date("Y", strtotime($fecha_string2)));
    if (comprobar_fecha($fecha_uno) == true && comprobar_fecha($fecha_dos) == true) {
        $diferencia = $fecha_dos - $fecha_uno;
        $diferencia = $diferencia / (24 * 60 * 60);
        if ($fin_semana == true) {
            $dias_laborales = 0;
            for ($i = $fecha_uno; $i < $fecha_dos; $i += 86400) {
                if (date('D', $i) != 'Sat' && date('D', $i) != 'Sun')
                    $dias_laborales++;
            }
            return $dias_laborales;
        } else
            return $diferencia;
    } else {
        return false;
    }
}

function app_now()
{
    $formato_fecha = 'Y-m-d';
    return date($formato_fecha, strtotime('now'));
}

function app_date($string)
{
    $formato_fecha = app_config('date_format_sitio');
    return date($formato_fecha, strtotime($string));
}

function app_str_date($string)
{
    $formato_fecha = app_config('date_format_sitio');
    $fecha = date($formato_fecha, strtotime($string));
    $months = array('01' => trans('enero'), '02' => trans('febrero'), '03' => trans('marzo'), '04' => trans('abril'), '05' => trans('mayo'), '06' => trans('junio'), '07' => trans('julio'), '08' => trans('agosto'), '09' => trans('septiempre'), '10' => trans('octubre'), '11' => trans('noviembre'), '12' => trans('diciembre'));

    $arr = explode('-', $fecha);
    $dias = array('01' => '1', '02' => '2', '03' => '3', '04' => '4', '05' => '5', '06' => '6', '07' => '7', '08' => '8', '09' => '9');
    $dia = ($arr[2] < 10) ? $dias[$arr[2]] : $arr[2];

    return trans('formato_fecha', array('dia' => $dia, 'mes' => $months[$arr[1]], 'anno' => $arr[0]));

}

function app_str_hora($string)
{
    return date('h:i A', strtotime($string));
}

function app_dias_mes()
{
    $dias_mes = array();
    $dias_mes[1] = 31;
    $dias_mes[2] = 28;
    $dias_mes[3] = 31;
    $dias_mes[4] = 30;
    $dias_mes[5] = 31;
    $dias_mes[6] = 30;
    $dias_mes[7] = 31;
    $dias_mes[8] = 31;
    $dias_mes[9] = 30;
    $dias_mes[10] = 31;
    $dias_mes[11] = 30;
    $dias_mes[12] = 31;

    $anno = date("Y");
    //si es biciesto
    if ($anno % 4 == 0)
        $dias_mes[2] = 29;
    return $dias_mes;
}

function app_dias_restar_dates($fecha1, $fecha2)
{
    $date_1 = explode('-', $fecha1);
    $date_2 = explode('-', $fecha2);
    $cantDiasxAnno = 0;
    $cantDiasxMes = 0;
    $cantDias = 0;
    $dias_x_mes = app_dias_mes();
    //x ANNO
    if ((int)$date_1[0] > (int)$date_2[0] + 1)
        $cantDiasxAnno = ((int)$date_1[0] - (int)$date_2[0] - 1) * 365;

    //x MES
    if ((int)$date_1[0] > (int)$date_2[0]) {
        $ini = 1;//desde enero en adelante
        $fin = (int)$date_1[1];
        while ($ini < (int)$date_1[1]) {
            $cantDiasxMes += $dias_x_mes[$ini];
            $ini++;
        }
        $ini = (int)$date_2[1] + 1;//desde mes actual  en adelante hasta diciembre
        while ($ini <= 12) {
            $cantDiasxMes += $dias_x_mes[$ini];
            $ini++;
        }
    } elseif ((int)$date_1[1] > (int)$date_2[1] + 1) {
        $ini = (int)$date_2[1] + 1;//desde mes actual hasta el prox mes
        $fin = (int)$date_1[1];
        while ($ini < $fin) {
            $cantDiasxMes += $dias_x_mes[$ini];
            $ini++;
        }
    }
    //x DIA
    if ((int)$date_1[1] == (int)$date_2[1]) {
        $cantDias = (int)$date_1[2] - (int)$date_2[2];
    } elseif (((int)$date_1[1] > (int)$date_2[1]) || ((int)$date_1[0] > (int)$date_2[0])) {
        $cantDias = (int)$date_1[2] + ($dias_x_mes[(int)$date_2[1]] - (int)$date_2[2]);
        //$cantDias = ($cantDias < 0)?$cantDias*(-1):$cantDias;
    }

    return $cantDiasxAnno + $cantDiasxMes + $cantDias;
}

function app_redondear($valor)
{
    $arr = explode(",", $valor);
    if (sizeof($arr) > 1)
        $valor = $arr[0] . "." . $arr[1];

    $float_redondeado = round($valor * 100) / 100;
    $arr = explode(".", $float_redondeado);
    if (sizeof($arr) > 1) {
        if ($arr[1] < 10)
            return $float_redondeado . '0';
        else
            return $float_redondeado;
    } else {
        return $float_redondeado . '.00';
    }
}

function app_rate_cambio($precio, $formato = NULL, $conf_str_modulo = NULL)
{
    $moneda = app_moneda();
    $precio = $precio * $moneda['tasa'];
    if ($conf_str_modulo !== NULL) {
        $descuento = app_descuento_tipo_cliente($conf_str_modulo);
        if ($descuento)
            $precio = app_aplicar_descuento($precio, $descuento);
    }
    $precio = app_redondear($precio);
    if ($formato == null) {
        return array('precio' => $precio, 'simbolo' => $moneda['simbolo']);
    } else {
        switch ($formato) {
            case 'ltr': {
                return $precio . ' ' . $moneda['nombre'];
                break;
            }
            case 'smb': {
                return $precio . ' ' . $moneda['simbolo'];
                break;
            }
        }
    }
}

function app_descuento_tipo_cliente($conf_str_modulo)
{
    $usuario_logeado = app_usuario();
    if ($usuario_logeado) {
        $controller = &get_instance();
        $id_usuario = $usuario_logeado['id'];
        $tipo_cliente = isset($usuario_logeado['tipo_cliente_fk']) ? $usuario_logeado['tipo_cliente_fk'] : null;
        if (isset($tipo_cliente) && $tipo_cliente != NULL) {
            $producto_modulos = $controller->app_config('producto_modulo_key');
            $no_modulo = $producto_modulos[$conf_str_modulo];
            $controller->db->select('*');
            $controller->db->from('frontend.frontend_tipo_cliente');
            $controller->db->where('frontend.frontend_tipo_cliente.nombre', $tipo_cliente);
            $controller->db->where('frontend.frontend_tipo_cliente.modulo_fk', $no_modulo);
            $resultado = $controller->db->get()->row();
            if (isset($resultado->descuento) && $resultado->descuento != '')
                return $resultado->descuento;
            else
                return false;
        }
    }
    return false;
}

function app_aplicar_descuento($precio, $descuento)
{
    return $precio - $precio * $descuento / 100;
}

function app_clear_reservas_activas()
{
    $controlador = &get_instance();
    $productos = $controlador->app_config('productos');
    foreach ($productos as $p) {
        $controlador->session->unset_userdata('reserva_activa_' . $p);
    }
}

function app_relleno($valor, $largo, $relleno = 0, $dir = 'l')
{
    $direccion = array('l' => STR_PAD_LEFT, 'r' => STR_PAD_RIGHT);
    return str_pad($valor, $largo, $relleno, $direccion[$dir]);
}

function app_convert_paxs($paxs_nuevos)
{
    $paxs = array();
    foreach ($paxs_nuevos as $key => $p) {
        $a = $p['adultos'];
        $n = $p['ninos'];

        $val = $a;


        $ad = ($a > 1) ? $a . ' ' . trans('al_adultos') : $a . ' ' . trans('al_adulto');

        $ni = '';
        if ($n > 1) {
            $ni = $n . ' ' . trans('al_ninos');
            $val .= '-' . $n;
        } else {
            if ($n == 1) {
                $ni = $n . ' ' . trans('al_nino');
                $val .= '-' . $n;
            }
        }
        $opc = $ni != '' ? $ad . ' - ' . $ni : $ad;

        $paxs[] = array('val' => $val, 'opc' => $opc);
    }

    return $paxs;
}

function app_get_pax_opc($paxs, $pax_opc)
{
    foreach ($paxs as $key => $p) {
        if ($p['val'] == $pax_opc) {
            return $p['opc'];
        }
    }

    return $pax_opc;
}

function trans($key, $options = array())
{
    $CI =& get_instance();

    $line = get_instance()->lang->line($key);

    if (sizeof($options) > 0) {
        $line = $CI->parser->parse_string($line, $options, true);
    }

    // esto es del profiler personal
    if (defined('ENVIRONMENT') && ENVIRONMENT == 'development') {
        // guardar en el profiler la traducción que falta
        if (false === $line) {
            try {
                $CI->myprofilerlib->addLang($key, $key);
            } catch (Exception $e) {
            }
        }
    }
    /////// HASTA AQUI //////////////

    return $line;
}

function app_info_hab($habitaciones,$id_hab,$campo)
{
    foreach($habitaciones as $hab)
    {
        if($hab['tipo_habitacion_fk'] == $id_hab)
            return $hab[$campo];
    }
    return 1;
}

function app_get_tipo_habitacion($tipo_habitacion)
{
    $CI =& get_instance();
    $CI->load->model('mod_alojamiento');

    return $CI->alojamiento->_get_tipo_habitacion($tipo_habitacion);
}

function app_get_plan_alimentacion($plan)
{
    $CI =& get_instance();
    $CI->load->model('mod_alojamiento');

    return $CI->alojamiento->_get_plan_alimentacion($plan);
}

function app_get_paquete_luna_miel($paquete_luna_miel)
{
    $CI =& get_instance();
    $CI->load->model('mod_alojamiento');

    return $CI->alojamiento->get_paquete_luna_miel($paquete_luna_miel);
}

function app_get_pax_habitacion($tipo_habitacion, $plan_alimentacion, $fecha)
{
    $CI =& get_instance();
    $CI->load->model('mod_alojamiento');

    return $CI->alojamiento->get_pax_habitacion($tipo_habitacion, $plan_alimentacion, $fecha);
}

function app_get_restaurante($id)
{
    $controlador = & get_instance();
    $controlador->load->model('mod_restaurante','restaurante');
    return $controlador->restaurante->get_restaurante(array('id'=>$id));
}

function app_get_oferta($id)
{
    $controlador = & get_instance();
    $controlador->load->model('mod_oferta','oferta');
    $oferta = $controlador->oferta->get_oferta(array('id'=>$id));
    return app_traduccion('oferta','oferta_idioma',NULL,'oferta_fk',$oferta['id'],$oferta);
}

function app_get_evento($tipo)
{
    $controlador = & get_instance();
    $controlador->load->model('mod_evento','evento');
    $tipo_evento = $controlador->evento->get_name_tipo_menu($tipo);
    return app_traduccion('evento','evento_tipom_idioma','nombre','tipo_menu_fk',$tipo,$tipo_evento);
}
function app_get_bar($id)
{
    $controlador = & get_instance();
    $controlador->load->model('mod_bar','bar');
    return $controlador->bar->get_bar(array('id'=>$id));
}
function app_get_bar_menu($id)
{
    $controlador = & get_instance();
    $controlador->load->model('mod_bar','bar');

    return $controlador->bar->get_menu($id);
}
function app_get_bar_duracion($id)
{
    $controlador = & get_instance();
    $controlador->load->model('mod_bar','bar');
    return $controlador->bar->get_horario($id);
}

// B2B
function app_descuento_tipo_producto($conf_str_modulo,  $tipo_habitacion = null, $plan = null, $fecha = null)
{
    $usuario_logeado = app_usuario();
    if ($usuario_logeado)
    {
        $controller = & get_instance();

        $tipo_cliente = $usuario_logeado['id_tipo_cliente'];
        if ($tipo_cliente != NULL)
        {

            if (!$fecha)
            {
                $fecha = date("Y-m-d");
            }

            $controller->db->select('*');
            $controller->db->from('frontend.frontend_cliente_producto');
            $controller->db->where('frontend.frontend_cliente_producto.producto_tipo', $conf_str_modulo);
            $controller->db->where('frontend.frontend_cliente_producto.descuento_fk', $tipo_cliente);
            $controller->db->where("'" . $fecha . "' BETWEEN frontend.frontend_cliente_producto.fecha_cupo_inicio AND frontend.frontend_cliente_producto.fecha_cupo_fin",
                null,
                false
            );

            if ($tipo_habitacion)
            {
                $controller->db->where('frontend.frontend_cliente_producto.tipo_habitacion_fk', $tipo_habitacion);
            }
            if ($plan)
            {
                $controller->db->where('frontend.frontend_cliente_producto.plan_fk', $plan);
            }

            $resultado = $controller->db->get()->row();

            if (isset($resultado->descuento) && $resultado->descuento != '')
                return array($resultado->descuento, $resultado->pre_descuento, $resultado->post_aumento);
            else
                return array(0, 0, 0);
        }
    }
    return array(0, 0, 0);
}
?>