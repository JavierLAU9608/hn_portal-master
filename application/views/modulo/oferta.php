<div id="area_ofertas" class="hidden-phone hidden-tablet">
    <span class="headtitle" title=""><h1><?php print trans('of_ofertas_especiales'); ?></h1></span>
    <ul id="ofertas_carrousel" class="jcarousel-skin-tango">
    <?php
		$total_ofertas = sizeof($ofertas_especiales);
		for($i=0;$i<$total_ofertas;)
		{
			$oferta_top = $ofertas_especiales[$i];
			$oferta_trans = app_traduccion('oferta','oferta_idioma',NULL,'oferta_fk',$oferta_top['id'],$oferta_top);
			$oferta_trans['descripcion'] = app_strip_salto($oferta_trans['descripcion']);
			$oferta_nombre = $oferta_trans['nombre'];
			print '<li>';
				print '<a href="'.trans('ruta_oferta',array('nombre'=>url_title($oferta_nombre),'id'=>$oferta_top['id'])).'" title="'.$oferta_nombre.'" id="subtitle">';
					print word_limiter($oferta_nombre,7);
				print '</a>';
				print '<br/>';
				$con_precio = ($oferta_top['precio'] != 0)?'left con_precio':'';
				$cant_words = ($oferta_top['precio'] != 0)?9:17;
				print '<p class="verdana '.$con_precio.'" >';
					print '<span>';
						print trans('del').' '.app_str_date($oferta_top['fecha_inicio']);
						if($oferta_top['fecha_fin'])
							print ' '.trans('al').' '.app_str_date($oferta_top['fecha_fin']);
					print '</span>';print '<br/>';
					print word_limiter($oferta_trans['descripcion'],$cant_words);
				print '</p>';
				if($oferta_top['precio'] != 0)
					print '<div class="right precio_reserva"><span></span><p class="verdana yellow_bg">'.app_rate_cambio($oferta_top['precio'],'smb').'</p></div><br class="clean"/>';
			if(isset($ofertas_especiales[$i+1]))
			{
				$oferta_bott = $ofertas_especiales[$i+1];
				$oferta_trans = app_traduccion('oferta','oferta_idioma',NULL,'oferta_fk',$oferta_bott['id'],$oferta_bott);
				$oferta_nombre = $oferta_trans['nombre'];
				print '<a href="'.trans('ruta_oferta',array('nombre'=>url_title($oferta_nombre),'id'=>$oferta_bott['id'])).'" title="'.$oferta_nombre.'" id="subtitle">';
					print word_limiter($oferta_nombre,7);
				print '</a>';
				print '<br/>';
				$con_precio = ($oferta_bott['precio'] != 0)?'left con_precio':'';
				$cant_words = ($oferta_bott['precio'] != 0)?9:17;
				print '<p class="verdana '.$con_precio.'" >';
					print '<span>';
						print trans('del').' '.app_str_date($oferta_bott['fecha_inicio']).' ';
						if($oferta_bott['fecha_fin'])
							print trans('al').' '.app_str_date($oferta_bott['fecha_fin']);
					print '</span>';print '<br/>';
					print word_limiter($oferta_trans['descripcion'],$cant_words);
				print '</p>';
				if($oferta_bott['precio'] != 0)
					print '<div class="right precio_reserva"><span></span><p class="verdana yellow_bg">'.app_rate_cambio($oferta_bott['precio'],'smb').'</p></div><br class="clean"/>';
			}
			print '</li>';
			$i=$i+2;
		}
	?>
	</ul>
    <a class="flecha" href="<?php print trans('ruta_ofertas'); ?>"><?php print trans('of_todas_nuestras_ofertas'); ?></a>
</div>