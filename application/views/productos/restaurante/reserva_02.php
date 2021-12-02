<!DOCTYPE html>
<html lang="<?php $code_idioma = app_idioma_codigo(); print $code_idioma; ?>">
	<?php
    $restaurante_trans = app_traduccion('restaurante','restaurante_idioma_rest',NULL,'restaurante_fk',$restaurante['id'],$restaurante);
	head(array('titulo'=>trans('reserva_datos').' - '.$restaurante['nombre'],'description'=>$restaurante_trans['description'],'keywords'=>$restaurante_trans['nombre'])); ?>
    <body>
        <?php top(array('title'=>trans('reserva_datos'),'subtitle'=>trans('rt_restaurante_nombre',array('nombre'=>$restaurante['nombre'])))); ?>
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
                        <div>
                            <div class="col solo1">
                                <label class="verdana detail">
                                    <?php print $restaurante['nombre']; ?>
                                </label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>                        
                        <div>
                            <div class="col solo2">
                            <label><?php print trans('rt_dia_reservacion');?></label><br/>
                            <label class="verdana detail"><?php print app_str_date($producto['options']['fecha']); ?></label>
                            </div>
                            <div class="col solo2 no_marg">
                            <label><?php print trans('rt_horario');?></label><br/>
                            <label class="verdana detail">
								<?php
									$horario_nombre = app_traduccion('restaurante','restaurante_horario_idioma','nombre','horario_fk',$horario_reservado['id'],$horario_reservado['nombre']);
									print $horario_nombre;
								?>
                            </label>
                            </div>
                        </div>                        
                        <br class="clean" /><br/>
                        <div>
                        	<div class="col solo2">
                            	<label><?php print trans('rt_menus_reservados');?>:</label><br/>
                            </div>
                            <div class="col solo2">
                            	<label><?php print trans('rt_cantidad');?>:</label><br/>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                        <?php
							foreach($producto['options']['menus'] as $m)
							{
								print '<div>';
								$datos_menu = $this->restaurante->get_el_menu($producto['options']['id_restaurante'],$m['id_menu']);
								$nombre_menu = app_traduccion('restaurante','restaurante_menu_idioma','nombre','menu_fk',$datos_menu['id'],$datos_menu['nombre']);
									print '<div class="col solo2">';
										print '<label class="verdana detail">'.$nombre_menu.'</label>';
									print '</div>';
									print '<div class="col solo2">';
										print '<label class="verdana detail">'.$m['cantidad'].'</label>';
									print '</div>';
								print '</div>';
								print '<br class="clean"/><br/>';
							}
						?>
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