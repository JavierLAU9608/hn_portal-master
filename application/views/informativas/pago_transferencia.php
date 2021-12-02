<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('reserva_pago_transferencia_bancaria'))); ?>
    <body>
    	<?php top(array('title'=>trans('reserva_pago_transferencia_bancaria'))); ?>
    	<div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<?php modulo_load(); ?>
                </div>
                <div id="center_area">
                	<div class="form border_drk">
                    	<p class="verdana intro">
							<?php print trans('reserva_texto_pago_transferencia_bancaria'); ?>
                        </p>
                        <p>
                        <?php
							print '<b>'.trans('reserva_informacion_cuenta_bancaria').'</b>';
							print '<br class="clean" /><br/>';
							print '<div class="col solo1">';
								print '<label>';
									print trans('banco_financiero_internacional');
								print '</label>';
								print '<br/>';
								print '<label class="verdana detail">';
									print $banco;
								print '</label>';
							print '</div>';
							print '<br class="clean" /><br/>';
							print '<div class="col solo1">';
								print '<label>';
									print trans('banco_nombre_cuenta');
								print '</label>';
								print '<br/>';
								print '<label class="verdana detail">';
									print $titularcuenta;
								print '</label>';
							print '</div>';
							print '<br class="clean" /><br/>';
							print '<div class="col solo1">';
								print '<label>';
									print trans('banco_numero_cuenta');
								print '</label>';
								print '<br/>';
								print '<label class="verdana detail">';
									print $cuentabanco;
								print '</label>';
							print '</div>';
							print '<br class="clean" /><br/>';
							print '<div class="col solo1">';
								print '<label>';
									print trans('banco_swift');
								print '</label>';
								print '<br/>';
								print '<label class="verdana detail">';
									print $swift;
								print '</label>';
							print '</div>';
							
							print '<br class="clean" /><br/>';
					
						   footer_operacion(); 
						   ?>                          
                        </p>
                    </div>
                </div>
            </div>
        </div>        	      
        <?php footer(); ?>
    </body>
</html>