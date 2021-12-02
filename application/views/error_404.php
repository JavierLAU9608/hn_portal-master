<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('error_404_encabezado'))); ?>
    <body>
        <?php top(array('title'=>trans('error_404_encabezado'))); ?>
        <div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                </div>
                <div id="center_area">
                	<div class="form border_drk">
                    	<?php
							print '<div class="form_msg  verdana">';
								print trans('error_404',array('url'=>base_url(uri_string())));
                            print '</div>';
						?>
                    </div>
                </div>
            </div> 
        </div>   
        <?php footer(); ?>
    </body>
</html>