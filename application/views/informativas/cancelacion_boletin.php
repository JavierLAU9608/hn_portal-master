<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('subscripcion_cancelada'))); ?>
    <body>
    	<?php top(array('title'=>trans('subscripcion_cancelada'))); ?>
    	<div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<?php modulo_load(); ?>
                </div>
                <div id="center_area">
                	<div class="form border_drk">
                    	<p class="verdana intro">
							<?php print trans('subscripcion_texto_cancelacion',array('email'=>$email)); ?>
                            <?php footer_operacion(); ?>    
                        </p>
                    </div>
                </div>
            </div>
        </div>        	      
        <?php footer(); ?>
    </body>
</html>