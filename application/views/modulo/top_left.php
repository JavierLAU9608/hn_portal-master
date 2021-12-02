<?php
if (sizeof($modulos) > 0) {
    print '<div id="area_ejecutivo">';
    print '<ul id="ejecutivo_carrousel" class="jcarousel-skin-tango">';
    foreach ($modulos as $m) {
        $m_trad = app_traduccion('frontend', 'frontend_modulo_idioma', null, 'modulo_fk', $m['modulo_fk'], $m);
        print '<li>';
        print '<img src="' . app_url_admin(
            ) . ('/admin/modulos/topleft-' . $m['imagen']) . '" width="295" height="163" title="' . $m['nombre'] . '">';
        if ($m['url'] !== '') {
            print '<a href="' . $m['url'] . '" class="title">';
        } else {
            print '<a class="title nohand">';
        }
        print '<h1>';
        print $m_trad['nombre'];
        print '</h1>';
        print $m_trad['sub_titulos'];
        print '</a>';
        print '<div class="info">';
        print  $m_trad['descripcion'];
        print '</div>';
        print '</li>';
    }
    print '</ul>';
    print '</div>';
}
?>