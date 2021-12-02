<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Con_micuenta extends APP_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->load->model('mod_micuenta', 'micuenta');		
		$this->load->helper('text');
	}
	public function index()
	{
		$datos = array('error' => '');
		$user_registrado = $this->session->userdata('usuario_registrado');
		
		if($user_registrado)
		{
			$user_registrado['pais'] = app_get_pais($user_registrado['pais_fk']);
			$datos['user_registrado'] = $user_registrado;
			$datos['items'] = $this->_menu_vertical();
			$datos['item_activo'] = 'mi-cuenta';
			$datos['titulo_activo'] = $datos['items']['mi-cuenta']['titulo'];

			if ($this->input->method() == 'post')
			{
				$id = $user_registrado['id'];

				$this->load->library('form_validation');
				$this->load->helper(array('form', 'url'));
				$this->form_validation->set_error_delimiters('','<br/>');

				if ($this->form_validation->run('upd_registro') == TRUE)
				{
					$flag = true;
					if ($this->input->post('password_edit')) {
						$this->form_validation->set_rules('password_edit', trans('contrasenna'), 'required');
						$this->form_validation->set_rules('password_edit_confir', trans('repetir_contrasenna'), 'matches[password_edit]');

						$flag = $this->form_validation->run('upd_registro');
					}

					if ($flag) {
						$upd_usuario = array('correo'=>$this->input->post('correo'),
							'nombre'=>$this->input->post('nombre'),
							'pais_fk'=>$this->input->post('pais'),
							'pasaporte'=>$this->input->post('pasaporte')
						);
						if($this->input->post('password_edit'))
						{
							$upd_usuario['password'] = md5($this->input->post('password_edit'));
						}

						if($this->micuenta->upd_registro($upd_usuario,$id))
						{
							unset($upd_usuario['password']);
							$new_datos_user = array_merge($user_registrado,$upd_usuario);

							$this->session->set_userdata(array('usuario_registrado'=>$new_datos_user));
							$this->twig->addGlobal('app', $this->getApp());

						} else {
							$datos['error'] = trans('error_inesperado');
						}
					}
				}
			}

			// B2B
			$temp = $this->micuenta->get_disponibilidad_tipo_registro($user_registrado['tipo_cliente_fk']);
			$datos['user_registrado']['disponible'] = $temp;

			$this->display('administracion/perfil',$datos);
			//$this->load->view('administracion/perfil',$datos);
		}
		else
		{
			redirect(base_url());
		}	
	}

	public function historial()
	{
		$user_registrado = $this->session->userdata('usuario_registrado');
		
		if($user_registrado)
		{
			$datos['user_registrado'] = $user_registrado;
			$datos['items'] = $this->_menu_vertical();
			$datos['item_activo'] = 'historial';
			
			$reservas = array();
			$identificadores_productos = app_productos();

			$this->load->model('mod_alojamiento','alojamiento');
			$hotel = $this->alojamiento->get_hotel();

			foreach($identificadores_productos as $identificador)
			{
				$obj_modelo_producto = $identificador.'reservacion';
				
				$this->load->model('mod_reservacion_'.$identificador, $obj_modelo_producto);
				if($pagadas = $this->$obj_modelo_producto->get_reservas_confirmadas($user_registrado['id'],4))
				{
					foreach($pagadas as &$p)
					{
						$p['options']['tipo'] = $identificador;

						$data = array('datos_adicionales' => $p['options'], 'producto' => $p, 'hotel' => $hotel);
						//$p['options']['template_historial'] = $this->load->view('productos/'.$identificador.'/template_historial',$data,true);
						$p['options']['template_historial'] = $this->twig->render('productos/'.$identificador.'/template_historial',$data);
					}
					$reservas = array_merge($reservas,$pagadas);
				}				
			}
			$datos['reservas'] = $reservas;
			//$this->load->view('administracion/historial_reservas_pagadas',$datos);
			$this->display('administracion/historial_reservas_pagadas',$datos);
		}
		else
		{
			redirect(base_url());
		}	
	}
	public function calendario_pagos()
	{
		$user_registrado = app_usuario();
		
		if($user_registrado)
		{
			$datos['user_registrado'] = $user_registrado;
			$datos['items'] = $this->_menu_vertical();
			$datos['item_activo'] = 'calendario';
			
			$this->load->model('mod_reservacion','reservacion');
			$reservas_proceso = $this->reservacion->get_reservas_con_calendario($user_registrado['id']);
			$reservas = array();
			$identificadores_productos = app_productos();

			$this->load->model('mod_alojamiento','alojamiento');
			$hotel = $this->alojamiento->get_hotel();

			foreach($reservas_proceso as $r)
			{				
				foreach($identificadores_productos as $identificador)
				{
					$obj_modelo_producto = $identificador.'reservacion';
					
					$this->load->model('mod_reservacion_'.$identificador, $obj_modelo_producto);
					if($reserva = $this->$obj_modelo_producto->get_reserva($r['id']))
					{
						$reserva['options']['tipo'] = $identificador;
						$reserva['options']['calendarios'] = $this->reservacion->get_calendario_pagos($r['id']);
						$reserva['options']['template_historial'] = $this->load->view('productos/'.$identificador.'/template_historial',array('producto'=>$reserva),true);

						$data = array('datos_adicionales' => $reserva['options'], 'producto' => $reserva, 'hotel' => $hotel);
						$reserva['options']['template_historial'] = $this->twig->render('productos/'.$identificador.'/template_historial',$data);

						$reservas[] = $reserva;
					}
				}				
			}
			$datos['reservas'] = $reservas;
			///$this->load->view('administracion/calendario_pagos',$datos);
			$this->display('administracion/calendario_pagos',$datos);
		}
		else
		{
			redirect(base_url());
		}	
	}
	private function _menu_vertical()
	{
		$menu_vertical = array();
		$menu_vertical['mi-cuenta'] = array('url'=>trans('ruta_mi_cuenta'),'titulo'=>trans('user_micuenta'));
		$menu_vertical['historial'] = array('url'=>trans('ruta_historial'),'titulo'=>trans('user_historial'));
		$menu_vertical['calendario'] = array('url'=>trans('ruta_calendario_pagos'),'titulo'=>trans('user_pagos_pendientes'));
		//$menu_vertical['historial'] = array('url'=>trans('ruta_bar',array('slug'=>$b['slug'])),'titulo'=>trans('br_bar_nombre',array('nombre'=>$b['nombre'])));
		
		
		return $menu_vertical;
	}
	
}