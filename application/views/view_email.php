<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php
		head(array('titulo'=>$titulo,'description'=>$pagina_footer['description'],'keywords'=>$pagina_footer['keywords']));		
	?>
    <body>
        <?php //top(array('title'=>$titulo)); ?>
        <div class="white_bg">
            <div id="body" class="center">
            	<?php print str_replace('\r\n',"<br>",str_replace('\t',"&nbsp;",$texto)); ?>
            </div>
        </div>
        <?php //footer(); ?>
    </body>
</html>