<?php
function modulo_load($opciones = array('posicion'=>'top_left'))
{
	$controlador = & get_instance();
	$modulos_publicidad = app_config('modulos_publicidad');
	$menu_principal = app_config('menu_principal');
	$menu_principal = $menu_principal[$controlador->str_producto?$controlador->str_producto:'home'];
	$posicion_modulo =  $opciones['posicion'];
	$opciones['menu_principal_fk'] = $menu_principal; 
	$key_modulo = $modulos_publicidad[$posicion_modulo];
	$modulos = $controlador->mod_modulo->get_modulos($key_modulo,$opciones);
	$controlador->load->view('modulo/'.$posicion_modulo,array('modulos'=>$modulos,'opciones'=>$opciones));
}

function modulo_load_list($opciones = array('posicion'=>'top_left'))
{
	$controlador = & get_instance();
	$modulos_publicidad = app_config('modulos_publicidad');
	$menu_principal = app_config('menu_principal');
	$menu_principal = $menu_principal[$controlador->str_producto?$controlador->str_producto:'home'];
	$posicion_modulo =  $opciones['posicion'];
	$opciones['menu_principal_fk'] = $menu_principal; 
	$key_modulo = $modulos_publicidad[$posicion_modulo];
	$modulos = $controlador->mod_modulo->get_modulos($key_modulo,$opciones);
	return $modulos;
}
function modulo_ofertas()
{
	$controlador = & get_instance();
	$producto_anterior = $controlador->str_producto;
	$controlador->str_producto = 'oferta';
	$controlador->load->model('mod_oferta','oferta');
	$ofertas_especiales = $controlador->oferta->get_ofertas(array('pagina_inicio'=>'t','disponible'=>'t'));
	$controlador->load->view('modulo/oferta',array('ofertas_especiales'=>$ofertas_especiales));
	$controlador->str_producto = $producto_anterior;
}
?>