<!DOCTYPE html>
<html lang="<?php $code_idioma = app_idioma_codigo(); print $code_idioma; ?>">
	<?php
    $bar_traducido = app_traduccion('bar','bar_idioma',NULL,'bar_fk',$bar['id'],$bar);
	$description = $bar_traducido['description'];
	$keywords = $bar_traducido['keywords'];
	$descripcion = $bar_traducido['descripcion'];
	head(array('titulo'=>trans('reservar').' - '.trans('br_bar_nombre',array('nombre'=>$bar['nombre'])),'description'=>$description,'keywords'=>$keywords,'css'=>array('ui-lightness/jquery.ui.all.css'))); ?>
    <body>
        <?php top(array('title'=>trans('reservar'),'subtitle'=>trans('br_bar_nombre',array('nombre'=>$bar['nombre'])))); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                    <?php modulo_load(); ?>
                </div>
                <div id="center_area">
                    <div class="form border_drk" style="position:relative" id="capa_reserva_bar">
                    	<div class="loader_reserva">
                            <img style="margin-top: 74px;" src="images/loading_box.gif" alt="" />
                            <br />
                            <label><?php print trans('procesando'); ?></label>
                        </div>
                        <?php echo form_open(base_url('con_bar/crear_reserva'), array( 'id'=>"form_reserva_bar", 'onSubmit' => 'return validar()')); ?>

                        <input type="hidden" name="id_bar" value="<?php print $bar['id']; ?>"/>
                        <?php				
                            if($bar['confirmacion_online']=='f')
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
                                    <?php print trans('br_bar_nombre',array('nombre'=>$bar['nombre'])); ?>
                                </label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>
                        <br class="clean"/>
                        <?php
							print '<div>';
								print '<div class="col solo1">';
								print '<label>'.trans('br_menus').'</label>';
								print '</div>';
								print '<br class="clean"/>';
								foreach($bar['menus'] as $m)
								{
									print '<label>';
										print '<input type="radio" class="menu input_cal" value="'.$m['id'].'" id="menu_'.$m['id'].'" name="menu"/> ';							
										print $m['nombre'];
									print '</label>';
									print '<br/>';
								}
							print '</div>';						
                        ?>
                        <br class="clean"/>
                        <div>
                            <div class="col solo2">
                                <label><?php print trans('br_dia_reservacion'); ?> </label>
                                <input type="text" readonly class="fecha input_cal" id="fecha" name="fecha"/>
                            </div>              
                            <div class="col solo2">                        
                                <label><?php print trans('br_cantidad_personas'); ?></label>
                                <select name="cantidad" id="cantidad" class="input_cal">                    	
                                    <?php
                                        for($i=1;$i<=(int)$bar['maximo_reservar'];$i++)
                                            print '<option value="'.$i.'">'.$i.'</option>';
                                    ?>                                                  
                                </select>
                            </div>
                        </div>
                        <br class="clean" />
                        <div>
                            <div class="col solo2">
                                <label><?php print trans('br_duracion'); ?></label>
                                <select name="duracion" id="duracion" class="input_cal">
                                    <option value=""><?php print trans('seleccione'); ?></option>
                                </select>
                            </div>
                            <div class="col solo2">
                                <label><?php print trans('br_precio_hora_extra'); ?></label>
                                <select name="horas_extras" id="horas_extras" class="input_cal">
                                    <option value="0"><?php print trans('seleccione'); ?></option>
                                    <?php
                                        for($i=1;$i<=5;$i++)
                                            print '<option value="'.$i.'">'.$i.'</option>';
                                    ?>                    	                      
                                </select>
                            </div> 
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
			$("#fecha").datepicker({"dateFormat":"yy-mm-dd",minDate:'<?php print $bar['release']; ?>',maxDate:'1Y'},$.datepicker.regional[ "<?php print $code_idioma; ?>" ]);
			$(".input_cal").change(function() {
				if($("#duracion").val()>0 && $("#fecha").val()!=='')
				{					
					$.ajax({
                    'url':  'con_bar/calcular',
                    'data': $("#form_reserva_bar").serialize(),
                    'dataType': 'json',
                    'type': 'POST',
                    'beforeSend': function(){
                        $('#capa_reserva_bar').find('.loader_reserva').show();
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
						$('#capa_reserva_bar').find('.loader_reserva').hide();
					}
					});
				}
			});
			$(".menu").click(function(){
				var id_menu = $(this).val();
				$("#duracion").empty();
				   $("#duracion").append('<option value=""><?php print trans('seleccione'); ?></option>');
					for (var i = 0; i < menu_tarifas.length; i++) {
						if(menu_tarifas[i].id==id_menu){
						 $("#duracion").append('<option value="'+menu_tarifas[i].id_tarifa+'">'+menu_tarifas[i].duracion+'</option>');	  	  
						}
					}
			});
			function validar()
			{
				if($('.precio_reservacion').html()!=='')
					return true;
				alert('<?php print trans('al_error_reserva_incorrecta'); ?>');
				return false;
			}
			function menu_bar(id,id_tarifa,duracion)
			{
				this.id=id;
				this.id_tarifa=id_tarifa;
				this.duracion=duracion;
			}
			<?php
			print 'var menu_tarifas = new Array();';
			$items=0;
			foreach($bar['menus'] as $m)
			{
				foreach($m['tarifas'] as $t)
				{
					 print 'menu_tarifas['.$items++.']=new menu_bar('.$m['id'].','.$t['id'].',"'.$t['duracion'].'");';
				}
			}
			?>
			<?php
				if(isset($key_car_reserva))
				{
					print "$('#fecha').val('".$reserva["options"]["fecha"]."');";
					print "$('#menu_".$reserva["options"]["id_menu"]."').click();";
					print "$('#duracion').val(".$reserva["options"]["id_duracion"].");";
					print "$('#horas_extras').val(".$reserva["options"]["horas_extras"].");";
					print "$('#cantidad').val(".$reserva["options"]["cantidad"].");";
					print "$('.precio_reservacion').html('".app_rate_cambio($reserva["price"],'smb')."');";					
				}
			?>
		</script>
    </body>
</html>