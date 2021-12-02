<?php
$controlador = & get_instance();
$controlador->load->model('mod_alojamiento','alojamiento');
$hotel = $controlador->alojamiento->get_hotel(array('disponible_para_la_venta'=>'t'));

?>
<?php echo form_open(base_url(trans('ruta_reservar_alojamiento')), array('class' => 'form_filter', 'id' => 'form_alojamiento')); ?>

	<div id="booking_loading" class="loader_reserva">
		<img style="margin-top: 74px;" src="images/loading_box.gif" alt="" />
		<br />
		<label><?php print trans('procesando'); ?></label>
	</div>

	<label><?php print trans('al_fecha_entrada'); ?></label>
    <input type="text" id="date_in_room" name="fecha" class="fecha" required="required" autocomplete="off" value="<?php print $hotel['fecha_minima']; ?>" />

    <div class="col cola">
    	<label><?php print trans('al_habitacion'); ?></label>
        <select id="nombre_habitacion" name="tipo_habitacion" required="required">
            <?php
				foreach($hotel['habitaciones_reserva'] as $h)
				{
					$nombre_habitacion = app_traduccion('hotel','hotel_tipo_hab_idioma','nombre','tipo_habitacion_fk',$h['tipo_habitacion_fk'],$h['nombre_habitacion']);
					print '<option value="'.$h['tipo_habitacion_fk'].'">'.$nombre_habitacion.'</option>';
				}
			?>
        </select>
    </div>
    <div class="col">
        <label><?php print trans('al_cantidad_habitaciones_abreviado'); ?></label>
        <select id="no_habitacion" name="cantidad_habitaciones">
        	<?php
				for($i=1;$i<=10;$i++)
				{
					print '<option value="'.$i.'">'.$i.'</option>';
				}
			?>
        </select>
    </div>

	<label><?php print trans('al_noches'); ?></label>
	<select id="booking_noches" name="noches">
		<?php
		$minimo_noche = $hotel['minimo_de_noches']?$hotel['minimo_de_noches']:1;
		for($i=1;$i<=30;$i++)
		{
			print '<option value="'.$i.'">'.$i.'</option>';
		}
		?>
	</select>
    <input id="booking_submit" type="submit" class="buttom roman" value="<?php print trans('reservar'); ?>" />
</form>
<script language="javascript" type="application/javascript">
	<?php
        $paros_venta = $hotel['paros_venta'];
        foreach ($paros_venta as $paro)
        {
            $text_paro = "['" . date("Y/m/d", strtotime($paro['fecha_inicio'])) . "','" . date("Y/m/d", strtotime($paro['fecha_fin'])) . "']";
            $paros_jscript[] = $text_paro;
        }
        $paros_tjscript = "";
        if (sizeof($paros_venta) > 0)
            $paros_tjscript = implode(',', $paros_jscript);
        print 'var closedDates = [' . $paros_tjscript . '];';
    ?>
	jQuery(function($){
		$("#date_in_room").datepicker({
			"dateFormat":"yy-mm-dd",
			minDate:'<?php print $hotel['fecha_minima']; ?>',
			maxDate:'<?php print $hotel['fecha_maxima'] ?>',
			onSelect: function() {
				update_booking2();
			},
			onChangeMonthYear: function(year, month, inst){
				$(this).datepicker( "setDate", year + '-' + month + '-01' );
				update_booking("<?php echo trans('seleccione_dia') ?>");
			},
			beforeShowDay: nonWorkingDates,
			beforeShow: update_booking()
		},$.datepicker.regional[ "<?php print CODIGO_IDIOMA; ?>" ]);

		$('#nombre_habitacion').change(function () {
			update_booking("<?php echo trans('seleccione_dia') ?>");
		});
	});

</script>