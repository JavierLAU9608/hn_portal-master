<?php
if(sizeof($modulos)>0)
{
	print '<div id="footer_carousel">';
		print '<ul id="modulos_carrousel" class="jcarousel-skin-tango" >';
			foreach($modulos as $m)
			{
				$m_trad = app_traduccion('frontend','frontend_modulo_idioma',NULL,'modulo_fk',$m['modulo_fk'],$m);                         
				print '<li>';
					print '<a class="title" '.($m['url']?'href="'.$m['url'].'"':'').' >';
						print '<h1>';
							print $m_trad['nombre'];
						print '</h1>';
						print $m_trad['sub_titulos'];
					print '</a>';
					print '<img src="'.app_url_admin().('/admin/modulos/pubslide-'.$m['imagen']).'" width="302" height="137" class="border" />';
					print '<div class="info">';
						print word_limiter($m_trad['descripcion'],45);
						$links = $m['links'];
						if(sizeof($links)>0)
						{
							print '<ul>';
								foreach($links as $l)
								{
									print '<li>';
										print '<a href="'.$l['url'].'">';
											print $l['nombre'];
										print '</a>';
									print '</li>';
								}
							print '</ul>';
						}
					print '</div>';           
				 print '</li>';
			}
		print '</ul> ';
	print '</div>';
}
?>