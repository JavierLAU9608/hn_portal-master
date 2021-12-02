<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
    	$personalidades_titulo_traduccion = app_traduccion('frontend','frontend_informacion_idioma','nombre','informacion_fk',$textopresentacion['id'],$textopresentacion['titulo']);
		$personalidades_texto_traduccion = app_traduccion('frontend','frontend_informacion_idioma','descripcion','informacion_fk',$textopresentacion['id'],$textopresentacion['value']);
	?>
	<?php head(array('titulo'=>$personalidades_titulo_traduccion,'description'=>trans('seo_description_personalidades'),'keywords'=>trans('seo_keywords_personalidades'))); ?>
    <body>
        <?php top(array("title"=>$personalidades_titulo_traduccion)); ?>
        <div class="white_bg">
            <div id="body" class="center">
<div id="left_area">
    				<?php modulo_load(); ?>        
        			<div class="divisor"></div>
        			<p class="verdana intro">
            			<?php print trans('texto_left_personalidades'); ?>
            		</p>        
        			<img src="<?php print base_url('images/fotoHistoria.jpg'); ?>" width="295" height="193" />
        			<br class="clean_space"/>
        			<div class="divisor"></div>
        			<span class="headtitle" title="">
                    	<h1>
                        	<?php trans('historia'); ?>
                        </h1>
                    </span>
        			<p class="verdana">
						<?php print $textohome['value']; ?>
        			</p>        
        			<a class="flecha" href="<?php print base_url(trans('ruta_historia')); ?>"><?php print trans('mas_nuestra_historia'); ?></a>
        			<div class="divisor"></div>
        			<?php modulo_load(array('posicion'=>'publicidad_vertical')); ?>
				</div>
                <div id="center_area">               	
                	<p class="verdana intro">
                		<?php print $personalidades_texto_traduccion; ?>
                	</p>
        			<?php
                    $iterador_ano = NULL;
					print '<div id="list_cuadros">';
						foreach($lista_personalidades as $p)
						{							
							$ano_visita = date('Y',strtotime($p['fecha_visita']));							
							if($iterador_ano==NULL || $iterador_ano!==$ano_visita)
							{
								print '<br class="clean_lttl_space" />';
								print '<div class="divisor"><span class="l"></span><span class="r"></span></div>';
								$iterador_ano = $ano_visita;
								print '<p class="verdana">';
									print app_parse(trans('personalidades_texto_anno'),array('anno'=>$iterador_ano));
								print '</p>';								
							}
							print '<div class="verdana fig marg">';
								$url_personalidad = app_parse(trans('ruta_personalidad'),array('slug'=>$p['slug']));
								$desc = $p['descripcion_trad'] != null ? $p['descripcion_trad'] : $p['descripcion'];
								print '<a href="'.base_url($url_personalidad).'">';
									print '<img class="left border" title="'.$p['nombre'].'" src="'.app_url_admin().('/admin/personalidades/thumb-'.$p['imagen']).'" width="119" height="100"/>';
								print '</a>';
								print '<a href="'.base_url($url_personalidad).'"><h2>';
									print $p['nombre'];
								print '</h2></a>';
								print '<br/>';
								print word_limiter(app_strip_etiquetas($desc),13);
							print '</div>';							
						}
					print '</div>';
					print '<br class="clean_space" />';
					print $paginacion;									
			    ?>
				</div>
			</div>
		</div>  
        <?php footer(); ?>
    </body>
</html>