<!DOCTYPE html>
<html lang="<?php print CODIGO_IDIOMA; ?>">
<?php 
$titulo = trans('user_pagos_pendientes');
$subtitulo = $user_registrado['nombre']; 
?>
<?php head(array('titulo'=>$titulo.' - '.$subtitulo,'description'=>trans('seo_description_home'),'keywords'=>trans('seo_keywords_home')));?>
<body>
<?php top(array("title"=>$titulo,"subtitle"=>$subtitulo)); ?>
<div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                <?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>              	
                    <div class="clean_space" ></div>                    
                </div>
                <div id="center_area">
                	<div class="form border_drk">
                    <?php
					if(sizeof($reservas)>0)
					{
							foreach($reservas as $r)
							{
								print $r['options']['template_historial'];
								print '<div class="col solo2">';
								    print '<br class="clean_lttl_space" />';
									print '<label class="verdana detail">';
										print trans('user_pagos_pendientes');
									print '</label>';
								print '</div>';							
								print '<div class="divisor"></div>';
								foreach($r['options']['calendarios'] as $c)
								{
									print '<div class="precio_reserva right">
									<p class="verdana">'.app_str_date($c['fecha']).'</p>
									<span></span>';	
									if($c['pago_porciento'] == 't')								
										print '<p class="verdana yellow_bg">'.$c['precio'].' %</p>';
									else
										print '<p class="verdana yellow_bg">'.app_rate_cambio($c['precio'],'smb').'</p>';
										
									if($c['estado'] == 't')
										print '<p class="verdana" style="width:120px;"><b>'.trans('estado_calendario_pagado').'</b></p>';
									else
										print '<a class="buttom roman right" href="'.base_url(trans('ruta_pagar_calendario',array('producto'=>$r['options']['tipo'],'id'=>$c['id']))).'" >'.trans('pagar').'</a>';
									
									print '<br class="clean_lttl_space">
									</div>';											
									print '<br class="clean" />';
								}
								print '<div class="divisor"><span class="l"></span><span class="r"></span></div>';
							}
						}
						else
						{
							print '<div class="form_msg  verdana">';
								print trans('error_no_se_encontraron_elementos');
							print '</div>';
						}
					?>
                    </div>			
				</div>
            </div>
        </div>     
        <?php footer(); ?>
    </body>
</html>