<!DOCTYPE html>
<html lang="<?php print app_idioma_codigo(); ?>">
    <?php
    $titulo = "Mapa del sitio"; //trans('mapa_sitio');
    //print_r($menu);exit;
    ?>
    <?php
    head(array('titulo' => trans('mapa_sitio'),
        'description' => trans('seo_description_mapa'),
        'keywords' => trans('seo_keywords_mapa'), //, 'jqTreeView/jquery.js'
        'css' => array('jqTreeView/jquery.treeview.css')
            )
    );
    ?>
    <body>
        <?php top(array("title" => $titulo, "subtitle" => '')); ?>
        <div class="white_bg">
            <div id="body" class="center">
                <div id="left_area">
                    <?php modulo_load(); ?>
                    <div class="clean_space" ></div>
                    <?php modulo_ofertas(); ?>
                    <?php //modulo_load(array('posicion'=>'publicidad_vertical'));  ?>                  
                </div>
                <div id="center_area">                    
                    <?php
                    if (isset($mapa)) {
                        if (count($mapa) > 0) {
                            ?>

                            <UL id="red" class="treeview-red site_map">
                                <?php
                                foreach ($mapa as $key => $map) {
                                    ?>
                                    <LI>
                                        <SPAN><H2><?php print $map['nombre']; ?></H2></SPAN>
                                        <?php if (count($map['menu']) > 0) { ?>
                                            <UL>
                                                <?php foreach ($map['menu'] as $k => $menuArr) { ?>
                                                    <LI><SPAN><?php print "<a href='" . $menuArr['url'] . "' target='_parent' class='verdana' >" . $menuArr['titulo'] . "</a>"; ?></SPAN>
                                                        <?php if (isset($menuArr['menu']) && count($menuArr['menu']) > 0 && $menuArr['menu'] != '') { ?>
                                                            <UL>
                                                                <?php foreach ($menuArr['menu'] as $r => $subMenu) { ?>
                                                                    <LI><SPAN><?php print "<a href='" . $subMenu['url'] . "' target='_parent' class='verdana'>" . $subMenu['titulo'] . "</a>"; ?></SPAN>
                                                                        <?php if (isset($subMenu['menu']) && count($subMenu['menu']) > 0 && $subMenu['menu'] != '') { ?> 
                                                                            <UL>
                                                                                <?php foreach ($subMenu['menu'] as $o => $subMenu2) { ?>
                                                                                    <LI><SPAN><?php print "<a href='" . $subMenu2['url'] . "' target='_parent' class='verdana' >" . $subMenu2['titulo'] . "</a>"; ?></SPAN></LI>
                                                                                <?php } ?>
                                                                            </UL>
                                                                        <?php } ?>
                                                                    </LI>
                                                                <?php } ?>
                                                            </UL>
                                                        <?php } ?>
                                                    </LI>
                                                <?php } ?>
                                            </UL>
                                        <?php } ?>

                                    </LI>
                                <?php } ?>
                            </UL>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
        <?php footer(array('js' => array('jqTreeView/jquery.cookie.js', 'jqTreeView/jquery.treeview.js', 'jqTreeView/demo.js'))); ?>
        <script type="text/javascript" language="javascript">
        </script>
    </body>
</html>