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
<!--                	--><?php //modulo_load(); ?><!--                            	-->
                    <div class="clean_space" ></div>                    
                </div>
                <div id="center_area">
                    <?php echo form_open('', array('class' => 'verdana gray')); ?>
                        <input class="input_login" autofocus="autofocus" type="text" name="correo" placeholder="<?php print trans('correo'); ?>" value="" />
                        <br/>
                        <span class="help-block"><?php echo form_error('correo') ?></span>
                        <br/>
                        <input class="input_login" type="password" name="password" placeholder="<?php print trans('contrasenna'); ?>" value=""  /><br class="clean" />
                        <br/>
                        <span class="help-block"><?php echo form_error('password') ?></span>
                        <input type="checkbox" class="chk" name="remember_pass"/><label><?php print trans('entrar_recordar_contrasenna'); ?></label>
                        <br/>
                        <input class="buttom roman" type="submit" value="<?php print trans('entrar_iniciar_session'); ?>"/>
                    </form>
				</div>
            </div>
        </div>     
        <?php footer(); ?>
    </body>
</html>