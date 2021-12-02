<?php
$datos_adicionales = $producto['options'];
$controlador = & get_instance();
$controlador->load->model('mod_oferta','oferta');
$oferta = $controlador->oferta->get_oferta(array('id'=>$datos_adicionales['id_oferta']));
$oferta_traducido = app_traduccion('oferta','oferta_idioma',NULL,'oferta_fk',$oferta['id'],$oferta);
$oferta_tipo_traducido = app_traduccion('oferta','oferta_tipo_idioma',NULL,'tipo_fk',$oferta['tipo_fk'],$oferta['tipo']);
?>
<div style="width:95%;">
        <div>
            <h4><?php print trans('of_oferta')?>:
            	<strong>
                	<?php print $oferta_tipo_traducido['nombre'].' >>'; ?> 
					<?php print ' '.$oferta_traducido['nombre']; ?>
                </strong>
            </h4>
             <div style="clear:both"></div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('of_fecha')?>:
                 <font color="#457FBD"><?php print app_str_date($datos_adicionales['fecha']); ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('of_cantidad')?>:
                 <font color="#457FBD"><?php print $datos_adicionales['cantidad']; ?></font>
             </div>
             <div style="float:left;width:45%;height:20px;">
			     <?php print trans('of_cantidad_dias')?>:
                 <font color="#457FBD"><?php print $datos_adicionales['cantidad_dias']; ?></font>
             </div>
             <?php if(isset($datos_adicionales['detalles']) && $datos_adicionales['detalles']!=='' && $datos_adicionales['detalles']!==NULL)
			 {
			 ?>
             <div style="float:left;width:90%;height:auto;">
			     <?php print trans('of_solicitud_adicional')?>:
                 <font color="#457FBD"><?php print $datos_adicionales['detalles']; ?></font>
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