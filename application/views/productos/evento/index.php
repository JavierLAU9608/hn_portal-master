<!DOCTYPE html>
<html lang="<?php $code_idioma = app_idioma_codigo(); print $code_idioma; ?>">
	<?php
		$titulo = app_traduccion('frontend','frontend_informacion_idioma','nombre','informacion_fk',$textopresentacion['id'],$textopresentacion['titulo']);
		$texto_presentacion = app_traduccion('frontend','frontend_informacion_idioma','descripcion','informacion_fk',$textopresentacion['id'],$textopresentacion['value']);
    ?>
	<?php head(array('titulo'=>trans('ev_evento'),'description'=>trans('seo_description_evento'),'keywords'=>trans('seo_keywords_evento'),'css'=>array('ui-lightness/jquery.ui.all.css'))); ?>
    <body>
        <?php top(array("title"=>$titulo,"subtitle"=>trans('ev_organiza'))); ?>
        <div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                	<div class="menu golden_bg upper">
                        <ul>
                        	<li><a style="cursor:auto;color:#000 !important;background-image:none !important;"><?php print trans('ev_le_ofrecemos'); ?></a></li>
                          <?php
						  foreach($tipo_servicios as $tipo)
						  {
							$tipo_servicio_nomb = app_traduccion('evento','evento_tipos_idioma','nombre','tipo_servicio_fk',$tipo['id'],$tipo['nombre']);
						  ?>
                          <li><a href="<?php print base_url(trans('ruta_eventos').'/'.$tipo['id']);?>"  class="<?php print $tipo['active'];?>"><?php print strtoupper( $tipo_servicio_nomb); ?></a></li>
                          <?php
						  }
						  ?>
                       </ul>
                    </div>
                    <?php
                    if($programacion_ev != '')
					{
						print trans('ev_ayuda_evento');
					}
					else
					{
						modulo_ofertas();
					}
					?>

        			<?php
					if(isset($estoy_en_sala)) {
					   print '<div class="divisor"></div>';
					   modulo_load(array('posicion'=>'publicidad_vertical'));
					}
					?>
                    <div class="clean_space" ></div>
                </div>
                <div id="center_area">
                <?php
				if($inicio)
				{
					$texto_presentacion = app_strip_etiquetas($texto_presentacion);
					$cutted  = word_limiter($texto_presentacion,40,'...',true);
					if(isset($cutted[0]) && $cutted[0])
					{
						print '<p id="cut-textpress"  class="verdana intro">'.$cutted[1].'</p>';
						print '<p id="hidden-textpress" class="verdana intro" style="display: none">'.$texto_presentacion.'</p>';
						print '<div class="right"><a id="togcut-textpress" class="toggle right" title="'.trans('leer_mas').'" data-pick="'.trans('recoger').'" ><span class="roman">'.trans('leer_mas').'</span><span class="fl"></span></a></div>';
					}
					else
					{
						print '<p class="verdana intro">'.$texto_presentacion.'</p>';
					}
				?>
                    <br class="clean"/><br/>
                 <?php
				}

				$clase_form = '';
				$title_form = trans('ev_nuevo_evento');
				$title_form_buttom = trans('ev_comenzar');
				if($programacion_ev != '')
				{
					$dias_evento = app_dias_restar_dates($programacion_ev['fecha_fin'],$programacion_ev['fecha']) +1;
					if(!isset($flash_error))
					{
				print '<div id="data_evento" class="form border_drk">';
				print '<h2>'.$programacion_ev['name_tipo_evento'].' '.trans('del').' '.app_str_date($programacion_ev['fecha']).' '.trans('al').' '.app_str_date($programacion_ev['fecha_fin']).' '.trans('ev_con').' '.$programacion_ev['no_participantes'].' '.trans('ev_participantes').'</h2>';
				print '<br class="clean_lttl_space"/>';
				print '<a id="editar_form_evento"  title="'.trans('editar').'" class="buttom roman" href="#" >'.trans('editar').'</a>';

				print '<a class="buttom roman"  title="'.trans('ev_cancelar_evento').'" href="'.base_url(trans('ruta_eventos_cancelar')).'" >'.trans('cancelar').'</a>';

				$clase_bt_fin = ( sizeof($prog_dias_ev) > 0 )?'':'disable_buttom';
				print '<a id="btn_fin_evento" class="buttom roman '.$clase_bt_fin.'" title="'.trans('ev_finalizar_evento').'" href="'.base_url(trans('ruta_reservar_evento')).'" >'.trans('finalizar').'</a><br class="clean" />';
				 		print '<br class="clean" />';
						print '<div class="precio_reserva">';
						print '<p class="verdana">'.trans('importe_total').':</p>';
						print '<span></span>';
						print '<p class="verdana yellow_bg" id="importe_total_evento">'.app_rate_cambio($precio_total,'smb').'</p>';
						print '</div>';



				if( sizeof($prog_dias_ev) > 0 )
				{
				print '<div id="hidden-x" class="hidden verdana"><br class="clean_lttl_space"/>';

				   for($i = 1 ; $i <= $dias_evento ; $i++ )
				   {
					   $dia_ev_tipo_servicio = isset($prog_dias_ev[$i])?$prog_dias_ev[$i]:array();
					   print '<h3>'.trans('ev_dia').' '.$i.'</h3>';
					   foreach($dia_ev_tipo_servicio as $id_tipo_ser => $dia_ev_servicio)
					   {
					   	$o = 0;
						   foreach($dia_ev_servicio as $id_servicio => $servicio)
						   {
							$tipo_servicio_nomb = app_traduccion('evento','evento_tipos_idioma','nombre','tipo_servicio_fk',$id_tipo_ser,$servicio["tipo_serv_nomb"]);
						    if($o == 0)print '<span>'.$tipo_servicio_nomb.':</span><br/>';

							$nombre_servicio = app_traduccion('evento','evento_servicio_idioma','nombre','servicio_fk',$id_servicio,$servicio["nomb_serv"]);
							$cant_servicio = ($servicio['cant_serv'] != 1)?trans('ev_cantidad').': '.$servicio['cant_serv']:'';

								print '<div class="precio_reserva">';
										    print '<a title="'.trans('eliminar').'" class="del" href="'.base_url('con_evento/del_servicio/'.$i.'/'.$id_tipo_ser.'/'.$id_servicio.'/'.$id_tipo_servicio).'"></a>';
											print '<p class="verdana ">'.$nombre_servicio.' '.$cant_servicio.'</p>';
											print '<span></span>';
											print '<p class="verdana border yellow_lite">'.app_rate_cambio($servicio['precio'],'smb').'</p>';
								print '</div><br class="clean" />';
								$o++;
						   }
					   }
				   }
				print '</div>';
				//print '<br/><a id="tog-x" class="toggle" href="#"  title="'.trans('ev_servicios_incluidos').'" data-pick="'.trans('recoger').'"><span>'.trans('ev_servicios_incluidos').'</span><span class="fl"></span></a>';
				}

					$href = ($sig_atras['sig'] == 'reserva')?base_url(trans('ruta_reservar_evento')):base_url(trans('ruta_eventos').'/'.$sig_atras['sig']);
					print '<h1><a class="right '.$sig_atras['sig'].'"  title="'.trans('siguiente').'" href="'.$href.'" ><img width="22" height="18" src="'.base_url('images/siguiente.png').'" /></a></h1>';

					print '<h1><a class="right '.$sig_atras['atras'].'"  title="'.trans('atras').'" href="'.base_url(trans('ruta_eventos').'/'.$sig_atras['atras']).'" ><img width="22" height="18" src="'.base_url('images/atras.png').'" /></a></h1>';

				print '<br class="clean_lttl_space"/>';
				print '</div>';
				$clase_form = 'hidden';
					}
				//--------------------------------
				$title_form = trans('ev_editando_evento');
				$title_form_buttom = trans('guardar');
                }

				if(!$inicio)
				{
					$clase_form = 'hidden';//no estoy en index de evento y no he comenzado a prog el evento
					print ($programacion_ev == '')?'<a href="'.base_url(trans('ruta_eventos')).'" class="flecha">'.trans('ev_comenzar_evento').'</a>':'';
				}
                ?>


                    <div id="form1_evento" class="form border_drk <?php print $clase_form; ?>">
						<?php echo form_open(base_url(trans('ruta_eventos')),array('name' => 'form1_evento')); ?>
                    	<h1><?php print $title_form;?></h1>
                        <?php
						if($inicio && $programacion_ev == ''){
						?>
                        <p class="verdana"><?php print trans('ev_descripcion_nuevo');?></p>
                        <p class="verdana"><?php print trans('ev_entre');?></p>
                        <?php } ?>
                        <br class="clean" />

                        <?php
                        if(isset($flash_error) && $flash_error !='')
							print
								'<div class="form_msg  verdana" style="background-color: #ebcccc">'.
								'<img src="'.base_url('images/error-msg.png').'">'. 'Error en el formulario <br/>'.
								$flash_error.
								'</div>';
						?>
                        <div class="col"><label><?php print trans('ev_inicio');?></label>
                        <input type="text" name="date_in_event"  id="date_in_event" class="fecha" value="<?php print (isset($flash_campos['date_in_event']))?$flash_campos['date_in_event']:(isset($programacion_ev['fecha'])?$programacion_ev['fecha']:'');?>" autocomplete="off" required="required"/>
                        </div>
                        <div class="col"><label><?php print trans('ev_fin');?></label>
                        <input type="text" name="date_out_event"  id="date_out_event"  class="fecha" value="<?php print (isset($flash_campos['date_out_event']))?$flash_campos['date_out_event']:(isset($programacion_ev['fecha_fin'])?$programacion_ev['fecha_fin']:'');?>" autocomplete="off" required="required"/>
                        </div>
                        <div class="col"><label><?php print trans('ev_tipo');?></label>

                        	<select  name="tipo_evento">
                                <?php
                                foreach($tipo_menu as $tipo)
								{
									if(isset($flash_campos['tipo_evento']))
											$selected = ($flash_campos['tipo_evento'] == $tipo['id'])?'selected="selected"':'';
									elseif(isset($programacion_ev['tipo_evento']))
											$selected = ($programacion_ev['tipo_evento'] == $tipo['id'])?'selected="selected"':'';
                                                                        else
                                                                            $selected = null;

									$tipo_menu_nomb = app_traduccion('evento','evento_tipom_idioma','nombre','tipo_menu_fk',$tipo['id'],$tipo['nombre']);
                                	print '<option '.$selected.' value="'.$tipo['id'].'">'.$tipo_menu_nomb.'</option>';
								}
                                ?>
                            </select></div>
                        <div class="col no_marg"><label><?php print trans('ev_no_participantes');?></label>
							<?php
								$temp = '';
								if (isset($flash_campos['no_participantes'])) {
									$temp = $flash_campos['no_participantes'];
								} else {
									if (isset($programacion_ev['no_participantes'])) {
										$temp = $programacion_ev['no_participantes'];
									}
								}
							?>
                        <input type="text" name="no_participantes" class="solo_numeros" value="<?php print $temp ?>" required="required"/>
                        </div>
                        <br class="clean" /><br/>
                        <input type="submit" class="buttom roman" value="<?php print $title_form_buttom;?>" />
                        <?php if($programacion_ev != '')
						{?><input id="cancelar_edicion_evento" type="submit" class="buttom roman" value="<?php print trans('cancelar');?>" />  <?php }?>
                         <br class="clean" />
                        </form>
                    </div>
                <?php
				 //CARRUSEL DE PAG INICIO EN EVENTOS ...
				 if($inicio)
				 {
				 ?> <br class="clean_lttl_space" />
                	<div class="list_imagenes">
                        <ul class="images_carrousel jcarousel-skin-tango" >
                        <?php
                           foreach($imagenes_salas as $imagen){
							$titulo_imagen = app_traduccion('hotel','hotel_imagenes_idioma','nombre','imagen_fk',$imagen['id'],$imagen['descripcion']);
                           print '<li><img class="border" title="'.$titulo_imagen.'"  alt="'.$titulo_imagen.'" width="180" height="129" src="'.app_url_admin().'/'.($this->ruta_galeria.'galeria-'.$imagen['url']).'"/></li>';
						   }
						?>
                        </ul>
                        <div class="divisor"></div>
                  <?php
				  }
				  //PRESENTACION TIPO DE SERVICIO
				  if( $id_tipo_servicio != NULL && isset($tipo_servicio_evento) && $tipo_servicio_evento['descripcion'] != '')
				  {
				  $tipo_servicio_descripcion = app_traduccion('evento','evento_tipos_idioma','descripcion','tipo_servicio_fk',$tipo_servicio_evento['id'],$tipo_servicio_evento['descripcion']);
				  print '<br class="clean"/>';
				  print app_strip_etiquetas($tipo_servicio_descripcion);
				  print '<br class="clean"/>';
				  }
				  //SERVICIOS PARA EVENTOS
				  if(isset($servicios_x_tipo))
				  {
				   print '<div id="list_products">';
				  				 $r = 0;
								 $s = 0;
                                foreach($servicios_x_tipo as $serv)
                                {$r++;$s++;
                                    $serv_trans = app_traduccion('evento','evento_servicio_idioma',NULL,'servicio_fk',$serv['id'],$serv);
									$nombre_servicio = $serv_trans['nombre'];
                                    print '<div >';	//class="imagenes"
										print '<h5>';
                                            print $nombre_servicio;
                                        print '</h5>';

										if(isset($serv['precio'])){
										print '<div class="precio_reserva right">';
											print '<p class="verdana">'.trans('precio').':</p>';
											print '<span></span>';
											print '<p class="verdana yellow_bg">'.$serv['precio'].'</p>';
											print '<br class="clean_lttl_space" />';
										print '</div>';
										}


										print '<br class="clean" />';
                                        print '<p class="verdana">'.$serv_trans['descripcion'].'</p>';
										$espacio = true;
										if(sizeof($serv['imagenes'])>0)
                                        {
										$espacio = false;
										?>
                                        <div class="divisor"><span class="l"></span><span class="r"></span></div>
                                        <div class="list_imagenes">
                        					<ul class="images_carrousel jcarousel-skin-tango" >
                                            <?php
											   $r = 0;
                                               foreach($serv['imagenes'] as $i)
                                               {
                                                   $titulo_imagen = app_traduccion('hotel','hotel_imagenes_idioma','nombre','imagen_fk',$i['imagen_fk'],$i['descripcion']);
                                                    print '<li>';
														print '<a href="'.app_url_admin().'/hoteles/'.app_hotel_id().'/images/zoom-'.$i['url'].'" title="'.$i['descripcion'].'" rel="lightbox[galeria_servicio_'.$i['servicio_fk'].']">';
                                                        	print '<img title="'.$titulo_imagen.'" alt="'.$titulo_imagen.'" class="border" src="'.app_url_admin().'/'.($this->ruta_galeria.'galeria-'.$i['url']).'" width="180" height="129"/>';
														print '</a>';
                                                    print '</li>';
													$r++;
                                               }
											   while($r < 3)
											   {
												print '<li>';
													print '<img class="border" src="'.base_url('images/thumb-padd2.jpg').'" width="180" height="129"/>';
                                                print '</li>';
												$r++;
											   }
                                            ?>
                                            </ul>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="divisor"><span class="l"></span><span class="r"></span></div>
                                        <?php
										}
										if($espacio)
									      print '<br class="clean_lttl_space" />';

										if($programacion_ev != '')
										{
										   print '<div  id="hidden-'.$s.'" class="form verdana border_thin" style="position:relative; display: none">';
										   print '<div class="loader_reserva">';
                            			   		print '<img style="margin-top: 74px;" src="images/loading_box.gif" alt="" />';
												print '<br />';
												print '<label>'.trans('procesando').'</label>';
										   print '</div>';

											echo form_open(base_url(trans('ruta_reservar_alojamiento')),array('class' => 'form_add_servicio', 'name' => 'form_servicio_dia_'.$s));

											   print '<input type="hidden" name="id_tipo_servicio" value="'.$id_tipo_servicio.'"/>';
											   print '<div class="verdana">'.trans('ev_reservar_para_dias').'</div>';
											   $precio_servicio = 0;
											   for($i = 1 ; $i <= $dias_evento ; $i++ )
											   {
												   $dia_chequeado = '';
												   $cantidad_guardada = 1;

												   $dia_ev_tipo_servicio = isset($prog_dias_ev[$i])?$prog_dias_ev[$i]:array();
												   $detalle_adicional_guardado = '';
												   if(isset($dia_ev_tipo_servicio[$id_tipo_servicio][$serv['id']]))
												   {
													   $datos_servicio_guardado = $dia_ev_tipo_servicio[$id_tipo_servicio][$serv['id']];
													   $dia_chequeado = 'checked="checked"';
													   $cantidad_guardada = $datos_servicio_guardado['cant_serv'];
													   $precio_servicio += $datos_servicio_guardado['precio'];
													   $detalle_adicional_guardado = $datos_servicio_guardado['detalle_adicional'];
												   }
												  $precio_servicio_smb = app_rate_cambio($precio_servicio,'smb');
												  print '<div class="col cuadro">';
													  print '<input type="checkbox" '.$dia_chequeado.'  name="dia_ev[]" value="'.$i.'" class="chk left" /><label><b>'.trans('ev_dia').' '.$i.'</b></label>';
													  $type_cant = ($serv['precio_cantidad_unica']=='t')?'hidden':'text';
													  print '<br/><label class="'.$type_cant.'">'.trans('ev_cantidad').': </label>';
													  if(($serv['cantidad_minima'] || $serv['cantidad_maxima']) && $serv['precio_cantidad_unica']!=='t')
													  {
														 $cantidad_minima =  $serv['cantidad_minima']?$serv['cantidad_minima']:1;
														 $cantidad_maxima =  $serv['cantidad_maxima']?$serv['cantidad_maxima']:300;
														 print '<select name="cantidad_ev[]" class="little marcar_check_select">';
														 for($j=$cantidad_minima;$j<=$cantidad_maxima;$j++)
														 {
															 if($cantidad_guardada == $j)
															 	print '<option selected="selected" value="'.$j.'">';
															 else
															 	print '<option value="'.$j.'">';
															 	print $j;
															 print '</option>';
														 }
														 print '</select>';
													  }
													  else
													  	print '<input type="'.$type_cant.'" name="cantidad_ev[]" class="solo_numeros little marcar_check" value="'.$cantidad_guardada.'" />';
													  print '<br/>';
													  print '<input class="marcar_check" type="text" placeholder="'.trans('ev_detalle_adicional').'" name="detalle_adicional[]" value="'.$detalle_adicional_guardado.'" />';
													  print '<input type="hidden" name="id_servicio" value="'.$serv['id'].'" />';
												  print '</div>';
											   }
												print '<br class="clean" />';
												print '<div class="precio_reserva">';
													print '<p class="verdana ">'.trans('precio').'</p>';
													print '<span></span>';
													print '<p class="verdana border yellow_lite precio_dia_servicio">'.$precio_servicio_smb.'</p>';
													print '<input type="buttom" class="buttom roman input_cal" value="'.trans('ev_aceptar').'" />';
												print '</div>';
												print '<br class="clean" />';
										   print '</form>';
										   print '</div>';
										   print '<br class="clean_lttl_space" />';
										   print '<a id="tog-'.$s.'" class="toggle" title="'.trans('ev_incluir').'" data-pick="'.trans('recoger').'" ><span>'.trans('ev_incluir').'</span><span class="fl"></span></a>';
										   if($precio_servicio>0)
										   {
											print '<div class="precio_reserva right">';
												print '<p class="verdana">'.trans('ev_importe_reservado').':</p>';
												print '<span></span>';
												print '<p class="verdana yellow_bg precio_servicio_reservado">'.$precio_servicio_smb.'</p>';
												print '<br class="clean_lttl_space" />';
											print '</div>';
											}
										   print '<br class="clean_lttl_space" />';
										}
                                    print '</div>';
									print '<div class="divisor"></div>';
                                }
                            print '</div>';
							}
				            ?>
                    </div>
                </div>
            </div>
        </div>
        <?php footer(array('js'=>array('ui/jquery.ui.datepicker-min.js','ui/jquery.ui.core-min.js','ui/i18n/jquery.ui.datepicker-'.$code_idioma.'.js'))); ?>
         <script language="javascript" type="application/javascript">
		 var release = 5;
		 jQuery(function($) {
			 //$("#date_in_event").datepicker({"dateFormat":"yy-mm-dd",minDate:release,maxDate:'1Y'},$.datepicker.regional[ "<?php print $code_idioma; ?>" ]);
			 //$("#date_out_event").datepicker({"dateFormat":"yy-mm-dd",minDate:release,maxDate:'1Y'},$.datepicker.regional[ "<?php print $code_idioma; ?>" ]);
			 $.datepicker.setDefaults($.datepicker.regional["<?php print $code_idioma; ?>"]);

			 var dates = $("#date_in_event, #date_out_event").datepicker({
				 dateFormat: "yy-mm-dd",
				 defaultDate: "+1w",
				 minDate: release,
				 maxDate: '1Y',
				 onSelect: function (selectedDate) {
					 var option = this.id == "date_in_event" ? "minDate" : "maxDate",
						 instance = $(this).data("datepicker"),
						 date = $.datepicker.parseDate(
							 instance.settings.dateFormat ||
							 $.datepicker._defaults.dateFormat,
							 selectedDate, instance.settings);
					 dates.not(this).datepicker("option", option, date);
				 }
			 });

			 $("#date_in_event").change(function (e) {
				 if ($("#date_in_event").val() > $("#date_out_event").val() && $("#date_out_event").val() != "") {
					 alert("<?php print trans('fecha_ini_menor_fecha_fin');?>");
					 $("#date_in_event").val("");
				 }
			 });

			 $("#date_out_event").change(function (e) {
				 if ($("#date_in_event").val() > $("#date_out_event").val() && $("#date_in_event").val() != "") {
					 alert("<?php print trans('fecha_ini_menor_fecha_fin');?>");
					 $("#date_out_event").val("");
				 }
			 });


			 $('#editar_form_evento').click(function (e) {
				 e.preventDefault();
				 $('#data_evento').hide('slow');
				 $('#form1_evento').removeClass('hidden').show('slide');

			 });
			 $('#cancelar_edicion_evento').click(function (e) {
				 e.preventDefault();
				 $('#form1_evento').hide('slow');
				 $('#data_evento').removeClass('hidden').show('slide');
			 });
			 $(".input_cal").click(function () {
				 var capa_div = $(this).parent();
				 var capa_form_parent = capa_div.parent();
				 $.ajax({
					 'url': 'con_evento/incluir_servicio',
					 'data': capa_form_parent.serialize(),
					 'dataType': 'json',
					 'type': 'POST',
					 'beforeSend': function () {
						 capa_form_parent.parent().find('.loader_reserva').show();
					 },
					 'success': function (data) {
						 if (data.ok == 't') {
							 //alert(data.msg);
							 capa_form_parent.find('.precio_dia_servicio').html(data.precio);
							 capa_form_parent.parent().parent().find('.precio_servicio_reservado').html(data.precio);
							 $("#importe_total_evento").html(data.precio_total);
							 if (data.precio_base_total > 0) {
								 $('a#btn_fin_evento').removeClass('disable_buttom');
								 $('a#btn_fin_evento').off('click');
							 }
							 else {
								 $('a#btn_fin_evento').addClass('disable_buttom');
								 $('a#btn_fin_evento').click(function (e) {
									 e.preventDefault();
								 });
							 }
						 }
						 else {
							 alert(data.msg);
						 }
						 capa_form_parent.parent().find('.loader_reserva').hide();
					 }
				 });
			 });
			 $('.marcar_check').keyup(function () {
				 if ($(this).val() !== '') {
					 $(this).parent().find('.chk').attr('checked', 'checked');
				 }
				 else {
					 $(this).parent().find('.chk').removeAttr('checked');
				 }
			 });
			 $('.marcar_check_select').change(function () {
				 if ($(this).val() !== '') {
					 $(this).parent().find('.chk').attr('checked', 'checked');
				 }
				 else {
					 $(this).parent().find('.chk').removeAttr('checked');
				 }
			 });
		 });
		 </script>
    </body>
</html>