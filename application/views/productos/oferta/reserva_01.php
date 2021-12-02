<!DOCTYPE html>
<html lang="<?php $code_idioma = app_idioma_codigo(); print $code_idioma; ?>">
	<?php
	$oferta_traducido = app_traduccion('oferta','oferta_idioma',NULL,'oferta_fk',$oferta['id'],$oferta);
	$oferta_tipo_traducido = app_traduccion('oferta','oferta_tipo_idioma',NULL,'tipo_fk',$oferta['tipo_fk'],$oferta['tipo']);
    $oferta_traducido['description'] = $oferta_traducido['description'] != null ? $oferta_traducido['description'] : $oferta_traducido['descripcion'];

	head(array('titulo'=>trans('reservar').' - '.$oferta_traducido['nombre'],'description'=>$oferta_traducido['description'],'keywords'=>$oferta_traducido['keywords'],'css'=>array('ui-lightness/jquery.ui.all.css'))); ?>
    <body>
        <?php top(array('title'=>trans('reservar'),'subtitle'=>$oferta_traducido['nombre'])); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                    <?php modulo_load(); ?>
                </div>
                <div id="center_area">
                    <br class="clean"/>
                    <div class="form border_drk" style="position:relative" id="capa_reserva_oferta">
                    	<div class="loader_reserva">
                            <img style="margin-top: 74px;" src="images/loading_box.gif" alt="" />
                            <br />
                            <label><?php print trans('procesando'); ?></label>
                        </div>
                        <?php echo form_open(base_url('con_oferta/crear_reserva'), array( 'id'=>"form_reserva_oferta", 'onSubmit' => 'return validar()')); ?>

                        <input type="hidden" name="id_oferta" value="<?php print $oferta['id']; ?>"/>
                        <?php				
                            if($oferta['confirmacion_online']=='f')
                            {
                                print '<span class="black right"><b>¡'.trans("reserva_a_confirmar").'!</span>';
                                print '<input type="hidden" name="aconfirmar" value="1"/>';
                            }
                        ?>
                        <?php if(isset($key_car_reserva)){ ?>
                        <input  type="hidden" name="key_car_reserva" value="<?php print $key_car_reserva; ?>"/>
                        <?php } ?>
                        <div>
                        	<div class="col solo1">
                                <label class="verdana detail">
                                    <?php print $oferta_tipo_traducido['nombre']; ?>
                                </label>
                            </div>
                            <div class="col solo1">
                                <label class="verdana detail">
                                    <?php print $oferta_traducido['nombre']; ?>
                                </label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>
                        <br class="clean"/>
                        <div>
                            <div class="col solo2">
                                <label><?php print trans('of_fecha'); ?></label>
                                <input type="text" class="input_cal fecha" id="fecha" name="fecha" required="required" autocomplete="off"/>
                            </div>
                            <div class="col solo2">
                                <label><?php print trans('of_cantidad'); ?></label>
                                <select name="cantidad" id="cantidad" class="input_cal" required="required" >
                                    <?php
                                        for($i=1;$i<=$oferta['maximo_reservar'];$i++)
                                        {
                                            print '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                            </div><br class="clean" /><br/>
                            <div class="col solo2">
                                <label for=""><?php echo trans('of_cantidad_dias') ?></label>

                                <select name="cantidad_dias" id="cantidad_dias" class="input_cal" required="required" >
                                    <?php
                                    for($i=1;$i<=$cant_dias;$i++)
                                    {
                                        print '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>            
                        <br class="clean"/>
                        
                        
                        <div class="col solo1">
                            <label><?php print trans('of_solicitud_adicional'); ?></label>
                            <br>
                            <textarea rows="5" id="detalles_oferta"  name="detalles"></textarea>
                        </div>
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
			$("#fecha").datepicker({"dateFormat":"yy-mm-dd",minDate:'<?php print $oferta['fecha_rinicio']; ?>',maxDate:'<?php print $oferta['fecha_rfin']; ?>'<?php
			if(isset($oferta['dias_disponibles']))
			{
				print ',';
				print 'beforeShowDay: function (day)';
				print '{';
					print 'var day = day.getDay();';
					foreach($oferta['dias_disponibles'] as $d)
					{
						$dias_disponibles[] = 'day == '.($d['dia']-1);
					}
					$cadena_if = implode(' || ',$dias_disponibles);
					print 'if ('.$cadena_if.') { ';
						print 'return [true, ""];';
					print '} else { ';
						print 'return [false, ""];';
					print '}';
				print '}';
			}
			?>},$.datepicker.regional[ "<?php print $code_idioma; ?>" ]);
			$(".input_cal").change(function() {
					$.ajax({
                    'url':  'con_oferta/calcular',
                    'data': $("#form_reserva_oferta").serialize(),
                    'dataType': 'json',
                    'type': 'POST',
                    'beforeSend': function(){
                        $('#capa_reserva_oferta').find('.loader_reserva').show();
                    },
                    'success': function(data) {
						if(data.ok == 't')
						{
							$('.precio_reservacion').html(data.precio);
						}
						else
						{
							$('.precio_reservacion').html('');
							alert(data.msg);
						}
						$('#capa_reserva_oferta').find('.loader_reserva').hide();
					}
					});
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
					print "$('#cantidad').val(".$reserva["options"]["cantidad"].");";
					print "$('#cantidad_dias').val(".$reserva["options"]["cantidad_dias"].");";
					print "$('#fecha').val('".$reserva["options"]["fecha"]."');";
					print "$('#detalles_oferta').val('".$reserva["options"]["detalles"]."');";
				}
			?>
		</script>
    </body>
</html>