<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('reserva_cancelacion_reserva'))); ?>
    <body>
    	<?php top(array('title'=>trans('reserva_cancelacion_reserva'),'subtitle'=>$no_reserva)); ?>
    	<div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<?php modulo_load(); ?>					 
                </div>
                <div id="center_area">
                	<div class="form border_drk">
						<?php 
                        print '<p class="verdana intro">';						                       
                            print trans('reserva_texto_cancelacion_reserva');
                        print '</p>';
                        print '<p>'; 
                            print '<b>'.trans('reserva_politica_cancelacion_aplicada').'</b>';
							print '<br class="clean" /><br/>';
							print '<div class="col solo1">';
								print '<label>';
									print trans('titular_tarjeta_credito');
								print '</label>';
								print '<br/>';
								print '<label class="verdana detail">';
									print $titualar_tarjeta;
								print '</label>';
							print '</div>';							
							print '<br class="clean" /><br/>';
							print '<div class="col solo1">';
								print '<label>';
									print trans('reserva_numero_reserva');
								print '</label>';
								print '<br/>';
								print '<label class="verdana detail">';
									print $no_reserva;
								print '</label>';
							print '</div>';
							print '<br class="clean" /><br/>';
							print '<div class="col solo1">';
								print '<label>';
									print trans('reserva_descuento_cancelacion');
								print '</label>';
								print '<br/>';
								print '<label class="verdana detail">';
									print $descuento;
								print '</label>';
							print '</div>';
							print '<br class="clean" /><br/>';
							print '<div class="col solo1">';
								print '<label>';
									print trans('reserva_reintegro_cancelacion');
								print '</label>';
								print '<br/>';
								print '<label class="verdana detail">';
									print $reintegro;
								print '</label>';
							print '</div>';							
                        print '</p>';
						print '<br/>';
						print '<p>';
							print '<a href="'.base_url(trans('ruta_historial')).'">'.trans('user_historial').'</a>';
						print '</p>';
						
						footer_operacion();
                        ?>
                    </div>
                </div>
            </div>
        </div>        	      
        <?php footer(); ?>
    </body>
</html>