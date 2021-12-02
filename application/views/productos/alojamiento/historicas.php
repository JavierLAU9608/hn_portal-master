<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
		$titulo = app_traduccion('frontend','frontend_informacion_idioma','nombre','informacion_fk',$textopresentacion['id'],$textopresentacion['titulo']);
		$texto_presentacion = app_traduccion('frontend','frontend_informacion_idioma','descripcion','informacion_fk',$textopresentacion['id'],$textopresentacion['value']);
    ?>
	<?php head(array('titulo'=>$titulo,'description'=>$texto_presentacion,'keywords'=>trans('seo_keywords_alojamiento'))); ?>
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
					<div id="list_cuadros" class="historicas">
                    <?php
					$i = 0;$c=0;
					foreach($lista_hab_historicas as $hab)
					{						
						$hab_trans = app_traduccion('public','public_habper_idioma',NULL,'habper_fk',$hab['id'],$hab);
						print '<div class="verdana fig marg">';							
							print '<div class="sello golden left"><p>'.$hab['numero_habitacion'].'</p></div>';
							print '<h2 class="larg">';
								print $hab_trans['nombre'].'</p>';
							print '</h2>';
							print '<br/>';
							if($hab['personalidades_asociadas'])
							{
								foreach($hab['personalidades_asociadas'] as $p)
								{
									print '<br/>';
									print '<a href="'.base_url(trans('ruta_personalidad',array('slug'=>$p['slug']))).'">';
										print $p['nombre'];
									print '</a>';									
								}
							}
							$description_hab = app_strip_etiquetas($hab_trans['descripcion']);							
							$cutted  = word_limiter($description_hab,7,'...',true);
							if(isset($cutted[0]) && $cutted[0])
							{
								print '<p id="cut-'.$i.'" >'.$cutted[1].'</p>';
								print '<p id="hidden-'.$i.'" class="hidden">'.$description_hab.'</p>';
							    print '<a id="togcut-'.$i.'" class="toggle" title="'.trans('al_leer_mas').'" data-pick="'.trans('al_recoger').'" ><span class="roman">'.trans('al_leer_mas').'</span><span class="fl"></span></a>';
							}
							else
							{
								print '<p>'.$description_hab.'</p>';
							}													
						print '</div>';
						$c++;
						if($c == 2)
						{
							$c = 0;	
							print '<div class="clean_lttl_space"></div>';
						}
						$i++;						
					}															
					?> 
                    <br class="clean"/>
                    <div class="divisor"><span class="l"></span><span class="r"></span></div>                  
                    </div>
                </div>
            </div>
        </div>
        <?php footer(); ?>
    </body>
</html>