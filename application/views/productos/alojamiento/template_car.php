<?php
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_alojamiento','alojamiento');
$hotel = $controlador->alojamiento->get_hotel();
?>
<div class="border_thin car">
    <div class="parte1">
        <h1><?php print trans('serivicio_nombre',array('nombre'=>trans('alojamiento'))); ?></h1>
        <br class="clean_space"/>
        <p class="verdana"><span><?php print trans('fecha_solicitud'); ?>:</span><br/><?php print app_str_date(app_now()); ?></p>
        <br class="clean_space"/>
        <p class="verdana"><span><?php print trans('carro_estado_reserva'); ?>:</span> <?php if($datos_adicionales['aconfirmar']==1){print trans("reserva_a_confirmar");}else{print trans('reserva_estado_confirmada');} ?></p>
        <br class="clean_space"/>
    </div>
    <div class="parte2">
        <div class="left">
            <p class="verdana"><?php print trans('al_cantidad_habitaciones'); ?>:<b><?php print sizeof($datos_adicionales['habitaciones']); ?></b></p>
        </div>                        
        <div class="precio_reserva right">
            <p class="verdana"><?php print trans('precio'); ?></p>
            <span></span>
            <p class="verdana border yellow_lite"><?php print app_rate_cambio($producto['price'],'smb'); ?></p>                                
        </div>
        <br class="clean">  
               
        <div id="hidden-<?php print $producto['id']; ?>" class="verdana" style="display: none">
        <?php
			print '<h3>'.trans('al_habitaciones').'</h3>';
			print '<div class="divisor"></div>';
			foreach($datos_adicionales['habitaciones'] as $h)
			{
				$tipo_habitacion = $controlador->alojamiento->_get_tipo_habitacion($h['tipo_habitacion']);
				$tipo_habitacion_nombre = app_traduccion('hotel','hotel_tipo_hab_idioma','nombre','tipo_habitacion_fk',$tipo_habitacion['id'],$tipo_habitacion['nombre_habitacion']);
				$plan_alimentacion = $controlador->alojamiento->_get_plan_alimentacion($h['plan']);
				$plan_nombre = app_traduccion('hotel','hotel_plan_idioma','nombre','plan_fk',$plan_alimentacion['id'],$plan_alimentacion['nombre_plan']);
				$nuevos_paxs = app_convert_paxs($controlador->alojamiento->get_pax_habitacion($tipo_habitacion['id'], $plan_alimentacion['id'], $h['fecha']));
				
				print '<br class="clean_lttl_space">';
				print '<div class="left">';
					print '<h3>'.trans('al_habitacion').'</h3>';
					print '<span>'.$tipo_habitacion_nombre.'</span>';
					print '<br/>';
					print '<h3>'.trans('al_fecha_entrada').'</h3>';
					print '<span>'.app_str_date($h['fecha']).'</span>';
					print '<br/>';
					print '<h3>'.trans('al_noches').'</h3>';
					print '<span>'.$h['noches'].'</span>';					
					if($h['paquete_luna_miel'])
					{
						$paquete_luna_miel = $controlador->alojamiento->get_paquete_luna_miel($h['paquete_luna_miel']);
						$paquete_luna_miel_nombre = app_traduccion('hotel','hotel_pack_idioma','nombre','pack_fk',$paquete_luna_miel['id'],$paquete_luna_miel['nombre']);
						print '<br/>';
						print '<h3>'.trans('al_paquete_luna_miel').'</h3>';
						print '<span>'.$paquete_luna_miel_nombre.'</span>';
					}
				print '</div>';
				print '<div class="right" style="width:40%;">';					
					print '<h3>'.trans('al_plan_alojamiento').'</h3>';
					print '<span>'.$plan_nombre.'</span>';
					print '<br/>';
					print '<h3>'.trans('al_pax').'</h3>';
					print '<span>'.app_get_pax_opc($nuevos_paxs, $h['paxs']).'</span>';
					print '<br/>';
					print '<h3>'.trans('al_hora_entrada').'</h3>';
					print '<span>'.$h['hora'].'</span>';					
					if($h['ninno_adicional']!=='f' && $h['ninno_adicional'])
					{
						print '<br/>';
						print '<h3>'.trans('al_ninno_adicional').'</h3>';
					}
				print '</div>';			
				print '<div class="divisor"></div>';
			}
			if($datos_adicionales['detalles']!=='')
			{
				print '<br/>';
				print '<h3>'.trans('detalles_adicionales').'</h3>';
				print '<p class="verdana">'.$datos_adicionales['detalles'].'</p>';
				print '<br class="clean_lttl_space">';
			}
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