<?php
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_alojamiento','alojamiento');
$hotel = $controlador->alojamiento->get_hotel();
?>
<div style="width:95%;">
    <?php foreach($datos_adicionales['habitaciones'] as $h)
	{
		$tipo_habitacion = $controlador->alojamiento->_get_tipo_habitacion($h['tipo_habitacion']);
		$tipo_habitacion_nombre = app_traduccion('hotel','hotel_tipo_hab_idioma','nombre','tipo_habitacion_fk',$tipo_habitacion['id'],$tipo_habitacion['nombre_habitacion']);
		$plan_alimentacion = $controlador->alojamiento->_get_plan_alimentacion($h['plan']);
		$plan_nombre = app_traduccion('hotel','hotel_plan_idioma','nombre','plan_fk',$plan_alimentacion['id'],$plan_alimentacion['nombre_plan']); 
	?>
        <div class="habitacion">
            <h4><?php print trans('al_habitacion')?>:
            	<strong>
					<?php print $tipo_habitacion_nombre; ?>
                </strong>
            </h4>
             <div style="clear:both"></div>
             <div style="float:left;width:65%;height:20px;">
			     <?php print trans('al_fecha_entrada')?>:
                 <font color="#457FBD"><?php print app_str_date($h['fecha']); ?></font>
             </div>
            <div style="float:left;width:45%;height:20px;">
                <?php print trans('al_noches')?>:
                <font color="#457FBD"><?php print $h['noches']; ?></font>
            </div>
            <br/>

            <div style="float:left;width:100%;height:20px;">
                <?php print trans('responsable_hab_nombre')?>:
                <font color="#457FBD"><?php print $h['responsable_nombre']; ?></font>
            </div>
            <div style="float:left;width:80%;height:20px;">
                <?php print trans('responsable_hab_pasaporte')?>:
                <font color="#457FBD"><?php print $h['responsable_pasaporte']; ?></font>
            </div>

             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('al_hora_entrada')?>:
                 <font color="#457FBD"><?php print $h['hora']; ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			      <?php print trans('al_pax')?>:
                  <font color="#457FBD"><?php print $h['paxs']; ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('al_plan_alojamiento')?>:
                 <font color="#457FBD"><?php print $plan_nombre; ?></font>
             </div>             
             <div style="float:left;width:45%;height:20px;">
                  <?php
				  if($h['paquete_luna_miel'])
				  {
					  $paquete_luna_miel = $controlador->alojamiento->get_paquete_luna_miel($h['paquete_luna_miel']);
					  $paquete_luna_miel_nombre = app_traduccion('hotel','hotel_pack_idioma','nombre','pack_fk',$paquete_luna_miel['id'],$paquete_luna_miel['nombre']);
				  	  print trans('al_paquete_luna_miel').': <font color="#457FBD">'.$paquete_luna_miel_nombre.'</font>';
				  }
				  ?>
             </div>

             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('precio')?>:
                 <font color="#457FBD"><?php print app_rate_cambio($h['precio'],'ltr'); ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php
				  if($h['ninno_adicional']!=='f' && $h['ninno_adicional'])
				  {
				  	  print '<font color="#457FBD">'.trans('al_ninno_adicional').'</font>';
				  }
				  ?>
             </div>
                                  
        </div>

        <div style="clear:both;margin-top:10px"></div>

    <?php } ?>
    <br/>
</div>

<div>
    <?php if(isset($h['detalles_reservacion']['desglose_oferta'])) {
        $lastOffer = '';
        foreach ($h['detalles_reservacion']['desglose_oferta'] as $ofert) {
            if ($lastOffer != $ofert['titulo']) { //parche rápido
                echo trans('oferta_aplicada').$ofert['titulo'] . '<br>'.trans('precio_sin_oferta'). $h['detalles_reservacion']['precio_original']. '<br>'.trans('descripcion_oferta'). $ofert['desc'];
                $lastOffer = $ofert['titulo'];
            }
        }
        ?>

    <?php } ?>
</div>