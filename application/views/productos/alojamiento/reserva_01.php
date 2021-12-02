<!DOCTYPE html>
<html lang="<?php $code_idioma = app_idioma_codigo(); print $code_idioma; ?>">
	<?php head(array('titulo'=>trans('reservar').' - '.trans('alojamiento'),'description'=>$hotel['description'],'keywords'=>$hotel['keywords'],'css'=>array('ui-lightness/jquery.ui.all.css'))); ?>
    <body class="menu-always-on-top-header">
        <?php top(array('title'=>trans('reservar'),'subtitle'=>trans('alojamiento'))); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">


                </div>
                <div id="center_area">
                    <div class="form border_drk">
						<?php echo form_open(base_url('con_alojamiento/crear_reserva'), array('class' => 'form_filter', 'id' => 'form_reserva_alojamiento', 'onSubmit' => 'return validar()')); ?>

                        <input type="hidden" name="id_hotel" value="<?php print $hotel['id']; ?>"/>
                        <?php				
                            if($hotel['confirmacion_online']=='f')
                            {
                                print '<span class="black right"><b>¡'.trans("reserva_a_confirmar").'!</span>';
                                print '<input type="hidden" name="aconfirmar" value="1"/>';
                            }
                        ?>
                        <?php if(isset($key_car_reserva)){ ?>
                        <input  type="hidden" name="key_car_reserva" value="<?php print $key_car_reserva; ?>"/>
                        <?php } ?>
                        <?php
						$pre_habitaciones_reserva = $reserva['options']['habitaciones'];
						$tota_habitaciones = sizeof($pre_habitaciones_reserva);
						foreach($pre_habitaciones_reserva as $pre_habitacion) {}

						function info_hab($habitaciones,$id_hab,$campo)
						{
							foreach($habitaciones as $hab)
							{
								if($hab['tipo_habitacion_fk'] == $id_hab)
								return $hab[$campo];
							}
							return 1;
						}
						?>
                        <div>
                            <div class="col solo3">
                                <label class="verdana detail">
                                    <?php print trans('alojamiento'); ?>
                                </label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                        <div>
                            <div class="col solo3">
								<label><?php print trans('al_fecha_entrada'); ?></label><br/>
								<input id="fecha_principal" type="text" readonly name="fecha" class="selector_fecha input_cal" value="<?php print($pre_habitacion['fecha']); ?>"/>
                            </div>
							<br class="clean" /><br/>
							<div class="col solo3">
								<label><?php print trans('al_habitacion'); ?></label><br/>
								<select id="tipo_hab_principal" name="tipo_habitacion" class="tipo_habitacion input_cal">
									<?php
									foreach($hotel['habitaciones_reserva'] as $h)
									{
										$nombre_habitacion = app_traduccion('hotel','hotel_tipo_hab_idioma','nombre','tipo_habitacion_fk',$h['tipo_habitacion_fk'],$h['nombre_habitacion']);
										if($pre_habitacion['tipo_habitacion'] == $h['tipo_habitacion_fk'])
											print '<option selected="selected" value="'.$h['tipo_habitacion_fk'].'">'.$nombre_habitacion.'</option>';
										//else
											//print '<option value="'.$h['tipo_habitacion_fk'].'">'.$nombre_habitacion.'</option>';
									}
									?>
								</select>
							</div>

							<div class="col solo3">
								<label><?php print trans('al_cantidad_habitaciones'); ?></label><br/>
<!--								<select id="cantidad_habitaciones" class="cantidad_habitaciones">-->
<!--									--><?php
//									for($i=1;$i<=$max_habitacion_reserva;$i++)
//									{
//										if($i == $tota_habitaciones)
//											print '<option selected="selected" value="'.$i.'">'.$i.'</option>';
//										else
//											print '<option value="'.$i.'">'.$i.'</option>';
//									}
//									?>
<!--								</select>-->
								<input autocomplete="off" value="<?php echo $tota_habitaciones ?>" type="text" id="cantidad_habitaciones" class="cantidad_habitaciones solo_numeros"/>
							</div>
                        </div>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>                        
                        <br class="clean"/>
                        <?php
						$numero_habitacion = 0;
						foreach($pre_habitaciones_reserva as $pre_habitacion):
						?>
                        <div class="formulario_alojamiento border_drk_1" style="position:relative;">
                            <div class="loader_reserva">
                                <img style="margin-top: 74px;" src="images/loading_box.gif" alt="" />
                                <br />
                                <label><?php print trans('procesando'); ?></label>
                            </div>
                        	<input type="hidden" class="precio_habitacion" name="precio_habitacion[]" value="<?php print $pre_habitacion['precio']; ?>"/>
                        	<div class="numero_habitacion"><font><?php print ++$numero_habitacion; ?></font></div>

                            <br class="clean" /><br/>
                            <div>                       
                                <div class="col solo3">
                                    <label><?php print trans('al_hora_entrada'); ?></label>
                                    <select name="hora[]" class="hora">
                                        <?php									
                                        $hora_inicio = (int)$hotel['horario_check_in'];
                                        for($i=$hora_inicio;$i<24;$i++)
                                        {
                                            $hora_i = date('H:i',strtotime("$i:00"));
                                            if($pre_habitacion['hora'] == $hora_i)
                                                print '<option selected="selected">'.$hora_i.'</option>';
                                            else
                                                print '<option>'.$hora_i.'</option>';
                                        }								
                                        ?>
                                    </select>
                                </div>                           
                               
                                <div class="col solo3">
                                    <label><?php print trans('al_plan_alojamiento'); ?></label>
                                    <select name="plan[]" class="plan">
                                    <?php
                                    foreach($hotel['plan_alojamiento'] as $p)
                                    {
										$plan = app_traduccion('hotel','hotel_plan_idioma',null,'plan_fk',$p['plan_fk'],$p);
										$nombre_plan = isset($plan['nombre_plan']) ? $plan['nombre_plan'] : $plan['nombre'];
										$descrip_plan = ' ('.$plan['descripcion'].')';

                                        if($pre_habitacion['plan'] == $p['plan_fk'])
                                            print '<option selected="selected" value="'.$p['plan_fk'].'">'.$nombre_plan.$descrip_plan.'</option>';
                                        else
                                            print '<option value="'.$p['plan_fk'].'">'.$nombre_plan.$descrip_plan.'</option>';
                                    }
                                    ?>                                	
                                    </select>
                                </div>
                            </div>
                            <br class="clean"/><br/>
                            <div>
                                <div class="col solo3">
                                    <label><?php print trans('al_pax'); ?></label>
                                    <select name="paxs[]" class="cantidad_paxs input_cal">
                                        <?php
//                                        $maximo_pax = info_hab($hotel['habitaciones_reserva'],$pre_habitacion['tipo_habitacion'],'cantidad_pax');
//                                        for($i=1;$i<=$maximo_pax;$i++)
//                                        {
//                                            if($pre_habitacion['paxs'] == $i)
//                                                print '<option selected="selected" value="'.$i.'">'.$i.'</option>';
//                                            else
//                                                print '<option value="'.$i.'">'.$i.'</option>';
//                                        }

										foreach ($hotel['nuevos_paxs'] as $n_pax) {
											if ($pre_habitacion['paxs'] == $n_pax['val']) {
												print '<option selected="selected" value="' . $n_pax['val'] . '">' . $n_pax['opc'] . '</option>';
											} else {
												print '<option value="' . $n_pax['val'] . '">' . $n_pax['opc'] . '</option>';
											}
										}
                                        ?>
                                    </select>
                                </div>
                                <div class="col solo3">
                                    <label><?php print trans('al_noches'); ?></label>
                                    <select name="noches[]" class="input_cal noches">
                                    <?php
                                    $minimo_noche = $hotel['minimo_de_noches']?$hotel['minimo_de_noches']:1;
                                    for($i=$minimo_noche;$i<=$cant_max_noches;$i++)
                                    {
                                        if($pre_habitacion['noches'] == $i)
                                            print '<option selected="selected" value="'.$i.'">'.$i.'</option>';
                                        else
                                            print '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>                            
                            <br class="clean"/><br/>
                            <div>                          
                                <div class="col solo3">
                                    <label><?php print trans('al_paquete_luna_miel'); ?> <img class="detalle_pql" style="cursor:pointer;display:none" title="<?php print trans('al_ver_detalles_paquete_luna_miel') ?>" alt="<?php print trans('al_ver_detalles_paquete_luna_miel') ?>" src="images/detalle.png"/></label>
                                    <select name="paquete_luna_miel[]" class="paquete_luna_miel input_cal">
                                        <option value=""><?php print trans('seleccione'); ?></option>
                                    <?php
                                    foreach($hotel['paquetes_luna_miel'] as $plm)
                                    {
                                        $nombre_paquete = $plm['nombre'];
                                        if($pre_habitacion['paquete_luna_miel'] == $plm['id'])
                                            print '<option selected="selected" value="'.$plm['id'].'">'.$nombre_paquete.'</option>';
                                        else
                                            print '<option value="'.$plm['id'].'">'.$nombre_paquete.'</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                                <?php
                                $acepta_ninno_adicional = info_hab($hotel['habitaciones_reserva'],$pre_habitacion['tipo_habitacion'],'ninno_adicional');
                                ?>
                                <div class="col solo3 capa_ninno_adicional hidden" <?php if($acepta_ninno_adicional=='f' || $acepta_ninno_adicional==NULL){print 'style="visibility:hidden"';} ?>>
                                    <label><?php print trans('al_ninno_adicional'); ?></label>
                                    <input <?php if($pre_habitacion['ninno_adicional']){print 'checked';} ?> type="checkbox" name="ninno_adicional_<?php print $numero_habitacion-1; ?>" class="ninno_adicional input_cal"/>
                                </div>
                            </div>
                            <br class="clean"/><br/>
                            <div class="col">
                            	<label><?php print trans('precio'); ?>: <span class="precio_habitacion_text"><?php print app_rate_cambio($pre_habitacion['precio'],'smb'); ?></span></label>
                            </div>
                            <br class="clean"/>                     
                        </div>
                        <?php
						endforeach;
						?>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>
                        <br class="clean"/>
                        <div class="col solo1">
                            <label><?php print trans('detalles_adicionales'); ?></label><br/>
                            <textarea name="detalles"  rows="5"><?php print $reserva['options']['detalles']; ?></textarea>
                        </div>
                        <br class="clean" /><br/>
                    	<div class="divisor"><span class="l"></span><span class="r"></span></div>
                        <br class="clean"/>
                        <div class="precio_reserva">
                        	<p class="verdana"><?php print trans('precio'); ?></p>
                            <span></span>
                            <p class="verdana yellow_bg precio_reservacion"><?php print app_rate_cambio($reserva["price"],'smb'); ?></p>                            
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
			var max_habitacion_reserva = <?php echo $max_habitacion_reserva ?>

			$('.plan').change(function(){
				var tipo_habitacion = $('#tipo_hab_principal').val();
				var fecha = $("#fecha_principal").val();

				var capa_form_parent = $(this).parent().parent().parent();
				var paxs = capa_form_parent.find('select:.cantidad_paxs').val();
				var noches = capa_form_parent.find('select:.noches').val();
				var plan = capa_form_parent.find('select:.plan').val();
				var token = $("input[name='token']").val();

				$.ajax({
					'url':  'con_alojamiento/get_paxs',
					'data':{'tipo_habitacion' : tipo_habitacion, 'fecha' : fecha, 'plan': plan, 'paxs' : paxs, 'token': token},
					'dataType': 'json',
					'type': 'POST',
					'beforeSend': function(){
						//$('.loader_reserva').show();
					},
					'success': function(data) {
						if(data.ok == 't')
						{
							var obj = capa_form_parent.find('select:.cantidad_paxs');
							obj.empty();
							for (var t_i = 0; t_i < data.n_paxs.length; t_i++) {
								//var vopc = data.n_paxs[t_i]['opc'];
								obj.append('<option value="'+data.n_paxs[t_i]['val']+'">'+data.n_paxs[t_i]['opc']+'</option>');
							}
							obj.val(data.paxs);

							precio(capa_form_parent.find('select:.cantidad_paxs'));
						}
					}
				});

			});

			$('#fecha_principal').change(function(){
				var tipo_habitacion = $('#tipo_hab_principal').val();
				var fecha = $("#fecha_principal").val();
				var cantidad_habitaciones = $('#cantidad_habitaciones').val();
				$(".selector_fecha").val(fecha);
				var token = $("input[name='token']").val();

				$.ajax({
					'url':  'con_alojamiento/get_dispo',
					'data':{'tipo_habitacion':tipo_habitacion, 'fecha':fecha, 'cant_habitaciones': cantidad_habitaciones, 'token': token},
					'dataType': 'json',
					'type': 'POST',
					'beforeSend': function(){
						$('.loader_reserva').show();
					},
					'success': function(data) {
						if(data.ok == 't')
						{
							var t_hab = $('#cantidad_habitaciones');
							var temp = t_hab.val();
							max_habitacion_reserva = data.habitaciones;

							if (temp > data.habitaciones) {
								t_hab.val(data.habitaciones);
								t_hab.keyup();
							} else {
								t_hab.val(temp);
							}

							var t_noches =  $('.noches');
							t_noches.each(function (i, e) {
								var temp = $(this).val();
								$(this).empty();
								for (var t_i = data.noches_min; t_i <= data.noches_max; t_i++) {
									$(this).append('<option value="'+t_i+'">'+t_i+'</option>');
								}
								if (temp > data.noches_max) {
									$(this).val(data.noches_max);
									$(this).change();
								} else {
									$(this).val(temp);
								}
							});

							if (data.info != null) {
								$('#dispo_info').attr('title', data.info);
								$('#dispo_info').removeClass('hidden');
							} else {
								$('#dispo_info').addClass('hidden');
							}

							total();

						} else if(data.ok == 'f') {
							alert(data.msg);
						}

						$('.loader_reserva').hide();
					}
				});
			});

			$(".selector_fecha").datepicker(
				{
					"dateFormat": "yy-mm-dd",
					minDate: '<?php print $hotel['fecha_minima']; ?>',
					maxDate: '<?php print $hotel['fecha_maxima'] ?>',
					beforeShowDay: nonWorkingDates,
					onChangeMonthYear: function (year, month, inst) {
						var fecha = year + '-' + month + '-01';
						update_datepicker("<?php echo trans('seleccione_dia') ?>", fecha);
					}
				},
				$.datepicker.regional["<?php print $code_idioma; ?>"]
			);

			function update_datepicker(msg, fecha) {
				var tipo_habitacion = $('#tipo_hab_principal').val();
				var token = $("input[name='token']").val();
				$.ajax({
					'url':  'con_alojamiento/get_paros',
					'data':{'tipo_habitacion':tipo_habitacion, 'fecha':fecha, 'token':token},
					'dataType': 'json',
					'type': 'POST',
					'beforeSend': function(){


					},
					'success': function(data) {

						if(data.ok == 't')
						{
							closedDates = data.paros;
							$("#fecha_principal").datepicker("refresh");
						}


					},
					'error' : function() {

					}
				});
			}

			$('.tipo_habitacion').change(function(){
				
				var capa_form_parent = $(this).parent().parent().parent();               
                var cantidad_paxs = capa_form_parent.find('select:.cantidad_paxs');
				var sel_cantidad_paxs = cantidad_paxs.val();
				var capa_ninno_adicional = capa_form_parent.find('div:.capa_ninno_adicional');
				var ninno_adicional = capa_form_parent.find('input:.ninno_adicional');
				ninno_adicional.removeAttr('checked');
				var tipo_habitacion = $(this).val();
				if(capacidades_maximas[tipo_habitacion].ninno_adicional == 't')
				{
					capa_ninno_adicional.css('visibility','visible');
				}
				else
					capa_ninno_adicional.css('visibility','hidden');
				
				cantidad_paxs.empty();
				var limites = capacidades_maximas[tipo_habitacion];				
				for (var i = 1; i <= limites.max_pax; i++)				
					cantidad_paxs.append('<option value="'+i+'">'+i+'</option>');				
				cantidad_paxs.val(sel_cantidad_paxs);

			});
			$(".paquete_luna_miel").change(function(){
				var capa_exterior = $(this).parent();
				var img_detalle_luna_miel = capa_exterior.find('img:.detalle_pql');
				
				if($(this).val()>0)
				{					
					img_detalle_luna_miel.css('display','');
				}
				else
					img_detalle_luna_miel.css('display','none');
			});
			$(".detalle_pql").click(function(){
				var capa_exterior = $(this).parent().parent();               
                var paquete_luna_miel = capa_exterior.find('select:.paquete_luna_miel');
				var id_paquete_luna_miel = paquete_luna_miel.val();
				var token = $("input[name='token']").val();
				if(id_paquete_luna_miel)
				{
					$.ajax({
					'url':  'con_alojamiento/paquete_luna_miel',
					'data':{'id_paquete':id_paquete_luna_miel, 'token': token},
					'dataType': 'json',
					'type': 'POST',
					'beforeSend': function(){
												
					},
					'success': function(data) {
						if(data.ok == 't')
						{
							alert(data.nombre+'\n\n'+data.descripcion);
						}
						else if(data.ok == 'f')
						{
							
						}											
					}
					});
				}
			});
			
			$(".input_cal").change(function() {
				prepare();
				precio($(this));
			});
			$(".cantidad_habitaciones").keyup(function() {

				if ($(this).val() > max_habitacion_reserva) {
					alert('<?php print trans('al_error_cantidad_habitaciones'); ?>' + max_habitacion_reserva);
					$(this).val(max_habitacion_reserva);
				}

				var cant_selected = $(this).val();
				if ( cant_selected > 0 )
                {
					var cant_habitacion = $('.formulario_alojamiento').length;
					var cant_for = cant_selected - cant_habitacion;
					if ( cant_for > 0 )
                    {
						var precio_habitacion_0=$('.formulario_alojamiento:eq(0) .precio_habitacion').val();
						var tipo_habitacion_0=$('#tipo_hab_principal').val();
						var selector_fecha_0=$('#fecha_principal').val();
						var hora_0=$('.formulario_alojamiento:eq(0) .hora').val();
						var noches_0=$('.formulario_alojamiento:eq(0) .noches').val();
						var plan_0=$('.formulario_alojamiento:eq(0) .plan').val();
						var cantidad_paxs_0=$('.formulario_alojamiento:eq(0) .cantidad_paxs').val();
						var ninno_adicional_0=$('.formulario_alojamiento:eq(0) .ninno_adicional').val();
						var paquete_luna_miel_0=$('.formulario_alojamiento:eq(0) .paquete_luna_miel').val();
						
						for (var i = 0; i < cant_for; i++)
						{
							$('.formulario_alojamiento:eq(0)').clone(true).insertAfter(".formulario_alojamiento:last");
							$('.formulario_alojamiento:last .numero_habitacion').html('<font>' + (i + cant_habitacion + 1)  + '</font>');
							$('.formulario_alojamiento:last .precio_habitacion').val(precio_habitacion_0);
							$('.formulario_alojamiento:last .tipo_habitacion').val(tipo_habitacion_0);
							$('.formulario_alojamiento:last .hora').val(hora_0);
							$('.formulario_alojamiento:last .noches').val(noches_0);
							$('.formulario_alojamiento:last .plan').val(plan_0);
							$('.formulario_alojamiento:last .cantidad_paxs').val(cantidad_paxs_0);
							$('.formulario_alojamiento:last .ninno_adicional').attr('name','ninno_adicional_'+(i+1));
							$('.formulario_alojamiento:last .ninno_adicional').val(ninno_adicional_0);
							$('.formulario_alojamiento:last .paquete_luna_miel').val(paquete_luna_miel_0);

						}
					}
					else
                    {
                        for (var i = 0; i > cant_for; i--) {
                            $('.formulario_alojamiento:last').remove();
                        }
                    }
				}

				prepare();

				total();
			});
			function prepare()
			{
				$('._tipo_hab').each(function (i, e) {
					$(e).val($('#tipo_hab_principal').val());
				});
				$('._fecha_hab').each(function (i, e) {
					$(e).val($('#fecha_principal').val());
				});
			}
			function precio(elemento)
			{
				var capa_form_parent = elemento.parent().parent().parent();
				
				var fecha = $('#fecha_principal').val();
				            
                var paxs = capa_form_parent.find('select:.cantidad_paxs').val();				
				if(paxs !='' && fecha !=='')
				{	
					var tipo_habitacion = $('#tipo_hab_principal').val();
					var noches = capa_form_parent.find('select:.noches').val();
					var plan = capa_form_parent.find('select:.plan').val();
					var ninno_adicional = capa_form_parent.find('input:.ninno_adicional').attr("checked")?true:'';
					var paquete_luna_miel = capa_form_parent.find('select:.paquete_luna_miel').val();				
					var fondo = $('<div class="box-modal-bg"/>');
					var token = $("input[name='token']").val();
					$.ajax({
					'url':  'con_alojamiento/calcular',
					'data':{'tipo_habitacion':tipo_habitacion,
							'fecha':fecha,
							'noches':noches,
							'plan':plan,
							'paxs':paxs,
							'ninno_adicional':ninno_adicional,
							'paquete_luna_miel':paquete_luna_miel,
						'token': token
							},
					'dataType': 'json',
					'type': 'POST',
					'beforeSend': function(){
						capa_form_parent.find('.loader_reserva').show();						
					},
					'success': function(data) {
						if(data.ok == 't')
						{
							capa_form_parent.find('span:.precio_habitacion_text').html(data.precio_convertido+' '+data.smb_moneda);
							capa_form_parent.find('input:.precio_habitacion').val(data.precio_convertido);
							$('.precio_reservacion').html(data.precio);
						}
						else if(data.ok == 'f')
						{
							capa_form_parent.find('input:.precio_habitacion').val(0);
							capa_form_parent.find('span:.precio_habitacion_text').html('');
							//alert(data.msg);
						}
						total();
						capa_form_parent.find('.loader_reserva').hide();						
					}
					});
				}
			}
			function total()
			{
				new_price = 0;
				$('.precio_reservacion').html('');
				var simb='';
				$('.precio_habitacion').each(function(index, term) {
					new_price += parseFloat($(this).val());
				});
				if(new_price > 0)
					$('.precio_reservacion').html(new_price+' '+'<?php print SIMBOLO_MONEDA; ?>');
			}
			function validar()
			{
				if($('.precio_reservacion').html()!=='')
					return true;
				alert('<?php print trans('al_error_reserva_incorrecta'); ?>');
				return false;
			}
			function hab_capacidad(id,max_pax,ninno_adicional)
			{
				this.id=id;
				this.max_pax=max_pax;
				this.ninno_adicional=ninno_adicional;
			}
			<?php
			print 'var capacidades_maximas = new Array();';
			$items=0;
			foreach($hotel['habitaciones_reserva'] as $h)
			{
				print 'capacidades_maximas['.$h['tipo_habitacion_fk'].']=new hab_capacidad('.$h['tipo_habitacion_fk'].','.$h['cantidad_pax'].',"'.$h['ninno_adicional'].'");';
			}
			?>
			<?php
			$paros_venta = $hotel['paros_venta'];
				foreach($paros_venta as $paro)
				{	
					$text_paro="['".date("Y/m/d",strtotime($paro['fecha_inicio']))."','".date("Y/m/d",strtotime($paro['fecha_fin']))."']";
					$paros_jscript[]=$text_paro;
				}
				$paros_tjscript="";
				if(sizeof($paros_venta)>0)
				 $paros_tjscript=implode(',',$paros_jscript);
				print 'var closedDates = ['.$paros_tjscript.'];';
				?>

			prepare();

			$('._tipo_hab').each(function (i, e) {
				precio($(this));
			});
		</script>
    </body>
</html>