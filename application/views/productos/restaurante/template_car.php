<?php
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_restaurante','restaurante');
$restaurante = $controlador->restaurante->get_restaurante(array('id'=>$datos_adicionales['id_restaurante']));
?>
<div class="border_thin car">
    <div class="parte1">
        <h1><?php print trans('serivicio_nombre',array('nombre'=>trans('restaurante'))); ?></h1>
        <br class="clean_space"/>
        <p class="verdana"><span><?php print trans('fecha_solicitud'); ?>:</span> <br/><?php print app_str_date(app_now()); ?></p>
        <br class="clean_space"/>
        <p class="verdana"><span><?php print trans('carro_estado_reserva'); ?>:</span> <?php if($datos_adicionales['aconfirmar']==1){print trans("reserva_a_confirmar");}else{print trans('reserva_estado_confirmada');} ?></p>
        <br class="clean_space"/>
    </div>
    <div class="parte2">
        <div class="left">
            <p class="verdana"><?php print trans('restaurante'); ?>:<b><?php print $restaurante['nombre']; ?></b></p>
            <p class="verdana"><?php print trans('rt_dia_reservacion'); ?>:<b><?php print app_str_date($datos_adicionales['fecha']); ?></b></p>
            <p class="verdana"><?php print trans('rt_horario'); ?>:
            	<b>
					<?php
					$horario = $controlador->restaurante->get_horario($datos_adicionales['horario']);
					$horario_nombre = app_traduccion('restaurante','restaurante_horario_idioma','nombre','horario_fk',$horario['id'],$horario['nombre']);
					print $horario_nombre.' ('.app_str_hora($horario['hora_inicio']).'-'.app_str_hora($horario['hora_fin']).')';
                    ?>
                </b>
            </p>
            <p class="verdana"><?php print trans('rt_cantidad_menus'); ?>:<b><?php print sizeof($datos_adicionales['menus']); ?></b></p>
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
			print '<h3>'.trans('rt_menus_reservados').'</h3>';
			print '<div class="divisor"></div>';
			foreach($datos_adicionales['menus'] as $m)
			{
				$datos_menu = $controlador->restaurante->get_el_menu($datos_adicionales['id_restaurante'],$m['id_menu']);
				$nombre_menu = app_traduccion('restaurante','restaurante_menu_idioma','nombre','menu_fk',$datos_menu['id'],$datos_menu['nombre']);
				print '<h3>'.trans('rt_menu').'</h3>';
				print '<span>'.$nombre_menu.'</span>';
				print '<br/>';
				print '<h3>'.trans('rt_cantidad').'</h3>';
				print '<span>'.$m['cantidad'].'</span>';
				print '<br/>';
				print '<div class="divisor"></div>';
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