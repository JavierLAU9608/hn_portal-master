<!DOCTYPE html>
<html lang="<?php $code_idioma = app_idioma_codigo(); print $code_idioma; ?>">
	<?php
    $restaurante_trans = app_traduccion('restaurante','restaurante_idioma_rest',NULL,'restaurante_fk',$restaurante['id'],$restaurante);
	head(array('titulo'=>trans('reservar').' - '.$restaurante['nombre'],'description'=>$restaurante_trans['description'],'keywords'=>$restaurante_trans['keywords'],'css'=>array('ui-lightness/jquery.ui.all.css'))); ?>
    <body>
        <?php top(array('title'=>trans('reservar'),'subtitle'=>trans('rt_restaurante_nombre',array('nombre'=>$restaurante['nombre'])))); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                    <?php modulo_load(); ?>
                </div>
                <div id="center_area">
                    <div class="form border_drk" style="position:relative" id="capa_reserva_restaurante">
                    	<div class="loader_reserva">
                            <img style="margin-top: 74px;" src="images/loading_box.gif" alt="" />
                            <br />
                            <label><?php print trans('procesando'); ?></label>
                        </div>
						<?php echo form_open(base_url('con_restaurante/crear_reserva'), array( 'id'=>"form_reserva_restaurante", 'onSubmit' => 'return validar()')); ?>
                        
                        <input type="hidden" name="id_restaurante" value="<?php print $restaurante['id']; ?>"/>
                        <?php				
                            if($restaurante['confirmacion_online']=='f')
                            {
                                print '<span class="black right"><b>¡'.trans("reserva_a_confirmar").'!</span>';
                                print '<input type="hidden" name="aconfirmar" value="1"/>';
                            }
                        ?>
                        <?php if(isset($key_card_reserva)){ ?>
                        <input  type="hidden" name="key_car_reserva" value="<?php print $key_car_reserva; ?>"/>
                        <?php } ?>
                       
                        <div>
                            <div class="col solo1">
                                <label class="verdana detail">
                                    <?php print trans('rt_restaurante_nombre',array('nombre'=>$restaurante['nombre'])); ?>
                                </label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>
                        <br class="clean"/>
                        <div>
                            <div class="col solo2">
                                <label><?php print trans('rt_dia_reservacion'); ?> </label>
                                <input required="required" type="text" readonly class="fecha input_cal" id="fecha" value="<?php print $fecha_seleccionada; ?>" name="fecha"/>
                            </div>                       
                            <div class="col solo2">
                                <label><?php print trans('rt_horario'); ?></label>
                                <select name="horario" id="horario" class="input_cal">
                                    <?php
                                        foreach($restaurante['horarios'] as $h)
                                        {
                                            $h_t = app_traduccion('restaurante','restaurante_horario_idioma',NULL,'horario_fk',$h['id'],$h);
                                            print '<option value="'.$h['id'].'">'.$h_t['nombre'].' '.date('h:i A',strtotime($h['hora_inicio'])).' - '.date('h:i A',strtotime($h['hora_fin'])).'</option>';
                                        }
                                    ?>                                                   	                      
                                </select>
                            </div> 
                        </div>             
                        <br class="clean"/>
                        <?php
							foreach($menus as $m)
							{
								$capacidad_minima = $m['capacidad_min']?$m['capacidad_min']:1;
								$capacidad_maxima = $m['capacidad_max']?$m['capacidad_max']:$restaurante['cantidad_persona'];
								$m_t = app_traduccion('restaurante','restaurante_menu_idioma',NULL,'menu_fk',$m['id'],$m);
								print '<div class="menu-restaurante" style="height:200px;width:47%;float:left;border:1px solid;margin:3px;padding:2px;">';
									print '<h2>'.$m_t['nombre'].'</h2>';
									print '<div style="height:100px;overflow:auto;" class="datos_menu">';
										foreach($m['platos'] as $p)
										{
											if(is_array($p))
											{
											$tipo_plato_traduccion = app_traduccion('restaurante','restaurante_tipoc_idioma','nombre','tipo_comida_fk',$p[0]['id_tipo_plato'],$p[0]['nombre_tipo_plato']);
												print '<h3>'.$tipo_plato_traduccion.':</h3>';
												foreach($p as $o)
												{	
													$plato_traduccion = app_traduccion('restaurante','restaurante_plato_idioma','nombre','plato_fk',$o['id_plato'],$o['nombre_plato']);										
													print '<span>'.($o['cantidad']>1?$o['cantidad'].' ':'').$o['nombre_plato'].'</span>';
													print '<br/>';
												}
											}
											else
											{
												print '<span>'.$p.'</span>';
												print '<br/>';
											}
										}
									print '</div>';
									print '<br class="clean"/>';
									print '<input type="hidden" name="id_menu[]" value="'.$m['id'].'"/>';
									print '<div class="col">';
										print '<label>';
											print trans('rt_cantidad');
										print '</label>';
										print '<select name="cantidad[]" id="cantidad_menu_'.$m['id'].'" class="input_cal">';
											print '<option value="0">'.trans('seleccione').'</option>';
											for($i=$capacidad_minima;$i<=$capacidad_maxima;$i++)
											{
												print '<option value="'.$i.'">'.$i.'</option>';
											}
										print '</select>';										
									print '</div>';
								print '</div>';
							}
						?>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>
                        <br class="clean"/>
                        <div class="precio_reserva">
                        	<p class="verdana"><?php print trans('precio'); ?></p>
                            <span></span>
                            <p class="verdana yellow_bg precio_reservacion"><?php if(isset($key_car_reserva)){ print app_rate_cambio($reserva["price"],'smb'); } ?></p>                            
                            <input class="buttom roman" type="submit" name="btn_continuar" value="<?php print trans('continuar'); ?>">
                            <input class="buttom roman" type="submit" name="btn_cancelar" value="<?php print trans('cancelar'); ?>">
                        </div>
                        <br class="clean"/>
                        <?php if(isset($flash_error)){ print $flash_error; } ?>
                        <br class="clean"/>
                        </form>
                    </div>
                </div>
            </div> 
        </div>   
        <?php footer(array('js'=>array('ui/jquery.ui.datepicker.js','ui/jquery.ui.core.js','ui/i18n/jquery.ui.datepicker-'.$code_idioma.'.js'))); ?>
        <script language="javascript" type="application/javascript">
			$("#fecha").datepicker({"dateFormat":"yy-mm-dd",minDate:'<?php print $restaurante['release']; ?>',maxDate:'1Y'},$.datepicker.regional[ "<?php print $code_idioma; ?>" ]);
			$(".input_cal").change(function() {
				if($("#horario").val()>0 && $("#fecha").val()!=='')
				{									
					$.ajax({
                    'url':  'con_restaurante/calcular',
                    'data': $("#form_reserva_restaurante").serialize(),
                    'dataType': 'json',
                    'type': 'POST',
                    'beforeSend': function(){
                        $('#capa_reserva_restaurante').find('.loader_reserva').show();
                    },
                    'success': function(data) {
						if(data.ok == 't')
						{
							$('.precio_reservacion').html(data.precio);
						}
						else
						{
							$('.precio_reservacion').html('');
						}
						 $('#capa_reserva_restaurante').find('.loader_reserva').hide();
					}
					});
				}
			});
			function validar()
			{
				if($('.precio_reservacion').html()!=='')
					return true;
				alert('<?php print trans('al_error_reserva_incorrecta'); ?>');
				return false;
			}	
			<?php
				if(isset($key_car_reserva))
				{
					print "$('#fecha').val('".$reserva["options"]["fecha"]."');";
					print "$('#horario').val(".$reserva["options"]["horario"].");";
					foreach($reserva["options"]["menus"] as $m)
					{
						print "$('#cantidad_menu_".$m["id_menu"]."').val(".$m["cantidad"].");";
					}
					print "$('.precio_reservacion').html('".app_rate_cambio($reserva["price"],'smb')."');";									
				}
			?>
		</script>
    </body>
</html>