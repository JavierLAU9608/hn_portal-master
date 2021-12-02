<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
	$oferta_traducido = app_traduccion('oferta','oferta_idioma',NULL,'oferta_fk',$oferta['id'],$oferta);
	$oferta_tipo_traducido = app_traduccion('oferta','oferta_tipo_idioma',NULL,'tipo_fk',$oferta['tipo_fk'],$oferta['tipo']);
	?>
	<?php head(array('titulo'=>trans('of_oferta_nombre',array('nombre'=>$oferta_traducido['nombre'])),'description'=>app_strip_etiquetas($oferta_traducido['description']),'keywords'=>$oferta_traducido['keywords'])); ?>
    <body>
        <?php top(array('title'=>$oferta_tipo_traducido['nombre'],'subtitle'=>$oferta_traducido['nombre'])); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                	<?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>
                    <?php modulo_load(); ?>
                    <?php modulo_ofertas(); ?>
                </div>
                <div id="center_area">
                    <?php			
						print '<p class="verdana left intro">';
						if($oferta['imagen'])
						{
							print '<a href="'.app_url_admin().'/oferta/oferta-'.$oferta['imagen'].'" title="'.$oferta_traducido['nombre'].'" rel="lightbox[galeria_oferta]">';
                        		print '<img class="border left margen_r max_width" title="'.$oferta_traducido['nombre'].'" src="'.app_url_admin().('/oferta/oferta-'.$oferta['imagen']).'"/>';
							print '</a>';
						}
						print '<p class="intro">';
                        	print $oferta_traducido['descripcion'];
						print '</p>';
						print '<br class="clean" />';
						print '<br class="clean" />';
						if($oferta['precio']>0)
						{
							print '<div class="divisor"><span class="l"></span><span class="r"></span></div>';		
							print '<div class="precio_reserva">';
								print '<p class="verdana">'.trans('of_precio').':</p>';
								print '<span></span>';
								print '<p class="verdana yellow_bg">'.app_rate_cambio($oferta['precio'],'smb').'</p>';											
								print '<a class="buttom roman" href="'.base_url(trans('ruta_reservar_oferta',array('id_oferta'=>$oferta['id']))).'" >'.trans('of_reservar').'</a>';
								print '<br class="clean" />';									
							print '</div>';
						}
						print '</p>';
						?>
                </div>
            </div> 
        </div>   
        <?php footer(); ?>
    </body>
</html>