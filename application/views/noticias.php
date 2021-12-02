<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('noticias'),'description'=>trans('seo_description_noticias'),'keywords'=>trans('seo_keywords_noticias'))); ?>
    <body>
    <?php top(array('title'=>trans('noticias'))); ?>
<div class="white_bg">
    <div id="body" class="center">
    <div id="left_area">
    		<?php modulo_load(); ?>        
        	<div class="divisor"></div>
      </div>
       <div id="center_area">               
        	<?php
				if(sizeof($lista_noticias)>0)
				{
					print '<div id="list_cuadros">';
						foreach($lista_noticias as $n)
						{
							$noticia_trans = app_traduccion('frontend','frontend_noticia_idioma',NULL,'noticia_fk',$n['id'],$n);
							print '<div class="verdana fig marg">';
								$url_noticia = app_parse(trans('ruta_noticia'),array('titulo'=>url_title($noticia_trans['titulo']),'id'=>$n['id']));
								print '<a href="'.base_url($url_noticia).'">';
									print '<img title="'.$noticia_trans['titulo'].'" src="'.app_url_admin().('/admin/noticia/thumb-'.$n['imagen']).'" class="left border" class="113" height="80"/>';
								print '</a>';
								print '<a href="'.base_url($url_noticia).'"><h2>';
									print $noticia_trans['titulo'];
								print '</h2></a>';
								print '<br/>';
								print word_limiter($noticia_trans['texto'],30);
							print '</div>';
						}
					print '</div>';
					print '<br style="clear:both"/>';
				print $paginacion;
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
        <?php footer(); ?>
        <script type="text/javascript" language="javascript">
		</script>
    </body>
</html>