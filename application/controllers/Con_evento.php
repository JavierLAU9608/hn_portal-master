<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_evento extends APP_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->root_producto.='evento/';
		$this->load->model('mod_evento','evento');
		$this->str_producto = 'evento';
		$this->url_base.=trans('ruta_eventos');
	}
	public function index($id_tipo_servicio = NULL)
	{
		$this->load->helper('text');

		extract($_POST);
		if(isset($date_in_event))
		{
			$this->load->library('form_validation');
			$this->load->helper(array('form', 'url'));
			$this->form_validation->set_error_delimiters('','<br/>');
			if ($this->form_validation->run('programar_evento') == TRUE)
			{
			//$evento = array('fecha_inicio'=>$date_in_event,'fecha_fin'=>$date_out_event,'tipo_evento'=>$tipo_evento,'name_tipo_evento'=>$this->evento->get_name_tipo_menu($tipo_evento),'no_participantes'=>$no_participantes);
			$options_evento = array('fecha'=>$date_in_event,
									'fecha_fin'=>$date_out_event,
									'tipo_evento'=>$tipo_evento,
									'name_tipo_evento'=>$this->evento->get_name_tipo_menu($tipo_evento),
									'no_participantes'=>$no_participantes,
									'dias_ev'=>array(),
									);
			//$_SESSION['datos_evento']['options']['inicio_evento'] = $evento;
			$_SESSION['datos_evento']['options'] = $options_evento;
			}
			else
			{
				$datos['flash_campos'] = $_POST;
			    $datos['flash_error'] = validation_errors();
			}
		}

		$datos['textopresentacion'] = $this->sitio->st_get_informacion_simple('textoevento');
		$datos['tipo_menu'] = $this->evento->get_tipo_menu();

		$tipo_servicios = $this->evento->get_tipo_servicios();
		$id_tipo_evento_creado = (isset($_SESSION['datos_evento']['options']['tipo_evento']))?$_SESSION['datos_evento']['options']['tipo_evento']:NULL;
		$tipos_servicios_reales = array();
		foreach($tipo_servicios as $key=>$tipo)
		{
			$servicios_reales = $this->evento->get_servicios($tipo['id'],$id_tipo_evento_creado);
			if(sizeof($servicios_reales)>0)
			{
			$tipo['active'] = ( $id_tipo_servicio!=NULL && $id_tipo_servicio == $tipo['id'] )?'active':'';
			$arr_id_tipos[] = $tipo['id'];
			$tipos_servicios_reales[$key] = $tipo;
			}
		}
		$tipo_servicios = $tipos_servicios_reales;
		$datos['tipo_servicios'] = $tipo_servicios;

		$datos['imagenes_salas'] = $this->evento->get_imagenes_salas_eventos();

		$datos['inicio'] = ($id_tipo_servicio == NULL)?true:false;
		$datos['programacion_ev'] = (isset($_SESSION['datos_evento']['options']))?$_SESSION['datos_evento']['options']:'';
		$datos['id_tipo_servicio'] = $id_tipo_servicio;
		$prog_dias_ev = (isset($_SESSION['datos_evento']['options']['dias_ev']))?$_SESSION['datos_evento']['options']['dias_ev']:array();
		$datos['prog_dias_ev'] = $prog_dias_ev;

		if($id_tipo_servicio == NULL)
		{
			$sig_atras["atras"] = 'disable';
			$sig_atras["sig"] = (isset($arr_id_tipos[0]))?$arr_id_tipos[0]:'disable';
		}
		for($i = 0 ; $i < sizeof($arr_id_tipos) ; $i++)
		{
			if($id_tipo_servicio == $arr_id_tipos[$i])
			{
				$sig_atras["atras"] = (isset($arr_id_tipos[$i-1]))?$arr_id_tipos[$i-1]:'';
				$sig_atras["sig"] = (isset($arr_id_tipos[$i+1]))?$arr_id_tipos[$i+1]:((sizeof($prog_dias_ev)>0)?'reserva':'disable');
				//$sig_atras["sig"] = (isset($arr_id_tipos[$i+1]))?$arr_id_tipos[$i+1]:'reserva';
				break;
			}
		}
		$datos['sig_atras'] = $sig_atras;

		if($id_tipo_servicio != NULL)
		{
			$id_tipo_menu = (isset($_SESSION['datos_evento']['options']['tipo_evento']))?$_SESSION['datos_evento']['options']['tipo_evento']:NULL;
			$tipo_servicio_evento = $this->evento->get_tipo_servicio($id_tipo_servicio);
			$servicios_x_tipo = $this->evento->get_servicios($id_tipo_servicio,$id_tipo_menu);

			foreach($servicios_x_tipo as &$servicio)
			{
				$servicio['imagenes'] = $this->evento->get_imagenes_servicio($servicio['id']);

				/*if( $id_tipo_servicio == $this->evento->id_tipo_servicio_sala )
				{	$servicio['imagenes'] = $this->evento->get_imagenes_salas_eventos($servicio['id']); $datos['estoy_en_sala'] = true;  }
				*/
				$servicio['precio'] = app_rate_cambio($this->verifica_cliente($servicio['precio']),'smb');
			}
			$datos['tipo_servicio_evento'] = $tipo_servicio_evento;
			$datos['servicios_x_tipo'] = $servicios_x_tipo;
		}

		$datos['precio_total'] = app_rate_cambio($this->_get_precio_total_evento(),'smb');
		$this->load->view($this->root_producto.'index',$datos);
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
	public function cancelar_evento()
	{
		unset($_SESSION['datos_evento']);
		$this->go();
		redirect(base_url(trans('ruta_eventos')));
	}
	public function incluir_servicio($id_tipo_servicio = NULL)
	{
		extract($_POST);
		$precio_total_servicio = 0;
		$dias_creados = array();
		if(!isset($dia_ev))
		{
			$dia_ev = array();
		}
		foreach($_SESSION['datos_evento']['options']['dias_ev'] as $keyday=>$d)
		{
				if(!in_array($keyday,$dia_ev))
				{
					unset($_SESSION['datos_evento']['options']['dias_ev'][$keyday][$id_tipo_servicio][$id_servicio]);
				}
		}
		foreach($dia_ev as $dia)
		{
			$cant_servicio = $cantidad_ev[$dia-1];
			$detalle = $detalle_adicional[$dia-1];
			$tipo_servicio = $this->evento->get_tipo_servicio($id_tipo_servicio);
			$servicio = $this->evento->get_servicio($id_servicio);
			$precio = $cant_servicio*$servicio['precio'];
			$precio_total_servicio+=$precio;

			$_SESSION['datos_evento']['options']['dias_ev'][$dia][$id_tipo_servicio][$id_servicio] = array("nomb_serv"=>$servicio['nombre'],"tipo_serv_nomb"=>$tipo_servicio['nombre'],"cant_serv"=>$cant_servicio,"detalle_adicional"=>$detalle,"precio"=>$precio);
		}
		//redirect(base_url(trans('ruta_eventos').'/'.$id_tipo_servicio));
		$precio_base_total = $this->_get_precio_total_evento();
		$precio_total = app_rate_cambio($precio_base_total,'smb');
		print json_encode(array('ok'=>'t','precio'=>app_rate_cambio($precio_total_servicio,'smb'),'precio_total'=>$precio_total,'precio_base_total'=>$precio_base_total,'msg'=>trans('ev_servicio_incorporado')));
	}
	public function del_servicio($dia_event,$id_tipo_serv,$id_servicio,$id_tipo_servicio = NULL)
	{

		unset($_SESSION['datos_evento']['options']['dias_ev'][$dia_event][$id_tipo_serv][$id_servicio]);

		if($id_tipo_servicio == NULL)
			redirect(base_url(trans('ruta_eventos')));
		elseif($id_tipo_servicio == 'reserva')
			redirect(base_url(trans('ruta_reservar_evento')));
		else
			redirect(base_url(trans('ruta_eventos').'/'.$id_tipo_servicio));
	}
	public function reservar()
	{
		if(isset($_SESSION['datos_evento']['options']))
		{
			$prog_ev = $_SESSION['datos_evento'];
		  /* $prog_ev['options']['fecha'] = $_SESSION['datos_evento']['options']['inicio_evento']['fecha_inicio'];
		   $prog_ev['options']['fecha_fin'] = $_SESSION['datos_evento']['options']['inicio_evento']['fecha_fin'];
		   $prog_ev['options']['tipo_evento'] = $_SESSION['datos_evento']['options']['inicio_evento']['tipo_evento'];
		   $prog_ev['options']['name_tipo_evento'] = $_SESSION['datos_evento']['options']['inicio_evento']['name_tipo_evento'];
		   $prog_ev['options']['no_participantes'] = $_SESSION['datos_evento']['options']['inicio_evento']['no_participantes'];*/

		   $datos['programacion_ev'] = $prog_ev;
		}
		elseif($ckecking = $this->session->userdata('reserva_activa_'.$this->str_producto))
		{
				if($reserva = $this->cart->searchProduct($ckecking))
				{
					$datos['key_car_reserva'] = $ckecking;
					$datos['programacion_ev'] = $reserva;

					$_SESSION['datos_evento'] = $reserva;
					$prog_ev = $reserva;
					//--- recargando la session porque dieron click en anterior y la habia reseteado
					/*$_SESSION['datos_evento']['inicio_evento']['fecha_inicio'] = $reserva['options']['fecha'];
		  			$_SESSION['datos_evento']['inicio_evento']['fecha_fin'] = $reserva['options']['fecha_fin'];
		            $_SESSION['datos_evento']['inicio_evento']['tipo_evento'] = $reserva['options']['tipo_evento'];
		            $_SESSION['datos_evento']['inicio_evento']['name_tipo_evento'] = $reserva['options']['name_tipo_evento'];
		            $_SESSION['datos_evento']['inicio_evento']['no_participantes'] = $reserva['options']['no_participantes'];*/
				}
		}
		if($this->session->flashdata('flash_error'))
		{
			$datos['datos_enviados'] = $this->session->flashdata('flash_datos');
			$datos['flash_error'] = $this->session->flashdata('flash_error');
		}

			$prog_dias_ev = (isset($prog_ev['options']['dias_ev']))?$prog_ev['options']['dias_ev']:array();
			$datos['prog_dias_ev'] = $prog_dias_ev;

			$tipo_servicios = $this->evento->get_tipo_servicios();
				foreach($tipo_servicios as $key=>$tipo)
				{
					$servicios_reales = $this->evento->get_servicios($tipo['id'],$prog_ev['options']['tipo_evento']);
					if(sizeof($servicios_reales)>0)
					{
						$tipos_servicios_reales[$key] = $tipo;
					}
				}
				$tipo_servicios = $tipos_servicios_reales;
			$datos['tipo_servicios'] = $tipo_servicios;
			$datos['tipo_menu'] = $this->evento->get_tipo_menu();
			$datos['precio_total'] = $this->_get_precio_total_evento();

		    $this->load->view($this->root_producto.'reserva01',$datos);

	}
	public function crear_reserva()
	{
	   if($this->input->post("btn_continuar"))
		{
			$this->load->helper(array('form'));
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<br />','');
			if ($this->form_validation->run('precio_evento') == TRUE)
			{
				extract($_POST);

			   //los servicios por dias , cantidad y precio , ya multiplicado ....
			   $prog_dias_ev = (isset($_SESSION['datos_evento']['options']['dias_ev']))?$_SESSION['datos_evento']['options']['dias_ev']:array();
				$datos_general_evento = $_SESSION['datos_evento']['options'];
			  //los dias del evento ....
			   $dias_evento = app_dias_restar_dates($date_out_event,$date_in_event) +1;

				$ckecking = $this->session->userdata('reserva_activa_'.$this->str_producto);
				if($this->input->post('key_car_reserva'))
					$key_producto = $this->input->post('key_car_reserva');
				elseif($ckecking)
					$key_producto=$ckecking;
				else
					$key_producto = $this->generar_key_producto();
				//guardo en nueva sesion pa el carrito ..
				$producto_reservado = array(
					   'id'      => $key_producto,
					   'qty'     => 1,
					   'price'   => $this->_get_precio_total_evento(),
					   'name'    => 'evento',
					   'options' => array('aconfirmar'        => 1,
					   					  'fecha'             => $datos_general_evento['fecha'],
					  					  'fecha_fin'         => $datos_general_evento['fecha_fin'],
					 					  'tipo_evento'       => $datos_general_evento['tipo_evento'],
										  'name_tipo_evento'  => $datos_general_evento['name_tipo_evento'],
					   					  'no_participantes'  => $datos_general_evento['no_participantes'],
										  'nombre'            => $nombre,
										  'tipo' => $this->str_producto,
										  'tipo_evento' => $datos_general_evento['tipo_evento'],
										  'telefono' => $telefono,
										  'presentacion' => $presentacion,
										  'nombre_completo' => $nombre_completo,
										  'ciudad' => $ciudad,
										  'pais' => $pais,
										  'nombre_empresa' => $nombre_empresa,
										  'descripcion' => $descripcion,
										  'cargo' => $cargo,
										  'email'=> $email,
										  'sitio_web'    => $sitio_web,
										  'dias_ev' => $prog_dias_ev
											)
											);



				if ($car = $this->cart->searchProduct($key_producto)) {
					$producto_reservado['rowid'] = $car['rowid'];
					$this->cart->update($producto_reservado);
				} else {
					$producto_reservado['rowid'] = $this->cart->insert($producto_reservado);
				}

				$this->session->set_userdata(array('reserva_activa_'.$this->str_producto=>$key_producto));
				//unset($_SESSION['datos_evento']);

				$datos['programacion_ev'] = $producto_reservado;
				$tipo_servicios = $this->evento->get_tipo_servicios();
				$tipo_servicios = $this->evento->get_tipo_servicios();
				foreach($tipo_servicios as $key=>$tipo)
				{
					$servicios_reales = $this->evento->get_servicios($tipo['id'],$producto_reservado['options']['tipo_evento']);
					if(sizeof($servicios_reales)>0)
					{
						$tipos_servicios_reales[$key] = $tipo;
					}
				}
				$tipo_servicios = $tipos_servicios_reales;
		        $datos['tipo_servicios'] = $tipo_servicios;
	        	$datos['tipo_menu'] = $this->evento->get_tipo_menu();
				$datos['prog_dias_ev'] = $prog_dias_ev;
				$datos['total_price'] = $producto_reservado['price'];
				//limpio la session anterior con los datos de inicio y los dias y servicios
				$_SESSION['datos_evento'] = array();
				$this->load->view($this->root_producto.'reserva02',$datos);
			}
			else
			{
				$this->session->set_flashdata('flash_error', validation_errors());
				$this->session->set_flashdata('flash_datos', $_POST);
				redirect(base_url(trans('ruta_reservar_evento')));
			}

		}
		elseif($this->input->post("btn_cancelar"))
		{
			unset($_SESSION['datos_evento']);
			if($key_producto = $this->input->post('key_car_reserva'))
				$this->cart->remove($key_producto);
			$this->go();
		}
	}
	private function _get_precio_total_evento()
	{
		$total = 0;
		if(isset($_SESSION['datos_evento']['options']['dias_ev']))
		{
			$dias_evento = $_SESSION['datos_evento']['options']['dias_ev'];

			foreach($dias_evento as $d)
			{
				foreach($d as $id_tipo_servicio=>$tipo_servicio)
				{
					foreach($tipo_servicio as $id_servicio=>$servicio)
					{
						$total += $servicio['precio'];
					}
				}
			}
		}
		return $total;
	}
    public function get_servicio($id){
        //$this->_error_no_existe();
        $tipo_servicio = $this->evento->get_tipo_servicio($id);
        if($tipo_servicio)
        {
            $datos['tipo_servicio'] =	$tipo_servicio;
            $this->display($this->root_producto.'tipo_servicio',$datos);
        }
        else
            $this->_error_no_existe();

    }

}