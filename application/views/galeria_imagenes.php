<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('galeria_imagenes'),'description'=>trans('seo_description_galeria'),'keywords'=>trans('seo_keywords_galeria'))); ?>
    <body>
        <?php top(array('title'=>trans('galeria_imagenes'),'subtitle'=>isset($tipo_imagen)?$tipo_imagen['nombre']:'')); ?>
        <div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>
                	<?php modulo_load(); ?>
                </div>
                <div id="center_area">
                <?php
				if(isset($tipo_imagen) && $tipo_imagen['descripcion'] && $tipo_imagen['descripcion']!=='')
				{
					print '<p class="verdana intro">';
						print $tipo_imagen['descripcion'];
					print '</p>';					
				}
				if(isset($tipo_imagen) && sizeof($lista_imagenes)>0)
				{
					print '<br/>';
						print '<a href="'.trans('ruta_descargar_imagenes_por_tipo',array('id'=>$tipo_imagen['id'])).'">';
							print trans('descargar_imagenes',array('nombre'=>$tipo_imagen['nombre']));
						print '</a>';
					print '<br/>';
					print '<br/>';
				}
				?>
					<?php                          
						foreach($lista_imagenes as $i)
						{
							$titulo_imagen = app_traduccion('hotel','hotel_imagenes_idioma','nombre','imagen_fk',$i['id'],$i['descripcion']);							
							print '<a style="margin:2px;" href="'.app_url_admin().'/hoteles/'.app_hotel_id().'/images/zoom-'.$i['url'].'" title="'.$titulo_imagen.' - <a target=\'_blank\' href=\''.trans('ruta_descargar_imagen',array('id'=>$i['id'])).'\'>'.trans('descargar').'</a>" rel="lightbox[galeria_imagenes]">';
								print '<img title="'.$titulo_imagen.'" alt="'.$titulo_imagen.'" src="'.app_url_admin().('/hoteles/'.app_hotel_id().'/images/galeria-'.$i['url']).'" class="border"/>';
							print '</a>';							
						}                       
                        print $paginacion;
                    ?>
                </div>
            </div>
        </div>  
        <?php footer(); ?>
    </body>
</html>