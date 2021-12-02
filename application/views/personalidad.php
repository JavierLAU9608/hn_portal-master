<!DOCTYPE html>
<html lang="<?php print CODIGO_IDIOMA; ?>">
	<?php
    $keywords = $personalidad['keywords'];
    $description =  $personalidad['description'];
    head(array('titulo'=>'Personalidad: '.$personalidad['nombre'],'description'=>$description,'keywords'=>$keywords));

    ?>
    <body>
        <?php top(array('title'=>$personalidad['nombre'])); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                    <?php modulo_load(); ?>
                    <?php
					if($personalidades_relacionadas)
					{
                    	print '<div class="personalidades_relacionadas">';                    	
							print '<h2>';
								print trans('personalidades_relacionadas');
							print '</h2>';
							foreach($personalidades_relacionadas as $p)
							{
								$url_personalidad = trans('ruta_personalidad',array('slug'=>$p['slug']));
								$nombre_personalidad = $p['nombre'];
								print '<a href="'.$url_personalidad.'">';							
								print '<img class="left border" style="margin:5px;" alt="'.$nombre_personalidad.'" title="'.$nombre_personalidad.'" src="'.app_url_admin().('/admin/personalidades/thumb-'.$p['imagen']).'"/>';
								print '</a>';
							}
						print '</div>';
					}
					?>                    
                </div>
                <div id="center_area">
                    <?php                        
                        $img = '<img class="border left margen_r max_width" title="'.$personalidad['nombre'].'" src="'.app_url_admin().('/admin/personalidades/normal-'.$personalidad['imagen']).'"/>';
                        print '<p class="verdana left">'.$img.'<p class="intro">'.$personalidad['descripcion'].'</p></p>';
                    ?>
                </div>
            </div> 
        </div>   
        <?php footer(); ?>
    </body>
</html>