<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Con_alojamiento extends APP_Controller {
	function __construct()
	{
		parent::__construct();
		$this->root_producto.='alojamiento/';
		$this->load->model('mod_alojamiento','alojamiento');
		$this->str_producto = 'alojamiento';
		$this->url_base.=trans('ruta_alojamientos');
	}
	public function index($pagina = 0,$ejecutivo = 'f')
	{
		$this->load->library('pagination');
		
		$items_pagina = $this->sitio->st_get_informacion_simple_directa('paginadoalojamientos');	
		$pagina = $pagina;
		$datos['hotel'] = $this->alojamiento->get_hotel();
		
		$config['page_query_string']=false;
		$config['base_url'] = ($ejecutivo == 't')?trans('ruta_ejecutivo'):trans('ruta_alojamientos');
		$config['total_rows'] = $this->alojamiento->get_total_habitaciones(array('hotel_fk'=>$datos['hotel']['id'],'tipo_ejecutivo'=>$ejecutivo));	
		$config['cur_page'] = $pagina;	
		$config['per_page']	= $items_pagina;
		$this->pagination->initialize($config);	
		$datos['paginacion'] = $this->pagination->create_links();
		$datos['pagina'] = $pagina;
		$datos['js_page'] = true;
		$datos['textopresentacion'] = ($ejecutivo == 't')?$this->sitio->st_get_informacion_simple('textoejecutivo'):$this->sitio->st_get_informacion_simple('textoalojamiento');
		
		$lista_alojamientos = $this->alojamiento->get_alojamientos($items_pagina,$pagina,$ejecutivo);
	
		foreach($lista_alojamientos as &$al)
		{
		   $al['tipo'] = $this->alojamiento->get_tipo_alojamiento($al['id']); 
		   $al['imagenes'] = $this->alojamiento->get_imagenes_alojamiento($al['tipo_habitacion_fk']); 	
		   $al['facilidades'] = $this->alojamiento->get_facilidades_alojamiento($al['tipo_habitacion_fk'],$this->id_hotel_current); 			  
		   $al['precio'] = app_rate_cambio($this->calcular_precio($al['tipo_habitacion_fk']),'smb');		  
		}
		$datos['lista_alojamientos'] = $lista_alojamientos;
		$datos['items'] = $this->_menu_vertical();
		$datos['item_activo'] = ($ejecutivo == 't')?'piso_ejecutivo':'habitaciones';
				
		$this->load->view($this->root_producto.'index',$datos);
	}
	public function historicas()
	{		
		$datos['textopresentacion'] = $this->sitio->st_get_informacion_simple('textohistoricas');

		$lista_historicas = $this->alojamiento->get_historicas();
		$datos['lista_hab_historicas'] = $lista_historicas;
		$datos['items'] = $this->_menu_vertical();
		$datos['item_activo'] = 'historicas';
		$this->load->view($this->root_producto.'historicas',$datos);
	}
	public function paquetes_luna_miel()
	{	
		if($datos['hotel'] = $this->alojamiento->get_hotel())
		{
			$datos['textopresentacion'] = $datos['hotel']['luna_de_miel'];
			$datos['paquetes'] = $datos['hotel']['paquetes_luna_miel'];
			$datos['items'] = $this->_menu_vertical();
			$datos['item_activo'] = 'luna_miel';
			$this->load->view($this->root_producto.'paquetes_luna_miel',$datos);
		}
	}
	public function paquete_luna_miel()
	{
		if($this->input->is_ajax_request())
		{
			$paquete = $this->alojamiento->get_paquete_luna_miel($this->input->post("id_paquete"));
			if($paquete)
				print json_encode(array('ok'=>'t','nombre'=>$paquete['nombre'],'descripcion'=>$paquete['descripcion']));
			else
				print json_encode(array('ok'=>'f'));
		}
	}
	private function _menu_vertical()
	{
		$menu_alojamiento = array();
		$menu_alojamiento['habitaciones']   = array('url'   =>base_url(trans('ruta_alojamientos')),
												  'titulo'=>trans('al_habitaciones'));
		$menu_alojamiento['piso_ejecutivo'] = array('url'   =>base_url(trans('ruta_ejecutivo')),
													'titulo'=>trans('al_habitaciones_ejecutivas'));
		$menu_alojamiento['historicas'] = array('url'   =>base_url(trans('ruta_historicas')),
													'titulo'=>trans('al_habitaciones_historicas'));
		$menu_alojamiento['luna_miel'] = array('url'   =>base_url(trans('ruta_paquetes_luna_miel')),
													'titulo'=>trans('al_paquetes_luna_miel'));
		return $menu_alojamiento;
	}
	public function reservar($tipo_habitacion  = NULL)
	{
		$datos = array();

		if ($this->input->post("tipo_habitacion")) {
			$tipo_habitacion = $this->input->post("tipo_habitacion");
		} elseif($tipo_habitacion == null) {
			$ses = $this->cart->get_item($this->session->userdata('reserva_activa_' . $this->str_producto));
			$tipo_habitacion = $ses['options']['habitaciones'][0]['tipo_habitacion'];
		}

        $facilidades = $this->alojamiento->get_facilidades_alojamiento($tipo_habitacion, $this->id_hotel_current);
		$datos['facilidades'] = $facilidades;

		if($datos['hotel'] = $this->alojamiento->get_hotel(array('disponible_para_la_venta'=>'t')))
		{
			$this->load->model('sitio');
			$max_habitacion_reserva = $this->sitio->st_get_informacion_simple_directa('max_habitacion_reserva');
			$max_noches_reserva = $this->sitio->st_get_informacion_simple_directa('max_noches_reserva');

			$datos['max_habitacion_reserva'] = $max_habitacion_reserva;

			if ($tipo_habitacion == null) {
				redirect(base_url(trans('ruta_alojamientos')));
			}

			if ($this->input->post("fecha"))
			{
				$pre_fecha = $this->input->post("fecha");
				if ($pre_fecha < $datos['hotel']['fecha_minima']) {
					$pre_fecha = $datos['hotel']['fecha_minima'];
				}
			} elseif (isset($ses['options']['fecha'])) {
				$pre_fecha = $ses['options']['fecha'];
			} else {
				$pre_fecha = $datos['hotel']['fecha_minima'];
			}

			$tmp_fecha1 = $datos['hotel']['fecha_maxima'];
			$tmp_fecha2 = $datos['hotel']['fecha_minima'];
			$this->alojamiento->modifica_paros($datos, $tipo_habitacion, $pre_fecha);
			$datos['hotel']['fecha_maxima'] = $tmp_fecha1;
			$datos['hotel']['fecha_minima'] = $tmp_fecha2;

			$temp_max_noches = $this->alojamiento->get_max_cant_max_noches($pre_fecha, $tipo_habitacion);
			$datos['cant_max_noches'] = $temp_max_noches > $max_noches_reserva ? $max_noches_reserva : $temp_max_noches;

			$datos['info'] = $this->alojamiento->get_reserva_info($pre_fecha);

			$ckecking = $this->session->userdata('reserva_activa_' . $this->str_producto);
			$reserva = $this->cart->get_item($ckecking);

			if($ckecking = $this->session->userdata('reserva_activa_'.$this->str_producto))
			{
				if($reserva)
				{
					$plan = $reserva['options']['habitaciones'][0]['plan'];

					$nuevos_paxs = app_convert_paxs($this->alojamiento->get_pax_habitacion($tipo_habitacion, $plan, $pre_fecha));
					$datos['hotel']['nuevos_paxs'] = $nuevos_paxs;
					$pre_paxs = $reserva['options']['habitaciones'][0]['paxs'];

					$datos['key_car_reserva'] = $ckecking;			
					$datos['reserva'] = $reserva;
				}
			}
			else
			{
				if($this->input->post("noches"))
					$pre_noches = $this->input->post("noches");
				else
					$pre_noches = $datos['hotel']['minimo_de_noches']?$datos['hotel']['minimo_de_noches']:1;				
				if($this->input->post("cantidad_habitaciones"))
					$pre_cantidad_habitaciones = $this->input->post("cantidad_habitaciones");
				else
					$pre_cantidad_habitaciones = 1;
				if($this->input->post("tipo_habitacion"))
					$pre_tipo_habitacion = $this->input->post("tipo_habitacion");
				else
					$pre_tipo_habitacion = $tipo_habitacion?$tipo_habitacion:$datos['hotel']['habitaciones_reserva'][0]['tipo_habitacion_fk'];

				$pre_plan = $datos['hotel']['plan_alojamiento'][0]['plan_fk'];

				$nuevos_paxs = app_convert_paxs($this->alojamiento->get_pax_habitacion($tipo_habitacion, $pre_plan, $pre_fecha));
				$datos['hotel']['nuevos_paxs'] = $nuevos_paxs;
				$pre_paxs = isset($nuevos_paxs[0]['val']) ? $nuevos_paxs[0]['val']:0;

				$_planes_ = $datos['hotel']['plan_alojamiento'];
				foreach ($_planes_ as $__plan) {
					$resultado = $this->calcular_precio_datos($pre_tipo_habitacion,$pre_fecha,$pre_noches,$__plan['plan_fk'],$pre_paxs,NULL,NULL);
					if($resultado['ok'] == 't')
					{
						$pre_plan = $__plan['plan_fk'];
						break;
					}
				}

				$pre_habitaciones = array();
				$pre_costo_total = 0;
				$precio_original = 0;
				for($i=0;$i<$pre_cantidad_habitaciones;$i++)
				{
					$resultado = $this->calcular_precio_datos($pre_tipo_habitacion,$pre_fecha,$pre_noches,$pre_plan,$pre_paxs,NULL,NULL);
					if($resultado['ok'] == 't')
					{
						$pre_costo_total = $resultado['precio'];
						$precio_original = $resultado['precio_original'];
						$pre_habitaciones[] = array('tipo_habitacion'     => $pre_tipo_habitacion,
													'fecha'               => $pre_fecha,
													'hora'                => $datos['hotel']['horario_check_in'],
													'noches'              => $pre_noches,
													'plan'                => $pre_plan,
													'paxs'                => $pre_paxs,
													'ninno_adicional'     => '',
													'paquete_luna_miel'   => '',
													'precio'              => $resultado['precio'],
													'precio_original'     => $resultado['precio_original'],
													'detalles_reservacion'=> $resultado
													);
					}
					else
					{
						$this->_error($resultado['msg']);
						return 0;
					}
				}
				$pre_reserva = array(	'price'  => $pre_costo_total,
										'precio_original' => $precio_original,
										'name'   => $datos['hotel']['id'],
										'options'=> array('tipo'        => $this->str_producto,
														  'detalles'    => '',
														  'habitaciones'=> $pre_habitaciones
														 )										
									);
				$datos['reserva'] = $pre_reserva;
			}

			$datos['flash_error'] = $this->session->flashdata('flash_error');


			//para el JS
			$js = '';
			foreach($datos['hotel']['habitaciones_reserva'] as $h)
			{
				$js .=  'capacidades_maximas['.$h['tipo_habitacion_fk'].']=new hab_capacidad('.$h['tipo_habitacion_fk'].','.$h['cantidad_pax'].',"'.$h['ninno_adicional'].'");'.PHP_EOL;
			}
			$datos['js'] = $js;

			$paros_venta = $datos['hotel']['paros_venta'];
			foreach($paros_venta as $paro)
			{
				$text_paro="['".date("Y/m/d",strtotime($paro['fecha_inicio']))."','".date("Y/m/d",strtotime($paro['fecha_fin']))."']";
				$paros_jscript[]=$text_paro;
			}
			$paros_tjscript="";
			if(sizeof($paros_venta)>0)
				$paros_tjscript=implode(',',$paros_jscript);

			$closedDates = 'var closedDates = ['.$paros_tjscript.'];';
			$datos['closedDates'] = $closedDates;

			foreach($datos['reserva']['options']['habitaciones'] as $pre_habitacion) {
				$datos['pre_habitacion'] = $pre_habitacion;
			}


			// hora
			$hora_inicio = (int)$datos['hotel']['horario_check_in'];
			$horas = array();$hora_selected = '';
			for($i=$hora_inicio;$i<24;$i++)
			{
				$hora_i = date('H:i',strtotime("$i:00"));
				if($datos['pre_habitacion']['hora'] == $hora_i)
					$hora_selected = $hora_i;

				$horas[] = $hora_i;
			}
			$datos['horas'] = $horas;
			$datos['hora_selected'] = $hora_selected;

			//$this->load->view($this->root_producto.'reserva_01',$datos);

			$this->display('productos/alojamiento/reserva_01', $datos);
		}
	}
	public function crear_reserva()
	{
		if($this->input->post("btn_continuar"))
		{
			if($datos['hotel'] = $this->alojamiento->get_hotel(array('disponible_para_la_venta'=>'t')))
			{
				$this->load->helper(array('form'));
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('','');
		
				if ($this->form_validation->run('precio_habitaciones') == TRUE)
				{		
					$habitaciones = array();
					$total_habitaciones = 0;
					$tipo_habitacion = $this->input->post('tipo_habitacion');
					$fecha = $this->input->post('fecha');

					foreach($this->input->post('hora') as $key=>$hora)
					{
						$total_habitaciones++;
						$habitaciones[$key]['hora'] = $hora;
						$habitaciones[$key]['tipo_habitacion'] = $tipo_habitacion;
						$habitaciones[$key]['fecha'] = $fecha;
					}
					foreach($this->input->post('noches') as $key=>$noches)
					{
						$habitaciones[$key]['noches'] = $noches;
					}
					foreach($this->input->post('plan') as $key=>$plan)
					{
						$habitaciones[$key]['plan'] = $plan;
					}
					foreach($this->input->post('paxs') as $key=>$paxs)
					{
						$habitaciones[$key]['paxs'] = $paxs;
					}
					for($i=0;$i<$total_habitaciones;$i++)
					{
						$habitaciones[$i]['ninno_adicional'] = $this->input->post('ninno_adicional_'.$i);
					}
					foreach($this->input->post('paquete_luna_miel') as $key=>$paquete_luna_miel)
					{
						$habitaciones[$key]['paquete_luna_miel'] = $paquete_luna_miel==''?NULL:$paquete_luna_miel;
					}
					$precio_total = 0;
					
					foreach($habitaciones as $key=> &$h)
					{
						if (!isset($h['noches'])) {
							unset($habitaciones[$key]);
							continue;
						}
						$resultado = $this->calcular_precio_datos($tipo_habitacion,$fecha,$h['noches'],$h['plan'],$h['paxs'],$h['ninno_adicional'],$h['paquete_luna_miel']);
						if($resultado['ok'] == 't')
						{
							$precio_total += $resultado['precio'];
							$h['precio'] = $resultado['precio'];
							$h['detalles_reservacion'] = $resultado;
						}
						else
						{
							$this->session->set_flashdata('flash_error',$resultado['msg']);
							redirect(base_url(trans('ruta_reservar_alojamiento')));
						}
					}
					$nuevos_paxs = app_convert_paxs($this->alojamiento->get_pax_habitacion($tipo_habitacion, $plan, $fecha));
					$datos['nuevos_paxs'] = $nuevos_paxs;

					$datos['precio_total'] = $precio_total;
					$datos['habitaciones'] = $habitaciones;
					$ckecking = $this->session->userdata('reserva_activa_'.$this->str_producto);

					$key_car = $this->input->post('key_car_reserva');

					if ($key_car) {
						$car = $this->cart->get_item($key_car);
						$key_producto = $car['id'];
					} elseif ($ckecking) {
						$key_producto = $ckecking;
					} else {
						$key_producto = $this->generar_key_producto();
					}

					$producto_reservado = array(	  
						   'id'      => $key_producto,
						   'qty'     => 1,
						   'price'   => $precio_total,
						   'name'    => $datos['hotel']['id'],
						   'options' => array('aconfirmar'    => $this->input->post("aconfirmar")==1?1:0,						   					  
						   					  'tipo'          => $this->str_producto,
											  'id_hotel'      => $datos['hotel']['id'],
											  'fecha'         => $fecha,
											  'detalles'      => $this->input->post("detalles"),
											  'habitaciones'  => $habitaciones
												)
												);

					if ($car = $this->cart->searchProduct($key_producto)) {
						$producto_reservado['rowid'] = $car['rowid'];
						$this->cart->update($producto_reservado);
					} else {
						$producto_reservado['rowid'] = $this->cart->insert($producto_reservado);
					}



					$this->session->set_userdata(array('reserva_activa_'.$this->str_producto=>$key_producto));

					$datos['producto'] = $producto_reservado;
					//$this->load->view($this->root_producto.'reserva_02',$datos);
					$this->display('productos/alojamiento/reserva_02', $datos);
					
				}
				else
				{
					$this->session->set_flashdata('flash_error', validation_errors());
					redirect(base_url(trans('ruta_reservar_alojamiento')));
				}
			}
			else
			redirect(base_url('error'));
		}
		elseif($this->input->post("btn_cancelar"))
		{
			if($key_producto = $this->input->post('key_car_reserva'))
				$this->cart->remove($key_producto);
			app_clear_reservas_activas();
			$this->go();
		}
	}
	public function calcular()
	{
		if ($this->input->is_ajax_request())
		{
			$this->load->helper(array('form'));
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', '');

			if ($this->form_validation->run('precio_habitacion') == TRUE)
			{
				$tipo_habitacion = $this->input->post("tipo_habitacion");
				$fecha = $this->input->post("fecha");
				$noches = $this->input->post("noches");
				$plan = $this->input->post("plan");
				$paxs = $this->input->post("paxs");
				$ninno_adicional = $this->input->post("ninno_adicional");
				$paquete_luna_miel = $this->input->post("paquete_luna_miel");

				$resultado = $this->calcular_precio_datos($tipo_habitacion, $fecha, $noches, $plan, $paxs, $ninno_adicional, $paquete_luna_miel);

				$this->load->model('sitio');
				$max_noches_reserva = $this->sitio->st_get_informacion_simple_directa('max_noches_reserva');

				$cant_max_noches = $this->alojamiento->get_max_cant_max_noches($fecha, $tipo_habitacion);
				$resultado['cant_max_noches'] = $cant_max_noches > $max_noches_reserva ? $max_noches_reserva : $cant_max_noches;
				$resultado['noches'] = $noches;

				print json_encode($resultado);
				exit();
			}
			print json_encode(array('ok' => 'f', 'msg' => validation_errors(), 'precio' => 0));
			exit();
		}
	}
	private function calcular_precio_datos($tipo_habitacion,$fecha,$noches,$plan,$paxs,$ninno_adicional,$paquete_luna_miel)
	{
		if($datos['hotel'] = $this->alojamiento->get_hotel(array('disponible_para_la_venta'=>'t')))
		{
			$costo_total = 0;
			$resultado =  $this->alojamiento->get_precio_habitacion($tipo_habitacion,$fecha,$noches,$plan,$paxs,$ninno_adicional,$paquete_luna_miel);
			if($resultado['ok'] == 't')
			{
				$precio_convertido = app_rate_cambio($resultado['precio']);
				$resultado['precio_convertido'] = $precio_convertido['precio'];
				$resultado['smb_moneda'] = $precio_convertido['simbolo'];
				return $resultado;
			}
			else
			{
				$resultado['msg'] = trans($resultado['msg']);
				return $resultado;
			}
				
		}
		return false;
	}
	private function calcular_precio($id_tipo)
	{
		$precio_alojamiento = $this->alojamiento->get_precio_alojamiento($id_tipo);
		if ($precio_alojamiento && $precio_alojamiento['precio_adulto'] > 0) {
			$precio = $precio_alojamiento['precio_adulto'];

			// VIP, AGENTE,...
			$descuento_cliente = app_descuento_tipo_cliente($this->str_producto);
			if ($descuento_cliente)
				$precio = app_aplicar_descuento($precio, $descuento_cliente);

			// B2B
			list($descuento_producto, $pre, $post) = app_descuento_tipo_producto('Hotel');
			if ($descuento_producto) {
				$precio -= $pre;
				$precio = app_aplicar_descuento($precio, $descuento_producto);
				$precio += $post;
			}

			return $precio;
		}
		return false;
	}

	public function get_paros()
	{
		if ($this->input->is_ajax_request())
		{
			$tipo_habitacion = (int)$this->input->post("tipo_habitacion");
			if ($tipo_habitacion > 0) {
				$fecha = $this->input->post("fecha");

				$datos['hotel'] = $this->alojamiento->get_hotel_reducido();
				if (!$fecha) {
					$fecha = $datos['hotel']['fecha_minima'];
				}

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

				print json_encode(array('ok' => 't', 'fecha' => $fecha,
					'habitaciones' => $cant_habitaciones, 'noches_min' => ($min_noches == 0 ? 1: $min_noches),
					'min_active_day' => $datos['hotel']['min_active_day'],
					'noches_max' => $cant_max_noches, 'paros' => $_p,
					'info' => $info
				));
				exit();
			}

		}

		print json_encode(array('ok' => 'f', 'msg' => trans('al_error_no_politica')));
		exit();
	}

	public function get_dispo()
	{
		if ($this->input->is_ajax_request())
		{
			$tipo_habitacion = (int)$this->input->post("tipo_habitacion");
			if ($tipo_habitacion > 0) {
				$fecha = $this->input->post("fecha");
				$cantidad_habitaciones = $this->input->post("cant_habitaciones");

				$this->load->model('sitio');
				$max_noches_reserva = $this->sitio->st_get_informacion_simple_directa('max_noches_reserva');

				$cant_max_noches   = $this->alojamiento->get_max_cant_max_noches($fecha, $tipo_habitacion);
				$cant_max_noches = $cant_max_noches > $max_noches_reserva ? $max_noches_reserva : $cant_max_noches;

				$cant_habitaciones = $this->alojamiento->get_cant_hab_disp($tipo_habitacion, $fecha);

				// nueva funcionalidad
				$info = $this->alojamiento->get_reserva_info($fecha);

				print json_encode(array('ok' => 't',
					'habitaciones' => $cant_habitaciones,
					'cantidad_habitaciones' => $cantidad_habitaciones ? $cantidad_habitaciones : 1,
					'noches_max' => $cant_max_noches,
					'noches_min' => 1,
					'info' => $info
				));
				exit();
			}

		}

		print json_encode(array('ok' => 'f', 'msg' => trans('al_error_no_politica')));
		exit();
	}

	public function get_paxs()
	{
		if ($this->input->is_ajax_request())
		{
			$tipo_habitacion = $this->input->post("tipo_habitacion");
			$fecha = $this->input->post("fecha");
			$plan = $this->input->post("plan");
			$paxs = $this->input->post("paxs");

			$nuevos_paxs = app_convert_paxs($this->alojamiento->get_pax_habitacion($tipo_habitacion, $plan, $fecha));

			print json_encode(array('ok' => 't',
				'n_paxs' => $nuevos_paxs,
				'paxs' => $paxs
			));
			exit();
		}

		print json_encode(array('ok' => 'f', 'msg' => validation_errors()));
		exit();
	}
}