<?php
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_evento','evento');
?>
<div style="width:95%;">
        <div>
            <h4><?php print trans('evento')?>:
            	<strong>
					<?php print $datos_adicionales['nombre']; ?>
                </strong>
            </h4>
             <div style="clear:both"></div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('ev_inicio')?>:
                 <font color="#457FBD"><?php print app_str_date($datos_adicionales['fecha']); ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('ev_fin')?>:
                 <font color="#457FBD"><?php print app_str_date($datos_adicionales['fecha_fin']); ?></font>                 
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('ev_no_participantes')?>:
                 <font color="#457FBD"><?php print $datos_adicionales['no_participantes']; ?></font>                 
             </div>
             
             <div style="float:left;width:90%;height:20px;">
			     <?php print trans('ev_responsable_evento')?>:
             </div>
             
             <div style="float:left;width:90%;height:20px;">
			     <?php print trans('nombre_completo')?>:
                 <font color="#457FBD"><?php print $datos_adicionales['nombre_completo']; ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('email')?>:
                 <font color="#457FBD"><?php print $datos_adicionales['email']; ?></font>                 
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('telefono')?>:
                 <font color="#457FBD"><?php print $datos_adicionales['telefono']; ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('ciudad')?>:
                 <font color="#457FBD"><?php print $datos_adicionales['ciudad']; ?></font>                 
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('user_pais')?>:
                 <font color="#457FBD">
				 <?php
				 $pais = $controlador->sitio->st_get_pais($datos_adicionales['pais']);
				 print $pais['nombre']; ?></font>                 
             </div>
             
             <div style="float:left;width:90%;height:20px;">
			     <?php print trans('ev_servicios_incluidos')?>:
             </div>
             
             <?php
			 foreach($datos_adicionales['dias_ev'] as $keyday=>$d)
			 {
				 print '<div style="float:left;width:90%;height:20px;">';
				 	print trans('ev_dia_numero',array('numero'=>$keyday));
				 print '</div>';
				 print '<div style="float:left;width:70%;height:20px;">';
						 	print trans('ev_servicio');
				 print '</div>';
				 print '<div style="float:left;width:20%;height:20px;">';
						 	print trans('ev_cantidad');
				 print '</div>';
				 $dias_evento[] = array('numero_dia'=>$keyday,'descripcion'=>'Dia'.$keyday,'evento_fk'=>NULL);
				 foreach($d as $id_tipo_servicio=>$tipo_servicio)
				 {
					 foreach($tipo_servicio as $id_servicio=>$servicio)
					 {
						 
						 $tipo_servicio = $controlador->evento->get_tipo_servicio($id_tipo_servicio);
						 $tipo_servicio_nombre = app_traduccion('evento','evento_tipos_idioma','nombre','tipo_servicio_fk',$id_tipo_servicio,$tipo_servicio['nombre']);
						 $servicio_incluido = $controlador->evento->get_servicio($id_servicio);
						 $servicio_incluido_nombre = app_traduccion('evento','evento_servicio_idioma','nombre','servicio_fk',$id_servicio,$servicio_incluido['nombre']);
						 print '<div style="float:left;width:70%;height:20px;">';
						 	print '<font color="#457FBD">';
								print $tipo_servicio_nombre;
								print ': ';
						 		print $servicio_incluido_nombre;
							print '</font>';
						 print '</div>';
						 print '<div style="float:left;width:20%;height:20px;">';
						 	print '<font color="#457FBD">';
						 		print $servicio['cant_serv'];
							print '</font>';
						 print '</div>';						 
					 }				 		
				 }
			 }
			 ?>
             <br/>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('precio')?>:
                 <font color="#457FBD"><?php print app_rate_cambio($producto['price'],'ltr'); ?></font>
             </div>                     
        </div>
    <br/>
</div>