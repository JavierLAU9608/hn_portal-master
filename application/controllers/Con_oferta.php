<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_oferta extends APP_Controller {
	function __construct()
	{
		parent::__construct();
		$this->root_producto.='oferta/';
		$this->url_base.=trans('ruta_ofertas');
		$this->str_producto = 'oferta';
		$this->load->model('mod_oferta', 'oferta');
	}
	public function index($tipo_oferta = NULL,$pagina = 0)
	{
		app_clear_reservas_activas();
		$this->load->library('pagination');
		$this->load->helper('text');
		$criterio = array('disponible'=>'t');
		$datos['sub_titulo'] = '';
		if($tipo_oferta!=='NULL' && $tipo_oferta!==NULL)
		{		
			$tipo = $this->oferta->get_tipos_oferta(array('slug'=>$tipo_oferta));			
			$criterio['tipo_fk'] = $tipo['id'];
			$config['base_url']=base_url(trans('ruta_ofertas_tipo',array('slug'=>$tipo_oferta)));
			$tipo_oferta_traducido = app_traduccion('oferta','oferta_tipo_idioma',NULL,'tipo_fk',$tipo['id'],$tipo);			
			$datos['sub_titulo'] = $tipo_oferta_traducido['nombre'];
			$datos['tipo_oferta'] = $tipo_oferta_traducido;
		}
		else
		{
			$config['base_url']=base_url(trans('ruta_ofertas'));
		}
		
		$items_pagina = $this->sitio->st_get_informacion_simple_directa('paginadoofertas');		
		$pagina = $pagina;
		$config['page_query_string']=false;
		
		$config['total_rows'] = $this->oferta->get_total_ofertas($criterio);	
		$config['cur_page'] = $pagina;	
		$config['per_page']	= $items_pagina;
		$this->pagination->initialize($config);	
		$datos['paginacion'] = $this->pagination->create_links();
		$datos['pagina'] = $pagina;
		$datos['textopresentacion'] = $this->sitio->st_get_informacion_simple('textooferta');
		$datos['lista_ofertas'] = $this->oferta->get_ofertas($criterio,$items_pagina,$pagina);		
		
		$datos['items'] = $this->_menu_vertical();
		$datos['item_activo'] = $tipo_oferta;
		
		$this->load->view($this->root_producto.'index',$datos);
		
	}
	public function oferta($id)
	{
		$datos = array();
		if($datos['oferta']=$this->oferta->get_oferta(array('id'=>$id)))
		{
			$datos['ofertas_relacionadas'] = $this->oferta->get_ofertas(array(),3,0);
			
			$datos['items'] = $this->_menu_vertical();
			$datos['item_activo'] = NULL;			
			$this->display($this->root_producto.'oferta',$datos);
		}
	}
	public function reservar($id)
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
		if($datos['oferta']=$this->oferta->get_oferta(array('id'=>$id)))
		{
			$datos['flash_error'] = $this->session->flashdata('flash_error');
			
			$fecha_actual = app_now();
			$fecha_actual = app_dateadd($fecha_actual,$datos['oferta']['release']);
			if($fecha_actual > $datos['oferta']['fecha_inicio'])
			{
				$datos['oferta']['fecha_inicio'] = $fecha_actual;
			}

			if ($datos['oferta']['fecha_rinicio'] === null || $fecha_actual > $datos['oferta']['fecha_rinicio'])
			{
				$datos['oferta']['fecha_rinicio'] = $fecha_actual;
			}

			$cant_dias = 9;
			if ($datos['oferta']['fecha_rfin'] != null)
			{
				$ob_fecha1 = new DateTime($datos['oferta']['fecha_rinicio']);
				$ob_fecha2 = new DateTime($datos['oferta']['fecha_rfin']);
				$intervalo = $ob_fecha1->diff($ob_fecha2);

				$cant_dias = $intervalo->format('%d');
			}

			$dias_disponibles = array();
			if (isset($datos['oferta']['dias_disponibles'])) {
				foreach($datos['oferta']['dias_disponibles'] as $d)
				{
					$dias_disponibles[] = 'day == '.($d['dia']-1);
				}
			}

			$cadena_if = implode(' || ',$dias_disponibles);
			$datos['cadena_if'] = $cadena_if;

			$datos['cant_dias'] = $cant_dias + 1;

			// parche para bodas
            $datos['boda'] = false;
			$slug = isset($datos['oferta']['tipo']['slug']) ? $datos['oferta']['tipo']['slug']: null;
			if ($slug === 'bodas-quinces-aniversarios') {
			    $datos['boda'] = true;
            }

			$this->display($this->root_producto.'reserva_01', $datos);
		}
	}
	public function crear_reserva()
	{
		if($this->input->post("btn_continuar"))
		{
			$id_oferta = $this->input->post("id_oferta");
			if($datos['oferta']=$this->oferta->get_oferta(array('id'=>$id_oferta)))
			{
				$this->load->helper(array('form'));
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('','');

				// parche para bodas
                $isBoda = $this->input->post("is_boda") == 1;
                $validador = $isBoda ? 'precio_boda' : 'precio_oferta';
                $datos['is_boda'] = $isBoda;
		
				if ($this->form_validation->run($validador) == TRUE)
				{					
					$fecha = $this->input->post("fecha");

                    if ($isBoda) {// parche para bodas
                        $cantidad = 1;
                        $cantidad_dias = 1;
                    } else {
                        $cantidad = $this->input->post("cantidad");
                        $cantidad_dias = $this->input->post("cantidad_dias");
                    }

					$precio = $this->calcular_precio($id_oferta,$fecha,$cantidad, $cantidad_dias);
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
						   'name'    => $datos['oferta']['id'],
						   'options' => array('aconfirmar'=> $this->input->post("aconfirmar")==1?1:0,						   					  
						   					  'tipo'      => $this->str_producto,
											  'id_oferta' => $id_oferta,
											  'is_boda' => $isBoda,
											  'fecha'     => $fecha,
											  'cantidad'  => $cantidad,
											  'cantidad_dias'  => $cantidad_dias,
											  'detalles'  => $this->input->post("detalles")
												)
												);

					if ($car = $this->cart->searchProduct($key_producto)) {
						$producto_reservado['rowid'] = $car['rowid'];
						$this->cart->update($producto_reservado);
					} else {
						$producto_reservado['rowid'] = $this->cart->insert($producto_reservado);
					}
					$datos['producto'] = $producto_reservado;

					$this->session->set_userdata(array('reserva_activa_'.$this->str_producto=>$key_producto));					
					$this->display($this->root_producto.'reserva_02',$datos);
				}
				else
				{
					$this->session->set_flashdata('flash_error', validation_errors());
					redirect(base_url(trans('ruta_reservar_oferta',array('id_oferta'=>$datos['oferta']['id']))));
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

			$isBoda = $this->input->post("is_boda") == 1;
			$validador = $isBoda ? 'precio_boda' : 'precio_oferta';
	
			if ($this->form_validation->run($validador) == TRUE)
			{
				$id_oferta = $this->input->post("id_oferta");
				$fecha = $this->input->post("fecha");

				if ($isBoda) {
                    $cantidad = 1;
                    $cantidad_dias = 1;
                } else {
                    $cantidad = $this->input->post("cantidad");
                    $cantidad_dias = $this->input->post("cantidad_dias");
                }

				$precio = $this->calcular_precio($id_oferta,$fecha,$cantidad, $cantidad_dias);
				if($precio)
				{
					print json_encode(array('ok'=>'t','precio'=>app_rate_cambio($precio,'smb')));
				}
				else
				{
					print json_encode(array('ok'=>'f','msg'=>trans('of_error_no_precio')));
				}
				exit();
			}
			print json_encode(array('ok'=>'f','msg'=>validation_errors()));
			exit();			
		}
	}
	private function calcular_precio($id_oferta,$fecha,$cantidad, $cantidad_dias)
	{
		// check si la fecha es una fecha válida
        $d = DateTime::createFromFormat('Y-m-d', $fecha);
        if (!$d || $d->format('Y-m-d') !== $fecha) {
            return false;
        }
        
		$precio_oferta = $this->oferta->get_precio_oferta($id_oferta,$fecha);
		if($precio_oferta && $precio_oferta['precio']>0)
		{
			$precio = $cantidad*$precio_oferta['precio']*$cantidad_dias;
			$descuento_cliente = app_descuento_tipo_cliente($this->str_producto);
			if($descuento_cliente)
			$precio = app_aplicar_descuento($precio,$descuento_cliente);
			return $precio;
		}
		return false;
	}
	private function _menu_vertical()
	{
		$tipos_ofertas = $this->oferta->get_tipos_ofertas();
		$menu_ofertas = array();
		foreach($tipos_ofertas as $to)
		{
			$nombre = app_traduccion('oferta','oferta_tipo_idioma','nombre','tipo_fk',$to['id'],$to['nombre']);
			$menu_ofertas[$to['slug']] = array('url'=>trans('ruta_ofertas_tipo',array('slug'=>$to['slug'])),
										  'titulo'=>$nombre
										  );
		}
		return $menu_ofertas;
	}
}