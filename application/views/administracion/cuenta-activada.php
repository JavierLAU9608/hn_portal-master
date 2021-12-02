<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('user_cuenta_activada'))); ?>
    <body>
    	<?php top(array('title'=>trans('user_cuenta_activada'))); ?>
    	<div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<?php modulo_load(); ?>                    
                </div>
                <div id="center_area">
                	<div class="form border_drk">
						<?php                     
                        print '<p class="verdana intro">';                        
                            print trans('user_texto_cuenta_activada');
                        print '</p>';
                        ?>
                    </div>
                </div>
            </div>
        </div>        	      
        <?php footer(); ?>
    </body>
</html>