<?php
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_oferta','oferta');
$oferta = $controlador->oferta->get_oferta(array('id'=>$datos_adicionales['id_oferta']));
$oferta_traducido = app_traduccion('oferta','oferta_idioma',NULL,'oferta_fk',$oferta['id'],$oferta);
$oferta_tipo_traducido = app_traduccion('oferta','oferta_tipo_idioma',NULL,'tipo_fk',$oferta['tipo_fk'],$oferta['tipo']);
?>
<div class="border_thin car">
    <div class="parte1">
        <h1><?php print trans('serivicio_nombre',array('nombre'=>trans('oferta'))); ?></h1>
        <br class="clean_space"/>
        <p class="verdana"><span><?php print trans('fecha_solicitud'); ?>:</span><br/> <?php print app_str_date(app_now()); ?></p>
        <br class="clean_space"/>
        <p class="verdana"><span><?php print trans('carro_estado_reserva'); ?>:</span> <?php if($datos_adicionales['aconfirmar']==1){print trans("reserva_a_confirmar");}else{print trans('reserva_estado_confirmada');} ?></p>
        <br class="clean_space"/>
    </div>
    <div class="parte2">
        <div class="left">
        	<p class="verdana"><b><?php print $oferta_tipo_traducido['nombre']; ?></b></p>
            <p class="verdana"><?php print trans('of_oferta'); ?>: <b><?php print $oferta_traducido['nombre']; ?></b></p>
            <p class="verdana"><?php print trans('of_fecha'); ?>: <b><?php print app_str_date($datos_adicionales['fecha']); ?></b></p>
            <p class="verdana"><?php print trans('of_cantidad'); ?>: <b><?php print $datos_adicionales['cantidad']; ?></b></p>
            <p class="verdana"><?php print trans('of_cantidad_dias'); ?>: <b><?php print $datos_adicionales['cantidad_dias']; ?></b></p>
        </div>
        <div class="precio_reserva right">
            <p class="verdana"><?php print trans('precio'); ?></p>
            <span></span>
            <p class="verdana border yellow_lite"><?php print app_rate_cambio($producto['price'],'smb'); ?></p>                                
        </div>
        <br class="clean">
        <?php
		if(isset($datos_adicionales['detalles']) && $datos_adicionales['detalles']!=='' && $datos_adicionales['detalles']!==NULL)
		{
		?>
        <div id="hidden-<?php print $producto['id']; ?>" class="verdana" style="display: none">
        <?php
			print '<br class="clean_lttl_space">';
			print '<h3>'.trans('of_solicitud_adicional').'</h3>';
			print '<div class="divisor"></div>';
			print '<span>'.$datos_adicionales['detalles'].'</span>';
		?>            
        </div>
    	<br class="clean_lttl_space"/>
    	<a id="tog-<?php print $producto['id']; ?>" class="toggle " data-pick="<?php print trans('recoger'); ?>" title="<?php print trans('otros_detalles'); ?>"><span><?php print trans('otros_detalles'); ?></span><span class="fl"></span></a>
    
    	<br class="clean" />
        <?php } ?>
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