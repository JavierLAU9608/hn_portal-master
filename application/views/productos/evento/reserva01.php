<!DOCTYPE html>
<html lang="<?php $code_idioma = app_idioma_codigo(); print $code_idioma; ?>">
	<?php
	    $dias_evento = app_dias_restar_dates($programacion_ev['options']['fecha_fin'],$programacion_ev['options']['fecha']) +1;
		$titulo =trans('reservar');
		$subtitle = $programacion_ev['options']['name_tipo_evento'].' '.trans('del').' '.app_str_date($programacion_ev['options']['fecha']).' '.trans('al').' '.app_str_date($programacion_ev['options']['fecha_fin']).' '.trans('ev_con').' '.$programacion_ev['options']['no_participantes'].' '.trans('ev_participantes');
		
    ?>
	<?php head(array('titulo'=>trans('ev_evento'),'description'=>trans('seo_description_evento'),'keywords'=>trans('seo_keywords_evento'),'css'=>array('ui-lightness/jquery.ui.all.css'))); ?>
    <body>
        <?php top(array("title"=>$titulo,"subtitle"=>$subtitle)); ?>
        <div class="white_bg">
            <div id="body" class="center">            	
                <div id="left_area">
                	<div class="menu golden_bg upper">
                        <ul>
                          <?php 
						  foreach($tipo_servicios as $tipo)
						  {
							$tipo_servicio_nomb = app_traduccion('evento','evento_tipos_idioma','nombre','tipo_servicio_fk',$tipo['id'],$tipo['nombre']);  
						  ?>
                          <li><a href="<?php print base_url(trans('ruta_eventos').'/'.$tipo['id']);?>" ><?php print strtoupper($tipo_servicio_nomb); ?></a></li>
                          <?php
						  }
						  ?>
                       </ul>
                    </div>                	
                    <?php modulo_load(); ?>
                    
                    <div class="clean_space" ></div>                   
                </div>
                <div id="center_area">
            				
                    <div id="form_reserva_evento" class="form border_drk">
                    <?php echo form_open(base_url(trans('ruta_crear_reserva_eventos')), array( 'name'=>"form_reserva_evento")); ?>

                    	<?php
						$total = 0;
                        if( sizeof($prog_dias_ev) > 0 )
						{
				    print '<div style="display: none" id="hidden-x" class="verdana"><br class="clean_lttl_space"/>';
				    
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
										    print '<a title="'.trans('eliminar').'" class="del" href="'.base_url('con_evento/del_servicio/'.$i.'/'.$id_tipo_ser.'/'.$id_servicio.'/reserva').'"></a>';
											print '<p class="verdana ">'.$nombre_servicio.' '.$cant_servicio.'</p>';
											print '<span></span>';
											print '<p class="verdana border yellow_lite">'.app_rate_cambio($servicio['precio'],'smb').'</p>';											
								print '</div><br class="clean" />';
								$total += $servicio['precio'];
								$o++;
								
						   }
					   }					  
				   }
				print '</div>';
				print '<br/><a id="tog-x" class="toggle" href="#"  title="'.trans('ev_servicios_incluidos').'" data-pick="'.trans('recoger').'"><span>'.trans('ev_servicios_incluidos').'</span><span class="fl"></span></a>';
				print '<span class="black right"><b>¡'.trans('reserva_a_confirmar').'!</b></span>';
				} 
				         ?> 
                          <?php
                        if(isset($flash_error) && $flash_error !='')
							print '<div class="form_msg  verdana">'.$flash_error.'</div>';								
						?>                     
                       <br class="clean" />
                       <div class="divisor"><span class="l"></span><span class="r"></span></div> 
                                                 
                        <div class="col"><label><?php print trans('ev_inicio');?></label>
                        <br/>
                        <label class="verdana detail"><?php print (isset($programacion_ev['options']['fecha']))?$programacion_ev['options']['fecha']:'';?></label>
                        <input type="hidden" name="date_in_event"  id="date_in_event" class="fecha" value="<?php print (isset($programacion_ev['options']['fecha']))?$programacion_ev['options']['fecha']:'';?>" />
                        </div>
                        <div class="col"><label><?php print trans('ev_fin');?></label><br/>
                        <label class="verdana detail"><?php print (isset($programacion_ev['options']['fecha_fin']))?$programacion_ev['options']['fecha_fin']:'';?></label>
                        <input type="hidden" name="date_out_event"  id="date_out_event"  class="fecha" value="<?php print (isset($programacion_ev['options']['fecha_fin']))?$programacion_ev['options']['fecha_fin']:'';?>" />
                        </div>                        
                        <div class="col no_marg"><label><?php print trans('ev_no_participantes');?></label><br/>
                        <label class="verdana detail"><?php print (isset($programacion_ev['options']['no_participantes']))?$programacion_ev['options']['no_participantes']:'';?></label>
                        <input type="hidden" name="no_participantes" class="solo_numeros" value="<?php print (isset($programacion_ev['options']['no_participantes']))?$programacion_ev['options']['no_participantes']:'';?>"  />
                        </div>
                        <br class="clean" />
                        <div class="col solo1"><label><?php print trans('ev_tipo');?></label><br/>
                                <?php 
                                foreach($tipo_menu as $tipo)
								{									
									if($programacion_ev['options']['tipo_evento'] == $tipo['id'])
									{
										$tipo_menu_nomb = app_traduccion('evento','evento_tipom_idioma','nombre','tipo_menu_fk',$tipo['id'],$tipo['nombre']);                                 		?>
                                        <label class="verdana detail"><?php print $tipo_menu_nomb; ?></label>
                                        <input type="hidden" id="tipo_evento" name="tipo_evento" value="<?php print $tipo['id']; ?>"/>
                                        <?php
									}								
								}
                                ?>
                            <input type="hidden" id="name_tipo_evento" name="name_tipo_evento" value="<?php print (isset($programacion_ev['options']['name_tipo_evento']))?$programacion_ev['options']['name_tipo_evento']:'';?>" />
                            </div>
                        
                         
                        <?php if(isset($key_car_reserva)){ ?>
                        <input  type="hidden" name="key_car_reserva" value="<?php print $key_car_reserva; ?>"/>
                        <?php } ?>
                        <br class="clean" />
                       <div class="divisor"><span class="l"></span><span class="r"></span></div>   
   
  
                        <div class="col solo2">
                        <label><?php print trans('ev_nombre_evento').'*';?></label>
                        <input type="text" name="nombre" class="numeros_letras" value="<?php print (isset($programacion_ev['options']['nombre']))?$programacion_ev['options']['nombre']:(isset($flash_error)?$datos_enviados['nombre']:'');?>"/>
                        <br class="clean"/><br />                        
                        <label><?php print trans('presentacion');?></label>
                        <textarea name="presentacion" class="numeros_letras"><?php print (isset($programacion_ev['options']['presentacion']))?$programacion_ev['options']['presentacion']:(isset($flash_error)?$datos_enviados['presentacion']:'');?></textarea>
                        <br class="clean"/><br /><label><b><?php print trans('ev_responsable_evento').': ';?></b></label> <br class="clean"/>
                        <label><?php print trans('nombre_completo').'*';?></label>
                        <input type="text" name="nombre_completo" class="numeros_letras" value="<?php print (isset($programacion_ev['options']['nombre_completo']))?$programacion_ev['options']['nombre_completo']:(isset($flash_error)?$datos_enviados['nombre_completo']:'');?>" />
                       <br class="clean"/><br />
                        <label><?php print trans('telefono').'*';?></label>
                        <input type="text" name="telefono" class="solo_numeros" value="<?php print (isset($programacion_ev['options']['telefono']))?$programacion_ev['options']['telefono']:(isset($flash_error)?$datos_enviados['telefono']:'');?>" />
                        <br class="clean"/><br />
                        <label><?php print trans('ciudad');?></label>
                        <input type="text" name="ciudad" class="numeros_letras" value="<?php print (isset($programacion_ev['options']['ciudad']))?$programacion_ev['options']['ciudad']:(isset($flash_error)?$datos_enviados['ciudad']:'');?>" />                        
                        <br class="clean"/><br />
                        <label><?php print trans('user_pais');?></label>
                        <select  name="pais">
                            <?php
                                $paises = app_paises();
                                foreach($paises as $p)
                                {
									$selected = '';
                                    if(isset($programacion_ev['options']['pais']) && $programacion_ev['options']['pais'] == $p['id'])
                                        $selected = 'selected="selected"';                                    
                                    if(isset($flash_error) && isset($datos_enviados['pais']) && $datos_enviados['pais'] == $p['id'])
										 $selected = 'selected="selected"';   
                                    print '<option '.$selected.' value="'.$p['id'].'">';
                                        print $p['nombre'];
                                    print '</option>';
                                }
                            ?>                            
                        </select>
                        </div>
                        
                        <div class="col solo2 no_marg" >
                        <label><?php print trans('ev_nombre_empresa');?></label>
                        <input type="text" name="nombre_empresa" class="numeros_letras" value="<?php print (isset($programacion_ev['options']['nombre_empresa']))?$programacion_ev['options']['nombre_empresa']:(isset($flash_error)?$datos_enviados['nombre_empresa']:'');?>"  />
                         <br class="clean"/><br />  
                        <label><?php print trans('descripcion');?></label>
                        <textarea name="descripcion" class="numeros_letras"><?php print (isset($programacion_ev['options']['descripcion']))?$programacion_ev['options']['descripcion']:(isset($flash_error)?$datos_enviados['descripcion']:'');?></textarea>
                        <br class="clean"/><br /><label>&nbsp;</label><br class="clean"/>
                        <label><?php print trans('cargo');?></label>
                        <input type="text" name="cargo" class="numeros_letras" value="<?php print (isset($programacion_ev['options']['cargo']))?$programacion_ev['options']['cargo']:(isset($flash_error)?$datos_enviados['cargo']:'');?>"  />
                       <br class="clean"/><br />
                        <label><?php print trans('email').'*';?></label>
                        <input type="text" name="email" class="correo" value="<?php print (isset($programacion_ev['options']['email']))?$programacion_ev['options']['email']:(isset($flash_error)?$datos_enviados['email']:'');?>"  /> 
                        <br class="clean"/><br />
                        <label><?php print trans('sitio_web');?></label>
                        <input type="text" name="sitio_web" class="numeros_letras" value="<?php print (isset($programacion_ev['options']['sitio_web']))?$programacion_ev['options']['sitio_web']:(isset($flash_error)?$datos_enviados['sitio_web']:'');?>"  /> 
                        </div>
                       
                        <br class="clean" /><br/>
                        
                         <?php 
						print '<div class="precio_reserva">';						
						print '<p class="verdana">'.trans('pagar').':</p>';
						print '<span></span>';
						print '<p class="verdana yellow_bg">'.app_rate_cambio($precio_total,'smb').'</p>';	
						print ' <input type="submit" class="buttom roman" name="btn_continuar" value="'.trans('continuar').'" />';
						print '<input class="buttom roman" type="submit" name="btn_cancelar" value="'.trans('cancelar').'">';
						print '</div>';						
						 ?> 
                       	
                        
                                   <br class="clean" />
                        </form>
                    </div>
               
                    </div>
                </div>              
            </div>
        </div>
        <?php footer(array('js'=>array('ui/jquery.ui.datepicker.js','ui/jquery.ui.core.js','ui/i18n/jquery.ui.datepicker-'.$code_idioma.'.js'))); ?>
         <script language="javascript" type="application/javascript">
		 var release = 10;
         jQuery(function($) {
             $("#date_in_event").datepicker({
                 "dateFormat": "yy-mm-dd",
                 minDate: release,
                 maxDate: '1Y'
             }, $.datepicker.regional["<?php print $code_idioma; ?>"]);
             $("#date_out_event").datepicker({
                 "dateFormat": "yy-mm-dd",
                 minDate: release,
                 maxDate: '1Y'
             }, $.datepicker.regional["<?php print $code_idioma; ?>"]);

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

             $("#tipo_evento").change(function (e) {
                 $("#name_tipo_evento").val(getText("tipo_evento", $(this).val()));
             });
         });
		 </script>        
    </body>
</html>