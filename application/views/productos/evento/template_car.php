<?php 
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_evento','evento');
$tipo_evento = $controlador->evento->get_name_tipo_menu($datos_adicionales['tipo_evento']);
$tipo_evento_nombre = app_traduccion('evento','evento_tipom_idioma','nombre','tipo_menu_fk',$datos_adicionales['tipo_evento'],$tipo_evento);
?>
<div class="border_thin car">
    <div class="parte1">
        <h1><?php print trans('serivicio_nombre',array('nombre'=>trans('evento'))); ?></h1>
        <br class="clean_space"/>
        <p class="verdana"><span><?php print trans('fecha_solicitud'); ?>:</span> <br/><?php print app_str_date(app_now()); ?></p>
        <br class="clean_space"/>
        <p class="verdana"><span><?php print trans('carro_estado_reserva'); ?>:</span> <?php if($datos_adicionales['aconfirmar']==1){print trans("reserva_a_confirmar");}else{print trans('reserva_estado_confirmada');} ?></p>
        <br class="clean_space"/>
    </div>
    <div class="parte2">
        <div class="left">
            <p class="verdana"><?php print trans('ev_inicio'); ?>:<b><?php print app_str_date($datos_adicionales['fecha']); ?></b></p>
            <p class="verdana"><?php print trans('ev_fin'); ?>:<b><?php print app_str_date($datos_adicionales['fecha_fin']); ?></b></p>
            <p class="verdana"><?php print trans('ev_tipo'); ?>:<b><?php print $tipo_evento_nombre; ?></b></p>
            <p class="verdana"><?php print trans('ev_nombre_evento'); ?>:<b><?php print $datos_adicionales['nombre']; ?></b></p>
            <p class="verdana"><?php print trans('ev_no_participantes'); ?>:<b><?php print $datos_adicionales['no_participantes']; ?></b></p>
        </div>                        
        <div class="precio_reserva right">
            <p class="verdana"><?php print trans('precio'); ?></p>
            <span></span>
            <p class="verdana border yellow_lite"><?php print app_rate_cambio($producto['price'],'smb'); ?></p>                                
        </div>
        <br class="clean">  
               
        <div id="hidden-<?php print $producto['id']; ?>" class="verdana" style="display: none">
        <?php
			print '<br class="clean_lttl_space">';
			print '<div class="divisor"></div>';
			print '<h3>'.strtoupper(trans('ev_responsable_evento')).':</h3>';
			print '<div class="left">';
				print '<h3>'.trans('nombre_completo').'</h3>';
				print '<span>'.$datos_adicionales['nombre_completo'].'</span>';
				print '<h3>'.trans('email').'</h3>';
				print '<span>'.$datos_adicionales['email'].'</span>';
			print '</div>';	
			print '<div class="right" style="width:40%;">';
				print '<h3>'.trans('telefono').'</h3>';
				print '<span>'.$datos_adicionales['telefono'].'</span>';
				print '<h3>'.trans('ciudad').'</h3>';
				print '<span>'.$datos_adicionales['ciudad'].'</span>';
			print '</div>';	
			print '<br class="clean_lttl_space">';		
		?>            
        </div>
    	<br class="clean_lttl_space"/>
    	<a id="tog-<?php print $producto['id']; ?>" class="toggle " data-pick="<?php print trans('recoger'); ?>" title="<?php print trans('otros_detalles'); ?>"><span><?php print trans('otros_detalles'); ?></span><span class="fl"></span></a>
    
    	<br class="clean" />
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