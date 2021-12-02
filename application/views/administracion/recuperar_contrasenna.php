<!DOCTYPE html>
<html lang="<?php print CODIGO_IDIOMA; ?>">
<?php 
$titulo = trans('entrar_iniciar_session');
?>
<?php head(array('titulo'=>$titulo,'description'=>trans('seo_description_home'),'keywords'=>trans('seo_keywords_home')));?>
<body>
<?php top(array("title"=>$titulo)); ?>
<div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<?php modulo_load(); ?>                            	
                    <div class="clean_space" ></div>                    
                </div>
                <div id="center_area">
                	<div class="form border_drk">
                        <?php echo form_open('', array()); ?>

                        	<div class="col solo2">
                                <label>
                                    <?php print trans('correo'); ?>
                                </label>
                                <input type="text" name="correo" value="<?php print set_value('correo'); ?>"/>
                            </div>
                            <br class="clean" /><br/>
                            <input class="buttom roman" type="submit" name="btn_continuar" value="<?php print trans('continuar'); ?>">
                            <br class="clean" /><br/>
                            <?php if(isset($flash_error) && (string)$flash_error!==''){ print '<br class="clean"/><div class="form_msg  verdana">'.$flash_error.'</div>'; } ?>               
                        </form>
                    </div>			
				</div>
            </div>
        </div>     
        <?php footer(); ?>
    </body>
</html>