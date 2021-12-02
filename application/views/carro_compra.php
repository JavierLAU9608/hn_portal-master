<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
	<?php head(array('titulo'=>trans('carro_compra'))); ?>
    <body>
        <?php top(array('title'=>trans('carro_compra'))); ?>
        <div class="white_bg">
            <div id="body" class="center no_marg">
                <div class="left_center">
                <?php
                $clase_shop = ($total_productos>0)?'class="shop_car"':'class="empty_car"';
				?>
                <h1 class="title_pad_left"><span <?php print $clase_shop; ?> ></span><span class="padd"><?php print trans('carro_compra_cantidad_productos', array('cantidad'=>$total_productos)); ?></span></h1>
                    <br class="clean" /><br class="clean_space" />
                	<?php
						if($total_productos>0)
						{
							$importe_a_confirmar = 0;
							$importe_a_pagar = 0;
							foreach($lista_productos_carro as $producto)
							{
								print $producto['options']['template_car'];
								if($producto['options']['aconfirmar'] == 1)
								{
									$importe_a_confirmar +=$producto['price'];
								}
								else
								{
									$importe_a_pagar +=$producto['price'];
								}
							}
					?>



                    <div class="pago_car border_drk_1">
                        <div class="orange_lite">
                            <div class="precio_reserva right">
                                <p class="verdana"><?php print trans('importe_a_confirmar'); ?></p>
                                <span></span><p class="verdana border yellow_lite"><?php print app_rate_cambio($importe_a_confirmar,'smb'); ?></p>
                                <p class="verdana"><?php print trans('importe_total'); ?></p>
                                <span></span><p class="verdana border yellow_lite"><?php print app_rate_cambio($total_monto,'smb'); ?></p>
                            </div>
                            <br class="clean"/>
                        </div>
                        <br class="clean_lttl_space" />
                        <div class="interior">
                            <div class="precio_reserva right">
                                <p class="verdana"><?php print trans('importe_a_pagar'); ?></p>
                                <span></span>
                                <p class="verdana yellow_bg"><?php print app_rate_cambio($importe_a_pagar,'smb'); ?></p>										
                                <a class="buttom roman no_margen" href="<?php print trans('ruta_datos_reserva'); ?>" ><?php print trans('carro_compra_continuar'); ?></a>
                                <br class="clean_lttl_space" /><br/>
                            </div>
                        </div>
                    </div>
                    <?php
					}
					?>

                    <div id="left_area" style="margin-top: 10px;">

                        <div class="menu golden_bg">
                            <ul>
                                <?php
                                foreach($items as $key=>$item)
                                {
                                    if($item['url']!=='')
                                    {
                                        print '<li>';
                                        print '<a title="'.$item['titulo'].'" href="'.base_url('login-page').'/'.$item['url'].'">';
                                        print $item['titulo'];
                                        print '</a>';
                                        print '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>


                        <div class="clean_space" ></div>
                    </div>
                </div>
            </div> 
        </div>   
        <?php footer(); ?>
    </body>
</html>