<!DOCTYPE html>
<html lang="<?php $code_idioma = app_idioma_codigo(); print $code_idioma; ?>">
	<?php
	    $dias_evento = app_dias_restar_dates($programacion_ev['options']['fecha_fin'],$programacion_ev['options']['fecha']) +1;
		$titulo =trans('reserva_datos');
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
                    <?php echo form_open(base_url(trans('ruta_crear_reserva_eventos')),array( 'name'=>"form_reserva_evento")); ?>

                    	<?php
                        if( sizeof($prog_dias_ev) > 0 )
						{
				    print '<div style="display: none" id="hidden-x" class="verdana"><br class="clean_lttl_space"/>';
				  
				   for($i = 1 ; $i <= $dias_evento ; $i++ )
				   {
					   $dia_ev_tipo_servicio = isset($prog_dias_ev[$i])?$prog_dias_ev[$i]:array();
					   print '<h3>'.trans('ev_dia').' '.$i.'</h3>';
					   $total = 0;
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
                       
                        <div class="col solo2"><label><?php print trans('ev_inicio');?></label><br/>
                        <label class="verdana detail"><?php print app_str_date($programacion_ev['options']['fecha']);?> </label>
                        <br class="clean" /><br/>
                        <label><?php print trans('ev_tipo');?></label><br/>
                        <label class="verdana detail">
                        <?php 
						
						foreach($tipo_menu as $tipo)
						{									
							if(isset($programacion_ev['options']['tipo_evento']))
							{
								if( $programacion_ev['options']['tipo_evento'] == $tipo['id'] )
								{
									$tipo_menu_nomb = app_traduccion('evento','evento_tipom_idioma','nombre','tipo_menu_fk',$tipo['id'],$tipo['nombre']); 
									print $tipo_menu_nomb;	
								}
							}
						}
						?>
                        </label>
                        </div>
                        
                         <div class="col solo2"><label><?php print trans('ev_fin');?></label><br/>
                        <label class="verdana detail"><?php print app_str_date($programacion_ev['options']['fecha_fin']);?> </label>
                         <br class="clean" /><br/>
                         <label><?php print trans('ev_no_participantes');?></label><br/>
                         <label class="verdana detail"><?php print $programacion_ev['options']['no_participantes'];?></label>
                        </div>
                                            
                        <br class="clean" />
                        <div class="divisor"><span class="l"></span><span class="r"></span></div>   
   
 						<div>
                            <div class="col solo2">
                            <label><?php print trans('ev_nombre_evento');?></label><br/>
                            <label class="verdana detail"><?php print $programacion_ev['options']['nombre'];?></label>
                            </div>
                            <div class="col solo2 no_marg">
                            <label><?php print trans('ev_nombre_empresa');?></label><br/>
                            <label class="verdana detail"><?php print $programacion_ev['options']['nombre_empresa'];?></label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                        <div>
                            <div class="col solo2">
                            <label><?php print trans('presentacion');?></label><br/>
                            <label class="verdana"><?php print $programacion_ev['options']['presentacion'];?></label>
                            </div>
                            <div class="col solo2 no_marg">
                            <label><?php print trans('descripcion');?></label><br/>
                            <label class="verdana"><?php print $programacion_ev['options']['descripcion'];?></label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                        <br class="clean_lttl_space"/>
                        <div class="col solo2">
                        <label><b><?php print trans('ev_responsable_evento').': ';?></b></label>
                        </div><br class="clean"/>
                        <div>
                            <div class="col solo2">
                            <label><?php print trans('nombre_completo');?></label><br/>
                            <label class="verdana detail"><?php print $programacion_ev['options']['nombre_completo'];?></label>
                            </div>
                            <div class="col solo2 no_marg">
                            <label><?php print trans('cargo');?></label><br/>
                            <label class="verdana detail"><?php print $programacion_ev['options']['cargo'];?></label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                        <div>
                            <div class="col solo2">
                            <label><?php print trans('telefono');?></label><br/>
                            <label class="verdana detail"><?php print $programacion_ev['options']['telefono'];?></label>
                            </div>
                            <div class="col solo2 no_marg">
                            <label><?php print trans('email');?></label><br/>
                            <label class="verdana detail"><?php print $programacion_ev['options']['email'];?></label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                        <div>
                            <div class="col solo2">
                            <label><?php print trans('ciudad');?></label><br/>
                            <label class="verdana detail"><?php print $programacion_ev['options']['ciudad'];?></label>
                            </div>
                            <div class="col solo2 no_marg">
                            <label><?php print trans('sitio_web');?></label><br/>
                            <label class="verdana detail"><?php print $programacion_ev['options']['sitio_web'];?></label>
                            </div>
                        </div>
                        <br class="clean" /><br/>
                        <div>
                            <div class="col solo2">
                            <label><?php print trans('user_pais');?></label><br/>
                            <label class="verdana detail">
							<?php
                            $paises = app_paises();
                                foreach($paises as $p)
                                {
                                    if(isset($programacion_ev['options']['pais']))
									{
                                      if($programacion_ev['options']['pais'] == $p['id'])                                   
                                      {
										 print $p['nombre'];
									  }
									}
                                }
							?>
                            </label>
                            </div>                           
                        </div>
                       
                        <br class="clean" /><br/>
                      
                        <?php 
						print '<div class="precio_reserva">';						
						print '<p class="verdana">'.trans('pagar').':</p>';
						print '<span></span>';
						print '<p class="verdana yellow_bg">'.app_rate_cambio($total_price,'smb').'</p>';						
						print '<a class="buttom roman" href="'.base_url(trans('ruta_reservar_evento')).'"  title="'.trans('anterior').'"  >'.trans('anterior').'</a>';
						print '<a class="buttom roman"  title="'.trans('ev_cancelar_evento').'" href="'.base_url(trans('ruta_carro_compra_cancelar',array('rowid'=>$programacion_ev['rowid']))).'" >'.trans('cancelar').'</a>';
						print '<a class="buttom roman" href="'.base_url(trans('ruta_carro_compra')).'" title="'.trans('ver_carrito').'"  >'.trans('ver_carrito').'</a>';
						print '</div>';						
						 ?>  
                         <br class="clean_space" />
                        </form>
                    </div>
               
                    </div>
                </div>              
            </div>
        </div>
        <?php footer(array('js'=>array('ui/jquery.ui.datepicker.js','ui/jquery.ui.core.js','ui/i18n/jquery.ui.datepicker-'.$code_idioma.'.js'))); ?>
    </body>
</html>