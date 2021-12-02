<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
    	$historia_titulo_traduccion = app_traduccion('frontend','frontend_informacion_idioma','nombre','informacion_fk',$historia['id'],$historia['titulo']);
	?>
	<?php head(array('titulo'=>$historia_titulo_traduccion,'description'=>trans('seo_description_historia'),'keywords'=>trans('seo_keywords_historia'))); ?>
    <body>
    	<?php top(array('title'=>$historia_titulo_traduccion)); ?>
    	<div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<?php modulo_load(); ?>
                    <?php modulo_load(array('posicion'=>'publicidad_vertical')); ?>
                </div>
                <div id="center_area">
					<?php 
                    print '<p class="verdana intro">';
                        $historia_texto_traduccion = app_traduccion('frontend','frontend_informacion_idioma','descripcion','informacion_fk',$historia['id'],$historia['value']);
                        print app_strip_etiquetas($historia_texto_traduccion);
                    print '</p>';
                    ?>
                </div>
            </div>
        </div>        	      
        <?php footer(); ?>
    </body>
</html>