<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_seguridad extends APP_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('mod_seguridad', 'seguridad');
	}
	public function index()
	{
		if($this->session->userdata('usuario_registrado'))
			redirect(base_url('perfil'));
		if($this->input->is_ajax_request())
		{	
			$this->load->helper(array('form'));
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('','<br/>');
	
			if ($this->form_validation->run('login') == TRUE)
			{
				$usuario = strtolower($this->input->post("correo"));
				$contrasena = $this->input->post("password");
				if($datos = $this->seguridad->autenticar($usuario,$contrasena))
				{					
					unset($datos['password']);
					$this->session->set_userdata(array('usuario_registrado'=>$datos));
					//Cargar en el carro de compras las reservas confirmadas que estan lista para ser pagadas
					$this->_cargar_reservas();
					//FIn de la carga de reservas lista para pagar
					print json_encode(array('ok'=>'t','url'=>base_url(trans('ruta_mi_cuenta'))));
					exit();
				}
				else
				{
					print json_encode(array('ok'=>'f','msg'=>trans('error_autenticacion')));
					exit();
				}
			}
			print json_encode(array('ok'=>'f','msg'=>validation_errors()));
			exit();			
		}
	}

	private function _cargar_reservas()
	{
		$datos = $this->session->userdata('usuario_registrado');
		$identificadores_productos = app_productos();
		foreach($identificadores_productos as $identificador)
		{
			$obj_modelo_producto = $identificador.'reservacion';

			$this->load->model('mod_reservacion_'.$identificador, $obj_modelo_producto);
			$reservas_confirmadas=$this->$obj_modelo_producto->get_reservas_confirmadas($datos['id']);

			if($reservas_confirmadas!==false)
			{
				foreach($reservas_confirmadas as $reserva)
				{
					$this->str_producto = $identificador;
					$reserva['id'] = $this->generar_key_producto();
					$reserva['options']['tipo'] = $identificador;
					$this->cart->insert($reserva);
				}
			}
		}
	}

	public function loginPage($controller, $method)
	{
		$datos['error'] = '';

		if ($this->input->method() === 'post') {
			$this->load->library('form_validation');
			$this->load->helper(array('form', 'url'));

			$this->form_validation->set_error_delimiters('', '<br/>');
			if ($this->form_validation->run('login') == TRUE) {

				$usuario = strtolower($this->input->post("correo"));
				$contrasena = $this->input->post("password");
				if($datos = $this->seguridad->autenticar($usuario,$contrasena)) {
					unset($datos['password']);
					$this->session->set_userdata(array('usuario_registrado' => $datos));
					$this->twig->addGlobal('app', $this->getApp());
					$this->_cargar_reservas();

					redirect(base_url($controller.'/'.$method));
				}

				$datos['error'] = trans('error_autenticacion');
			}
		}

		//$this->load->view('administracion/page_login', $datos);

		$this->display('administracion/page_login', $datos);
	}

	public function registro()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('form_validation');
			$this->load->helper(array('form', 'url'));
			$this->form_validation->set_error_delimiters('','<br/>');
			if ($this->form_validation->run('registro') == TRUE)
			{
				// rodear un bug que impide establecer la regla: |is_unique[frontend_registrarse.correo]
				// la consulta no encuentra la tabla frontend_registrarse (parece que la busca en el schema public)
				$existe = $this->seguridad->get_usuario(array('correo' => $this->input->post('correo')));
				if ($existe) {
					print trans('usuario_registrado');
					exit();
				}


				$codigo_activacion = md5(microtime());
				$nuevo_usuario = array('correo'=>strtolower($this->input->post('correo')),
									   'password'=>$this->input->post('password'),
									   'nombre'=>$this->input->post('nombre'),									   
									   'pais_fk'=>$this->input->post('pais_fk'),
									   'pasaporte'=>$this->input->post('passport'),
									   'active_code'=>$codigo_activacion
										);
				if($this->input->post('politica'))
				{
					if($this->seguridad->insert_usuario($nuevo_usuario))
					{
						if($this->input->post('subscribirme'))
						{
							$this->load->model('mod_subscripcion', 'subscripcion');
							$this->subscripcion->add_subscriptor(array('email'=>$this->input->post('correo'),'idioma_fk'=>$this->idioma_current['id']));
						}
						$this->load->library('notificacion_email');
						$nuevo_usuario['link_activacion'] = base_url(trans('ruta_activar_cuenta',array('codigo'=>$codigo_activacion)));
						$this->notificacion_email->notificacion_usuario_creado($nuevo_usuario);
						print trans('msg_activar_cuenta');
						exit();
					}
				}
				print trans('error_inesperado');
				exit();
			}
			else
			{
				print validation_errors();
				exit();		
			}
		}
	}

	function activar_cuenta($active_code)
	{
		if ($datos = $this->seguridad->get_usuario(array('active_code' => $active_code))) {

			unset($datos['password']);
			$this->session->set_userdata(array('usuario_registrado' => $datos));
			$this->twig->addGlobal('app', $this->getApp());

			if ($datos['confirm_mail'] == 't') {
				redirect(base_url('cuenta/perfil'));
			}

			if ($this->seguridad->editar_usuario(array('id' => $datos['id'], 'confirm_mail' => 't'))) {
				$this->display('administracion/cuenta-activada', $datos);
			} else {

				redirect('error');
			}
		} else {
			redirect('error');
		}
	}

	function recuperar_contrasenna()
	{
		$datos = array();
		$this->load->helper('form');
		if($this->input->post('btn_continuar'))
		{			
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('','');
		
			if ($this->form_validation->run('recuperar_contrasenna') == TRUE)
			{
				$correo = strtolower($this->input->post('correo'));
				if($datos_usuario = $this->seguridad->get_usuario(array('correo'=>$correo)))
				{
					$this->load->library('generarpass');
		    		$datos_usuario['password'] = $this->generarpass->generar_pass();
					$this->seguridad->editar_usuario($datos_usuario);
					//$datos['flash_error'] = trans('recuperar_contrasenna_correo_enviado',array('correo'=>$correo));
					$this->load->library('notificacion_email');
					$datos_usuario['link_activacion'] = base_url(trans('ruta_activar_cuenta',array('codigo'=>$datos_usuario['active_code'])));
					$this->notificacion_email->notificacion_recuperar_contrasena($datos_usuario);

					return $this->_error(trans('recuperar_contrasenna_correo_enviado',array('correo'=>$correo)));
				}
				else
				{
					$datos['flash_error'] = trans('error_elemento_no_encontrado',array('nombre'=>$correo));
				}
			}
			else
			{
				$datos['flash_error'] = validation_errors();
			}
		}		
		//$this->load->view('administracion/recuperar_contrasenna',$datos);
		$this->display('administracion/recuperar_contrasenna',$datos);
	}
	public function cerrar()
	{
		$this->session->unset_userdata('usuario_registrado');
		$this->cart->borrar_productos_a_confirmar();
		redirect(base_url());
	}
}