<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('reserva_datos_del_titular'))); ?>
    <body>
        <?php top(array('title'=>trans('reserva_datos_del_titular'))); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                    <?php modulo_load(); ?>
                </div>

                <div id="center_area">
                    <div style="margin-bottom: 20px;">
                        <?php echo trans('al_texto_intro_reserva') ?>
                        <br/>
                        <a target="_blank" href="<?php echo base_url('informacion/Reservar-y-pagar') ?>"><?php echo trans('al_texto_intro_reserva_link') ?></a>
                    </div>

                	<div class="form border_drk">
                        <?php echo form_open(base_url('con_reservacion/confirmar_pagar'), array('id' => 'form_detalles_reserva')); ?>

                            <div class="info_center_reserva cuerpo_dato_reserva">
                            	<?php
                                if($existen_productos_no_confirmar == true)
								{
									print '<p class="verdana intro">';
									print trans('reservaciones').': <b>'.trans('reserva_a_confirmar').'</b>';
									foreach($formas_pago as $forma_pago)
                                    {
										if($forma_pago['predeterminado']=='t')
											print '<input type="hidden" name="forma_pago" id="forma_pago" value="'.$forma_pago['id'].'"/>';
									}
									print '</p>';
								}
								else
								{
								?>
                            	<p class="verdana intro">
                                <?php
                                if ($formas_pago) {
								print trans('reserva_forma_pago');
								print '<br class="clean" /><br/>';
                                    print '<ol style="list-style-type:none">';
                                        foreach($formas_pago as $forma_pago)
                                        {
                                            $cheked='';
                                            print '<li>';
                                                if($forma_pago['predeterminado']=='t')
                                                    $cheked='checked="checked"';
                                                      $texto_forma_pago=$forma_pago['descripcion'];
                                                      print '<label style="cursor:pointer;"><input type="radio" '.$cheked.' title="'.$texto_forma_pago.'" name="forma_pago" id="forma_pago" value="'.$forma_pago['id'].'" style="margin-right:20px;"/>'.$texto_forma_pago.'</label>';
                                            print '</li>';
                                            print '<br/>';
                                            $cheked='';
                                        }
                                    print '</ol>';
                                ?>
                                </p>
                                <?php
								}
								}
								?>
								<?php if(isset($flash_error) && (string)$flash_error!==''){
                                    print '<p class="verdana"><br class="clean"/><div class="form_msg  verdana">'.$flash_error.'</div></p>';
                                } ?>

                            </div>

                            <div class="info_center_reserva cuerpo_dato_reserva">
                                <p class="verdana intro">
                                    <?php echo trans('al_cards') ?>
                                </p>

                                <div class="radio-list">
								<?php
                                if (defined('ENVIRONMENT') && ENVIRONMENT == 'development') { ?>
                                    <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5">
                                            <span class="checked">
                                                <input type="radio" value="10" id="optionsRadios5" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img title="VISA ELECTRON" height='50' src="images/tarjetas/visa-electron.jpg"/>
                                    </label>
                                <?php } else {
								foreach($tarjetas as $tarj){
								?>
									<label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios4">
                                            <span class="">
                                                <input type="radio" checked="" value="<?php print $tarj;?>" id="optionsRadios4" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img height='50' src="images/tarjetas/<?php print $tarj;?>.jpg"/>
                                    </label>
								<?php
								}
								}
								?>
                                    <!--label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios4">
                                            <span class="">
                                                <input type="radio" checked="" value="2" id="optionsRadios4" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img title="VISA" height='50' src="images/tarjetas/visa.jpg"/>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5">
                                            <span class="checked">
                                                <input type="radio" value="10" id="optionsRadios5" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img title="VISA ELECTRON" height='50' src="images/tarjetas/visa-electron.jpg"/>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5">
                                            <span class="checked">
                                                <input type="radio" value="3" id="optionsRadios5" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img title="MASTERCARD" height='50' src="images/tarjetas/mastercard.jpg"/>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5">
                                            <span class="checked">
                                                <input type="radio" value="9" id="optionsRadios5" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img title="MAESTRO INTERNACIONAL" height='50' src="images/tarjetas/maestro.jpg"/>
                                    </label>
                                    <!--label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5">
                                            <span class="checked">
                                                <input type="radio" value="5" id="optionsRadios5" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img height='50' src="images/tarjetas/jcb.jpg"/>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5">
                                            <span class="checked">
                                                <input type="radio" value="4" id="optionsRadios5" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img height='50' src="images/tarjetas/diners.jpg"/>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5">
                                            <span class="checked">
                                                <input type="radio" value="1" id="optionsRadios5" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img title="AMERICAN EXPRESS" height='50' src="images/tarjetas/amex.jpg"/>
                                    </label>
									<label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5">
                                            <span class="checked">
                                                <input type="radio" value="6" id="optionsRadios5" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img title="4B" height='50' src="images/tarjetas/4d.jpg"/>
                                    </label>
                                    <!--label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5">
                                            <span class="checked">
                                                <input type="radio" value="8" id="optionsRadios5" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img height='50' src="images/tarjetas/servired.jpg"/>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5">
                                            <span class="checked">
                                                <input type="radio" value="7" id="optionsRadios5" name="optionsRadios">
                                            </span>
                                        </div>
                                        <img title="EURO6000" height='50' src="images/tarjetas/euro6000.jpg"/>
                                    </label-->
                                </div>
                            </div>

                        <br class="clean" />
                            <div class="divisor"><span class="l"></span><span class="r"></span></div>
                            <br class="clean" />
                            <div>
                                <div class="titulares">
                                    <input name="titular_diferente" id="titular_diferente" type="checkbox" <?php if($marcado_regalo){print 'checked="checked"';} ?> value="1"/>
                                    <label for="titular_diferente"><?php print trans('titular_diferente'); ?></label>
                                </div>
                                <div>
                                	<br class="clean" />
                                    <div class="titular" id="titular_reserva" style="float:left;width:45%">
                                    	<div class="col solo2">
                                        	<label><?php print trans('datos_personales');?></label>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
											<label><?php print trans('titular_reserva');?>:</label>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
                                        	<label for="nombre_titular"><?php print trans('nombre_apellidos');?> *</label><br/>
                                        	<input required="required" type="text" value="<?php print (isset($usuario['nombre_titular'])?$usuario['nombre_titular']: (isset($usuario['nombre']) ? $usuario['nombre'] : '')); ?>" name="nombre_titular" class="numeros_letras"/>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
                                        	<label for="pais_titular"><?php print trans('pais_residencia');?> *</label><br/>
                                        	<select required="required" name="pais_titular">
                                                <option value=""><?php print trans("seleccione"); ?></option>
                                                <?php
                                                    $paises = app_paises();
                                                    foreach($paises as $p)
                                                    {
														if(isset($usuario['pais_fk']) && $usuario['pais_fk'] == $p['id'])
                                                        	print '<option selected="selected" value="'.$p['id'].'">';
                                                         else
														 	print '<option value="'.$p['id'].'">';
															print ($p['nombre_trad']!=NULL && trim($p['nombre_trad'])!="")?$p['nombre_trad']:$p['nombre'];//$p['nombre'];
                                                        	print '</option>';
                                                    }
                                                ?>
                                        	</select>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
                                        	<label for="pasaporte_titular"><?php print trans('pasaporte');?> *</label><br/>
                                                <input required="required" type="text" value="<?php print (isset($usuario['pasaporte_titular'])?$usuario['pasaporte_titular']:(isset($usuario['pasaporte'])?$usuario['pasaporte']:'')); ?>" name="pasaporte_titular" class="numeros_letras"/>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
                                        	<label for="email_titular"><?php print trans('email');?> *</label><br/>
                                        	<input required="required" type="email" value="<?php print (isset($usuario['email_titular'])?$usuario['email_titular']:(isset($usuario['correo'])?$usuario['correo']:'')); ?>" name="email_titular" class="correo"/>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
                                        	<label for="telefono_titular"><?php print trans('telefono');?></label><br/>
                                        	<input type="text" value="<?php print (isset($usuario['telefono_titular'])?$usuario['telefono_titular']:(isset($usuario['telefono_titular'])?$usuario['telefono_titular']:'')); ?>" name="telefono_titular" class="solo_numeros"/>
                                        </div>
                                        <br class="clean" /><br/>

                                    </div>
                                    <div class="titular margen_titular" id="titular_tarjeta" style="<?php if(!$marcado_regalo){print 'display:none;';} ?>float:right;width:45%;margin-right:20px;">
                                        <div class="col solo2">
											<label><?php print trans('datos_personales');?></label><br/>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
                                        	<label><?php print trans('titular_tarjeta_credito');?>:</label><br/>
                                        </div>
    									<br class="clean" /><br/>
                                        <div class="col solo2">
                                            <label for="nombre_titular_tarjeta"><?php print trans('nombre_apellidos');?> *</label><br/>
                                            <input type="text" value="<?php print (isset($usuario['nombre_titular_tarjeta'])?$usuario['nombre_titular_tarjeta']:''); ?>" name="nombre_titular_tarjeta" class="numeros_letras"/>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
                                            <label for="pais_titular_tarjeta"><?php print trans('pais_residencia');?> *</label><br/>
                                            <select name="pais_titular_tarjeta">
                                                <option value=""><?php print trans("seleccione"); ?></option>
                                                <?php
                                                    foreach($paises as $p)
                                                    {
                                                        $p_titu = isset($usuario['pais_titular_tarjeta']) ? $usuario['pais_titular_tarjeta'] : '';
                                                        $selected = $p['id'] == $p_titu ? 'selected="selected"' : '';
                                                        print '<option '.$selected.' value="'.$p['id'].'">';
                                                            print $p['nombre'];
                                                        print '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
                                            <label for="pasaporte_titular_tarjeta"><?php print trans('pasaporte');?> *</label><br/>
                                            <input  type="text" value="<?php print (isset($usuario['pasaporte_titular_tarjeta'])?$usuario['pasaporte_titular_tarjeta']:''); ?>" name="pasaporte_titular_tarjeta" class="numeros_letras"/>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
                                            <label for="email_titular_tarjeta"><?php print trans('email');?> *</label><br/>
                                            <input type="text" value="<?php print (isset($usuario['email_titular_tarjeta'])?$usuario['email_titular_tarjeta']:''); ?>" name="email_titular_tarjeta" class="correo"/>
                                        </div>
                                        <br class="clean" /><br/>
                                        <div class="col solo2">
                                            <label for="telefono_titular_tarjeta"><?php print trans('telefono');?></label><br/>
                                            <input type="text" value="<?php print (isset($usuario['telefono_titular_tarjeta'])?$usuario['telefono_titular_tarjeta']:''); ?>" name="telefono_titular_tarjeta" class="solo_numeros"/>
                                        </div>
                                        <br class="clean" /><br/>
                                    </div>
                                    <br class="clean" />
                                    <div class="requerido">
                                        * <?php print trans('requerido');?>
                                    </div>
                                </div>
                            </div>

                            <div class="info_center_reserva margen_borde pie_datos_reserva">
                                <div class="divisor"><span class="l"></span><span class="r"></span></div>
								<div id="aceptacion_reserva">
									<br/>
										<font class="letra_aceptacion_terminos margen_imp">
											<a href="noticias/garantizamos-la-seguridad-de-sus-pagos/15" style="font-size:18px;" target="_blank"><?php print trans('texto_garantizamos_seguridad');?></a>
										</font>
									<br/>
                                    <br/>
                                </div>
                                <div id="aceptacion_reserva">
                                    <font class="letra_aceptacion_terminos margen_imp">

                                    </font>
                                    <p>
                                        <input required="required" type="checkbox" name="aceptar_terminos" id="aceptar_terminos" value="1" style="margin-right:20px;"/>
                                        <label id="texto_aceptar_terminos" for="aceptar_terminos">
                                            <?php print trans('texto_aceptar_terminos_condiciones');?>
                                        </label>
                                    </p>
                                    <br/>
                                    <br/>
                                </div>
                                <div id="other_verificacion">
                                    <div>
                                        <input title="" type="submit" name="btn_confirmar_y_pagar" value="<?php print trans('continuar');?>" class="buttom roman" id="btn_confirmar_y_pagar" />
                                    </div>
                                </div>
                                <br class="clean" /><br/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php footer(); ?>
        <script language="javascript" type="application/javascript">
		$("#titular_diferente").click(function(){
			$("#titular_tarjeta").toggle();
		});
		</script>
    </body>
</html>