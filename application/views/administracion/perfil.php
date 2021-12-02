<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
<?php
$titulo = (isset($history) && ($history))?trans('user_historial'):trans('user_datos_personales');
$subtitulo = $user_registrado['nombre'];
?>
<?php head(array('titulo'=>$subtitulo,'description'=>trans('seo_description_home'),'keywords'=>trans('seo_keywords_home')));?>
<body>
<?php top(array("title"=>$titulo,"subtitle"=>$subtitulo)); ?>
<div class="white_bg">
            <div id="body" class="center">
            	<div id="left_area">
                    <?php menu_vertical(array('items'=>$items,'item_activo'=>$item_activo)); ?>
                    <div class="clean_space" ></div>
                </div>
                <div id="center_area">
                	<?php
					if(!isset($history))
					{
						$show = (isset($flash_error) && $flash_error !='')?'style="display:none"':'';
						$edit_error = (isset($flash_error) && $flash_error !='')?'':'style="display:none"';
					?>
                	<div class="form border_drk data_perfil" <?php print $show;?>>
                        <?php
							print '<h1><a class="edit_perfil"><img width="22" height="23" src="'.base_url('images/editar.png').'" />'.trans('user_datos_editar').'</a></h1>';
							print '<ul class="micuenta verdana">';
							print '<li>'.trans('nombre_completo').': <span>'.$user_registrado['nombre'].'</span></li>';
							print '<li>'.trans('correo').': <span>'.$user_registrado['correo'].'</span></li>';
							print '<li>'.trans('user_pais').': <span>'.$user_registrado['pais']['nombre'].'</span></li>';
							$pasaporte = ($user_registrado['pasaporte'] == 0)?'--------':$user_registrado['pasaporte'];
							print '<li>'.trans('pasaporte').': <span>'.$pasaporte.'</span></li>';
							print '</ul>';
						?>
                        <br class="clean_lttl_space" />
                    </div>
                    <div class="form border_drk edicion_perfil" <?php print $edit_error;?>>
                        <?php echo form_open('con_micuenta/upd_registro', array('name' => 'form_edicion_registro')); ?>

                    	<?php print '<h1><a class="reg_data_perfil"><img width="22" height="18" src="'.app_imagen_base64('images/atras.png',array('ruta_interna'=>true)).'" />'.trans('user_regresar_original').'</a></h1>';
						print '<br class="clean_lttl_space" />';
						if(isset($flash_error) && $flash_error !='')
							print '<div class="form_msg  verdana">'.$flash_error.'</div>';

						?>
                        <div class="col solo2">
                        <label><?php print trans('nombre_completo');?></label>
                        <input type="text" name="nombre"  value="<?php print (isset($flash_campos['nombre']))?$flash_campos['nombre']:$user_registrado['nombre'];?>"/>
                        </div>
                        <div class="col solo2">
                        <label><?php print trans('correo');?></label>
                        <input type="text" name="correo" value="<?php print (isset($flash_campos['correo']))?$flash_campos['correo']:$user_registrado['correo'];?>" />
                        </div>
                        <br class="clean" /><br/>
                        <div class="col solo2">
                        <label><?php print trans('user_pais');?></label>
                        	<select  name="pais">
                                <?php
									$paises = app_paises();
									foreach($paises as $p)
									{
										if(isset($flash_campos['pais']))
											$selected = ($flash_campos['pais'] == $p['id'])?'selected="selected"':'';
										else
											$selected = ($user_registrado['pais_fk'] == $p['id'])?'selected="selected"':'';

										print '<option '.$selected.' value="'.$p['id'].'">';
											print $p['nombre'];
										print '</option>';
									}
								?>
                            </select>
                        </div>
                            <?php $pasaporte = ($user_registrado['pasaporte'] == 0)?'':$user_registrado['pasaporte'];?>
                        <div class="col solo2 no_marg">
                        <label><?php print trans('pasaporte');?></label>
                        <input type="text" name="pasaporte" class="numeros_letras" value="<?php print (isset($flash_campos['pasaporte']))?$flash_campos['pasaporte']:$pasaporte;?>"  />
                        </div>

                        <?php
						$hidden		   = (isset($flash_campos['password_edit']) && $flash_campos['password_edit'] != '')?'':' style="display:none"';
                        $ver_tog 	   = (isset($flash_campos['password_edit']) && $flash_campos['password_edit'] != '')?trans('recoger'):trans('cambiar_pasword');
						$clase_lnk_tog = (isset($flash_campos['password_edit']) && $flash_campos['password_edit'] != '')?' pickup':'';
						?>
                        <div id="hidden-1" class="col solo2" <?php print $hidden;?>>
                        <br/>
                        <label><?php print trans('contrasenna');?></label>
                        <input type="password" name="password_edit"  value="<?php print (isset($flash_campos['password_edit']))?$flash_campos['password_edit']:'';?>" />  <br/>
                        <label><?php print trans('repetir_contrasenna'); ?></label>
                        <input type="password" name="password_edit_confir"  value="<?php print (isset($flash_campos['password_edit_confir']))?$flash_campos['password_edit_confir']:'';?>" />
                        </div>
                        <br class="clean" /><br/>
                         <?php print '<a id="tog-1" class="toggle '.$clase_lnk_tog.'" title="'.trans('cambiar_pasword').'" data-pick="'.trans('recoger').'" ><span>'.$ver_tog.'</span><span class="fl"></span></a>'; ?>
                         <br class="clean" /><br/>
                        <input type="submit" class="buttom roman" value="<?php print trans('guardar');?>" /><br class="clean" />
                        </form>
                    </div>
                    <?php
					}
					elseif(isset($history) && ($history))
					{
					?>
                    <div class="form border_drk">
                    plantillas de productos
                    </div>
                    <?php
					}
					?>
				</div>
            </div>
        </div>
        <?php footer(); ?>
    </body>
</html>
