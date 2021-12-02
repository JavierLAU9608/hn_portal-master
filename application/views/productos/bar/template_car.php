<?php
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_bar','bar');
$bar = $controlador->bar->get_bar(array('id'=>$datos_adicionales['id_bar']));
$menu_reservado = $controlador->bar->get_menu($datos_adicionales['id_menu']);
$horario_reservado = $controlador->bar->get_horario($datos_adicionales['id_duracion']);
?>
<div class="border_thin car">
    <div class="parte1">
        <h1><?php print trans('serivicio_nombre',array('nombre'=>trans('bar'))); ?></h1>
        <br class="clean_space"/>
        <p class="verdana"><span><?php print trans('fecha_solicitud'); ?>:</span><br/><?php print app_str_date(app_now()); ?></p>
        <br class="clean_space"/>
        <p class="verdana"><span><?php print trans('carro_estado_reserva'); ?>:</span> <?php if($datos_adicionales['aconfirmar']==1){print trans("reserva_a_confirmar");}else{print trans('reserva_estado_confirmada');} ?></p>
        <br class="clean_space"/>
    </div>
    <div class="parte2">
        <div class="left">
            <p class="verdana"><?php print trans('br_bar'); ?>:<b><?php print $bar['nombre']; ?></b></p>
            <p class="verdana"><?php print trans('br_dia_reservacion'); ?>:<b><?php print app_str_date($datos_adicionales['fecha']); ?></b></p>
            <p class="verdana"><?php print trans('br_menu'); ?>:<b><?php print $menu_reservado['nombre']; ?></b></p>
            <p class="verdana"><?php print trans('br_duracion'); ?>:<b><?php print $horario_reservado['duracion']; ?></b></p>
            <?php
			if($datos_adicionales['horas_extras']>0)
			{
			?>
            <p class="verdana"><?php print trans('br_precio_hora_extra'); ?>:<b><?php print $datos_adicionales['horas_extras']; ?></b></p>
            <?php
            }
            ?>
            <p class="verdana"><?php print trans('br_cantidad_personas'); ?>:<b><?php print $datos_adicionales['cantidad']; ?></b></p>
        </div>                        
        <div class="precio_reserva right">
            <p class="verdana"><?php print trans('precio'); ?></p>
            <span></span>
            <p class="verdana border yellow_lite"><?php print app_rate_cambio($producto['price'],'smb'); ?></p>                                
        </div>
        <br class="clean">
    	<br class="clean_space" />
        <?php
		    if($datos_adicionales['aconfirmar']==2)
		    {
		    ?>
            <a href="<?php print base_url('con_reservacion/cancelar_producto_confirmado_car/'.$producto['rowid']); ?>" class="buttom roman right"><?php print trans('cancelar'); ?></a>
            <?php
		    }
		    else
		    {
				?>
                <a class="buttom roman right" href="<?php print trans('ruta_carro_compra_cancelar',array('rowid'=>$producto['rowid'])) ?>" ><?php print trans('cancelar'); ?></a>
        		<a class="buttom roman right margen_r" href="<?php print trans('ruta_carro_compra_editar',array('rowid'=>$producto['rowid'])); ?>" ><?php print trans('editar'); ?></a>
                <?php
			}
		?>
    	<br class="clean"/> 
    </div>
    <br class="clean"/> 
</div>