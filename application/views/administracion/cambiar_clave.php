<!DOCTYPE html>
<html lang="en">
<?php head(array(
				'titulo'=>trans('usuario_cambiar_clave').': '.$usuario_regitrado['nombre_completo'],

				)); 
?>
<body>
<div id="pagina">
<?php menu(); ?>
<div id="contenido">
<?php arbol_navegacion(array(array('texto'=>trans('usuario_perfil'),'url'=>base_url('perfil')),array('texto'=>trans('usuario_cambiar_clave')))); ?>
	<div class="row-fluid">
    	<div class="span4">
    	</div>
        <div class="span6">
            <?php echo form_open(''); ?>
            <legend><?php print trans('usuario_cambiar_clave'); ?></legend>
            <div>
                <label for="clave_old"><?php print trans('usuario_clave_anterior'); ?>: </label>
                <input type="password" value="<?php echo set_value('clave_old'); ?>" name="clave_old"/>
                <?php echo form_error('clave_old'); ?>
            </div>
            <div>
                <label for="clave_new"><?php print trans('usuario_clave_nueva'); ?>: </label>
                <input type="password" value="<?php echo set_value('clave_new'); ?>" name="clave_new"/>
                <?php echo form_error('clave_new'); ?>
            </div>
            <div>
                <label for="clave_new_repet"><?php print trans('usuario_clave_nueva_repetir'); ?>: </label>
                <input type="password" value="<?php echo set_value('clave_new_repet'); ?>" name="clave_new_repet"/>
                <?php echo form_error('clave_new_repet'); ?>
            </div>
            <input class="btn btn-large btn-primary" type="submit" value="<?php print trans('accion_aceptar'); ?>" name="cambiar"/>
            <a class="btn btn-large" href="<?php print base_url('perfil'); ?>"><?php print trans('accion_cancelar'); ?></a>
            <?php
            if($mensaje!==NULL)
            {   
                print '<div class="alert alert-error">'.$mensaje.'</div>';
            }
            ?>
            </form>
        </div>
        <div class="span4">
    	</div>
    </div>
</div>
<?php footer(array('js'=>array('jquery.validate.js'))); ?>
</div>
<script language="javascript">
$(document).ready(function() {
<?php
if($mensaje!==NULL)
{
	print '$(".alert-error").show("slide");';
}
?>
});
</script>
</body>
</html>