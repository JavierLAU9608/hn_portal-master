<!DOCTYPE html>
<?php
$bar_traducido = app_traduccion('bar','bar_idioma',NULL,'bar_fk',$bar['id'],$bar);
$description = $bar_traducido['description'];
$keywords = $bar_traducido['keywords'];
$descripcion = $bar_traducido['descripcion'];
?>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('br_bar_nombre',array('nombre'=>$bar['nombre'])),'description'=>$description,'keywords'=>$keywords)); ?>
    <body>
        <?php top(array('title'=>trans('br_bar_nombre',array('nombre'=>$bar['nombre'])))); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                	<?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>
                    <?php modulo_load(); ?>
                </div>
                <div id="center_area">
                    <?php
                        print '<p class="verdana intro">'.$descripcion.'</p>';
                    ?>
                    <div class="divisor"><span class="l"></span><span class="r"></span></div>
                    <div class="list_imagenes">
                        <ul class="images_carrousel jcarousel-skin-tango" >
                        <?php			   
                           foreach($bar['imagenes'] as $i)
						   {				   
							   $titulo_imagen = app_traduccion('hotel','hotel_imagenes_idioma','nombre','imagen_fk',$i['imagen_fk'],$i['descripcion']);
						    	print '<li>';
									print '<img title="'.$titulo_imagen.'" alt="'.$titulo_imagen.'" class="border" src="'.app_url_admin().'/'.($this->ruta_galeria.'galeria-'.$i['url']).'"/>';
								print '</li>';  
						   }                           
                        ?>
                        </ul>
                    </div>
                </div>
            </div> 
        </div>   
        <?php footer(); ?>
    </body>
</html>