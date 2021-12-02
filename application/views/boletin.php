<?php
if(sizeof($ofertas)>0)
{
	print '<fieldset>';
		print '<legend>';
			print '<h2>'.trans('of_ofertas_especiales').'</h2>';
		print '</legend>';
		foreach($ofertas as $o)
		{
			$o_t = app_traduccion('oferta','oferta_idioma',NULL,'oferta_fk',$o['id'],$o);
			print '<div>';
				print '<h3>';
					print '<a style="text-decoration:none" href="'.base_url(trans('ruta_oferta',array('nombre'=>url_title($o_t['nombre']),'id'=>$o['id']))).'">';
						print $o_t['nombre'];
					print '</a>';
				print '</h3>';
				print '<p>';
					if(!$o['imagen']=='' || !$o['imagen']==NULL)
					{
						print '<img title="'.$o_t['nombre'].'" style="float:left;margin:3px;" src="'.app_imagen_base64('oferta/thumb-'.$o['imagen']).'" height="80" />';
					}
					if($o_t['fecha_fin'])
					{
						print '<h4 style="text-transform:capitalize">';						
							print trans('fecha_rango',array('inicio'=>app_str_date($o_t['fecha_inicio']),'final'=>app_str_date($o_t['fecha_fin'])));
						print '</h4>';
					}
					print word_limiter(app_strip_etiquetas($o_t['descripcion']),8);
				print '</p>';
				
			print '</div>';
			print '<div style="clear:both"></div>';
		}
	print '</fieldset>';
}
if(sizeof($noticias)>0)
{
	print '<fieldset>';
		print '<legend>';
			print '<h2>'.trans('noticias').'</h2>';
		print '</legend>';
		foreach($noticias as $n)
		{
			$n_t = app_traduccion('frontend','frontend_noticia_idioma',NULL,'noticia_fk',$n['id'],$n);
			print '<div style="clear:both">';
				print '<h3>';
					print '<a style="text-decoration:none" href="'.base_url(trans('ruta_noticia',array('titulo'=>url_title($n_t['titulo']),'id'=>$n['id']))).'">';
						print $n_t['titulo'];
					print '</a>';
				print '</h3>';
				print '<p>';
					if($n['imagen']!=='')
					{
						print '<img title="'.$n['titulo'].'" src="'.app_imagen_base64('admin/noticia/thumb-'.$n['imagen']).'" style="float:left;margin:3px" height="80"/>';
					}
					print $n_t['description'];
				print '</p>';
			print '</div>';
		}
	print '</fieldset>';
}
?>