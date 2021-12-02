<div class="headerTop header-mobi-ext">
    <div class="container">
        <div class="row">
            <!-- Logo BEGIN -->
            <div class="col-md-2 col-sm-2">
                <a class="scroll site-logo" href="#promo-block"><img src="web/assets/frontend/onepage/img/logo/logo.png" alt="Hotel Nacional de Cuba"></a>
            </div>
            <!-- Logo END -->
            <a href="javascript:void(0);" class="mobi-togglerTop"><i class="fa fa-bars"></i></a>
            <!-- Navigation BEGIN -->
            <div class="col-md-10 pull-right padding-top-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group" style="float: right; position: relative">
                            <button data-toggle="dropdown" type="button" class="btn btn-language btn-lg dropdown-toggle" aria-expanded="false">
                                <i class="fa fa-globe"></i> <?php $idioma_current = app_idioma(); $idioma_actual = ($idioma_current['nombre_trad']!=NULL && trim($idioma_current['nombre_trad'])!="")?$idioma_current['nombre_trad']:$idioma_current['nombre']; print $idioma_actual;//print $idioma_current['nombre']; ?>
                            </button>
                            <ul role="menu" class="dropdown-menu pull-right">
                                <?php foreach($idiomas_sistema as $i){ if ($idioma_current['id'] != $i['id']){ ?>
                                    <li>
                                        <a href="javascript:cambiar_idioma(<?php echo $i['id'] ?>);">
                                            <?php print ($i['nombre_trad']!=NULL && trim($i['nombre_trad'])!="")?$i['nombre_trad']:$i['nombre']; ?>
                                        </a>
                                    </li>
                                <?php }} ?>
                            </ul>
                        </div>

                        <div style="position: relative;float: right; height: 34px; width: 1px; background-color: #ccc;"></div>

                        <div class="btn-group" style="float: right; position: relative">
                            <button data-toggle="dropdown" type="button" class="btn btn-language btn-lg dropdown-toggle" aria-expanded="false">
                                <?php $moneda_current = app_moneda();print $moneda_current['nombre']; ?>
                            </button>
                            <ul role="menu" class="dropdown-menu pull-right">
                                <?php foreach($monedas_sistema as $m){ ?>
                                    <li>
                                        <a href="javascript:cambiar_moneda(<?php echo $m['id'] ?>);">
                                            <?php print $m['nombre'] ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div style="position: relative;float: right; height: 34px; width: 1px; background-color: #ccc;"></div>

                        <div class="btn-group" style="float: right; position: relative">
                            <?php if (!$datos_usuario) { ?>

                                    <button class="btn btn-link" data-toggle="modal" data-target="#loginform"><?php print trans('autenticar'); ?></button>
                                    <button class="btn btn-link" data-toggle="modal" data-target="#registerform"><?php print trans('registrarse'); ?></button>

                            <?php } else { ?>
                                <?php $user = (strlen($datos_usuario['nombre'])>21)?substr($datos_usuario['nombre'],0,18).'...':$datos_usuario['nombre']; ?>
                                <button data-toggle="dropdown" type="button" class="btn btn-language btn-lg dropdown-toggle" aria-expanded="false">
                                    <a href="<?php echo base_url(trans('ruta_mi_cuenta')) ?>"><?php echo $user ?></a>
                                    <a href="<?php base_url('salir') ?>"><?php echo trans('cerrar_session') ?></a>
                                </button>
                            <?php } ?>
                        </div>

                        <div style="float: right; position: relative; margin-right: 20px;">
                            <span class="glyphicon glyphicon-shopping-cart"></span> <button class="btn btn-default circle" type="button"><?php print trans('carro_compra'); ?></button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <ul class="header-navigation">
                            <?php
                            $menu_principal = app_menu();

                            foreach($menu_principal as $k=> $m)
                            {
                                print '<li ' . ($k == 0 ? 'class="current"': null). '>';
                                print '<a href="'.$m['url'].'">';
                                $titulo =  $m['titulo_trad'] != null ? $m['titulo_trad']: $m['titulo'];
                                print $titulo;
                                print '</a>';
                                print '</li>';
                            }

                            ?>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul class="header-social">
                            <?php
                            foreach($redes_sociales as $r)
                            { ?>
                                <li>
                                    <a style="background: url('<?php echo app_url_admin().('/admin/redes/'.$r['icono_top']) ?>') no-repeat;" class="social-icon social-icon-color circle" target="_blank" title="<?php echo $r['descripcion'] ?>" href="<?php echo $r['url'] ?>">
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- Navigation END -->
        </div>
    </div>
</div>
