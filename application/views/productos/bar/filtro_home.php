<?php echo form_open(base_url(trans('ruta_eventos')),array('id' => 'form_bar', 'class' => 'form_filter hidden','style' => "display: none")); ?>

	<label>Fecha</label>
	<input type="text" id="date_in_room" name="date_in_room" class="fecha" />            
	<label>Bar</label>
	<select id="evento_form" name="evento_form">
		<option>Seleccione</option>
		<option>Barraca</option>
	</select>         
	<input type="submit" class="buttom roman" value="Reservar" />
</form> 