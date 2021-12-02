<?php 
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_evento','evento');
$tipo_evento = $controlador->evento->get_name_tipo_menu($datos_adicionales['tipo_evento']);
$tipo_evento_nombre = app_traduccion('evento','evento_tipom_idioma','nombre','tipo_menu_fk',$datos_adicionales['tipo_evento'],$tipo_evento);
?>
<div class="relative">
        <div class="border relleno left">
        	<p class="verdana"><b><?php print trans('serivicio_nombre',array('nombre'=>trans('evento'))); ?></b></p>
            <p class="verdana"><?php print trans('evento'); ?>: <b><?php print $datos_adicionales['nombre']; ?></b></p>
            <p class="verdana"><?php print trans('ev_inicio'); ?>: <b><?php print app_str_date($datos_adicionales['fecha']); ?></b></p>
            <p class="verdana"><?php print trans('ev_fin'); ?>: <b><?php print app_str_date($datos_adicionales['fecha_fin']); ?></b></p>
            <p class="verdana"><?php print trans('ev_no_participantes'); ?>: <b><?php print $datos_adicionales['no_participantes']; ?></b></p>
        </div>                       
        <div class="precio_reserva right" >
        	<p class="verdana"><b><?php print $datos_adicionales['no_reserva']; ?></b></p>  
            <?php 
			if($datos_adicionales['estado'] != 4)
			{
				print '<br class="clean" />';
			}
			?>           
            <p class="verdana"><?php print trans('precio'); ?></p>
            <span></span>
            <p class="verdana yellow_bg"><?php print app_rate_cambio($producto['price'],'smb'); ?></p>
            <?php
			
			if($datos_adicionales['estado'] == 4)
			{				
				print '<br class="clean_space" />';
				print '<div class="left">';									
					print '<a title="'.trans('descargar').'" href="'.trans('ruta_voucher_producto',array('producto'=>$datos_adicionales['tipo'],'id'=>$datos_adicionales['id_reserva'])).'" ><span class="pdf"></span><span class="padd">'.trans('voucher').'</span></a>';
				print '</div>';
			}
			?>               
        </div>        
       
        <?php
        if($datos_adicionales['estado'] == 4 && $datos_adicionales['fecha'] > app_now())
			{
			?>                          
				<a class="buttom roman right abajo" href="<?php print trans('ruta_cancelar_producto_pagado',array('producto'=>$datos_adicionales['tipo'],'id'=>$datos_adicionales['id_reserva'])) ?>" ><?php print trans('cancelar'); ?></a>
            <?php
			}?>
    	<br class="clean" />
</div>