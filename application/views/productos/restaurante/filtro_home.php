<?php
$controlador = & get_instance();
$controlador->load->model('mod_restaurante','restaurante');
$restaurantes = $controlador->restaurante->get_restaurantes();
?>
<?php echo form_open(base_url(trans('ruta_reservar_restaurante',array('slug'=>'{slug}'))), array('id' => 'form_restaurant', 'class' => 'form_filter','style' => "display: none")); ?>

    <label><?php print trans('rt_dia_reservacion'); ?></label>
    <input type="text" id="date_in_restaurante" name="fecha" class="fecha" />
    <label><?php print trans('rt_restaurante'); ?></label>
    <select id="filtro_restaurante"  name="restaurante">
    	<?php
		foreach($restaurantes as $r)
		{
			print '<option value="'.$r['slug'].'">'.$r['nombre'].'</option>';
		}
		?>
    </select>         
    <input type="button" id="buttom_filtro_restaurante" class="buttom roman" value="<?php print trans('reservar'); ?>" />
</form>
<script language="javascript" type="application/javascript">
	jQuery(function($) {
		$("#date_in_restaurante").datepicker({
			"dateFormat": "yy-mm-dd",
			minDate:<?php print $r['release']; ?>,
			maxDate: '1Y'
		}, $.datepicker.regional["<?php print CODIGO_IDIOMA; ?>"]);
		$('#buttom_filtro_restaurante').click(function (e) {
			e.preventDefault();
			var slug = $('#filtro_restaurante').val();
			var url = $('#form_restaurant').attr('action');
			url = url.replace('{slug}', slug);
			$('#form_restaurant').attr('action', url);
			$('#form_restaurant').submit();
		});
	});
</script>