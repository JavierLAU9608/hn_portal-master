<!DOCTYPE html>
<html lang="<?php $code_idioma = app_idioma_codigo(); print $code_idioma; ?>">
	<?php head(array('titulo'=>trans('reserva_datos').' - '.trans('alojamiento').' - '.$hotel['nombre_hotel'],'description'=>$hotel['description'],'keywords'=>$hotel['keywords'])); ?>
    <body>
        <?php top(array('title'=>trans('reserva_datos'),'subtitle'=>trans('alojamiento'))); ?>
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
                                    <?php print trans('alojamiento'); ?>
                                </label>
                            </div>
                        </div>
                        <br class="clean" /><br/>                        
                        <div>
                            <div class="col solo1">
                                <label class="verdana detail"><?php print trans('al_cantidad_habitaciones'); ?></label>:
                                <label class="verdana detail">
                                	<?php
										print sizeof($producto['options']['habitaciones']);
									?>
                                </label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>
                        
                        <?php
						$i=0;
						foreach($producto['options']['habitaciones'] as $h):
						?>
                        	
                                	<div class="sello golden left">
                                    	<p style="padding:0px;"><?php print ++$i; ?></p>
                                    </div>
                                
                        	<br class="clean" /><br/>
                            <div>
                                <div class="col solo2">
                                	<?php
									$tipo_habitacion = $this->alojamiento->_get_tipo_habitacion($h['tipo_habitacion']);
									$tipo_habitacion_nombre = app_traduccion('hotel','hotel_tipo_hab_idioma','nombre','tipo_habitacion_fk',$tipo_habitacion['id'],$tipo_habitacion['nombre_habitacion']);
									?>
                                    <label><?php print trans('al_habitacion');?>:</label><br/>
                                    <label class="verdana detail"><?php print $tipo_habitacion_nombre;?></label><br/>
                                </div>
                                <div class="col solo2">
                                    <label><?php print trans('al_fecha_entrada');?>:</label><br/>
                                    <label class="verdana detail"><?php print app_str_date($h['fecha']);?></label><br/>
                                </div>
                        	</div>
                            <br class="clean" /><br/>
                            <div>
                                <div class="col solo2">
                                    <label><?php print trans('al_hora_entrada');?>:</label><br/>
                                    <label class="verdana detail"><?php print $h['hora'];?></label><br/>
                                </div>
                                <div class="col solo2">
                                	<?php
									$plan_alimentacion = $this->alojamiento->_get_plan_alimentacion($h['plan']);
									$plan_nombre = app_traduccion('hotel','hotel_plan_idioma','nombre','plan_fk',$plan_alimentacion['id'],$plan_alimentacion['nombre_plan']);
									?>
                                    <label><?php print trans('al_plan_alojamiento');?>:</label><br/>
                                    <label class="verdana detail"><?php print $plan_nombre;?></label><br/>
                                </div>
                        	</div>
                            <br class="clean" /><br/>
                            <div>
                                <div class="col solo2">
                                    <label><?php print trans('al_pax');?>:</label><br/>
                                    <label class="verdana detail"><?php print app_get_pax_opc($nuevos_paxs, $h['paxs']);?></label><br/>
                                </div>
                                <div class="col solo2">
                                    <label><?php print trans('al_noches');?>:</label><br/>
                                    <label class="verdana detail"><?php print $h['noches'];?></label><br/>
                                </div>
                        	</div>
                            <br class="clean" /><br/>
                            <div>
                                <div class="col solo2">
                                	<?php
									if($h['paquete_luna_miel']>0)
									{
										$paquete_luna_miel = $this->alojamiento->get_paquete_luna_miel($h['paquete_luna_miel']);
										$paquete_luna_miel_nombre = app_traduccion('hotel','hotel_pack_idioma','nombre','pack_fk',$paquete_luna_miel['id'],$paquete_luna_miel['nombre']);
										print '<label>'.trans('al_paquete_luna_miel').'</label><br/>';
										print '<label class="verdana detail">'.$paquete_luna_miel_nombre.'</label><br/>';
									}
									?>
                                </div>
                                <div class="col solo2">
                                	<?php
									if($h['ninno_adicional']!=='f' && $h['ninno_adicional'])
									{										
										print '<label class="verdana detail">'.trans('al_ninno_adicional').'</label>';
										print '<br/>';
									}
									?>
                                </div>
                        	</div>
                            
                            <div class="divisor"></div>
                        <?php
						endforeach;
						?>
                        <br class="clean" /><br/>
                        <?php
						if($producto['options']['detalles']!=='')
						{
							print '<div class="col solo1">';
								print '<label>';
									print trans('detalles_adicionales');
								print '</label><br/>';
								print $producto['options']['detalles'];
							print '</div>';
							print '<br class="clean" /><br/>';
							print '<div class="divisor"><span class="l"></span><span class="r"></span></div>';
							print '<br class="clean" /><br/>';
						}
						?>
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