<!DOCTYPE html>
<html lang="<?php $code_idioma = app_idioma_codigo(); print $code_idioma; ?>">
	<?php head(array('titulo'=>trans('reserva_datos').' '.trans('br_bar_nombre',array('nombre'=>$bar['nombre'])),'description'=>$bar['descripcion'],'keywords'=>$bar['nombre'])); ?>
    <body>
        <?php top(array('title'=>trans('reserva_datos'),'subtitle'=>trans('br_bar_nombre',array('nombre'=>$bar['nombre'])))); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                    <?php modulo_load(); ?>
                </div>
                <div id="center_area">
                	<div id="form_reserva_evento" class="form border_drk">
                    	<?php
						if($producto['options']['aconfirmar'] == 1)
						{
                    	print '<span class="black right"><b>¡'.trans('reserva_a_confirmar').'!</b></span>';
                        }
						?>
                        <br class="clean" /><br/>
                        <div>
                            <div class="col solo1">
                                <label class="verdana detail">
                                    <?php print trans('br_bar_nombre',array('nombre'=>$bar['nombre'])); ?>
                                </label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>                       
                        <div>
                            <div class="col solo1">
                            <label><?php print trans('br_menu');?></label><br/>
                            <label class="verdana detail"><?php print $menu_reservado['nombre']; ?></label>
                            </div>                            
                        </div>
                        <br class="clean" /><br/>
                        <div>
                            <div class="col solo2">
                            <label><?php print trans('br_dia_reservacion');?></label><br/>
                            <label class="verdana detail"><?php print app_str_date($producto['options']['fecha']); ?></label>
                            </div>
                            <div class="col solo2 no_marg">
                            <label><?php print trans('br_cantidad_personas');?></label><br/>
                            <label class="verdana detail"><?php print $producto['options']['cantidad']; ?></label>
                            </div>
                        </div>                        
                        <br class="clean" /><br/>
                        <div>
                            <div class="col solo2">
                            <label><?php print trans('br_duracion');?></label><br/>
                            <label class="verdana detail"><?php print $horario_reservado['duracion']; ?></label>
                            </div>
                            <div class="col solo2 no_marg">
                            <label><?php print trans('br_precio_hora_extra');?></label><br/>
                            <label class="verdana detail"><?php print $producto['options']['horas_extras']; ?></label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>
                        <br class="clean" /><br/>
                        <div class="precio_reserva">
                        	<p class="verdana"><?php print trans('pagar'); ?></p>
                            <span></span>
                            <p class="verdana yellow_bg"><?php print app_rate_cambio($producto['price'],'smb'); ?></p>                            
                            <a class="buttom roman" href="<?php print base_url(trans('ruta_carro_compra_editar',array('rowid'=>$producto['rowid']))); ?>"  title="<?php print trans('anterior'); ?>">
                            	<?php print trans('anterior'); ?>
                            </a>
                            <a class="buttom roman"  title="<?php print trans('cancelar'); ?>" href="<?php print base_url(trans('ruta_carro_compra_cancelar',array('rowid'=>$producto['rowid']))); ?>">
                            	<?php print trans('cancelar'); ?>
                            </a>
                            <a class="buttom roman" href="<?php print base_url(trans('ruta_carro_compra')); ?>" title="<?php print trans('ver_carrito'); ?>">
								<?php print trans('ver_carrito'); ?>
                            </a>
                        </div>
                        <br class="clean" /><br/>
                    </div>
                </div>
            </div> 
        </div>   
        <?php footer(); ?>
    </body>
</html>