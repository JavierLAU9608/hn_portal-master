<?php
function head($opciones = array())
{
	$default = array('css_page'=>true,'js_page'=>true);
	$opciones = combinar_opciones($default,$opciones);
	$controller = & get_instance();
	$controller->load->view('diseno/head',$opciones);
}
function top($opciones = array())
{
	$default = array('barra_superior'=>true,'menu'=>true,'filtro'=>true);
	$opciones = combinar_opciones($default,$opciones);

	if($opciones['menu']) menu();
}
function menu($opciones = array())
{
	$controller = & get_instance();
	$controller->load->model('mod_alojamiento', 'alojamiento');

	$opciones['datos_usuario'] = app_usuario();
	$opciones['redes_sociales'] = app_redes_sociales();

	$lista_alojamientos = $controller->alojamiento->get_alojamientos(NULL, NULL, 'f');
	foreach ($lista_alojamientos as &$al) {
		$al['tipo'] = $controller->alojamiento->get_tipo_alojamiento($al['id']);

		$precio = 0;
		$precio_alojamiento = $controller->alojamiento->get_precio_alojamiento($al['tipo_habitacion_fk']);
		if($precio_alojamiento && $precio_alojamiento['precio_adulto']>0)
		{
			$precio = $precio_alojamiento['precio_adulto'];
			$descuento_cliente = app_descuento_tipo_cliente('');
			if($descuento_cliente)
				$precio = app_aplicar_descuento($precio,$descuento_cliente);
		}

		$al['precio'] = app_rate_cambio($precio,'smb');
	}
	$opciones['default_room'] = $lista_alojamientos[0];

	$opciones['idiomas_sistema'] = app_idiomas();
	$opciones['monedas_sistema'] = app_monedas();

	$controller->load->view('diseno/menu', $opciones);
}

function slide($opciones = array())
{
	$controller = & get_instance();
	$controller->load->view('diseno/slider_principal',$opciones);
}

function modulos($opciones = array())
{
	
}
function footer($opciones = array('js_page' => true, 'js' => array()))
{
	$controller = & get_instance();

	// contacto
	$datos['telefono'] = $controller->sitio->st_get_informacion_simple('telefono');
	$datos['telefonoreserva'] = $controller->sitio->st_get_informacion_simple('telefonoreserva');
	$datos['faxhotel'] = $controller->sitio->st_get_informacion_simple('faxhotel');
	$datos['direccion'] = $controller->sitio->st_get_informacion_simple('direccion');

	$datos['redes_sociales'] = app_redes_sociales();
//	$datos['form_login'] = $controller->load->view('administracion/login',array(),true);
	$datos['form_login'] = $controller->twig->render('administracion/login',array(),true);
	$datos['form_registro'] = $controller->twig->render('administracion/registro',array(),true);
	//$datos['form_registro'] = $controller->load->view('administracion/registro',array(),true);

	$controller->load->view('diseno/footer',$datos);
}
function combinar_opciones($default,$nuevos_valores)
{
	$combinacion = $default;
	foreach($combinacion as $key=>$valor)
	{
		if(isset($nuevos_valores[$key]))
			$combinacion[$key] = $nuevos_valores[$key];
			
	}
	foreach($nuevos_valores as $key=>$valor)
	{
		if(!isset($combinacion[$key]))
			$combinacion[$key] = $valor;
	}
	return $combinacion;
}
function menu_vertical($opciones)
{
	$controller = & get_instance();
	$controller->load->view('diseno/menu_vertical',$opciones);
}
function footer_operacion()
{
	$controller = & get_instance();
	$controller->load->view('diseno/footer_operacion');
}
?>