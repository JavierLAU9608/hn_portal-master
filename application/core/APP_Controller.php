<?php
class APP_Controller extends CI_Controller{
	var $idioma_current = array();
	var $idioma_current_code = '';
	var $moneda_current = array();
	var $moneda_current_iso = '';
	var $id_hotel_current = NULL;
	var $id_tipo_servicio_sala = NULL;
	var $root_producto = 'productos/';
	var $url_base = '';
	var $str_producto = '';

    function __construct()
    {
        parent::__construct();
		$this->idioma_current = $this->app_idioma();
		$this->idioma_current_code = $this->idioma_current['codigo'];
		define('CODIGO_IDIOMA',$this->idioma_current_code);
		$this->moneda_current = $this->app_moneda();
		$this->moneda_current_iso = $this->moneda_current['codigo_iso'];
		define('SIMBOLO_MONEDA',$this->moneda_current['simbolo']);
		$this->cargar_idiomas();
		$this->id_hotel_current = $this->app_config('hotel_key');
		$this->ruta_galeria = 'hoteles/'.$this->id_hotel_current.'/images/';

		$this->configTwig();
    }

	private function configTwig()
	{
		$config_twig = [
			// funciones disponibles desde twig
			'functions' => ['app_url_admin', 'trans', 'round_number', 'url_title', 'word_limiter', 'base_url',
				'app_room_type', 'form_dropdown', 'app_traduccion',
				'app_strip_etiquetas', 'app_rate_cambio', 'app_parse', 'app_menu_footer', 'app_info_hab',
				'app_get_tipo_habitacion', 'app_get_plan_alimentacion', 'app_get_pax_opc', 'app_get_paquete_luna_miel',
				'app_now', 'app_str_date', 'app_get_pax_habitacion', 'app_convert_paxs', 'menu_vertical', 'app_paises',
				'app_get_restaurante', 'app_get_oferta', 'app_get_evento', 'app_get_bar_menu', 'app_get_bar_duracion',
				'app_tarjetas_creditos'
			],
			'debug' => (ENVIRONMENT !== 'production'),
		];

		$config_twig['paths'][] = VIEWPATH;

		// agregar estas funciones en modo desarrollo
		if (ENVIRONMENT !== 'production') {
			$config_twig['functions'][] = 'elapseTime';
			$config_twig['functions'][] = 'getProfilerResumen';
			$config_twig['functions'][] = 'getCIVersion';
			$config_twig['functions'][] = 'displayArray';
		}

		// cargar twig
		$this->load->library('twig', $config_twig);

		$modules = Modules::list_modules();
		foreach (Modules::$locations as $location => $offset) {
			foreach ($modules as $module) {
				$dir = $location . $module. '/views/';
				if (is_dir($dir)) {
					$this->twig->addPath($dir, $module);//path, namespace
				}
			}
		}

		// ignorar cuando la petición es ajax (para evitar las consultas innecesarias)
		if (!$this->input->is_ajax_request()) {
			// variables globales de twig
			$this->twig->addGlobal('app', $this->getApp());
		}

		// un ejemplo de agregar un filtro
		//$this->twig->getTwig()->addFilter('round_number', new Twig_Filter_Function('round_number'));
	}

	/**
	 * Crear variables accesibles desde todas las plantillas de la forma app.site_name
	 *
	 * @return array
	 */
	public function getApp()
	{
		$texto_presentacion = $this->sitio->st_get_informacion_simple('textoalojamiento');

		$app = [
			'site_name' => $this->app_config('nombre_sistema'),
			'current_url' => $_SERVER['REQUEST_URI'],
			'current_lang' => app_idioma(),
			'main_menu' => app_menu(),
			'all_langs' => app_idiomas(),
			'all_currency' => app_monedas(),
			'texto_presentacion' => app_traduccion('frontend', 'frontend_informacion_idioma', 'descripcion', 'informacion_fk', $texto_presentacion['id'], $texto_presentacion['value']),
			'current_currency' => app_moneda(),
			'social_nets' => app_redes_sociales(),
			'url_admin' => app_url_admin(),
			'user' => $this->session->userdata('usuario_registrado'),
			'countries' => app_paises(),
			'env' => ENVIRONMENT,
			'isPost' => $this->input->method() == 'post',
			'isGet' => $this->input->method() == 'get',

			'telefono' => $this->sitio->st_get_informacion_simple('telefono'),
			'telefonoreserva' => $this->sitio->st_get_informacion_simple('telefonoreserva'),
			'faxhotel' => $this->sitio->st_get_informacion_simple('faxhotel'),
			'direccion' => $this->sitio->st_get_informacion_simple('direccion'),
			'total_carro_compra' => $this->cart->total_items(),
		];

		return $app;
	}

	function go()
	{
		redirect(base_url());
	}
	function generar_key_producto()
	{
		return $this->str_producto.'_reserva_'.md5(microtime());
	}
	function app_config($valor)
	{
		return $this->config->item($valor);
	}
	function cargar_idiomas($idioma = NULL)
	{
		if($idioma!==NULL)
		{
			$this->lang->language = array();
			$this->lang->is_loaded = array();
			$this->idioma_current_code = $idioma;
		}
		$this->lang->load('hn',$this->idioma_current_code);
		$this->lang->load('ruta',$this->idioma_current_code);
		$this->lang->load('seo',$this->idioma_current_code);
		$this->lang->load('textomail',$this->idioma_current_code);
		$productos = $this->app_config('productos');
		foreach($productos as $p)
		{
			$this->lang->load($p,$this->idioma_current_code);
		}
	}
	function app_idioma_defecto()
	{
		$idioma =  $this->sitio->st_get_idioma(array('codigo'=>app_config('language')));
		$this->session->set_userdata(array('language' => $idioma));

		return $idioma;
	}
	function app_idioma()
	{
		$idioma = $this->session->userdata('language');
		if($idioma)
			return $idioma;
		return $this->app_idioma_defecto();
	}
	function app_idiomas()
	{
		return $this->sitio->st_get_idiomas();
	}
	function app_moneda_defecto()
	{
		return $this->sitio->st_get_moneda_defecto();
	}
	function app_moneda()
	{
		$moneda = $this->session->userdata('money');
		if($moneda)
			return $moneda;
		return $this->app_moneda_defecto();
	}
	function app_monedas()
	{
		return $this->sitio->st_get_monedas();
	}
	public function _error_no_existe($elemento = NULL)
	{
		if($elemento == NULL)
			$elemento = trans($this->str_producto);
		$this->_error(trans('error_elemento_no_encontrado',array('nombre'=>$elemento)));
	}
	public function _error($msg)
	{
		$this->display('administracion/msg_error', array('msg' => $msg));
		//show_error($msg);
	}


	/**
	 * Muestra la página de login si no ha iniciado sesión
	 */
	public function securityCheck()
	{
		$user = $this->session->userdata('usuario_registrado');

		if (!$user) {
			$url = uri_string();

			echo $this->twig->render('pages/login', ['redirect' => $url]);
			exit();
		}

		return $user;
	}

	/**
	 * Muestra una respuesta JSON
	 *
	 * @param array $arr
	 */
	public function JsonResponse($arr = array())
	{
		$this->output->set_header('Content-type: application/json; charset=UTF-8');
		$this->output->set_output(json_encode($arr));
	}


	/**
	 * Acceso directo a $this->twig->render()
	 *
	 * @param $template
	 * @param array $data
	 * @return string
	 */
	public function display($template, $data = array())
	{
		$this->twig->display($template, $data);
	}

	// guardar las queries si la petición es ajax,
	// sino se guardan cuando la bar ejecuta getProfilerResumen()
	function __destruct()
	{
		if (ENVIRONMENT !== 'production') {
			// si la petición fue por ajax guardar las queries
			if ($this->input->is_ajax_request()){
				$this->myprofilerlib->addQueries($this->db->queries, $this->db->query_times);
			}
		}
	}
}