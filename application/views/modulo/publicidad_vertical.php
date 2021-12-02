<?php
if(sizeof($modulos)>0)
{
	print '<div id="vertical_mod_carrousel" class="golden_bg" >';
		print '<ul id="modulos_carrousel" class="jcarousel-skin-tango" >';
			foreach($modulos as $m)
			{                         
				print '<li>';
					if($m['url']!=='') {
						print '<a href="'.$m['url'].'" class="title">';
					}
					print '<span class="title">';

					print '<h1>';
					print $m['nombre'];
					print '</h1>';
					print $m['sub_titulos'];
					print '</span>';
					print '<img src="'.app_url_admin().('/admin/modulos/pubslide-'.$m['imagen']).'" width="302" height="137" class="border" />';

					if($m['url']!=='') {
						print '</a>';
					}
				 print '</li>';
			}
		print '</ul> ';
	print '</div>';
}
?>