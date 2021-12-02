<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
		$titulo = app_traduccion('frontend','frontend_informacion_idioma','nombre','informacion_fk',$textopresentacion['id'],$textopresentacion['titulo']);
		$texto_presentacion = app_traduccion('frontend','frontend_informacion_idioma','descripcion','informacion_fk',$textopresentacion['id'],$textopresentacion['value']);
    ?>
	<?php head(array('titulo'=>trans('al_alojamiento'),'description'=>trans('seo_description_alojamiento'),'keywords'=>trans('seo_keywords_alojamiento'))); ?>
    <body>
        <?php top(array("title"=>$titulo,"subtitle"=>'')); ?>
        <div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>
                	<?php modulo_load(); ?>
                    <div class="clean_space" ></div>
                    <?php modulo_ofertas(); ?>
                    <?php modulo_load(array('posicion'=>'publicidad_vertical')); ?>
                </div>
                <div id="center_area">
                    <p class="verdana intro">
                        <?php print isset($texto_presentacion)?$texto_presentacion:''; ?>
                    </p>
                    <div class="divisor"><span class="l"></span><span class="r"></span></div>
					<?php
                            print '<div id="list_products">';
							    $i = 0;
                                foreach($lista_alojamientos as $al)
                                {$i++;
                                    $nombre_alojamiento = app_traduccion('hotel','hotel_tipo_hab_idioma','nombre','tipo_habitacion_fk',$al['tipo']['id'],$al['tipo']['nombre_habitacion']);
                                    $slug_alojamiento = 'slug'/*$al['slug'] m kede aki , pidiendo lo de la hab*/;
                                    print '<div class="imagenes">';

										print '<span class="title left">'.trans('al_habitacion').'<h1>';
                                            print $nombre_alojamiento;
                                        print '</h1></span>';
										print ' <div class="precio_reserva right"><p class="verdana">'.trans('al_pax').':</p><span></span><p class="verdana yellow_bg">'.$al['cantidad_pax'].'</p></div>';
                                        print '<div class="clean"></div>';
										print '<a>';
										print '<img title="'.$nombre_alojamiento.'" class="principal" width="305" height="187" src="'.app_url_admin().('/hoteles/habitaciones/detalle-'.$al['imagen']).'"/></a>';
										$class = array('border no_top margen','border no_top','border margen','border');
										$o = 0;
										foreach($al['imagenes'] as $img)
										{
											if($o == 4)break;
											$titulo_imagen = app_traduccion('hotel','hotel_imagenes_idioma','nombre','imagen_fk',$img['id'],$img['descripcion']);
											print '<img class="border" alt="'.$titulo_imagen.'"  title="'.$titulo_imagen.'"  width="113" height="80" src="'.app_url_admin().'/'.($this->ruta_galeria.'thumb-'.$img['url']).'"/>';
											$o++;
										}
										while($o < 4)
										{
											print '<img class="border" width="113" height="80" src="'.base_url('images/thumb-padd.jpg').'" />';$o++;
										}
										 $descripcio_alojamiento = app_traduccion('hotel','hotel_habitacion_hotel_idioma','nombre','habitacion_hotel_fk',$al['id_ocupacion'],$al['presentacion']);
										print '<div class="clean_lttl_space"></div>';
                                        print '<p class="verdana">'.word_limiter($descripcio_alojamiento,30).'</p>';
										if(sizeof($al['facilidades']) > 0)
										{
											print '<br class="clean_lttl_space" />';
											print '<div id="hidden-'.$i.'" style="display:none;">';
												print '<div class="title_list">'.trans('al_facilidades_title').'</div>';
												print '<ul class="sub_list gray verdana">';
												foreach($al['facilidades'] as $facilidad)
												{
													print '<li>'.$facilidad['nombre'].'</li>';
												}
												print '</ul>';
												print '<br class="clean_lttl_space" />';print '<br class="clean_lttl_space" />';
											print '</div>';
											print '<a id="tog-'.$i.'" class="toggle" title="'.trans('al_facilidades').'" data-pick="'.trans('al_recoger').'" ><span>'.trans('al_facilidades').'</span><span class="fl"></span></a>';
										}
										print '<div class="clean_lttl_space"></div>';
                						print '<div class="precio_reserva">';
											print '<p class="verdana">'.trans('al_precio').':</p>';
											print '<span></span>';
											print '<p class="verdana yellow_bg">'.$al['precio'].'</p>';
                                                                                        if ($al['disponible'] == 't' && (int)$al['precio'] > 0) {
                                                                                            print '<a class="buttom roman" href="'.trans('ruta_reservar_alojamiento_habitacion',array('nombre'=>url_title($nombre_alojamiento),'id'=>$al['tipo_habitacion_fk'])).'" >'.trans('reservar').'</a>';
                                                                                        }
											print '<br class="clean_lttl_space" />';
										print '</div>';
                                    print '</div>';
									print '<div class="divisor"><span class="l"></span><span class="r"></span></div>';
                                }
                            print '</div>';

							print '<br class="clean_space" />';
							print $paginacion;
                    ?>
                </div>
            </div>
        </div>
        <?php footer(array('carrucel_publicidad'=>true)); ?>
        <script type="text/javascript" language="javascript">
		</script>
    </body>
</html>