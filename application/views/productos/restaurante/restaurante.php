<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
	    $restaurante_trans = app_traduccion('restaurante','restaurante_idioma_rest',NULL,'restaurante_fk',$restaurante['id'],$restaurante);
		$titulo = trans('rt_restaurante_nombre',array('nombre'=>$restaurante_trans['nombre']));
		
		$tipo = app_traduccion('restaurante','restaurante_tipo_idioma','nombre','tipo_fk',$tipo['id'],$tipo['nombre']);	
		$subtitle = ($view == 'open')?trans('rt_restaurante').' '.$tipo:trans('rt_restaurante_menu');
		$texto_presentacion = $restaurante_trans['descripcion'];
	?>
	<?php head(array('titulo'=>$titulo,'description'=>trans('seo_description_restaurantes'),'keywords'=>trans('seo_keywords_restaurantes')));?>
    <body>

        <div class="white_bg" style="padding-top: 200px">
            <div id="body" class="center">
            	<div id="left_area">
                	<div class="menu golden_bg">
                        <ul>
                          <li><a href="<?php print base_url(trans('ruta_restaurante',array("slug"=>$restaurante['slug'])));?>"  class="<?php print $active_link[0];?>"><?php print trans('rt_restaurante'); ?></a></li>
                          <li><a href="<?php print base_url(trans('ruta_restaurante-menus',array("slug"=>$restaurante['slug'])));?>" class="<?php print $active_link[1];?>"><?php print trans('rt_restaurante_menu'); ?></a></li>
                        </ul>
                    </div>
<!--                	--><?php //modulo_load(); ?>
<!--                    <div class="clean_space" ></div>-->
<!--                    --><?php //modulo_ofertas(); ?><!--                    -->
                </div>
                <div id="center_area">
                    <?php 
					if($view == 'open')
					{
					?>
                    <p class="verdana intro">
                        <?php  print $texto_presentacion; ?>
                    </p>
                    <div class="divisor"><span class="l"></span><span class="r"></span></div>
                     <div class="list_imagenes">
                        <ul class="images_carrousel jcarousel-skin-tango" >
                        <?php					   
                           print '<li><img class="border" title="'.$titulo.'" alt="'.$titulo.'"  width="180" height="129" src="'.app_url_admin().'/'.('restaurante/detalle-'.$restaurante['imagen']).'"/></li>';
						   $r = 0;
						   foreach($imagenes as $imagen){
							   $titulo_imagen = app_traduccion('hotel','hotel_imagenes_idioma','nombre','imagen_fk',$imagen['id'],$imagen['descripcion']);
                           print '<li><img class="border" title="'.$titulo_imagen.'" alt="'.$titulo_imagen.'"  width="180" height="129" src="'.app_url_admin().'/'.($this->ruta_galeria.'galeria-'.$imagen['url']).'"/></li>';
						   $r++;
						   }						
						  while($r < 2)
						  {
						     print '<li><img class="border"  width="180" height="129" src="'.base_url('images/thumb-padd2.jpg').'" /></li>'; $r++;
						  }   
						   
						?>
                        </ul>
                    </div>        
					<div class="clean_space"></div>
                    <?php  
					print ' <div class="precio_reserva right"><p class="verdana">'.trans('rt_cantidad_personas').':</p><span></span><p class="verdana yellow_bg">'.$restaurante['cantidad_persona'].'</p></div>';
					print '<br class="clean" /><br/>';
					?>
                    <?php
					}
					?>
                    <?php 
					if($view == 'menu' && isset($menus) && sizeof($menus) > 0)
					{
						$hidden = (sizeof($menus) > 4)?'style="display: none1"':'';
						$ver_tog = (sizeof($menus) > 4)?trans('rt_ver'):trans('rt_recoger');
						$clase_lnk_tog = (sizeof($menus) > 4)?'':'pickup';						
						
						$i = 0;
						foreach($menus as $menu)
						{	
							$menu_trans = app_traduccion('restaurante','restaurante_menu_idioma','nombre','menu_fk',$menu['id'],$menu['nombre']);					
							
							print '<div class="rt_menu_larg">';
							   $recomended = ($menu['recomendado'] == 't')?'recomendado':''; 
							  print '<h2 class="left"><span class="left">'.$menu_trans.'</span>';
							  print ($recomended == 'recomendado')?'<img class="right" src="'.base_url('images/recomendado.png').'"/>':'';
							  print '</h2>';
							  print '<div class="precio_reserva right">';							    
								if(isset($menu['precio'])){
									print '<p class="verdana">'.trans('rt_precio_por_pax').':</p>';
									print '<span></span>';
									print '<p class="verdana yellow_bg">'.$menu['precio'].'</p>';									
								}								
							  print '</div><br class="clean" />';							  
							 
							  print '<div  id="hidden-'.$i.'" class="verdana "'.$hidden.'>';
							  print '<br class="clean_lttl_space" />';
							  foreach($menu['platos'] as $p)
							  {
								  if(is_array($p))
								  {
								  $tipo_plato_traduccion = app_traduccion('restaurante','restaurante_tipop_idioma','nombre','tipo_plato_fk',$p[0]['id_tipo_plato'],$p[0]['nombre_tipo_plato']);
									  print '<h3>'.$tipo_plato_traduccion.':</h3>';
									  foreach($p as $o)
									  {	
										  $plato_traduccion = app_traduccion('restaurante','restaurante_plato_idioma','nombre','plato_fk',$o['id_plato'],$o['nombre_plato']);										
										  print '<span>'.($o['cantidad']>1?$o['cantidad'].' ':'').$plato_traduccion.'</span><br/>';
									  }
								  }
								  else
								  {
									  print '<span>'.$p.'</span>';
									  print '<br/>';
								  }
							  }
							  /*$id_tipo_plato_ant = ''; $id_tipo_comida_ant = '';
							  	foreach($menu['list_platos'] as $plato)
								{
									if($id_tipo_plato_ant != $plato['id_tipo_plato'] && $plato['id_tipo_plato'] != '' )
										print '<h3>'.$plato['nombre_tipo_plato'].':</h3>';
							  		print '<span>'.$plato['nombre_plato'].'</span><br/>';
									$id_tipo_plato_ant = $plato['id_tipo_plato'];									
								}	*/						  							  							  
							  print '</div>';
							  print '<br class="clean_lttl_space" />';								  
							  print '<a id="tog-'.$i.'" class="toggle '.$clase_lnk_tog.'" title="'.trans('rt_ver').'" data-pick="'.trans('rt_recoger').'" ><span>'.$ver_tog.'</span><span class="fl"></span></a>';
							print '<br class="clean" /><br/>';  
							print '</div>';	
							$i++;						
							
						}
						
					}
					if($restaurante['menor_precio']>0)
						{
							print '<div class="divisor"><span class="l"></span><span class="r"></span></div>';		
							print '<div class="precio_reserva">';
								print '<p class="verdana">'.trans('precio_desde').':</p>';
								print '<span></span>';
								print '<p class="verdana yellow_bg">'.app_rate_cambio($restaurante['menor_precio'],'smb').'</p>';											
								print '<a class="buttom roman" href="'.base_url(trans('ruta_reservar_restaurante',array('slug'=>$restaurante['slug']))).'" >'.trans('reservar').'</a>';
								print '<br class="clean" />';									
							print '</div>';
						}
					?>
                    <div class="clean_lttl_space"></div>
                    
               </div>
            </div>
        </div>     
        <?php footer(); ?>
    </body>
</html>