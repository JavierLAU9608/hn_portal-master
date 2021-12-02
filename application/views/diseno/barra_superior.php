<div class="golden_bg">
  <div id="menu_top" class="center relative">
    <div class="social_net">
      <?php
            $redes_sociales = app_redes_sociales();
            foreach($redes_sociales as $r)
            {
				print '<a target="_blank" href="'.$r['url'].'">';
					print '<img title="'.$r['descripcion'].'" src="'. app_url_admin(). ('/admin/redes/'.$r['icono_top']).'"/>';
				print '</a>';
            }
        ?>
        <a class="rss" target="_blank" href="<?php print base_url(trans('ruta_rss',array('codigo'=>CODIGO_IDIOMA))); ?>" title="<?php print trans('rss'); ?>">
        	<img src="<?php print base_url('images/rss_top.png'); ?>"/>
        </a>
    </div>
    <div class="select left">
      <a id="idioma" href="#"  title="Seleccione idioma"><?php print trans('idioma'); ?><span><?php $idioma_current = app_idioma(); /*print_r($idioma_current);*/ $idioma_actual = ($idioma_current['nombre_trad']!=NULL && trim($idioma_current['nombre_trad'])!="")?$idioma_current['nombre_trad']:$idioma_current['nombre']; print $idioma_actual;//print $idioma_current['nombre']; ?></span></a>
      <a id="moneda" href="#" title="Seleccione moneda"><?php print trans('moneda'); ?><span><?php $moneda_current = app_moneda();print $moneda_current['nombre']; ?></span></a>
      <a href="<?php print trans('ruta_mapa_sitio'); ?>" id="site_map" title="<?php print trans('mapa_sitio'); ?>"><span><?php print trans('mapa_sitio'); ?></span></a>
    </div> 
    <div class="links right">
        <?php $clas_carro = ($this->cart->total_items()>0)?'cart':'cart_vacio';?> 
    	<a id="<?php print $clas_carro;?>" <?php if($this->cart->total_items()>0){ print 'href="'.trans('ruta_carro_compra').'"'; }else{ print 'style="cursor:auto"'; } ?> title="<?php print trans('carro_compra'); ?>"><span><?php print trans('carro_compra'); ?></span></a>
        <?php
			app_menu_usuario();
		?>     
    </div> 
    <div style="display: none" class="golden_bg menu_select m_idioma border">
		<?php
            $idiomas_sistema = app_idiomas();
            print '<ul>';
                foreach($idiomas_sistema as $i)
                {
                    print '<li onclick="cambiar_idioma('.$i['id'].')"><a>';
                        print ($i['nombre_trad']!=NULL && trim($i['nombre_trad'])!="")?$i['nombre_trad']:$i['nombre'];
                    print '</a></li>';
                }
            print '</ul>';
        ?>
    </div>
    <div style="display: none" class="golden_bg menu_select m_moneda border">
		<?php
            $monedas_sistema = app_monedas();
            print '<ul>';
                foreach($monedas_sistema as $m)
                {
                    print '<li  onclick="cambiar_moneda('.$m['id'].')"><a>';
                        print $m['nombre'];
                    print '</a></li>';
                }
            print '</ul>';
        ?>
    </div>     	      
  </div>
  <?php print $form_registro; ?>
  <?php print $form_login; ?>
</div>