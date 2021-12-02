<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
		$titulo = app_traduccion('frontend','frontend_informacion_idioma','nombre','informacion_fk',$textopresentacion['id'],$textopresentacion['titulo']);
		$texto_presentacion = app_traduccion('frontend','frontend_informacion_idioma','descripcion','informacion_fk',$textopresentacion['id'],$textopresentacion['value']);
		if(isset($tipo_oferta) && $tipo_oferta['descripcion'])
		{
			$texto_presentacion = $tipo_oferta['descripcion'];
		}
    ?>
	<?php head(array('titulo'=>$titulo.(isset($tipo_oferta['nombre'])?' - '.$tipo_oferta['nombre']:''),'description'=>trans('seo_description_ofertas'),'keywords'=>trans('seo_keywords_ofertas'))); ?>
    <body>
        <?php top(array('title'=>$titulo,'subtitle'=>$sub_titulo)); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                   <?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>
               	   <?php modulo_load(); ?>
                   <?php modulo_load(array('posicion'=>'publicidad_vertical')); ?>      
                </div>
                <div id="center_area">
                    <p class="verdana intro">
                        <?php print isset($texto_presentacion)?$texto_presentacion:''; ?>
                    </p>
                    <div class="divisor"><span class="l"></span><span class="r"></span></div>
        	        <?php
						if(sizeof($lista_ofertas)>0)
						{
								
							print '<div id="list_products">';			
								foreach($lista_ofertas as $o)
								{
									$o_t = app_traduccion('oferta','oferta_idioma',NULL,'oferta_fk',$o['id'],$o);
									print '<div class="offert_prod">';
										print '<a class="title large" href="'.trans('ruta_oferta',array('nombre'=>url_title($o_t['nombre']),'id'=>$o['id'])).'">';
											print '<h1>'.$o_t['nombre'].'</h1>';
										print '</a>';
										print '<p class="verdana">';
										if($o['imagen'] != '')
										{
										    print '<img title="'.$o_t['nombre'].'" class="left" src="'.app_url_admin().('/oferta/listado-'.$o['imagen']).'"/>';
										}
											print word_limiter(app_strip_etiquetas($o_t['descripcion']),20);
										print '</p>';
										print '<br class="clean" />';										
										print '<a class=" flecha" href="'.trans('ruta_oferta',array('nombre'=>url_title($o_t['nombre']),'id'=>$o['id'])).'">'.trans('of_conocer_oferta').'</a>';
										print '<div class="clean_lttl_space"></div>';
										if( $o['precio'] != '' && $o['precio'] != 0   )
										{
										print '<div class="precio_reserva">';
											print '<p class="verdana">'.trans('of_precio').':</p>';
											print '<span></span>';
											print '<p class="verdana yellow_bg">'.app_rate_cambio($o['precio'],'smb').'</p>';											
											print '<a class="buttom roman" href="'.base_url(trans('ruta_reservar_oferta',array('id_oferta'=>$o['id']))).'" >'.trans('of_reservar').'</a>';
											print '<br class="clean" />';									
										print '</div>';	
										}
									
									print '</div>';
											
									print '<div class="divisor"><span class="l"></span><span class="r"></span></div>';		
								}								
								print $paginacion;
							print '</div>';
						}
						else
						{
							print '<div class="form_msg  verdana">';
								print trans('error_no_se_encontraron_elementos');
							print '</div>';
						}
			     	?>
                </div>
            </div>
        </div>  
        <?php footer(array('carrucel_publicidad'=>true)); ?>
    </body>
</html>