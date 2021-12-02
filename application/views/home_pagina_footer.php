<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
		$pie_traduccion = app_traduccion('frontend','frontend_menupie_idioma',NULL,'menu_footer_fk',$pagina_footer['id'],$pagina_footer);
		$titulo = (isset($pie_traduccion['nombre']) && !$pie_traduccion['nombre']=='')?$pie_traduccion['nombre']:$pie_traduccion['titulo'];
	 	head(array('titulo'=>$titulo,'description'=>$pagina_footer['description'],'keywords'=>$pagina_footer['keywords']));
		
	?>
    <body>
        <?php top(array('title'=>$titulo)); ?>
        <div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
               		<?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>
                	<?php modulo_load(); ?>
                    <?php modulo_load(array('posicion'=>'publicidad_vertical')); ?>
                </div>
                <div id="center_area">
					<?php
                        print '<p class="verdana intro">';
                            print $pie_traduccion['descripcion'];
                        print '</p>';
                    ?>
                </div>
            </div>
        </div>
        <?php footer(); ?>
    </body>
</html>