<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('reserva_pago_pasarela_denegado'))); ?>
    <body>
    	<?php top(array('title'=>trans('reserva_pago_pasarela_denegado'))); ?>
    	<div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<?php modulo_load(); ?>
                </div>
                <div id="center_area">
                	<div class="form border_drk">
                    	<p class="verdana intro">
							<?php print trans('reserva_texto_pago_pasarela_denegado', array('email' => 'jcomercial@gcnacio.gca.tur.cu', 'link' => base_url('carro-compra'))); ?>
                            <?php footer_operacion(); ?>  
                        </p>
                    </div>
                </div>
            </div>
        </div>        	      
        <?php footer(); ?>
    </body>
</html>