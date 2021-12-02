<!DOCTYPE html>
<?php
$description = app_traduccion('bar','bar_idioma','description','bar_fk',$bar['id'],$bar['description']);
$keywords = app_traduccion('bar','bar_idioma','keywords','bar_fk',$bar['id'],$bar['keywords']);
$descripcion = app_traduccion('bar','bar_idioma','descripcion','bar_fk',$bar['id'],$bar['descripcion']);
?>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>'Bar: '.$bar['nombre'],'description'=>$description,'keywords'=>$keywords)); ?>
    <body>
        <?php top(array('title'=>trans('br_bar_nombre',array('nombre'=>$bar['nombre'])),'subtitle'=>trans('br_menus'))); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                	<?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>
                    <?php modulo_load(); ?>
                </div>
                <div id="center_area">
                    <?php
					foreach($bar['menus'] as $m)
					{
						$menu_traducido = app_traduccion('bar','bar_menu_idioma',NULL,'menu_fk',$m['id'],$m);
						print '<div class="rt_menu_larg">';
							
								print '<h2 class="trecho">'.$menu_traducido['nombre'].'</h2>';
								
								print '<p class="verdana">';
									print $menu_traducido['descripcion'];
								print '</p>';
								if(sizeof($m['tarifas']) > 0){	
								print '<br class="clean_lttl_space" />';				
								print '<p class="verdana"><b>'.trans('br_precio_por_duracion').':</b></p>';	}
								
								foreach($m['tarifas'] as $t)
								{
									$duracion = app_traduccion('bar','bar_menup_idioma',NULL,'precio_fk',$t['id'],$t['duracion']);
									
									print '<div class="precio_reserva">';	
											print '<p class="verdana min_ancho">'.$duracion.':</p>';
											print '<span></span>';
											print '<p class="verdana yellow_bg">'.app_rate_cambio($t['precio'],'smb').'</p>';
											print '<p class="verdana margen_l">'.trans('br_precio_hora_extra').':</p>';
											print '<span></span>';
											print '<p class="verdana yellow_bg">'.app_rate_cambio($t['precio_extra'],'smb').'</p>';
									print '</div>';
									print '<br class="clean_lttl_space" />';									
								}
							
						print '<div class="clean_lttl_space"></div>';
						print '<div class="divisor"></div>'; 
						print '</div>';						
					}
					?>
                </div>
            </div> 
        </div>   
        <?php footer(); ?>
    </body>
</html>