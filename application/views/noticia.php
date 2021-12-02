<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
    <?php
    $noticia_trans = app_traduccion('frontend','frontend_noticia_idioma',NULL,'noticia_fk',$noticia['id'],$noticia);		
	?>
	<?php head(array('titulo'=>trans('noticia').': '.$noticia_trans['titulo'],'description'=>$noticia_trans['description'],'keywords'=>$noticia_trans['keywords'])); ?>
    <body>
        <?php top(array('title'=>trans('noticias'),'subtitle'=>$noticia_trans['titulo'])); ?>
        <div class="white_bg">
        	<div id="body" class="center">
            	<div id="left_area">
                	<?php modulo_load(); ?>
                </div>
                <div id="center_area">  
				<?php                    
                    print '<img class="border left margen_r max_width" title="'.$noticia_trans['titulo'].'" src="'.app_url_admin().('/admin/noticia/noticia-'.$noticia['imagen']).'"/>';
                    print '<p class="verdana intro">'.$noticia_trans['texto'].'</p>';
                ?>                
                <br style="clear:both"/>
                <br/>
                <div class="divisor">
                	<span class="l"></span>
					<span class="r"></span>
                </div>
                <a class="flecha" href="<?php print base_url(trans('ruta_noticias')); ?>"><?php print trans('todas_noticias'); ?></a>
                </div>
            </div>
        </div>    
        <?php footer(); ?>
    </body>
</html>