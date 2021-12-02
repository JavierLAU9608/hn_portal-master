<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_restaurante extends APP_Controller {
	function __construct()
	{
		parent::__construct();
		$this->root_producto.='restaurante/';
		$this->load->model('mod_restaurante', 'restaurante');
		$this->str_producto = 'restaurante';
	}
	public function index($pagina = 0)
	{
		$this->load->library('pagination');
		$this->load->helper('text');
		
		$items_pagina = $items_pagina = $this->sitio->st_get_informacion_simple_directa('paginadobares');		
		$pagina = $pagina;	
		
		$config['page_query_string']=false;
		$config['base_url'] = trans('ruta_restaurantes');
		$config['total_rows'] = $this->restaurante->get_total_restaurantes();	
		$config['cur_page'] = $pagina;	
		$config['per_page']	= $items_pagina;
		$this->pagination->initialize($config);	
		$datos['paginacion'] = $this->pagination->create_links();
		$datos['pagina'] = $pagina;
		$datos['js_page'] = true;
		$datos['textopresentacion'] = $this->sitio->st_get_informacion_simple('textorestaurante');
		$lista_restaurantes = $this->restaurante->get_restaurantes($items_pagina,$pagina);
	
		foreach($lista_restaurantes as &$r)
		{	
		$r['tipo'] = $this->restaurante->get_tipo_restaurante($r['id']); 
		$r['imagenes'] = $this->restaurante->get_imagenes_restaurante($r['id']); 	
		
		    $list_menu = $this->restaurante->get_menu($r['id']);
			$flag = true;
			foreach($list_menu as &$menu)
			{
				if($flag){	$menor = $menu['precio'];	$flag = false;	}
				if($menu['precio'] <= $menor && $menu['precio'] != 0 )
				{
					$r['precio'] = app_rate_cambio($this->verifica_cliente($menu['precio']),'smb');					
				}								
			}		
		}
		$datos['lista_restaurantes'] = $lista_restaurantes;
		
		$this->load->view($this->root_producto.'index',$datos);
	}
	public function restaurante($view,$slug)
	{
		$this->load->helper('text');
		$datos = array();
		$restaurante = $this->restaurante->get_restaurante(array('slug'=>$slug));
		if($restaurante)
		{
			$datos['restaurante'] =	$restaurante;
			$datos['tipo'] = $this->restaurante->get_tipo_restaurante($restaurante['id']);
			$datos['imagenes'] = $this->restaurante->get_imagenes_restaurante($restaurante['id']); 
			
			$datos['menus'] = $this->restaurante->get_menu($datos['restaurante']['id']);
			$menor_precio = 999999;
			foreach($datos['menus'] as &$menu)
			{
				$menu['precio'] = app_rate_cambio($this->verifica_cliente($menu['precio']),'smb');
				if($menu['precio']<$menor_precio)
					$menor_precio = $menu['precio'];
			}
			$datos['restaurante']['menor_precio'] = $menor_precio;
			$datos['view'] = ($view == 'menu')?'menu':'open';
			$datos['active_link'] = ($view == 'menu')?array('','active'):array('active','');			
			$datos['id_hotel'] = $this->id_hotel_current;	
			$this->display($this->root_producto.'restaurante',$datos);
			//$this->load->view($this->root_producto.'restaurante',$datos);
		}
		else
			$this->_error_no_existe();
	}
	public function reservar($slug)
	{
		$datos = array();
		if($ckecking = $this->session->userdata('reserva_activa_'.$this->str_producto))
		{
			if($reserva = $this->cart->get_item($ckecking))
			{
				$datos['key_car_reserva'] = $ckecking;			
				$datos['reserva'] = $reserva;
			}
		}
		if($datos['restaurante']  = $this->restaurante->get_restaurante(array('slug'=>$slug,'disponible'=>'t'),TRUE))
		{
			$datos['fecha_seleccionada'] = $this->input->post("fecha");
			$datos['flash_error'] = $this->session->flashdata('flash_error');
			$datos['menus'] = $this->restaurante->get_menu($datos['restaurante']['id']);
			$this->load->view($this->root_producto.'reserva_01',$datos);
		}
		else
			$this->_error_no_existe();
	}
	private function verifica_cliente($precio)
	{	
		if($precio && $precio>0)
		{
			$descuento_cliente = app_descuento_tipo_cliente($this->str_producto);
			if($descuento_cliente)
				$precio = app_aplicar_descuento($precio,$descuento_cliente);
			return $precio;
		}
		return false;
	}
	public function crear_reserva()
	{
		if($this->input->post("btn_continuar"))
		{
			$id_restaurante = $this->input->post("id_restaurante");
			if($datos['restaurante']=$this->restaurante->get_restaurante(array('id'=>$id_restaurante),TRUE))
			{
				$this->load->helper(array('form'));
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('','');
		
				if ($this->form_validation->run('precio_restaurante') == TRUE)
				{					
					$fecha = $this->input->post("fecha");
					$horario = $this->input->post("horario");
					$menus_validos = array();					
					foreach ($this->input->post("cantidad") as $key => $value)
					{
						if($value > 0)
							$menus_validos[$key]['cantidad'] = $value;
					}
					foreach ($this->input->post("id_menu") as $key => $value)
					{
						if(isset($menus_validos[$key]['cantidad']) && $menus_validos[$key]['cantidad'] > 0)
							$menus_validos[$key]['id_menu'] = $value;
					}
					$precio = $this->calcular_precio($id_restaurante,$menus_validos);
					$datos['precio'] = app_rate_cambio($precio);
					
					$ckecking = $this->session->userdata('reserva_activa_'.$this->str_producto);
					if($this->input->post('key_car_reserva'))
						$key_producto = $this->input->post('key_car_reserva');
					elseif($ckecking)
						$key_producto=$ckecking;					
					else
						$key_producto = $this->generar_key_producto();									
					
					$producto_reservado = array(	  
						   'id'      => $key_producto,
						   'qty'     => 1,
						   'price'   => $precio,
						   'name'    => $datos['restaurante']['id'],
						   'options' => array('aconfirmar'    => $this->input->post("aconfirmar")==1?1:0,						   					  
						   					  'tipo'          => $this->str_producto,
											  'id_restaurante'=> $id_restaurante,
											  'slug'          => $datos['restaurante']['slug'],
											  'fecha'         => $fecha,
											  'horario'       => $horario,
											  'menus'         => $menus_validos											  
												)
												);

					$datos['horario_reservado'] = $this->restaurante->get_horario($horario);

					if ($car = $this->cart->searchProduct($key_producto)) {
						$producto_reservado['rowid'] = $car['rowid'];
						$this->cart->update($producto_reservado);
					} else {
						$producto_reservado['rowid'] = $this->cart->insert($producto_reservado);
					}

					$datos['producto'] = $producto_reservado;

					$this->session->set_userdata(array('reserva_activa_'.$this->str_producto=>$key_producto));					
					$this->load->view($this->root_producto.'reserva_02',$datos);
				}
				else
				{
					$this->session->set_flashdata('flash_error', validation_errors());
					redirect(base_url(trans('ruta_reservar_restaurante',array('slug'=>$datos['restaurante']['slug']))));
				}
			}
			else
			redirect(base_url('error'));
		}
		elseif($this->input->post("btn_cancelar"))
		{
			$this->go();
		}
	}
	public function calcular()
	{
		if($this->input->is_ajax_request())
		{	
			$this->load->helper(array('form'));
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('','');
	
			if ($this->form_validation->run('precio_restaurante') == TRUE)
			{
				$id_restaurante = $this->input->post("id_restaurante");
				$fecha = $this->input->post("fecha");
				$horario = $this->input->post("horario");
				
				$menus_validos = array();
				foreach ($this->input->post("id_menu") as $key => $value)
				{
					$menus_validos[$key]['id_menu'] = $value;
				}
				foreach ($this->input->post("cantidad") as $key => $value)
				{
					$menus_validos[$key]['cantidad'] = $value;
				}
				$precio = $this->calcular_precio($id_restaurante,$menus_validos);
				$resultado = array('ok'=>'f','msg'=>'','precio'=>0);
				if($precio)
				{
					$resultado['ok']='t';
					$resultado['precio']=app_rate_cambio($precio,'smb');
				}
				else
				{
					$resultado['ok']='f';
					$resultado['msg']=trans('rt_error_no_precio');
					$resultado['precio']=0;
				}
				print json_encode($resultado);
				exit();
			}
			print json_encode(array('ok'=>'f','msg'=>validation_errors(),'precio'=>0));
			exit();			
		}
	}
	private function calcular_precio($id_restaurante,$menus)
	{
		if($restaurante=$this->restaurante->get_restaurante(array('id'=>$id_restaurante),TRUE))
		{
			$costo_total = 0;
			foreach($menus as $m)
			{
				$datos_menu = $this->restaurante->get_el_menu($restaurante['id'],$m['id_menu']);
				$costo_menu = 0;
				if($datos_menu)
				{
					$costo_menu = $m['cantidad']*$datos_menu['precio'];
				}
				$costo_total += $costo_menu;
			}
			return $costo_total == 0?false:$costo_total;
		}
		return false;
	}
}