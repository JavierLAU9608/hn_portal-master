<?php
if(sizeof($modulos)>0)
{
	print '<div class="info_footer2">';
		foreach($modulos as $m)
		{
			$m_trad = app_traduccion('frontend','frontend_modulo_idioma',NULL,'modulo_fk',$m['modulo_fk'],$m);
			print '<div class="blok">';
				print '<div class="info white">';
					print $m_trad['nombre'];
					print '<span>';
						print $m_trad['sub_titulos'];
						print '<br/>';
					print '</span>';
					print $m_trad['descripcion'];
				print '</div>';
				print '<img src="'.app_url_admin().('/admin/modulos/reconocimiento-'.$m['imagen']).'" width="61" height="63" />';
			print '</div>';
			print '<hr/>';
		}
		print '<img src="'.base_url('images/logcuba.jpg').'" width="54" height="62" class="imagen_fot"/>';
		print '<img src="'.base_url('images/escudo.jpg').'" width="47" height="61" class="imagen_fot"/>';
		print '<img src="'.base_url('images/mintur-autentica-cuba.png').'" width="47" height="61" class="imagen_fot"/>';
		print '<img src="'.base_url('images/mintur-logo.png').'" width="100" height="61" class="imagen_fot"/>';
	print '</div>';
}
?>