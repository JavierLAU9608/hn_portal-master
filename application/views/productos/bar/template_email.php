<?php
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_bar','bar');
$bar = $controlador->bar->get_bar(array('id'=>$datos_adicionales['id_bar']));
$menu_reservado = $controlador->bar->get_menu($datos_adicionales['id_menu']);
$horario_reservado = $controlador->bar->get_horario($datos_adicionales['id_duracion']);
?>
<div style="width:95%;">
        <div>
            <h4><?php print trans('br_bar')?>:
            	<strong>
					<?php print $bar['nombre']; ?>
                </strong>
            </h4>
             <div style="clear:both"></div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('br_dia_reservacion')?>:
                 <font color="#457FBD"><?php print app_str_date($datos_adicionales['fecha']); ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('br_cantidad_personas')?>:
                 <font color="#457FBD"><?php print $datos_adicionales['cantidad']; ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('br_menu')?>:
                 <font color="#457FBD"><?php print $menu_reservado['nombre']; ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('br_duracion')?>:
                 <font color="#457FBD"><?php print $horario_reservado['duracion']; ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('br_precio_hora_extra')?>:
                 <font color="#457FBD"><?php print $datos_adicionales['horas_extras']; ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('precio')?>:
                 <font color="#457FBD"><?php print app_rate_cambio($producto['price'],'ltr'); ?></font>
             </div>                     
        </div>
    <br/>
</div>