<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
		$titulo = trans('al_paquetes_luna_miel');
		$texto_presentacion = app_traduccion('hotel','hotel_idioma_hotel','luna_de_miel','hotel_fk',$hotel['id'],$textopresentacion);
    ?>
	<?php head(array('titulo'=>$titulo,'description'=>trans('seo_description_luna_miel'),'keywords'=>trans('seo_keywords_luna_miel'))); ?>
    <body>
        <?php top(array("title"=>$titulo,"subtitle"=>'')); ?>
        <div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>
                	<?php modulo_load(); ?>
                    <div class="clean_space" ></div>
                    <?php modulo_ofertas(); ?>
                    <div class="clean_space" ></div>
                    <?php modulo_load(array('posicion'=>'publicidad_vertical')); ?>
                </div>
                <div id="center_area">
                    <p class="verdana intro">
                        <?php print isset($texto_presentacion)?$texto_presentacion:''; ?>
                    </p>
                    <div class="divisor"><span class="l"></span><span class="r"></span></div> 
                    <br class="clean" />                 
					<div id="paquetes_luna_miel">
                    <?php
					foreach($paquetes as $p)
					{		
						$paquete_traducido = app_traduccion('hotel','hotel_pack_idioma',NULL,'pack_fk',$p['id'],$p);
						$nombre_paquete = $paquete_traducido['nombre'];
						$descripcion_paquete = $paquete_traducido['descripcion'];				
						print '<h2 class="left"><span class="left">'.$nombre_paquete.'</span></h2>';
						print '<div class="precio_reserva right">';
								print '<p class="verdana">'.trans('precio').':</p>';
								print '<span></span>';
								print '<p class="verdana yellow_bg">'.app_rate_cambio($p['precio'],'smb').'</p>';
								print '<br class="clean" />';									
							print '</div>';
						print '<br class="clean" />';
						print '<p>';
							 print app_texto_salto_html($descripcion_paquete);
						print '</p>';
						print '<div class="divisor"><span class="l"></span><span class="r"></span></div> ';				
					}															
					?>                    
                    </div>
                </div>
            </div>
        </div>
        <?php footer(); ?>
    </body>
</html>