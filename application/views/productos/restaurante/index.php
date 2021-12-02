<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
		$titulo = app_traduccion('frontend','frontend_informacion_idioma','nombre','informacion_fk',$textopresentacion['id'],$textopresentacion['titulo']);
		$texto_presentacion = app_traduccion('frontend','frontend_informacion_idioma','descripcion','informacion_fk',$textopresentacion['id'],$textopresentacion['value']);
    ?>
	<?php head(array('titulo'=>$titulo,'description'=>trans('seo_description_restaurantes'),'keywords'=>trans('seo_keywords_restaurantes'))); ?>
    <body>
        <?php top(array("title"=>$titulo,"subtitle"=>'')); ?>
        <div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
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
					<?php                    
                            print '<div id="list_products">';
                                foreach($lista_restaurantes as $r)
                                {
                                    $r_trans = app_traduccion('restaurante','restaurante_idioma_rest',NULL,'restaurante_fk',$r['id'],$r);	
									$nombre_restaurante = $r_trans['nombre'];
                                    $slug_restaurante = $r['slug'];
                                    print '<div class="imagenes">';	
										$tipo = app_traduccion('restaurante','restaurante_tipo_idioma','nombre','tipo_fk',$r['tipo']['id'],$r['tipo']['nombre']);
																	  
                                        $url_restaurante = app_parse(trans('ruta_restaurante'),array('slug'=>$slug_restaurante));
										print '<a class="title left" href="'.base_url($url_restaurante).'">'.trans('rt_restaurante').' '.$tipo.'<h1>';
                                            print $nombre_restaurante;
                                        print '</h1></a>';
										print ' <div class="precio_reserva right"><p class="verdana">'.trans('rt_cantidad_personas').':</p><span></span><p class="verdana yellow_bg">'.$r['cantidad_persona'].'</p></div>';
                                        print '<div class="clean"></div>';
										print '<a href="'.base_url($url_restaurante).'">';
										print '<img title="'.$nombre_restaurante.'" alt="'.$nombre_restaurante.'"  class="principal" width="305" height="187" src="'.app_url_admin().('/restaurante/detalle-'.$r['imagen']).'"/></a>';
										 
										$o = 0;
										foreach($r['imagenes'] as $img)
										{
											if($o == 4)break;
											$titulo_imagen = app_traduccion('hotel','hotel_imagenes_idioma','nombre','imagen_fk',$img['id'],$img['descripcion']);
											print '<img class="border" title="'.$titulo_imagen.'" alt="'.$titulo_imagen.'"  width="113" height="80" src="'.app_url_admin().'/'.($this->ruta_galeria.'thumb-'.$img['url']).'"/>';
											$o++;
										}
										while($o < 4)
										{
											print '<img class="border" width="113" height="80" src="'.base_url('images/thumb-padd.jpg').'" />';$o++;
										}
										print '<div class="clean_lttl_space"></div>';
                                        print '<p class="verdana">'.word_limiter($r_trans['descripcion'],30).'</p>';
										print '<br class="clean_lttl_space" />';
										print '<a class=" flecha" href="'.base_url(trans('ruta_restaurante-menus',array("slug"=>$r['slug']))).'">'.trans('rt_ver_menu').'</a>';
										print '<div class="clean_lttl_space"></div>';
										print '<div class="precio_reserva">';
										    if(isset($r['precio'])){
											print '<p class="verdana">'.trans('precio_desde').':</p>';
											print '<span></span>';
											print '<p class="verdana yellow_bg">'.$r['precio'].'</p>';
											}
											print '<a class="buttom roman" href="'.base_url(trans('ruta_reservar_restaurante',array('slug'=>$r['slug']))).'" >'.trans('reservar').'</a>';
											print '<br class="clean_lttl_space" />';
										print '</div>';
                						
                                    print '</div>';
									print '<div class="divisor"><span class="l"></span><span class="r"></span></div>';
                                }
                            print '</div>';                      
						print $paginacion;
                    ?>
                </div>
            </div>
        </div>
        <?php footer(array('carrucel_publicidad'=>true)); ?>
                <script type="text/javascript" language="javascript">
			$(".pagination ul li a").click(function(e){
				e.preventDefault();
				var cur_page = $(this).attr("href");
				cur_page = cur_page.replace("/","");		
				$("#current_page").val(cur_page);		
				$(".form_pagination").submit();
			});
		</script>
    </body>
</html>