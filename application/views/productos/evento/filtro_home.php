<?php
$controlador = & get_instance();
$controlador->load->model('mod_evento','evento');
$tipo_menu = $this->evento->get_tipo_menu();	
?>
<?php echo form_open(base_url(trans('ruta_eventos')), array('id' => 'form_event', 'class' => 'form_filter','style' => "display: none")); ?>

    <label><?php print trans('ev_inicio');?></label>
    <input type="text" id="date_in_event" name="date_in_event" class="fecha" readonly="readonly" />
    <label><?php print trans('ev_fin');?></label>
    <input type="text" id="date_out_event" name="date_out_event" class="fecha" readonly="readonly"  />
    <div class="col cola">
    	<label><?php print trans('ev_tipo');?></label>
    	<select id="tipo_evento"  name="tipo_evento">
            <option value=""><?php print trans('ev_seleccione');?></option>
            <?php 
            foreach($tipo_menu as $tipo)
            {
                $tipo_menu_nomb = app_traduccion('evento','evento_tipom_idioma','nombre','tipo_menu_fk',$tipo['id'],$tipo['nombre']); 
                print '<option '.(isset($selected) ? $selected: '').' value="'.$tipo['id'].'">'.$tipo_menu_nomb.'</option>';
            }
            ?>                            
        </select>
    </div>             
    <div class="col">
    	<label><?php print trans('ev_no_inv');?></label>
    	<input type="text" id="no_participantes" name="no_participantes"/>
    </div>          
    <input type="submit" class="buttom roman" value="Reservar" />
</form>
<script language="javascript" type="application/javascript">
var release = 5;
jQuery(function ($) {
    $("#date_in_event").datepicker({
        "dateFormat": "yy-mm-dd",
        minDate: release,
        maxDate: '1Y'
    }, $.datepicker.regional["<?php print CODIGO_IDIOMA; ?>"]);
    $("#date_out_event").datepicker({
        "dateFormat": "yy-mm-dd",
        minDate: release,
        maxDate: '1Y'
    }, $.datepicker.regional["<?php print CODIGO_IDIOMA; ?>"]);

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
});
</script>