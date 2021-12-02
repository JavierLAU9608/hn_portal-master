<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_bar extends APP_Controller {
	function __construct()
	{
		parent::__construct();
		$this->root_producto.='bar/';
		$this->url_base.=trans('ruta_bares');
		$this->str_producto = 'bar';
		$this->load->model('mod_bar', 'bar');
	}
	public function index($pagina = 0)
	{
		app_clear_reservas_activas();
		$this->load->library('pagination');
		$this->load->helper('text');
		
		$criterio = array();
		
		$items_pagina = $this->sitio->st_get_informacion_simple_directa('paginadobares');		
		$pagina = $pagina;
		$config['page_query_string']=false;
		$config['base_url']=base_url(trans('ruta_bares'));
		$config['total_rows'] = $this->bar->get_total_bares($criterio);	
		$config['cur_page'] = $pagina;	
		$config['per_page']	= $items_pagina;
		$this->pagination->initialize($config);	
		$datos['paginacion'] = $this->pagination->create_links();
		$datos['pagina'] = $pagina;
		$datos['textopresentacion'] = $this->sitio->st_get_informacion_simple('textobares');
		$datos['lista_bares'] = $this->bar->get_bares($criterio,$items_pagina,$pagina,array('imagenes'=>true));
		$this->load->view($this->root_producto.'index',$datos);
	}
	public function bar($slug)
	{
		$datos = array();
		if($datos['bar']=$this->bar->get_bar(array('slug'=>$slug),FALSE,TRUE))
		{
			$datos['items'] = $this->_menu_vertical($datos['bar']);
			$datos['item_activo'] = $datos['bar']['id'];			
			$this->load->view($this->root_producto.'bar',$datos);
		}
		else
			$this->_error_no_existe();
	}
	private function _menu_vertical($datos_bar)
	{
		$bares = $this->bar->get_bares(array());
		$menu_bares = array();
		foreach($bares as $b)
		{
			$menu_bares[$b['id']] = array('url'=>trans('ruta_bar',array('slug'=>$b['slug'])),
										  'titulo'=>trans('br_bar_nombre',array('nombre'=>$b['nombre']))
										  );
		}
		return $menu_bares;
		//return array('bar'=>array('url'=>trans('ruta_bar',array('slug'=>$datos_bar['slug'])),'titulo'=>trans('br_bar_nombre',array('nombre'=>$datos_bar['nombre']))),'menus'=>array('url'=>trans('ruta_bar_menus',array('slug'=>$datos_bar['slug'])),'titulo'=>trans('br_menus')));
	}
	public function bar_menus($slug)
	{
		$datos = array();
		if($datos['bar']=$this->bar->get_bar(array('slug'=>$slug),TRUE))
		{
			$datos['items'] = $this->_menu_vertical($datos['bar']);
			$datos['item_activo'] = $datos['bar']['id'];			
			$this->load->view($this->root_producto.'bar_menus',$datos);
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
		if($datos['bar']=$this->bar->get_bar(array('slug'=>$slug),TRUE))
		{
			$datos['flash_error'] = $this->session->flashdata('flash_error');
			$this->load->view($this->root_producto.'reserva_01',$datos);
		}
		else
			$this->_error_no_existe();
	}
	public function crear_reserva()
	{
		if($this->input->post("btn_continuar"))
		{
			$id_bar = $this->input->post("id_bar");
			if($datos['bar']=$this->bar->get_bar(array('id'=>$id_bar),TRUE))
			{
				$this->load->helper(array('form'));
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('','');
		
				if ($this->form_validation->run('precio_bar') == TRUE)
				{					
					$fecha = $this->input->post("fecha");
					$menu = $this->input->post("menu");
					$duracion = $this->input->post("duracion");
					$horas_extras = $this->input->post("horas_extras");
					$cantidad = $this->input->post("cantidad");
					$precio = $this->calcular_precio($id_bar,$fecha,$menu,$duracion,$horas_extras,$cantidad);
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
						   'name'    => $datos['bar']['id'],
						   'options' => array('aconfirmar'  => $this->input->post("aconfirmar")==1?1:0,						   					  
						   					  'tipo'        => $this->str_producto,
											  'id_bar'      => $id_bar,
											  'slug'        => $datos['bar']['slug'],
											  'fecha'       => $fecha,
											  'id_menu'     => $menu,
											  'id_duracion' => $duracion,
											  'horas_extras'=> $horas_extras,
											  'cantidad'    => $cantidad
												)
												);
												

					$datos['menu_reservado'] = $this->bar->get_menu($menu);
					$datos['horario_reservado'] = $this->bar->get_horario($duracion);
		            $this->cart->insert($producto_reservado);

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
					redirect(base_url(trans('ruta_reservar_bar',array('slug'=>$datos['bar']['slug']))));
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
	
			if ($this->form_validation->run('precio_bar') == TRUE)
			{
				$id_bar = $this->input->post("id_bar");
				$fecha = $this->input->post("fecha");
				$menu = $this->input->post("menu");
				$duracion = $this->input->post("duracion");
				$horas_extras = $this->input->post("horas_extras");
				$cantidad = $this->input->post("cantidad");
				$precio = $this->calcular_precio($id_bar,$fecha,$menu,$duracion,$horas_extras,$cantidad);
				$resultado = array('ok'=>'f','msg'=>'','precio'=>0);
				if($precio)
				{
					$resultado['ok']='t';
					$resultado['precio']=app_rate_cambio($precio,'smb');
				}
				else
				{
					$resultado['ok']='f';
					$resultado['msg']=trans('br_error_no_precio');
					$resultado['precio']=0;
				}
				print json_encode($resultado);
				exit();
			}
			print json_encode(array('ok'=>'f','msg'=>validation_errors(),'precio'=>0));
			exit();			
		}
	}
	private function calcular_precio($id_bar,$fecha,$menu,$duracion,$horas_extra,$cantidad)
	{
		if($bar=$this->bar->get_bar(array('id'=>$id_bar),TRUE))
		{
			$menu_seleccionado = $bar['menus'][$menu];
			foreach($menu_seleccionado['tarifas'] as $t)
			{
				if($t['id'] == $duracion)
				{
					$costo = $menu_seleccionado['precio'];
					$costo += $t['precio'];
					$costo += $t['precio_extra']*$horas_extra;
					return $costo*$cantidad;
				}
			}
			return false;
		}
		return false;
	}
}