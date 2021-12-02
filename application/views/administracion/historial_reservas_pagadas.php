<!DOCTYPE html>
<html lang="<?php print CODIGO_IDIOMA; ?>">
<?php 
$titulo = trans('user_historial');
$subtitulo = $user_registrado['nombre']; 
?>
<?php head(array('titulo'=>$titulo.' - '.$subtitulo,'description'=>trans('seo_description_home'),'keywords'=>trans('seo_keywords_home')));?>
<body>
<?php top(array("title"=>$titulo,"subtitle"=>$subtitulo)); ?>
<div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                <?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>              	
                    <div class="clean_space" ></div>                    
                </div>
                <div id="center_area">
                	<div >
                    <?php
						if(sizeof($reservas)>0)
						{
							foreach($reservas as $r)
							{
								print $r['options']['template_historial'];							
								print '<div class="divisor"><span class="l"></span><span class="r"></span></div>';
							}
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
        </div>     
        <?php footer(); ?>
    </body>
</html>