<?php
if($datos_usuario)
{
	$user = (strlen($datos_usuario['nombre'])>21)?substr($datos_usuario['nombre'],0,18).'...':$datos_usuario['nombre'];
	print '<a title="'.$datos_usuario['nombre'].'" href="'.base_url(trans('ruta_mi_cuenta')).'" class="dif user"><span>'.' '.$user.'</span></a>';
	print '<a href="'.base_url('salir').'" class="dif"><span>'.trans('cerrar_session').'</span></a>';
}
else
{
?>
	<a id="login" data-modal-id="loginform" data-animation="fade" href="#" title="<?php print trans('autenticar'); ?>"><span><?php print trans('autenticar'); ?></span></a>
    <a id="register" data-modal-id="registerform" data-animation="fade" href="#" title="<?php print trans('registrarse'); ?>"><span><?php print trans('registrarse'); ?></span></a>
<?php
}
?>