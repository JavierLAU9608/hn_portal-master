<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
		$titulo = app_traduccion('frontend','frontend_informacion_idioma','nombre','informacion_fk',$textopresentacion['id'],$textopresentacion['titulo']);
		$texto_presentacion = app_traduccion('frontend','frontend_informacion_idioma','descripcion','informacion_fk',$textopresentacion['id'],$textopresentacion['value']);
    ?>
	<?php head(array('titulo'=>$titulo,'description'=>trans('seo_description_bares'),'keywords'=>trans('seo_keywords_bares'))); ?>
    <body>
        <?php top(array('title'=>$titulo)); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                    <?php modulo_load(); ?>
                    <?php modulo_load(array('posicion'=>'publicidad_vertical')); ?>     
                </div>
                <div id="center_area">
                    <p class="verdana intro">
                        <?php print isset($texto_presentacion)?$texto_presentacion:''; ?>
                    </p>
                    <div class="divisor"><span class="l"></span><span class="r"></span></div>
        	        <?php
						if(sizeof($lista_bares)>0)
						{	
							print '<div id="list_products">';
										
								foreach($lista_bares as $b)
								{
									$url_bar = base_url(trans('ruta_bar',array('slug'=>$b['slug'])));
									$url_bar_menus = base_url(trans('ruta_bar_menus',array('slug'=>$b['slug'])));
									$nombre_bar = $b['nombre'];
									$descripcion = app_traduccion('bar','bar_idioma','descripcion','bar_fk',$b['id'],$b['descripcion']);
									print '<div class="imagenes">';									
										print '<a class="title left" href="'.$url_bar.'">';
											print '<h1>';
												print trans('br_bar_nombre',array('nombre'=>$nombre_bar));
											print '</h1>';
										print '</a>';
										print '<div class="clean"></div>';
										print '<a href="'.$url_bar.'" style="margin-right:15px"><img title="'.$nombre_bar.'" alt="'.$nombre_bar.'" class="principal" width="305" height="187" src="'.app_url_admin().('/bar/detalle-'.$b['imagen']).'"/></a>';
										$o = 0;
										foreach($b['imagenes'] as $i)
										{
											if($o == 4)break;
											$titulo_imagen = app_traduccion('hotel','hotel_imagenes_idioma','nombre','imagen_fk',$i['imagen_fk'],$i['descripcion']);
											print '<img title="'.$titulo_imagen.'" alt="'.$titulo_imagen.'" class="border" width="113" height="80" src="'.app_url_admin().'/'.($this->ruta_galeria.'thumb-'.$i['url']).'"/>';
											$o++;
										}
										while($o < 4)
										{
											print '<img class="border" width="113" height="80" src="'.base_url('images/thumb-padd.jpg').'" />';$o++;
										}
										
										print '<div class="clean_lttl_space"></div>';
										print '<p class="verdana">'.word_limiter($descripcion,30).'</p>';
										print '<br class="clean_lttl_space" />';
										/*
										print '<a href="'.$url_bar_menus.'" class=" flecha">'.trans('br_ver_bar').'</a>';
										print '<div class="clean_lttl_space"></div>';
										print '<div class="precio_reserva">';										   
											print '<p class="verdana">'.trans('precio_desde').':</p>';
											print '<span></span>';
											print '<p class="verdana yellow_bg">'.app_rate_cambio($b['menor_precio'],'smb').'</p>';											
											print '<a class="buttom roman" href="'.trans('ruta_reservar_bar',array('slug'=>$b['slug'])).'" >'.trans('reservar').'</a>';
											print '<br class="clean_lttl_space" />';
										print '</div>';*/								
									print '</div>';
									
									print '<div class="divisor"><span class="l"></span><span class="r"></span></div>';													
								}					
								print '<br class="clean_space" />';
								print $paginacion;
							print '</ol>';
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