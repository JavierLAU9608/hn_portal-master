<?php
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_restaurante','restaurante');
$restaurante = $controlador->restaurante->get_restaurante(array('id'=>$datos_adicionales['id_restaurante']));
?>
<div style="width:95%;">
        <div>
            <h4><?php print trans('restaurante')?>:
            	<strong>
					<?php print $restaurante['nombre']; ?>
                </strong>
            </h4>
             <div style="clear:both"></div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('rt_dia_reservacion')?>:
                 <font color="#457FBD"><?php print app_str_date($datos_adicionales['fecha']); ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('rt_horario')?>:
                 <font color="#457FBD">
				 	<?php
					$horario = $controlador->restaurante->get_horario($datos_adicionales['horario']);
					$horario_nombre = app_traduccion('restaurante','restaurante_horario_idioma','nombre','horario_fk',$horario['id'],$horario['nombre']);
					print $horario_nombre.' ('.app_str_hora($horario['hora_inicio']).'-'.app_str_hora($horario['hora_fin']).')';
					?>
                 </font>
             </div>
             <div style="float:left;width:90%;height:20px;">
			     <?php print trans('rt_menus_reservados')?>:
             </div>
             
             <?php
			 foreach($datos_adicionales['menus'] as $m)
			 {
			 	$datos_menu = $controlador->restaurante->get_el_menu($datos_adicionales['id_restaurante'],$m['id_menu']);
				$nombre_menu = app_traduccion('restaurante','restaurante_menu_idioma','nombre','menu_fk',$datos_menu['id'],$datos_menu['nombre']);
				?>                
                <div style="float:left;width:45%;height:20px;">
			     	<?php print '<strong>'.$nombre_menu.'</strong>'; ?>
             	</div>
                <div style="float:left;width:45%;height:20px;">
			     	<?php print trans('rt_cantidad'); ?>:
                    <font color="#457FBD"><?php print $m['cantidad']; ?></font>
             	</div>
                <?php
			 }
			 ?>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('precio')?>:
                 <font color="#457FBD"><?php print app_rate_cambio($producto['price'],'ltr'); ?></font>
             </div>                     
        </div>
    <br/>
</div>