<?php
function icon($icono,$opciones = array())
{
	$icon = '';
	$icon.='<i class="icon-'.$icono.'"></i>';
	if($opciones['texto'])
		$icon.=$opciones['texto'];
	return $icon;
}
?>