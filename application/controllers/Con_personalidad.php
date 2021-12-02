<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_personalidad extends APP_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('mod_personalidad', 'personalidad');
		$this->str_producto = 'personalidad';
	}
	public function index($pagina = 0)
	{
		$this->load->library('pagination');
		$this->load->helper('text');
		
		$criterio = array();
		
		$items_pagina = $this->sitio->st_get_informacion_simple_directa('paginadopersonalidades');		
		$pagina = $pagina;
		$config['page_query_string']=false;
		$config['base_url']=base_url(trans('ruta_personalidades'));
		$config['total_rows'] = $this->personalidad->get_total_personalidades();	
		$config['cur_page'] = $pagina;	
		$config['per_page']	= $items_pagina;
		$this->pagination->initialize($config);	
		$datos['paginacion'] = $this->pagination->create_links();
		$datos['pagina'] = $pagina;
		$datos['textopresentacion'] = $this->sitio->st_get_informacion_simple('textopersonalidades');
		$datos['textohome'] = $this->sitio->st_get_informacion_simple('textohome');
		$datos['lista_personalidades'] = $this->personalidad->get_personalidades($criterio,$items_pagina,$pagina);
		$this->load->view('personalidades',$datos);
	}
	public function personalidad($slug)
	{
		$datos = array();
		if($datos['personalidad']=$this->personalidad->get_personalidad(array('slug'=>$slug)))
		{
			$total_a_mostrar = 4;
			$cantidad_relacionadas = $this->personalidad->get_total_personalidades(array('tipo_personalidad_fk'=>$datos['personalidad']['tipo_personalidad_fk']));
			$posible_inicio = $cantidad_relacionadas - $total_a_mostrar - 1;			
			$posible_inicio = ($posible_inicio<0?0:rand(0,$posible_inicio));
			$datos['personalidades_relacionadas'] = $this->personalidad->get_personalidades(array('tipo_personalidad_fk'=>$datos['personalidad']['tipo_personalidad_fk'],'i.id != '=>$datos['personalidad']['id']),$total_a_mostrar,$posible_inicio);
			$this->load->view('personalidad',$datos);
		}
		else
			$this->_error_no_existe('personalidad');
	}
}