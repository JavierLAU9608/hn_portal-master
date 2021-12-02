<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Con_home extends APP_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->str_producto = 'home';

        $this->load->model('mod_oferta', 'oferta');
        $this->load->model('mod_restaurante', 'restaurante');
        $this->load->model('mod_alojamiento', 'alojamiento');
        $this->load->model('mod_evento', 'evento');
    }

    public function index()
    {
        $datos = array('slide_show' => $this->sitio->st_get_slide_show());

        // Tipos de habitaciones
        $lista_alojamientos = $this->alojamiento->get_alojamientos(NULL, NULL, null);
        foreach ($lista_alojamientos as &$al) {
            $al['tipo'] = $this->alojamiento->get_tipo_alojamiento($al['id']);
            //$al['facilidades'] = $this->alojamiento->get_facilidades_alojamiento($al['tipo_habitacion_fk'],$this->id_hotel_current);

            $precio = $this->calcular_precio($al['tipo_habitacion_fk']);
            $al['precio_numerico'] = $precio;
            $al['precio'] = app_rate_cambio(ceil($precio),'smb');
            $al['precio_oferta'] = $this->precio_oferta($al['tipo_habitacion_fk']);
            $al['precio_original'] = $al['precio'];

            if ($al['precio_oferta']) {
                $al['precio'] =  app_rate_cambio(ceil($al['precio_oferta']), 'smb');
            }

            $al['nombre_trad_'] = app_traduccion('hotel','hotel_tipo_hab_idioma','nombre','tipo_habitacion_fk', $al['tipo']['id'],$al['tipo']['nombre_habitacion']);
        }


        $datos['lista_alojamientos'] = $lista_alojamientos;
        $datos['default_room'] = $lista_alojamientos[1];
        $datos['room_info']  = $this->get_paros($lista_alojamientos[1]['tipo_habitacion_fk']);

        //parisien
        $temp = $this->getOferta();
        $datos = array_merge($datos, $temp);

        // buena vista
        $temp = $this->getOferta('conciertos-invitados-buena-vista-social-club', 'buena_vista');
        $datos = array_merge($datos, $temp);

        // ofertas especiales
        $temp = $this->getOferta('bodas-quinces-aniversarios', 'bodas');
        $datos = array_merge($datos, $temp);


        // bodas, quinces, aniversarios
        $temp = $this->getOferta('ofertas-especiales', 'ofertas_especiales');
        $datos = array_merge($datos, $temp);
        $datos['texto_boda'] = $this->sitio->st_get_informacion_simple('textoboda');


//        // eventos
        $datos['texto_evento'] = $this->sitio->st_get_informacion_simple('textoevento');
        $datos['textoeventocontacto'] = $this->sitio->st_get_informacion_simple('textoeventocontacto');
        $datos['evento_imagenes'] = $this->evento->get_all_img_servicios(30);
        $datos['evento_tipos'] = $this->evento->get_tipo_servicios();

        // datos restaurantes
        $datos['lista_restaurantes'] = $this->getRestaurants();
        $datos['textopresentacion_restaurante'] = $this->sitio->st_get_informacion_simple('textorestaurante');
        $datos['textocontacto_restaurante'] = $this->sitio->st_get_informacion_simple('textorestaurantecontacto');
        $datos['texto_presentacion'] = $this->sitio->st_get_informacion_simple('textohome');


        // ofertas restaurantes
        $temp = $this->getOferta('ofertas-restaurantes', 'ofertas_restaurantes');
        $datos = array_merge($datos, $temp);

        $this->display('home', $datos);

//        $this->load->view('home', $datos);
    }

    private function get_paros($tipo_habitacion)
    {

        if ($tipo_habitacion > 0) {

            $datos['hotel'] = $this->alojamiento->get_hotel_reducido();
            $fecha = $datos['hotel']['fecha_minima'];
            $this->alojamiento->modifica_paros($datos, $tipo_habitacion, $fecha);

            $paros = $datos['hotel']['paros_venta'];
            $fecha_min = $datos['hotel']['fecha_minima'];
            $min_noches = $datos['hotel']['minimo_de_noches'];

            //if ($fecha < $fecha_min) {
            $fecha = $fecha_min;
            //}

            $_p = array();
            foreach ($paros as $key => $paro)
            {
                $_p[] = array(date("Y/m/d",strtotime($paro['fecha_inicio'])), date("Y/m/d",strtotime($paro['fecha_fin'])));
            }

            $cant_max_noches   = $this->alojamiento->get_max_cant_max_noches($fecha, $tipo_habitacion);
            $cant_habitaciones = $this->alojamiento->get_cant_hab_disp($tipo_habitacion, $fecha);

            $this->load->model('sitio');
            $max_habitacion_reserva = $this->sitio->st_get_informacion_simple_directa('max_habitacion_reserva');
            $max_noches_reserva = $this->sitio->st_get_informacion_simple_directa('max_noches_reserva');

            $cant_habitaciones = $cant_habitaciones > $max_habitacion_reserva ? $max_habitacion_reserva : $cant_habitaciones;
            $cant_max_noches = $cant_max_noches > $max_noches_reserva ? $max_noches_reserva: $cant_max_noches;

            // nueva funcionalidad
            $info = $this->alojamiento->get_reserva_info($fecha);

            return (array('ok' => 't', 'fecha' => $fecha, 'fechaMax' => $datos['hotel']['fecha_maxima'],
                'habitaciones' => $cant_habitaciones, 'noches_min' => ($min_noches == 0 ? 1: $min_noches),
                'min_active_day' => $datos['hotel']['min_active_day'],
                'noches_max' => $cant_max_noches, 'paros' => json_encode($_p),
                'info' => $info
            ));
        }

        return (array('ok' => 'f', 'msg' => trans('al_error_no_politica')));
    }

    private function getRestaurants()
    {
        $lista_restaurantes = $this->restaurante->get_restaurantes();

        foreach($lista_restaurantes as &$r)
        {
            $list_menu = $this->restaurante->get_menu($r['id']);
            $flag = true;
            foreach($list_menu as &$menu)
            {
                if($flag){	$menor = 10000;$mayor = 0;	$flag = false;	}
                if($menu['precio'] <= $menor && $menu['precio'] != 0 )
                {
                    $r['precio'] = app_rate_cambio($this->verifica_cliente($menu['precio']),'smb');
                    $menor = $menu['precio'];
                }
                if($menu['precio'] > $mayor && $menu['precio'] != 0 )
                {
                    $r['precio_mayor'] = app_rate_cambio($this->verifica_cliente($menu['precio']),'smb');
                    $mayor = $menu['precio'];
                }
            }
        }

        return $lista_restaurantes;
    }

    private function verifica_cliente($precio)
    {
        if($precio && $precio>0)
        {
            $descuento_cliente = app_descuento_tipo_cliente('alojamiento');
            if($descuento_cliente)
                $precio = app_aplicar_descuento($precio,$descuento_cliente);
            return $precio;
        }
        return false;
    }

    private function getOferta($slug = 'cabaret-parisien', $key = 'parisiem')
    {
        $tipo = $this->oferta->get_tipos_oferta(array('slug'=> $slug));
        $criterio['tipo_fk'] = $tipo['id'];
        $tipo_oferta_traducido = app_traduccion('oferta','oferta_tipo_idioma',NULL,'tipo_fk',$tipo['id'],$tipo);
        $datos[$key] = $tipo_oferta_traducido;

        $sub = 'lista_'. $key;
        $datos[$sub] = $this->oferta->get_ofertas($criterio);

        return $datos;
    }

    private function calcular_precio($id_tipo)
    {
        $precio_alojamiento = $this->alojamiento->get_precio_alojamiento($id_tipo);
        if($precio_alojamiento && $precio_alojamiento['precio_adulto']>0)
        {
            $precio = $precio_alojamiento['precio_adulto'];
            $descuento_cliente = app_descuento_tipo_cliente('alojamiento');
            if($descuento_cliente)
                $precio = app_aplicar_descuento($precio,$descuento_cliente);
            return $precio;
        }
        return false;
    }

    private function precio_oferta($id_tipo, $fecha = null)
    {
        if (!$fecha) {
            $f = new DateTime('now');
            $fecha = $f->format('Y-m-d');
        }

        $oferta = $this->alojamiento->_get_oferta_habitacion($id_tipo, $fecha);

        if ($oferta) {
            $precio = $oferta['precio'];

            return $precio;
        }
    }

    function pagina_footer($id)
    {
        $id = urldecode($id);
        $id = app_id_url_amigable('frontend', $id, 'titulo', 'frontend_menu_footer', 'nombre', 'frontend_menupie_idioma', 'menu_footer_fk');
        $this->load->model('mod_home', 'home');
        $items_footer = $this->sitio->st_get_menu_footer();
        $items = array();
        foreach ($items_footer as $item) {
            if ($item['url'] == '') {
                $titulo = app_traduccion('frontend', 'frontend_menupie_idioma', 'nombre', 'menu_footer_fk', $item['id'], $item['titulo']);
                $url = base_url(trans('ruta_informacion', array('titulo' => url_title($titulo), 'id' => $item['id'])));
                $items[$item['id']] = array('url' => $url,
                    'titulo' => $titulo
                );
            }
        }
        $datos['items'] = $items;
        $datos['item_activo'] = $id;
        if ($id) {
            $datos['pagina_footer'] = $this->home->get_pagina_footer($id);
        } else {
            $datos['pagina_footer'] = array();
        }
        $this->display('home_pagina_footer', $datos);
    }

    function pagina_footer_ajax($id)
    {
        $id = urldecode($id);
        $id = app_id_url_amigable('frontend', $id, 'titulo', 'frontend_menu_footer', 'nombre', 'frontend_menupie_idioma', 'menu_footer_fk');

        $this->load->model('mod_home', 'home');
        $datos['pagina_footer'] = $this->home->get_pagina_footer($id);

        $this->display('home_pagina_footer_ajax', $datos);
    }

    function historia()
    {
        $this->str_producto = 'historia';
        $datos = array();
        $datos['historia'] = $this->sitio->st_get_informacion_simple('textohistoria');
        $this->load->view('historia', $datos);
    }


}